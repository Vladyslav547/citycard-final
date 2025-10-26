<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreCityRequest;
use App\Http\Requests\Admin\City\UpdateCityRequest;
use App\Models\City;
use App\Models\TransportType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * City management for admin area.
 *
 * Handles listing, creation, editing and deletion of cities and
 * syncing transport types via the city_transport pivot table.
 */
class CityController extends Controller
{
    /** Constructor: require auth + admin middleware. */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /** Display paginated list of cities with transport types. */
    public function index(): View
    {
        $cities = City::with('transportTypes')->orderBy('name')->paginate(15);
        return view('admin.cities.index', compact('cities'));
    }

    /** Show form to create a city. */
    public function create(): View
    {
        $transportTypes = TransportType::orderBy('name')->get();
        return view('admin.cities.create', compact('transportTypes'));
    }

    /** Store a newly created city and sync transport types pivot. */
    public function store(StoreCityRequest $request): RedirectResponse
    {
        $city = City::create(['name' => $request->validated('name')]);
        $city->transportTypes()->sync($request->input('transport_types', []));
        return redirect()->route('admin.cities.index')->with('success', 'Місто створено.');
    }

    /** Show edit form for a city. */
    public function edit(City $city): View
    {
        $transportTypes = TransportType::orderBy('name')->get();
        $selected = $city->transportTypes()->pluck('id')->toArray();
        return view('admin.cities.edit', compact('city', 'transportTypes', 'selected'));
    }

    /** Update city and its transport types relationship. */
    public function update(UpdateCityRequest $request, City $city): RedirectResponse
    {
        $city->update(['name' => $request->validated('name')]);
        $city->transportTypes()->sync($request->input('transport_types', []));
        return redirect()->route('admin.cities.index')->with('success', 'Місто оновлено.');
    }

    /** Delete a city and detach pivot relations. */
    public function destroy(City $city): RedirectResponse
    {
        $city->transportTypes()->detach();
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'Місто видалено.');
    }
}
