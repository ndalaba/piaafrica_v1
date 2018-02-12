<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Annonce;
use App\Http\Models\Country;
use App\Http\Models\Entreprise;
use App\Http\Models\EntrepriseDetails;
use App\Http\Models\Section;
use App\Http\Models\User;
use App\Http\Models\Help;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class ContactController extends BaseController {
    var $paginate, $filesize;

    public function __construct() {
        parent::__construct();
        $this->filesize = config('application.image_size');

        $this->paginate = config('application.paginate');
    }

    public function formulaire_contact(Request $request) {
        if (!\Auth::check())
            $id = 0;
        else
            $id = \Auth::user()->id;

        $user = new User();

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $user = $user->fill($request->old());
        }
        else {
            $user = User::find($id);

            if ($user == null) {
                $user = new User();
            }
        }
        return view('front.contact.formulaire')->with('user', $user);
    }

    public function save_contact(Request $request) {
        if ($request->isMethod('post')) {
            $user = $this->create($request);
            return view('front.contact.formulaire')->with('user', $user)->with('success', 1);
        }
    }

    public function compte(Request $request) {
        $entreprises = null;
        if ($request->isMethod('post')) {
            if ($request->input('doaction') == 'Appliquer') {
                $action = $request->input('action');
                $posts = $request->input('post');
                if ($action == -1) {
                    foreach ($posts as $id) {
                        Entreprise::supprimer(Entreprise::find($id));
                    }

                }

                elseif ($action == 0)
                    Entreprise::depublier($posts);
                return redirect('mon-compte');
            }
            elseif ($request->input('doaction') == 'Filtrer') {
                $publie = $request->input('publie');
                $query = Entreprise::with('section')->where('user_id', \Auth::user()->id);
                if (!empty($publie))
                    $query->online($publie);
                $entreprises = $query->orderBy('id', 'desc')->get();
            }

        }
        else
            $entreprises = Entreprise::with('section')->where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->get();

        $data = ['entreprises' => $entreprises];
        return view('front.contact.compte', $data);
    }

    public function formulaire_entreprise(Request $request, $id = 0) {
        if ($id != 0) {
            if (!\Auth::check())
                return redirect('se-connecter');
        }

        $entreprise = new Entreprise();
        $user = new User;

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $entreprise = $entreprise->fill($request->old());
            $user = $user->fill($request->old());
        }
        else {
            $user_id = \Auth::user() ? \Auth::user()->id : 0;
            $entreprise = Entreprise::where('id', $id)->where('user_id', $user_id)->first();
            if ($entreprise == null) {
                $entreprise = new Entreprise(['user_id' => $user_id]);
            }
        }
        $countries = Country::all();
        if ($id != 0)
            $villes =  Ville::where('country_id', $entreprise->adress->ville->country_id)->orderBy('ville')->get();
        else
            $villes = Ville::orderBy('ville')->get();

        return view('front.contact.publier')->with('entreprise', $entreprise)->with('user', $user)->with('adresse', $entreprise->adress)->with('countries',$countries)->with('villes',$villes);

    }

    private function create(Request $request) {

        $user = null;
        $validator = \Validator::make($request->all(), User::$rules);
        if ($validator->fails()) {
            return array('reponse' => 0, "message" => $validator->messages());
           // return redirect("publier-entreprise/0")->withInput()->withErrors($validator->messages());
        }

        $error = "";
        $login = url('se-connecter');

        if (Help::checkObject(new User(), 'email', $request->input('email'), $request->input('id', 0)))
            $error = 'Adresse email déja enregistrée <a href="' . $login . '" style="color:#3AB795">Connectez vous à votre compte</a>';

        if (Help::checkObject(new User(), 'phone', $request->input('user_phone'), $request->input('id', 0)))
            $error = 'Numéro de téléphone déja enregistré <a href="' . $login . '" style="color:#3AB795">Connectez vous à votre compte</a>';

        if (strlen(trim($error)) > 0)
            return array('reponse' => 0, "message" => $error);

        $pass = ($request->input('password') == "") ? $request->input('lastpass') : \Hash::make($request->input('password'));
        $request->merge(['password' => $pass]);
        $request->merge(['phone' => $request->input('user_phone')]);
        $request->merge(['droit' => config('application.contact')]);
        if ($request->has('id')) {
            $user = User::find($request->input('id'));
            $user->update($request->all());
        }
        else{
            $user = User::create($request->all());
            \Auth::loginUsingId($user->id);
            $param = ['name' =>$user->name, 'email' => $user->email, 'sujet'=>'  Bienvenue parmi la communauté PIA AFRICA'];;
            if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){
                \Mail::send('emails.contact-entreprise', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@piaafrica.com', config('application.name'));
                    $message->to($param['email'], $param['name'])->cc('contact@piaafrica.com')->subject($param['sujet']);
                });
            }
        }


        return array('reponse' => 1, "message" => $user);

    }

    public function register(Request $request) {
        if ($request->isMethod('post')) {
            $rp = $this->create($request);
            if ($rp['reponse'] == 0)
                return redirect("publier-entreprise/0")->withInput()->with("error", $rp['message']);
            else if ($rp['reponse'] == 1) {
                $user = $rp['message'];
                \Auth::loginUsingId($user->id);
                return redirect('mon-compte');
            }
        }
        else
            return redirect('publier-entreprise');
    }

    public function publier_entreprise(Request $request) {
        if ($request->isMethod('post')) {
            if (!\Auth::user()) {
                $rp = $this->create($request);
                if ($rp['reponse'] == 0)
                    return redirect("publier-entreprise/0")->withInput()->with("error", $rp['message']);
                else if ($rp['reponse'] == 1) {
                    $user = $rp['message'];
                    \Auth::loginUsingId($user->id);
                    $request->merge(array('user_id' => $user->id));
                }
            }
            else {
                $request->merge(array('user_id' => \Auth::user()->id));
            }

            return Entreprise::store($request, 'publier-entreprise/');
        }
    }

    public function supprimer_entreprise($id) {
        $entreprise = Entreprise::where('id', $id)->where('user_id', \Auth::user()->id)->first();
        if (!is_null($entreprise)) {
            $services = count($entreprise->services);
            $produits = count($entreprise->produits);
            if (!$services && !$produits) {
                Entreprise::supprimer($entreprise);
            }
        }
        return redirect('mes-entreprises');
    }

    public function entreprises() {
        $entreprises =   Entreprise::with('user', 'section')->where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->paginate($this->paginate);
        $entreprises->setPath('');
        $data = array('entreprises' => $entreprises);
        return view('front.contact.entreprises', $data);
    }

    //ANNONCES
    public function annonces() {
        $annonces = Annonce::with('section', 'ville', 'entreprise')->where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->paginate($this->paginate);
        $annonces->setPath('');
        $data = array('annonces' => $annonces);
        return view('front.contact.annonces', $data);
    }

    public function saveannonce(Request $request) {
        if ($request->isMethod('post')) {
            return Annonce::store($request, 'mes-offres/annonce/');
        }
    }

    public function getannonce(Request $request, $id = 0) {
        $annonce = new Annonce();

        $sections =  Section::orderBy('section')->get();
        $entreprises = Entreprise::where('user_id',$request->user()->id)->orderBy('name')->get();
        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $annonce = $annonce->fill($request->old());
        }
        else {
            $annonce =  Annonce::where('id',$id)->where('user_id',\Auth::user()->id)->first();
            if ($annonce == null) {
                $annonce = new Annonce();
            }
        }

        $countries = Country::all();
        if ($annonce->ville)
            $villes = Ville::where('country_id', $annonce->ville->country_id)->orderBy('ville')->get();
        else
            $villes = Ville::orderBy('ville')->get();
        return view('front.contact.annonce_frm')->with('sections', $sections)->with('annonce', $annonce)->with('countries', $countries)->with('villes', $villes)->with('entreprises', $entreprises);
    }

    public function deleteAnnonce($id) {
        $annonce =  Annonce::where('id',$id)->where('user_id',\Auth::user()->id)->first();
        Annonce::supprimer($annonce);
        return redirect('mes-offres');
    }


    //ABOUT
    public function about(Request $request, $id) {
        return EntrepriseDetails::about($request, $id, 'front.contact.about', 'entreprise-detail/about/');
    }

    //SERVICES
    public function services($entreprise = 0) {
        return EntrepriseDetails::services($entreprise, 'front.contact.services');
    }

    public function service($entreprise = 0, $id = 0) {
        return EntrepriseDetails::service($entreprise, $id, 'front.contact.services');
    }

    public function createService(Request $request) {
        return EntrepriseDetails::createService($request, "entreprise-detail/service/", "entreprises-detail/services/");
    }

    public function updateService(Request $request) {
        return EntrepriseDetails::updateService($request, "entreprise-detail/service/", 'entreprises-detail/services/');
    }

    public function deleteService($entreprise, $id) {
        return EntrepriseDetails::deleteService($entreprise, $id, 'entreprises-detail/services/');
    }

    //ADRESSES
    public function adresses($entreprise = 0) {
        return EntrepriseDetails::adresses($entreprise, 'front.contact.adresses');
    }

    public function adresse($entreprise = 0, $id = 0) {
        return EntrepriseDetails::adresse($entreprise, $id, 'front.contact.adresses');
    }

    public function createAdresse(Request $request) {
        return EntrepriseDetails::createAdresse($request, "entreprise-detail/adresse/", 'entreprises-detail/adresses/');
    }

    public function updateAdresse(Request $request) {
        return EntrepriseDetails::updateAdresse($request, "entreprise-detail/adresse/", "entreprises-detail/adresses/");
    }

    public function deleteAdresse($entreprise, $id) {
        return EntrepriseDetails::deleteAdresse($entreprise, $id, 'entreprises-detail/adresses/');
    }

    //PRODUITS
    public function produits($entreprise = 0) {
        return EntrepriseDetails::produits($entreprise, 'front.contact.produits');
    }

    public function produit($entreprise = 0, $id = 0) {
        return EntrepriseDetails::produit($entreprise, $id, 'front.contact.produits');
    }

    public function createProduit(Request $request) {
        return EntrepriseDetails::createProduit($request, "entreprise-detail/produit/", "entreprises-detail/produits/", $this->filesize);
    }

    public function updateProduit(Request $request) {
        return EntrepriseDetails::updateProduit($request, "entreprise-detail/produit/", "entreprises-detail/produits/", $this->filesize);
    }

    public function deleteProduit($entreprise, $id) {
        return EntrepriseDetails::deleteProduit($entreprise, $id, 'entreprises-detail/produits/');
    }

    //PARTENAIRES
    public function partenaires($entreprise = 0) {
        return EntrepriseDetails::partenaires($entreprise, 'front.contact.partenaires');
    }

    public function partenaire($entreprise = 0, $id = 0) {
        return EntrepriseDetails::partenaire($entreprise, $id, 'front.contact.partenaires');
    }

    public function createPartenaire(Request $request) {
        return EntrepriseDetails::createPartenaire($request, "entreprise-detail/partenaire/", "entreprises-detail/partenaires/", $this->filesize);
    }

    public function updatePartenaire(Request $request) {
        return EntrepriseDetails::updatePartenaire($request, "entreprise-detail/partenaire/", "entreprises-detail/partenaires/", $this->filesize);
    }

    public function deletePartenaire($entreprise, $id) {
        return EntrepriseDetails::deletePartenaire($entreprise, $id, 'entreprises-detail/partenaires/');
    }
}
