<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkRegisterModel extends Model
{
    use HasFactory;

    protected $table = "mark_registers";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    static public function checkAlreadyMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return MarkRegisterModel::where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function getExam($student_id)
    {
        return self::select('mark_registers.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'mark_registers.exam_id')
            ->where('mark_registers.student_id', '=', $student_id)
            ->groupBy('mark_registers.exam_id')
            ->get();
    }

    static public function getExamSubject($exam_id, $student_id)
    {
        return self::select('mark_registers.*', 'exam.name as exam_name', 'subject.name as subject_name')
            ->join('exam', 'exam.id', '=', 'mark_registers.exam_id')
            ->join('subject', 'subject.id', '=', 'mark_registers.subject_id')
            ->where('mark_registers.exam_id', '=', $exam_id)
            ->where('mark_registers.student_id', '=', $student_id)
            ->get();
    }
}
