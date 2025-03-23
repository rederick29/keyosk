<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function index(): View
    {
        return view('forgot-password');
    }

    public function forgot_password(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')],
        ]);

        $status = Password::sendResetLink(request()->only('email'));
        if ($status === Password::RESET_LINK_SENT) {
            return to_route('index')->with('success', $status);
        }
        return back()->with('error', "Failed to send reset link: " . $status);
    }

    public function index_reset(Request $request): View
    {
        $token = $request->token;
        return view('reset-password', ['passwordToken' => $token]);
    }

    public function reset_password(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::default()],
        ]);

        $status = Password::reset(request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return to_route('login.get')->with('success', "Password reset successfully.");
        }
        return back()->with('error', "Failed to reset password: " . $status);
    }
}
