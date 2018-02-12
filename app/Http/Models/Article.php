<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Article extends Model {

    public $fillable = ['titre', 'slug', 'contenu', 'image', 'section_id', 'publie', 'une', 'user_id','vue'];
    public static $rules = ['titre' => 'required', 'slug' => 'required', 'section_id' => 'required'];


    public function section() {
        return $this->belongsTo('App\Http\Models\Section');
    }

    public function entreprises() {
        return $this->belongsToMany('App\Http\Models\Entreprise');
    }

    public function user() {
        return $this->belongsTo('App\Http\Models\User');
    }

    public function getEtatAttribute($value) {
        if ($this->publie == 1)
            return "Publié";
        else
            return "En attente";
    }

    public function getPositionAttribute() {
        if ($this->une == 1)
            return "A la une";
        else
            return 'Normale';

    }

    public function scopePosition($query, $position) {
        return $query->where('une', $position);
    }


    public function getImagelinkAttribute() {
        $principale = "noimage.png";

        if (!empty(trim($this->image)) && file_exists(public_path() . '/uploads/articles/' . $this->image))
            $principale = $this->image;
        return asset('uploads/articles/' . $principale);
    }

    public function getLinkAttribute() {
        return url('actualites/' . $this->section->slug . '/' . $this->slug);
    }

    public function scopeKeyword($query, $q) {
        return $query->whereRaw("titre like '%" . $q . "%' ");
    }

    public function scopeOnline($query, $publie = 1) {
        return $query->where('publie', $publie);
    }


    public static function store($request, $redirect) {
        $article = new Article;
        $id = $request->input('id');
        $slug = Str::slug($request->input('titre'));
        $request->merge(array('slug' => $slug));
        $request->merge(array('user_id' => \Auth::user()->id));

        $validator = \Validator::make($request->all(), self::$rules);
        if ($validator->fails()) {
            return redirect($redirect . $request->input('id'))->withInput()->withErrors($validator->messages());
        }
        $error = "";
        if (Help::checkObject(new Article(), 'slug', $request->input('slug'), $request->input('id', 0)))
            $error = "Article déja publié";

        if (strlen(trim($error)) > 0)
            return redirect($redirect . $id)->withInput()->with("error", $error);

        $extension = array('png', 'gif', 'jpg', 'jpeg');

        if ($request->hasFile('fichier')) {
            $fileName = Help::upload('fichier', 'articles/', config('application.image_size'), $extension);
            if ($fileName != null)
                $request->merge(array('image' => $fileName));
        }

        $request = Help::publie($request);

        if ($request->has('id')) {
            $article = self::find($request->input('id'));
            $article->update($request->all());
            $article->entreprises()->sync($request->input('entreprises', []));

        }
        else {
            $article = self::create($request->all());
            $article->entreprises()->sync($request->input('entreprises', []));
        }

        return redirect($redirect . $article->id)->with('success', 1);
    }


    public static function supprimer(Article $article) {
        // $article = Article::find($id);
        if ($article != null) {
            if (\File::exists('uploads/articles/' . $article->image))
                \File::delete('uploads/articles/' . $article->image);

            $param = ['name' => $article->user->name, 'sujet' => $article->titre, 'email' => $article->user->email];

            \Mail::send('emails.fakearticle', ['param' => $param], function ($message) use ($param) {
                $message->from('contact@piaafrica.com', config('application.name'));
                $message->to($param['email'], $param['name'])->subject($param['sujet']);
            });
            $article->delete();
        }
    }

    public static function supprimerWithMessage($posts) {
        foreach ($posts as $post) {
            $article = Article::where('id', $post)->first();
            if ($article != null) {
                if (\File::exists('uploads/articles/' . $article->image))
                    \File::delete('uploads/articles/' . $article->image);

                $param = ['name' => $article->user->name, 'sujet' => $article->titre, 'email' => $article->user->email];;

                \Mail::send('emails.fakearticle', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@maakiti.com', config('application.name'));
                    $message->to($param['email'], $param['name'])->subject($param['sujet']);
                });

                $article->delete();
            }
        }
    }

    public static function depublier($posts) {
        foreach ($posts as $post) {
            $article = Article::find($post);
            $article->update(['publie' => 0]);
        }
    }

    public static function publier($posts) {
        foreach ($posts as $post) {
            $article = Article::find($post);
            $article->update(['publie' => 1]);
        }
    }

    public static function setUne($posts) {
        foreach ($posts as $post) {
            $entreprise = Article::find($post);
            $entreprise->update(['une' => 1]);
        }
    }

    public static function normal($posts) {
        foreach ($posts as $post) {
            $entreprise = Article::find($post);
            $entreprise->update(['une' => 0]);
        }
    }


}
