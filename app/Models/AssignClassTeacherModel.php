<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignClassTeacherModel extends Model
{
    use HasFactory;

    protected $table = "assign_class_teacher";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';



    static function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return = self::select('assign_class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'assign_class_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
            ->join('users', 'users.id', '=', 'assign_class_teacher.created_by')
            ->where('assign_class_teacher.is_delete', '=', 0);

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }

        if (!empty(Request::get('name'))) {
            $return = $return->where('teacher.name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('last_name'))) {
            $return = $return->where('teacher.last_name', 'like', '%' . Request::get('last_name') . '%');
        }


        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class_subject.created_at', '=', Request::get('date'));
        }

        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }

        $return = $return->orderBy('assign_class_teacher.created_at', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getAlreadyFirst($class_id, $teacher_id)
    {
        return self::where('class_id', '=', $class_id)
            ->where('teacher_id', '=', $teacher_id)
            ->first();
    }

    static public function getAssignTeacherID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    static public function deleteTeacher($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }
}
