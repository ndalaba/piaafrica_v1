<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Gservice extends Model {

    public $fillable = ['service', 'description', 'image', 'slug'];
    public static $rules = ['service' => 'required', 'slug' => 'required'];

    public function realisations() {
        return $this->hasMany('App\Http\Models\Realisation');
    }

    public function getImagelinkAttribute() {
        $principale = "noimage.png";

        if (file_exists(public_path() . '/uploads/services/' . $this->image))
            $principale = $this->image;
        return asset('uploads/services/' . $principale);
    }

    public function getLinkAttribute() {
        return url('actualites/' . $this->section->slug . '/' . $this->slug);
    }

    public static function store($request, $redirect) {
        $gservice = new Gservice;
        $id = $request->input('id');
        $slug = Str::slug($request->input('service'));
        $request->merge(array('slug' => $slug));

        $validator = \Validator::make($request->all(), self::$rules);
        if ($validator->fails()) {
            return redirect($redirect . $request->input('id'))->withInput()->withErrors($validator->messages());
        }
        $error = "";
        if (Help::checkObject(new Gservice(), 'slug', $request->input('slug'), $request->input('id', 0)))
            $error = "Service déja publié";

        if (strlen(trim($error)) > 0)
            return redirect($redirect . $id)->withInput()->with("error", $error);

        $extension = array('png', 'gif', 'jpg', 'jpeg');

        if ($request->hasFile('fichier')) {
            $fileName = Help::upload('fichier', 'services/', config('application.image_size'), $extension);
            if ($fileName != null)
                $request->merge(array('image' => $fileName));
        }

        $request = Help::publie($request);

        if ($request->has('id')) {
            $gservice = self::find($request->input('id'));
            $gservice->update($request->all());

        }
        else {
            $gservice = self::create($request->all());
        }

        return redirect($redirect . $gservice->id)->with('success', 1);
    }


    public static function supprimer(Gservice $gservice) {
        // $gservice = Gservice::find($id);
        if ($gservice != null) {
            if (\File::exists('uploads/services/' . $gservice->image))
                \File::delete('uploads/services/' . $gservice->image);

            $gservice->delete();
        }
    }

    public static function supprimerWithMessage($posts) {
        foreach ($posts as $post) {
            $gservice = Gservice::where('id', $post)->first();
            if ($gservice != null) {
                if (\File::exists('uploads/services/' . $gservice->image))
                    \File::delete('uploads/services/' . $gservice->image);

                $gservice->delete();
            }
        }
    }
}
