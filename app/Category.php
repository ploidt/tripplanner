<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public $timestamps = false;

    protected $fillable = [
        'category',
    ];

    protected $hidden = [

    ];

    public function attraction(){
        return $this->belongsTo('App\Attraction');
    }
}
