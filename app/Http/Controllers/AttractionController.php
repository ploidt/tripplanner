<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Attraction;
use App\Image;

class AttractionController extends Controller {

	public function searchAttraction(Request $request)
	{
		$attraction = Attraction::find($request->id);
		$image = $attraction->images;
		$address = explode(",",$attraction->address);

		return response()->json([
			'id' => $attraction->id,
			'title' => $attraction->title,
			'image' => $image->first()->url,
			'latitude' => $attraction->latitude,
			'longitude' => $attraction->longitude,
			'address' => $address[0],
			'approx_time' => $attraction->approx_time,
			]);
	}
}