<?php

namespace App\Traits;
use App\TypeAffectation;

trait TypeAffectationTrait {

    use TagTrait;
    use DefaultTrait;


    public function formatRequestInput($formInput){

        $formInput['is_default'] = array_key_exists('is_default', $formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    public function unsetDefaultTypeAffectation($curr_typeaffectation) {
      $this->unsetDefault($curr_typeaffectation, TypeAffectation::default([$curr_typeaffectation->id])->first());
    }
}
