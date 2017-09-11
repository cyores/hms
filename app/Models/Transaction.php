<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Carbon\Carbon;

class Transaction extends Model
{
    public static function getAllTransactions() {
    	$user_id = Auth::id();
    	$return_array = array();

    	$get_tas = DB::table('transactions')->select('id', 'vendor', 'amount', 'type', 'cate', 'desc', 'date')->where('user_id', '=', $user_id)->latest('date')->get();

    	foreach ($get_tas as $key => $value) {
    		array_push($return_array, array(
    										'id'     => $value->id,
    										'vendor' => $value->vendor,
    										'amount' => $value->amount,
    										'type'   => $value->type,
    										'cate'   => $value->cate,
    										'desc'   => $value->desc,
    										'date'   => (new Carbon($value->date))->toFormattedDateString()
    										));
    	}

    	return $return_array;    	
    }

    public static function getTransactionsFromPast(String $time_period) {
    	$cond = '';
    	$return_array = array();

    	switch($time_period) {
			case 'year':
    			$cond = '';
    			break;
			case 'month':
    			$cond = '';
    			break;
    		case 'week':
    			$cond = '';
    			break;
    	}

    	return $return_array;
    }

    public static function getTransactionsOn(String $date) {
    	
    }
}
