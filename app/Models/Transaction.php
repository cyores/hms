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

    public static function getAllTimeSpending() {
    	$user_id = Auth::id();
    	$return_array['categories'] = array();
    	$return_array['amounts'] = array();

    	$get_cats = DB::table('transactions')->selectRaw('cate, SUM(amount) as amt')->where('user_id', '=', $user_id)->groupBy('cate')->get();

    	foreach ($get_cats as $key => $value) {
    		array_push($return_array['categories'], $value->cate);
    		array_push($return_array['amounts'], round($value->amt, 3));
    	}

    	return $return_array;
    }

    public static function getSpendingPerMonth() {
    	$user_id = Auth::id();
    	$return_array['months'] = array();
    	$return_array['mo_amts'] = array();

    	$get = DB::table('transactions')->selectRaw('MONTH(`date`) as `month`, SUM(`amount`) as `amt`')
                                        ->where('user_id', '=', $user_id)
                                        ->groupBy('month')
                                        ->latest('date')
                                        ->limit(10)
                                        ->get();

    	foreach ($get as $key => $value) {
    		array_push($return_array['months'], date("F",mktime(0,0,0,$value->month,1,2017)));
    		array_push($return_array['mo_amts'], $value->amt);
    	}

        $return_array['months'] = array_reverse($return_array['months']);
        $return_array['mo_amts'] = array_reverse($return_array['mo_amts']);

    	return $return_array;
    }

    public static function getSpendingLastTenDays() {
        $user_id = Auth::id();
        $return_array['days'] = array();
        $return_array['da_amts'] = array();
        $temp_array = array();

        $get = DB::table('transactions')->selectRaw('`date` as `day`, SUM(`amount`) as `amt`')
                                        ->where('user_id', '=', $user_id)
                                        ->groupBy('day')
                                        ->latest('date')
                                        ->limit(10)
                                        ->get();
        
        foreach ($get as $key => $value) {
            $temp_array[(new Carbon($value->day))->toFormattedDateString()] = $value->amt;
        }

        $d = (new Carbon())->toFormattedDateString();
        array_push($return_array['days'], $d);

        for ($i = 0; $i < 9; $i++) {
            $d = ((new Carbon($d))->subDay())->toFormattedDateString();
            array_push($return_array['days'], $d);
        }

        foreach ($return_array['days'] as $key => $day) {
            if(isset($temp_array[$day])) {
                array_push($return_array['da_amts'], $temp_array[$day]);
            }
            else {
                array_push($return_array['da_amts'], 0);
            }
        }

        $return_array['days'] = array_reverse($return_array['days']);
        $return_array['da_amts'] = array_reverse($return_array['da_amts']);
        return $return_array;
    }

    public static function getCates() {
        // for the dropdowns in new ta

        $cates = DB::select('SHOW COLUMNS FROM `transactions` LIKE \'cate\'');

        $vals = str_replace('enum', '', $cates[0]->Type);
        $vals = str_replace('(', '', $vals);
        $vals = str_replace(')', '', $vals);
        $vals = str_replace('\'', '', $vals);
        $vals = explode(',', $vals);
        
        return $vals;
    }

    public static function getTypes() {
        // for the dropdowns in new ta

        $cates = DB::select('SHOW COLUMNS FROM `transactions` LIKE \'type\'');

        $vals = str_replace('enum', '', $cates[0]->Type);
        $vals = str_replace('(', '', $vals);
        $vals = str_replace(')', '', $vals);
        $vals = str_replace('\'', '', $vals);
        $vals = explode(',', $vals);
        
        return $vals;
    }
}
