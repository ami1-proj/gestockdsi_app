@extends('layouts.app_create',[
  'title' => 'fournisseurs',
  'model' => $fournisseur,
  'index_route' => 'FournisseurController@index',
  'store_route' => 'FournisseurController@store',
  'show_route' => 'FournisseurController@show',
  'edit_route' => 'FournisseurController@edit',
  'destroy_route' => 'FournisseurController@destroy',
  'model_fields' => 'fournisseurs.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'fournisseurs.create',
  'breadcrumb_param' => '',
  'canlist' => 'fournisseur-list',
  'cancreate' => 'fournisseur-create',
  'canedit' => 'fournisseur-edit',
  'candelete' => 'fournisseur-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
