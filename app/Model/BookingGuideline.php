<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookingGuideline extends Model
{
    protected $table = 'booking_guideline';

     public static function GetGuidelineSummary() {
     	$d = self::orderBy('created_at', 'desc')->get();

    	return $d;
     }

     public static function GetSourcepath() {
     	return "uploads/bookingguideline/";
     }
}
