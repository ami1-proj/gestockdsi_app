@extends('layouts.app_index',[
  'title' => 'employes',
  'listvalues' => $employes,
  'index_route' => 'EmployeController@index',
  'create_route' => 'EmployeController@create',
  'show_route' => 'EmployeController@show',
  'edit_route' => 'EmployeController@edit',
  'destroy_route' => 'EmployeController@destroy',
  'table_values' => 'employes.table_values',
  'table_headers' => 'employes.table_headers',
  'breadcrumb_title' => 'employes',
  'breadcrumb_param' => '',
  'affectation_tag' => 'Employe',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'employe-list',
  'cancreate' => 'employe-create',
  'canedit' => 'employe-edit',
  'candelete' => 'employe-delete'
])
