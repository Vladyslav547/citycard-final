<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Only admins can create cities.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_admin;
    }

    /**
     * Validation rules for creating a city.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:cities,name',
            'transport_types' => 'nullable|array',
            'transport_types.*' => 'exists:transport_types,id',
        ];
    }
}
