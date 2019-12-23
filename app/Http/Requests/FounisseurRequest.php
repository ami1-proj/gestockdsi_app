<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FounisseurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
          'prenom' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],

            'raison_social' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
          'statut_id' => [
                'required',
                'integer',
            ]
        ];
    }

public function messages()
    {
        return [
          
          'nom.required' => 'Prière de renseigner le nom',
          'prenom.required' => 'Prière de renseigner le nom',
          'raison_social.required' => 'Prière de renseigner le nom',

          
          
          
        ];
   }
  }
