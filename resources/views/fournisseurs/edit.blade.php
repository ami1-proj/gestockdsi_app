@extends('layouts.app_edit',[
  'title' => 'fournisseurs',
  'model' => $fournisseur,
  'modelname' => $fournisseur->raison_sociale,
  'modeltype' => 'du fournisseur',
  'index_route' => 'FournisseurController@index',
  'update_route' => 'FournisseurController@update',
  'show_route' => 'FournisseurController@show',
  'edit_route' => 'FournisseurController@edit',
  'destroy_route' => 'FournisseurController@destroy',
  'model_fields' => 'fournisseurs.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'fournisseurs.edit',
  'breadcrumb_param' => $fournisseur->id,
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
