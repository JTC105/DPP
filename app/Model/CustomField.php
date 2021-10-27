<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $table = 'custom_fields';

    public static function GetFieldNameByDescAndFieldId($desc, $fieldid) {
    	$id = CustomFieldRef::GetIdByDesc($desc);

    	$name = self::where('desc_id', $id)->where('field_id', $fieldid)->first()->field_name;

    	return $name;
    }

    public static function GetFieldsByDesc($desc) {
    	$id = CustomFieldRef::GetIdByDesc($desc);
    	$result = self::where('desc_id', $id)->get();

    	return $result;
    }

    public static function GetConReqFieldValueByDescAndFieldId($fieldid) {
        $result = self::where('desc_id', 105)->where('field_id', $fieldid)->first();

        if($result!=null)
        $result = $result->field_value;

        return $result;
    }

    public static function GetConReqFieldValuesByConReqIdsBeforePrinting() {
        $result = self::where('desc_id', 105)->where('field_id', 22)->first()->field_value;
        $result = explode(',', $result);

        if($result[0] != null) {

            $notes = "";

            for($i=0; $i < count($result); $i++) {
                $data = self::GetConReqFieldValueByDescAndFieldId($result[$i]);
                $notes .= " (".($i+1).") ".$data;
            }

        } else {
            $notes = "Nothing is required.";
        }

        return $notes;

    }
}
