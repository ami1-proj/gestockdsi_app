@extends('layouts.app_show',[
  'title' => 'types article',
  'model' => $typearticle,
  'modelname' => $typearticle->libelle,
  'modeltype' => 'du type article',
  'index_route' => 'TypeArticleController@index',
  'store_route' => 'TypeArticleController@store',
  'show_route' => 'TypeArticleController@show',
  'edit_route' => 'TypeArticleController@edit',
  'destroy_route' => 'TypeArticleController@destroy',
  'breadcrumb_title' => 'typearticles.show',
  'breadcrumb_param' => $typearticle->id,
  'canlist' => 'type_article-list',
  'cancreate' => 'type_article-create',
  'canedit' => 'type_article-edit',
  'candelete' => 'type_article-delete'
])

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9">{{ $typearticle->id }}</dd>

    <dt class="col-sm-3">Libelle</dt>
    <dd class="col-sm-9">{{ $typearticle->libelle }}</dd>

    <dt class="col-sm-3">Description</dt>
    <dd class="col-sm-9">{{ $typearticle->description }}</dd>

    <dt class="col-sm-3">Image</dt>
    <dd class="col-sm-9"><img src="{{ url(config('app.typearticle_filefolder')).'/'. $typearticle->image }}" alt="" class="img-thumbnail" style="width: 150px;"></dd>

    <dt class="col-sm-3">Statut</dt>
    <dd class="col-sm-9">{{ $typearticle->statut->libelle }}</dd>

    <dt class="col-sm-3">Créé le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typearticle->created_at)) }}</dd>

    <dt class="col-sm-3">Modifié le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typearticle->updated_at)) }}</dd>
</dl>

@endsection
