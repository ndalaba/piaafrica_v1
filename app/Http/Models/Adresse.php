<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model {
    public $fillable = ['phone', 'ville_id', 'adresse', 'entreprise_id'];

    public function entreprise() {
        return $this->belongsTo('App\Http\Models\Entreprise');
    }
    public function ville(){
        return $this->belongsTo('App\Http\Models\Ville');
    }

}
