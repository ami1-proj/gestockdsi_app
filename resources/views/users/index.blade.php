@extends('layouts.app_index',[
  'title' => 'utilisateurs',
  'listvalues' => $users,
  'index_route' => 'UserController@index',
  'create_route' => 'UserController@create',
  'show_route' => 'UserController@show',
  'edit_route' => 'UserController@edit',
  'destroy_route' => 'UserController@destroy',
  'table_values' => 'users.table_values',
  'table_headers' => 'users.table_headers',
  'breadcrumb_title' => 'users',
  'breadcrumb_param' => '',
  'affectation_tag' => '',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'user-list',
  'cancreate' => 'user-create',
  'canedit' => 'user-edit',
  'candelete' => 'user-delete'
])
