<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {

    public $fillable = ['service', 'description', 'entreprise_id'];

    public function entreprise() {
        return $this->belongsTo('App\Http\Models\Entreprise');
    }
    public function getLinkAttribute() {
        //return 'coucou';
        return url('services/' . $this->entreprise->slug . '/' . $this->id . '-' . str_slug($this->service));
    }

    public static function same($service, $limit = 2) {
        return self::with('entreprise')->where('service', 'like', "%$service->service%")->where('id', '!=', $service->id)->whereHas('entreprise', function ($q) {
            return $q->where('une', 1);
        })->orderBy('id', 'rand')->limit($limit)->get();
    }

}
