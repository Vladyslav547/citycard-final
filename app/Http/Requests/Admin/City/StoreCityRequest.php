<?php

namespace App\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    /**
     * Authorize only authenticated admins.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Validation rules for creating a city.
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|string|max:255|unique:cities,name',
            'transport_types'   => 'nullable|array',
            'transport_types.*' => 'exists:transport_types,id',
        ];
    }
}
