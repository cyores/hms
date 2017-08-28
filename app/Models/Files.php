<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Utility;

use Auth;
use Storage;

class Files extends Model
{

	public static function getUsersFiles($path = '') {
		$user_id = Auth::id();
        $d = Storage::disk('public');

        $dir  = 'backup' . '/' . $user_id . '/';
        $base = 'backup' . '/' . $path;

        if(!$d->exists('/' . $base)) $d->makeDirectory($base);

        $folders = $d->directories('/' . $base);
        $files   = $d->files('/' . $base);

        $return_array = array();

        foreach ($folders as $key => $obj_path) {
    		$type = substr(strrchr($obj_path, '.'), 1);
    		if($type == '') $type = "folder";
            if($type == 'db') continue;

            $name = str_replace($base, '', $obj_path);
            $name = str_replace('/', '', $name);
            $name = str_replace('.' . $type, '', $name);

            $obj_path = str_replace($dir, '', $obj_path);

    		$meta = array(
    					"name" => $name,
    					"type" => $type,
    					"path" => $obj_path
    					);

    		array_push($return_array, $meta);
    	}

    	foreach ($files as $key => $obj_path) {
    		$type = substr(strrchr($obj_path, '.'), 1);
    		if($type == '') $type = "folder";
            if($type == 'db') continue;

            $name = str_replace($base, '', $obj_path);
            $name = str_replace('/', '', $name);
            $name = str_replace('.' . $type, '', $name);

    		$meta = array(
    					"name" => $name,
    					"type" => $type,
    					"path" => '/' . $obj_path
    					);

    		array_push($return_array, $meta);
    	}

    	return $return_array;
	}

	public static function deleteFile($path){
        $d = Storage::disk('public');
        $d->delete($path);
	}

	public static function deleteDir($path){
		$user_id = Auth::id();
        $d = Storage::disk('public');
        $path = 'backup' . '/' . $user_id . '/' . $path;
        $d->deleteDirectory($path);
	}

	public static function makeDir($path) {
		$d = Storage::disk('public');
		$d->makeDirectory('backup' . $path);
	}

}
