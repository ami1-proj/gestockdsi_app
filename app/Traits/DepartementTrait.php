<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use App\Departement;

trait DepartementTrait {
  use TagTrait;

	public function formatRequestInput($formInput){

        // Formattage des Tags a insérer dans la DB
        $formInput = $this->setFormatTags($formInput);

        return $formInput;
  }

  public function getCheminComplet($intitule, $parent_id) {
    if (is_null($parent_id)) {
      return $intitule;
    } else {
      $parent = Departement::find($parent_id);

      return $parent->chemin_complet . ' > ' . $intitule;
    }
  }
}
