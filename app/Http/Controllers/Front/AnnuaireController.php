<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Country;
use App\Http\Models\Entreprise;
use App\Http\Models\Produit;
use App\Http\Models\Section;
use App\Http\Models\Service;
use App\Http\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnuaireController extends BaseController {

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
            $data = ['annuaires' => $sections, 'country' => $country];
        }
        else
            $data = ['annuaires' => $sections];
        return view('front.annuaire', $data);
    }

    public function entreprises($slug) {
        $userCountry = \Session::get('country');
        if ($userCountry !== null) {
            $country = Country::where('code', $userCountry->countryCode)->first();
            $country_id = $country->id;
            $section = Section::where('slug', $slug)->first();
            if ($section != null) {
                $entreprises = Entreprise::with('section', 'ville')->whereHas('adresses', function ($query) use ($country_id) {
                    return $query->whereHas('ville', function ($q) use ($country_id) {
                        return $q->where('country_id', $country_id);
                    });
                })->where("section_id", $section->id)->online()->orderBy('une', 'desc')->paginate($this->paginate);
                $entreprises->setPath($section->slug);
            }
            else {
                $section = new Section(array('slug' => 'toutes-les-categories', 'section' => 'Toutes les catégories'));
                $entreprises = Entreprise::with('section', 'ville')->whereHas('adresses', function ($query) use ($country_id) {
                    return $query->whereHas('ville', function ($q) use ($country_id) {
                        return $q->where('country_id', $country_id);
                    });
                })->online()->orderBy('id', 'desc')->paginate($this->paginate);
                $entreprises->setPath($slug);
            }

            $data = ["entreprises" => $entreprises, 'section' => $section, 'country' => $country];
        }
        else {
            $section = Section::where('slug', $slug)->first();
            if ($section != null) {
                $entreprises = Entreprise::with('section', 'ville')->where("section_id", $section->id)->online()->orderBy('une', 'desc')->paginate($this->paginate);
                $entreprises->setPath($section->slug);
            }
            else {
                $section = new Section(array('slug' => 'toutes-les-categories', 'section' => 'Toutes les catégories'));
                $entreprises = Entreprise::with('section', 'ville')->online()->orderBy('id', 'desc')->paginate($this->paginate);
                $entreprises->setPath($slug);
            }

            $data = ["entreprises" => $entreprises, 'section' => $section];
        }

        return view('front.entreprise.entreprises', $data);
    }

    public function recherche(Request $request) {
        $q = trim($request->input('q', ' '));
        $v = trim($request->input('ville', ' '));
        $pays = trim($request->input('pays', ' '));
        $s = trim($request->input('section', ' '));
        $entreprises = Entreprise::with('section', 'ville')->online();

        if (!empty($q)) {
            $entreprises->keyword($q);
        }

        if (!empty($s)) {
            $section = Section::where('slug', $s)->first();
            $entreprises->section($section->id);
        }
        if (!empty($v)) {
            $ville = Ville::where('ville', $v)->first();
            $entreprises->ville($ville->id);
        }
        elseif (!empty($pays)) {
            $country = Country::where('slug', $pays)->first();
            $entreprises->country($country->id);
        }

        $path = array(
            "_token" => $request->get('_token'),
            "q" => $q,
            "pays" => $pays,
            "section" => $s,
            "ville" => $v,
        );
        $entreprises = $entreprises->orderBy('une', 'desc')->paginate($this->paginate)->appends($path);
        //$toutes->setPath("recherche".$path);

        $data = ["entreprises" => $entreprises, 'all' => $request->all()];
        return view('front.entreprise.entreprises', $data);
    }

    public function entreprise($country, $domaine, $slug) {
        return self::detail($slug);
    }

    public function preview($id) {
        return self::detail('', null, true, $id);
       /* if ($this->user->droit >= config('application.annonceur')) {
            //$slug = Entreprise::select('slug')->where('id', $id)->first();

        }
        else if ($this->user)
            return self::detail('', null, true, $id);
        else
            return self::detail($id);*/
    }

    private function detail($slug, $response = null, $preview = false, $id = 0) {
        //$slug = explode('_', $slug)[0];
        if ($preview)
            $entreprise = Entreprise::with('services', 'produits', 'partenaires')->where('id', $id)->first();
            //$entreprise = Entreprise::with('services', 'produits', 'partenaires')->where('id', $id)->where('user_id', $this->user->id)->first();
        else
            $entreprise = Entreprise::with('services', 'produits', 'partenaires')->online()->where('slug', $slug)->first();

        if (is_null($entreprise))
            return view('front.entreprise.introuvable');
        if ($response == null) {
            $entreprise->vu += 1;
            $entreprise->save();
        }
        $articles = \DB::select(\DB::raw("SELECT article_id  FROM article_entreprise WHERE entreprise_id=$entreprise->id"));
        $data = array('entreprise' => $entreprise, 'response' => $response, 'articles' => $articles);
        if ($response['type'] == 'error')
            return view('front.entreprise.entreprise', $data)->withErrors($response['message']);
        else
            return view('front.entreprise.entreprise', $data);
    }

    public function produit($slug, $query) {
        $query = explode('-', $query);
        $entreprise = Entreprise::where('slug', $slug)->first();
        if (is_null($entreprise))
            return view('front.entreprise.introuvable');
        $produit = Produit::where('entreprise_id', $entreprise->id)->where('id', $query[0])->first();
        $produits = Produit::same($produit);
        $data = array('produit' => $produit, 'produits' => $produits, 'entreprise' => $entreprise);
        return view('front.entreprise.produit', $data);
    }

    public function service($slug, $query) {
        $query = explode('-', $query);
        $entreprise = Entreprise::where('slug', $slug)->first();
        if (is_null($entreprise))
            return view('front.entreprise.introuvable');
        $service = Service::where('entreprise_id', $entreprise->id)->where('id', $query[0])->first();
        $services = Service::same($service);
        $data = array('service' => $service, 'services' => $services, 'entreprise' => $entreprise);
        return view('front.entreprise.service', $data);
    }


    public function message(Request $request, $slug) {
        if ($request->isMethod('post')) {
            $entreprise = Entreprise::find($request->input('id'));
            $user = $entreprise->user;

            $validator = \Validator::make($request->all(), ['name' => 'required', 'email' => 'required|email', 'sujet' => 'required', 'message' => 'required']);
            if ($validator->fails()) {
                $reponse = array('type' => 'error', 'message' => $validator->messages());
                return self::detail($entreprise->slug, $reponse);
                //return redirect('annuaire/message/' . $request->input('id'))->withInput()->withErrors($validator->messages());
            }

            $param = ['name' => $request->input('email'), 'name' => $request->input('name'), 'sujet' => $request->input('sujet'), 'message' => $request->input('message')];

            \Mail::send('emails.message', ['param' => $param], function ($message) use ($request, $entreprise) {
                $message->from($request->input('email'), $request->input('nom'));
                $message->to($entreprise->email, $entreprise->name)->subject($request->input('sujet'));
            });

            \Mail::send('emails.message', ['param' => $param], function ($message) use ($request, $user) {
                $message->from('contact@piaafrica.com', 'Pia Africa');
                $message->to($request->input('email'), $request->input('name'))->subject($request->input('sujet'));
            });
            $reponse = array('type' => 'success', 'message' => 'Message envoyé');
            return self::detail($entreprise->slug, $reponse);
        }
        else {
            return self::detail($slug);
        }
    }

}
