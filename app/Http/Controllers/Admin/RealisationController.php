<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Gservice;
use App\Http\Models\Realisation;
use App\Http\Models\Entreprise;
use App\Http\Models\Section;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class RealisationController extends Controller {

    public function __construct() {
        $this->middleware('administration');
        $this->paginate = config('application.paginate');
        $this->pro = config('application.professionel');
        $this->filesize = config('application.image_size');
    }

    public function getIndex() {
        $realisations = Realisation::with('service')->orderBy('id', 'desc')->paginate($this->paginate);
        $realisations->setPath('');
        $services = Gservice::all();
        $data = array('realisations' => $realisations, 'services' => $services);
        return view('admin.realisations.realisations', $data);
    }

    public function getRealisationAction(Request $request) {
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $posts = $request->input('post');
            if ($action == -1)
                Realisation::supprimerWithMessage($posts);
            elseif ($action == 1)
                Realisation::publier($posts);
            elseif ($action == 0)
                Realisation::depublier($posts);
            return redirect('admin/realisations');
        }
        elseif ($request->input('doaction') == 'Filtrer') {
            $titre = $request->input('titre');
            $service_id = $request->get('gservice_id');
            $query = Realisation::with('service');

            if (is_numeric($service_id))
                $query->service($service_id);

            $realisations = $query->orderBy('id', 'desc')->paginate($this->paginate);
            $realisations->setPath('');

            $services = Gservice::all();
            $data = array('realisations' => $realisations, 'services' => $services);
            return view('admin.realisations.realisations', $data);
        }

    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {
            return Realisation::store($request, 'admin/realisations/edit/');
        }
    }

    public function getEdit(Request $request, $id = 0) {
        $realisation = new Realisation();

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $realisation = $realisation->fill($request->old());
        }
        else {
            $realisation = Realisation::find($id);
            if ($realisation == null) {
                $realisation = new Realisation();
            }
        }
        $services = Gservice::all();
        $data = array('realisation' => $realisation, 'services' => $services);
        return view('admin.realisations.formulaire', $data);
    }

    public function getDelete($id) {
        $realisation = Realisation::find($id);
        Realisation::supprimer($realisation);
        return redirect('admin/realisations');
    }

}
