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
use App\Http\Models\Contact;
use App\Http\Models\Help;
use App\Http\Models\Section;
use App\Http\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller {

    public function __construct() {
        $this->middleware('administration');
        $this->paginate = config('application.paginate');
        $this->contact = config('application.contact');
        $this->annonceur = config('application.annonceur');
    }

    public function getIndex() {
        /*$activites = Activite::where('type_id', $type->id)->online()->orderBy('id', 'desc')->simplePaginate($this->paginate);
        $activites->setPath($slug);*/
        $contacts = User::with('entreprises')->whereRaw("droit BETWEEN ".$this->contact." AND ".$this->annonceur)->orderBy('id', 'desc')->paginate($this->paginate);
        $contacts->setPath('');
        $countries= Country::all();
        $data = array('contacts' => $contacts,'countries'=>$countries);
        return view('admin.contacts.contacts', $data);
    }

    public function getContactAction(Request $request) {
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $posts = $request->input('post');
            if ($action == 'trash')
                User::destroy($posts);
            elseif($action==config('application.contact'))
                User::setContact($posts);
            elseif($action==config('application.annonceur'))
                User::setAnnonceur($posts);
            return redirect('admin/contacts');
        }
        elseif ($request->input('doaction') == 'Filtrer') {
            $email = $request->input('email');
            $name = $request->get('name');
            $type = $request->get('type');
            $country_id = $request->input('country_id');
            $query = User::with('entreprises')->whereRaw("droit BETWEEN ".$this->contact." AND ".$this->annonceur);

            if (!empty($email))
                $query->byEmail($email);
            if (!empty($name))
                $query->byName($name);
            if (!empty($type))
                $query->byType($type);
            if (is_numeric($country_id))
                $query->country($country_id);

            $path = array(
                "_token" => $request->get('_token'),
                "name" => $name,
                "email" => $email,
                "type" => $type,
                "country_id"=>$country_id,
                "doaction" => 'Filtrer',
            );
            $contacts = $query->orderBy('id', 'desc')->paginate($this->paginate)->appends($path);
            $countries= Country::all();

            $data = array('contacts' => $contacts,'countries'=>$countries);
            return view('admin.contacts.contacts', $data);
        }

    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {

            $contact = new User;
            $validator = \Validator::make($request->all(), User::$rules);
            if ($validator->fails()) {
                return redirect('admin/contacts/edit/' . $request->input('id'))->withInput()->withErrors($validator->messages());
            }

            //$request= Help::upload($request,'file','images/');
            $error = "";
            if (Help::checkObject(new User(), 'email', $request->input('email'),$request->input('id',0)))
                $error = "Adresse email déja enregistrée";

            if (Help::checkObject(new User(), 'phone', $request->input('phone'),$request->input('id',0)))
                $error = "Numéro de téléphone déja enregistré";

            if (strlen(trim($error)) > 0)
                return view('admin.contacts.formulaire', ['contact' => $contact, 'error' => $error]);

            $pass = ($request->input('password') == "") ? $request->input('lastpass') : \Hash::make($request->input('password'));
            $request->merge(['password' => $pass]);

            if ($request->has('id')) {
                $contact = User::find($request->input('id'));
                $contact->update($request->all());
            } else
                $contact = User::create($request->all());

            return view('admin.contacts.formulaire', ['contact' => $contact, 'success' => 1]);
        }
    }


    public function getEdit(Request $request, $id = 0) {
        $contact = new User();

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $contact = $contact->fill($request->old());
        }
        else {
            $contact = User::find($id);

            if ($contact == null) {
                $contact = new User();
            }
        }
        return view('admin.contacts.formulaire')->with('contact', $contact);
    }

    public function getDelete($id) {
        $contact = User::find($id);
        $contact->delete();
        return redirect('admin/contacts');
    }

}
