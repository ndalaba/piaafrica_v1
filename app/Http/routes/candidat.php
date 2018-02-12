<?php
Route::post('candidat/edit-info', 'CandidatController@save_candidat');
Route::post('candidat/register', 'CandidatController@register');
Route::get('candidat/register', 'CandidatController@register');

Route::group(['middleware' => ['candidat']], function () {
    Route::get('candidat/mon-compte', 'CandidatController@compte');
    Route::get('candidat/cv', 'CandidatController@cv');
    Route::post('candidat/cv', 'CandidatController@cv');
    Route::get('candidat/edit-info/{id?}', 'CandidatController@register');
    Route::get('candidat/details', 'CandidatController@details');
    Route::post('candidat/details', 'CandidatController@details');

    //FROM GUINEE-EMPLOI
    Route::get('candidat/forgetPwd/','CandidatController@compte');

});