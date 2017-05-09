<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use Auth;

class PlannerController extends Controller {

	public function store(Request $request){
		if(\Auth::check()){
			return "login";
		}else{
			return redirect('preplanner');
		}
	}
	
	
}
