<?php

Route::group(['namespace' => 'Front', 'middleware' => 'ip'], function () {

    //Actualites
    if (starts_with('actualites', Request::segment(1))) {
        Route::get('actualites', 'ArticleController@actualites');
        Route::get('actualites/{section?}', 'ArticleController@actualites');
        Route::get('actualites/{section}/{slug}', 'ArticleController@actualite');
    }

    //ANNUAIRE LINK
    if (starts_with('entreprise', Request::segment(1))) {
        Route::get('entreprise', 'AnnuaireController@index');
        Route::get('entreprise/{section}', 'AnnuaireController@entreprises');
        Route::get('entreprise/{domaine}/{slug}', 'AnnuaireController@entreprise');
        Route::get('entreprise/{country}/{domaine}/{slug}', 'AnnuaireController@entreprise');
    }

    if (starts_with('annuaire', Request::segment(1))) {
        Route::get('annuaire', 'AnnuaireController@index');
        Route::get('annuaire/{section}', 'AnnuaireController@entreprises');
        Route::get('annuaire/{country}/{domaine}/{slug}', 'AnnuaireController@entreprise');
    }

    Route::get('preview/{id}', 'AnnuaireController@preview');

    Route::post('message-entreprise/{slug}', 'AnnuaireController@message');

    Route::get('recherche', "AnnuaireController@recherche");

    Route::get('realisations/{slug}/{produit}', 'AnnuaireController@produit');
    Route::get('services/{slug}/{service}', 'AnnuaireController@service');


    Route::get('/', "HomeController@index");
    Route::get('nous-contacter', "HomeController@contact");
    Route::post('nous-contacter', "HomeController@contact");

    Route::get('services', 'HomeController@services');
    Route::get('service/{slug}', 'HomeController@service');
    Route::get('realisations', 'HomeController@realisations');
    Route::get('realisation/{slug}', 'HomeController@realisation');

    //USER LINK
    Route::get('reset-passeword', 'UserController@reset_password');
    Route::post('reset-passeword', 'UserController@reset_password');

    Route::get('inquire/password/edit', 'UserController@reset_password_token');
    Route::post('inquire/password/edit', 'UserController@reset_password_token');

    Route::get('se-connecter', 'UserController@login');
    Route::get('se-deconnecter', 'UserController@logout');

    Route::post('login', 'UserController@login');

    //CONTACT LINK
    require_once("contact.php");

    //CANDIDAT LINK
    require_once("candidat.php");

    //ANNONCE LINK
    require_once("annonce.php");

    Route::get('qui-sommes-nous', "HomeController@about");
    Route::get('regles-generales', "HomeController@regles");
    Route::get('faq', "HomeController@faq");
    Route::post('newsletters/subscribe', 'NewsletterController@subscribe');
    Route::get('newsletters/{id}', 'NewsletterController@opened');
    Route::get('newsletters/unsubscribe/{email}', 'NewsletterController@unsubscribe');
    Route::get('newsletters/opened/{id}', 'NewsletterController@opened');

});


Route::get("{any}", function () {
    return redirect('/');
});

//FROM GUINEE-EMPLOI
Route::get('front/conditions', "HomeController@regles");
Route::get('offre', 'AnnonceController@index');
Route::get('offre/detail/{slug}/{titre}', function () {
    return redirect('emploi',301);
});
Route::get('offre/detail/{slug}', function () {
    return redirect('emploi',301);
});

Route::get('recruteur/detail/{id}', function () {
    return redirect('annuaire',301);
});
Route::get('offre/recruteur/{id}/{slud}', function () {
    return redirect('annuaire',301);
});

Route::get('article/{id}/{slug}',function(){
    return redirect('actualites',301);
});

