<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = "class";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    static public function getRecord()
    {
        $return = Self::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by');

        if (!empty(Request::get('name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class.created_at', '=', Request::get('date'));
        }

        $return = $return->where('class.is_delete', '=', 0)
            ->orderBy('class.created_at', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getClassList()
    {
        $return = Self::select('class.*')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();

        return $return;
    }

    static public function getTotalClass()
    {
        $return = Self::select('class.id*')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->count();

        return $return;
    }
}




// CREATE TABLE users (
//   id CHAR(36) NOT NULL DEFAULT (UUID()),
//   name VARCHAR(255),
//   email VARCHAR(255),
//   password VARCHAR(255),
//   PRIMARY KEY (id)
// );
