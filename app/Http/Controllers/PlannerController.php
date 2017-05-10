<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Planner;
use Auth;
use Carbon\Carbon;

class PlannerController extends Controller {

	public function store(Request $request){
		if(\Auth::check()){
			$rules = [
	            'arrivalDate' => 'required|date',
	            'returnDate' => 'required|date',
	            'travelWith' => 'required',
	        ];
	        $this->validate($request, $rules);
	        $arrivalDate = Carbon::parse($request->get('arrivalDate'));
	        $returnDate = Carbon::parse($request->get('returnDate'));
	        $lengthOfStay = $returnDate->diffInDays($arrivalDate);
	        $user_id = \Auth::user()->id;
	        $planner = new Planner();
	        $planner->user_id = $user_id;
	        $planner->arrivalDate = $arrivalDate;
	        $planner->returnDate = $returnDate;
	        $planner->travelWith = $request->get('travelWith');
	        $planner->lengthOfStay = $lengthOfStay + 1;
	        $planner->save();

	        // return $this->success("The group with with id {$planner->id} has been created", 201);
	        return redirect('user/'.$user_id.'/planner');

		}else{
			return redirect('login');
		}
	}

	public function show($id){
		$user = User::find($id);
		// echo $user;
		if($user){
			$planners = $user->planners;
			return view('user.personal_planner', ["planners" => $planners]);
		}else{
			return redirect('homepage');
		}
	}

	public function update($planner_id){
		if(\Auth::check()){
			$user_id = \Auth::user()->id;
			$user = User::find($user_id);
			$planner = Planner::where('id',$planner_id);
			if($planner){
				return redirect('user/'.$user_id.'/planner/'.$planner_id);
			}else{
				return error('you are not authorize to edit this plan',409);
			}
		}else{
			return redirect('login');
		}
	}

	public function destroy($planner_id){
		if(\Auth::check()){
			$user_id = \Auth::user()->id;
			$user = User::find($user_id);
			$planner = Planner::where('id',$planner_id);
			if($planner){
				$planner->delete();
				return redirect('user/'.$user_id.'/planner');
			}else{
				return error('you are not authorize to delete this plan',409);
			}
		}else{
			return redirect('login');
		}
	}
	
	
}
