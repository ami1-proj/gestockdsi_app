<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;
use App\EtatCommande;


class Commande extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $employes = Employe::search($q)->get()->pluck('id')->toArray();
      $etatcommandes = EtatCommande::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('objet_commande', 'LIKE', "%{$q}%")
        ->where('description_commande', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('employe_id', $employes)
        ->orWhereIn('etat_commande_id', $etatcommandes)
        ;
    }

    /**
     * Renvoie le Statut de la Commande.
     */
    public function statut() {
      return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le Etat (EtatCommande) de la Commande.
     */
    public function etatCommande() {
      return $this->belongsTo('App\EtatCommande');
    }

    /**
     * Renvoie l'Employe de la Commande.
     */
    public function employe() {
      return $this->belongsTo('App\Employe');
    }

    /**
     * Renvoie le(s) Article(s) de la Commande.
     */
     public function articles() {
        return $this->belongsToMany('App\Article')
          ->withPivot('statut_id')->withTimestamps();
     }
}
