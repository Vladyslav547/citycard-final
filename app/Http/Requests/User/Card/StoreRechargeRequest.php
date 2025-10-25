<?php

namespace App\Http\Requests\User\Card;

use Illuminate\Foundation\Http\FormRequest;

class StoreRechargeRequest extends FormRequest
{
    /**
     * Authorize any authenticated user.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Validation rules for recharging a card.
     */
    public function rules(): array
    {
        return [
            'amount'      => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ];
    }
}
