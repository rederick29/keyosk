<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Review;
use App\Models\Order;
use App\Models\User;
use PDO;

class AdminIndexController extends Controller
{
    /**
     * Displays the admin index page.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'query' => ['nullable', 'in:admin_only,users_only'],
        ]);

        $query = User::query();

        // Case-insensitive search filter
        if ($search = $validated['search'] ?? null) {
            // Convert the search term to lowercase
            $search = strtolower($search);

            // Search by name or email
            $query->where(function ($query) use ($search) {
                $likeOperator = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql' ? 'ilike' : 'like';

                $query->where('name', $likeOperator, "%{$search}%")
                    ->orWhere('email', $likeOperator, "%{$search}%");
            });
        }

        // Filter by user type (default is everyone)
        if ($search = $validated["query"] ?? null) {
            if ($validated['query'] === 'admin_only') {
                $query->where('is_admin', true);
            } elseif ($validated['query'] === 'users_only') {
                $query->where('is_admin', false);
            }
        }

        // Order by the currently authenticated user first, then by admin status, then by name
        $users = $query->orderByRaw('id = ? desc', [Auth::id()])
            ->orderBy('is_admin', 'desc')
            ->orderBy('last_name')
            ->paginate(24)
            ->withQueryString();

        return view('manage-users', compact('users'));
    }

    /**
     * Perform a bulk action on the selected users.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkAction(Request $request): JsonResponse
    {
        // Validate the request data
        $validated = $request->validate([
            'action' => ['required', 'in:delete,toggle_admin'],
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['integer', 'exists:users,id'],
        ]);

        // Extract the validated data
        $action = $validated['action'];
        $userIds = $validated['user_ids'] ?? [];

        // Ensure at least one user is selected
        if (empty($userIds)) {
            return response()->json(['message' => 'No users selected'], 400);
        }

        // Don't allow actions on the active admin
        if (in_array(Auth::id(), $userIds)) {
            return response()->json(['message' => 'Cannot perform action on the current user'], 400);
        }

        // Perform the selected action
        switch ($action) {
            case 'delete':
                // Delete all orders and reviews associated with the selected users
                Order::whereIn('user_id', $userIds)->delete();
                Review::whereIn('user_id', $userIds)->delete();

                // Delete the selected users
                User::whereIn('id', $userIds)->delete();
                break;

            case 'toggle_admin':
                // Toggle the is_admin status of the selected users
                User::whereIn('id', $userIds)
                    ->update(['is_admin' => DB::raw('NOT is_admin')]);
                break;

            default:
                return response()->json(['message' => 'Invalid action'], 400);
        }

        return response()->json(['message' => 'Action performed successfully']);
    }

    public function manage_users(): View
    {
        return view('manage-users');
    }

    public function stats(Request $request): View
    {
        return view('stats');
    }

    public function stats_best_selling(Request $request, int $amount = 10): JsonResponse
    {
        // Validation!
        $amount = $request->input('limit', $amount);
        $amount = is_numeric($amount) ? max(2, min(100, intval($amount))) : 10;

        $bestSellingProducts = DB::table('products')
            ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                DB::raw('COALESCE(SUM(order_product.quantity), 0) as total_sold')
            )
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderBy('total_sold', 'desc')
            ->limit($amount)
            ->get();

        return response()->json([
            'data' => $bestSellingProducts,
            'amount' => $bestSellingProducts->count(),
            'generated_at' => now()->toIso8601String()
        ]);
    }

    public function stats_worst_selling(Request $request, int $amount = 10): JsonResponse
    {
        // Validation!
        $amount = $request->input('limit', $amount);
        $amount = is_numeric($amount) ? max(2, min(100, intval($amount))) : 10;

        // (copy paste above but change the order by lol)
        $bestSellingProducts = DB::table('products')
            ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                DB::raw('COALESCE(SUM(order_product.quantity), 0) as total_sold')
            )
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderBy('total_sold', 'asc')
            ->limit($amount)
            ->get();

        return response()->json([
            'data' => $bestSellingProducts,
            'amount' => $bestSellingProducts->count(),
            'generated_at' => now()->toIso8601String()
        ]);
    }
}
