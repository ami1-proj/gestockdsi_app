<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Statut;


class TypeAffectation extends Model
{
    protected $guarded = [];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('libelle', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Filtre d élément par défaut
     * @param  var $query   La requete
     * @param  array  $exclude liste d ids a exclure le cas echeant
     * @return var          La nouvelle requete
     */
    public function scopeDefault($query, $exclude = []) {
      return $query
        ->where('is_default', true)->whereNotIn('id', $exclude);
    }

    /**
     * Filtre de recherche d élément(s) contenant un tag donné
     * @param  var $query La requete
     * @param  string $tag   Le tag recherché
     * @return var        La nouvelle requete
     */
    public function scopeTagged($query, $tag) {
      return $query
        ->where('tags', 'LIKE', "%{$tag}%");
    }

    public function statut() {
        return $this->belongsTo('App\Statut');
    }
    /**
     * Retourne tous les TypeArticle qui ont ce Statut.
     */
    public function affectations()
    {
        return $this->hasMany('App\Affectation');
    }
}
