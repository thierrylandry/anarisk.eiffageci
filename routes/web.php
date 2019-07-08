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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/',[
    'as'=>'/',
    'uses'=>'HomeController@index',
])->middleware('auth');

Route::group(['prefix' => 'analyses'], function () {
    Route::get('/creer',[
        'as'=>'analyses',
        'uses'=>'AnalysesController@ajouter_analyse',
    ])->middleware('auth');

    Route::get('/liste',[
        'as'=>'liste',
        'uses'=>'AnalysesController@liste',
    ])->middleware('auth');
    Route::post('/enregistrer',[
        'as'=>'save_analyse',
        'uses'=>'AnalysesController@save_analyse',
    ])->middleware('auth');
    Route::get('/ficheAnalyse/{id}',[
        'as'=>'ficheAnalyse',
        'uses'=>'AnalysesController@ficheAnalyse',
    ])->middleware('auth');
    Route::get('/mesures/{id}',[
        'as'=>'mesures',
        'uses'=>'MesuresController@mesures',
    ])->middleware('auth');

    Route::post('/SaveMesure',[
        'as'=>'SaveMesure',
        'uses'=>'MesuresController@SaveMesure',
    ])->middleware('auth');
    Route::post('/ModifierMesure',[
        'as'=>'ModifierMesure',
        'uses'=>'MesuresController@ModifierMesure',
    ])->middleware('auth');


    Route::get('/pageModifMesure/{id}',[
        'as'=>'pageModifMesure',
        'uses'=>'MesuresController@pageModifMesure',
    ])->middleware('auth');

    Route::get('/pageModifierAnalyse/{id}',[
        'as'=>'pageModifierAnalyse',
        'uses'=>'AnalysesController@pageModifierAnalyse',
    ])->middleware('auth');
    Route::post('/modifier_analyse',[
        'as'=>'modifier_analyse',
        'uses'=>'AnalysesController@modifier_analyse',
    ])->middleware('auth');

});



Route::get('/chantierListeFonction/{id}',[
        'as'=>'chantierListeFonction',
        'uses'=>'AnalysesController@chantierListeFonction',
    ])->middleware('auth');

Route::get('/proprietaireListeFonction/{id}',[
        'as'=>'proprietaireListeFonction',
        'uses'=>'AnalysesController@proprietaireListeFonction',
    ])->middleware('auth');

Route::get('/analyseFonctionId/{id}',[
        'as'=>'analyseFonctionId',
        'uses'=>'AnalysesController@analyseFonctionId',
    ])->middleware('auth');

Route::get('/acteurFonctionResponsable/{id}',[
    'as'=>'acteurFonctionResponsable',
    'uses'=>'MesuresController@acteurFonctionResponsable',
])->middleware('auth');


