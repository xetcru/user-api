<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignWorkerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'worker_id' => 'required|exists:workers,id',
            'amount' => 'required|numeric|min:0'
        ];
    }
}