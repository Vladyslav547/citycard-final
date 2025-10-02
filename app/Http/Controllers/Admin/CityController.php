<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\TransportType;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $cities = City::with('transportTypes')->orderBy('name')->paginate(15);
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $transportTypes = TransportType::orderBy('name')->get();
        return view('admin.cities.create', compact('transportTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'transport_types' => 'nullable|array',
            'transport_types.*' => 'exists:transport_types,id',
        ]);

        $city = City::create(['name' => $data['name']]);

        $city->transportTypes()->sync($request->input('transport_types', []));

        return redirect()->route('admin.cities.index')->with('success', 'Місто створено.');
    }

    public function edit(City $city)
    {
        $transportTypes = TransportType::orderBy('name')->get();
        $selected = $city->transportTypes()->pluck('id')->toArray();
        return view('admin.cities.edit', compact('city', 'transportTypes', 'selected'));
    }

    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,'.$city->id,
            'transport_types' => 'nullable|array',
            'transport_types.*' => 'exists:transport_types,id',
        ]);

        $city->update(['name' => $data['name']]);
        $city->transportTypes()->sync($request->input('transport_types', []));

        return redirect()->route('admin.cities.index')->with('success', 'Місто оновлено.');
    }

    public function destroy(City $city)
    {
        $city->transportTypes()->detach();
        $city->delete();

        return redirect()->route('admin.cities.index')->with('success', 'Місто видалено.');
    }
}
