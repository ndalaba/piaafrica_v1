<?php
namespace App\Http\Controllers;


use App\Http\Models\Article;
use App\Http\Models\Country;
use App\Http\Models\Entreprise;
use App\Http\Models\Pub;
use App\Http\Models\Section;
use App\Http\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use View;

class BaseController extends Controller {
    public function __construct() {
        //Affiche pas pour le moment Habillement et cosmetique
        //Cache::pull('partenaires');

        $sections = Cache::remember('sections', 60, function () {
            return Section::orderBy('section')->get();
        });

        $homesections = Cache::remember('homesections', 60, function () {
            $results = \DB::select(\DB::raw('SELECT sections.*, COUNT(entreprises.id) AS count_id FROM sections
                                                LEFT JOIN entreprises on sections.id=entreprises.section_id
                                                GROUP BY sections.id ORDER BY count_id DESC limit 0,12'));
            return $results;
            // return Section::orderBy('section', 'rand')->limit(12)->get();
        });

        $unes = Cache::remember('unes', 60, function () {
            return Entreprise::with('section', 'adresses','ville')->online()->where('une', 1)->orderByRaw("RAND()")->limit(4)->get();
        });

        $latests = Cache::remember('latests', 60, function () {
            return Article::with('section')->online()->position(1)->orderBy('id', 'desc')->limit(2)->get();
        });

        $populaires = Cache::remember('populaires', 1000, function () {
            $results = \DB::select(\DB::raw('SELECT sections.*, COUNT(entreprises.id) AS count_id FROM sections
                                                LEFT JOIN entreprises on sections.id=entreprises.section_id
                                                GROUP BY sections.id ORDER BY count_id DESC limit 0,6'));
            return $results;
            // return Section::orderByRaw("RAND()")->limit(5)->get();
        });

        $villes = Cache::remember('villes', 2000, function () {
            return Ville::orderBy('ville')->get();
        });
        $countries = Cache::remember('countries', 2000, function () {
            return Country::all();
        });
        $partenaires = Cache::remember('partenaires', 2000, function () {
            return Pub::where('niveau', 1)->online()->get();
        });

        $pubs = Cache::remember('pubs', 60, function () {
            $wide = Pub::where('niveau', 2)->online()->orderBy('id', 'rand')->limit(1)->first();
            $squares = Pub::where('niveau', 4)->online()->orderBy('id', 'rand')->limit(2)->get();
            $medium = Pub::where('niveau', 3)->online()->orderBy('id', 'rand')->limit(1)->first();

            return array('wide' => $wide, 'squares' => $squares, 'medium' => $medium);
        });

        View::share('sections', $sections);
        View::share('homesections', $homesections);
        View::share('unes', $unes);
        View::share('lasts', $latests);
        View::share('countries', $countries);
        View::share('villes', $villes);
        View::share('partenaires', $partenaires);
        View::share('populaires', $populaires);
        View::share('pubs', $pubs);


    }
}
