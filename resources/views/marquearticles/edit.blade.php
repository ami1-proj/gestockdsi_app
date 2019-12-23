@extends('layouts.app_edit',[
  'title' => 'marque',
  'model' => $marquearticle,
  'modelname' => $marquearticle->libelle,
  'modeltype' => 'du type article',
  'index_route' => 'MarqueArticleController@index',
  'update_route' => 'MarqueArticleController@update',
  'show_route' => 'MarqueArticleController@show',
  'edit_route' => 'MarqueArticleController@edit',
  'destroy_route' => 'MarqueArticleController@destroy',
  'model_fields' => 'marquearticles.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'marquearticles.edit',
  'breadcrumb_param' => $marquearticle->id,
  'canlist' => 'marque-list',
  'cancreate' => 'marque-create',
  'canedit' => 'marque-edit',
  'candelete' => 'marque-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
