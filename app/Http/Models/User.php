<?php namespace App\Http\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'phone', 'droit', 'reset_password_token', 'fonction', 'ville_id', 'publie'];
    protected $hidden = ['password', 'remember_token'];

    public static $rules = ['name' => 'required', 'email' => 'required|email'];

    public function getTypeAttribute() {
        if ($this->droit == config('application.candidat'))
            return "Candidat";
        elseif ($this->droit == config('application.contact'))
            return "Contact";
        elseif ($this->droit == config('application.annonceur'))
            return 'Annonceur';
        elseif ($this->droit == config('application.editeur'))
            return 'Editeur';
        elseif ($this->droit == config('application.administrateur'))
            return 'Administrateur';
    }

    public function getLinkAttribute() {
        return url('cvtheques/' . str_slug($this->name) . '_' . $this->id);
    }

    public function entreprises() {
        return $this->hasMany(Entreprise::class);
    }

    public function offres() {
        return $this->hasMany(Annonce::class);
    }

    public function candidat() {
        return $this->hasOne(Candidat::class);
    }

    public function annonces() {
        return $this->belongsToMany(Annonce::class)->withPivot('motivation');
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function ville() {
        return $this->belongsTo(Ville::class);
    }

    public function scopeKeyword($query, $q) {
        return $query->orWhere('fonction', 'like', '%' . $q . '%');
    }

    public function scopeVille($query, $ville_id) {
        return $query->where('ville_id', $ville_id);
    }

    public function scopeCountry($query, $country_id) {
        return $query->whereHas('ville', function ($q) use ($country_id) {
            return $q->where('country_id', $country_id);
        });
    }

    public function scopeByEmail($query, $email) {
        return $query->whereRaw("email like '%$email%'");
    }

    public function scopeByName($query, $name) {
        return $query->whereRaw("name like '%$name%'");
    }

    public function scopeByType($query, $droit) {
        return $query->where('droit', $droit);
    }

    public function scopeContact($query) {
        return $query->where('droit', config('application.contact'));
    }

    public static function setAnnonceur($posts) {
        foreach ($posts as $post) {
            $user = User::find($post);
            $user->update(['droit' => config('application.annonceur')]);
        }
    }

    public static function setContact($posts) {
        foreach ($posts as $post) {
            $user = User::find($post);
            $user->update(['droit' => config('application.contact')]);
        }
    }

}
