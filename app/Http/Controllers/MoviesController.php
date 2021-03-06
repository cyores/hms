<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movies;
use App\Models\Utility;

use Auth;
use Carbon\Carbon;
use DB;
use View;

class MoviesController extends Controller
{
    public function index() {
    	$return_array = Movies::getAllMovies();
    	return View::make('movies.index', $return_array);
    }

    public function anyWatchMovie($id) {
    	$return_array = array();
    	$get_movie = DB::select('SELECT `title`, `path`, `count`, `rating` FROM `movies` WHERE `id` = ?', array($id));
    	foreach ($get_movie as $key => $movie) {
    		$path = str_replace('E:/', '', $movie->path);
    		$return_array['movie'] = array(
    									'title'  => $movie->title,
    									'path'   => '/media' . '/' . $path,
    									'count'  => $movie->count,
    									'rating' => $movie->rating
    									);
    	}

        $u = DB::update('UPDATE `movies` SET `count` = `count` + 1 WHERE `id` = ?', array($id));

    	return View::make('movies.watch', $return_array);
    }

    public function postScan() {
        return Movies::scanMovies();
    }

    public function postSearch(Request $request){
        $query = $request->input('query');

        $return_array = array();

        $get_results = DB::select('SELECT `title`, `id`, `rating`, `count` FROM `movies` WHERE `title` LIKE ?', array($query . '%'));

        foreach ($get_results as $key => $value) {
            $movie = array();
            $movie['title'] = $value->title;
            $movie['movie_id'] = $value->id;
            $movie['rating'] = $value->rating;
            $movie['count'] = $value->count;
            array_push($return_array, View::make('movies.partials.card', compact('movie', 'movie'))->render());
        }

        return json_encode($return_array);
    }
}
