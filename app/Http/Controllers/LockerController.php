<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Locker;
use Auth;
use Carbon\Carbon;
use DB;
use View;

class LockerController extends Controller
{
    public function index() {
    	$return_array = array();
    	return View::make('locker.index', $return_array);
    }
}
