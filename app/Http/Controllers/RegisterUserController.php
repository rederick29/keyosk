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

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // Validate the request on the following rules:
        // [name] - string, max 255 chars, min 3 chars
        // [email] - email, max 255 chars, min 5 chars, and doesn't already exist in email
        // [password] - password-(confirm[ed]) is filled, max 255 chars, min 8 chars, at least 1 uppercase letter, 1 lowercase letter, and 1 number
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'email', 'max:255', 'min:5', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'max:255', Password::min(8)->mixedCase()->letters()->numbers()],
        ]);

        // If the validator fails, redirect back to the registration page with the errors and the input data
        // (frontend validation isn't good enough, lol)
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If the validator passes, hash the password and create the user
        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Try to create the user, log them in, and redirect to the home page with a success message
        try {
            $user = User::create($validatedData);
            Auth::login($user);
            return redirect('/')->with('success', 'Welcome, ' . Auth::user()->name . '!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'We could not create your account. Please try again later.');
        }
    }
}
