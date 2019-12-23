@extends('layouts.app_index',[
  'title' => 'typearticles',
  'listvalues' => $typearticles,
  'index_route' => 'TypeArticleController@index',
  'create_route' => 'TypeArticleController@create',
  'show_route' => 'TypeArticleController@show',
  'edit_route' => 'TypeArticleController@edit',
  'destroy_route' => 'TypeArticleController@destroy',
  'table_values' => 'typearticles.table_values',
  'table_headers' => 'typearticles.table_headers',
  'breadcrumb_title' => 'typearticles',
  'breadcrumb_param' => '',
  'affectation_tag' => '',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'type_article-list',
  'cancreate' => 'type_article-create',
  'canedit' => 'type_article-edit',
  'candelete' => 'type_article-delete'
])
