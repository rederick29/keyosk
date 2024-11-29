<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store()
    {
        $user_form = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            // requires a form input with name 'password_confirmation'
            'password' => ['required', Password::default(), 'confirmed'],
        ]);

        $user = User::create($user_form);
        Auth::login($user);
        return redirect('/login');
    }
}
