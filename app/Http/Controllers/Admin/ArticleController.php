<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Article;
use App\Http\Models\Entreprise;
use App\Http\Models\Section;
use App\Http\Models\Ville;
use Illuminate\Http\Request;

class ArticleController extends Controller {

    public function __construct() {
        $this->paginate = config('application.paginate');
        $this->pro = config('application.professionel');
        $this->filesize = config('application.image_size');
    }

    public function getIndex() {
        $articles = Article::with('entreprises', 'section')->orderBy('id', 'desc')->paginate($this->paginate);
        $articles->setPath('');
        $sections = Section::orderBy('section')->get();
        $villes = Ville::orderBy('ville')->get();
        $data = array('articles' => $articles, 'sections' => $sections, 'villes' => $villes);
        return view('admin.articles.articles', $data);
    }

    public function getArticleAction(Request $request) {
        $sections = Section::all();
        if ($request->input('doaction') == 'Appliquer') {
            $action = $request->input('action');
            $posts = $request->input('post');
            if ($action == -1)
                Article::supprimerWithMessage($posts);
            elseif ($action == 1)
                Article::publier($posts);
            elseif ($action == 0)
                Article::depublier($posts);
            elseif ($action == 2)
                Article::setUne($posts);
            elseif ($action == -2)
                Article::normal($posts);
            return redirect('admin/articles');
        }
        elseif ($request->input('doaction') == 'Filtrer') {
            $titre = $request->input('titre');
            $une = $request->input('une');
            $publie = $request->input('publie');
            $section_id = $request->get('section_id');
            $query = Article::with('entreprises', 'section');

            if (is_numeric($publie))
                $query->online($publie);
            if (is_numeric($une))
                $query->position($une);
            if (is_numeric($section_id))
                $query->section($section_id);
            if (!empty($titre))
                $query->keyword($titre);

            $order = $request->input('order');

            $path = array(
                "action" => $request->get('action'),
                "titre" => $titre,
                "publie" => $publie,
                "une" => $une,
                "section_id" => $section_id,
                "order" => $order,
                "doaction" => 'Filtrer',
            );

            $articles = $query->orderByRaw($order)->paginate($this->paginate)->appends($path);

            $data = array('articles' => $articles, 'sections' => $sections);
            return view('admin.articles.articles', $data);
        }

    }

    public function postStore(Request $request) {
        if ($request->isMethod('post')) {
            return Article::store($request, 'admin/articles/edit/');
        }
    }

    public function getEdit(Request $request, $id = 0) {
        $article = new Article();
        $sections = Section::orderBy('section')->get();
        $entreprises = Entreprise::select('id', 'name')->get();

        if (count($request->old()) && $id == 0) { // redirection après validation incorrect
            $article = $article->fill($request->old());
        }
        else {
            $article = Article::find($id);
            if ($article == null) {
                $article = new Article();
            }
        }
        $articleentreprises = $article->entreprises()->lists('name', 'id');
        return view('admin.articles.formulaire')->with('sections', $sections)->with('article', $article)->with('entreprises', $entreprises)->with('articleentreprises', $articleentreprises);
    }

    public function getDelete($id) {
        $article = Article::find($id);
        Article::supprimer($article);
        return redirect('admin/articles');
    }

}
