<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //

    public $timestamps = false;

    protected $fillable = [
        'url',
    ];
    
    protected $hidden = [
        
    ];

    public function attraction(){
        return $this->belongsTo('App\Attraction');
    }
}
