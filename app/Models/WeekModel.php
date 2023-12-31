<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignClassTeacherModel;

class WeekModel extends Model
{
    use HasFactory;

    protected $table = "week";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    static public function getRecord()
    {
        return self::get();
    }

    static public function getWeekUsingName($weekname)
    {
        return WeekModel::where('name', '=', $weekname)->first();
    }
}
