<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function listTeacher()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('admin.teacher.list', $data);
    }

    public function addTeacher()
    {

        $data['header_title'] = 'Add New Teacher';
        return view('admin.teacher.add-teacher', $data);
    }

    public function insertTeacher(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'password' => 'min:5',
            'mobile_number' => 'max:15|min:8'

        ]);

        $teacher = new User;
        $teacher->id = Str::uuid()->toString();
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->middle_name = trim($request->middle_name);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->guarantor_name = trim($request->guarantor_name);
        $teacher->guarantor_number = trim($request->guarantor_number);

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = $request->date_of_birth;
        }

        $teacher->gender = trim($request->gender);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->religion = trim($request->religion);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->nationality = trim($request->nationality);
        $teacher->state_of_origin = trim($request->state_of_origin);
        $teacher->city = trim($request->city);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);

        if (!empty($request->employment_date)) {
            $teacher->employment_date = $request->employment_date;
        }
        $teacher->note = trim($request->note);


        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/upload/profile/',  $filename);
            $teacher->profile_pic = $filename;
        }

        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);

        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher successfully created");
    }

    public function editTeacher($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Teacher';
            return view('admin.teacher.edit-teacher', $data);
        } else {
            return view('404');
        }
    }
}
