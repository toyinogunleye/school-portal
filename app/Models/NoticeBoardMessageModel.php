<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoardMessageModel extends Model
{
    use HasFactory;

    protected $table = "notice_board_message";

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    static function deleteRecord($id)
    {
        NoticeBoardMessageModel::where('notice_board_id', '=', $id)->delete();
    }
}
