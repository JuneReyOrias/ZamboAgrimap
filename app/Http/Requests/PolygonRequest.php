<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolygonRequest extends FormRequest
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
            'verone_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'verone_longitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'vertwo_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'vertwo_longitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'verthree_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'verthree_longitude'=>[
                'required',
                'string',
                'max:50',
            ], 
            'vertfour_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'vertfour_longitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'verfive_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'verfive_longitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'versix_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'versix_longitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'verseven_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'verseven_longitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'vereight_latitude'=>[
                'required',
                'string',
                'max:50',
            ],
           
            'verteight_longitude'=>[
                'required',
                'string',
                'max:50',
            ],
            'strokecolor'=>[
                'required',
                'string',
                'max:50',
            ],
        ];
        return $rule;
    }
}
