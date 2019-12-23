<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;

class TypeMouvement extends Model
{
    protected $guarded = [];
    use SoftDeletes;

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

    /**
     * Filtre les TypeMouvement non tagés systeme
     * @param  var $query La requete
     * @return var        La nouvelle requete
     */
    public function scopeNonSystem($query) {
      return $query
        ->where('tags', 'NOT LIKE', "%Systeme%");
    }

    public function scopeCreation($query) {
      return $this->scopeTagged($query, 'Systeme,Creation');
    }

    public function scopeSuppression($query) {
      return $this->scopeTagged($query, 'Systeme,Suppression');
    }

    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    public function affectationarticles() {
        return $this->hasMany('App\AffectationArticle', 'type_mouvement_id');
    }
}
