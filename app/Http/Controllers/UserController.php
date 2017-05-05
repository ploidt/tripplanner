<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

	public function showRegister(){
    	return view('register2');
    }


	public function store(Request $request)
	{
		
		$this->validateRequest($request);

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