<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function index(int $id = null): View
    {
        if ($id === null) {
            return view('account', ['user' => Auth::user()]);
        }

        try {
            $user = User::findOrFail($id);
            return view('account', compact('user'));
        } catch (Exception $e) {
            return view('account', ['user' => Auth::user()]);
        }
    }

    public function create(): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'min:5', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        try {
            // Create the user and log them in
            $user = User::create($validatedData);

            // TODO: implement remember me functionality
            $rememberMe = false;
            Auth::login($user, $rememberMe);

            // If the user is an admin, redirect to the admin dashboard
            if ($user->is_admin) {
                return redirect()->route('admin.index');
            }

            // Redirect to the home page with a success message
            return redirect('/')->with('success', "Welcome, {$user->name}!");
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'We could not create your account. Please try again later.');
        }
    }
}
