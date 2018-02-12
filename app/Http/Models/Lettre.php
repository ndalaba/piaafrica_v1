<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Lettre extends Model {
// AVANT MODIFICATION DU NOM DU CHAMP DANS LA BASE DE DONNÉE
// lastuser CORRESPONDRA AU NOMBRE DE MAIL ENVOYÉ CONSERNANT CETTE NEWSLETTER
// ET IMAGE L'HEURE À LA QUELLE LE DERNIER MAIL A ÉTÉ ENVOYÉ.
    public $fillable = ['country_id', 'titre', 'publie', 'slug', 'contenu', 'image', 'vue', 'publie', 'lastmail', 'lastuser'];
    public static $rules = ['titre' => 'required', 'slug' => 'required', 'country_id'];

    public function getLinkAttribute() {
        return url('newsletters/' . $this->slug);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function scopeOnline($query) {
        return $query->where('publie', 1);
    }

    public function getEtatAttribute($value) {
        if ($this->publie == 1)
            return "Publié";
        else
            return "En attente";
    }

    public function getStatutAttribute() {
        if ($this->lastmail != -1)
            return "<span style='color: #990f0e'>D'autres mails attendent</span>";
        else return "<span style='color: #009926'>Newsletter envoyé à tous</span>";
    }

    public static function store($request, $redirect) {
        $lettre = new Lettre;
        $id = $request->input('id');
        $slug = Str::slug($request->input('titre'));
        $request->merge(array('slug' => $slug));

        $validator = \Validator::make($request->all(), self::$rules);
        if ($validator->fails()) {
            return redirect($redirect . $request->input('id'))->withInput()->withErrors($validator->messages());
        }
        $error = "";
        if (Help::checkObject(new Lettre(), 'slug', $request->input('slug'), $request->input('id', 0)))
            $error = "Lettre déja publié";

        if (strlen(trim($error)) > 0)
            return redirect($redirect . $id)->withInput()->with("error", $error);

        $request = Help::publie($request);

        if ($request->has('id')) {
            $lettre = self::find($request->input('id'));
            if (empty($request->input('country_id')))
                $request->merge(['country_id' => NULL]);

            $lettre->update($request->all());
        }
        else {
            if (empty($request->input('country_id')))
                $request->merge(['country_id' => NULL]);
            $lettre = self::create($request->all());
        }

        return redirect($redirect . $lettre->id)->with('success', 1);
    }


    public static function supprimer(Lettre $lettre) {
        $lettre->delete();
    }

    public static function supprimerWithMessage($posts) {
        foreach ($posts as $post) {
            $lettre = Lettre::where('id', $post)->first();
            $lettre->delete();
        }
    }

    public static function depublier($posts) {
        foreach ($posts as $post) {
            $lettre = Lettre::find($post);
            $lettre->update(['publie' => 0]);
        }
    }

    public static function publier($posts, $n) {
        $post = $posts[0];
        $lettre = Lettre::find($post);

        if ($lettre->lastmail == -1)
            return;
       
        if ($lettre->country)
            $emails = Newsletter::where('country_id', $lettre->country->id)->where('id', '>', $lettre->lastmail)->online()->orderBy('id')->take($n)->get();

        else    $emails = Newsletter::where('id', '>', $lettre->lastmail)->online()->orderBy('id')->take($n)->get();
        $lastmail = 0;
        $n_send = 0;
        foreach ($emails as $email) {
            $lastmail = $email->id;
            if (filter_var($email->email, FILTER_VALIDATE_EMAIL)) {
                $param = ['id' => $lettre->id, 'titre' => $lettre->titre, 'message' => $lettre->contenu, 'email' => $email->email, 'newsletter' => true];
                \Mail::send('emails.newsletter', ['param' => $param], function ($message) use ($param) {
                    $message->from('noreply@piaafrica.com', config('application.name'));
                    $message->to($param['email'])->subject($param['titre']);
                });
                $n_send += 1;
            }
        }
        // CECI POUR SAVOIR SI LES MAILS ONT ETE ENVOYÉS
        $param = ['id' => $lettre->id, 'titre' => $lettre->titre, 'message' => $lettre->contenu, 'email' => 'dmn@dev-hoster.com', 'newsletter' => true];
        \Mail::send('emails.newsletter', ['param' => $param], function ($message) use ($param) {
            $message->from('contact@piaafrica.com', config('application.name'));
            $message->to('dmn@dev-hoster.com')->subject($param['titre']);
        });

        $n_send += $lettre->lastuser;

        if ($lettre->country)
            $other = Newsletter::where('country_id', $lettre->country->id)->where('id', '>', $lastmail)->online()->orderBy('id')->first();
        else
            $other = Newsletter::where('id', '>', $lastmail)->online()->orderBy('id')->first();

        if (!$other)
            $lastmail = -1;
        // JE RAPPELLE QUE LASTUSER CORRESPOND AU NOMBRE DE MAIL ENVOYÉ POUR CETTE NEWSLETTER
        $lettre->update(['publie' => 1, 'lastmail' => $lastmail, 'lastuser' => $n_send, 'image' => date('Y-m-d H:i:s')]);

    }
}
