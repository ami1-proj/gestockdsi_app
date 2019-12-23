@extends('layouts.app_create',[
  'title' => 'departements',
  'model' => $departement,
  'index_route' => 'DepartementController@index',
  'store_route' => 'DepartementController@store',
  'show_route' => 'DepartementController@show',
  'edit_route' => 'DepartementController@edit',
  'destroy_route' => 'DepartementController@destroy',
  'model_fields' => 'departements.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'departements.create',
  'breadcrumb_param' => '',
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
