<?php

namespace App\Traits;
use App\EtatCommande;

trait EtatCommandeTrait {

    use TagTrait;
    use DefaultTrait;


    public function formatRequestInput($formInput){

        $formInput['is_default'] = array_key_exists('is_default', $formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    public function unsetDefaultEtatCommande($curr_etatcommande) {
      $this->unsetDefault($curr_etatcommande, EtatCommande::default([$curr_etatcommande->id])->first());
    }
}
