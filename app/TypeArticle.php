<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class TypeArticle extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('libelle', 'LIKE', "%{$q}%")
        ->orWhere('description', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Renvoie le Statut du TypeArticle.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie tous les Articles du TypeArticle.
     */
    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function articles_enstock() {
        return $this->hasMany('App\Article')
          ->where('affectation_id', 1);
    }

    public function articles_enaffectation() {
        return $this->hasMany('App\Article')
          ->where('affectation_id', '<>', 1);
    }

    public function articles_neuf() {
        return $this->hasMany('App\Article')
          ->where('etat_article_id', 1);
    }

    public function articles_enpanne() {
        return $this->hasMany('App\Article')
          ->where('etat_article_id', 2);
    }
}
