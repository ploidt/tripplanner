<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    //

    public $timestamps = false;

    protected $fillable = [
        'day', 'time_open', 'time_close', 'closed_day',
    ];

    protected $hidden = [

    ];

    public function attraction(){
        return $this->belongsTo('App\Attraction');
    }
}
