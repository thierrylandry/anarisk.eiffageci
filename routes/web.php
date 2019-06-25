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
});





