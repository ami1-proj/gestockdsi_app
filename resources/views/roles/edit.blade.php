@extends('layouts.app_edit',[
  'title' => 'roles',
  'model' => $role,
  'modelname' => $role->name,
  'modeltype' => 'du role',
  'index_route' => 'RoleController@index',
  'update_route' => 'RoleController@update',
  'show_route' => 'RoleController@show',
  'edit_route' => 'RoleController@edit',
  'destroy_route' => 'RoleController@destroy',
  'model_fields' => 'roles.fields',
  'morecontrols' => ['roles.permissions_control'],
  'breadcrumb_title' => 'roles.edit',
  'breadcrumb_param' => $role->id,
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
