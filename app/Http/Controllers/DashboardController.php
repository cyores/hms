<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

// use App;
use App\Models\Dashboard;
use App\Models\News;
use App\Models\Weather;
use Auth;
use Carbon\Carbon;
use DB;
use View;

class DashboardController extends BaseController
{
    public function index() {
        $user_id = Auth::id();

        $return_array['user'] = Dashboard::getUserInfo();
    	$return_array['upcoming_events'] = Dashboard::getUpcomingEvents();
        $return_array['weather']['curr'] = Weather::getCurrentInfo();
        $return_array['weather']['fore'] = Weather::getForecast();
        $return_array['news'] = News::getNews();
        
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
