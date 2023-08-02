<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimetableModel extends Model
{
    use HasFactory;

    protected $table = "class_subject_timetable";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    static public function getRecordClassSubject($class_id, $subject_id, $week_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->where('week_id', '=', $week_id)->first();
    }
}
