<?php

namespace App\Traits;
use App\TypeDepartement;

trait TypeDepartementTrait {

    use TagTrait;
    use DefaultTrait;


    public function formatRequestInput($formInput){

        $formInput['is_default'] = array_key_exists('is_default', $formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    public function unsetDefaultTypeDepartement($curr_typedepartement) {
      $this->unsetDefault($curr_typedepartement, TypeDepartement::default([$curr_typedepartement->id])->first());
    }
}
