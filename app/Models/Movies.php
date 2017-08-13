<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Utility;

use Auth;
use DB;
use Carbon\Carbon;

class Movies extends Model
{
	public static function getAllMoviesTV() {
		$return_array = array();
		$get_movies = DB::select('SELECT * FROM `movies` ORDER BY `title` ASC', array());
		foreach ($get_movies as $key => $movie) {
			$letter = substr($movie->title, 0, 1);
			$return_array['movies'][$letter][$movie->id] = array(
															"movie_id" => $movie->id,
															"title"    => $movie->title,
															"length"   => $movie->length,
															"count"    => $movie->count,
															"rating"   => $movie->rating,
															"path"     => $movie->path
														);
		}
		return $return_array;
	}

	public static function scanMoviesTV() {
		$return_array = array();
		$return_array['movies'] = Utility::getAllFiles('E:/Films');
		foreach ($return_array['movies'] as $key => $movie) {
			$title = explode('.', $movie['title'], 2)[0];
			$path = $movie['path'];
			$s = DB::select('SELECT `title` FROM `movies` WHERE `title` = ?', array($title));
			if(empty($s)) $i = DB::insert('INSERT `movies` (`title`, `path`) VALUES (?,?)', array($title, $path));
		}
		// $return_array['tv'] = Utility::getAllFiles('E:/TV');
		return $return_array;
	}
}
