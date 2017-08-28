<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Carbon\Carbon;

class Locker extends Model
{
    public static function getEntry($entry_id) {
    	$return_array = array();

    	$get_entry = DB::select('SELECT * FROM `locker` WHERE `id` = ? LIMIT 1', array($entry_id));

    	foreach ($get_entry as $key => $value) {
    		$return_array['entry_id']   = $value->id;
    		$return_array['service']    = $value->service;
    		$return_array['email']      = $value->email;
    		$return_array['username']   = $value->username;
    		$return_array['password']   = decrypt($value->password);
    		$return_array['created_at'] = (new Carbon($value->created_at))->toDayDateTimeString();
    		$return_array['updated_at'] = (new Carbon($value->updated_at))->toDayDateTimeString();;
    	}

    	return $return_array;
    }

    public static function changeEntry($entry_id) {
    	
    }
}
