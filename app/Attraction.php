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


    public function tags(){
        return $this->hasMany('App\Tag');
    }

    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function plannerDetail(){
        return $this->hasOne('App\PlannerDetail');
    }

    public function openingHours(){
        return $this->hasMany('App\OpeningHour');
    }

}
