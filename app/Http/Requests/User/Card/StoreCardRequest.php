<?php

namespace App\Http\Requests\User\Card;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'number'  => 'required|string|max:50|unique:cards,number',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
