<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Article;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //$article = Article::find($this->route('articles'));
        return true;//, $article);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'reference' => ['required',],
        'date_livraison' => ['required','date',],
        'type_article_id' => ['required',],
        'etat_article_id' => ['required',],
        'marque_article_id' => ['required',],
        'fournisseur_id' => ['required',],
        'affectation_id' => ['required',],
        'statut_id' => ['required',],
      ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
          
          'taille.required' => 'Prière de renseigner la taille',
          'reference.min:3' => 'La référence doit comporter au moins 3 caractères',
          'reference.min:3' => 'La référence doit comporter au trop 100 caractères',
          'date_livraison.required' => 'Prière de renseigner la date de Livraison',
          'date_livraison.date' => 'La date de Livraison doit avoir un format de date valide',
          'statut_id.required' => 'Prière de rensigner le Statut',
          'marque_article_id.required' => 'Prière de rensigner la Marque de l article',
          
        ];
    }
}
