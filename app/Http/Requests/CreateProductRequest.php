<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
 
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required'
            ],
            'supplier_id' => [
              'required'
            ],
            'brand_id' => [
              'required'
            ],
            'product_name' => [
              'required'
            ],
            'product_quantity' => [
              'required'
            ],
            'product_price' => [
              'required'
            ],
        ];
    }
}
