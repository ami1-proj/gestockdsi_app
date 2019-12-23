@extends('layouts.app_edit',[
  'title' => 'utilisateurs',
  'model' => $user,
  'modelname' => $user->name,
  'modeltype' => 'de l utilisateur',
  'index_route' => 'UserController@index',
  'update_route' => 'UserController@update',
  'show_route' => 'UserController@show',
  'edit_route' => 'UserController@edit',
  'destroy_route' => 'UserController@destroy',
  'model_fields' => 'users.fields',
  'morecontrols' => ['users.roles_control'],
  'breadcrumb_title' => 'users.edit',
  'breadcrumb_param' => $user->id,
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
