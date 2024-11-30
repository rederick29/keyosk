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
}
