<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Auth::routes();

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'HomeController@index')->name('home');
    });

    Route::get('/tests', function () {
        	return view('tests.index');
   	})->name('tests');

    Route::resource('roles','RoleController')->middleware('auth');
    Route::resource('users','UserController')->middleware('auth');

    Route::get('/selectmorepermissions', 'PermissionController@selectmorepermissions')->middleware('auth');
    Route::get('/selectmoreroles', 'RoleController@selectmoreroles')->middleware('auth');

    // Tags
    Route::get('/select2-remote-data-source', 'TagController@select2RemoteDataSource')->middleware('auth');
    Route::get('/select2-load-more', 'TagController@select2LoadMore')->middleware('auth');
    Route::get('/selectmoretags', 'TagController@selectmoretags')->middleware('auth');

    // Articles & Types
    Route::get('articlesettypes', 'ArticlesEtTypesController@index')->name('articlesettypes.index')->middleware('auth');
    // Type Articles
    Route::resource('typearticles', 'TypeArticleController')->middleware('auth');

    // Articles
    Route::resource('marquearticles', 'MarqueArticleController')->middleware('auth');
    Route::resource('articles', 'ArticleController')->middleware('auth');
    Route::get('articles/{type_affectation_tag}/{elem_id}/affectation', 'ArticleController@affectation')->name('articles.affectation')->middleware('auth');
    Route::put('articles/{type_affectation_tag}/{elem_id}/affectationupdate', 'ArticleController@affectationupdate')->name('articles.affectationupdate')->middleware('auth');

    // Phonenums
    Route::resource('phonenums', 'PhonenumController')->middleware('auth');
    Route::get('phonenums/{elem_type}/{elem_id}/', 'PhonenumController@editelem')->name('phonenums.editelem')->middleware('auth');
    Route::put('phonenums/{elem_type}/{elem_id}/{phonenum_id}/', 'PhonenumController@updateelem')->name('phonenums.updateelem')->middleware('auth');
    Route::post('phonenums/{elem_type}/{elem_id}/', 'PhonenumController@storeelem')->name('phonenums.storeelem')->middleware('auth');

    // Adresseemails
    Route::resource('adresseemails', 'AdresseemailController')->middleware('auth');
    Route::get('adresseemails/{elem_type}/{elem_id}/', 'AdresseemailController@editelem')->name('adresseemails.editelem')->middleware('auth');
    Route::put('adresseemails/{elem_type}/{elem_id}/{adresseemail_id}/', 'AdresseemailController@updateelem')->name('adresseemails.updateelem')->middleware('auth');
    Route::post('adresseemails/{elem_type}/{elem_id}/', 'AdresseemailController@storeelem')->name('adresseemails.storeelem')->middleware('auth');

    // Employes & Départements
    Route::resource('employes', 'EmployeController')->middleware('auth');
    Route::resource('typedepartements', 'TypeDepartementController')->middleware('auth');
    Route::resource('departements', 'DepartementController')->middleware('auth');

    Route::resource('fournisseurs', 'FournisseurController')->middleware('auth');
    Route::resource('commandes', 'CommandeController')->middleware('auth');

    // Affectations
    Route::resource('affectations', 'AffectationController')->middleware('auth');
    Route::get('affectations/{type_affectation_tag}/{elem_id}/', 'AffectationController@elemcreate')->name('affectations.elemcreate')->middleware('auth');
    Route::post('affectations/{type_affectation_tag}/{elem_id}/', 'AffectationController@elemstore')->name('affectations.elemstore')->middleware('auth');

    // Paramètres
    Route::get('parametres', 'ParametreController@index')->name('parametres.index')->middleware('auth');

    // Statut
    Route::resource('statuts', 'StatutController')->middleware('auth');
    // TypeMouvement
    Route::resource('typemouvements', 'TypeMouvementController')->middleware('auth');
    // EtatCommande
    Route::resource('etatcommandes', 'EtatCommandeController')->middleware('auth');
    // TypeAffectation
    Route::resource('typeaffectations', 'TypeAffectationController')->middleware('auth');
    // EtatArticle
    Route::resource('etatarticles', 'EtatArticleController')->middleware('auth');

    // Stock
    Route::resource('stocks', 'StockController')->middleware('auth');

    //Route::get('/home', 'HomeController@index')->name('home');
