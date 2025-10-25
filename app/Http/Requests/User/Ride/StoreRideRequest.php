<?php

namespace App\Http\Requests\User\Ride;

use Illuminate\Foundation\Http\FormRequest;

class StoreRideRequest extends FormRequest
{
    /**
     * Authorize any authenticated user.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Validation rules for creating a ride (separate Ride flow).
     */
    public function rules(): array
    {
        return [
            'city_id'        => 'required|exists:cities,id',
            'transport_id'   => 'required|exists:transport_types,id',
            'ticket_type_id' => 'required|exists:ticket_types,id',
        ];
    }
}
