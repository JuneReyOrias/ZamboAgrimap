<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaborRequest extends FormRequest
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
            'no_of_person'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
            'rate_per_person'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
            'total_labor_cost'=>[
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
            'no_of_person.numeric'=>'Please input no. of person, field must be a number',
            'rate_per_person.numeric'=>'Please input rate per person, field must be a number',
            'total_labor_cost.numeric'=>'Please input total labor cost, field must be a number',
       ];
    }
}
