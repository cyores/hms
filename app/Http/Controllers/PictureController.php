<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Utility;

use Auth;
use Carbon\Carbon;
use DB;
use View;

class PictureController extends Controller
{
    public function index() {
    	$return_array = array();
    	return View::make('pictures.index', $return_array);
    }
}
