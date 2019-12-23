@extends('layouts.app_index',[
  'title' => 'marquearticles',
  'listvalues' => $marquearticles,
  'index_route' => 'MarqueArticleController@index',
  'create_route' => 'MarqueArticleController@create',
  'show_route' => 'MarqueArticleController@show',
  'edit_route' => 'MarqueArticleController@edit',
  'destroy_route' => 'MarqueArticleController@destroy',
  'table_values' => 'marquearticles.table_values',
  'table_headers' => 'marquearticles.table_headers',
  'breadcrumb_title' => 'marquearticles',
  'breadcrumb_param' => '',
  'affectation_tag' => '',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'marque-list',
  'cancreate' => 'marque-create',
  'canedit' => 'marque-edit',
  'candelete' => 'marque-delete'
])
