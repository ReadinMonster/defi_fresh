<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEntryRequest extends FormRequest
{
  
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required'
            ],
            'product_id' => [
                'required'
            ]
        ];
    }
}
