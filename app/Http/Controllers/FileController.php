<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Files;
use App\Models\Utility;

use Auth;
use Carbon\Carbon;
use DB;
use View;

class FileController extends Controller
{
	private $dir;
	private $vhost;

	public function __construct() {
		$this->dir = 'Z:/HMS/';
		$this->vhost = 'files.hms.dev';
	}

    public function index() {
    	$user_id = Auth::id();

    	$this->dir = Files::makeDir($this->dir . $user_id);

    	$return_array = array();

    	$return_array['user_name'] = Auth::user()->name;

    	$return_array['objects'] = Utility::getThingsInDir($this->dir);

    	return View::make('files.index', $return_array);
    }

    public function anyOpenFolder($path) {
    	$user_id = Auth::id();

    	$return_array = array();

    	$return_array['user_name'] = Auth::user()->name;

    	$path = str_replace("-", '/', $path);
    	$path = $user_id . $path;
    	$return_array['objects'] = Utility::getThingsInDir($this->dir . $path);

    	$return_array['path'] = $path;

    	return View::make('files.folder', $return_array);
    }

}
