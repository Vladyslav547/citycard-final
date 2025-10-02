<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Card;

class CardLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Показує форму входу за карткою
    public function showLoginForm()
    {
        return view('auth.login-card');
    }

    // Обробка логіну 
    public function login(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $card = Card::where('number', $request->card_number)->first();

        if (! $card || ! $card->user) {
            return back()
                ->withErrors(['card_number' => 'Картка не знайдена або не прив\'язана до користувача.'])
                ->withInput();
        }

        $user = $card->user;

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Невірний пароль.'])->withInput();
        }

        Auth::login($user, true);

        return redirect()->intended(route('user.cards.index'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
