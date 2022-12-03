<?php

namespace App\Http\Requests\Cart;

use App\Http\Requests\ApiRequest;

class SynchroniseCartRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*.id' => 'required|integer',
            'products.*.quantity' => 'required|integer'
        ];
    }
}
