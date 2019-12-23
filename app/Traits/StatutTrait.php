<?php

namespace App\Traits;
use App\Statut;

trait StatutTrait {

    use TagTrait;
    use DefaultTrait;


    public function formatRequestInput($formInput){

        $formInput['is_default'] = array_key_exists('is_default', $formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    public function unsetDefaultStatut($curr_statut) {
      $this->unsetDefault($curr_statut, Statut::default([$curr_statut->id])->first());
    }
}
