@extends('layouts.app_create',[
  'title' => 'utilisateurs',
  'model' => $user,
  'index_route' => 'UserController@index',
  'store_route' => 'UserController@store',
  'show_route' => 'UserController@show',
  'edit_route' => 'UserController@edit',
  'destroy_route' => 'UserController@destroy',
  'model_fields' => 'users.fields',
  'morecontrols' => ['users.roles_control'],
  'breadcrumb_title' => 'users.create',
  'breadcrumb_param' => '',
  'canlist' => 'user-list',
  'cancreate' => 'user-create',
  'canedit' => 'user-edit',
  'candelete' => 'user-delete'
])

@section('more_css')
  @include('users.roles_css')
@endsection

@section('more_js')
  @include('users.roles_js')
@endsection
