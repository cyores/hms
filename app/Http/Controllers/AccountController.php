<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use View;

class AccountController extends Controller
{
    public static function index() {
    	$return_array['user'] = array();
    	$id = Auth::id();
    	$get_user = DB::select('SELECT * FROM `users` WHERE `id` = ?', array($id));
    	foreach ($get_user as $key => $user) {
    		$return_array['user'] = array(
												"name"  => $user->name,
												"email" => $user->email
											);
    	}

    	return View::make('account.index', $return_array);
    }
}
