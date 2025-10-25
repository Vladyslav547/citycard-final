<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRideRequest extends FormRequest
{
    /**
     * Only card owner may create ride for it.
     */
    public function authorize(): bool
    {
        $card = $this->route('card');
        return $this->user() && $card && $card->user_id === $this->user()->id;
    }

    /**
     * Rules for creating a ride.
     */
    public function rules(): array
    {
        return [
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'transport_type_id' => 'required|exists:transport_types,id',
        ];
    }
}
