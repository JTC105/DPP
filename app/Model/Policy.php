<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Policy extends Model
{
    protected $table = 'policies';

    public static function CheckIfPasswordExpired() {
        if(auth()->user()->is_admin_level == 1) // Exception if SUPER ADMIN
            return false;

    	$expirycount = Policy::where('name', 'passExpiry')->first()->value;

    	$dateofexpiry = Carbon::parse(auth()->user()->last_changepass_date)->addDays($expirycount)->format('Y-m-d');
    	$datenow = Carbon::now('Asia/Manila')->format('Y-m-d');

    	if($dateofexpiry == $datenow) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public static function CheckIfPasswordExpiredWarning() {
        if(auth()->user()->is_admin_level == 1) // Exception if SUPER ADMIN
            return false;
            
        $expirycount = Policy::where('name', 'passExpiry')->first()->value;
    	$expirywarncount = $expirycount - Policy::where('name', 'passExpiryWarning')->first()->value;


    	$dateofexpirywarn = Carbon::parse(auth()->user()->last_changepass_date)->addDays($expirywarncount)->format('Y-m-d');
    	$datenow = Carbon::now('Asia/Manila')->format('Y-m-d');

        // $datenow = new Carbon('2019-03-13');
        // $datenow = Carbon::parse($datenow)->format('Y-m-d');
        // dd($dateofexpirywarn);

    	if($dateofexpirywarn <= $datenow) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public static function GetPassExpiryDate() {
        $expirycount = Policy::where('name', 'passExpiry')->first()->value;
        $dateofexpiry = Carbon::parse(auth()->user()->last_changepass_date)->addDays($expirycount)->format('M d, Y');

        return $dateofexpiry;
    }

    public static function GetPassExpiryDateInDays() {
        $expirycount = Policy::where('name', 'passExpiry')->first()->value;
        $dateofexpiry = Carbon::parse(auth()->user()->last_changepass_date)->addDays($expirycount);
        $datenow = Carbon::now('Asia/Manila');

        $days = $dateofexpiry->diffInDays($datenow);
        
        return $days;
    }
}
