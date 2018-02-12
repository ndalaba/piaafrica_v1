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
use App\Http\Models\Ville;
use App\Http\Models\Categorie;

use App\Http\Models\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VilleController extends Controller {

    public function __construct() {
        $this->middleware('administration');
    }

    //VILLES
    public function getVilles($id = 0) {
        $ville = new Ville();
        if ($id != 0)
            $ville = Ville::find($id);
        $villes = Ville::with('country')->orderBy('ville')->get();
        $countries= Country::orderBy('pays')->get();

        return view('admin.reglages.ville')->with('ville', $ville)->with('villes', $villes)->with('countries',$countries);
    }

    public function getVille($id = 0) {
        $ville = Ville::find($id);
        $villes = Ville::with('country')->orderBy('ville')->get();
        if ($ville == null)
            $ville = new Ville();
        $countries= Country::orderBy('pays')->get();
        return view('admin.reglages.ville')->with('ville', $ville)->with('villes', $villes)->with('countries',$countries);
    }

    public function postCreateVille(Request $request) {
        if ($request->isMethod('post')) {
            $error = "";
            if (Help::checkObject(new Ville(), 'ville', $request->input('ville'), $request->input('id', 0)))
                $error = "Ville déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect("admin/villes/ville")->withInput()->with("error", $error);

            Ville::create($request->all());
            return redirect('admin/villes/villes');
        }
    }

    public function putUpdateVille(Request $request) {
        if ($request->isMethod('put')) {
            $error = "";
            if (Help::checkObject(new Ville(), 'ville', $request->input('ville'), $request->input('id', 0)))
                $error = "Ville déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect("admin/villes/ville")->withInput()->with("error", $error);

            $id = $request->input('id');
            Ville::find($id)->update($request->all());
            return redirect('admin/villes/villes');
        }
    }

    public function getVilleDelete($id, Request $request) {
        //$ids = $request->input($id);
        Ville::destroy($id);
        return redirect('admin/villes/villes');
    }
}
