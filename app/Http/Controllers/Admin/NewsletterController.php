<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Lettre;
use App\Http\Models\Country;
use App\Http\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller {

    public function __construct() {
        $this->middleware('administration');
        $this->paginate = config('application.paginate');
        $this->pro = config('application.professionel');
        $this->filesize = config('application.image_size');
    }

    public function getIndex() {
        $lettres = Lettre::orderBy('id', 'desc')->paginate($this->paginate);
        $lettres->setPath('');
        $countries = Country::all();
        $data = array('lettres' => $lettres, 'countries' => $countries);
        return view('admin.lettres.lettres', $data);
    }

    public function getSubscribe() {
        $countries = Country::all();
        return view('admin.lettres.subscribe')->with('countries', $countries);
    }

    public function postSubscribe(Request $request) {
        if ($request->isMethod('post')) {
            $emails = explode(';', $request->input('emails'));
            $emails = array_map('trim', $emails);
            $emails=array_unique($emails);
            $data = array();
            foreach ($emails as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $values = Newsletter::select('id')->where('email', $email)->count('id');
                    if (!$values)
                        $data[] = array('email' => $email, 'country_id' => $request->input('country_id'), 'publie' => 1);
                }
            }
            Newsletter::insert($data);
            $countries = Country::all();
            return view('admin.lettres.subscribe')->with('countries', $countries);

        }
        else {
            $countries = Country::all();
            return view('admin.lettres.subscribe')->with('countries', $countries);
        }
    }

    public function getLettreAction(Request $request) {
        $countries = Country::all();
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $posts = $request->input('post');
            $n = $request->input('nombre');
            if ($action == -1)
                Lettre::supprimerWithMessage($posts);
            elseif ($action == 1)
                Lettre::publier($posts, $n);
            return redirect('admin/lettres');
        }
        elseif ($request->input('doaction') == 'Filtrer') {
            $titre = $request->input('titre');
            $publie = $request->input('publie');
            $country_id = $request->get('country_id');
            $query = Lettre::with('country');

            if (is_numeric($publie))
                $query->online($publie);
            if (is_numeric($country_id))
                $query->country($country_id);
            if (!empty($titre))
                $query->keyword($titre);

            $order = $request->input('order');

            $path = array(
                "action" => $request->get('action'),
                "titre" => $titre,
                "publie" => $publie,
                "country_id" => $country_id,
                "order" => $order,
                "doaction" => 'Filtrer',
            );

            $lettres = $query->orderByRaw($order)->paginate($this->paginate)->appends($path);

            $data = array('lettres' => $lettres, 'countries' => $countries);
            return view('admin.lettres.lettres', $data);
        }

    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {
            return Lettre::store($request, 'admin/lettres/edit/');
        }
    }

    public function getEdit(Request $request, $id = 0) {
        $lettre = new Lettre();
        $countries = Country::all();

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $lettre = $lettre->fill($request->old());
        }
        else {
            $lettre = Lettre::find($id);
            if ($lettre == null) {
                $lettre = new Lettre();
            }
        }
        return view('admin.lettres.formulaire')->with('countries', $countries)->with('lettre', $lettre);
    }

    public function getDelete($id) {
        $lettre = Lettre::find($id);
        Lettre::supprimer($lettre);
        return redirect('admin/lettres');
    }

    public function getEmails() {
        $emails = Newsletter::orderBy('id', 'desc')->paginate(20);
        $countries = Country::all();
        $data = array('emails' => $emails, 'countries' => $countries);
        return view('admin.lettres.emails', $data);
    }

    public function getEmailAction(Request $request) {
        $countries = Country::all();
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $posts = $request->input('post');
            if ($action == 0)
                Newsletter::depublier($posts);
            return redirect('admin/lettres/emails');
        }
        elseif ($request->input('doaction') == 'Filtrer') {
            $email = $request->input('email');
            $publie = $request->input('publie');
            $country_id = $request->get('country_id');
            $query = Newsletter::with('country');

            if (is_numeric($publie))
                $query->online($publie);
            if (is_numeric($country_id))
                $query->country($country_id);
            if (!empty($email))
                $query->keyword($email);

            $path = array(
                "action" => $request->get('action'),
                "email" => $email,
                "publie" => $publie,
                "country_id" => $country_id,
                "doaction" => 'Filtrer',
            );

            $emails = $query->orderBy('id', 'desc')->paginate(20)->appends($path);

            $data = array('emails' => $emails, 'countries' => $countries);
            return view('admin.lettres.emails', $data);
        }

    }

}
