<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Pub;

use App\Http\Models\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PubController extends Controller {

    public function __construct() {
        $this->middleware('administration');
    }

    public function getPubs(Request $request, $id = 0) {
        $pub = new Pub;
        $pubs = Pub::latest()->get();
        if (count($request->old())) { // redirection après validation incorrect
            $pub = $pub->fill($request->old());
        }
        return view('admin.pub.pub')->with('pubs', $pubs)->with('pub', $pub);
    }

    public function getPub(Request $request, $id) {
        $pub = Pub::find($id);
        $pubs = Pub::all();
        if ($pub == null)
            $pub = new Pub();
        return view('admin.pub.pub')->with('pub', $pub)->with('pubs', $pubs);
    }

    public function getPubDelete($id, $media, Request $request) {
        //$ids = $request->input($id);
        $pub = Pub::find($id);
        if ($pub != null) {
            $pub->delete();
            if (\File::exists('uploads/pub/' . $media))
                \File::delete('uploads/pub/' . $media);
        }
        return redirect('admin/pubs/pubs');
    }

    public function postCreatePub(Request $request) {
        if ($request->isMethod('post')) {
            $validator = \Validator::make($request->all(), Pub::$rules);
            if ($validator->fails()) {
                return redirect('admin/pubs/pubs/' . $request->input('id'))->withInput()->withErrors($validator->messages());
            }
            $extension = array('png', 'gif', 'jpg', 'jpeg');
            $fileName = Help::upload( 'fichier', 'pub/', 500000, $extension);
            if ($fileName != null)
                $request->merge(array('image' => $fileName));
            $request = Help::publie($request);
            Pub::create($request->all());
            return redirect('admin/pubs/pubs');
        }
    }

    public function putUpdatePub(Request $request) {
        if ($request->isMethod('put')) {
            $id = $request->input('id');
            $validator = \Validator::make($request->all(), Pub::$rules);
            if ($validator->fails()) {
                return redirect('admin/pubs/pubs/' . $request->input('id'))->withInput()->withErrors($validator->messages());
            }
            $request = Help::publie($request);
            $pub = Pub::find($id);
            $extension = array('png', 'gif', 'jpg', 'jpeg');
            $fileName = Help::upload( 'fichier', 'pub/', 500000, $extension);
            if ($fileName != null)
                $request->merge(array('image' => $fileName));
            $request = Help::publie($request);
            $pub->update($request->all());
            return redirect('admin/pubs/pubs');

        }
    }
}
