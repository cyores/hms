<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App;
use View;

class DashboardController extends Controller
{
    public function index() {
    	$return_array = array();
    	return View::make('dashboard.index', $return_array);
    }
}
