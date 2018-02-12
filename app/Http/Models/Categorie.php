<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

    public $fillable = ['categorie','description','section_id','slug'];

    public static $rules = ['catgorie' => 'required','section_id'=>'required'];

    public function annonces() {
       return   $this->hasMany('App\Http\Models\Annonce');
    }
    public function section() {
      return  $this->belongsTo('App\Http\Models\Section');
    }

}
