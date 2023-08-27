<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class StudentAttendanceModel extends Model
{
    use HasFactory;

    protected $table = "student_attendance";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';



    static public function CheckAlreadyAttendance($student_id, $class_id, $attendance_date)
    {
        return self::where('student_id', '=', $student_id)
            ->where('class_id', '=', $class_id)
            ->where('attendance_date', '=', $attendance_date)
            ->first();
    }

    static public function getRecord()
    {
        $return = self::select(
            'student_attendance.*',
            'class.name as class_name',
            'student.name as student_name',
            'student.middle_name as student_mname',
            'student.last_name as student_lname',
            'createdby.name as created_name',
            'createdby.middle_name as created_mname',
            'createdby.last_name as created_lname',
        )
            ->join('class', 'class.id', 'student_attendance.class_id')
            ->join('users as student', 'student.id', 'student_attendance.student_id')
            ->join('users as createdby', 'createdby.id', 'student_attendance.created_by');

        if (!empty(Request::get('class_id'))) {
            $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));
        }

        if (!empty(Request::get('attendance_date'))) {
            $return = $return->whereDate('student_attendance.attendance_date', '=', Request::get('attendance_date'));
        }

        if (!empty(Request::get('start_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '>=', Request::get('end_attendance_date'));
        }

        if (!empty(Request::get('end_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '<=', Request::get('end_attendance_date'));
        }

        if (!empty(Request::get('attendance_type'))) {
            $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
        }

        if (!empty(Request::get('student_name'))) {
            $return = $return->where('student.name', 'like', '%' . Request::get('student_name') . '%');
        }

        if (!empty(Request::get('student_lname'))) {
            $return = $return->where('student.last_name', 'like', '%' . Request::get('student_lname') . '%');
        }


        $return = $return->orderBy('student_attendance.created_at', 'desc')
            ->paginate(25);
        return $return;
    }

    static public function getRecordTeacher($class_id)
    {
        if (!empty($class_id)) {

            $return = self::select(
                'student_attendance.*',
                'class.name as class_name',
                'student.name as student_name',
                'student.middle_name as student_mname',
                'student.last_name as student_lname',
                'createdby.name as created_name',
                'createdby.middle_name as created_mname',
                'createdby.last_name as created_lname',
            )
                ->join('class', 'class.id', 'student_attendance.class_id')
                ->join('users as student', 'student.id', 'student_attendance.student_id')
                ->join('users as createdby', 'createdby.id', 'student_attendance.created_by')
                ->whereIn('student_attendance.class_id', $class_id);

            if (!empty(Request::get('class_id'))) {
                $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));
            }

            if (!empty(Request::get('attendance_date'))) {
                $return = $return->whereDate('student_attendance.attendance_date', '=', Request::get('attendance_date'));
            }

            if (!empty(Request::get('start_attendance_date'))) {
                $return = $return->where('student_attendance.attendance_date', '>=', Request::get('end_attendance_date'));
            }

            if (!empty(Request::get('end_attendance_date'))) {
                $return = $return->where('student_attendance.attendance_date', '<=', Request::get('end_attendance_date'));
            }

            if (!empty(Request::get('attendance_type'))) {
                $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
            }

            if (!empty(Request::get('student_name'))) {
                $return = $return->where('student.name', 'like', '%' . Request::get('student_name') . '%');
            }

            if (!empty(Request::get('student_lname'))) {
                $return = $return->where('student.last_name', 'like', '%' . Request::get('student_lname') . '%');
            }

            $return = $return->orderBy('student_attendance.created_at', 'desc')
                ->paginate(25);
            return $return;
        } else {
            return "";
        }
    }

    static public function getRecordStudent($student_id)
    {
        $return = self::select('student_attendance.*', 'class.name as class_name')
            ->join('class', 'class.id', 'student_attendance.class_id')
            ->where('student_attendance.student_id', '=', $student_id);

        if (!empty(Request::get('class_id'))) {
            $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));
        }

        if (!empty(Request::get('attendance_date'))) {
            $return = $return->whereDate('student_attendance.attendance_date', '=', Request::get('attendance_date'));
        }

        if (!empty(Request::get('start_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '>=', Request::get('end_attendance_date'));
        }

        if (!empty(Request::get('end_attendance_date'))) {
            $return = $return->where('student_attendance.attendance_date', '<=', Request::get('end_attendance_date'));
        }

        if (!empty(Request::get('attendance_type'))) {
            $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
        }


        $return = $return->orderBy('student_attendance.created_at', 'desc')
            ->paginate(25);
        return $return;
    }

    static public function getClassStudent($student_id)
    {
        return  self::select('student_attendance.*', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->where('student_attendance.student_id', '=', $student_id)
            ->groupBy('student_attendance.class_id')
            ->get();
    }
}
