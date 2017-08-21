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
}
