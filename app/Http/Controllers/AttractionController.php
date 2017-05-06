<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Attraction;
use App\Image;
use App\Tag;
use App\Category;
use App\OpeningHour;

class AttractionController extends Controller {

	public function searchAttraction(Request $request)
	{
		$attraction = Attraction::find($request->id);
		$image = $attraction->images;
		$address = explode(",",$attraction->address);
		$lati = $attraction->latitude;
		$tag = $attraction->tags;
		$category = $attraction->categories;
		$openTime = $attraction->opening_hours;
		// $openTime = $attraction->opening_hours;


		$approxTime = $attraction->approx_time;
		$endTime = 0.0;
		$endTime2 = 0.0;
		$endTime3 = 0.0;
		$endTime4 = 0.0;
		// calculate visit Duration

		$day = $request->day;
		if($day == 1) {
			if($request->count==1){
				$selectedTime = $image->first()->time_open;
			} else {
				$selectedTime = "10:00:00";
			}
			$time = $request->time;
			$time = floatval($time);
			$approxTime = $time + $approxTime;
			$whole = floor($approxTime);
			$decimal = $approxTime - $whole;
			$min = 0;
			if ($decimal == .50) {
	    	$min = 30;
			}
			$endTime = strtotime($selectedTime) + ($whole*3600) + ($min*60);  //900 = 15 min X 60 sec
			$endTime = date('h:i:s', $endTime);

		} else if($day==2) {
			if($request->count==1){
				$selectedTime = $image->first()->time_open;
			} else {
				$selectedTime = "10:00:00";
			}
			$time = $request->time2;
			$time = floatval($time);
			$approxTime = $time + $approxTime;
			$whole = floor($approxTime);
			$decimal = $approxTime - $whole;
			$min = 0;
			if ($decimal == .50) {
	    	$min = 30;
			}
			$endTime2 = strtotime($selectedTime) + ($whole*3600) + ($min*60);  //900 = 15 min X 60 sec
			$endTime2 = date('h:i:s', $endTime2);
		} else if($day==3) {
			$selectedTime = "9:00:00";
			$time = $request->time3;
			$time = floatval($time);
			$approxTime = $time + $approxTime;
			$whole = floor($approxTime);
			$decimal = $approxTime - $whole;
			$min = 0;
			if ($decimal == .50) {
	    	$min = 30;
			}
			$endTime3 = strtotime($selectedTime) + ($whole*3600) + ($min*60);  //900 = 15 min X 60 sec
			$endTime3 = date('h:i:s', $endTime3);
		} else if($day==4) {
			$selectedTime = "9:00:00";
			$time = $request->time4;
			$time = floatval($time);
			$approxTime = $time + $approxTime;
			$whole = floor($approxTime);
			$decimal = $approxTime - $whole;
			$min = 0;
			if ($decimal == .50) {
	    	$min = 30;
			}
			$endTime4 = strtotime($selectedTime) + ($whole*3600) + ($min*60);  //900 = 15 min X 60 sec
			$endTime4 = date('h:i:s', $endTime4);
		}


		return response()->json([
			'title' => $attraction->title,
			'image' => $image->first()->url,
			'latitude' => $attraction->latitude,
			'longitude' => $attraction->longitude,
			'address' => $address[0],
			'approx_time' => $attraction->approx_time,
			'tag' => $tag->first()->tag,
			'category'=> $category->first()->category,
			'category2' => $category->get(1)->category,
			'category3' => $category->get(2)->category,
			'totalApproxTime' => $endTime,
			'totalApproxTime2' => $endTime2,
			'totalApproxTime3' => $endTime3,
			'totalApproxTime4' => $endTime4
			]);
	}
}
