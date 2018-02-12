<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Country;
use App\Http\Models\Entreprise;
use App\Http\Models\EntrepriseDetails;
use App\Http\Models\User;
use App\Http\Models\Help;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class UserController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function reset_password(Request $request) {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
            if (is_null($user))
                return view('front.users.reset')->with("error", "Aucun compte ne correspond à cette adresse e-mail.");

            $reset_password_token = str_random(20);
            $user->reset_password_token = $reset_password_token;
            $user->save();

            $param = ['reset_password_token' => $reset_password_token, 'email' => $email, 'name' => $user->name];

            \Mail::send('emails.reset', ['param' => $param], function ($message) use ($request, $user) {
                $message->from("user@piaafrica.com", $request->input('nom'));
                $message->to($request->input('email'), $user->name)->subject("Instructions de réinitialisation de votre mot de passe PIA AFRICA");
            });

            return view('front.users.reset')->with('succes', "Vous allez bientôt recevoir un mail à l'adresse " . $email . "  vous donnant toutes les informations necessaires à la modification de votre mot de passe");
        }
        else
            return view('front.users.reset');
    }

    public function reset_password_token(Request $request) {

        $reset_password_token = $request->get('reset_password_token');
        $email = $request->get('email');
        if ($request->isMethod('post')) {
            $reset_password_token = $request->input('reset_password_token');
            $email = $request->input('email');
            $pass = \Hash::make($request->input('password'));
            $user = User::where('reset_password_token', $reset_password_token)->where('email', $email)->first();
            if (!is_null($user)) {
                $user->password = $pass;
                $user->save();
                \Auth::loginUsingId($user->id);
                return redirect('mon-compte');
            }
            else
                return view('front.users.reset_token')->with('reset_password_token', $reset_password_token)->with('email', $email);
        }
        else {
            return view('front.users.reset_token')->with('reset_password_token', $reset_password_token)->with('email', $email);
        }

    }

    public function login(Request $request) {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');
            if (\Auth::attempt($credentials, $request->has('remember'))) {
                if (\Auth::user()->droit == config('application.candidat'))
                    return redirect()->to('candidat/mon-compte');
                elseif (\Auth::user()->droit >= config('application.contact'))
                    return redirect()->to('mon-compte');
            }
            return redirect('se-connecter')
                ->withInput($request->only('email'))
                ->withErrors(['error' => 'Email ou mot de passe incorrect']);
        }
        else {
            return view('front.users.login');
        }
    }

    public function logout() {
        \Auth::logout();
        return redirect('/');
    }

}
