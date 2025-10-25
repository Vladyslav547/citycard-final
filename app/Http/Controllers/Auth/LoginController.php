<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

/**
 * Standard login controller (keeps Laravel default behavior).
 * You can override credentials() here if you want login by phone/email.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users after login.
     */
    protected function redirectTo()
    {
        if (Auth::user() && Auth::user()->is_admin) {
            return '/admin/dashboard';
        }

        return '/dashboard';
    }

    /**
     * Controller constructor: guest middleware for everything except logout.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
