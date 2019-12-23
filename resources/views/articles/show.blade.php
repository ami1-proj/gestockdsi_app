@extends('layouts.app_show',[
  'title' => 'articles',
  'model' => $article,
  'modelname' => $article->nom,
  'modeltype' => 'd article',
  'index_route' => 'ArticleController@index',
  'store_route' => 'ArticleController@store',
  'show_route' => 'ArticleController@show',
  'edit_route' => 'ArticleController@edit',
  'destroy_route' => 'ArticleController@destroy',
  'breadcrumb_title' => 'articles.show',
  'breadcrumb_param' => $article->id,
  'canlist' => 'article-list',
  'cancreate' => 'article-create',
  'canedit' => 'article-edit',
  'candelete' => 'article-delete'
])

@section('show_details')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $article->id }}</dd>

        <dt class="col-sm-3">Référence</dt>
        <dd class="col-sm-9">{{ $article->reference }}</dd>

        <dt class="col-sm-3">Taille</dt>
        <dd class="col-sm-9">{{ $article->taille }}</dd>

        <dt class="col-sm-3">Situation</dt>
        <dd class="col-sm-9">{{ $article->situation()->typeAffectation->libelle }}</dd>

        <dt class="col-sm-3">Date de livraison</dt>
        <dd class="col-sm-9">{{ $article->date_livraison }}</dd>

        <dt class="col-sm-3">Type</dt>
        <dd class="col-sm-9">{{ $article->typeArticle->libelle }}</dd>

        <dt class="col-sm-3">Fournisseurs</dt>
        <dd class="col-sm-9">{{ $article->fournisseur->nom }}</dd>

        <dt class="col-sm-3">Marque</dt>
        <dd class="col-sm-9">{{ $article->marqueArticle->nom}}</dd>

        <dt class="col-sm-3">Etat</dt>
        <dd class="col-sm-9">{{ $article->etatArticle->libelle }}</dd>


        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $article->statut->libelle }}</dd>
    </dl>
@endsection
