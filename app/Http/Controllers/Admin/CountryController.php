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

use App\Http\Models\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryController extends Controller {

    public function __construct() {
        $this->middleware('administration');
    }

    //PAYS
    public function getCountry($id = 0) {
        $country = new Country();
        if ($id != 0)
            $country = Country::find($id);
        $countrys = Country::orderBy('pays')->get();

        return view('admin.reglages.country')->with('countrys', $countrys)->with('country', $country);
    }

    public function getCountrys($id = 0) {
        $country = new Country();
        $countrys = Country::orderBy('pays')->get();
        if ($country == null)
            $country = new Country();
        return view('admin.reglages.country')->with('countrys', $countrys)->with('country', $country);
    }

    public function postCreateCountry(Request $request) {
        if ($request->isMethod('post')) {
            $error = "";
            if (Help::checkObject(new Country(), 'pays', $request->input('pays'), $request->input('id', 0)))
                $error = "Pays déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect("admin/countrys/countrys")->withInput()->with("error", $error);

            $extension = array('png', 'gif', 'jpg', 'jpeg');

            if ($request->hasFile('fichier')) {
                $fileName = Help::upload('fichier', 'pays/', config('application.image_size'), $extension);
                if ($fileName != null)
                    $request->merge(array('carte' => $fileName));
            }
            $request->merge(array('slug' => Str::slug($request->input('pays'))));

            Country::create($request->all());
            return redirect('admin/countrys/countrys');
        }
    }

    public function putUpdateCountry(Request $request) {
        if ($request->isMethod('put')) {
            $error = "";
            if (Help::checkObject(new Country(), 'pays', $request->input('pays'), $request->input('id', 0)))
                $error = "Pays déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect("admin/countrys/countrys")->withInput()->with("error", $error);

            $extension = array('png', 'gif', 'jpg', 'jpeg');

            if ($request->hasFile('fichier')) {
                $fileName = Help::upload('fichier', 'pays/', config('application.image_size'), $extension);
                if ($fileName != null)
                    $request->merge(array('carte' => $fileName));
            }
            $request->merge(array('slug' => Str::slug($request->input('pays'))));
            $id = $request->input('id');
            Country::find($id)->update($request->all());
            return redirect('admin/countrys/countrys');
        }
    }

    public function getCountryDelete($id, Request $request) {
        //$ids = $request->input($id);
        Country::destroy($id);
        return redirect('admin/countrys/countrys');
    }
}
