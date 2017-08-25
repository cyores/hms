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
    	$service   = $request->input('service');
    	$email     = $request->input('email');
    	$username  = $request->input('username');
    	$password  = encrypt($request->input('password'));
    	// $password  = $request->input('password');

    	$i = DB::insert('INSERT INTO `locker` (`user_id`, `service`, `email`, `username`, `password`) VALUES (?,?,?,?,?)', 
    						array($user_id, $service, $email, $username, $password));
    }

    public function postSearch(Request $request) {
    	$user_id = Auth::id();
    	$query   = $request->input('query');

    	$return_array = array();

    	$get_results = DB::select('SELECT `service`, `email`, `username`, `password`, `id` FROM `locker` WHERE `user_id` = ? AND `service` LIKE ?',
    								array($user_id, $query . '%'));

    	foreach ($get_results as $key => $value) {
    		array_push($return_array, array(
    										'service'  => $value->service,
    										'email'    => $value->email,
    										'username' => $value->username,
    										'password' => decrypt($value->password),
    										'entry_id' => $value->id
    										));
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
    	$service   = $request->input('service');
    	$email     = $request->input('email');
    	$username  = $request->input('username');
    	$password  = encrypt($request->input('password'));
    	$entry_id  = $request->input('entry_id');

    	$u = DB::update('UPDATE `locker` SET `service` = ?, `email` = ?, `username` = ?, `password` = ? WHERE `id` = ?',
    						array($service, $email, $username, $password, $entry_id));
    }
}
