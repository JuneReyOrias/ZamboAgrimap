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
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'verone_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'vertwo_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'vertwo_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'verthree_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'verthree_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ], 
            'vertfour_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'vertfour_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'verfive_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'verfive_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'versix_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'versix_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'verseven_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'verseven_longitude'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'vereight_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
            'verteight_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'strokecolor'=>[
                'required',
                'string',
                'max:50',
            ],
            'area'=>[
                'numeric',
                 'regex:/^\d+(\.\d+)?$/',
                 'max:180',
             ],
             'perimeter'=>[
                'numeric',
                 'regex:/^\d+(\.\d+)?$/',
                 'max:180',
             ],
        ];
        return $rule;
    }
    public function messages()
    {
        return [
            'verone_latitude.numeric' => 'The Point 1 Latitude field must be a number.',
            'verone_latitude.regex' => 'The Point 1 Latitude field must be a valid numeric value.',
            'verone_latitude.max' => 'The Point 1 Latitude field must be less than or equal to 180.',
            'verone_longitude.numeric' => 'The Point 1 Longitude field must be a number.',
            'verone_longitude.regex' => 'The Point 1 Longitude field must be a valid numeric value.',
            'verone_longitude.max' => 'The Point 1 Longitude field must be less than or equal to 180.',
            'vertwo_latitude.numeric' => 'The Point 2 Latitude field must be a number.',
            'vertwo_latitude.regex' => 'The Point 2 Latitude field must be a valid numeric value.',
            'vertwo_latitude.max' => 'The Point 2 Latitude field must be less than or equal to 180.',
            'vertwo_longitude.numeric' => 'The Point 2 Longitude field must be a number.',
            'vertwo_longitude.regex' => 'The Point 2 Longitude field must be a valid numeric value.',
            'vertwo_longitude.max' => 'The Point 2 Longitude field must be less than or equal to 180.',
            'verthree_latitude.numeric' => 'The Point 3 Latitude field must be a number.',
            'verthree_latitude.regex' => 'The Point 3 Latitude field must be a valid numeric value.',
            'verthree_latitude.max' => 'The Point 3 Latitude field must be less than or equal to 180.',
            'verthree_longitude.numeric' => 'The Point 3 Longitude field must be a number.',
            'verthree_longitude.regex' => 'The Point 3 Longitude field must be a valid numeric value.',
            'verthree_longitude.max' => 'The Point 3 Longitude field must be less than or equal to 180.',

            'vertfour_latitude.numeric' => 'The Point 4 Latitude field must be a number.',
            'vertfour_longitude.numeric' => 'The Point 4 Longitude field must be a number.',
            'verfive_latitude.numeric' => 'The Point 5 Latitude field must be a number.',
            'verfive_longitude.numeric' => 'The Point 5 Longitude field must be a number.',
            'versix_latitude.numeric' => 'The Point 6 Latitude field must be a number.',
            'versix_longitude.numeric' => 'The Point 6 Longitude field must be a number.',
            'verseven_latitude.numeric' => 'The Point 7 Latitude field must be a number.',
            'verseven_longitude.numeric' => 'The Point 7 Longitude field must be a number.',
            'vereight_latitude.numeric' => 'The Point 8 Latitude field must be a number.',
            'verteight_longitude' => 'The Point 8 Longitude field must be a number.',
            // Add custom messages for other rules as needed...
            'strokecolor.required' => 'The stroke color field is required.',

            'area.numeric' => 'The area field must be a number.',
            
            'perimeter.numeric' => 'The perimeter field must be a number.',
            
        ];
    }
}
