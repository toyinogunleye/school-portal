<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkGradeModel extends Model
{
    use HasFactory;

    protected $table = "mark_grade";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    static function getRecord()
    {
        return self::select('mark_grade.*', 'users.name as user_fname', 'users.last_name as user_lname', 'users.middle_name as user_mname')
            ->join('users', 'users.id', '=', 'mark_grade.created_by')
            ->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static function getGrade($percent)
    {
        $return = self::select('mark_grade.*')
            ->where('percent_from', '<=', $percent)
            ->where('percent_to', '>=', $percent)
            ->first();

        return !empty($return->name) ? $return->name : '';
    }
}
