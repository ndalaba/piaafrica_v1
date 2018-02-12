<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Realisation extends Model {

    public $fillable = ['realisation', 'url', 'gservice_id', 'description', 'images', 'slug', 'publie'];
    public static $rules = ['realisation' => 'required', 'slug' => 'required', 'gservice_id' => 'required'];

    public function service() {
        return $this->belongsTo('App\Http\Models\Gservice');
    }

    public function getEtatAttribute($value) {
        if ($this->publie == 1)
            return "Publié";
        else
            return "En attente";
    }

    public function getImagelinkAttribute($value) {
        $images = explode(';', $this->images);
        $image = $images[0];
        $principale = "noimage.png";
        if (file_exists(public_path() . '/uploads/realisations/' . $image))
            $principale = $image;
        return asset('uploads/realisations/' . $principale);
    }

    public function scopeService($query, $service) {
        return $query->where('gservice_id', $service);
    }

    public static function store($request, $redirect) {
        $realisation = new Realisation;
        $id = $request->input('id');
        $slug = Str::slug($request->input('realisation'));
        $request->merge(array('slug' => $slug));


        $validator = \Validator::make($request->all(), self::$rules);
        if ($validator->fails()) {
            return redirect($redirect . $request->input('id'))->withInput()->withErrors($validator->messages());
        }
        $error = "";
        if (Help::checkObject(new Realisation(), 'slug', $request->input('slug'), $request->input('id', 0)))
            $error = "Réalisation déja publiée";

        if (strlen(trim($error)) > 0)
            return redirect($redirect . $id)->withInput()->with("error", $error);

        $extension = array('png', 'gif', 'jpg', 'jpeg');

        $total = count($_FILES['image']['name']);
        $filenames = "";

        for ($i = 0; $i < $total; $i++) {
            $filename = Help::upload('image', 'realisations/', 2000000, $extension, $i);
            if ($filename != null)
                $filenames = $filename . "; " . $filenames;
        }
        if (trim($filenames) != "")
            $request->merge(array('images' => $filenames));
        $request = Help::publie($request);

        if ($request->has('id')) {
            $realisation = self::find($request->input('id'));
            $realisation->update($request->all());

        }
        else {
            $realisation = self::create($request->all());
        }

        return redirect($redirect . $realisation->id)->with('success', 1);
    }


    public static function supprimer(Realisation $realisation) {
        // $realisation = Realisation::find($id);
        if ($realisation != null) {
            $images = explode(';', $realisation->images);
            foreach ($images as $image) {
                if (\File::exists('uploads/realisations/' . trim($image)))
                    \File::delete('uploads/realisations/' . trim($image));
            }

            $realisation->delete();
        }
    }

    public static function supprimerWithMessage($posts) {
        foreach ($posts as $post) {
            $realisation = Realisation::with('user')->where('id', $post)->first();
            if ($realisation != null) {
                $images = explode(';', $realisation->images);
                foreach ($images as $image) {
                    if (\File::exists('uploads/realisations/' . trim($image)))
                        \File::delete('uploads/realisations/' . trim($image));
                }
                $realisation->delete();
            }
        }
    }

    public static function depublier($posts) {
        foreach ($posts as $post) {
            $realisation = Realisation::find($post);
            $realisation->update(['publie' => 0]);
        }
    }

    public static function publier($posts) {
        foreach ($posts as $post) {
            $realisation = Realisation::find($post);
            $realisation->update(['publie' => 1]);
        }
    }


}
