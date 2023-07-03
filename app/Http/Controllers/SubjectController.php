<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function subjectList()
    {
        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] = 'Subject List';
        return view('admin.subject.subject-list', $data);
    }

    public function addSubject()
    {
        $data['header_title'] = 'Add New Suject';
        return view('admin.subject.add-subject', $data);
    }

    public function insertSubject(Request $request)
    {
        // $data['header_title'] = 'Add New Class';
        $save = new SubjectModel;
        $save->id = Str::uuid()->toString();
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/subject/list')->with('success', "Subject Successfully Created");
    }

    public function editSubject($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Subject';
            return view('admin.subject.edit-subject', $data);
        } else {
            abort(404);
        }
    }

    public function updateSubject($id, Request $request)
    {
        $save = SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->save();
        return redirect('admin/subject/list')->with('success', "Subject Successfully Updated");
    }

    public function deleteSubject($id)
    {
        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect()->back()->with('success', "Subject Successfully Deleted");
    }
}
