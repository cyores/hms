<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Files;

use Auth;
use Storage;
use View;

class FileController extends Controller
{
    public function anyOpenFolder($path = '') {
    	$user_id = Auth::id();
        $user_name = Auth::user()->name;

        $return_array = array();

        if($path == '') {
            $path = $user_id;
            $return_array['objects'] = Files::getUsersFiles($path);
        }    	
        else {
            $path = $user_id . '/' . $path;
            $return_array['objects'] = Files::getUsersFiles($path);
        }   	

        $return_array['user_name'] = $user_name;
    	$return_array['path'] = preg_replace('#'.$user_id.'#i', $user_name, $path, 1);

    	return View::make('files.folder', $return_array);
    }

    public function postDelete(Request $request) {
        $path = $request->input('path');
        if(strpos($path, '.') !== false){
            Files::deleteFile($path);
        }
        else {
            Files::deleteDir($path);
        }
    }

    public function postNewFolder(Request $request) {
        $path = $request->input('path');
        $path = str_replace(Auth::user()->name, Auth::id(), $path);
        $name = $request->input('name');
        Files::makeDir('/' . $path . '/' . $name);
    }

    public function postUploadFiles(Request $request) {
        $d = Storage::disk('public');

        $path = $request->input('path');
        $path = str_replace(Auth::user()->name, Auth::id(), $path);
        
        $files_exist = $request->input("files_exist");

        $return_array['files_added'] = 'no';

        if($files_exist == 'true') {
            foreach ($_FILES as $key => $file) {
                $return_array['files_added'] = 'yes';

                $file_name = $file["name"];
                $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $file_file = $file["tmp_name"];

                $target_path = 'backup' . '/' . $path . '/' . $file_name;
                
                $d->put($target_path, file_get_contents($file_file));
            }
        }

        return json_encode($return_array);
    }

}
