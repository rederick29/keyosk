<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

class RegisterUserController extends Controller
{
    public function create()
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
