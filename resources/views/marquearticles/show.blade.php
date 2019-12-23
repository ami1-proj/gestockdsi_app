@extends('layouts.app_show',[
  'title' => 'types article',
  'model' => $marquearticle,
  'modelname' => $marquearticle->libelle,
  'modeltype' => 'du type article',
  'index_route' => 'MarqueArticleController@index',
  'store_route' => 'MarqueArticleController@store',
  'show_route' => 'MarqueArticleController@show',
  'edit_route' => 'MarqueArticleController@edit',
  'destroy_route' => 'MarqueArticleController@destroy',
  'breadcrumb_title' => 'marquearticles.show',
  'breadcrumb_param' => $marquearticle->id,
  'canlist' => 'marque-list',
  'cancreate' => 'marque-create',
  'canedit' => 'marque-edit',
  'candelete' => 'marque-delete'
])

@section('show_details')
    <dl class="row">  
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $marquearticle->id }}</dd>

        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $marquearticle->nom }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $marquearticle->statut->libelle }}</dd>
    </dl>
@endsection