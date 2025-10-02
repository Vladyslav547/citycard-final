<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Куди перенаправляти користувачів після логіну.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (Auth::user() && Auth::user()->is_admin) {
            return '/admin/dashboard';
        }

        return '/dashboard';
    }

    /**
     * Створення нового контролера
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
