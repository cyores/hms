<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Carbon\Carbon;
use DateTimeZone;

class News extends Model
{
    public static function getNews() {
    	$return_array = array();

    	$key = env('NEWS_API_KEY', 'key');
    	$sources = 'the-next-web,the-verge,bbc-news,bbc-sport,engadget,independent';
    	$cates = '';
    	// $call_url = 'https://newsapi.org/v2/top-headlines?sources=' . $sources . '& apiKey=' . $key;
    	$call_url = 'https://newsapi.org/v1/articles?source=the-next-web&sortBy=latest&apiKey=28e3c8b09eb14492a0c904d1166a862e';

    	try {
    		$response = json_decode(file_get_contents($call_url));

    		foreach ($response->articles as $key => $value) {
    			if($key >= 2) break;
    			array_push($return_array, array(
    											"source"    => $response->source,
    											"author"    => $value->author,
    											"title"     => $value->title,
    											"desc"      => $value->description,
    											"link"      => $value->url,
    											"image"     => $value->urlToImage,
    											"published" => $value->publishedAt
    											));
    		}

    	} catch(Exception $e) {

    	}

    	return $return_array;

    }
}
