@extends('layouts.app_create',[
  'title' => 'marque',
  'model' => $marquearticle,
  'index_route' => 'MarqueArticleController@index',
  'store_route' => 'MarqueArticleController@store',
  'show_route' => 'MarqueArticleController@show',
  'edit_route' => 'MarqueArticleController@edit',
  'destroy_route' => 'MarqueArticleController@destroy',
  'model_fields' => 'marquearticles.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'marquearticles.create',
  'breadcrumb_param' => '',
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
