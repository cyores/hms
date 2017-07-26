<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App;
use Auth;
use Carbon\Carbon;
use DB;
use View;

class DashboardController extends Controller
{
    public function index() {
    	$return_array = array();
    	$user_id = Auth::id();

    	// basic info
    	$get_name = DB::select('SELECT `name` FROM `users` WHERE `id` = ? LIMIT 1', array($user_id));
    	$return_array['name'] = ucfirst($get_name[0]->name);
		$return_array['date'] = Carbon::now()->subHours(4)->toDayDateTimeString();

		// upcoming events
		$get_events = DB::select('SELECT * FROM `upcoming_events` WHERE (`user_id` = ? OR `public` = "Y") AND `event_on` >= NOW() - INTERVAL 1 DAY ORDER BY `event_on` ASC LIMIT 5 ', array($user_id));
		foreach ($get_events as $key => $event) {
			$return_array['events'][$event->id] = array(
														"title" => $event->title,
														"desc" => $event->desc,
														"date" => (new Carbon($event->event_on))->toFormattedDateString(),
														"time" => $event->event_time,
														"public" => $event->public
														);
		}
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
