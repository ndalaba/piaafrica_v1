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
use App\Http\Models\Service;
use App\Http\Models\Entreprise;
use App\Http\Models\Section;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class ServiceController extends Controller {

    public function __construct() {
        $this->middleware('administration');
        $this->paginate = config('application.paginate');
        $this->filesize = config('application.image_size');
    }

    public function getIndex() {
        $services = Gservice::orderBy('id', 'desc')->paginate($this->paginate);
        $services->setPath('');
        $data = array('services' => $services,);
        return view('admin.services.services', $data);
    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {
            return Gservice::store($request, 'admin/services/edit/');
        }
    }

    public function getEdit(Request $request, $id = 0) {
        $service = new Gservice();

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $service = $service->fill($request->old());
        }
        else {
            $service = Gservice::find($id);
            if ($service == null) {
                $service = new Gservice();
            }
        }
        return view('admin.services.formulaire')->with('service', $service);
    }

    public function getDelete($id) {
        $service = Gservice::find($id);
        Gservice::supprimer($service);
        return redirect('admin/services');
    }

}
