@extends('layouts.app_create',[
  'title' => 'role',
  'model' => $role,
  'index_route' => 'RoleController@index',
  'store_route' => 'RoleController@store',
  'show_route' => 'RoleController@show',
  'edit_route' => 'RoleController@edit',
  'destroy_route' => 'RoleController@destroy',
  'model_fields' => 'roles.fields',
  'morecontrols' => ['roles.permissions_control'],
  'breadcrumb_title' => 'roles.create',
  'breadcrumb_param' => '',
  'canlist' => 'role-list',
  'cancreate' => 'role-create',
  'canedit' => 'role-edit',
  'candelete' => 'role-delete'
])

@section('more_css')
  @include('roles.permissions_css')
@endsection

@section('more_js')
  @include('roles.permissions_js')
@endsection
