<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TicketType\StoreTicketTypeRequest;
use App\Http\Requests\Admin\TicketType\UpdateTicketTypeRequest;
use App\Models\TicketType;
use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Admin controller for ticket types.
 *
 * Handles CRUD for ticket types and associates them with a city.
 */
class TicketTypeController extends Controller
{
    /** Require authentication + admin. */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /** List ticket types with their city. */
    public function index(): View
    {
        $ticketTypes = TicketType::with('city')->orderBy('name')->paginate(20);
        return view('admin.ticket_types.index', compact('ticketTypes'));
    }

    /** Show create form. */
    public function create(): View
    {
        $cities = City::orderBy('name')->get();
        return view('admin.ticket_types.create', compact('cities'));
    }

    /** Store a new ticket type. */
    public function store(StoreTicketTypeRequest $request): RedirectResponse
    {
        TicketType::create($request->validated());
        return redirect()->route('admin.ticket-types.index')->with('success', 'Тип квитка створено.');
    }

    /** Show ticket type details. */
    public function show(TicketType $ticket_type): View
    {
        return view('admin.ticket_types.show', compact('ticket_type'));
    }

    /** Show edit form for a ticket type. */
    public function edit(TicketType $ticket_type): View
    {
        $cities = City::orderBy('name')->get();
        return view('admin.ticket_types.edit', compact('ticket_type', 'cities'));
    }

    /** Update existing ticket type. */
    public function update(UpdateTicketTypeRequest $request, TicketType $ticket_type): RedirectResponse
    {
        $ticket_type->update($request->validated());
        return redirect()->route('admin.ticket-types.index')->with('success', 'Тип квитка оновлено.');
    }

    /** Delete ticket type. */
    public function destroy(TicketType $ticket_type): RedirectResponse
    {
        $ticket_type->delete();
        return back()->with('success', 'Тип квитка видалено.');
    }
}
