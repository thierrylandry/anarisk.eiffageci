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

Route::get('erreur', [
    'as'=>'erreur',
    'uses'=>'ErreurController@erreur'

]);

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
    Route::post('/EnregistrerEvalPosteEv',[
        'as'=>'EnregistrerEvalPosteEv',
        'uses'=>'AnalysesController@EnregistrerEvalPosteEv',
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
Route::get('/etat',[
        'as'=>'etat',
        'uses'=>'AnalysesController@etat',
    ])->middleware('auth');
Route::get('/etatfermer',[
        'as'=>'etatfermer',
        'uses'=>'AnalysesController@etatfermer',
    ])->middleware('auth');
Route::get('/fichesanalyses',[
        'as'=>'fichesanalyses',
        'uses'=>'AnalysesController@fichesanalyses',
    ])->middleware('auth');
Route::get('/etatpdf',[
        'as'=>'etatpdf',
        'uses'=>'AnalysesController@etatpdf',
    ])->middleware('auth');
Route::post('/saveEtat',[
        'as'=>'saveEtat',
        'uses'=>'AnalysesController@saveEtat',
    ])->middleware('auth');
Route::post('/terminer_mesure',[
        'as'=>'terminer_mesure',
        'uses'=>'MesuresController@terminer_mesure',
    ])->middleware('auth');

Route::get('/proprietaireListeFonction/{id}',[
        'as'=>'proprietaireListeFonction',
        'uses'=>'AnalysesController@proprietaireListeFonction',
    ])->middleware('auth');

Route::get('/analyseFonctionId/{id}',[
        'as'=>'analyseFonctionId',
        'uses'=>'AnalysesController@analyseFonctionId',
    ])->middleware('auth');

Route::get('/fermer_analyse/{id}',[
        'as'=>'fermer_analyse',
        'uses'=>'AnalysesController@fermer_analyse',
    ])->middleware('auth');
Route::post('/terminer_analyse',[
    'as'=>'terminer_analyse',
    'uses'=>'AnalysesController@terminer_analyse',
])->middleware('auth');
Route::get('/download_doc/{namefile}',[
    'as'=>'download_doc',
    'uses'=>'AnalysesController@download_doc',
])->middleware('auth');
Route::get('/supprimer/{id}',[
        'as'=>'supprimer',
        'uses'=>'AnalysesController@supprimer',
    ])->middleware('auth');
Route::get('/supprimer_pj/{id}',[
        'as'=>'supprimer_pj',
        'uses'=>'AnalysesController@supprimer_pj',
    ])->middleware('auth');
Route::get('/supprimer_pj_unique/{id}/{nomfichier}',[
        'as'=>'supprimer_pj_unique',
        'uses'=>'AnalysesController@supprimer_pj_unique',
    ])->middleware('auth');
Route::get('/supprimer_pj_mesure/{id}',[
        'as'=>'supprimer_pj_mesure',
        'uses'=>'MesuresController@supprimer_pj_mesure',
    ])->middleware('auth');
Route::get('/supprimer_mesure/{id}',[
        'as'=>'supprimer_mesure',
        'uses'=>'MesuresController@supprimer_mesure',
    ])->middleware('auth');

Route::get('/acteurFonctionResponsable/{id}',[
    'as'=>'acteurFonctionResponsable',
    'uses'=>'MesuresController@acteurFonctionResponsable',
])->middleware('auth');

Route::get('/utilisateurs',[
    'as'=>'utilisateurs',
    'uses'=>'UsersController@utilisateurs',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');

Route::get('/voir_utilisateur/{id}',[
    'as'=>'voir_utilisateur',
    'uses'=>'UsersController@voir_utilisateur',
    'middleware' => 'roles',
    'roles'=>['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_utilisateur/{id}',[
    'as'=>'supprimer_utilisateur',
    'uses'=>'UsersController@supprimer_utilisateur',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');
Route::post('/save_utilisateur',[
    'as'=>'save_utilisateur',
    'uses'=>'UsersController@save_utilisateur',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');
Route::post('/modifier_utilisateur',[
    'as'=>'modifier_utilisateur',
    'uses'=>'UsersController@modifier_utilisateur',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');

Route::get('/chantiers',[
    'as'=>'chantiers',
    'uses'=>'ChantiersController@chantiers',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');
Route::get('/voir_chantier/{id}',[
    'as'=>'voir_chantier',
    'uses'=>'ChantiersController@voir_chantier',
    'middleware' => 'roles',
    'roles'=>['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_chantier/{id}',[
    'as'=>'supprimer_chantier',
    'uses'=>'ChantiersController@supprimer_chantier',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');
Route::post('/save_chantier',[
    'as'=>'save_chantier',
    'uses'=>'ChantiersController@save_chantier',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');

Route::post('/modifier_chantier',[
    'as'=>'modifier_chantier',
    'uses'=>'ChantiersController@modifier_chantier',
    'middleware' => 'roles',
    'roles'=>'Parametrage'
])->middleware('auth');
Route::get('/liste_chantier/{email}',[
    'as'=>'liste_chantier',
    'uses'=>'ChantiersController@liste_chantier',
]);


