<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model {

    public $fillable = ['produit', 'image', 'entreprise_id', 'description'];

    public function entreprise() {
        return $this->belongsTo('App\Http\Models\Entreprise');
    }

    public function getLinkAttribute() {
        //return 'coucou';
        return url('realisations/' . $this->entreprise->slug . '/' . $this->id . '-' . str_slug($this->produit));
    }

    public function getImagelinkAttribute() {
        $principale = "noimage.png";

        if ( !empty(trim($this->image)) && file_exists(public_path() . '/uploads/entreprises/produits/' . $this->image))
            $principale = $this->image;

        return asset('uploads/entreprises/produits/' . $principale);

    }

    public static function same($produit, $limit = 2) {
        return self::with('entreprise')->where('produit', 'like', "%$produit->produit%")->where('id', '!=', $produit->id)->whereHas('entreprise', function ($q) {
            return $q->where('une', 1);
        })->orderBy('id', 'rand')->limit($limit)->get();
    }


}
