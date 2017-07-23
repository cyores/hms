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
    	$id = Auth::id();
    	$get_name = DB::select('SELECT `name` FROM `users` WHERE `id` = ? LIMIT 1', array($id));
		foreach ($get_name as $key => $name) {
			$return_array['user'] = array(
					'name' => ucfirst($name->name) 
					);
		}
		$return_array['date'] = Carbon::now()->subHours(4)->toDayDateTimeString();
    	return View::make('dashboard.index', $return_array);
    }
}
