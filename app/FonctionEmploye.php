<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class FonctionEmploye extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('intitule', 'LIKE', "%{$q}%")
        ->orWhere('description', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ;
    }

    /**
     * Renvoie le Statut de la Fonction.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Retourne tous les Employe qui ont cette fonction.
     */
    public function employes()
    {
        return $this->hasMany('App\Employe');
    }
}
