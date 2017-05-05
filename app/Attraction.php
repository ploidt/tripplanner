<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'latitude', 'longitude', 'address', 'title', 'phone', 'email', 'website', 'category', 'rating', 'url', 'additional_info'
        ,'description', 'approx_time', 'entrance_free',
    ];

    protected $hidden = [

    ];

    public function images(){
        return $this->hasMany('App\Image');
    }
    public function plannerDetail(){
        return $this->hasOne('App\PlannerDetail');
    }
}
