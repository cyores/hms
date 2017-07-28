<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

// use App;
use App\Models\Dashboard;
use Auth;
use Carbon\Carbon;
use DB;
use View;

class DashboardController extends BaseController
{
    public function index() {
    	$return_array = Dashboard::getUpcomingEvents();
    	return View::make('dashboard.index', $return_array);
    }

    public function postNewEvent(Request $request) {
    	$user_id   = Auth::id();
    	$title     = $request->input('title');
    	$desc      = $request->input('desc');
    	$public    = $request->input('public');
    	$date      = $request->input('date');
    	$time      = $request->input('time'); 

        $convert_time = date("H:i", strtotime($time));

        $event_on = $date . " " . $convert_time;  	

    	$i = DB::insert('INSERT INTO `upcoming_events` (`user_id`, `title`, `desc`, `public`, `event_on`, `event_time`) VALUES (?,?,?,?,?,?)', 
    				array($user_id, $title, $desc, $public, $event_on, $time));

    }
}
