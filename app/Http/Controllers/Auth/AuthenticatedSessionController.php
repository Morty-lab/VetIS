<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
//    public function store(LoginRequest $request): RedirectResponse
//    {
//        $request->authenticate();
//
//        $request->session()->regenerate();
//
//        return redirect()->intended(RouteServiceProvider::HOME_ADMIN);
//    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = $request->user()->role;

        // Check the user's role and redirect accordingly
        switch ($role) {
            case 'client':
                $redirectRoute = RouteServiceProvider::HOME_CLIENT;
                break;

            case 'veterinarian':
                $redirectRoute = RouteServiceProvider::HOME_VETERINARIAN;
                break;

            case 'staff':
                $redirectRoute = RouteServiceProvider::HOME_STAFF;
                break;
            case 'secretary':
                $redirectRoute = RouteServiceProvider::HOME_SECRETARY;
                break;
            case 'cashier':
                $redirectRoute = RouteServiceProvider::HOME_CASHIER;
                break;
            default:
                $redirectRoute = RouteServiceProvider::HOME_ADMIN;
                break;
        }

        return redirect()->intended($redirectRoute);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $redirectRoute = $request->user()->role === 'client'
            ? '/portal/login'
            : '/';
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($redirectRoute);
    }
}
