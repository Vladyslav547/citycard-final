<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Card;

class CardLoginController extends Controller
{
    // Allow only guests to access login
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show card-login form
    public function showLoginForm()
    {
        return view('auth.login-card');
    }

    // Process login by card number + account password
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

        // Log in the user and redirect to user's cards
        Auth::login($user, true);

        return redirect()->intended(route('user.cards.index'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
