<?php

namespace App\Http\Requests\Cart;

use App\Http\Requests\ApiRequest;

class UpdateCartQuantityRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'exists:products,id',
            'quantity' => 'required|integer'
        ];
    }
}
