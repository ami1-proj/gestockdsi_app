<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;
use App\StockLieu;


class Stock extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $stocklieus = StockLieu::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->where('designation_complete', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('lieu_id', $stocklieus);
    }

    /**
    * Get designation complete.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getDesignationCompleteAttribute()
    {
        return "{$this->nom}";
    }

    /**
     * Renvoie le Statut du Stock.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le lieu (StockLieu) du Stock.
     */
    public function stockLieu() {
        return $this->belongsTo('App\StockLieu','lieu_id');
    }

    public function affectations() {
        return $this->hasMany('App\Affectation')
          ->whereNull('date_fin');
    }

}
