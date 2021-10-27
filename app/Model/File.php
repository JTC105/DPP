<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    // protected $table = 'files';

    public static function GetFormTemplatePath() {
    	return 'uploads/formtemplates/';
    }
}
