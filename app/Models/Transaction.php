<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Carbon\Carbon;

class Transaction extends Model
{
    public static function getAllTransactions() {
    	$return_array = array();

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
