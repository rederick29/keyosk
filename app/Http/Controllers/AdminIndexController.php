<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Case-insensitive search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($search) . "%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%" . strtolower($search) . "%"]);
            });
        }

        // Admin filter
        if ($request->input('is_admin') === '1') {
            $query->where('is_admin', true);
        }

        // Default sorting
        $users = $query->orderBy('name')
            ->paginate(50)
            ->withQueryString();

        return view('admin-index', compact('users'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,promote_to_admin',
            'user_ids' => 'required|array',
            'user_ids.*' => 'integer|exists:users,id',
        ]);

        $action = $request->input('action');
        $userIds = $request->input('user_ids', []);

        if (empty($userIds)) {
            return response()->json(['message' => 'No users selected'], 400);
        }

        switch ($action) {
            case 'delete':
                $users = User::whereIn('id', $userIds)->get();

                foreach ($users as $user) {
                    // Delete or handle related orders
                    $user->orders()->delete(); // Assuming `orders()` is a relationship in the User model
                }

                User::whereIn('id', $userIds)->delete();
                break;

            case 'promote_to_admin':
                User::whereIn('id', $userIds)->update(['is_admin' => true]);
                break;

            default:
                return response()->json(['message' => 'Invalid action'], 400);
        }

        return response()->json(['message' => 'Action performed successfully']);
    }
}
