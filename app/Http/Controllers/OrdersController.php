<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order\OrderStatus;
use App\Models\Subscription\SubscriptionTiers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PDO;

class OrdersController extends Controller
{
    public function index($userId = null)
    {
        if ($userId === null || !Auth::user()->is_admin) {
            $userId = Auth::id();
        }

        // Get all orders for the authenticated user with their products and images order by latest first
        $orders = Order::with(['user', 'products.images'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('orders', compact('orders', 'userId'));
    }

    public function manage_orders(Request $request): View
    {
        $validatedData = $request->validate([
            'search' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'finalised_only' => ['nullable', 'boolean'],
            'sort_by' => ['nullable', 'string'],
        ]);

        $search = isset($validatedData['search']) && $validatedData['search'] ? strtolower(urldecode($validatedData['search'])) : null;
        $filter = isset($validatedData['status']) && $validatedData['status'] ? strtolower(urldecode($validatedData['status'])) : null;

        $query = Order::where('status', '!=', OrderStatus::Completed)
                ->where('status', '!=', OrderStatus::Refunded)
                ->where('status', '!=', OrderStatus::Cancelled);

        if ($filter) {
            $query = Order::where('status', $filter);
            if ($filter == OrderStatus::Completed || $filter == OrderStatus::Refunded || $filter == OrderStatus::Cancelled) {
                $query->latest('orders.created_at');
            }
        } else if (isset($validatedData['finalised_only']) && $validatedData['finalised_only'] === true) {
            $query = Order::where('status', OrderStatus::Completed)
                ->orWhere('status', OrderStatus::Refunded)
                ->orWhere('status', OrderStatus::Cancelled);
        }

        if (isset($validatedData['sort_by']) && $validatedData['sort_by'] === "subscription") {
            $query->join('subscriptions', 'subscriptions.user_id', '=', 'orders.user_id');
            foreach (SubscriptionTiers::getEnumValues() as $subscription) {
                $query->orderByRaw('subscriptions.tier = ?', [$subscription]);
            }
        } else if (!$filter) {
            foreach (OrderStatus::getEnumValues() as $status) {
                $query->orderByRaw('status = ? DESC', [$status]);
            }
        }

        $likeOp = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql' ? 'ilike' : 'like';
        $query
            ->when($search, function ($q) use ($search, $likeOp) {
                // select with aliases needed because by default they overwrite order's columns
                $q->leftJoin('users', 'users.id', '=', 'orders.user_id')->select('users.email as userEmail', 'users.id as userId', 'orders.*');
                $q->where(function ($q) use ($search, $likeOp) {
                    // order id
                    if (is_numeric($search)) {
                        $q->where('orders.id', $search);
                    }
                    // email
                    $q->orWhere(DB::raw('lower(orders.email)'), $likeOp, "%{$search}%")
                    // user's name
                    ->orWhere(DB::raw('lower(users.first_name)'), $likeOp, "%{$search}%")
                    ->orWhere(DB::raw('lower(users.last_name)'), $likeOp, "%{$search}%");
                });
                $q->groupBy('orders.status', 'orders.id', 'users.id');
            });
        if (!$search) {
            $query->groupBy('orders.status', 'orders.id');
        }

        $orders = $query->orderBy('orders.id', 'desc')->get();
        return view('manage-orders', compact('orders'));
    }

    private function updateOrder(int $orderId, OrderStatus $orderStatus)
    {
        try {
            $order = Order::findOrFail($orderId);
        } catch (ModelNotFoundException $e) {
            return back(404)->with('error', 'Order not found');
        }

        if (!Auth::user()->is_admin && $order->user_id !== Auth::id()) {
            return back(403)->with('error', 'You do not have permission to update this order');
        }

        $order->status = $orderStatus;
        $order->save();
        return back()->with('success', 'Order status updated successfully');
    }

    public function update(Request $request, int $orderId)
    {
        $validatedData = $request->validate([
            'status' => ['string', Rule::in(OrderStatus::getEnumValues())],
        ]);
        return $this->updateOrder($orderId, OrderStatus::tryFrom($validatedData['status']));
    }

    public function cancel(int $orderId)
    {
        return $this->updateOrder($orderId, OrderStatus::Cancelled);
    }

    public function refund(int $orderId)
    {
        return $this->updateOrder($orderId, OrderStatus::Refunded);
    }
}
