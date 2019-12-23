@extends('layouts.app_create',[
  'title' => 'type article',
  'model' => $typearticle,
  'index_route' => 'TypeArticleController@index',
  'store_route' => 'TypeArticleController@store',
  'show_route' => 'TypeArticleController@show',
  'edit_route' => 'TypeArticleController@edit',
  'destroy_route' => 'TypeArticleController@destroy',
  'model_fields' => 'typearticles.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'typearticles.create',
  'breadcrumb_param' => '',
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
