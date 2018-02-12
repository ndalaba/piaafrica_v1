<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model {

    public $fillable = ['partenaire', 'logo', 'entreprise_id','description'];

    public function entreprise() {
        return $this->belongsTo('App\Http\Models\Entreprise');
    }

}
