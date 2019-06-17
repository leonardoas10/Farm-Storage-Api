<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
        'product' => 'required|regex:/^[a-zA-Z]+$/u|max:10',
        'price' => 'required|numeric',
        ];
    }

    public function messages()
    {   
        return [
        'product.required' => 'A product is required, enter only letters',
        'price.required'  => 'A price is required, enter only numbers',
        ];
    }
}
