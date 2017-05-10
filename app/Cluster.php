<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'cluster','rating',
    ];

    protected $hidden = [

    ];

    public function attractions(){
        return $this->belongsTo('App\Attraction');
    }
}
