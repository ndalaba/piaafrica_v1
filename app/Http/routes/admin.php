<?php
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::get('administration/login', function () {
    return view('auth.login')->withErrors("Partie inaccessible");
});

Route::get('administration/logout', function () {
    Auth::logout();
    return redirect('administration/login');
});

Route::group(['middleware' => ['administration'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::controller('users', 'UserController');
    Route::controller('pubs', 'PubController');
    Route::controller('lettres', 'NewsletterController');
    Route::controller('candidats', 'CandidatController');
});

Route::group(['middleware' => ['editeur'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('/index', function () {

        $users = \App\Http\Models\User::where('droit', '<', config('application.contact'))->get();
        foreach ($users as $user) {
            $user->droit = config('application.candidat');
            $user->save();
        }

        $data = array(
            'entreprises' => \App\Http\Models\Entreprise::select('id')->where('publie', 1)->count('id'),
            'annonces' => \App\Http\Models\Annonce::select('id')->where('publie', 1)->count('id'),
            'vus' => \App\Http\Models\Entreprise::select('id')->sum('vu'),
            'vues' => \App\Http\Models\Article::select('id')->sum('vue'),
            'vues_annonces' => \App\Http\Models\Annonce::select('id')->sum('vu'),
            'entreprisesN' => \App\Http\Models\Entreprise::select('id')->where('publie', 0)->count('id'),
            'annoncesN' => \App\Http\Models\Annonce::select('id')->where('publie', 0)->count('id'),
            'news' => \App\Http\Models\Article::select('id')->where('publie', 1)->count('id'),
            'newsN' => \App\Http\Models\Article::select('id')->where('publie', 0)->count('id'),
            'contacts' => \App\Http\Models\User::select('id')->where('droit', config("application.contact"))->count('id'),
            'candidats' => \App\Http\Models\User::select('id')->where('droit', config("application.candidat"))->count('id'),
            'emails' => \App\Http\Models\Newsletter::select('id')->count('id'),
            'emails_actifs' => \App\Http\Models\Newsletter::select('id')->where('publie', 1)->count('id'),
            'newsletters' => \App\Http\Models\Lettre::select('id')->count('id'),
            'vues_newsletters' => \App\Http\Models\Lettre::select('id')->sum('vue'),
            'newslettersN' => \App\Http\Models\Lettre::select('id')->where('publie', 0)->count('id'),
        );
        return view('admin.home', $data);
    });


    // Include route

    Route::controller('sections', 'SectionController');
    Route::controller('villes', 'VilleController');
    Route::controller('countrys', 'CountryController');
    Route::controller('contacts', 'ContactController');
    Route::controller('articles', 'ArticleController');
    Route::controller('realisations', 'RealisationController');
    Route::controller('services', 'ServiceController');
    Route::controller('annonces', 'AnnonceController');
    require_once('entreprise.php');

});
