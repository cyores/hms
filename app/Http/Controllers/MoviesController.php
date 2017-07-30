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
    	$return_array = Movies::getAllMoviesTV();
    	return View::make('movies.index', $return_array);
    }

    public function anyWatchMovie($id) {
    	$return_array = array();
    	$get_movie = DB::select('SELECT `title`, `path`, `count`, `rating` FROM `movies` WHERE `id` = ?', array($id));
    	foreach ($get_movie as $key => $movie) {
    		$path = str_replace('E:/', '', $movie->path);
    		$return_array['movie'] = array(
    									'title'  => $movie->title,
    									'path'   => $path,
    									'count'  => $movie->count,
    									'rating' => $movie->rating
    									);
    	}

    	return View::make('movies.watch', $return_array);
    }
}
