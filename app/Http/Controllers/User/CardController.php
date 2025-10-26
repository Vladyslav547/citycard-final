<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Card\StoreCardRequest;
use App\Http\Requests\User\Card\StoreRechargeRequest;
use App\Http\Requests\User\Card\StoreRideRequest;
use App\Models\Card;
use App\Models\City;
use App\Models\CardRecharge;
use App\Models\CardRide;
use App\Models\TicketType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * User-facing CardController.
 *
 * Handles listing user cards, creating cards, recharges and recording rides.
 */
class CardController extends Controller
{
    /** Require authentication for all actions. */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /** List cards for current user. */
    public function index(): View
    {
        $cards = Card::where('user_id', auth()->id())
            ->with('city')
            ->latest()
            ->paginate(10);

        return view('user.cards.index', compact('cards'));
    }

    /** Show form to create a new card. */
    public function create(): View
    {
        $cities = City::orderBy('name')->get();
        return view('user.cards.create', compact('cities'));
    }

    /** AJAX: get ticket types by city. */
    public function getTicketTypesByCity(int $cityId)
    {
        $city = City::with('ticketTypes')->findOrFail($cityId);
        return response()->json($city->ticketTypes);
    }

    /** Store new card. */
    public function store(StoreCardRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['balance'] = 0;

        $card = Card::create($data);

        return redirect()
            ->route('user.cards.show', $card)
            ->with('success', 'Картку створено.');
    }

    /** Show card details. */
    public function show(Card $card): View
    {
        $this->authorizeCard($card);

        $card->load([
            'city',
            'recharges' => fn($q) => $q->latest(),
            'rides' => fn($q) => $q->latest(),
        ]);

        $ticketTypes = $card->city
            ? $card->city->ticketTypes()->orderBy('name')->get()
            : collect();

        $transportTypes = $card->city
            ? $card->city->transportTypes()->orderBy('name')->get()
            : collect();

        return view('user.cards.show', compact('card', 'ticketTypes', 'transportTypes'));
    }

    /** Store a card recharge. */
    public function storeRecharge(StoreRechargeRequest $request, Card $card): RedirectResponse
    {
        $this->authorizeCard($card);

        $data = $request->validated();

        DB::transaction(function () use ($card, $data) {
            CardRecharge::create([
                'card_id'     => $card->id,
                'amount'      => $data['amount'],
                'description' => $data['description'] ?? null,
            ]);

            $card->increment('balance', $data['amount']);
        });

        return back()->with('success', 'Баланс поповнено.');
    }

    /** Record a ride (spend). */
    public function storeRide(StoreRideRequest $request, Card $card): RedirectResponse
    {
        $this->authorizeCard($card);

        $data = $request->validated();

        $ticketType = TicketType::findOrFail($data['ticket_type_id']);
        $price = $ticketType->price;

        if (bccomp($card->balance, $price, 2) < 0) {
            return back()->withErrors(['ride' => 'Недостатньо коштів на картці.']);
        }

        DB::transaction(function () use ($card, $ticketType, $data, $price) {
            CardRide::create([
                'card_id'           => $card->id,
                'city_id'           => $card->city_id,
                'ticket_type_id'    => $ticketType->id,
                'transport_type_id' => $data['transport_type_id'],
                'price'             => $price,
                'boarded_at'        => now(),
            ]);

            $card->decrement('balance', $price);
        });

        return back()->with('success', 'Поїздку зафіксовано.');
    }

    /** Delete card (only owner allowed). */
    public function destroy(Card $card): RedirectResponse
    {
        $this->authorizeCard($card);

        $card->delete();

        return redirect()
            ->route('user.cards.index')
            ->with('success', 'Картку видалено.');
    }

    /** Ensure current user owns the card. */
    private function authorizeCard(Card $card): void
    {
        if ($card->user_id !== auth()->id()) {
            abort(403, 'Доступ заборонено');
        }
    }
}
