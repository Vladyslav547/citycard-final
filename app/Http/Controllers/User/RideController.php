<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function create($cardId)
    {
        $card = Card::findOrFail($cardId);
        $city = $card->city;

        $transports = $city->transportTypes; 
        $ticketTypes = $city->ticketTypes;

        return view('user.rides.create', compact('card', 'city', 'transports', 'ticketTypes'));
    }

    public function store(Request $request, $cardId)
    {
        $request->validate([
            'city_id'        => 'required|exists:cities,id',
            'transport_id'   => 'required|exists:transport_types,id',
            'ticket_type_id' => 'required|exists:ticket_types,id',
        ]);

        Ride::create([
            'card_id'        => $cardId,
            'city_id'        => $request->city_id,
            'transport_id'   => $request->transport_id,
            'ticket_type_id' => $request->ticket_type_id,
            'ride_time'      => now(),
        ]);

        return redirect()->route('user.cards.show', $cardId)
            ->with('success', 'Поїздка успішно додана!');
    }
}
