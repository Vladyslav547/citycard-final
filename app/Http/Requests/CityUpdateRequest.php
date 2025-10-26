<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityUpdateRequest extends FormRequest
{
    /**
     * Only admins can update cities.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_admin;
    }

    /**
     * Validation rules for updating a city.
     *
     * Note: expect route param 'city' for unique rule.
     */
    public function rules(): array
    {
        $cityId = $this->route('city') ? $this->route('city')->id : null;

        return [
            'name' => 'required|string|max:255|unique:cities,name,' . $cityId,
            'transport_types' => 'nullable|array',
            'transport_types.*' => 'exists:transport_types,id',
        ];
    }
}
