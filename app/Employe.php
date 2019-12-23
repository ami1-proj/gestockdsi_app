<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Employe extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $fonctionemployes = FonctionEmploye::search($q)->get()->pluck('id')->toArray();

      $departements = Departement::search($q, 'employe')->get()->pluck('id')->toArray();

      $phonenums = Phonenum::search($q)->get()->pluck('id')->toArray();
      $employes_phonenums = DB::table('employe_phonenum')->whereIn('phonenum_id', $phonenums)->get()->pluck('employe_id')->toArray();

      $adresseemails = Adresseemail::search($q)->get()->pluck('id')->toArray();
      $employes_adresseemails = DB::table('adresseemail_employe')->whereIn('adresseemail_id', $adresseemails)->get()->pluck('employe_id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->orWhere('prenom', 'LIKE', "%{$q}%")
        ->orWhere('matricule', 'LIKE', "%{$q}%")
        ->orWhere('adresse', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('fonction_employe_id', $fonctionemployes)
        ->orWhereIn('departement_id', $departements)
        ->orWhereIn('id', $employes_phonenums)
        ->orWhereIn('id', $employes_adresseemails)
        ;
    }

    /**
    * Get the employe's full concatenated name.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getNomCompletAttribute()
    {
        return "{$this->nom} {$this->prenom}";
    }

    /**
    * Get designation complete.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getDesignationCompleteAttribute()
    {
        return "{$this->nom_complet}";
    }

    /**
     * Renvoie le Statut de Employe.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie la Fonction de l employe.
     */
    public function fonction() {
        return $this->belongsTo('App\FonctionEmploye', 'fonction_employe_id');
    }

    /**
     * Renvoie l Assignation de l employe.
     */
    public function departement() {
        return $this->belongsTo('App\Departement');
    }


    /**
     * Retourne toutes les Departements pour lesquelles cet employe est responsable.
     */
    public function departementsResponsable() {
        return $this->hasMany('App\Departement', 'employe_responsable_id');
    }

    /**
     * Renvoie les numéro de téléphone (Phonenum) de cet Employe.
     */
     public function phonenums() {
        return $this->belongsToMany('App\Phonenum')
          ->withPivot('rang', 'statut_id')->withTimestamps()
          ->orderBy('rang','asc');
     }

     /**
      * Renvoie les e-mails (Adresseemail) de cet Employe.
      */
      public function adresseemails() {
         return $this->belongsToMany('App\Adresseemail')
           ->withPivot('rang', 'statut_id')->withTimestamps()
           ->orderBy('rang','asc');
      }

      /**
       * Retourne toutes les Commande de l'Employe.
       */
      public function commandes() {
          return $this->hasMany('App\Commande');
      }

      public function affectations() {
        return $this->hasMany('App\Affectation')
          ->whereNull('date_fin');
      }
}
