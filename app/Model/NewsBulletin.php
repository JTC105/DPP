<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsBulletin extends Model
{
     protected $table = 'news_bulletin';

     public static function GetAllNews() {
     	$d = self::orderBy('created_at', 'desc')->get();

    	return $d;
     }

     public static function GetNews() {
     	$d = self::where('is_visible', 1)->orderBy('created_at', 'desc')->get();

    	return $d;
     }

	public static function GetSourcepathNB() {
     	return "uploads/newsbulletin/";
     }

}
