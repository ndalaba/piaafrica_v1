<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Candidat;
use App\Http\Models\Country;
use App\Http\Models\Annonce;
use App\Http\Models\Entreprise;
use App\Http\Models\Help;
use App\Http\Models\Newsletter;
use App\Http\Models\Section;
use App\Http\Models\User;
use App\Http\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends BaseController {

    var $paginate, $user;

    public function __construct() {
        parent::__construct();
        $this->paginate = config('application.paginate');
        $this->user = Auth::user();
    }

    public function index() {
        $sections = Section::all();
        $userCountry = \Session::get('country');
        if ($userCountry !== null) {
            $country = Country::where('code', $userCountry->countryCode)->first();
            $country_id = $country->id;
            $annonces = Annonce::with('section', 'ville', 'entreprise')->whereHas('ville', function ($query) use ($country_id) {
                return $query->where('country_id', $country_id);
            })->online()->orderBy('id', 'desc')->paginate($this->paginate);
            $data = ['annonces' => $annonces, 'sections' => $sections, 'country' => $country];
        }
        else {
            $annonces = Annonce::with('section', 'ville', 'entreprise')->online()->orderBy('id', 'desc')->paginate($this->paginate);
            $annonces->setPath('');
            $data = ['annonces' => $annonces, 'sections' => $sections];
        }

        return view('front.annonce.annonces', $data);
    }

    public function postuler(Request $request) {
        if ($request->isMethod('post')) {
            $cv = null;
            $annonce = Annonce::find($request->input('annonce_id'));
            if ($annonce == null)
                return redirect()->back()->withErrors("Cette session est invalide");

            $candidat_id = $request->input('candidat_id');
            $motivation = $request->input('motivation');
            $name = $request->input('name');
            $email = $request->input('email');

            $extension = array('pdf', 'doc', 'docx');
            if ($request->hasFile('cv')) {
                $fileName = Help::upload('cv', 'temp/', config('application.image_size'), $extension);
                $cv = asset('uploads/temp/' . $fileName);
            }
            elseif ($request->user()) {
                if ($request->user()->candidat)
                    $cv = asset('uploads/candidats/cv/' . $request->user()->candidat->cvdoc);
            }
            if ($cv == null)
                return redirect()->back()->withErrors("Un cv est obligatoire pour postuler à cette offre");
            $validator = \Validator::make($request->all(), ['email' => 'required|email', 'name' => 'required']);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->messages());
            }

            if ($candidat_id == 0) {
                try {
                    if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
                        Newsletter::where('email', $email)->delete();
                        Newsletter::create(['email' => $email, 'publie' => 1]);
                    }

                } catch (Exception $e) {
                }
            }
            elseif (\Auth::user()) {
                if (\Auth::user()->id == $candidat_id) {
                    \DB::table('annonce_user')->where(['user_id' => $candidat_id, 'motivation' => $motivation, 'annonce_id' => $annonce->id])->take(1)->delete();
                    \DB::table('annonce_user')->insert(['user_id' => $candidat_id, 'annonce_id' => $annonce->id, 'motivation' => $motivation]);
                }
            }
            else {
                return redirect()->back()->withErrors("Cette session est invalide");
            }
            if (filter_var($annonce->email, FILTER_VALIDATE_EMAIL)) {
                $param = ['name' => $name, 'email' => $email, 'sujet' => $annonce->titre, 'message' => $motivation, 'annonce' => $annonce,'cv'=>$cv];
                \Mail::send('emails.postuler', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@piaafrica.com', config('application.name'));
                    $message->attach($param['cv']);
                    $message->to($param['annonce']->email)->cc($param['email'])->bcc('contact@piaafrica.com')->subject($param['sujet']);
                    //$message->to($param['email'], $param['name'])->cc($param['annonce']->email)->bcc('contact@piaafrica.com')->subject($param['sujet']);
                });
            }
            return redirect()->back()->with('success', "Vous avez postuler à cette offre");
        }
        else {
            return redirect()->back();
        }

    }

    public function annonces($slug) {
        $userCountry = new Country();// \Session::get('country');
        if ($userCountry !== null) {
            //$country = Country::where('code', $userCountry->countryCode)->first();
            $country = Country::where('code', 'gn')->first();
            $country_id = $country->id;
            $section = Section::where('slug', $slug)->first();
            if ($section != null) {
                $annonces = Annonce::with('section', 'ville', 'entreprise')->whereHas('ville', function ($query) use ($country_id) {
                    return $query->where('country_id', $country_id);
                })->where("section_id", $section->id)->online()->orderBy('une', 'desc')->paginate($this->paginate);
                $annonces->setPath($section->slug);
            }
            else {
                $section = new Section(array('slug' => 'toutes-les-categories', 'section' => 'Toutes les catégories', 'description' => "Les dernières offres d'emploi en Afrique"));
                $annonces = Annonce::with('section', 'ville', 'entreprise')->whereHas('ville', function ($query) use ($country_id) {
                    return $query->where('country_id', $country_id);
                })->online()->orderBy('id', 'desc')->paginate($this->paginate);
                $annonces->setPath($slug);
            }
            $data = ["annonces" => $annonces, 'section' => $section, 'country' => $country];
        }
        else {
            $section = Section::where('slug', $slug)->first();
            if ($section != null) {
                $annonces = Annonce::with('section', 'ville', 'entreprise')->where("section_id", $section->id)->online()->orderBy('une', 'desc')->paginate($this->paginate);
                $annonces->setPath($section->slug);
            }
            else {
                $section = new Section(array('slug' => 'toutes-les-categories', 'section' => 'Toutes les catégories', 'description' => "Les dernières offres d'emploi en Afrique"));
                $annonces = Annonce::with('section', 'ville', 'entreprise')->online()->orderBy('id', 'desc')->paginate($this->paginate);
                $annonces->setPath($slug);
            }

            $data = ["annonces" => $annonces, 'section' => $section];
        }

        return view('front.annonce.annonces', $data);
    }

    public function recherche(Request $request) {
        $q = trim($request->input('q', ' '));
        $v = trim($request->input('ville', ' '));
        $pays = trim($request->input('pays', ' '));
        $entreprise = trim($request->input('entreprise', ' '));
        $type = trim($request->input('type', ' '));
        $s = trim($request->input('section', ' '));
        $annonces = Annonce::with('section', 'ville', 'entreprise')->online();
        if (!empty($q)) {
            $annonces->keyword($q);
        }
        if (!empty($type)) {
            $annonces->type($type);
        }

        if (!empty($s)) {
            $section = Section::where('slug', $s)->first();
            $annonces->section($section->id);
        }
        if (!empty($entreprise)) {
            $entreprise = Entreprise::where('slug', $entreprise)->first();
            $annonces->entreprise($entreprise->id);
        }
        if (!empty($v)) {
            $ville = Ville::where('ville', $v)->first();
            $annonces->ville($ville->id);
        }
        elseif (!empty($pays)) {
            $country = Country::where('slug', $pays)->first();
            $annonces->country($country->id);
        }

        $path = array(
            "_token" => $request->get('_token'),
            "q" => $q,
            "pays" => $pays,
            "section" => $s,
            "entreprise" => $entreprise,
            "type" => $type,
            "ville" => $v,
        );
        $annonces = $annonces->orderBy('fin', 'desc')->orderBy('une', 'desc')->paginate($this->paginate)->appends($path);
        //$toutes->setPath("recherche".$path);

        $data = ["annonces" => $annonces, 'all' => $request->all()];
        return view('front.annonce.annonces', $data);
    }

    public function annonce($country, $slug) {
        $annonce = Annonce::where('slug', $slug)->first();

        if (is_null($annonce) or $annonce->expire)
            return view('front.annonce.introuvable');
        $annonce->vu += 1;
        $annonce->save();
        $annonces = Annonce::same($annonce->type, $annonce->ville->country_id, $annonce->section_id, $annonce->id);
        $data = array('annonce' => $annonce, 'annonces' => $annonces);
        return view('front.annonce.annonce', $data);
    }

    public function cvtheques() {
        $userCountry = \Session::get('country');
        if ($userCountry !== null) {
            $country = Country::where('code', $userCountry->countryCode)->first();
            $country_id = $country->id;
            $candidats = User::whereHas('ville', function ($query) use ($country_id) {
                return $query->where('country_id', $country_id);
            })->whereHas('candidat', function ($query) {
                return $query->online();
            })->where('droit', config('application.candidat'))->orderBy('id', 'desc')->paginate($this->paginate);
            $data = ['candidats' => $candidats, 'country' => $country];
        }
        else {
            $candidats = User::with('ville')->whereHas('candidat', function ($query) {
                return $query->online();
            })->where('droit', config('application.candidat'))->orderBy('id', 'desc')->paginate($this->paginate);
            $candidats->setPath('');
            $data = ['candidats' => $candidats];
        }
        return view('front.candidat.candidats', $data);
    }

    public function findcandidat(Request $request) {
        $q = trim($request->input('q', ' '));
        $v = trim($request->input('ville', ' '));
        $pays = trim($request->input('pays', ' '));
        $civilite = trim($request->input('civilite', ' '));
        $niveau = trim($request->input('niveau', ' '));
        $langue = trim($request->input('langue', ' '));
        $order = trim($request->input('order', ' '));

        $candidats = User::with('ville');

        if (!empty($v)) {
            $ville = Ville::where('ville', $v)->first();
            $ville_id = $ville->id;
            User::with(['ville' => function ($query) use ($ville_id) {
                return $query->where('ville_id', $ville_id);
            }]);
        }
        elseif (!empty($pays)) {
            $country = Country::where('slug', $pays)->first();
            $candidats->country($country->id);
        }
        if (!empty($q)) {
            $candidats->keyword($q);
        }
        $data = array('langue' => $langue, 'niveau' => $niveau, 'civilite' => $civilite, 'q' => $q);
        $candidats->whereHas('candidat', function ($query) use ($data) {
            $rs = $query->online();
            if (!empty($data['langue'])) {
                $rs->langue($data['langue']);
            }
            if (!empty($data['q'])) {
                $rs->keyword($data['q']);
            }
            if (!empty($data['niveau'])) {
                $rs->niveau($data['niveau']);
            }
            if (!empty($data['civilite'])) {
                $rs->langue($data['civilite']);
            }
        });

        $path = array(
            "_token" => $request->get('_token'),
            "q" => $q,
            "pays" => $pays,
            "civlite" => $civilite,
            "niveau" => $niveau,
            "langue" => $langue,
            "ville" => $v,
        );
        $candidats = $candidats->orderByRaw($order)->paginate($this->paginate)->appends($path);
        //$toutes->setPath("recherche".$path);

        $data = ["candidats" => $candidats, 'all' => $request->all()];
        return view('front.candidat.candidats', $data);
    }

    public function cvtheque($slug) {
        $slug = explode('_', $slug);
        $id = $slug[1];
        $candidat = User::whereHas('candidat', function ($query) {
            return $query->online();
        })->where('id', $id)->first();
        if ($candidat == null)
            return view('front.candidat.introuvable');

        $profil = Candidat::where('user_id', $id)->first();
        $profil->vu += 1;
        $profil->save();

        $data = ["candidat" => $candidat];
        return view('front.candidat.candidat', $data);
    }
}
