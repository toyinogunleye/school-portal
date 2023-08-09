<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTimetableModel;
use App\Models\SubjectModel;
use App\Models\User;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClassTimetableController extends Controller
{
    public function classTimetableList(Request $request)
    {
        $data['getClass'] = ClassModel::getClassList();
        if (!empty($request->class_id)) {
            $data['getSubject'] =  ClassSubjectModel::mySubject($request->class_id);
        }

        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $value) {
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;

            if (!empty($request->class_id) && !empty($request->subject_id)) {
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($request->class_id, $request->subject_id, $value->id);

                if (!empty($classSubject)) {

                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['venue'] = $classSubject->venue;
                } else {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['venue'] = '';
                }
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['venue'] = '';
            }

            $week[] = $dataW;
        }

        $data['week'] = $week;
        $data['header_title'] = 'Class Timetable';
        return view('admin.class_timetable.list', $data);
    }





    public function getSubject(Request $request)
    {
        // $data['getRecord'] =
        $getSubject =  ClassSubjectModel::mySubject($request->class_id);
        $html = "<option value=''>Select</option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>" . $value->subject_name . "</option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    public function insert_update(Request $request)
    {
        ClassSubjectTimetableModel::where('class_id', '=', $request->class_id)->where('subject_id', '=', $request->subject_id)->delete();

        foreach ($request->timetable as $timetable) {
            if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['venue'])) {

                $save = new ClassSubjectTimetableModel;
                $save->id = Str::uuid()->toString();
                $save->class_id = $request->class_id;
                $save->subject_id = $request->subject_id;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->venue = $timetable['venue'];
                $save->save();
            }
        }
        return redirect()->back()->with('success', 'Class Timetable Successsfully Save');
    }

    // student
    public function timetableStudent()
    {
        $result = array();
        $getRecord = ClassSubjectModel::mySubject(Auth::user()->class_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->subject_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;

                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($value->class_id, $value->subject_id, $valueW->id);

                if (!empty($classSubject)) {

                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['venue'] = $classSubject->venue;
                } else {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['venue'] = '';
                }
                $week[] = $dataW;
            }

            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        // dd($result);

        $data['getRecord'] = $result;

        $data['header_title'] = 'My Timetable';
        return view('student.classtimetable', $data);
    }

    public function timetableTeacher($class_id, $subject_id)
    {

        $data['getClass'] =  ClassModel::getSingle($class_id);
        $data['getSubject'] = SubjectModel::getSingle($subject_id);

        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($class_id, $subject_id, $valueW->id);

            if (!empty($classSubject)) {

                $dataW['start_time'] = $classSubject->start_time;
                $dataW['end_time'] = $classSubject->end_time;
                $dataW['venue'] = $classSubject->venue;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['venue'] = '';
            }
            $result[] = $dataW;
        }
        // dd($result);

        $data['getRecord'] = $result;

        $data['header_title'] = 'Class Timetable';
        return view('teacher.classtimetable', $data);
    }

    //Parent

    public function timetableParent($class_id, $subject_id, $student_id)
    {
        $data['getStudent'] =  User::getSingle($student_id);
        $data['getClass'] =  ClassModel::getSingle($class_id);
        $data['getSubject'] = SubjectModel::getSingle($subject_id);

        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($class_id, $subject_id, $valueW->id);

            if (!empty($classSubject)) {

                $dataW['start_time'] = $classSubject->start_time;
                $dataW['end_time'] = $classSubject->end_time;
                $dataW['venue'] = $classSubject->venue;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['venue'] = '';
            }
            $result[] = $dataW;
        }
        // dd($result);

        $data['getRecord'] = $result;

        $data['header_title'] = 'Class Timetable';
        return view('parent.classtimetable', $data);
    }
}
