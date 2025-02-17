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
        // Validate input
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'sort' => 'nullable|in:date,best_selling,price_high_to_low,price_low_to_high',
            'spp' => 'nullable|integer|min:10|max:50',
        ]);

        // Get search and sort parameters
        $search = $validated['search'] ?? null;
        $sort = $validated['sort'] ?? 'date'; // Default sort by date
        $showPerPage = $validated['spp'] ?? 10; // Default items per page

        // Convert the search term to lowercase
        if ($search) {
            $search = strtolower(urldecode($search));
        }

        // Determine the appropriate LIKE operator based on the database driver
        $likeOperator = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql' ? 'ilike' : 'like';

        // Query products with search and sort
        $products = Product::with('tags')
            ->when($search, function ($query, $search) use ($likeOperator) {
                // Search by name or description
                $query->where(function ($query) use ($search, $likeOperator) {
                    $query->where(DB::raw('lower(name)'), $likeOperator, "%{$search}%")
                        ->orWhere(DB::raw('lower(description)'), $likeOperator, "%{$search}%");
                });
            })
            ->when($sort, function ($query, $sort) {
                switch ($sort) {
                    case 'best_selling':
                        $query->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
                            ->select([
                                'products.*',
                                DB::raw('COALESCE(SUM(order_product.quantity), 0) as total_sold')
                            ])
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
                        break;
                        break;
                    case 'price_high_to_low':
                        $query->orderBy('price', 'desc');
                        break;
                    case 'price_low_to_high':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'date':
                    default:
                        $query->orderBy('created_at', 'desc');
                        break;
                }
            })
            ->paginate($showPerPage);

        return view('shop', ['products' => $products]);
    }
}
