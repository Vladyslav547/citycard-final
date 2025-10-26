<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardStoreRequest extends FormRequest
{
    /**
     * Any authenticated user can create a card for themselves.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Rules for creating a card.
     */
    public function rules(): array
    {
        return [
            'number' => 'required|string|max:50|unique:cards,number',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
