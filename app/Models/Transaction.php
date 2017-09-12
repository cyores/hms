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

    public static function getAllTimeSpending() {
    	$user_id = Auth::id();
    	$return_array['categories'] = array();
    	$return_array['amounts'] = array();

    	$get_cats = DB::table('transactions')->selectRaw('cate, SUM(amount) as amt')->where('user_id', '=', $user_id)->groupBy('cate')->get();

    	foreach ($get_cats as $key => $value) {
    		array_push($return_array['categories'], $value->cate);
    		array_push($return_array['amounts'], $value->amt);
    	}

    	return $return_array;
    }

    public static function getSpendingPerMonth() {
    	$user_id = Auth::id();
    	$return_array['months'] = array();
    	$return_array['mo_amts'] = array();

    	$get = DB::table('transactions')->selectRaw('MONTH(`date`) as `month`, SUM(`amount`) as `amt`')->where('user_id', '=', $user_id)->groupBy('month')->get();

    	foreach ($get as $key => $value) {
    		array_push($return_array['months'], date("F",mktime(0,0,0,$value->month,1,2017)));
    		array_push($return_array['mo_amts'], $value->amt);
    	}

    	return $return_array;
    }

    public static function getCates() {

        $cates = DB::select('SHOW COLUMNS FROM `transactions` LIKE \'cate\'');

        $vals = str_replace('enum', '', $cates[0]->Type);
        $vals = str_replace('(', '', $vals);
        $vals = str_replace(')', '', $vals);
        $vals = str_replace('\'', '', $vals);
        $vals = explode(',', $vals);
        // dd(json_encode($vals));
        return $vals;

    }

    public static function getTypes() {

        $cates = DB::select('SHOW COLUMNS FROM `transactions` LIKE \'type\'');

        $vals = str_replace('enum', '', $cates[0]->Type);
        $vals = str_replace('(', '', $vals);
        $vals = str_replace(')', '', $vals);
        $vals = str_replace('\'', '', $vals);
        $vals = explode(',', $vals);
        // dd(json_encode($vals));
        return $vals;

    }
}
