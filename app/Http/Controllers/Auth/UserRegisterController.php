<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    /**
     * Show the registration form for user.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.user-register');
    }

    /**
     * Handle registration request from user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Trim phone and card number to remove extra spaces
        $request->merge([
            'phone' => trim($request->phone),
            'card_number' => trim($request->card_number),
        ]);

        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'card_number' => [
                'required',
                'exists:cards,number',
                function ($attribute, $value, $fail) {
                    $card = Card::where('number', $value)->first();
                    if ($card && $card->user_id !== null) {
                        $fail('This card is already linked to another user.');
                    }
                },
            ],
        ]);

        // 🔸 Create user record
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // 🔸 Attach card to user
        $card = Card::where('number', $request->card_number)->first();
        $card->user_id = $user->id;
        $card->save();

        // Automatically log the user in
        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    /**
     * Logout the currently authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
