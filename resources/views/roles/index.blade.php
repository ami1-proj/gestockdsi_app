@extends('layouts.app_index',[
  'title' => 'roles',
  'listvalues' => $roles,
  'index_route' => 'RoleController@index',
  'create_route' => 'RoleController@create',
  'show_route' => 'RoleController@show',
  'edit_route' => 'RoleController@edit',
  'destroy_route' => 'RoleController@destroy',
  'table_values' => 'roles.table_values',
  'table_headers' => 'roles.table_headers',
  'breadcrumb_title' => 'roles',
  'breadcrumb_param' => '',
  'affectation_tag' => '',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'role-list',
  'cancreate' => 'role-create',
  'canedit' => 'role-edit',
  'candelete' => 'role-delete'
])
