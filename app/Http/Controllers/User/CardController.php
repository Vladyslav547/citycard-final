<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\City;
use App\Models\CardRecharge;
use App\Models\CardRide;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /** Список карток користувача */
    public function index()
    {
        $cards = Card::where('user_id', auth()->id())
            ->with('city')
            ->latest()
            ->paginate(10);

        return view('user.cards.index', compact('cards'));
    }

    /** Форма створення картки */
    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('user.cards.create', compact('cities'));
    }

    /** AJAX: отримати типи квитків для міста */
    public function getTicketTypesByCity($cityId)
    {
        $city = City::with('ticketTypes')->findOrFail($cityId);
        return response()->json($city->ticketTypes);
    }

    /** Зберегти картку */
    public function store(Request $request)
    {
        $data = $request->validate([
            'number'  => 'required|string|max:50|unique:cards,number',
            'city_id' => 'required|exists:cities,id',
        ]);

        $data['user_id'] = auth()->id();
        $data['balance'] = 0;

        $card = Card::create($data);

        return redirect()
            ->route('user.cards.show', $card)
            ->with('success', 'Картку створено.');
    }

    /** Перегляд картки */
    public function show(Card $card)
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

    /** Поповнення балансу */
    public function storeRecharge(Request $request, Card $card)
    {
        $this->authorizeCard($card);

        $data = $request->validate([
            'amount'      => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ]);

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

    /** Проведення поїздки */
    public function storeRide(Request $request, Card $card)
    {
        $this->authorizeCard($card);

        $data = $request->validate([
            'ticket_type_id'    => 'required|exists:ticket_types,id',
            'transport_type_id' => 'required|exists:transport_types,id',
        ]);

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

    /** Видалення картки */
    public function destroy(Card $card)
    {
        $this->authorizeCard($card);

        $card->delete();

        return redirect()
            ->route('user.cards.index')
            ->with('success', 'Картку видалено.');
    }

    /** Перевірка доступу */
    private function authorizeCard(Card $card): void
    {
        if ($card->user_id !== auth()->id()) {
            abort(403, 'Доступ заборонено');
        }
    }
}
