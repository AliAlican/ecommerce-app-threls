<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
            //matching password_confirmation should be present in input
        ];
    }
}
