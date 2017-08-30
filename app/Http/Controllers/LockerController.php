<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Locker;
use Auth;
use Carbon\Carbon;
use DB;
use View;

class LockerController extends Controller
{
    public function index() {
    	$return_array = array();
    	return View::make('locker.index', $return_array);
    }

    public function postNewEntry(Request $request) {
    	$user_id   = Auth::id();
    	$service   = encrypt($request->input('service'));
    	$email     = encrypt($request->input('email'));
    	$username  = encrypt($request->input('username'));
    	$password  = encrypt($request->input('password'));
    	$notes     = encrypt($request->input('notes'));

    	$i = DB::insert('INSERT INTO `locker` (`user_id`, `service`, `email`, `username`, `password`, `notes`) VALUES (?,?,?,?,?,?)', 
    						array($user_id, $service, $email, $username, $password, $notes));
    }

    public function postSearch(Request $request) {
    	$user_id = Auth::id();
    	$query   = $request->input('query');

    	$return_array = array();

    	$get_results = DB::select('SELECT `service`, `email`, `username`, `password`, `id` FROM `locker` WHERE `user_id` = ?',
    								array($user_id));

        foreach ($get_results as $key => $value) {
            $pos = strpos(strtolower(decrypt($value->service)), strtolower($query));
            if($pos !== false && $pos === 0) {
                array_push($return_array, array(
                                            'service'  => decrypt($value->service),
                                            'email'    => decrypt($value->email),
                                            'username' => decrypt($value->username),
                                            'password' => decrypt($value->password),
                                            'entry_id' => $value->id
                                            ));
            }
        }

    	return json_encode($return_array);
    }

    public function postDelete(Request $request) {
    	$user_id = Auth::id();
    	$entry_id = $request->input('entry_id');

    	$d = DB::delete('DELETE FROM `locker` WHERE `user_id` = ? AND `id` = ?', array($user_id, $entry_id));

    }

    public function anyEditIndex($entry_id) {
    	$return_array['entry'] = Locker::getEntry($entry_id);

    	return View::make('locker.edit', $return_array);

    }

    public function postApplyChanges(Request $request) {
    	$user_id = Auth::id();
    	$service   = encrypt($request->input('service'));
    	$email     = encrypt($request->input('email'));
    	$username  = encrypt($request->input('username'));
    	$password  = encrypt($request->input('password'));
        $notes     = encrypt($request->input('notes'));
    	$entry_id  = $request->input('entry_id');

    	$u = DB::update('UPDATE `locker` SET `service` = ?, `email` = ?, `username` = ?, `password` = ?, `notes` = ?, `updated_at` = NOW() WHERE `id` = ?',
    						array($service, $email, $username, $password, $notes, $entry_id));
    }
}
