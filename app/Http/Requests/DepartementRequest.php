<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartementRequest extends FormRequest
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
        'intitule' => ['required',],
        'statut_id' => ['required',],
        'employe_responsable_id' => ['employe_responsable_id',],
        'type_departement_id' => ['type_departement_id',],
        'departement_parent_id' => ['departement_parent_id',],
        
      ];
    }


     public function messages()
    {
        return [
          
          'intitule' => 'Prière de renseigner lintitule',
          
          'reference.min:3' => 'La référence doit comporter au trop 100 caractères',
          'date_livraison.required' => 'Prière de renseigner la date de Livraison',
          'date_livraison.date' => 'La date de Livraison doit avoir un format de date valide',
          
          
        ];
    }
}
