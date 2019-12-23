<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Affectation;

class Article extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    //protected $dateFormat = 'd/m/Y';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = [
    //     'date_livraison',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $typearticles = TypeArticle::search($q)->get()->pluck('id')->toArray();
      $marques = MarqueArticle::search($q)->get()->pluck('id')->toArray();
      $fournisseurs = Fournisseur::search($q)->get()->pluck('id')->toArray();
      $etatarticles = EtatArticle::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('reference', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('type_article_id', $typearticles)
        ->orWhereIn('marque_article_id', $marques)
        ->orWhereIn('fournisseur_id', $fournisseurs)
        ->orWhereIn('etat_article_id', $etatarticles);
    }

    /**
     * Filtre les articles en stock et en etat d etre affecte
     * @param  var $query la requete entrante
     * @return var        La requete sortante
     */
    public function scopeDisponibles($query) {
      return $query
        ->where('affectation_id', 1)
        ->where('etat_article_id', '!=', 3);
    }

    public function scopeEnStock($query) {
      return $query
        ->where('affectation_id', 1)
        ;
    }

    /**
    * Get the user's full concatenated name.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getReferenceCompleteAttribute()
    {
        return "{$this->typeArticle->libelle} - {$this->marqueArticle->nom} - {$this->id} - {$this->reference}";
    }

    /**
     * Renvoie le Statut de l'Article.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le marque (MarqueArticle) de l'Article.
     */
    public function marqueArticle() {
        return $this->belongsTo('App\MarqueArticle');
    }

    /**
     * Renvoie le Fournisseur de l'Article.
     */
    public function fournisseur() {
        return $this->belongsTo('App\Fournisseur');
    }

    /**
     * Renvoie le type (TypeArticle) de l'Article.
     */
    public function typeArticle() {
        return $this->belongsTo('App\TypeArticle');
    }

    /**
     * Renvoie la situation (SituationArticle) de l'Article.
     */
    public function situationArticle() {
        return $this->belongsTo('App\SituationArticle');
    }

    public function situation()
    {
        if ( is_null($this->affectation_id)) { return null; }

        return Affectation::find($this->affectation_id);
    }

    /**
     * Renvoie l'etat (EtatArticle) de l'Article.
     */
    public function etatArticle() {
        return $this->belongsTo('App\EtatArticle');
    }

    public function affectations() {
        // return $this->belongsToMany('App\Affectation')
        //     ->withPivot('type_mouvement_id','affectation_from_id','stock_emplacement_id','details','date_debut','date_fin','statut_id')
        //     ->withTimestamps()
        //     ->orderBy('created_at', 'desc');
        return $this->affectationarticles()->get('affectation');
    }

    public function affectationarticles() {
        return $this->hasMany('App\AffectationArticle');
    }

    public function affectation() {
        //return $this->affectations()->first();
        $last_affectationarticle = $this->affectationarticles()->whereNull('date_fin')->first();
        //dd($this->affectationarticles(), $last_affectationarticle);
        return $last_affectationarticle;
    }

    public function affecter($affectation_id, $mouvement_id, $details_mouvement = null) {
        $default_emplacement_id = 1;
        $default_statut_id = 1;

        // 1. ancienne affectation
        if (is_null($this->affectation())) {
            $old_affectation_id = null;
        } else {

            $old_affectation = $this->affectation()->affectation;
            $old_affectation_id = $old_affectation->id;
        }
        $this->terminerAffectation();

        $new_affectationarticle = AffectationArticle::create([
            'article_id' => $this->id,
            'affectation_id' => $affectation_id,
            'type_mouvement_id' => $mouvement_id,
            'affectation_from_id' => $old_affectation_id,
            'stock_emplacement_id' => $default_emplacement_id,
            'details' => $details_mouvement,
            'statut_id' => $default_statut_id,
            'date_debut' => now(),
        ]);

        // 3. Mettre a jour la nouvelle affectation de cet article
        $this->affectation_id = $affectation_id;
        $this->save();
    }

    public function desaffecter($mouvement_id, $details_mouvement = null) {
        $default_affectation_id = 1;

        return $this->affecter($default_affectation_id, $mouvement_id, $details_mouvement);
    }

    public function terminerAffectation()
    {
        if (!( is_null($this->affectation()) )) {
          // marque la fin de la derniere affectation
          $affectation_article = AffectationArticle::find($this->affectation()->id);
          if (! is_null($affectation_article) ) {
            $affectation_article->terminer();
          }
        }
    }

}
