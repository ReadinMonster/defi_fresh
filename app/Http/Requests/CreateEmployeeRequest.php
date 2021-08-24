<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'max:50',
            ],
            'middle_name' => [
              'required',
              'max:50',
            ],
            'last_name' => [
              'required',
              'max:50',
            ],
            'position' => [
              'required',
              'max:50',
            ],
            'sex' => [
              'required',
            ],
            'email' => [
              'required',
            ],
        ];
    }
}
