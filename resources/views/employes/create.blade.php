@extends('layouts.app_create',[
  'title' => 'employes',
  'model' => $employe,
  'index_route' => 'EmployeController@index',
  'store_route' => 'EmployeController@store',
  'show_route' => 'EmployeController@show',
  'edit_route' => 'EmployeController@edit',
  'destroy_route' => 'EmployeController@destroy',
  'model_fields' => 'employes.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'employes.create',
  'breadcrumb_param' => '',
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
