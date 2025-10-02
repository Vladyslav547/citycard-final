<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class UserLoginController extends Controller
{
    // Показ форми входу для користувача
    public function showLoginForm()
    {
        return view('auth.user_login');
    }

    // Обробка входу користувача
    public function login(Request $request)
    {
        $request->validate([
            'card_number' => 'required',
            'phone' => 'required',
        ]);

        $card = Card::where('number', $request->card_number)->first();

        if ($card && $card->user && $card->user->phone === $request->phone) {
            Auth::login($card->user);
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['card_number' => 'Невірні дані']);
    }

    // Вихід користувача
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
