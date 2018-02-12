<?php

// Include route
require_once('routes/admin.php');
require_once('routes/front.php');

Route::get('villes/{id}', function ($id) {
    return json_encode(\App\Http\Models\Ville::where('country_id', $id)->orderBy('ville')->get());
});
Route::get('entreprises/{slug}', function ($slug) {
    $country = \App\Http\Models\Country::where('slug', $slug)->first();
    return json_encode(\App\Http\Models\Entreprise::hasAnnonces($country->id));
});

Route::get('cities/{code}', function ($code) {
    $country = \App\Http\Models\Country::where('slug', $code)->first();
    return json_encode(\App\Http\Models\Ville::where('country_id', $country->id)->orderBy('ville')->get());
})->where('code', '(.*)');

Route::get("{any}", function () {
    return redirect('/');
});
