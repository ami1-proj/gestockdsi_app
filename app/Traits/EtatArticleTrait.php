<?php

namespace App\Traits;
use App\EtatArticle;

trait EtatArticleTrait {

    use TagTrait;
    use DefaultTrait;


    public function formatRequestInput($formInput){

        $formInput['is_default'] = array_key_exists('is_default', $formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    public function unsetDefaultEtatArticle($curr_etatarticle) {
      $this->unsetDefault($curr_etatarticle, EtatArticle::default([$curr_etatarticle->id])->first());
    }
}
