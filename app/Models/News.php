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

        $get_news = DB::select('SELECT * FROM `news`', array());
        
        $now = Carbon::now(new DateTimeZone('America/Toronto'));
        $stamp = new Carbon($get_news[0]->updated_at, 'America/Toronto');
        $diff = $now->diffInMinutes($stamp);

        if($diff < 30) {
            foreach ($get_news as $key => $value) {
                array_push($return_array, array(
                                                "source"    => $value->source,
                                                "author"    => $value->author,
                                                "title"     => $value->title,
                                                "desc"      => $value->desc,
                                                "link"      => $value->link,
                                                "image"     => $value->img_url,
                                                "published" => $value->published_at
                                                ));
            }
            return $return_array;
        }

    	$key = env('NEWS_API_KEY', 'key');
    	$sources = 'the-next-web,the-verge,ars-technica,engadget,google-news-ca';
    	$cates = '';
        $call_url = 'http://beta.newsapi.org/v2/top-headlines?sources=' . $sources . '&apiKey=' . $key;
    	// $call_url = 'https://newsapi.org/v1/articles?source=the-next-web&sortBy=latest&apiKey=28e3c8b09eb14492a0c904d1166a862e';

    	try {
    		$response = json_decode(file_get_contents($call_url));

            $seen_sources = array();
            $counter = 0;

    		foreach ($response->articles as $key => $value) {
                if(!in_array($value->source->name, $seen_sources)) {
                    array_push($seen_sources, $value->source->name);
                    $counter++;
                }
                else {
                    continue;
                }

                $source    = $value->source->name;
                $author    = $value->author;
                $title     = $value->title;
                $desc      = $value->description;
                $link      = $value->url;
                $img_url   = $value->urlToImage;
                $published = (new Carbon($value->publishedAt))->subHours(4)->ToDayDateTimeString();

                $s = DB::select('SELECT `id` FROM `news` WHERE `id` = ?', array($counter));
                if(empty($s)) {
                    $i = DB::insert('INSERT INTO `news` (`source`,`author`,`desc`,`title`,`link`,`img_url`,`published_at`) VALUES (?,?,?,?,?,?,?)',
                                        array($source, $author, $desc, $title, $link, $img_url, $published));
                }
                else {
                    $u = DB::update('UPDATE `news` SET `source` = ?, `author` = ?, `desc` = ?, `title` = ?, `link` = ?, `img_url` = ?, `published_at` = ?,
                                        `updated_at` = NOW() WHERE `id` = ?', array($source, $author, $desc, $title, $link, $img_url, $published, $counter));
                }

                array_push($return_array, array(
                                                "source"    => $source,
                                                "author"    => $author,
                                                "title"     => $title,
                                                "desc"      => $desc,
                                                "link"      => $link,
                                                "image"     => $img_url,
                                                "published" => $published
                                                ));

    		}

    	} catch(Exception $e) {

    	}

    	return $return_array;

    }
}
