<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRechargeRequest extends FormRequest
{
    /**
     * Only card owner may recharge it.
     */
    public function authorize(): bool
    {
        $card = $this->route('card');
        return $this->user() && $card && $card->user_id === $this->user()->id;
    }

    /**
     * Rules for card recharge.
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ];
    }
}
