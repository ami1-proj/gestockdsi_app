<?php

namespace App;

// use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;


class AffectationArticle extends Model
{
    public $incrementing = true;
    protected $table = 'affectation_article';

    protected $guarded = [];

    public function article() {
        return $this->belongsTo('App\Article');
    }

    public function affectation()
    {
        return $this->belongsTo('App\Affectation');
    }

    public function typemouvement()
    {
        return $this->belongsTo('App\TypeMouvement','type_mouvement_id');
    }

    public function terminer()
    {
        $this->date_fin = now();
        $this->save();
    }
}
