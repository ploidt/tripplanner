<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Attraction;
Use Input;

class SearchController extends Controller {

	public function showAll() {

        $result = Attraction::all();
	    
	    return view('search', ["searchResult" => '']);
    }

	public function search() {

        // Sets the parameters from the get request to the variables.
        $keyword = Input::get('keyword');
        // $keyword = strtolower($keyword);

        // Perform the query using Query Builder
        $result = Attraction::where('title','like',"%$keyword%")->get();
        return view('search', ["searchResult" => $result, "keyword" => $keyword]);
    }
    
    public function searchId($id) {

        $result = Attraction::find($id);
        return view('detail', ["searchResult" => $result]);
    }

    public function searchMap() {

        // Sets the parameters from the get request to the variables.
        $keyword = Input::get('keyword');
        // $keyword = strtolower($keyword);

        // Perform the query using Query Builder
        $result = Attraction::where('title','like',"%$keyword%")->get();
	    
	    $content = view('marker', ["result" => $result, "keyword" => $keyword]);
	    $response = \Response::make($content,200);
		$response->header('Content-type','text/xml' );
	    return $response;
    }

    public function searchMapAll() {

        $result = Attraction::all();
	    
	    $content = view('marker', ["result" => '']);
	    $response = \Response::make($content,200);
		$response->header('Content-type','text/xml' );
	    return $response;
    }
}