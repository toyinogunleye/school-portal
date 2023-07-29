<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\SubmitHomeworkModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeworkController extends Controller
{
    public function homework()
    {
        $data['getRecord'] = HomeworkModel::getRecord();
        $data['header_title'] = 'Homework';
        return view('admin.homework.list', $data);
    }

    // public function viewHomework($id)
    // {


    //     $getRecord = HomeworkModel::getSingle($id);
    //     $data['getClass'] = ClassModel::getClassList($getRecord->id);
    //     $data['getSubject'] = ClassSubjectModel::mySubject($getRecord->class_id);
    //     $data['getRecord'] = $getRecord;
    //     $data['header_title'] = 'View Homework';
    //     return view('admin.homework.view', $data);
    // }

    public function createHomework()
    {
        // $data['getRecord'] = NoticeBoardModel::getRecord();
        $data['getClass'] = ClassModel::getClassList();
        $data['header_title'] = 'Add New Homework';
        return view('admin.homework.add-homework', $data);
    }

    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubject = ClassSubjectModel::mySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        foreach ($getSubject as $value) {
            $html .= '<option value="' . $value->subject_id . '">' . $value->subject_name . '</option>';
        }
        $json['success'] = $html;
        echo json_encode($json);
    }

    public function insertHomework(Request $request)
    {

        $homework = new HomeworkModel;
        $homework->id = Str::uuid()->toString();
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;


        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/homework/',  $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('admin/homework/homework')->with('success', "Homework successfully created");
    }

    public function editHomework($id)
    {

        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getClass'] = ClassModel::getClassList();
        $data['getSubject'] = ClassSubjectModel::mySubject($getRecord->class_id);
        $data['header_title'] = 'Edit Homework';
        return view('admin.homework.edit-homework', $data);
    }

    public function updateHomework(Request $request, $id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);



        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/homework/',  $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('admin/homework/homework')->with('success', "Homework successfully Updated");
    }

    public function deleteHomework($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();

        return redirect()->back()->with('success', "Homework Successfully Deleted");
    }

    public function  adminSubmittedHomework($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if (!empty($homework)) {

            $data['homework_id'] = $homework_id;
            $data['getRecord'] = SubmitHomeworkModel::getRecord($homework_id);
            $data['header_title'] = 'Submitted Homework';
            return view('admin.homework.submitted', $data);
        } else {
            abort(404);
        }
    }

    //Teacher Side
    public function homeworkTeacher()
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach ($getClass as $class) {
            $class_ids[] = $class->class_id;
        }
        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title'] = 'Homework';
        return view('teacher.homework.list', $data);
    }

    public function createHomeworkTeacher()
    {
        // $data['getRecord'] = NoticeBoardModel::getRecord();
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = 'Add New Homework';
        return view('teacher.homework.add-homework', $data);
    }

    public function insertHomeworkTeacher(Request $request)
    {

        $homework = new HomeworkModel;
        $homework->id = Str::uuid()->toString();
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;


        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/homework/',  $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('teacher/homework')->with('success', "Homework successfully created");
    }

    public function editHomeworkTeacher($id)
    {

        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getSubject'] = ClassSubjectModel::mySubject($getRecord->class_id);
        $data['header_title'] = 'Edit Homework';
        return view('teacher.homework.edit-homework', $data);
    }

    public function updateHomeworkTeacher(Request $request, $id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);



        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/homework/',  $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('teacher/homework')->with('success', "Homework successfully Updated");
    }


    public function deleteHomeworkTeacher($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();

        return redirect()->back()->with('success', "Homework Successfully Deleted");
    }

    public function teacherSubmittedHomework($homework_id)
    {

        $homework = HomeworkModel::getSingle($homework_id);
        if (!empty($homework)) {

            $data['homework_id'] = $homework_id;
            $data['getRecord'] = SubmitHomeworkModel::getRecord($homework_id);
            $data['header_title'] = 'Submitted Homework';
            return view('teacher.homework.submittedlist', $data);
        } else {
            abort(404);
        }
    }

    //Student Homework
    public function homeworkStudent()
    {
        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = 'My Homework';
        return view('student.homework.list', $data);
    }

    public function submitHomework($homework_id)
    {
        $data['getRecord'] = HomeworkModel::getSingle($homework_id);
        $data['header_title'] = 'Submit My Homework';
        return view('student.homework.submit', $data);
    }

    public function submitHomeworkInsert($homework_id, Request $request)
    {

        $homework = new SubmitHomeworkModel;
        $homework->id = Str::uuid()->toString();
        $homework->homework_id = $homework_id;
        $homework->student_id = Auth::user()->id;
        $homework->description = trim($request->description);


        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/homework/',  $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('student/my-homework')->with('success', "Homework Submitted Successfully");
    }

    public function studentSubmittedHomework(Request $request)
    {
        $data['getRecord'] = SubmitHomeworkModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = 'My Submitted Homework';
        return view('student.homework.submittedlist', $data);
    }


    //Parent Side
    public function homeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkModel::getRecordStudent($getStudent->class_id, $getStudent->id);
        $data['header_title'] = 'Student Homework';
        $data['getStudent'] = $getStudent;
        return view('parent.homework.list', $data);
    }


    public function submittedHomeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = SubmitHomeworkModel::getRecordStudent($getStudent->id);
        $data['header_title'] = 'Submitted Homework';
        $data['getStudent'] = $getStudent;
        return view('parent.homework.submittedlist', $data);
    }

    public function homeworkReport()
    {
        $data['getRecord'] = SubmitHomeworkModel::getHomeworkReport();
        $data['header_title'] = 'Homework Report';
        return view('admin.homework.report', $data);
    }
}
