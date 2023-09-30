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

                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);

                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
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

    public function editAssignClassTeacher($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) {

            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherID'] = AssignClassTeacherModel::getAssignTeacherID($getRecord->class_id);
            $data['getClassList'] = ClassModel::getClassList();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = 'Edit Assign Class Teacher';
            return view('admin.assign-class-teacher.edit', $data);
        } else {
            return view('404');
        }
    }


    public function updateAssignClassTeacher($id, Request $request)
    {
        AssignClassTeacherModel::deleteTeacher($request->class_id);

        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {

                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);

                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $save = new  AssignClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign-class-teacher/list')->with('success', "Class Teacher Successfully Updated");
        } else {
            return redirect()->back()->with('error', 'Please Select Teacher');
        }
    }

    public function editSingleAssignClassTeacher($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) {

            $data['getRecord'] = $getRecord;
            $data['getClassList'] = ClassModel::getClassList();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = 'Edit Assign Class Teacher';
            return view('admin.assign-class-teacher.edit-single', $data);
        } else {
            return view('404');
        }
    }


    public function updateSingleAssignClassTeacher($id, Request $request)
    {

        $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $request->teacher_id);

        if (!empty($getAlreadyFirst)) {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();


            return redirect('admin/assign-class-teacher/list')->with('success', "Assign Class Teacher Successfully Updated");
        } else {
            $save = AssignClassTeacherModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->teacher_id = $request->teacher_id;
            $save->status = $request->status;
            $save->save();

            return redirect('admin/assign-class-teacher/list')->with('success', "Assign Class TeacherSuccessfully Updated");
        }
    }

    public function deleteAssignClassTeacher($id)
    {
        $save = AssignClassTeacherModel::getSingle($id);
        $save->delete();

        return redirect()->back()->with('success', "Assign Class Teacher Successfully Deleted");
    }

    //teacher side work

    public function myClassSubject()
    {
        $data['getRecord'] = AssignClassTeacherModel::getClassSubject(Auth::user()->id);
        // dd($data['getRecord']);
        $data['header_title'] = "My Class & Subject";
        return view('teacher.my-class-subject', $data);
    }
}
