<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{

	public static function GetPrefixFilename() {
      $name = auth()->user()->username;

        if(auth()->user()->hasRole('dealer')) {
           $name = auth()->user()->dealer_party_id;
         }
         else {
           $temp = auth()->user()::whatRole();
           if($temp != null) {
           	  if($temp->name != "admin")
                $name = $temp->name;
           }
        }

        return $name;
    }

     public static function GetPrintTemplateName() {
        $filename = "preview";

        return $filename;
    }
}
