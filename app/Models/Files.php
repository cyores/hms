<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Utility;

use Auth;
use DB;
use Carbon\Carbon;
use Storage;

class Files extends Model
{
    private $dir;
	private $vhost;

	public function __construct() {
		$this->dir = 'Z:/HMS/';
		$this->vhost = 'files.hms.dev';
	}

	public static function makeDir($rid) {
		$user_id = Auth::id();
		// if there is no directory for this user, create one.
		// @return the directory
		if(!file_exists($rid)) {
    		mkdir($rid);
    	}
    	return $rid;
	}
}
