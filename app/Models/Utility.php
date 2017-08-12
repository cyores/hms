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

    public static function getThingsInDir(String $dir) {
    	// return array_slice(scandir($dir), 2);

    	$objs = array_slice(scandir($dir), 2);
    	$return_array = array();

    	foreach ($objs as $key => $object) {
    		$type = substr(strrchr($object, '.'), 1);
    		if($type == '') $type = "folder";

    		$path = str_replace('Z:/HMS/', '', $dir . '/' . $object);
    		$path = strstr($path, '/');

    		$meta = array(
    					"name" => explode('.', $object, 2)[0],
    					"type" => $type,
    					"path" => $path
    					);

    		array_push($return_array, $meta);
    	}

    	return $return_array;
    }
}
