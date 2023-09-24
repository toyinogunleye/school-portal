<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class StudentAddFeesModel extends Model
{
    use HasFactory;

    protected $table = "student_add_fees";

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return =  self::select(
            'student_add_fees.*',
            'class.name as class_name',
            'student.admission_number as admission_number',
            'users.name as created_fname',
            'users.middle_name as created_mname',
            'users.last_name as created_lname',
            'student.name as student_fname',
            'student.middle_name as student_mname',
            'student.last_name as student_lname'
        )
            ->join('class', 'class.id', '=', 'student_add_fees.class_id')
            ->join('users as student', 'student.id', '=', 'student_add_fees.student_id')
            ->join('users', 'users.id', '=', 'student_add_fees.created_by')
            ->where('student_add_fees.is_payment', '=', 1);


        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('student.admission_number', '=', Request::get('admission_number'));
        }
        if (!empty(Request::get('class_id'))) {
            $return = $return->where('student_add_fees.class_id', '=', Request::get('class_id'));
        }

        if (!empty(Request::get('student_fname'))) {
            $return = $return->where('student.name', 'like', '%' . Request::get('student_fname') . '%');
        }

        if (!empty(Request::get('student_mname'))) {
            $return = $return->where('student.middle_name', 'like', '%' . Request::get('student_mname') . '%');
        }

        if (!empty(Request::get('student_lname'))) {
            $return = $return->where('student.last_name', 'like', '%' . Request::get('student_lname') . '%');
        }

        if (!empty(Request::get('payment_type'))) {
            $return = $return->where('student_add_fees.payment_type', 'like', '%' . Request::get('payment_type') . '%');
        }


        if (!empty(Request::get('payment_date'))) {
            $return = $return->whereDate('student_add_fees.created_at', '=', Request::get('payment_date'));
        }

        if (!empty(Request::get('date_from'))) {
            $return = $return->where('student_add_fees.created_at', '>=', Request::get('date_from'));
        }

        if (!empty(Request::get('date_to'))) {
            $return = $return->where('student_add_fees.created_at', '<=', Request::get('date_to'));
        }


        $return = $return->orderBy('student_add_fees.created_at', 'desc')
            ->paginate(50);

        return $return;
    }

    static public function getFees($student_id)
    {
        return self::select('student_add_fees.*', 'class.name as class_name', 'users.name as created_fname', 'users.middle_name as created_mname', 'users.last_name as created_lname')
            ->join('class', 'class.id', '=', 'student_add_fees.class_id')
            ->join('users', 'users.id', '=', 'student_add_fees.created_by')
            ->where('student_add_fees.student_id', '=', $student_id)
            ->where('student_add_fees.is_payment', '=', 1)
            ->orderBy('student_add_fees.created_at', 'desc')
            ->get();
    }

    static public function getPaidAmount($student_id, $class_id)
    {
        return self::where('student_add_fees.student_id', '=', $student_id)
            ->where('student_add_fees.class_id', '=', $class_id)
            ->where('student_add_fees.is_payment', '=', 1)
            ->sum('student_add_fees.paid_amount');
    }

    static public function getTotalTodayFees()
    {
        return self::where('student_add_fees.is_payment', '=', 1)
            ->whereDate('student_add_fees.created_at', '=', date('Y-m-d'))
            ->sum('student_add_fees.paid_amount');
    }

    static public function getTotalFees()
    {
        return self::where('student_add_fees.is_payment', '=', 1)
            ->sum('student_add_fees.paid_amount');
    }
}
