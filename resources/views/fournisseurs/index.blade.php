@extends('layouts.app_index',[
  'title' => 'fournisseurs',
  'listvalues' => $fournisseurs,
  'index_route' => 'FournisseurController@index',
  'create_route' => 'FournisseurController@create',
  'show_route' => 'FournisseurController@show',
  'edit_route' => 'FournisseurController@edit',
  'destroy_route' => 'FournisseurController@destroy',
  'table_values' => 'fournisseurs.table_values',
  'table_headers' => 'fournisseurs.table_headers',
  'breadcrumb_title' => 'fournisseurs',
  'breadcrumb_param' => '',
  'affectation_tag' => '',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'fournisseur-list',
  'cancreate' => 'fournisseur-create',
  'canedit' => 'fournisseur-edit',
  'candelete' => 'fournisseur-delete'
])
