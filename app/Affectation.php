<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class Affectation extends Model
{

		protected $guarded = [];
    use SoftDeletes;

		public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $this->searchByElem($query
        ->where('objet', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
				, $q);
    }

		public function searchByElem($query, $q) {
      if ($q == null) return $query;

			if ($this->typeAffectation->tags == 'Stock') {
        // Stock
        $elems = Stock::search($q)->get()->pluck('id')->toArray();
				return $query->orWhereIn('stock_id', $elems);
      } elseif ($this->typeAffectation->tags == 'Employe'){
        // Employe
				$elems = Employe::search($q)->get()->pluck('id')->toArray();
				return $query->orWhereIn('employe_id', $elems);
      } elseif ($this->typeAffectation->tags == 'Departement'){
        // Service
				$elems = Departement::search($q)->get()->pluck('id')->toArray();
				return $query->orWhereIn('departement_id', $elems);
      } else {
        return $query;
      }
    }

    /**
     * Renvoie le Statut de l affectation.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le type d affectation.
     */
    public function typeAffectation() {
        return $this->belongsTo('App\TypeAffectation');
    }

		public function affectationarticles() {
        return $this->hasMany('App\AffectationArticle')
					->whereNull('date_fin');
    }

    public function elem() {
        if ($this->typeAffectation->tags == 'Stock') {
          // Stock
          return Stock::find($this->stock_id);
        } elseif ($this->typeAffectation->tags == 'Employe'){
          // Employe
          return Employe::find($this->employe_id);
        } elseif ($this->typeAffectation->tags == 'Departement'){
          // Service
          return Departement::find($this->departement_id);
        } else {
          return null;
        }
    }

		public function terminer()
    {
        $this->date_fin = now();
        $this->save();
    }
}
