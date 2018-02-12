<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model {

    public $fillable = ['ville','country_id'];
    public static $rules = ['ville' => 'required', 'country_id'=>'required'];

    public function adresses() {
        return $this->hasMany('App\Http\Models\Adresse');
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function entreprises(){
        return $this->hasMany(Entreprise::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function annonces(){
        return $this->hasMany(Annonce::class);
    }

}
