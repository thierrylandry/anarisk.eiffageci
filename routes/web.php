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

Route::get('/analyses',[
    'as'=>'analyses',
    'uses'=>'AnalysesController@ajouter_analyse',
])->middleware('auth');
