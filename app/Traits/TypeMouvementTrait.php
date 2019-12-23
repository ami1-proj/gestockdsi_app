<?php

namespace App\Traits;
use App\TypeMouvement;

trait TypeMouvementTrait {

    use TagTrait;
    use DefaultTrait;


    public function formatRequestInput($formInput){

        $formInput['is_default'] = array_key_exists('is_default', $formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    public function unsetDefaultTypeMouvement($curr_typemouvement) {
      $this->unsetDefault($curr_typemouvement, TypeMouvement::default([$curr_typemouvement->id])->first());
    }
}
