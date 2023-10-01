<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class HomeworkModel extends Model
{
    use HasFactory;
    protected $table = "homework";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    static public function getRecord()
    {
        $return = self::select('homework.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('class', 'class.id', '=', 'homework.class_id')
            ->join('users', 'users.id', '=', 'homework.created_by')
            ->where('homework.is_delete', '=', 0);

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . trim(Request::get('class_name')) . '%');
        }
        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . trim(Request::get('subject_name')) . '%');
        }
        if (!empty(Request::get('created_by'))) {
            $return = $return->where('users.name', 'like', '%' . trim(Request::get('created_by')) . '%');
        }

        if (!empty(Request::get('homework_date_from'))) {
            $return = $return->where('homework_date', '>=', Request::get('homework_date_from'));
        }

        if (!empty(Request::get('homework_date_to'))) {
            $return = $return->where('homework_date', '<=', Request::get('homework_date_to'));
        }

        if (!empty(Request::get('submission_date_from'))) {
            $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
        }

        if (!empty(Request::get('submission_date_to'))) {
            $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
        }

        $return = $return->orderBy('homework.created_at', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getRecordTeacher($class_ids)
    {
        $return = self::select('homework.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('class', 'class.id', '=', 'homework.class_id')
            ->join('users', 'users.id', '=', 'homework.created_by')
            ->whereIn('homework.class_id', $class_ids)
            ->where('homework.is_delete', '=', 0);

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . trim(Request::get('class_name')) . '%');
        }
        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . trim(Request::get('subject_name')) . '%');
        }

        if (!empty(Request::get('homework_date_from'))) {
            $return = $return->where('homework_date', '>=', Request::get('homework_date_from'));
        }

        if (!empty(Request::get('homework_date_to'))) {
            $return = $return->where('homework_date', '<=', Request::get('homework_date_to'));
        }

        if (!empty(Request::get('submission_date_from'))) {
            $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
        }

        if (!empty(Request::get('submission_date_to'))) {
            $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
        }

        $return = $return->orderBy('homework.created_at', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getRecordStudent($class_id, $student_id)
    {
        $return = self::select('homework.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('class', 'class.id', '=', 'homework.class_id')
            ->join('users', 'users.id', '=', 'homework.created_by')
            ->where('homework.class_id', '=', $class_id)
            ->where('homework.is_delete', '=', 0)
            ->whereNotIn('homework.id', function ($query) use ($student_id) {
                $query->select('homework_submit.homework_id')
                    ->from('homework_submit')
                    ->where('homework_submit.student_id', '=', $student_id);
            });


        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . trim(Request::get('subject_name')) . '%');
        }

        if (!empty(Request::get('homework_date_from'))) {
            $return = $return->where('homework_date', '>=', Request::get('homework_date_from'));
        }

        if (!empty(Request::get('homework_date_to'))) {
            $return = $return->where('homework_date', '<=', Request::get('homework_date_to'));
        }

        if (!empty(Request::get('submission_date_from'))) {
            $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
        }

        if (!empty(Request::get('submission_date_to'))) {
            $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
        }

        $return = $return->orderBy('homework.created_at', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getRecordStudentCount($class_id, $student_id)
    {
        $return = self::select('homework.id')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->join('class', 'class.id', '=', 'homework.class_id')
            ->join('users', 'users.id', '=', 'homework.created_by')
            ->where('homework.class_id', '=', $class_id)
            ->where('homework.is_delete', '=', 0)
            ->whereNotIn('homework.id', function ($query) use ($student_id) {
                $query->select('homework_submit.homework_id')
                    ->from('homework_submit')
                    ->where('homework_submit.student_id', '=', $student_id);
            });

        $return = $return->count();
        return $return;
    }



    static public function getSingle($id)
    {
        return self::find($id);
    }





    public function getDocument()
    {
        if (!empty($this->document_file) && file_exists('public/homework/' . $this->document_file)) {
            return url('public/homework/' . $this->document_file);
        } else {
            return "";
        }
    }
}
