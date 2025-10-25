<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Ride\StoreRideRequest;
use App\Models\Card;
use App\Models\Ride;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RideController extends Controller
{
    /**
     * Show create ride form for a card.
     */
    public function create(int $cardId): View
    {
        $card = Card::findOrFail($cardId);
        $city = $card->city;

        // Transport types and ticket types for the card's city
        $transports = $city->transportTypes;
        $ticketTypes = $city->ticketTypes;

        return view('user.rides.create', compact('card', 'city', 'transports', 'ticketTypes'));
    }

    /**
     * Store ride record.
     */
    public function store(StoreRideRequest $request, int $cardId): RedirectResponse
    {
        Ride::create([
            'card_id'        => $cardId,
            'city_id'        => $request->validated()['city_id'],
            'transport_id'   => $request->validated()['transport_id'],
            'ticket_type_id' => $request->validated()['ticket_type_id'],
            'ride_time'      => now(),
        ]);

        return redirect()
            ->route('user.cards.show', $cardId)
            ->with('success', 'Поїздка успішно додана!');
    }
}
