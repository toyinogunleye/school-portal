<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubmitHomeworkModel extends Model
{
    use HasFactory;

    protected $table = "homework_submit";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    static public function getRecord($homework_id)
    {
        $return = self::select('homework_submit.*', 'users.name as first_name', 'users.middle_name as middle_name', 'users.last_name as last_name')
            // ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
            // ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('users', 'users.id', '=', 'homework_submit.student_id')
            ->where('homework_submit.homework_id', '=', $homework_id);

        if (!empty(Request::get('first_name'))) {
            $return = $return->where('users.first_name', 'like', '%' . trim(Request::get('first_name')) . '%');
        }

        if (!empty(Request::get('middle_name'))) {
            $return = $return->where('users.middle_name', 'like', '%' . trim(Request::get('middle_name')) . '%');
        }

        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . trim(Request::get('last_name')) . '%');
        }


        $return = $return->orderBy('homework_submit.created_at', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function gethomeworkReport()
    {
        $return = self::select(
            'homework_submit.*',
            'class.name as class_name',
            'subject.name as subject_name',
            'users.name as first_name',
            'users.middle_name as middle_name',
            'users.last_name as last_name'
        )
            ->join('users', 'users.id', '=', 'homework_submit.student_id')
            ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('class', 'class.id', '=', 'homework.class_id');

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . trim(Request::get('class_name')) . '%');
        }

        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . trim(Request::get('subject_name')) . '%');
        }


        $return = $return->orderBy('homework_submit.created_at', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getRecordStudent($student_id)
    {
        $return = self::select('homework_submit.*', 'class.name as class_name', 'subject.name as subject_name',)
            ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('class', 'class.id', '=', 'homework.class_id')
            ->where('homework_submit.student_id', '=', $student_id);

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . trim(Request::get('class_name')) . '%');
        }

        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . trim(Request::get('subject_name')) . '%');
        }


        $return = $return->orderBy('homework_submit.created_at', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getRecordStudentCount($student_id)
    {
        $return = self::select('homework_submit.id')
            ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('class', 'class.id', '=', 'homework.class_id')
            ->where('homework_submit.student_id', '=', $student_id)
            ->count();

        return $return;
    }


    public function getDocument()
    {
        if (!empty($this->document_file) && file_exists('public/homework/' . $this->document_file)) {
            return url('public/homework/' . $this->document_file);
        } else {
            return "";
        }
    }

    public function getHomework()
    {
        return $this->belongsTo(HomeworkModel::class, 'homework_id');
    }

    public function getStudent()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
