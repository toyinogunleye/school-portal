<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class ParentController extends Controller
{
    public function listParent()
    {
        $data['getRecord'] = User::getParent();
        $data['header_title'] = 'Parent List';
        return view('admin.parent.list', $data);
    }

    public function addParent()
    {

        $data['header_title'] = 'Add new Parent';
        return view('admin.parent.add-parent', $data);
    }

    public function insertParent(Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users',
            'password' => 'min:5',
            'mobile_number' => 'max:15|min:8'

        ]);

        $parent = new User;
        $parent->id = Str::uuid()->toString();
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->religion = trim($request->religion);

        $parent->nationality = trim($request->nationality);
        $parent->state_of_origin = trim($request->state_of_origin);
        $parent->city = trim($request->city);
        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/upload/profile/',  $filename);
            $parent->profile_pic = $filename;
        }

        $parent->status = trim($request->status);
        $parent->email = trim($request->email);

        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;
        $parent->save();

        return redirect('admin/parent/list')->with('success', "Parent successfully created");
    }

    public function editParent($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Parent';
            return view('admin.parent.edit-parent', $data);
        } else {
            return view('404');
        }
    }

    public function updateParent($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            // 'password' => 'min:5',
            'mobile_number' => 'max:15|min:8'

        ]);

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->gender = trim($request->gender);
        $parent->religion = trim($request->religion);
        $parent->address = trim($request->address);
        $parent->occupation = trim($request->occupation);
        $parent->nationality = trim($request->nationality);
        $parent->state_of_origin = trim($request->state_of_origin);
        $parent->city = trim($request->city);

        if (!empty($request->file('profile_pic'))) {

            if (!empty($parent->getProfile())) {
                unlink('public/upload/profile/' . $parent->profile_pic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/upload/profile/',  $filename);
            $parent->profile_pic = $filename;
        }


        $parent->status = trim($request->status);
        $parent->email = trim($request->email);

        if (!empty($request->password)) {
            request()->validate([
                'password' => 'min:5',
            ]);
            $parent->password = Hash::make($request->password);
        }
        $parent->save();
        return redirect('admin/parent/list')->with('success', "Student successfully Updated");
    }

    public function deleteParent($id)
    {
        $getRecord = User::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', "Parent successfully Deleted");
        } else {
            abort(404);
        }
    }

    public function myStudent($id)
    {
        $data['getParent'] = User::getSingle($id);
        $data['parent_id'] = $id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);
        $data['header_title'] = 'Parent Student List';
        return view('admin.parent.my-student', $data);
    }

    public function assignStudentParent($student_id, $parent_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();
        return redirect()->back()->with('success', "Student Successfully Assign");
    }

    public function assignStudentParentDelete($student_id)
    {

        $student = User::getSingle($student_id);
        $student->parent_id = null;
        $student->save();
        return redirect()->back()->with('success', "Student Assign Successfully Deleted");
    }
}
