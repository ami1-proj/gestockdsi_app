<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departement extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q, $caller) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      if ($caller == 'departement') {
        $employes = Employe::search($q, $caller)->get()->pluck('id')->toArray();

        return $query
          ->where('intitule', 'LIKE', "%{$q}%")
          ->orWhere('chemin_complet', 'LIKE', "%{$q}%")
          ->orWhereIn('statut_id', $statuts)
          ->orWhereIn('employe_responsable_id', $employes)
        ;
      } else {
        $query
          ->where('intitule', 'LIKE', "%{$q}%")
          ->orWhere('chemin_complet', 'LIKE', "%{$q}%")
          ->orWhereIn('statut_id', $statuts)
        ;
      }
    }

    /**
    * Get designation complete.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getDesignationCompleteAttribute()
    {
        return "{$this->intitule}";
    }

    /**
     * Renvoie le Statut du Departement.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie l'employe responsable du Departement.
     */
    public function typedepartement() {
        return $this->belongsTo('App\TypeDepartement', 'type_departement_id');
    }

    /**
     * Renvoie l'employe responsable du Departement.
     */
    public function parent() {
        return $this->belongsTo('App\Departement', 'departement_parent_id');
    }

    /**
     * Renvoie l'employe responsable du Departement.
     */
    public function employeResponsable() {
        return $this->belongsTo('App\Employe', 'employe_responsable_id');
    }

    public function affectations() {
        return $this->hasMany('App\Affectation')
          ->whereNull('date_fin');
    }
}
