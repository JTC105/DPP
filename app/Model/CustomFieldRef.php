<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomFieldRef extends Model
{
    protected $table = 'custom_fields_refs';

    public static function GetIdByDesc($desc) {
    	$id = self::where('desc', $desc)->first()->desc_id;

    	return $id;
    }
}
