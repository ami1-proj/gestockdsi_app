@extends('layouts.app_index',[
  'title' => 'departements',
  'listvalues' => $departements,
  'index_route' => 'DepartementController@index',
  'create_route' => 'DepartementController@create',
  'show_route' => 'DepartementController@show',
  'edit_route' => 'DepartementController@edit',
  'destroy_route' => 'DepartementController@destroy',
  'table_values' => 'departements.table_values',
  'table_headers' => 'departements.table_headers',
  'breadcrumb_title' => 'departements',
  'breadcrumb_param' => '',
  'affectation_tag' => 'Departement',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'departement-list',
  'cancreate' => 'departement-create',
  'canedit' => 'departement-edit',
  'candelete' => 'departement-delete'
])
