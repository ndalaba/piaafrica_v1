<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    public $fillable = ['pays', 'code', 'slug', 'carte'];
    public static $rules = ['pays' => 'required', 'code' => 'required', 'slug' => 'required'];

    public function villes() {
        return $this->hasMany(Ville::class);
    }

    public function emails(){
        return $this->hasMany(Newsletter::class);
    }

    public function entreprises() {
        return $this->hasManyThrough(Entreprise::class, Ville::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function letters() {
        return $this->hasMany(Lettre::class);
    }

}
