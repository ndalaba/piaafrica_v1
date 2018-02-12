<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Entreprise extends Model {

    public $fillable = ['name', 'domaine', 'publie', 'slug', 'logo', 'email', 'web', 'map', 'section_id', 'une', 'user_id', 'adress', 'image', 'ville_id'];
    public static $rules = ['name' => 'required', 'slug' => 'required', 'section_id' => 'required', 'email' => 'email', 'domaine' => 'required'];


    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function section() {
        return $this->belongsTo('App\Http\Models\Section');
    }

    public function annonces() {
        return $this->hasMany(Annonce::class);
    }

    public function articles() {
        return $this->belongsToMany('App\Http\Models\Article');
    }

    public function adresses() {
        return $this->hasMany('App\Http\Models\Adresse');
    }

    public function ville() {
        return $this->belongsTo(Ville::class);
    }

    public function about() {
        return $this->hasOne('App\Http\Models\About');
    }

    public function services() {
        return $this->hasMany('App\Http\Models\Service');
    }

    public function produits() {
        return $this->hasMany('App\Http\Models\Produit');
    }

    public function partenaires() {
        return $this->hasMany('App\Http\Models\Partenaire');
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

    public function getLinkAttribute() {
        //return url('annuaire/' . str_slug($this->domaine) . '/' . $this->slug . '_' . strtolower($this->adress->ville->country->slug));
        return url('annuaire/' . $this->ville->country->slug . '/' . str_slug($this->domaine) . '/' . $this->slug);
    }

    public function getImagelinkAttribute() {
        $principale = "noimage.png";

        if (!empty(trim($this->logo)) && file_exists(public_path() . '/uploads/entreprises/logos/' . $this->logo))
            $principale = $this->logo;

        return asset('uploads/entreprises/logos/' . $principale);
    }

    public function getAdressAttribute($value) {
        $adresse = Adresse::with('ville')->where('entreprise_id', $this->id)->first();
        if ($adresse != null)
            return $adresse;
        else
            return new Adresse();
    }

    public function getCoordonneeAttribute() {
        $r = explode(',', $this->map);
        return $r;
    }

    public function getPositionAttribute() {
        if ($this->une == 1)
            return "A la une";
        else
            return 'Normale';

    }

    public function getPrincipaleImageLinkAttribute() {
        $principale = "noimage.png";

        if (!empty(trim($this->image)) && file_exists(public_path() . '/uploads/entreprises/images/' . $this->image))
            $principale = $this->image;

        return asset('uploads/entreprises/images/' . $principale);
    }

    public function scopeSection($query, $section) {
        return $query->where('section_id', $section);
    }

    public function scopeKeyword($query, $q) {
        return $query->whereRaw("name like '%" . $q . "%' or domaine like '%" . $q . "%' ");
    }

    public function scopeVille($query, $ville_id) {
        return $query->whereHas('adresses', function ($q) use ($ville_id) {
            return $q->where('ville_id', $ville_id);
        });
    }

    public function scopeCountry($query, $country_id) {
        return $query->whereHas('adresses', function ($query) use ($country_id) {
            return $query->whereHas('ville', function ($q) use ($country_id) {
                return $q->where('country_id', $country_id);
            });
        });
    }

    public static function hasAnnonces($country_id = 0) {
        if ($country_id != 0) {
            $entreprises = Entreprise::whereHas('annonces', function ($query) {
                return $query->where('publie', 1);
            })->whereHas('adresses', function ($query) use ($country_id) {
                return $query->whereHas('ville', function ($q) use ($country_id) {
                    return $q->where('country_id', $country_id);
                });
            })->orderBy('name')->get();
        }
        else {
            $entreprises = Entreprise::whereHas('annonces', function ($query) {
                return $query->where('publie', 1);
            })->orderBy('name')->get();
        }
        return $entreprises;
    }

    public function scopeOnline($query, $publie = 1) {
        return $query->where('publie', $publie);
    }

    // A la une ou normale
    public function scopePosition($query, $position) {
        return $query->where('une', $position);
    }

    public static function store($request, $redirect) {
        $entreprise = new Entreprise;
        $id = $request->input('id');
        $contact = User::find($request->input('user_id'));
        $slug = Str::slug($request->input('name'));
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
        if (Help::checkObject(new Entreprise(), 'slug', $request->input('slug'), $request->input('id', 0)))
            $error = "Entreprise déja publié";

        if (strlen(trim($error)) > 0)
            return redirect($redirect . $id)->withInput()->with("error", $error);

        $extension = array('png', 'gif', 'jpg', 'jpeg');

        if ($request->hasFile('fichier')) {
            $fileName = Help::upload('fichier', 'entreprises/logos/', config('application.image_size'), $extension);
            if ($fileName != null)
                $request->merge(array('logo' => $fileName));
        }
        if ($request->hasFile('fichierimage')) {
            $fileName = Help::upload('fichierimage', 'entreprises/images/', 800000, $extension);
            if ($fileName != null)
                $request->merge(array('image' => $fileName));
        }

        if ($request->has('une'))
            $request->merge(array('une' => 1));
        else
            $request->merge(array('une' => 0));

        $request = Help::publie($request);
        if ($request->has('id')) {
            $entreprise = self::find($request->input('id'));
            $entreprise->update($request->all());
            $adresse = Adresse::where('entreprise_id', $entreprise->id)->first();
            if ($adresse != null)
                $adresse->update(['ville_id' => $request->input('ville_id'), 'adresse' => $request->input('adresse'), 'phone' => $request->input('phone'), 'entreprise_id' => $entreprise->id]);
            else {
                $adresse = new Adresse(['ville_id' => $request->input('ville_id'), 'adresse' => $request->input('adresse'), 'phone' => $request->input('phone'), 'entreprise_id' => $entreprise->id]);
                $adresse->save();
            }
        }
        else {
            $entreprise = self::create($request->all());
            $adresse = new Adresse(['ville_id' => $request->input('ville_id'), 'adresse' => $request->input('adresse'), 'phone' => $request->input('phone'), 'entreprise_id' => $entreprise->id]);
            $adresse->save();
            $about = new About(['description' => $entreprise->name, 'entreprise_id' => $entreprise->id]);
            $about->save();

            $param = ['name' => $entreprise->name, 'lien' => $entreprise->link, 'email' => $entreprise->email, 'sujet' => $entreprise->name . ' sur Pia Africa'];
            if (filter_var($entreprise->email, FILTER_VALIDATE_EMAIL)) {
                \Mail::send('emails.entreprise', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@piaafrica.com', config('application.name'));
                    $message->to($param['email'], $param['name'])->bcc('dmn@dev-hoster.com')->subject($param['sujet']);
                });
            }
        }

        return redirect($redirect . $entreprise->id)->with('success', 1);
    }

    public static function supprimer(Entreprise $entreprise) {
        // $entreprise = Entreprise::find($id);
        if ($entreprise != null) {
            if (\File::exists('uploads/entreprises/logos/' . $entreprise->logo))
                \File::delete('uploads/entreprises/logos/' . $entreprise->logo);
            if (\File::exists('uploads/entreprises/images/' . $entreprise->image))
                \File::delete('uploads/entreprises/images/' . $entreprise->image);

            if ($entreprise->user != null) {
                $param = ['name' => $entreprise->user->name, 'sujet' => $entreprise->name, 'email' => $entreprise->user->email];;

                \Mail::send('emails.fakeentreprise', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@piaafrica.com', config('application.name'));
                    $message->to($param['email'], $param['name'])->subject($param['sujet']);
                });

            }
            $entreprise->delete();
        }
    }

    public static function supprimerWithMessage($posts) {
        foreach ($posts as $post) {
            $entreprise = Entreprise::with('user')->where('id', $post)->first();
            if ($entreprise != null) {
                if (\File::exists('uploads/entreprises/logos/' . $entreprise->logo))
                    \File::delete('uploads/entreprises/logos/' . $entreprise->logo);
                if (\File::exists('uploads/entreprises/images/' . $entreprise->image))
                    \File::delete('uploads/entreprises/images/' . $entreprise->image);

                if ($entreprise->user != null) {
                    $param = ['name' => $entreprise->user->name, 'sujet' => $entreprise->name, 'email' => $entreprise->user->email];;

                    \Mail::send('emails.fakeentreprise', ['param' => $param], function ($message) use ($param) {
                        $message->from('contact@piaafrica.com', config('application.name'));
                        $message->to($param['email'], $param['name'])->subject($param['sujet']);
                    });

                }
                $entreprise->delete();
            }
        }
    }

    public static function depublier($posts) {
        foreach ($posts as $post) {
            $entreprise = Entreprise::find($post);
            $entreprise->update(['publie' => 0]);
        }
    }

    public static function publier($posts) {
        foreach ($posts as $post) {
            $entreprise = Entreprise::with('user')->find($post);
            $entreprise->update(['publie' => 1]);
            if ($entreprise->user != null) {
                $param = ['name' => $entreprise->user->name,'id'=>$entreprise->id, 'lien' => $entreprise->link, 'entreprise' => $entreprise->name, 'sujet' => 'Votre entreprise a été validée', 'email' => $entreprise->user->email];

                \Mail::send('emails.entreprise_valide', ['param' => $param], function ($message) use ($param) {
                    $message->from('contact@piaafrica.com', config('application.name'));
                    $message->to($param['email'], $param['name'])->bcc('dmn@dev-hoster.com')->subject($param['sujet']);
                });

            }
        }
    }

    public static function setUne($posts) {
        foreach ($posts as $post) {
            $entreprise = Entreprise::find($post);
            $entreprise->update(['une' => 1]);
        }
    }

    public static function normal($posts) {
        foreach ($posts as $post) {
            $entreprise = Entreprise::find($post);
            $entreprise->update(['une' => 0]);
        }
    }
}
