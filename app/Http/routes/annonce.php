<?php

if (starts_with('emploi', Request::segment(1))) {
    Route::get('emploi', 'AnnonceController@index');
    Route::get('emploi/{section}', 'AnnonceController@annonces');
    Route::get('emploi/{domaine}/{slug}', 'AnnonceController@annonce');
}

Route::post('postuler','AnnonceController@postuler');

Route::get('emplois/recherche', "AnnonceController@recherche");