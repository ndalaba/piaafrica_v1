<?php

Route::controller('entreprises','EntrepriseController');
Route::get('entreprise/edit/{contact_id}/{id}','EntrepriseController@getEdit');

Route::get('entreprise-detail/about/{id}','EntreprisedetailController@about');
Route::post('entreprise-detail/about/{id}','EntreprisedetailController@about');

Route::post('entreprises-detail/create-service','EntreprisedetailController@createService');
Route::put('entreprise-detail/update-service','EntreprisedetailController@updateService');
Route::get('entreprises-detail/services/{entreprise}','EntreprisedetailController@services');
Route::get('entreprise-detail/service/{entreprise}/{id}','EntreprisedetailController@service');
Route::get('entreprise-detail/service-delete/{entreprise}/{id}','EntreprisedetailController@deleteService');

Route::post('entreprises-detail/create-adresse','EntreprisedetailController@createAdresse');
Route::put('entreprise-detail/update-adresse','EntreprisedetailController@updateAdresse');
Route::get('entreprises-detail/adresses/{entreprise}','EntreprisedetailController@adresses');
Route::get('entreprise-detail/adresse/{entreprise}/{id}','EntreprisedetailController@adresse');
Route::get('entreprise-detail/adresse-delete/{entreprise}/{id}','EntreprisedetailController@deleteAdresse');

Route::post('entreprises-detail/create-produit','EntreprisedetailController@createProduit');
Route::put('entreprise-detail/update-produit','EntreprisedetailController@updateProduit');
Route::get('entreprises-detail/produits/{entreprise}','EntreprisedetailController@produits');
Route::get('entreprise-detail/produit/{entreprise}/{id}','EntreprisedetailController@produit');
Route::get('entreprise-detail/produit-delete/{entreprise}/{id}','EntreprisedetailController@deleteProduit');

Route::post('entreprises-detail/create-partenaire','EntreprisedetailController@createPartenaire');
Route::put('entreprise-detail/update-partenaire','EntreprisedetailController@updatePartenaire');
Route::get('entreprises-detail/partenaires/{entreprise}','EntreprisedetailController@partenaires');
Route::get('entreprise-detail/partenaire/{entreprise}/{id}','EntreprisedetailController@partenaire');
Route::get('entreprise-detail/partenaire-delete/{entreprise}/{id}','EntreprisedetailController@deletePartenaire');