<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class ExamScheduleModel extends Model
{
    use HasFactory;

    protected $table = "exam_schedule";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    static function getRecordSingle($exam_id, $class_id, $subject_id)
    {
        return self::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static function deleteRecord($exam_id, $class_id)
    {
        return self::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->delete();
    }
}
