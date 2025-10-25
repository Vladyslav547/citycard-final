<?php

namespace App\Http\Requests\Admin\TicketType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketTypeRequest extends FormRequest
{
    /**
     * Authorize only authenticated admins.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Validation rules for updating a ticket type.
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
