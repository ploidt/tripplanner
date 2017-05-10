<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planner extends Model
{
    //

    public $timestamps = false;

    protected $fillable = [
        'lengthOfStay', 'arrivalDate', 'departDate', 'travelWith',
    ];

    protected $hidden = [

    ];

    public function plannerDetails(){
        return $this->hasMany('App\PlannerDetail');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
