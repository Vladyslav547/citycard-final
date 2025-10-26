<?php

namespace App\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\City;

class UpdateCityRequest extends FormRequest
{
    /** Authorize admin only. */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /** Validation rules for updating a city. */
    public function rules(): array
    {
        /** @var City $city */
        $city = $this->route('city');

        return [
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
            'transport_types' => 'nullable|array',
            'transport_types.*' => 'exists:transport_types,id',
        ];
    }
}
