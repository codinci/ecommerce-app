<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phoneNo' => ['required', 'regex:/^(?=\d{10}$)(01|07)\d+/', 'unique:users,phone_no'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [

            'name.required' => 'The name field is required.',
            'phoneNo.required' => 'The phone number field is required.',
            'phoneNo.regex' => 'Please enter a valid phone number.',
            'phoneNo.unique' => 'This phone number is already registered.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone_no' => $request->phoneNo,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
