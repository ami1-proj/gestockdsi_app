@extends('layouts.app_index',[
  'title' => 'articles',
  'listvalues' => $articles,
  'index_route' => 'ArticleController@index',
  'create_route' => 'ArticleController@create',
  'show_route' => 'ArticleController@show',
  'edit_route' => 'ArticleController@edit',
  'destroy_route' => 'ArticleController@destroy',
  'table_values' => 'articles.table_values',
  'table_headers' => 'articles.table_headers',
  'breadcrumb_title' => 'articles',
  'breadcrumb_param' => '',
  'affectation_tag' => '',
  'cancreateaffectation' => 'affectation-create',
  'canlist' => 'article-list',
  'cancreate' => 'article-create',
  'canedit' => 'article-edit',
  'candelete' => 'article-delete'
])
