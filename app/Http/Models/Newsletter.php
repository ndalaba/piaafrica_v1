<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {

    public $fillable = ['email', 'country_id', 'publie'];
    public static $rules = ['email' => 'email'];

    public function entreprises() {
        return $this->hasMany('App\Http\Models\Entreprise');
    }

    public function newsletters() {
        return $this->hasMany('App\Http\Models\Newsletter');
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function scopeCountry($query, $country_id) {
        return $query->where('country_id', $country_id);
    }

    public function scopeOnline($query, $publie = 1) {
        return $query->where('publie', $publie);
    }

    public function scopeKeyword($query, $q) {
        return $query->whereRaw("email  like '%" . $q . "%' ");
    }

    public function getEtatAttribute($value) {
        if ($this->publie === 1)
            return "Actif";
        else
            return "Inactif";
    }

    public static function depublier($posts) {
        foreach ($posts as $post) {
            $newsletter = Newsletter::find($post);
            $newsletter->update(['publie' => 0]);
        }
    }

    public static function publier($posts) {
        foreach ($posts as $post) {
            $newsletter = Newsletter::find($post);
            $newsletter->update(['publie' => 1]);
        }
    }
}
