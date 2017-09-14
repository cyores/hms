<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use DB;
use View;

class TransactionController extends Controller
{
    public function index() {
    	$return_array['all'] = Transaction::getAllTransactions();
    	$return_array['donutData'] = Transaction::getAllTimeSpending();
    	$return_array['spm'] = Transaction::getSpendingPerMonth();
        $return_array['sltd'] = Transaction::getSpendingLastTenDays();
    	$return_array['nta_types'] = Transaction::getTypes();
    	$return_array['nta_cates'] = Transaction::getCates();
    	return View::make('transactions.index', $return_array);
    }

    public function postNewTransaction(Request $request) {
    	$user_id = Auth::id();
    	$vendor = $request->input('vendor');
    	$amt    = $request->input('amt');
    	$type   = $request->input('type');
    	$cate   = $request->input('cate');
    	$tags   = $request->input('tags');
    	$date   = $request->input('date');

    	$i = DB::table('transactions')->insert([
    											'vendor' => $vendor,
    											'amount' => $amt,
    											'type' => $type,
    											'cate' => $cate,
    											'tags' => $tags,
    											'date' => $date
    											]);

    }
}
