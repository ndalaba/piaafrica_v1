<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Annonce extends Model {

    public $fillable = ['section_id', 'entreprise_id', 'user_id ', 'titre', 'slug', 'description', 'publie', 'ville_id', 'vu', 'une', 'experience', 'profil', 'fin', 'type', 'email'];
    public static $rules = ['titre' => 'required', 'section_id' => 'required'];

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function section() {
        return $this->belongsTo('App\Http\Models\Section');
    }

    public function entreprise() {
        return $this->belongsTo(Entreprise::class);
    }

    public function candidats() {
        return $this->belongsToMany(User::class)->withPivot('motivation');
    }

    public function ville() {
        return $this->belongsTo(Ville::class);
    }

    public function getEtatAttribute($value) {
        if ($this->publie == 1)
            return "Publié(e)";
        else
            return "En attente";
    }

    public function getLinkAttribute() {
        return url('emploi/' . $this->ville->country->slug . '/' . $this->slug);
    }

    public function getExpireAttribute() {
        if ($this->fin == "0000-00-00")
            return false;
        $expire = time() - strtotime($this->fin);
        if ($expire > 0)
            return true;
        else return false;
    }

    public function getPositionAttribute() {
        if ($this->une == 1)
            return "A la une";
        else
            return 'Normale';

    }

    public function scopeSection($query, $section) {
        return $query->where('section_id', $section);
    }

    public function scopeEntreprise($query, $annonce_id) {
        return $query->where('entreprise_id', $annonce_id);
    }

    public function scopeType($query, $type) {
        return $query->where('type', $type);
    }

    public function scopeKeyword($query, $q) {
        return $query->whereRaw("titre like '%" . $q . "%' or profil like '%" . $q . "%' ");
    }

    public function scopeVille($query, $ville_id) {
        return $query->where('ville_id', $ville_id);
    }

    public function scopeCountry($query, $country_id) {
        return $query->whereHas('ville', function ($q) use ($country_id) {
            return $q->where('country_id', $country_id);
        });
    }

    public function scopeOnline($query, $publie = 1) {
        return $query->where('publie', $publie)->whereRaw(" fin >= NOW() ");
    }

    public static function same($type, $country_id, $section_id, $id) {
        return Annonce::whereHas('ville', function ($q) use ($country_id) {
            return $q->where('country_id', $country_id);
        })->online()->where('type', $type)->where('section_id', $section_id)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(5)->get();
    }

    // A la une ou normale
    public function scopePosition($query, $position) {
        return $query->where('une', $position);
    }

    public static function store($request, $redirect) {

        $annonce = new Annonce;
        $id = $request->input('id');
        $slug = Str::slug($request->input('titre'));
        $request->merge(array('slug' => $slug));

        $v = $request->input('ville');
        if (trim($v) != '') {
            $ville = Ville::firstOrNew(array('ville' => ucfirst($v)));
            $ville->ville = $v;
            $ville->country_id = $request->input('country_id');
            $ville->save();
            $request->merge(array('ville_id' => $ville->id));
        }

        $validator = \Validator::make($request->all(), self::$rules);
        if ($validator->fails()) {
            return redirect($redirect . $request->input('id'))->withInput()->withErrors($validator->messages());
        }

        $error = "";
        if (Help::checkObject(new Annonce(), 'slug', $request->input('slug'), $request->input('id', 0)))
            $error = "Annonce déja publiée";

        if (strlen(trim($error)) > 0)
            return redirect($redirect . $id)->withInput()->with("error", $error);

        if ($request->has('une'))
            $request->merge(array('une' => 1));
        else
            $request->merge(array('une' => 0));

        $request = Help::publie($request);
        if ($request->has('id')) {
            $annonce = self::find($request->input('id'));
            $annonce->update($request->all());
        }
        else {
            $annonce = self::create($request->all());
            $annonce->user_id = \Auth::user()->id;
            $annonce->save();
            $param = ['name' => $request->input('titre'), 'lien' => $annonce->link, 'email' => \Auth::user()->email, 'sujet' => 'Votre offre ' . $request->input('titre') . ' sur Pia Africa'];
            if (filter_var(\Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                \Mail::send('emails.annonce', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@piaafrica.com', config('application.name'));
                    $message->to($param['email'], $param['name'])->bcc('dmn@dev-hoster.com')->subject($param['sujet']);
                });
            }
        }

        return redirect($redirect . $annonce->id)->with('success', 1);
    }

    public static function supprimer(Annonce $annonce) {
        // $annonce = Annonce::find($id);
        if ($annonce != null) {
            $annonce->delete();
        }
    }

    public static function supprimerWithMessage($posts) {
        foreach ($posts as $post) {
            $annonce = Annonce::where('id', $post)->first();
            if ($annonce != null) {
                $annonce->delete();
            }
        }
    }

    public static function depublier($posts) {
        foreach ($posts as $post) {
            $annonce = Annonce::find($post);
            $annonce->update(['publie' => 0]);
        }
    }

    public static function publier($posts) {
        foreach ($posts as $post) {
            $annonce = Annonce::find($post);
            $annonce->update(['publie' => 1]);
            if ($annonce->user != null) {
                $param = ['name' => $annonce->titre, 'lien' => $annonce->link, 'entreprise' => $annonce->titre, 'sujet' => 'Votre annonce a été validée', 'email' => $annonce->user->email];

                \Mail::send('emails.annonce_valide', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@piaafrica.com', config('application.name'));
                    $message->to($param['email'], $param['name'])->bcc('dmn@dev-hoster.com')->subject($param['sujet']);
                });

            }
        }
    }

    public static function setUne($posts) {
        foreach ($posts as $post) {
            $annonce = Annonce::find($post);
            $annonce->update(['une' => 1]);
        }
    }

    public static function normal($posts) {
        foreach ($posts as $post) {
            $annonce = Annonce::find($post);
            $annonce->update(['une' => 0]);
        }
    }
}
