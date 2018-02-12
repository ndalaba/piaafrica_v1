<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 30/09/16
 * Time: 11:30
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Candidat extends Model {
    public $incrementing = false;
    public $primaryKey = "user_id";
    protected $fillable = ['user_id', 'cv', 'linkedin', 'cvdoc', 'newsletter', 'photo', 'naissance', 'adresse', 'civilite', 'niveau', 'langue', 'languebis', 'publie', 'specialite', 'alert', 'experience', 'vu'];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getEtatAttribute() {
        if ($this->publie)
            return "<span style='color: #15801d; font-weight: bold'>Profil consultable par les recruteurs</span>";
        else return "<span style='color: #801009;font-weight: bold'>Profil non consultable par les recruteurs</span>";
    }

    public function scopeOnline($query, $publie = 1) {
        return $query->where('publie', $publie);
    }

    public function scopeKeyword($query, $q) {
        return $query->whereRaw("specialite like '%" . $q . "%'");
    }

    public function scopeNiveau($query, $q) {
        return $query->whereRaw("niveau like '%" . $q . "%'");
    }

    public function scopeCivilite($query, $q) {
        return $query->whereRaw("civilite like '%" . $q . "%'");
    }

    public function scopeLangue($query, $q) {
        return $query->whereRaw("langue like '%" . $q . "%' or languebis like '%" . $q . "%' ");
    }
}