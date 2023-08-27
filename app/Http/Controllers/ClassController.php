<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClassController extends Controller
{
    public function classList()
    {
        $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] = 'Class List';
        return view('admin.class.class-list', $data);
    }

    public function addClass()
    {
        $data['header_title'] = 'Add New Class';
        return view('admin.class.add-class', $data);
    }

    public function insertClass(Request $request)
    {
        // $data['header_title'] = 'Add New Class';
        $save = new ClassModel;
        $save->id = Str::uuid()->toString();
        $save->name = trim($request->name);
        $save->amount = trim($request->amount);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class Successfully Created");
    }

    public function editClass($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Class';
            return view('admin.class.edit-class', $data);
        } else {
            abort(404);
        }
    }

    public function updateClass($id, Request $request)
    {
        $save = ClassModel::getSingle($id);
        $save->name = $request->name;
        $save->amount = trim($request->amount);
        $save->status = $request->status;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class Successfully Updated");
    }

    public function deleteClass($id)
    {
        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect()->back()->with('success', "Class Successfully Deleted");
    }
}
