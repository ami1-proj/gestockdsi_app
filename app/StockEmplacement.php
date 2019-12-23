<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class StockEmplacement extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('emplacement', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Renvoie le Statut du StockEmplacement.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie tous les Stock liés au StockEmplacement dans les relations ArticleStocks.
     */
    public function stocks() {
        //return $this->articleStocks->load('stock');
        return $this->belongsToMany('App\StockEmplacement', 'article_stock', 'stock_emplacement_id', 'stock_id');
    }

    /**
     * Renvoie tous les Article liés au StockEmplacement dans les relations ArticleStocks.
     */
    public function articles() {
        //return $this->articleStocks->load('article');
        return $this->belongsToMany('App\StockEmplacement', 'article_stock', 'stock_emplacement_id', 'article_id');
    }
}
