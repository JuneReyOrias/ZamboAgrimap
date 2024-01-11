<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorizeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rule= [
            'cat_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'cat_descript'=>[
                'required',
                'string',
                'max:50',
            ],
            
           
        ];
        return $rule;
    }
}
