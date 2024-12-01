<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
                $query->where('name', 'ilike', "%{$search}%")
                    ->orWhere('email', 'ilike', "%{$search}%");
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
            ->orderBy('name')
            ->paginate(24)
            ->withQueryString();

        return view('admin-index', compact('users'));
    }

    public function bulkAction(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'action' => ['required', 'in:delete,toggle_admin'],
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['integer', 'exists:users,id'],
        ]);

        $action = $validated['action'];
        $userIds = $validated['user_ids'] ?? [];

        if (empty($userIds)) {
            return response()->json(['message' => 'No users selected'], 400);
        }

        // Don't allow actions on the active admin
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
