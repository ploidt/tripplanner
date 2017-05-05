<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

	public function showRegister(){
    	return view('register');
    }


	public function register(Request $request)
	{
		
		$this->validateRequest($request);

  //       $user = User::create([
  //           'username' => $request->get('username'),
  //           'email' => $request->get('email'),
  //           'password'=> Hash::make($request->get('password')),
  //           'firstname' => $request->get('firstname'),
  //           'lastname' => $request->get('lastname'),
  //           'birthdate' => $request->get('birthdate'),
  //           'gender' => $request->get('gender'),
  //           'country' => $request->get('country'),
  //           'cluster' => 1
  //       ]);
        // return $request;
        return $this->success("The user with with id  has been created", 201);
	}

	public function validateRequest($request){
        $rules = [
            'username' => 'required',
            'email' => 'required|email', 
            'password' => 'required|min:6',
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'country' => 'required'
        ];
        $this->validate($request, $rules);
    }

}