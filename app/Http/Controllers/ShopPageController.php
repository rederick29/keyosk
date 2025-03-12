<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use PDO;

class ShopPageController extends Controller
{
    public function index(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'sort' => 'nullable|in:date,best_selling,price_high_to_low,price_low_to_high',
            'spp' => 'nullable|integer|min:10|max:50',
            'filters' => 'nullable|string',
        ]);

        $search = isset($validated['search']) && $validated['search'] ? strtolower(urldecode($validated['search'])) : null;
        $filters = isset($validated['filters']) && $validated['filters'] ? explode(',', strtolower(urldecode($validated['filters']))) : null;
        $sort = $validated['sort'] ?? 'date';
        $perPage = $validated['spp'] ?? 10;

        $likeOp = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql' ? 'ilike' : 'like';

        $query = Product::with('tags')
            ->when($search, function ($q) use ($search, $likeOp) {
                $q->where(function ($q) use ($search, $likeOp) {
                    $q->where(DB::raw('lower(name)'), $likeOp, "%{$search}%")
                        ->orWhere(DB::raw('lower(description)'), $likeOp, "%{$search}%")
                        ->orWhereHas(
                            'tags',
                            fn($q) => $q->where(DB::raw('lower(name)'), $likeOp, "%{$search}%")
                        );
                });
            })
            ->when($filters, function ($q) use ($likeOp, $filters) {
                foreach ($filters as $filter) {
                    $q->whereHas('tags', function ($q) use ($likeOp, $filter) {
                        $q->where(DB::raw('lower(name)'), $likeOp, "{$filter}");
                    });
                }
            });

        if ($sort === 'best_selling') {
            $query->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
                ->select('products.*', DB::raw('COALESCE(SUM(order_product.quantity), 0) as total_sold'))
                ->groupBy([
                    'products.id',
                    'products.name',
                    'products.short_description',
                    'products.description',
                    'products.stock',
                    'products.price',
                    'products.created_at',
                    'products.updated_at'
                ])
                ->orderBy('total_sold', 'desc');
        } else {
            $orderColumn = $sort === 'date' ? 'created_at' : 'price';
            $direction = $sort === 'price_high_to_low' ? 'desc' : 'asc';
            $query->orderBy($orderColumn, $direction);
        }

        return view('shop', ['products' => $query->paginate($perPage)]);
    }
}
