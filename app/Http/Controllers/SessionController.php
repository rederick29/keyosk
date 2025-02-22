<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('login');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the request on the following rules:
        // [email] - valid email format, max 255 chars, min 5 chars, and must exist in the users table
        // [password] - see Providers/AppServiceProvider.php
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'min:5', 'exists:users,email'],
            'password' => ['required', Password::defaults()],
        ]);

        // If the credentials are correct, log the user in and redirect to the home page
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $redirect = redirect()->intended('/')->with('success', 'Welcome, ' . $user->name . '!');

            if ($user->is_admin) {
                $redirect = redirect()->route('admin.index');
            }

            if ($user->last_login && $user->subscription && $user->last_login->lt(Carbon::now()->subDays(1))) {
                $user->coins += 10;
                $redirect = redirect()->intended('/')->with('success', 'Welcome back, ' . $user->name . '! You received 10 Coins.');
            }

            $user->last_login = Carbon::now();
            return $redirect;
        }

        // If the credentials are incorrect, redirect back to the login page with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        // Invalidate the session and regenerate the token to prevent session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'Sorry to see you go!');
    }
}
