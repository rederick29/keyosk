<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class SessionController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        // Validate the request on the following rules:
        // [email] - valid email format, max 255 chars, min 5 chars, and must exist in the users table
        // [password] - see Providers/AppServiceProvider.php
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'min:5', 'exists:users,email'],
            'password' => ['required', Password::defaults()],
        ]);

        // The credentials are the email and password
        $credentials = $request->only('email', 'password');

        // If the credentials are correct, log the user in and redirect to the home page
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Welcome, ' . Auth::user()->name . '!');
        }

        // If the credentials are incorrect, redirect back to the login page with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->only('email');
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
