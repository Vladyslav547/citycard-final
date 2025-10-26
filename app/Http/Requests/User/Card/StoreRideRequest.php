<?php

namespace App\Http\Requests\User\Card;

use Illuminate\Foundation\Http\FormRequest;

class StoreRideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'ticket_type_id'    => 'required|exists:ticket_types,id',
            'transport_type_id' => 'required|exists:transport_types,id',
        ];
    }
}
