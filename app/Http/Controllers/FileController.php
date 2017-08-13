<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Files;
use App\Models\Utility;

use Auth;
use Carbon\Carbon;
use DB;
use Route;
use View;

class FileController extends Controller
{
	private $dir;
	private $vhost;

	public function __construct() {
        $user_id = Auth::id();
		$this->dir = 'Z:/HMS/';
		$this->vhost = 'files.hms.dev';
	}

    public function anyOpenFolder($path = '') {
    	$user_id = Auth::id();
        $user_name = Auth::user()->name;

        $return_array = array();

        if($path == '') {
            $path = $user_id;
            $return_array['objects'] = Utility::getThingsInDir($this->dir . $path);
        }    	
        else {
            $path = $user_id . '/' . $path;
            $return_array['objects'] = Utility::getThingsInDir($this->dir . $path);
        }   	

        $return_array['user_name'] = $user_name;
    	$return_array['path'] = preg_replace('#'.$user_id.'#i', $user_name, $path, 1);

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

    public function postDelete(Request $request) {
        $path = Auth::id() . $request->input('path');
        if(strpos($path, '.') !== false) {
            unlink($this->dir . $path);
        }  
        else {
            rmdir($this->dir . $path);
        }     
    }

    public function postNewFolder(Request $request) {
        $path = $this->dir . $request->input('path');
        $path = str_replace(Auth::user()->name, Auth::id(), $path);
        $name = $request->input('name');
        mkdir($path . '/' . $name);
    }

}
