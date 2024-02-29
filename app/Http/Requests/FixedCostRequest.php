<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FixedCostRequest extends FormRequest
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
            'particular'=>[
                'required',
                'string',
                'max:50',
            ],
            'no_of_ha'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
            'cost_per_ha'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
            'total_amount'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            'particular.numeric'=>'Please input particular',
            'no_of_ha.numeric'=>'Please input your no of ha, field must be a number',
            'cost_per_ha.numeric'=>'Please input cost per ha, field must be a number',
            'gps_longitude.numeric'=>'Please input total amount, field must be a number',
            
       ];
    
    }
}
