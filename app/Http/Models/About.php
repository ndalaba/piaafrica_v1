<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model {

    public $fillable = ['description', 'entreprise_id','facebook','twitter','linkedid','googleplus'];

    public function entreprise() {
        return $this->belongsTo('App\Models\Entreprise');
    }

}
