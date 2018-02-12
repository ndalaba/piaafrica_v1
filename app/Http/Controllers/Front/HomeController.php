<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Gservice;
use App\Http\Models\Help;
use App\Http\Models\Newsletter;
use App\Http\Models\Realisation;
use App\Http\Models\Article;
use Illuminate\Http\Request;

class HomeController extends BaseController {
    var $paginate;

    public function __construct() {
        parent::__construct();
        $this->paginate = config('application.paginate');
    }

    public function index() {
        $articles = Article::with('section')->online()->orderBy('id', 'desc')->limit(3)->get();
        $data = array('articles' => $articles);
        return view('front.home', $data);
    }

    public function about() {
        return view('front.about');
    }

    public function regles() {
        return view('front.regles');
    }

    public function faq() {
        return view('front.faq');
    }

    public function apropos() {
        return view('front.apropos');
    }

    public function contact(Request $request) {
        if ($request->isMethod('post')) {
            $validator = \Validator::make($request->all(), ['email' => 'required|email', 'nom' => 'required', 'sujet' => 'required', 'message' => 'required']);
            if ($validator->fails()) {
                return redirect('nous-contacter')->withInput()->withErrors($validator->messages());
            }

            \Mail::send('emails.contact', ['request' => $request->all()], function ($message) use ($request) {
                $message->from($request->input('email'), $request->input('nom'));
                $message->to('contact@piaafrica.com', config('application.name'))->subject($request->input('sujet'));
            });
            return view('front.contact')->with('success', 'Message envoyé');
        }
        else
            return view('front.contact');
    }

}
