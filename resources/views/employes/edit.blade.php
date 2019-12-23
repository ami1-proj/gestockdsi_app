@extends('layouts.app_edit',[
  'title' => 'employes',
  'model' => $employe,
  'modelname' => $employe->nom_complet,
  'modeltype' => 'de lemploye',
  'index_route' => 'EmployeController@index',
  'update_route' => 'EmployeController@update',
  'show_route' => 'EmployeController@show',
  'edit_route' => 'EmployeController@edit',
  'destroy_route' => 'EmployeController@destroy',
  'model_fields' => 'employes.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'employes.edit',
  'breadcrumb_param' => $employe->id,
  'canlist' => 'employe-list',
  'cancreate' => 'employe-create',
  'canedit' => 'employe-edit',
  'candelete' => 'employe-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
