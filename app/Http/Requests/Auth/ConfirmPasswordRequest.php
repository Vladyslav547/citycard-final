<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only authenticated users confirm password
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
        ];
    }
}
