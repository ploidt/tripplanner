<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    public $timestamps = false;

    protected $fillable = [
        'tag',
    ];

    protected $hidden = [

    ];

    public function attraction(){
        return $this->belongsTo('App\Attraction');
    }
}
