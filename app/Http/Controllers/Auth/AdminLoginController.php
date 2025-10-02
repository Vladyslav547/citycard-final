<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Показ форми входу
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Обробка входу
    public function login(Request $request)
    {
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

    // Вихід
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
