<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users|max:255',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:255',
        ];
    }
}
