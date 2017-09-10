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
    	$return_array['month'] = Transaction::getTransactionsFromPast('month');
    	return View::make('transactions.index', $return_array);
    }
}
