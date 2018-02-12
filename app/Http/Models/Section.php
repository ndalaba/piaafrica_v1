<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

    public $fillable = ['section', 'description', 'faimage', 'slug'];
    public static $rules = ['section' => 'required', 'slug' => 'required'];

    public function entreprises() {
        return $this->hasMany(Entreprise::class);
    }
    public function annonces(){
        return $this->hasMany(Annonce::class);
    }

    public function articles() {
        return $this->hasMany('App\Http\Models\Article');
    }
}
