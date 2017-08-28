<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use File;
use Storage;

class Utility {

    public static function getAllFiles(String $dir) {
		$return_array = array();
		$return_array = Utility::getFilesRec($dir, $return_array);
		return $return_array;
    }

    private static function getFilesRec(String $dir, Array &$return_array) {
    	$files = array_slice(scandir($dir), 2);
    	foreach ($files as $key => $filename) {
    		if(is_dir($dir . "/" . $filename)) {
				Utility::getFilesRec($dir . "/" . $filename, $return_array);
			}
			else {
				$path = $dir . "/" . $filename;
				$ext = substr(strrchr($path, '.'), 1);
				if($ext != 'db') {
					// $return_array[] = $filename;
					$return_array[] = array("title" => $filename, "path" => $path);
				}				
			}
    	}

    	return $return_array;
    }

}
