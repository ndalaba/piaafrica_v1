<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Http\Models\Article;
use App\Http\Models\Entreprise;
use App\Http\Models\Section;

class ArticleController extends BaseController {
    var $paginate;

    public function __construct() {
        parent::__construct();
        $this->paginate = config('application.paginate');
    }

    public function actualites($slug = null) {
        if ($slug == null) {
            $articles = Article::with('section')->online()->orderBy('id', 'desc')->paginate($this->paginate);
            $articles->setPath('actualites');
            $titre = "";
        }
        else {
            $section = Section::where('slug', $slug)->first();
            if ($section != null) {
                $articles = Article::with('section')->where('section_id', $section->id)->online()->orderBy('id', 'desc')->paginate($this->paginate);
                $articles->setPath('actualites/' . $section->slug);
                $titre = ' - ' . $section->section;
            }
            else {
                $entreprise = Entreprise::where('slug', $slug)->first();
                if ($entreprise != null) {
                    $articles = Article::with('section')->whereHas('entreprises', function ($q) use ($entreprise) {
                        $q->where('slug', $entreprise->slug);
                    })->online()->orderBy('id', 'desc')->paginate($this->paginate);
                    $articles->setPath('actualites/' . $entreprise->slug);
                    $titre = ' - ' . $entreprise->name;
                }
            }
        }
        $data = ['articles' => $articles, 'titre' => $titre];
        return view('front.articles.articles', $data);
    }

    public function actualite($section = null, $slug = null) {
        $article = Article::with('section')->online()->where('slug', $slug)->first();
        if (is_null($article))
            return redirect('actualites');

        $article->vue += 1;
        $article->save();

        $data = array('article' => $article);
        return view('front.articles.article', $data);
    }

    /* public function entreprises($entreprise = null) {
         if ($entreprise == null) {
             $articles = Article::with('section')->online()->orderBy('id', 'desc')->paginate($this->paginate);
             $articles->setPath('actualites');
         }
         else {
             //  $entreprise = Entreprise::where('slug', $entreprise)->first();
             $articles = Article::with('section')->whereHas('entreprises', function ($q) use ($entreprise) {
                 $q->where('slug', $entreprise);
             })->online()->orderBy('id', 'desc')->paginate($this->paginate);
             $articles->setPath('actualites/entreprises/' . $entreprise);
         }
         $data = ['articles' => $articles];
         dd($data);
         return view('front.articles.articles', $data);
     }*/
}
