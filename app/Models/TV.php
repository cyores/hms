<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Utility;

use Auth;
use DB;
use Carbon\Carbon;

class TV extends Model
{
	public static function scanShows() {
		$return_array = array();

		$dir = 'E:/TV';
		
		$get_shows = Utility::getThingsInDir($dir);

		foreach ($get_shows as $key => $show) {
			$get_sezns = Utility::getThingsInDir($dir . $show);
			foreach ($get_sezns as $sezn_num => $sezn) {
				$get_episodes = Utility::getThingsInDir($dir . $show . $sezn);
				foreach ($get_episodes as $epis_num => $epis) {
					$s = DB::select('SELECT `id` FROM `tvshows` WHERE `show_title` = ? AND `sezn_num` = ? AND `epis_num` = ?', array($show,, $sezn_num, $epis_num));
					if(empty($s)) {
						$i = DB::insert('INSERT `tvshows` (`show_title`,`sezn_title`,`sezn_num`,`epis_title`,`epis_num`,`path`) VALUES (?,?,?,?,?,?)',
										array($show, $sezn, $sezn_num, $epis, $epis_num, $path));
					}
					
				}
			}
		}
	}
}
