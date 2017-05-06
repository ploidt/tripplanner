<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Carbon\Carbon;
use App\Country;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required|date',
            'gender' => 'required',
            'country' => 'required',


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $age = Carbon::parse($data['birthdate'])->age;
        if($age > 17 && $age < 25){
            $age = 1;
        }elseif ($age > 24 && $age < 35) {
            $age = 2;
        }elseif ($age > 34 && $age < 50) {
            $age = 3;
        }elseif ($age > 49 && $age < 65) {
            $age = 4;
        }elseif ($age > 64) {
            $age = 5;
        }
        $gender = $data['gender'];
        $countrynum = Country::where('value',$data['country'])->first();
        $countrynum = $countrynum->countrynum;
        $cluster = $this->findCluster($gender,$age,$countrynum);


        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'birthdate' => $data['birthdate'],
            'gender' => $data['gender'],
            'country' => $data['country'],
            'cluster' => $cluster,
        ]);
    }

    public function findCluster($gender,$age,$countrynum){
      if($gender == 0){
        if($age == 1){
          if($countrynum == 36){
            return (1);
          }else if($countrynum == 356){
            return (7);
          }else if($countrynum == 702){
            return (4);
          }else if($countrynum == 764){
            return (3);
          }else if($countrynum == 826){
            return (6);
          }else{
            return (2);
          }
        }else if($age == 2){
          if($countrynum == 356){
            return (7);
          }else if($countrynum == 702){
            return (4);
          }else if($countrynum == 764){
            return (3);
          }else if($countrynum == 840){
            return (2);
          }else{
            return (6);
          }
        }else if($age == 3){
          if($countrynum == 36){
            return (1);
          }else if($countrynum == 702){
            return (4);
          }else{
            return (2);
          }
        }else if($age == 4){
          if($countrynum == 36){
            return (1);
          }else if($countrynum == 356){
            return (7);
          }else if($countrynum == 702){
            return (4);
          }else if($countrynum == 764){
            return (3);
          }else if($countrynum == 826){
            return (6);
          }else{
            return (2);
          }
        }else if($age == 5){
          if($countrynum == 840){
            return (2);
          }else{
            return (3);
          }
        }
      }else if($gender == 1){
        if($age == 1){
          if($countrynum == 840){
            return (5);
          }else{
            return (1);
          }
        }else if($age == 2){
          if($countrynum == 36){
            return (1);
          }else{
            return (5);
          }
        }else if($age == 3){
          return (1);
        }else if($age == 4){
          if($countrynum == 840){
            return (5);
          }else{
            return (1);
          }
        }else if($age == 5){
          if($countrynum == 840){
            return (5);
          }else{
            return (1);
          }
        }
      }
    }
}
