<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\StudentAttendanceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function attendanceStudent(Request $request)
    {
        if (!empty($request->class_id) && !empty($request->attendance_date)) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }

        $data['getClass'] = ClassModel::getClassList();

        // $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] = 'Student Attendance';
        return view('admin.attendance.student', $data);
    }

    public function attendanceStudentSubmit(Request $request)
    {
        $check_attendance = StudentAttendanceModel::CheckAlreadyAttendance(
            $request->student_id,
            $request->class_id,
            $request->attendance_date
        );

        if (!empty($check_attendance)) {
            $attendance = $check_attendance;
        } else {
            $attendance = new StudentAttendanceModel;
            $attendance->id = Str::uuid()->toString();
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }
        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        $json['message'] = "Attendance Successfully Saved";
        echo json_encode($json);
    }

    public function attendanceReport()
    {
        $data['getClass'] = ClassModel::getClassList();
        $data['getRecord'] = StudentAttendanceModel::getRecord();


        $data['header_title'] = 'Attendance Report';
        return view('admin.attendance.report', $data);
    }

    // Teacher side attendance

    public function attendanceStudentTeacher(Request $request)
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

        if (!empty($request->class_id) && !empty($request->attendance_date)) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }


        $data['header_title'] = 'Student Attendance';
        return view('teacher.attendance.student', $data);
    }

    public function attendanceReportTeacher()
    {
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $classarray = array();

        foreach ($getClass as $value) {
            $classarray[] = $value->class_id;
        }

        $data['getClass'] = $getClass;
        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classarray);
        $data['header_title'] = 'Attendance Report';
        return view('teacher.attendance.report', $data);
    }

    //Student attendance
    public function myAttendanceStudent()
    {
        $data['getClass'] = StudentAttendanceModel::getClassStudent(Auth::user()->id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent(Auth::user()->id);

        $data['header_title'] = 'My Attendance';
        return view('student.my_attendance', $data);
    }

    // Parent Attendance
    public function myAttendanceParent($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);
        $data['getClass'] = StudentAttendanceModel::getClassStudent($student_id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent($student_id);

        $data['header_title'] = 'Student Attendance';
        return view('parent.student-attendance', $data);
    }
}
