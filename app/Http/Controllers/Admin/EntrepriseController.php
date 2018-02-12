<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Contact;
use App\Http\Models\Country;
use App\Http\Models\Entreprise;
use App\Http\Models\Section;
use App\Http\Models\User;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class EntrepriseController extends Controller {

    public function __construct() {        
        $this->paginate = config('application.paginate');
        $this->filesize = config('application.image_size');
    }

    public function getIndex() {
        $entreprises = Entreprise::with('user', 'section')->orderBy('id', 'desc')->paginate($this->paginate);
        $entreprises->setPath('');
        $sections = Section::orderBy('section')->get();
        $countries = Country::all();
        $counts = Entreprise::select('id')->count('id');
        $data = array('entreprises' => $entreprises, 'sections' => $sections, 'countries' => $countries, 'recap' => $counts . ' au total');
        return view('admin.entreprises.entreprises', $data);
    }

    public function getEntrepriseAction(Request $request) {

        $sections = Section::all();
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $posts = $request->input('post');
            if ($action == -1)
                Entreprise::supprimerWithMessage($posts);
            elseif ($action == 1)
                Entreprise::publier($posts);
            elseif ($action == 0)
                Entreprise::depublier($posts);
            elseif ($action == 2)
                Entreprise::setUne($posts);
            elseif ($action == -2)
                Entreprise::normal($posts);
            return redirect('admin/entreprises');
        }
        elseif ($request->input('doaction') == 'Filtrer') {

            $une = $request->input('une');
            $name = $request->input('name');
            $publie = $request->input('publie');
            $ville_id = $request->input('ville_id');
            $country_id = $request->input('country_id');
            $section_id = $request->get('section_id');
            $query = Entreprise::with('user', 'section');

            if (is_numeric($une))
                $query->position($une);
            if (is_numeric($publie))
                $query->online($publie);
            if (is_numeric($section_id))
                $query->section($section_id);
            if (!empty($name))
                $query->keyword($name);
            if (is_numeric($ville_id))
                $query->ville($ville_id);
            if (is_numeric($country_id))
                $query->country($country_id);

            $order = $request->input('order');
            $path = array(
                "action" => $request->get('action'),
                "name" => $name,
                "publie" => $publie,
                "une" => $une,
                "country_id" => $country_id,
                "ville_id" => $ville_id,
                "section_id" => $section_id,
                "order" => $order,
                "doaction" => 'Filtrer',
            );

            $entreprises = $query->orderByRaw($order)->paginate($this->paginate)->appends($path);
            $countries = Country::all();
            $recap = $entreprises->total() . ' au total';
            $data = array('entreprises' => $entreprises, 'sections' => $sections, 'countries' => $countries, 'recap' => $recap);
            return view('admin.entreprises.entreprises', $data);
        }

    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {
            if (!empty(trim($request->input('contact_email')))) {
                $user = User::where('email', $request->input('contact_email'))->first();
                if ($user != null && count($user->entreprise) == 0)
                    $request->merge(array('user_id' => $user->id));
                //else
                // return redirect('admin/entreprises/edit/' . $request->input('user_id') . '/' . $request->input('entreprise_id'))->withInput()->with("error", "Ce contact a déja une entreprise");
            }
            else
                $request->merge(array('user_id' => 0));
            return Entreprise::store($request, 'admin/entreprises/edit/' . $request->input('user_id') . '/');
        }

    }

    public function getEdit(Request $request, $contact_id = 0, $id = 0) {
        $entreprise = new Entreprise();
        $contact = User::find($contact_id);
        if ($contact == null) {
            $contact = new Contact();
            $contact->id = 0;
            $contact->email = "";
        }

        $sections = Section::orderBy('section')->get();
        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $entreprise = $entreprise->fill($request->old());
        }
        else {
            $entreprise = Entreprise::find($id);
            if ($entreprise == null) {
                $entreprise = new Entreprise();
            }
        }
        $countries = Country::all();
        if ($id != 0)
            $villes = Ville::where('country_id', $entreprise->adress->ville->country_id)->orderBy('ville')->get();
        else
            $villes = Ville::orderBy('ville')->get();
        return view('admin.entreprises.formulaire')->with('sections', $sections)->with('entreprise', $entreprise)->with('countries', $countries)->with('contact', $contact)->with('villes', $villes)->with('adresse', $entreprise->adress);
    }

    public function getDelete($id) {
        $entreprise = Entreprise::find($id);
        Entreprise::supprimer($entreprise);
        return redirect('admin/entreprises');
    }

}
