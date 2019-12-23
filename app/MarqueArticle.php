<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class MarqueArticle extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Renvoie le Statut de la MarqueArticle.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Retourne tous les Article de cette marque (MarqueArticle).
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
