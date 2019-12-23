@extends('layouts.app_edit',[
  'title' => 'types article',
  'model' => $typearticle,
  'modelname' => $typearticle->libelle,
  'modeltype' => 'du type article',
  'index_route' => 'TypeArticleController@index',
  'update_route' => 'TypeArticleController@update',
  'show_route' => 'TypeArticleController@show',
  'edit_route' => 'TypeArticleController@edit',
  'destroy_route' => 'TypeArticleController@destroy',
  'model_fields' => 'typearticles.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'typearticles.edit',
  'breadcrumb_param' => $typearticle->id,
  'canlist' => 'type_article-list',
  'cancreate' => 'type_article-create',
  'canedit' => 'type_article-edit',
  'candelete' => 'type_article-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
