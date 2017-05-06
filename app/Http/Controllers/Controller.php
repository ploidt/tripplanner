<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data,$code)
    {
    	return response()->json(['data' => $data], $code);
    }

    public function error($message,$code)
    {
    	return response()->json(['message' => $message, 'code' => $code], $code);
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
