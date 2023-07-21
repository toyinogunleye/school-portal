<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoardMessageModel;
use App\Models\NoticeBoardModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CommunicateController extends Controller
{
    public function noticeBoard()
    {
        $data['getRecord'] = NoticeBoardModel::getRecord();
        $data['header_title'] = 'Notice Board';
        return view('admin.communicate.noticeboard.list', $data);
    }

    public function addNoticeBoard()
    {
        $data['header_title'] = 'Add Notice Board';
        return view('admin.communicate.noticeboard.add', $data);
    }

    public function insertNoticeBoard(Request $request)
    {
        $save = new NoticeBoardModel;
        $save->id = Str::uuid()->toString();
        $save->title = trim($request->title);
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = trim($request->message);
        $save->created_by = Auth::user()->id;
        $save->save();

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $message_to) {
                $message = new NoticeBoardMessageModel;
                $message->id = Str::uuid()->toString();
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice-board')->with('success', 'Notice Board Successfully created');
    }

    public function editNoticeBoard($id)
    {
        $data['getRecord'] = NoticeBoardModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Notice Board';
            return view('admin.communicate.noticeboard.edit', $data);
        } else {
            abort(404);
        }
    }

    public function updateNoticeBoard($id, Request $request)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->title = trim($request->title);
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = trim($request->message);
        $save->save();

        NoticeBoardMessageModel::deleteRecord($id);

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $message_to) {
                $message = new NoticeBoardMessageModel;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice-board')->with('success', 'Notice Board Successfully Updated');
    }

    public function deleteNoticeBoard($id)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->delete();

        NoticeBoardMessageModel::deleteRecord($id);

        return redirect()->back()->with('success', 'Notice Board Successfully Deleted');
    }

    // student side work

    public function noticeBoardStudent()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);

        $data['header_title'] = 'Notice Board';
        return view('student.notice-board', $data);
    }

    public function noticeBoardTeacher()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = 'Notice Board';
        return view('teacher.notice-board', $data);
    }

    public function noticeBoardParent()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = 'Notice Board';
        return view('parent.notice-board', $data);
    }

    public function myStudentNoticeBoard()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(3);
        $data['header_title'] = 'Notice Board';
        return view('parent.my-student-notice-board', $data);
    }
}
