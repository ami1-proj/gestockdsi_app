<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Fournisseur extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      $phonenums = Phonenum::search($q)->get()->pluck('id')->toArray();
      $fournisseurs_phonenums = DB::table('fournisseur_phonenum')->whereIn('phonenum_id', $phonenums)->get()->pluck('fournisseur_id')->toArray();

      $adresseemails = Adresseemail::search($q)->get()->pluck('id')->toArray();
      $fournisseurs_adresseemails = DB::table('adresseemail_fournisseur')->whereIn('adresseemail_id', $adresseemails)->get()->pluck('fournisseur_id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->orWhere('prenom', 'LIKE', "%{$q}%")
        ->orWhere('raison_sociale', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('id', $fournisseurs_phonenums)
        ->orWhereIn('id', $fournisseurs_adresseemails)
        ;
    }

    /**
    * Get the user's full concatenated name.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getRaisonSocialeAttribute()
    {
        return "{$this->nom} {$this->prenom}";
    }

    /**
     * Renvoie le Statut de Fournisseur.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Retourne tous les Article de ce Fournisseur.
     */
    public function articles() {
        return $this->hasMany('App\Article');
    }

    /**
     * Renvoie les numéro de téléphone (Phonenum) de ce Fournisseur.
     */
     public function phonenums() {
        return $this->belongsToMany('App\Phonenum')
          ->withPivot('rang', 'statut_id')->withTimestamps();
     }

     /**
      * Renvoie les e-mails (Adresseemail) de ce Fournisseur.
      */
      public function adresseemails() {
         return $this->belongsToMany('App\Adresseemail')
           ->withPivot('rang', 'statut_id')->withTimestamps();
      }
}
