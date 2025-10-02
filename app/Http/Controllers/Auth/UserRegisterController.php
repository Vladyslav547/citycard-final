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
    public function showRegistrationForm()
    {
        return view('auth.user-register');
    }

    public function register(Request $request)
    {
        $request->merge([
            'phone' => trim($request->phone),
            'card_number' => trim($request->card_number),
        ]);

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
                        $fail('Ця картка вже прив’язана до іншого користувача.');
                    }
                },
            ],
        ]);

        // 🔸 Створення користувача
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // 🔸 Прив’язка картки
        $card = Card::where('number', $request->card_number)->first();
        $card->user_id = $user->id;
        $card->save();

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
