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

    	$return_array['path'] = Auth::user()->name;;

    	return View::make('files.index', $return_array);
    }

    public function anyOpenFolder($path) {
    	$user_id = Auth::id();

    	$return_array = array();

    	$return_array['user_name'] = Auth::user()->name;

    	$path = $user_id . '/' . $path;
    	$return_array['objects'] = Utility::getThingsInDir($this->dir . $path);

    	$return_array['path'] = $path;

    	return View::make('files.folder', $return_array);
    }

    public function postUploadFiles(Request $request) {
    	$path = $this->dir . $request->input("path") . '/';
    	$path = str_replace(Auth::user()->name, Auth::id(), $path);

    	$files_exist = $request->input("files_exist");

    	if($files_exist == 'true') {
    		foreach ($_FILES as $key => $file) {
    			$file_name = $file["name"];
    			$file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    			$file_file = $file["tmp_name"];

    			$target_file = $path . $file_name;

    			move_uploaded_file($file_file, $target_file);
    		}
    	}
    	
    }

}
