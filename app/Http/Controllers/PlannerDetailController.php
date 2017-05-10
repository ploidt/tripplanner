<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Planner;
use App\PlannerDetail;
use Auth;
use Carbon\Carbon;

class PlannerDetailController extends Controller
{
    public function show($user_id,$planner_id){
    	$planner = Planner::find($planner_id);
    	if($planner){
    		return view('planner',['lengthOfStay' => $planner->lengthOfStay, 'planner_id' => $planner->id]);
    	}else{
    		return 'planner not found';
    	}
    	
    }

    public function save(Request $request, $planner_id){
    	// if(\Auth::check()){
    		// $user_id = \Auth::user()->id;
	    	$user_id = 22;
    		$plannerDetail = new PlannerDetail;
    		$plannerDetail->planner_id = $planner_id;
    		$plannerDetail->day = $request->day;
    		$plannerDetail->attraction_id = $request->data;
    		$plannerDetail->orderOfPlan = $request->order;
    		$plannerDetail->save();

    		return 'succcess';
    	// }else{
    		return redirect('login');
    	// }
    }
}
