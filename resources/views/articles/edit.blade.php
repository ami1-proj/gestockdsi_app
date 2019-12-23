@extends('layouts.app_edit',[
  'title' => 'articles',
  'model' => $article,
  'modelname' => $article->reference_complete,
  'modeltype' => 'd article',
  'index_route' => 'ArticleController@index',
  'update_route' => 'ArticleController@update',
  'show_route' => 'ArticleController@show',
  'edit_route' => 'ArticleController@edit',
  'destroy_route' => 'ArticleController@destroy',
  'model_fields' => 'articles.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'articles.edit',
  'breadcrumb_param' => $article->id,
  'canlist' => 'article-list',
  'cancreate' => 'article-create',
  'canedit' => 'article-edit',
  'candelete' => 'article-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
