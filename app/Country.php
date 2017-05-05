<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'abbr','value', 
    ];

    protected $hidden = [

    ];
}
