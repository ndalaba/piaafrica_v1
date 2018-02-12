<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Candidat;
use App\Http\Models\Country;
use App\Http\Models\Newsletter;
use App\Http\Models\User;
use App\Http\Models\Help;
use Illuminate\Http\Request;

class CandidatController extends BaseController {
    var $paginate, $filesize;

    public function __construct() {
        parent::__construct();
        $this->filesize = config('application.image_size');

        $this->paginate = config('application.paginate');
    }

    public function compte(Request $request) {
        $user = User::with('candidat')->where('id', $request->user()->id)->first();
        $data = array('user' => $user);
        return view('front.candidat.compte', $data);
    }

    public function cv(Request $request) {
        if ($request->isMethod('post')) {
            $candidat = Candidat::where('user_id', $request->user()->id)->first();
            if ($candidat == null) {
                $candidat = new Candidat();
                $candidat->user_id = $request->user()->id;
            }
            $candidat->cv = $request->input('cv');
            $candidat->save();

            $user = User::with('candidat')->where('id', $request->user()->id)->first();
            $data = array('user' => $user);
            return view('front.candidat.cv', $data)->with("success", "CV Enregistré");
        }
        else {
            $user = User::with('candidat')->where('id', $request->user()->id)->first();
            $data = array('user' => $user);
            return view('front.candidat.cv', $data);
        }
    }

    public function details(Request $request) {
        if ($request->isMethod('post')) {
            $candidat = Candidat::where('user_id', $request->user()->id)->first();
            if ($candidat == null) {
                $candidat = new Candidat();
                $candidat->user_id = $request->user()->id;
            }
            if ($request->user()->ville)
                $country_id = $request->user()->ville->country_id;
            else $country_id = 0;
            if ($request->has('newsletter')) {
                Newsletter::where('email', $request->user()->email)->delete();
                Newsletter::create(['email' => $request->user()->email, 'publie' => 1, 'country_id' => $country_id]);
            }
            else {
                Newsletter::where('email', $request->user()->email)->delete();
                Newsletter::create(['email' => $request->user()->email, 'publie' => 0, 'country_id' => $country_id]);
            }
            $request = Help::checked($request, 'newsletter');
            $request = Help::checked($request, 'publie');

            $extension = array('png', 'gif', 'jpg', 'jpeg');

            if ($request->hasFile('tof')) {
                $fileName = Help::upload('tof', 'candidats/photos/', config('application.image_size'), $extension);
                if ($fileName != null)
                    $candidat->photo = $fileName;
                else
                    return redirect('candidat/details')->withErrors("Photo au format 'png', 'gif', 'jpg', 'jpeg'  <= " . config('application.image_size_help'));
            }
            $extension = array('pdf', 'doc', 'docx');
            if ($request->hasFile('cv')) {
                $fileName = Help::upload('cv', 'candidats/cv/', config('application.image_size'), $extension);
                if ($fileName != null)
                    $candidat->cvdoc = $fileName;
                else
                    return redirect('candidat/details')->withErrors("Fichier cv au format 'pdf', 'doc', 'docx' <= " . config('application.image_size_help'));
            }

            $candidat->civilite = $request->input('civilite');
            $candidat->linkedin = $request->input('linkedin');
            $candidat->naissance = $request->input('naissance');
            $candidat->adresse = $request->input('adresse');
            $candidat->niveau = $request->input('niveau');
            $candidat->langue = $request->input('langue');
            $candidat->languebis = $request->input('languebis');
            $candidat->specialite = $request->input('specialite');
            $candidat->experience = $request->input('experience');
            $candidat->newsletter = $request->input('newsletter');
            $candidat->publie = $request->input('publie');
            $candidat->save();

            $candidat = Candidat::where('user_id', $request->user()->id)->first();
            $data = array('candidat' => $candidat);
            return view('front.candidat.details', $data)->with("success", "Détails compte enregitré");
        }
        else {
            $candidat = Candidat::firstOrNew(['user_id' => $request->user()->id]);
            $data = array('candidat' => $candidat);
            return view('front.candidat.details', $data);
        }
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

        if (Help::checkObject(new User(), 'phone', $request->input('phone'), $request->input('id', 0)))
            $error = 'Numéro de téléphone déja enregistré <a href="' . $login . '" style="color:#3AB795">Connectez vous à votre compte</a>';

        if (strlen(trim($error)) > 0)
            return array('reponse' => 0, "message" => $error);

        $pass = ($request->input('password') == "") ? $request->input('lastpass') : \Hash::make($request->input('password'));
        $request->merge(['password' => $pass]);
        $request->merge(['droit' => config('application.candidat')]);
        if ($request->has('id')) {
            $user = User::find($request->input('id'));
            $user->update($request->all());
        }
        else {
            $user = User::create($request->all());
            Newsletter::where('email', $request->input('email'))->delete();
            Newsletter::create(['email' =>$request->input('email'), 'publie' => 1, 'country_id' => $request->input('country_id')]);
            \Auth::loginUsingId($user->id);
            $param = ['name' => $user->name, 'email' => $user->email, 'id' => $user->id, 'sujet' => '  Bienvenue parmi la communauté PIA AFRICA'];
            if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                \Mail::send('emails.candidat', ['param' => $param], function ($message) use ($param) {
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
                return redirect("candidat/register")->withInput()->with("error", $rp['message']);
            else if ($rp['reponse'] == 1) {
                $user = $rp['message'];
                \Auth::loginUsingId($user->id);
                return redirect('candidat/mon-compte');
            }
        }
        else {
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
            return view('front.candidat.formulaire')->with('user', $user);
        }
    }

}
