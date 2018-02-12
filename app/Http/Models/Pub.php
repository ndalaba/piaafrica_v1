<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Pub extends Model {

    public $fillable = ['titre', 'description', 'image', 'lien', 'publie', 'entreprise', 'niveau', 'created_at', 'updated_at','position' ];

    public static $rules = ['titre' => 'required', 'niveau' => 'required'];

    public function scopeOnline($query, $publie = 1) {
        return $query->where('publie', $publie);
    }

    public function getPositionAttribute($value) {
        if ($this->niveau == 1)
            return "Partenaires 170x170";
        elseif ($this->niveau == 2) {
            return "Wide droite 160x600";
        }
        elseif ($this->niveau == 3) {
            return "Medium rectangle à droit 300x250";
        }
        elseif ($this->niveau == 4) {
            return "Square 125x125";
        }
    }
}
