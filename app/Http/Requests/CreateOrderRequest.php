<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_id' => 'required|exists:order_types,id',
            'partnership_id' => 'required|exists:partnerships,id',
            'description' => 'required|string',
            'date' => 'required|date',
            'address' => 'required|string',
            'amount' => 'required|numeric|min:0'
        ];
    }
}