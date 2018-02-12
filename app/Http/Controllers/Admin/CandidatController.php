<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Country;
use App\Http\Models\Entreprise;
use App\Http\Models\Candidat;
use App\Http\Models\Help;
use App\Http\Models\Section;
use App\Http\Models\User;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class CandidatController extends Controller {

    public function __construct() {
        $this->middleware('administration');
        $this->paginate = config('application.paginate');
        $this->pro = config('application.candidat');
    }

    public function getIndex() {
        /*$activites = Activite::where('type_id', $type->id)->online()->orderBy('id', 'desc')->simplePaginate($this->paginate);
        $activites->setPath($slug);*/
        $candidats = User::with('candidat')->where('droit', $this->pro)->orderBy('id', 'desc')->paginate($this->paginate);
        $candidats->setPath('');
        $data = array('candidats' => $candidats);
        return view('admin.candidats.candidats', $data);
    }

    public function postCandidatAction(Request $request) {
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $ids = $request->input('post');
            if ($action == 'trash')
                User::destroy($request->input('post'));
            return redirect('admin/candidats');
        }
        elseif ($request->input('doaction') == 'Filtrer') {
            $email = $request->input('email');
            $type = $request->get('candidat');
            $query = User::with('candidat')->where('droit', '<=', $this->pro);

            if (!empty($email))
                $query->byEmail($email);
            if (!empty($type))
                $query->byType($type);

            $candidats = $query->paginate($this->paginate);
            //$candidats= User::with('candidat')->where('droit','<',$this->pro)->where('email',$request->input('email'))->get();

            $data = array('candidats' => $candidats);
            return view('admin.candidats.candidats', $data);
        }

    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {

            $candidat = new User;
            $validator = \Validator::make($request->all(), User::$rules);
            if ($validator->fails()) {
                return redirect('admin/candidats/edit/' . $request->input('id'))->withInput()->withErrors($validator->messages());
            }

            //$request= Help::upload($request,'file','images/');
            $error = "";
            if (Help::checkObject(new User(), 'email', $request->input('email'), $request->input('id', 0)))
                $error = "Adresse email déja enregistrée";

            if (Help::checkObject(new User(), 'phone', $request->input('phone'), $request->input('id', 0)))
                $error = "Numéro de téléphone déja enregistré";

            if (strlen(trim($error)) > 0)
                return view('admin.candidats.formulaire', ['candidat' => $candidat, 'error' => $error]);

            $pass = ($request->input('password') == "") ? $request->input('lastpass') : \Hash::make($request->input('password'));
            $request->merge(['password' => $pass]);

            if ($request->has('id')) {
                $candidat = User::find($request->input('id'));
                $candidat->update($request->all());
            }
            else
                $candidat = User::create($request->all());

            return view('admin.candidats.formulaire', ['candidat' => $candidat, 'success' => 1]);
        }
    }


    public function getEdit(Request $request, $id = 0) {
        $candidat = new User();

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $candidat = $candidat->fill($request->old());
        }
        else {
            $candidat = User::find($id);

            if ($candidat == null) {
                $candidat = new User();
            }
        }
        $countries = Country::all();
        $villes = Ville::where('country_id', $candidat->ville->country->id)->get();
        return view('admin.candidats.formulaire')->with('candidat', $candidat)->with('countries',$countries)->with('villes',$villes);
    }

    public function getDelete($id) {
        $candidat = User::find($id);
        $candidat->delete();
        return redirect('admin/candidats');
    }

}
