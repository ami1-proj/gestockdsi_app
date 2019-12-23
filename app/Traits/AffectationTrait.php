<?php

namespace App\Traits;
use App\Affectation;
use App\Departement;
use App\Employe;
use App\Stock;
use App\TypeMouvement;
use App\TypeAffectation;
use App\Article;
use App\Statut;
use Illuminate\Support\Carbon;


trait AffectationTrait {
	public function createNew($objet, $date_affectation, $type_affectation_tag, $elem_id, $liste_article_ids = null) : Affectation {
		$statut_id_default = Statut::default()->first()->id;
		$mouvement_default = TypeMouvement::creation()->first();
		$details_mouvement = "Creation Nouvelle affectation";

		// creer une nouvelle affectation vide
		$new_affectation = New Affectation();

		if ($type_affectation_tag == 'Stock'){
			// Stock
			$new_affectation->stock_id = $elem_id;
			// Recuperation du stock a qui affecter
			$elem = Stock::find($elem_id);
		} elseif ($type_affectation_tag == 'Employe'){
			// Employe
			$new_affectation->employe_id=$elem_id;
			// Recuperation de l employe a qui affecter
      $elem = Employe::find($elem_id);
		} elseif ($type_affectation_tag == 'Departement'){
			// Service
			$new_affectation->departement_id = $elem_id;
			// Recuperation du service a qui affecter
			$elem = Departement::find($elem_id);
		} else {
      return null;
    }

	   // On complete les donnnees de la nouvelle affectation
	   $new_affectation->objet = $objet;
	   $new_affectation->date_debut = Carbon::parse($date_affectation);
	   $new_affectation->type_affectation_id = TypeAffectation::tagged($type_affectation_tag)->first()->id;
	   $new_affectation->statut_id = $statut_id_default;

	   // Enregistrement (dans la base de donnees) de la nouvelle affectation
	   $new_affectation->save();

	   // Affectation(s) des articles contenus dans la liste
	   if (!(is_null($liste_article_ids))){
	   		$this->affecterArticles($liste_article_ids,$new_affectation->id,$mouvement_default->id,$details_mouvement);
	   } else {
	   	// On ne fait rien
	   }

	   return $new_affectation;
	}

	public function updateOne($affectation_id, $newvalues, $mouvement_id, $details_mouvement, $liste_article_a_ajouter = null, $liste_article_a_retirer = null) : int
	{
			$affectation = Affectation::withCount('affectationarticles')->find($affectation_id);
			$affectation->fill($newvalues);
			$affectation->save();

			// Tentative de retrait de tous les articles
			if (!(is_null($liste_article_a_retirer))){
				if ($affectation->affectationarticles_count == count($liste_article_a_retirer)){
					if (is_null($liste_article_a_ajouter)) {
						// Une affectation doit contenir au moins un article
						return -1;
					}
				}
			}

			// Affectation(s) des articles contenus dans la liste des articles a jouter
 	   	if (!(is_null($liste_article_a_ajouter))){
				$this->affecterArticles($liste_article_a_ajouter,$affectation_id,$mouvement_id,$details_mouvement);
 	   	} else {
 	   		// On ne fait rien
 	   	}

		 	// Désaffectation(s) des articles contenus dans la liste des articles a retirer
	   	if (!(is_null($liste_article_a_retirer))){
	   		$this->desaffecterArticles($liste_article_a_retirer,$mouvement_id,$details_mouvement);
	   	} else {
	   		// On ne fait rien
	   	}

			return 1;
	}

	public function delateOne($affectation_id)
	{
			$mouvement_default = TypeMouvement::suppression()->first();
			$details_mouvement = "Suppression affectation";
			$affectation = Affectation::find($affectation_id);

		 	// Désaffectation(s) des articles de cette affectations
			foreach ($affectation->affectationarticles as $affectationarticle) {
				$article = Article::find($affectationarticle->article_id);
				$article->desaffecter($mouvement_default->id, $details_mouvement);
			}

			$affectation->terminer();
	}

	public function affecterArticles($liste_article_ids,$affectation_id, $mouvement_id, $details_mouvement)
	{
		foreach ($liste_article_ids as $article_id) {
			$article = Article::find($article_id);
			$article->affecter($affectation_id, $mouvement_id, $details_mouvement);
		}
	}

	public function desaffecterArticles($liste_article_ids, $mouvement_id, $details_mouvement)
	{
		foreach ($liste_article_ids as $article_id) {
			$article = Article::find($article_id);
			$article->desaffecter($mouvement_id, $details_mouvement);
		}
	}

	public function getElemArr($type_affectation_tag, $elem_id)
	{
			if ($type_affectation_tag == 'Stock'){
				// Stock
				$elem_arr['elem'] = Stock::find($elem_id);
				$elem_arr['article'] = 'au';
				$elem_arr['showController'] = 'StockController@show';
				$elem_arr['breadcrumb_create'] = 'stocks.affectation.create';
				$elem_arr['breadcrumb_edit'] = 'stocks.affectation.edit';
				$elem_arr['breadcrumb_show'] = 'stocks.affectation.show';
			} elseif ($type_affectation_tag == 'Employe'){
				// Employe
				$elem_arr['elem'] = Employe::find($elem_id);
				$elem_arr['article'] = 'a l';
				$elem_arr['showController'] = 'EmployeController@show';
				$elem_arr['breadcrumb_create'] = 'employes.affectation.create';
				$elem_arr['breadcrumb_edit'] = 'employes.affectation.edit';
				$elem_arr['breadcrumb_show'] = 'employes.affectation.show';
			} elseif ($type_affectation_tag == 'Departement'){
				// Service
				$elem_arr['elem'] = Departement::find($elem_id);
				$elem_arr['article'] = 'au';
				$elem_arr['showController'] = 'DepartementController@show';
				$elem_arr['breadcrumb_create'] = 'departements.affectation.create';
				$elem_arr['breadcrumb_edit'] = 'departements.affectation.edit';
				$elem_arr['breadcrumb_show'] = 'departements.affectation.show';
			} else {
				return null;
			}

			$elem_arr['breadcrumb_param'] = $elem_arr['elem']->id;
			$elem_arr['type'] = class_basename($elem_arr['elem']);
			return $elem_arr;
	}

	public function formatRequestInput($formInput){
			// Retrait de l' e-mail et du téléphone du tableau INPUT
			if (array_key_exists('articles_disponibles', $formInput)) {
				unset($formInput['articles_disponibles']);
			}
			if (array_key_exists('liste_articles_affectes', $formInput)) {
				unset($formInput['liste_articles_affectes']);
			}
			if (array_key_exists('type_mouvement_id', $formInput)) {
				unset($formInput['type_mouvement_id']);
			}
			if (array_key_exists('details', $formInput)) {
				unset($formInput['details']);
			}
			if (array_key_exists('elem_id', $formInput)) {
				unset($formInput['elem_id']);
			}

			return $formInput;
	}

	public function addRemoveArticles($articles_list_from, $articles_list_to, $articles_list_selected) {
		//1. On retire les articles selectionneés de la liste d'origine
		$articles_list_from_old = $articles_list_from;
		$articles_list_from = [];

		$articles_list_selected = Article::whereIn('id', $articles_list_selected)->get()->pluck('reference_complete', 'id')->toArray();
		foreach ($articles_list_from_old as $id => $value) {
			if(array_key_exists($id, $articles_list_selected)) {
			} else {
				$articles_list_from[$id] = $value;
			}
		}

		//2. On ajoute ces articles dans la liste des articles a affecter
		if (is_null($articles_list_to)) {
			$articles_list_to = $articles_list_selected;
		} else {
			$befor = $articles_list_to;
			$articles_list_to = $articles_list_to + $articles_list_selected;
		}

		$articles_list_from_json = json_encode($articles_list_from);
		$articles_list_to_json = json_encode($articles_list_to);

		return [
			$articles_list_from,
			$articles_list_to,
			$articles_list_from_json,
			$articles_list_to_json
		];

	}

}
