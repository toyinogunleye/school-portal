<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\ExamModel;
use App\Models\NoticeBoardModel;
use App\Models\StudentAddFeesModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if (Auth::user()->user_type == 1) {

            $data['getTotalTodayFees'] = StudentAddFeesModel::getTotalTodayFees();
            $data['getTotalFees'] = StudentAddFeesModel::getTotalFees();
            $data['totalClass'] = ClassModel::getTotalClass();
            $data['totalSubject'] = SubjectModel::getTotalSubject();
            $data['totalExam'] = ExamModel::getTotalExam();
            $data['totalAdmin'] = User::getTotalUser(1);
            $data['totalTeacher'] = User::getTotalUser(2);
            $data['totalStudent'] = User::getTotalUser(3);
            $data['totalParent'] = User::getTotalUser(4);
            return view('admin/dashboard', $data);
        } else if (Auth::user()->user_type == 2) {

            $data['totalStudent'] = User::getTeacherStudentCount(Auth::user()->id);
            $data['totalClass'] = AssignClassTeacherModel::getMyClassSubjectGroupCount(Auth::user()->id);
            $data['totalSubject'] = AssignClassTeacherModel::getMyClassSubjectCount(Auth::user()->id);
            $data['totalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->user_type);



            $data['totalExam'] = ExamModel::getTotalExam();

            return view('teacher/dashboard', $data);
        } else if (Auth::user()->user_type == 3) {
            return view('student/dashboard', $data);
        } else if (Auth::user()->user_type == 4) {
            return view('parent/dashboard', $data);
        }
    }
}
