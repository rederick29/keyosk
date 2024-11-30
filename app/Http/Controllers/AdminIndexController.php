<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        if ($request->input('query') === 'admin_only') {
            $query->where('is_admin', true);
        } else if ($request->input('query') === 'users_only') {
            $query->where('is_admin', false);
        }


        $users = $query->orderByRaw('id = ? desc', [Auth::id()])  // Place current user first
            ->orderBy('is_admin', 'desc')  // Then order by admin status
            ->orderBy('name')  // Finally, order by name
            ->paginate(24)
            ->withQueryString();


        return view('admin-index', compact('users'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,toggle_admin',
            'user_ids' => 'required|array',
            'user_ids.*' => 'integer|exists:users,id',
        ]);

        $action = $request->input('action');
        $userIds = $request->input('user_ids', []);

        if (empty($userIds)) {
            return response()->json(['message' => 'No users selected'], 400);
        }

        // Don't allow performing actions on the currently authenticated user (admin)
        if (in_array(Auth::id(), $userIds)) {
            return response()->json(['message' => 'Cannot perform action on the current user'], 400);
        }

        switch ($action) {
            case 'delete':
                $users = User::whereIn('id', $userIds)->get();

                foreach ($users as $user) {
                    $user->orders()->delete();
                    $user->reviews()->delete();
                }

                User::whereIn('id', $userIds)->delete();
                break;

            case 'toggle_admin':
                User::whereIn('id', $userIds)
                    ->update(['is_admin' => DB::raw('NOT is_admin')]);
                break;

            default:
                return response()->json(['message' => 'Invalid action'], 400);
        }

        return response()->json(['message' => 'Action performed successfully']);
    }
}
