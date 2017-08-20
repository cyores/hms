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
		$s = DB::select('SELECT DISTINCT `show_title`, `id` FROM `tvshows`', array());
		foreach ($s as $key => $show) {
			array_push($return_array, $show->show_title);
		}

		return $return_array;
	}

	public static function scanShows() {
		$return_array = array();

		$dir = 'E:/TV/';
		
		$get_shows = Utility::getThingsInDir($dir);

		foreach ($get_shows as $key => $show) {
			$get_sezns = Utility::getThingsInDir($dir . $show['name']);
			foreach ($get_sezns as $sezn_num => $sezn) {
				$get_episodes = Utility::getThingsInDir($dir . $show['name'] . '/' . $sezn['name']);
				foreach ($get_episodes as $epis_num => $epis) {
					$title = substr($epis['name'], 11); // episode ## 

					$s = DB::select('SELECT `id` FROM `tvshows` WHERE `show_title` = ? AND `sezn_num` = ? AND `epis_num` = ? AND `epis_title` = ?',
									array($show['name'], $sezn_num + 1, $epis_num + 1, $title));

					// seasons start at 0 for spartacus
					$sparta = DB::select('SELECT `id` FROM `tvshows` WHERE `show_title` = ? AND `sezn_num` = ? AND `epis_num` = ? AND `epis_title` = ?',
									array($show['name'], $sezn_num, $epis_num + 1, $title));

					if(empty($s) && empty($sparta)) {
						$path = $dir . $show['name'] . '/' . $sezn['name'] . '/' . $epis['name'] . '.' . $epis['type'];

						// because Spartacus has season titles and starts at season 0
						if($show['name'] == 'Spartacus') {
							switch ($sezn_num) {
								case 0:
									$sezn['name'] = 'Gods of the Arena';
									break;
								case 1:
									$sezn['name'] = 'Blood and Sand';
									break;
								case 2:
									$sezn['name'] = 'Vengeance';
									break;
								case 3:
									$sezn['name'] = 'War of the Damned';
									break;
								default:
									break;
							}
							$i = DB::insert('INSERT `tvshows` (`show_title`,`sezn_title`,`sezn_num`,`epis_title`,`epis_num`,`path`) VALUES (?,?,?,?,?,?)',
										array($show['name'], $sezn['name'], $sezn_num, $title, $epis_num + 1, $path));
							continue;
						}

						$i = DB::insert('INSERT `tvshows` (`show_title`,`sezn_title`,`sezn_num`,`epis_title`,`epis_num`,`path`) VALUES (?,?,?,?,?,?)',
										array($show['name'], $sezn['name'], $sezn_num + 1, $title, $epis_num + 1, $path));

					}
					
				}
			}
		}

		return $return_array;
	}
}
