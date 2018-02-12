<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 13/10/16
 * Time: 10:48
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Country;
use App\Http\Models\Help;
use App\Http\Models\Lettre;
use App\Http\Models\Newsletter;
use Illuminate\Http\Request;


class NewsletterController extends BaseController {

    public function opened($id) {
        $lettre = Lettre::find($id);
        $lettre->vue += 1;
        $lettre->save();
    }

    public function unsubscribe($value) {
        $email = Help::decode($value);
        Newsletter::where('email', $email)->update(['publie' => 0]);
        return view('front.unsubscribe');
    }

    public function subscribe(Request $request) {
        if ($request->isMethod('post')) {
            $validator = \Validator::make($request->all(), ['email' => 'required|email']);
            if ($validator->fails()) {
                return json_encode(array('response' => 0, "message" => "Entrer une adresse email valide"));
            }
            $error = "";
            if (Help::checkObject(new Newsletter(), 'email', $request->input('email'), 0))
                $error = "Adresse déja enregistrée";

            if (strlen(trim($error)) > 0)
                return json_encode(array('response' => 0, "message" => $error));
            $userCountry = \Session::get('country');
            if ($userCountry !== null) {
                $country = Country::where('code', $userCountry->countryCode)->first();
                $request->merge(['country_id' => $country->id]);
            }
            $request->merge(['publie' => 1]);
            Newsletter::create($request->all());

            return json_encode(array('response' => 1, "message" => "Adresse enregistrée"));

        }
    }
}