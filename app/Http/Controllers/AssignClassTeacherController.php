<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function assignClassTeacherList()
    {
        $data['getRecord'] = AssignClassTeacherModel::getRecord();
        $data['header_title'] = 'Assign Class Teacher';
        return view('admin.assign-class-teacher.list', $data);
    }

    public function assignClassTeacher(Request $request)
    {
        $data['getClassList'] = ClassModel::getClassList();
        $data['getTeacher'] = User::getTeacherClass();
        $data['header_title'] = 'Assign New Class Teacher';
        return view('admin.assign-class-teacher.add', $data);
    }


    public function insertAssignClassTeacher(Request $request)
    {
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {

                $gettAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);

                if (!empty($gettAlreadyFirst)) {
                    $gettAlreadyFirst->status = $request->status;
                    $gettAlreadyFirst->save();
                } else {
                    $save = new  AssignClassTeacherModel;
                    $save->id = Str::uuid()->toString();
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign-class-teacher/list')->with('success', "Class Teacher  Successfully Assign");
        } else {
            return redirect()->back()->with('error', 'Please Select Teacher');
        }
    }
}
