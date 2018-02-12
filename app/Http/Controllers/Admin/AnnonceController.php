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
use App\Http\Models\Annonce;
use App\Http\Models\Entreprise;
use App\Http\Models\Section;
use App\Http\Models\User;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class AnnonceController extends Controller {

    public function __construct() {
        $this->paginate = config('application.paginate');
    }

    public function getIndex() {
        $annonces = Annonce::with('entreprise', 'section')->orderBy('id', 'desc')->paginate($this->paginate);
        $annonces->setPath('');
        $sections = Section::orderBy('section')->get();
        $countries = Country::all();
        $entreprises = Entreprise::orderBy('name')->get();
        $data = array('annonces' => $annonces, 'sections' => $sections, 'countries' => $countries, 'entreprises' => $entreprises);
        return view('admin.annonces.annonces', $data);
    }

    public function getAnnonceAction(Request $request) {
        $sections = Section::all();
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $posts = $request->input('post');
            if ($action == -1)
                Annonce::supprimerWithMessage($posts);
            elseif ($action == 1)
                Annonce::publier($posts);
            elseif ($action == 0)
                Annonce::depublier($posts);
            elseif ($action == 2)
                Annonce::setUne($posts);
            elseif ($action == -2)
                Annonce::normal($posts);
            return redirect('admin/annonces');
        }
        elseif ($request->input('doaction') == 'Filtrer') {
            $une = $request->input('une');
            $titre = $request->input('titre');
            $publie = $request->input('publie');
            $ville_id = $request->input('ville_id');
            $country_id = $request->input('country_id');
            $section_id = $request->get('section_id');
            $entreprise_id = $request->get('entreprise_id');
            $query = Annonce::with('user', 'section');

            if (is_numeric($une))
                $query->position($une);
            if (is_numeric($publie))
                $query->online($publie);
            if (is_numeric($section_id))
                $query->section($section_id);
            if (!empty($titre))
                $query->keyword($titre);
            if (is_numeric($ville_id))
                $query->ville($ville_id);
            if (is_numeric($country_id))
                $query->country($country_id);
            if (is_numeric($entreprise_id))
                $query->entreprise($entreprise_id);

            $order = $request->input('order');
            $path = array(
                "action" => $request->get('action'),
                "titre" => $titre,
                "publie" => $publie,
                "une" => $une,
                "ville_id" => $ville_id,
                "section_id" => $section_id,
                "entreprise_id" => $entreprise_id,
                "order" => $order,
                "doaction" => 'Filtrer',
            );

            $annonces = $query->orderByRaw($order)->paginate($this->paginate)->appends($path);

            //$villes = Ville::orderBy('ville')->limit(150)->get();
            $countries = Country::all();
            $entreprises = Entreprise::orderBy('name')->get();
            $data = array('annonces' => $annonces, 'sections' => $sections, 'countries' => $countries, 'entreprises' => $entreprises);
            return view('admin.annonces.annonces', $data);
        }

    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {
            return Annonce::store($request, 'admin/annonces/edit/');
        }
    }

    public function getEdit(Request $request, $id = 0) {
        $annonce = new Annonce();

        $sections = Section::orderBy('section')->get();
        $entreprises = Entreprise::orderBy('name')->get();
        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $annonce = $annonce->fill($request->old());
        }
        else {
            $annonce = Annonce::find($id);
            if ($annonce == null) {
                $annonce = new Annonce();
            }
        }
        $countries = Country::all();
        if ($id != 0)
            $villes = Ville::where('country_id', $annonce->ville->country_id)->orderBy('ville')->get();
        else
            $villes = Ville::orderBy('ville')->get();
        return view('admin.annonces.formulaire')->with('sections', $sections)->with('annonce', $annonce)->with('countries', $countries)->with('villes', $villes)->with('entreprises', $entreprises);
    }

    public function getDelete($id) {
        $annonce = Annonce::find($id);
        Annonce::supprimer($annonce);
        return redirect('admin/annonces');
    }

}
