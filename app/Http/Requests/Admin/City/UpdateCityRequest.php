<?php

namespace App\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    /**
     * Authorize only authenticated admins.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Validation rules for updating a city.
     */
    public function rules(): array
    {
        $cityId = $this->route('city')?->id ?? null;

        return [
            'name'              => 'required|string|max:255|unique:cities,name,' . $cityId,
            'transport_types'   => 'nullable|array',
            'transport_types.*' => 'exists:transport_types,id',
        ];
    }
}
