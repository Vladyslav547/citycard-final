<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class UserLoginController extends Controller
{
    /**
     * Display the user login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.user_login');
    }

    /**
     * Handle user login request via card number and phone number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return back()->withErrors(['card_number' => 'Invalid credentials']);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
