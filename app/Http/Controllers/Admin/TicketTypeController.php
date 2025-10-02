<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\City;

class TicketTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $ticketTypes = TicketType::with('city')->orderBy('name')->paginate(20);
        return view('admin.ticket_types.index', compact('ticketTypes'));
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('admin.ticket_types.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id',
        ]);

        TicketType::create($data);

        return redirect()->route('admin.ticket-types.index')->with('success', 'Тип квитка створено.');
    }

    public function show(TicketType $ticket_type)
    {
        return view('admin.ticket_types.show', compact('ticket_type'));
    }

    public function edit(TicketType $ticket_type)
    {
        $cities = City::orderBy('name')->get();
        return view('admin.ticket_types.edit', compact('ticket_type', 'cities'));
    }

    public function update(Request $request, TicketType $ticket_type)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id',
        ]);

        $ticket_type->update($data);

        return redirect()->route('admin.ticket-types.index')->with('success', 'Тип квитка оновлено.');
    }

    public function destroy(TicketType $ticket_type)
    {
        $ticket_type->delete();
        return back()->with('success', 'Тип квитка видалено.');
    }
}
