<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeedRequest extends FormRequest
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
            // 'name_of_fertilizer'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            // 'type_of_fertilizer'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            'unit'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'quantity'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'unit_price'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'total_seed_cost'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            // 'name_of_fertilizer.required'=>'Please input name of fertilizer',
            // 'type of fertilizer.required'=>'Please input type of fertilizer',
            'unit.numeric'=>'Please input unit, field must be a number',
            'quantity.numeric'=>'Please input quantity, field must be a number',
            'unit_price.numeric'=>'Please input total labor cost, field must be a number',
            'total_seed_cost.numeric'=>'Please input total seed cost, field must be a number',
       ];
    }
}
