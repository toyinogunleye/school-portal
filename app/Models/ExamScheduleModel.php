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

    static function getExam($class_id)
    {
        return self::select('exam_schedule.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', 'exam_schedule.exam_id')
            ->where('exam_schedule.class_id', '=', $class_id)
            ->groupBy('exam_id')
            ->orderBy('exam_schedule.created_at', 'desc')
            ->get();
    }

    static public function getExamTimetable($exam_id, $class_id)
    {
        return self::select('exam_schedule.*', 'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', 'exam_schedule.subject_id')
            ->where('exam_schedule.exam_id', '=', $exam_id)
            ->where('exam_schedule.class_id', '=', $class_id)
            ->get();
    }

    static public function getSubject($exam_id, $class_id)
    {
        return self::select('exam_schedule.*', 'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', 'exam_schedule.subject_id')
            ->where('exam_schedule.exam_id', '=', $exam_id)
            ->where('exam_schedule.class_id', '=', $class_id)
            ->get();
    }
}
