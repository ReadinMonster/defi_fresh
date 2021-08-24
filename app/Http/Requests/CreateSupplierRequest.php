<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'supplier_name' => [
              'required',
            ],
            'supplier_contact_number' => [
              'required',
            ],
            'supplier_address' => [
              'required',
            ],
        ];
    }
}
