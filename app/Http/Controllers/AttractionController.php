<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Attraction;
use App\Image;
use App\Tag;
use App\Category;

class AttractionController extends Controller {

	public function searchAttraction(Request $request)
	{
		$attraction = Attraction::find($request->id);
		$image = $attraction->images;
		$address = explode(",",$attraction->address);
		$tag = $attraction->tags;
		$category = $attraction->categories;

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
			'category3' => $category->get(2)->category
			]);
	}
}
