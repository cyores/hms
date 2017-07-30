<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utility {

    public static function getAllFiles(String $dir) {
		$return_array = array();
		$return_array = Utility::getFilesRec($dir, $return_array);
		return $return_array;
    }

    private static function getFilesRec(String $dir, Array &$return_array) {
    	$files = array_slice(scandir($dir), 2);
    	foreach ($files as $key => $value) {
    		if(is_dir($dir . "/" . $value)) {
				Utility::getFilesRec($dir . "/" . $value, $return_array);
			}
			else {
				$path = $dir . "/" . $value;
				$ext = substr(strrchr($path, '.'), 1);
				if($ext != 'db') {
					$return_array[] = $value;
				}				
			}
    	}

    	return $return_array;
    }
}
