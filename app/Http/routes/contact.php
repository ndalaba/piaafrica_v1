<?php
Route::get('contact/creer-compte', 'ContactController@formulaire_contact');
Route::post('edit-info', 'ContactController@save_contact');
Route::post('register', 'ContactController@register');

Route::get('publier-entreprise/{id?}', 'ContactController@formulaire_entreprise');
Route::post('entreprises/publier', 'ContactController@publier_entreprise');

Route::group(['middleware' => ['annonceur']], function () {

    Route::get('cvtheques','AnnonceController@cvtheques');
    Route::get('cvtheques/{slug}','AnnonceController@cvtheque');

    Route::get('mes-offres', 'ContactController@annonces');
    Route::get('mes-offres/annonce/{id?}','ContactController@getannonce');
    Route::get('mes-offres/annonces/suppimer/{id}','ContactController@deleteAnnonce');
    Route::post('mes-offres/annonces/saveannonce','ContactController@saveannonce');

    Route::get('candidats/recherche','AnnonceController@findcandidat');

});

Route::group(['middleware' => ['contact']], function () {
    Route::get('mon-compte', 'ContactController@entreprises');
    //Route::post('mon-compte', 'ContactController@compte');
    Route::get('entreprises/delete/{id}', 'ContactController@supprimer_entreprise');
    Route::get('edit-info/{id?}', 'ContactController@formulaire_contact');
    Route::get('mes-entreprises', 'ContactController@entreprises');

    Route::get('entreprise-detail/about/{id}', 'ContactController@about');
    Route::post('entreprise-detail/about/{id}', 'ContactController@about');

    Route::post('entreprises-detail/create-service', 'ContactController@createService');
    Route::put('entreprise-detail/update-service', 'ContactController@updateService');
    Route::get('entreprises-detail/services/{entreprise}', 'ContactController@services');
    Route::get('entreprise-detail/service/{entreprise}/{id}', 'ContactController@service');
    Route::get('entreprise-detail/service-delete/{entreprise}/{id}', 'ContactController@deleteService');

    Route::post('entreprises-detail/create-adresse', 'ContactController@createAdresse');
    Route::put('entreprise-detail/update-adresse', 'ContactController@updateAdresse');
    Route::get('entreprises-detail/adresses/{entreprise}', 'ContactController@adresses');
    Route::get('entreprise-detail/adresse/{entreprise}/{id}', 'ContactController@adresse');
    Route::get('entreprise-detail/adresse-delete/{entreprise}/{id}', 'ContactController@deleteAdresse');

    Route::post('entreprises-detail/create-produit', 'ContactController@createProduit');
    Route::put('entreprise-detail/update-produit', 'ContactController@updateProduit');
    Route::get('entreprises-detail/produits/{entreprise}', 'ContactController@produits');
    Route::get('entreprise-detail/produit/{entreprise}/{id}', 'ContactController@produit');
    Route::get('entreprise-detail/produit-delete/{entreprise}/{id}', 'ContactController@deleteProduit');

    Route::post('entreprises-detail/create-partenaire', 'ContactController@createPartenaire');
    Route::put('entreprise-detail/update-partenaire', 'ContactController@updatePartenaire');
    Route::get('entreprises-detail/partenaires/{entreprise}', 'ContactController@partenaires');
    Route::get('entreprise-detail/partenaire/{entreprise}/{id}', 'ContactController@partenaire');
    Route::get('entreprise-detail/partenaire-delete/{entreprise}/{id}', 'ContactController@deletePartenaire');

});