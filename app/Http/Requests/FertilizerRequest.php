<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FertilizerRequest extends FormRequest
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
            'no_ofsacks'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                
            ],
            'unitprice_per_sacks'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                
            ],
            'total_cost_fertilizers'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                
            ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            // 'name_of_fertilizer.required'=>'Please input name of fertilizer',
            // 'type of fertilizer.required'=>'Please input type of fertilizer',
            'no_ofsacks.numeric'=>'Please input no of sacks, field must be a number',
            'unitprice_per_sacks.numeric'=>'Please input unit price per sacks ,field must be a number',
            'total_cost_fertilizers.numeric'=>'Please input total cost fertilizers, field must be a number',
       ];
    }
}
