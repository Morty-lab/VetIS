<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
//    public function store(Request $request): RedirectResponse
//    {
//
//        $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//            'password' => ['required', 'confirmed', Rules\Password::defaults()],
//        ]);
//
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'role' => 'client',
//            'password' => Hash::make($request->password),
//        ]);
//
//        event(new Registered($user));
//
//        Auth::login($user);
//
//        return redirect(RouteServiceProvider::HOME_CLIENT);
//    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,15'],
            'birthday' => ['required', 'date', 'before:today'],
            'password' => ['required'],
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'role' => 'client',
            'password' => Hash::make($request->password),
        ]);

        // Add the user to the clients table
        Clients::createClient([
            'user_id' => $user->id,
            'client_name' => $request->first_name . " " . $request->last_name,
            'client_address' => $request->address,
            'client_no' => $request->phone_number,
            'client_birthday' => $request->birthday,
        ]);

        // Dispatch the registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect to the client home route
        return redirect(RouteServiceProvider::HOME_CLIENT);
    }

}
