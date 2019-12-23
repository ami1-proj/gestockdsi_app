<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      return $query
        ->where('libelle', 'LIKE', "%{$q}%");
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

    public function typeDepartement()
    {
        return $this->hasMany('App\TypeDepartement');
    }

    public function typeAffectations()
    {
        return $this->hasMany('App\TypeAffectation');
    }

    public function typemouvements()
    {
        return $this->hasMany('App\TypeMouvement');
    }

    /**
     * Retourne tous les TypeArticle qui ont ce Statut.
     */
    public function typeArticles()
    {
        return $this->hasMany('App\TypeArticle');
    }

    /**
     * Retourne tous les StockLieu qui ont ce Statut.
     */
    public function stockLieus()
    {
        return $this->hasMany('App\StockLieu');
    }

    /**
     * Retourne tous les StockEmplacement qui ont ce Statut.
     */
    public function stockEmplacements()
    {
        return $this->hasMany('App\StockEmplacement');
    }

    /**
     * Retourne tous les Stock qui ont ce Statut.
     */
    public function stocks()
    {
        return $this->hasMany('App\Stock');
    }

    /**
     * Retourne toutes les SituationArticle qui ont ce Statut.
     */
    public function situationArticles()
    {
        return $this->hasMany('App\SituationArticle');
    }

    /**
     * Retourne tous les Service qui ont ce Statut.
     */
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    /**
     * Retourne tous les Phonenum qui ont ce Statut.
     */
    public function phonenums()
    {
        return $this->hasMany('App\Phonenum');
    }

    /**
     * Retourne tous les MarqueArticle qui ont ce Statut.
     */
    public function marqueArticles()
    {
        return $this->hasMany('App\MarqueArticle');
    }

    /**
     * Retourne toutes les relations FournisseurPhonenum qui ont ce Statut.
     */
    public function fournisseurPhonenums()
    {
        return $this->hasMany('App\FournisseurPhonenum');
    }

    /**
     * Retourne toutes les relations FournisseurAdresseemail qui ont ce Statut.
     */
    public function fournisseurAdresseemails()
    {
        return $this->hasMany('App\FournisseurAdresseemail');
    }

    /**
     * Retourne tous les Fournisseur qui ont ce Statut.
     */
    public function fournisseurs()
    {
        return $this->hasMany('App\Fournisseur');
    }

    /**
     * Retourne tous les EtatCommande qui ont ce Statut.
     */
    public function etatCommandes()
    {
        return $this->hasMany('App\EtatCommande');
    }

    /**
     * Retourne tous les EtatArticle qui ont ce Statut.
     */
    public function etatArticles()
    {
        return $this->hasMany('App\EtatArticle');
    }

    /**
     * Retourne toutes les relations EmployePhonenum qui ont ce Statut.
     */
    public function employePhonenums()
    {
        return $this->hasMany('App\EmployePhonenum');
    }

    /**
     * Retourne toutes les relations EmployeAdresseemail qui ont ce Statut.
     */
    public function employeAdresseemails()
    {
        return $this->hasMany('App\EmployeAdresseemail');
    }

    /**
     * Retourne tous les Employe qui ont ce Statut.
     */
    public function employes()
    {
        return $this->hasMany('App\Employe');
    }

    /**
     * Retourne toutes les Division qui ont ce Statut.
     */
    public function divisions()
    {
        return $this->hasMany('App\Division');
    }

    /**
     * Retourne toutes les Direction qui ont ce Statut.
     */
    public function directions()
    {
        return $this->hasMany('App\Direction');
    }

    /**
     * Retourne toutes les relations ArticleStock qui ont ce Statut.
     */
    public function articleStocks()
    {
        return $this->hasMany('App\ArticleStock');
    }

    /**
     * Retourne toutes les relations ArticleCommande qui ont ce Statut.
     */
    public function articleCommandes()
    {
        return $this->hasMany('App\ArticleCommande');
    }

    /**
     * Retourne toutes les relations ArticleAffectation qui ont ce Statut.
     */
    public function articleAffectations()
    {
        return $this->hasMany('App\ArticleAffectation');
    }

    /**
     * Retourne tous les Article qui ont ce Statut.
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    /**
     * Retourne toutes les Adresseemail qui ont ce Statut.
     */
    public function adresseemails()
    {
        return $this->hasMany('App\Adresseemail');
    }
}
