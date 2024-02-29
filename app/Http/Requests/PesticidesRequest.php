<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesticidesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $rule= [
            // 'pesticides_name'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            // 'type_ofpesticides'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            'no_of_l_kg'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                
            ],
            'unitprice_ofpesticides'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                
            ],
            'total_cost_pesticides'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                
            ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            // 'pesticides_name.required'=>'Please input pesticides name',
            // 'type_ofpesticides.required'=>'Please input type of pesticides',
            'no_of_l_kg.numeric'=>'Please input  no of l kg, field must be a number',
            'unitprice_ofpesticides.numeric'=>'Please input unit price of pesticides, field must be a number',
            'total_cost_pesticides.numeric'=>'Please input total cost pesticides, field must be a number',
       ];
    
    }
}
