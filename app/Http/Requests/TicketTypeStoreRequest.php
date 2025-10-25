<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketTypeStoreRequest extends FormRequest
{
    /**
     * Only admins can create ticket types.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_admin;
    }

    /**
     * Rules for storing ticket type.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
