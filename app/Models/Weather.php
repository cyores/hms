<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Carbon\Carbon;
use DateTimeZone;

class Weather extends Model
{
    public static function getCurrentInfo() {
        $get_weather = DB::select('SELECT * FROM `weather` WHERE `type` = ?', array('current'));
        
        $now = Carbon::now(new DateTimeZone('America/Toronto'));
        $stamp = new Carbon($get_weather[0]->updated_at, 'America/Toronto');
        $diff = $now->diffInMinutes($stamp);

        if($diff < 10) {
            foreach ($get_weather as $key => $value) {
                $return_array['city']     = $value->city;
                $return_array['temp']     = round($value->temp);
                $return_array['humidity'] = $value->humidity;
                $return_array['title']    = $value->title;
                $return_array['desc']     = $value->desc;
                $return_array['icon']     = $value->icon;

                return $return_array;
            }
        }

    	$key = env('OPEN_WEATHER_API_KEY', 'key');
    	$vaughan = 6173577;
    	$london = 6058560;
    	$call_url = 'http://api.openweathermap.org/data/2.5/weather?id=' . $vaughan . "&units=metric" . '&appid=' . $key;

        try {
            $response = json_decode(file_get_contents($call_url));

            $return_array['city']     = $response->name;
            $return_array['temp']     = round($response->main->temp);
            $return_array['humidity'] = $response->main->humidity;
            $return_array['title']    = $response->weather[0]->main;
            $return_array['desc']     = ucfirst($response->weather[0]->description);
            $return_array['icon']     = $response->weather[0]->icon;

            $s = DB::select('SELECT `type` FROM `weather` WHERE `type` = ?', array('current'));
            if(empty($s)) {
                $i = DB::insert('INSERT INTO `weather` (`type`,`city`,`temp`,`humidity`,`title`,`desc`,`icon`) VALUES (?,?,?,?,?,?,?)',
                                array('current', $return_array['city'], $return_array['temp'], $return_array['humidity'],
                                                $return_array['title'], $return_array['desc'], $return_array['icon']));
            }
            else {
                $u = DB::update('UPDATE `weather` SET `city` = ?,`temp` = ?,`humidity` = ?,`title` = ?,`desc` = ?,`icon` = ?, `updated_at` = NOW() WHERE `type` = ?',
                                array($return_array['city'], $return_array['temp'], $return_array['humidity'], $return_array['title'], $return_array['desc'],
                                        $return_array['icon'], 'current'));
            }
            

        } catch(Exception $e) {
            $return_array['city']     = 'Could not connect';
            $return_array['temp']     = 'null';
            $return_array['humidity'] = 'null';
            $return_array['title']    = 'null';
            $return_array['desc']     = 'null';
            $return_array['icon']     = 'null';
        }
    	

    	return $return_array;
    }

    public static function getForecast() {
        $get_weather = DB::select('SELECT * FROM `weather` WHERE `type` LIKE ?', array('forecast_'));

        $return_array = array();

        $now = Carbon::now(new DateTimeZone('America/Toronto'));
        $stamp = new Carbon($get_weather[0]->updated_at, 'America/Toronto');
        $diff = $now->diffInMinutes($stamp);

        if($diff < 120) {
            foreach ($get_weather as $key => $value) {
                array_push($return_array, array(
                                                'time' => $value->hour,
                                                'temp' => $value->temp,
                                                'cond' => $value->title
                                                ));
            }
            return $return_array;
        }

        $key = env('OPEN_WEATHER_API_KEY', 'key');
        $vaughan = 6173577;
        $london = 6058560;
        $call_url = 'http://api.openweathermap.org/data/2.5/forecast?id=' . $vaughan . "&units=metric" . '&appid=' . $key;

        try {
            $response = json_decode(file_get_contents($call_url));

            foreach ($response->list as $key => $value) {
                if($key >= 5) break;
                $time = (new Carbon($value->dt_txt, 'America/Toronto'))->subHours(4)->hour;
                $temp = round($value->main->temp);
                $cond = $value->weather[0]->main;
                $cond = str_replace('Clouds', 'Cloudy', $cond);

                $s = DB::select('SELECT `type` FROM `weather` WHERE `type` LIKE ?', array('forecast_'));
                if(empty($s)) {
                    $i = DB::insert('INSERT INTO `weather` (`type`,`hour`,`temp`,`title`) VALUES (?,?,?,?)', array('forecast' . $key, $time, $temp, $cond));    
                }
                else {
                    $u = DB::update('UPDATE `weather` SET `hour` = ?, `temp` = ?, `title` = ?, `updated_at` = NOW() WHERE `type` = ?',
                                array($time, $temp, $cond, 'forecast' . $key));
                }

                array_push($return_array, array(
                                                'time' => $time,
                                                'temp' => $temp,
                                                'cond' => $cond
                                                ));

            }

        } catch(Exception $e) {

        }
        

        return $return_array;
    }
}
