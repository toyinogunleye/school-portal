<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ExamModel extends Model
{
    use HasFactory;

    protected $table = "exam";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    static function getRecord()
    {
        $return = self::select('exam.*', 'users.name as user_fname', 'users.last_name as user_lname', 'users.middle_name as user_mname')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0);

        if (!empty(Request::get('name'))) {
            $return = $return->where('exam.name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('exam.created_at', '=', Request::get('date'));
        }

        $return = $return->paginate(50);
        return $return;
    }

    static function getExam()
    {
        $return = self::select('exam.*')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0)
            ->orderBy('exam.name', 'desc')
            ->get();
        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static function getTotalExam()
    {
        $return = self::select('exam.id*')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0)
            ->count();
        return $return;
    }
}
