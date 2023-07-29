<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamModel;
use App\Models\ExamScheduleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExaminationController extends Controller
{
    public function examList()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = 'Exam List';
        return view('admin.exam.exam-list', $data);
    }

    public function addExam()
    {
        $data['header_title'] = 'Add Exam';
        return view('admin.exam.add-exam', $data);
    }

    public function insertExam(Request $request)
    {
        $exam = new ExamModel;
        $exam->id = Str::uuid()->toString();
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;

        $exam->save();

        return redirect('admin/examination/exam-list')->with('success', 'Exam Successfully Created');
    }

    public function editExam($id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Exam';
            return view('admin.exam.edit-exam', $data);
        } else {
            abort(404);
        }
    }

    public function updateExam($id, Request $request)
    {
        $exam = ExamModel::getSingle($id);
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);

        $exam->save();

        return redirect('admin/examination/exam-list')->with('success', 'Exam Successfully Updated ');
    }

    public function deleteExam($id)
    {
        $getRecord = ExamModel::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', 'Exam Successfully Deleted');
        } else {
            abort(404);
        }
    }

    public function examSchedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClassList();
        $data['getExam'] = ExamModel::getExam();

        $result = array();

        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $getSubject = ClassSubjectModel::mySubject($request->get('class_id'));
            foreach ($getSubject as $value) {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type;

                $examSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);

                if (!empty($examSchedule)) {
                    $dataS['exam_date'] = $examSchedule->exam_date;
                    $dataS['start_time'] = $examSchedule->start_time;
                    $dataS['end_time'] = $examSchedule->end_time;
                    $dataS['exam_venue'] = $examSchedule->exam_venue;
                    $dataS['full_mark'] = $examSchedule->full_mark;
                    $dataS['pass_mark'] = $examSchedule->pass_mark;
                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['exam_venue'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['pass_mark'] = '';
                }

                $result[] = $dataS;
            }
        }
        // dd($result);

        $data['getRecord'] = $result;
        $data['header_title'] = 'Exam Schedule';
        return view('admin.exam.exam-schedule', $data);
    }

    public function insertExamSchedule(Request $request)
    {

        ExamScheduleModel::deleteRecord($request->get('exam_id'), $request->get('class_id'));




        if (!empty($request->schedule)) {

            foreach ($request->schedule as $schedule) {

                if (
                    !empty($schedule['subject_id']) && !empty($schedule['exam_date'])
                    && !empty($schedule['start_time']) && !empty($schedule['end_time']) &&
                    !empty($schedule['exam_venue']) && !empty($schedule['full_mark']) && !empty($schedule['pass_mark'])
                ) {
                    $exam = new ExamScheduleModel;
                    $exam->id = Str::uuid()->toString();
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->exam_venue = $schedule['exam_venue'];
                    $exam->full_mark = $schedule['full_mark'];
                    $exam->pass_mark = $schedule['pass_mark'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Exam Schedule Successfully Save');
    }
}
