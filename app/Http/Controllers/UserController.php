<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function index(int $userId = null): View
    {
        if ($userId === null) {
            return view('account', ['user' => Auth::user()]);
        }

        try {
            $user = User::findOrFail($userId);
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
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
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

    public function update(Request $request, int $userId = null): RedirectResponse
    {
        if ($userId === null) {
            $userId = Auth::id();
        } else if (!User::where('id', $userId)->exists()) {
            return redirect()->back()->with('error', 'Invalid user ID.');
        }

        $validatedData = $request->validate([
            'first_name' => ['string', 'min:3', 'max:255'],
            'last_name' => ['string', 'min:3', 'max:255'],
            'email' => ['email', 'lowercase', 'min:5', 'max:255', 'unique:users,email'],
            'current_password' => [Password::defaults()],
            'new_password' => [Password::defaults()],
        ]);
        $updates = [];
        $user = User::find($userId);

        $currentPassword = $validatedData['current_password'];
        $newPassword = $validatedData['new_password'];
        if (!(empty($currentPassword) && empty($newPassword))) {
            if ((empty($currentPassword) && !empty($newPassword))
                || (empty($newPassword) && !empty($currentPassword))) {
                return redirect()->back()->with('error', 'You must provide both the current password and the new password to modify it.');
            } else if (!Hash::check($validatedData['current_password'], $user->password)) {
                return redirect()->back()->with('error', 'The entered password is incorrect.');
            } else if ($validatedData['current_password'] === $validatedData['new_password']) {
                return redirect()->back()->with('error', 'You may not reuse the same password that is currently being used.');
            } else {
                $newPassword = Hash::make($newPassword);
                $updates['password'] = $newPassword;
            }
        }

        foreach ($validatedData as $key => $value) {
            // handled separately above
            if ($key === 'current_password' || $key === 'new_password') {
                continue;
            }
            if (!empty($value) && $user->$key != $value) {
                $updates[$key] = $value;
            }
        }

        if (!empty($updates)) {
            $user->update($updates);
        } else {
            // no changes to make
            return redirect()->back();
        }

        return redirect()->back()->with('success', 'The account has been updated successfully.');
    }

    public function address(Request $request, int $userId = null)
    {
        if ($userId === null || !Auth::user()->is_admin) {
            $userId = Auth::id();
        }
        $validatedData = $request->validate(['priority' => ['required', 'integer', 'min:0']]);

        $address = User::find($userId)->addresses()->where('priority', $validatedData['priority'])->first();
        return response()->json([ 'address' => [
            'name' => $address->name,
            'line_one' => $address->line_one,
            'line_two' => $address->line_two,
            'city' => $address->city,
            'postcode' => $address->postcode,
            'country' => Country::find($address->country_id)->code,
        ]]);
    }
}
