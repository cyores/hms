<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TV;
use App\Models\Utility;

use Auth;
use Carbon\Carbon;
use DB;
use View;

class TVController extends Controller
{
    public function index() {
    	// $return_array = TV::scanShows();
    	$return_array['shows'] = TV::getShows();
    	return View::make('tv.index', $return_array);
    }

    public function anyShow($show_id) {
    	$return_array['seasons'] = TV::getSeasons($show_id);
    	return View::make('tv.show', $return_array);	
    }

    public function anySeason($show_id, $sezn_id) {
    	$return_array['episodes'] = TV::getEpisodes($sezn_id);
    	return View::make('tv.season', $return_array);	
    }

    public static function anyWatchEpisode($epis_id) {
        $return_array = array();
        $get_epis = DB::select(  'SELECT `epis_id`, `epis_title`, `epis_num`, `path`, `count`, `tv_seasons`.`sezn_title`, `tv_shows`.`show_name` FROM `tv_episodes`'
                                .'JOIN `tv_shows` USING(`show_id`)'
                                .'JOIN `tv_seasons` USING(`sezn_id`)'
                                .'WHERE `epis_id` = ?'
                                , array($epis_id));
        foreach ($get_epis as $key => $epis) {
            $path = str_replace('E:/', '', $epis->path);
            $return_array['episode'] = array(
                                        'title'      => $epis->epis_title,
                                        'epis_num'   => $epis->epis_num,
                                        'path'       => '/media' . '/' . $path,
                                        'count'      => $epis->count,
                                        'sezn_title' => $epis->sezn_title,
                                        'show_name'  => $epis->show_name
                                        );
        }

        $u = DB::update('UPDATE `tv_episodes` SET `count` = `count` + 1 WHERE `epis_id` = ?', array($epis_id));

        return View::make('tv.watch', $return_array);
    }
}
