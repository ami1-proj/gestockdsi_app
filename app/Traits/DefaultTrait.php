<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait DefaultTrait {

  public function unsetDefault($curr_model, $olddefault) {
    if ($curr_model->is_default == true) {
      if (!(is_null($olddefault))) {
        $olddefault->is_default = false;
        $olddefault->save();
      }
    }
  }
}
