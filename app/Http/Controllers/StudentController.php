<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function listStudent()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = 'Student List';
        return view('admin.student.list', $data);
    }

    // public function viewStudent($id)
    // {
    //     $data['getRecord'] = User::getSingle($id);
    //     if (!empty($data['getRecord'])) {
    //         $data['getClassList'] = ClassModel::getClassList();
    //         $data['header_title'] = 'Edit Student';
    //         return view('admin.student.view-student', $data);
    //     } else {
    //         return view('404');
    //     }
    // }

    public function addStudent()
    {
        $data['getClassList'] = ClassModel::getClassList();
        $data['header_title'] = 'Add new Student';
        return view('admin.student.add-student', $data);
    }

    public function insertStudent(Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users',
            'password' => 'min:5',
            'mobile_number' => 'max:15|min:8'

        ]);

        $student = new User;
        $student->id = Str::uuid()->toString();
        $student->name = trim($request->name);
        $student->middle_name = trim($request->middle_name);
        $student->last_name = trim($request->last_name);

        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = $request->date_of_birth;
        }

        $student->gender = trim($request->gender);
        $student->mobile_number = trim($request->mobile_number);
        $student->gender = trim($request->gender);
        $student->religion = trim($request->religion);
        $student->genotype = trim($request->genotype);
        $student->blood_group = trim($request->blood_group);
        $student->nationality = trim($request->nationality);
        $student->state_of_origin = trim($request->state_of_origin);
        $student->city = trim($request->city);
        $student->admission_number = trim($request->admission_number);
        $student->admission_date = $request->admission_date;

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/upload/profile/',  $filename);

            $student->profile_pic = $filename;
        }


        $student->class_id = trim($request->class_id);
        $student->caste = trim($request->caste);
        $student->status = trim($request->status);
        $student->email = trim($request->email);

        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        return redirect('admin/student/list')->with('success', "Student successfully created");
    }

    public function editStudent($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['getClassList'] = ClassModel::getClassList();
            $data['header_title'] = 'Edit Student';
            return view('admin.student.edit-student', $data);
        } else {
            return view('404');
        }
    }

    public function updateStudent($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            // 'password' => 'min:5',
            'mobile_number' => 'max:15|min:8'

        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->middle_name = trim($request->middle_name);
        $student->last_name = trim($request->last_name);

        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = $request->date_of_birth;
        }

        $student->gender = trim($request->gender);
        $student->mobile_number = trim($request->mobile_number);
        $student->religion = trim($request->religion);
        $student->genotype = trim($request->genotype);
        $student->blood_group = trim($request->blood_group);
        $student->nationality = trim($request->nationality);
        $student->state_of_origin = trim($request->state_of_origin);
        $student->city = trim($request->city);
        $student->admission_number = trim($request->admission_number);
        $student->admission_date = $request->admission_date;

        if (!empty($request->file('profile_pic'))) {

            if (!empty($student->getProfile())) {
                unlink('public/upload/profile/' . $student->profile_pic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/upload/profile/',  $filename);
            $student->profile_pic = $filename;
        }

        $student->class_id = trim($request->class_id);
        $student->caste = trim($request->caste);
        $student->status = trim($request->status);
        $student->email = trim($request->email);

        if (!empty($request->password)) {
            request()->validate([
                'password' => 'min:5',
            ]);
            $student->password = Hash::make($request->password);
        }
        $student->save();
        return redirect('admin/student/list')->with('success', "Student successfully Updated");
    }

    public function deleteStudent($id)
    {
        $getRecord = User::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', "Student successfully Deleted");
        } else {
            abort(404);
        }
    }
}
