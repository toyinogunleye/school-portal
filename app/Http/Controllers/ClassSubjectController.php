<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function classSubjectList()
    {
        $data['getRecord'] = ClassSubjectModel::getRecord();

        $data['header_title'] = 'Class Subject List';
        return view('admin.class-subject.list', $data);
    }

    public function addClassSubject(Request $request)
    {
        $data['getSubjectList'] = SubjectModel::getSubjectList();
        $data['getClassList'] = ClassModel::getClassList();

        $data['header_title'] = 'Add Subject to Class';
        return view('admin.class-subject.add', $data);
    }

    public function insertClassSubject(Request $request)
    {
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {

                $gettAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);

                if (!empty($gettAlreadyFirst)) {
                    $gettAlreadyFirst->status = $request->status;
                    $gettAlreadyFirst->save();
                } else {
                    $save = new ClassSubjectModel;
                    $save->id = Str::uuid()->toString();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/class-subject/list')->with('success', "Subject Successfully Assign to Class");
        } else {
            return redirect()->back()->with('error', 'Please Select Subject');
        }
    }

    public function editClassSubject($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);
        if (!empty($getRecord)) {

            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] = ClassSubjectModel::getAssignSubjectID($getRecord->class_id);

            $data['getSubjectList'] = SubjectModel::getSubjectList();
            $data['getClassList'] = ClassModel::getClassList();
            $data['header_title'] = 'Edit Subject to Class';
            return view('admin.class-subject.edit', $data);
        } else {
            return view('404');
        }
    }

    public function updateClassSubject(Request $request)
    {
        ClassSubjectModel::deleteSubject($request->class_id);

        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {

                $gettAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);

                if (!empty($gettAlreadyFirst)) {
                    $gettAlreadyFirst->status = $request->status;
                    $gettAlreadyFirst->save();
                } else {
                    $save = new ClassSubjectModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
        }
        return redirect('admin/class-subject/list')->with('success', "Subject Successfully Updated");
    }

    public function deleteClassSubject($id)
    {
        $save = ClassSubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect()->back()->with('success', "Record Successfully Deleted");
    }

    public function editSingleClassSubject($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);
        if (!empty($getRecord)) {

            $data['getRecord'] = $getRecord;
            $data['getSubjectList'] = SubjectModel::getSubjectList();
            $data['getClassList'] = ClassModel::getClassList();
            $data['header_title'] = 'Edit Subject to Class';
            return view('admin.class-subject.edit-single', $data);
        } else {
            return view('404');
        }
    }

    public function updateSingleClassSubject($id, Request $request)
    {


        $gettAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);

        if (!empty($gettAlreadyFirst)) {
            $gettAlreadyFirst->status = $request->status;
            $gettAlreadyFirst->save();


            return redirect('admin/class-subject/list')->with('success', "Subject Successfully Updated");
        } else {
            $save = ClassSubjectModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->status = $request->status;
            $save->save();

            return redirect('admin/class-subject/list')->with('success', "Subject Successfully Updated");
        }
    }
}
