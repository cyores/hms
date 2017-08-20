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
    	// $return_array = TV::getAllShows();
    	$return_array = TV::scanShows();
    	// $return_array = array();
    	return View::make('tv.index', $return_array);
    }
}
