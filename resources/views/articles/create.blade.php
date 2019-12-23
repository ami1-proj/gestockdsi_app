@extends('layouts.app_create',[
  'title' => 'articles',
  'model' => $article,
  'index_route' => 'ArticleController@index',
  'store_route' => 'ArticleController@store',
  'show_route' => 'ArticleController@show',
  'edit_route' => 'ArticleController@edit',
  'destroy_route' => 'ArticleController@destroy',
  'model_fields' => 'articles.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'articles.create',
  'breadcrumb_param' => '',
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
