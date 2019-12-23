<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeRequest extends FormRequest
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
          'nom' => ['required','string','min:3','max:255',],
          'matricule' => ['required','string','min:3','max:255',
              // 'unique:employes,matricule,{$this->employe->id}',
          ],
          'fonction_employe_id' => ['required','integer',],
          'service_id' => ['required','integer',],
          'statut_id' => ['required','integer',],
          'nouveau_email' => ['sometimes','required','email'],
          'nouveau_phone' => ['sometimes','required','numeric'],
        ];
    }
}
