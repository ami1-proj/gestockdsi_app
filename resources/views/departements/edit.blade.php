@extends('layouts.app_edit',[
  'title' => 'departements',
  'model' => $departement,
  'modelname' => $departement->nom,
  'modeltype' => 'du departement',
  'index_route' => 'DepartementController@index',
  'update_route' => 'DepartementController@update',
  'show_route' => 'DepartementController@show',
  'edit_route' => 'DepartementController@edit',
  'destroy_route' => 'DepartementController@destroy',
  'model_fields' => 'departements.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'departements.edit',
  'breadcrumb_param' => $departement->id,
  'canlist' => 'departement-list',
  'cancreate' => 'departement-create',
  'canedit' => 'departement-edit',
  'candelete' => 'departement-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
