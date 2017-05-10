<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlannerDetail extends Model
{
  public $timestamps = false;
  
  protected $fillable = [
      'date', 'orderOfPlan',
  ];

  protected $hidden = [

  ];

  public function attraction(){
      return $this->belongsTo('App\Attraction');
  }

  public function planners(){
      return $this->belongsToMany('App\Planner');
  }

}
