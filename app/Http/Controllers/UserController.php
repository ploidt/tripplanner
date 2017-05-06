<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth;

class UserController extends Controller {

	public function showSignin(){
    	return view('signin');
    }


	public function signin(Request $request)
	{
		
		$this->validate($request,[
            'email' => 'required|email', 
            'password' => 'required|min:6',
            
        ]);
		$user = User::where('email', $request->get('email'))->first();

        if($user && Hash::check($request->get('password'), $user->password)){
        	$user->remember_token = $request->_token;
            return redirect('planner');
        }

        return $this->error("This user doesn't exist", 404);
	}

	public function showResetPassword(){
    	return view('reset_password');
    }


	public function resetPassword(Request $request)
	{
		
		$this->validate($request,[
            'email' => 'required|email'
            
        ]);
		$user = User::where('email', $request->get('email'))->first();

        if(!$user){
            return $this->error("The user with {$user->id} doesn't exist", 404);
        }

        $rules = [
            'password' => 'required|min:6'
        ];

        $this->validate($request, $rules);
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return $this->success("The user with with id {$user->id} has been updated", 200);
	}
}