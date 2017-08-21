<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Utility;

use Auth;
use DB;
use Carbon\Carbon;

class TV extends Model
{

	public static function getShows() {
		$return_array = array();
		$s = DB::select('SELECT `show_name`, `show_id` FROM `tv_shows`', array());
		foreach ($s as $key => $show) {
			array_push($return_array, array(
											"title"  => $show->show_name,
											"id"     => $show->show_id,
											"link"   => '/tv' . '/' . $show->show_id,
											"poster" => '/images/tv_posters/' . $show->show_name . '.jpg',
											"type"   => 'show'
											));
		}

		return $return_array;
	}

	public static function getSeasons($id) {
		$return_array = array();
		$get_sezn = DB::select('SELECT `sezn_id`, `sezn_title`, `sezn_num`, `show_name` FROM `tv_seasons` JOIN `tv_shows` USING(`show_id`) WHERE `show_id` = ?', array($id));

		foreach ($get_sezn as $key => $sezn) {
			array_push($return_array, array(
											"id"        => $sezn->sezn_id,
											"title"     => $sezn->sezn_title,
											"link"      => '/tv' . '/' . $id . '/' . $sezn->sezn_id,
											"sezn_num"  => $sezn->sezn_num,
											"show_name" => $sezn->show_name,
											"poster"    => '/images/tv_posters/' . $sezn->show_name . '.jpg',
											"banner"    => '/images/tv_banners/' . $sezn->show_name . '.jpg',
											"type"      => 'seasons'
											));
		}

		return $return_array;
	}

	public static function getEpisodes($id) {
		$return_array = array();
		$get_epis = DB::select('SELECT `epis_id`, `epis_title`, `epis_num`,`path`, `sezn_id`, `sezn_title`, `sezn_num`, `show_name`, `tv_shows`.`show_id` FROM `tv_episodes` JOIN `tv_shows` USING(`show_id`) JOIN `tv_seasons` USING(`sezn_id`) WHERE `sezn_id` = ?', array($id));

		foreach ($get_epis as $key => $epis) {
			array_push($return_array, array(
											"id"        => $epis->epis_id,
											"title"     => $epis->epis_title,
											"link"      => $epis->path,
											"sezn_num"  => $epis->sezn_num,
											"show_name" => $epis->show_name,
											"poster"    => '/images/tv_posters/' . $epis->show_name . '.jpg',
											"banner"    => '/images/tv_banners/' . $epis->show_name . '.jpg',
											"type"      => 'episode'
											));
		}

		return $return_array;
	}


	public static function scanShows() {
		$return_array = array();

		$dir = 'E:/TV/';
		
		$get_shows = Utility::getThingsInDir($dir);

		foreach ($get_shows as $key => $show) {
			$i = DB::insert('INSERT `tv_shows` (`show_name`) VALUES (?)', array($show['name']));
			$show_id = DB::getPdo()->lastInsertId();
			$get_sezns = Utility::getThingsInDir($dir . $show['name']);

			foreach ($get_sezns as $sezn_num => $sezn) {
				$i = DB::insert('INSERT `tv_seasons` (`show_id`, `sezn_title`, `sezn_num`) VALUES (?,?,?)', array($show_id, $sezn['name'], $sezn_num + 1));
				$sezn_id = DB::getPdo()->lastInsertId();
				$get_episodes = Utility::getThingsInDir($dir . $show['name'] . '/' . $sezn['name']);

				foreach ($get_episodes as $epis_num => $epis) {
					$title = substr($epis['name'], 11); // episode ## 'title'
					$path = $dir . $show['name'] . '/' . $sezn['name'] . '/' . $epis['name'] . '.' . $epis['type'];

					$i = DB::insert('INSERT `tv_episodes` (`show_id`, `sezn_id`, `epis_num`, `epis_title`, `path`) VALUES (?,?,?,?,?)',
									array($show_id, $sezn_id, $epis_num + 1, $title, $path));
					
				}
			}
		}

		return $return_array;
	}
}
