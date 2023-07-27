<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailUserMail;
use App\Models\NoticeBoardMessageModel;
use App\Models\NoticeBoardModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    // Email Part

    public function sendEmail()
    {
        // $data['getRecord'] = NoticeBoardModel::getRecordUser(3);
        $data['header_title'] = 'Send Email';
        return view('admin.communicate.email.send-email', $data);
    }

    public function searchUser(Request $request)
    {
        $json = array();
        if (!empty($request->search)) {
            $getUser = User::searchUser($request->search);
            foreach ($getUser as $value) {
                $type = '';
                if ($value->user_type == 1) {
                    $type = 'Admin';
                } else if ($value->user_type == 2) {
                    $type = 'Teacher';
                } else if ($value->user_type == 3) {
                    $type = 'Student';
                } else if ($value->user_type == 4) {
                    $type = 'Parent';
                }
                $name = $value->name . ' ' . $value->middle_name . ' '  . $value->last_name . '  - ' . $type;
                $json[] = ['id' => $value->id, 'text' => $name];
            }
        }
        echo json_encode($json);
    }

    public function sendEmailUser(Request $request)
    {
        if (!empty($request->user_id)) {
            $user = User::getSingle($request->user_id);
            $user->send_subject = $request->subject;
            $user->send_message = $request->message;

            Mail::to($user->email)->send(new SendEmailUserMail($user));
        }

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $user_type) {
                $getUser = User::getUser($user_type);
                foreach ($getUser as $user) {
                    $user->send_subject = $request->subject;
                    $user->send_message = $request->message;

                    Mail::to($user->email)->send(new SendEmailUserMail($user));
                }
            }
        }


        return redirect()->back()->with('success', 'Mail Successfully send');
    }
}
