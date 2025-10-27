<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Admin-only login controller (email + password).
 */
class AdminLoginController extends Controller
{
    /**
     * Show login form for admins.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle admin login attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        // Note: this controller keeps inline validation for simplicity.
        // If needed, move to a dedicated FormRequest.
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'У вас немає доступу']);
        }

        return back()->withErrors(['email' => 'Невірні дані']);
    }

    /**
     * Log out current admin.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect('/');
    }
}
