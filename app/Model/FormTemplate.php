<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FormTemplate extends Model
{
    protected $table = 'form_templates';

    public static function GetFormTemplates() {

    	$d = self::all();

    	return $d;
    }
}
