<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Carbon\Carbon;

class Dashboard extends Model
{
    public static function getUpcomingEvents() {
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
		return $return_array;
    }
}
