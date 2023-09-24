<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\SettingModel;
use App\Models\StudentAddFeesModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FeesCollectionController extends Controller
{

    public function collectFees(Request $request)
    {
        $data['getClass'] = ClassModel::getClassList();

        if (!empty($request->all())) {
            $data['getRecord'] = User::getCollectFeesStudent();
        }


        $data['header_title'] = 'Collect Fees';
        return view('admin.fees_collection.collect_fees', $data);
    }

    public function collectFeesReport()
    {
        $data['getClass'] = ClassModel::getClassList();
        $data['getRecord'] = StudentAddFeesModel::getRecord();

        $data['header_title'] = 'Collect Fees Report';
        return view('admin.fees_collection.collect_fees_report', $data);
    }



    public function addCollectFees($student_id)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        $data['header_title'] = 'Add Collect Fees';
        return view('admin.fees_collection.add_collect_fees', $data);
    }

    public function insertCollectFees($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);

        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        if (!empty($request->amount)) {

            $balance = $getStudent->amount - $paid_amount;

            if ($balance >= $request->amount) {

                $remaining_amount_user = $balance - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->id = Str::uuid()->toString();
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $balance;
                $payment->balance = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;
                $payment->save();

                return redirect()->back()->with('success', 'Fees Successfully Added');
            } else {
                return redirect()->back()->with('error', 'Amount Can not be greater than Balance');
            }
        } else {

            return redirect()->back()->with('error', 'Amount can not be Zero');
        }
    }

    //Student

    public function collectFeesStudent(Request $request)
    {
        $student_id = Auth::user()->id;

        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        $data['header_title'] = 'Fees Payment';
        return view('student.my_fees_payment', $data);
    }

    public function collectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);


        if (!empty($request->amount)) {

            $balance = $getStudent->amount - $paid_amount;
            if ($balance >= $request->amount) {

                $remaining_amount_user = $balance - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->id = Str::uuid()->toString();
                $payment->student_id = Auth::user()->id;;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $balance;
                $payment->balance = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();

                $getSetting = SettingModel::getSingle();
                $url = 'https://api.watupay.com/v1/payment/initiate';

                if ($request->payment_type == 'Online-Payment') {

                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $getSetting->authorisation_key,
                        'Content-Type' => 'application/json',
                    ])->post($url, [
                        'email' => Auth::user()->email,
                        'amount' => $request->amount,
                        'country' => 'NG',
                        'currency' => 'NGN',
                        'merchant_reference' => $payment->id,
                    ]);
                    // Check for a successful response
                    if ($response->successful()) {
                        $data = $response->json();
                        // Handle the response data here
                        return $data;
                    } else {
                        // Handle the error response here
                        $error = $response->json();
                        return $error;
                    }
                }

                // return redirect()->back()->with('success', 'Fees Successfully Added');
            } else {
                return redirect()->back()->with('error', 'Amount Can not be greater than Balance');
            }
        } else {

            return redirect()->back()->with('error', 'Amount can not be Zero');
        }


        // dd($request->all());
    }

    //Parent side

    public function collectFeesStudentParent($student_id, Request $request)
    {
        $getStudent = User::getSingle($student_id);
        $data['getStudent'] = $getStudent;

        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);


        $data['header_title'] = 'Fees Payment';
        return view('parent.fees_payment', $data);
    }

    public function collectFeesStudentPaymentParent($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);


        if (!empty($request->amount)) {

            $balance = $getStudent->amount - $paid_amount;
            if ($balance >= $request->amount) {

                $remaining_amount_user = $balance - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->id = Str::uuid()->toString();
                $payment->student_id = $getStudent->id;;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $balance;
                $payment->balance = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();

                $getSetting = SettingModel::getSingle();
                $url = 'https://api.watupay.com/v1/payment/initiate';

                if ($request->payment_type == 'Online-Payment') {

                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $getSetting->authorisation_key,
                        'Content-Type' => 'application/json',
                    ])->post($url, [
                        'email' => Auth::user()->email,
                        'amount' => $request->amount,
                        'country' => 'NG',
                        'currency' => 'NGN',
                        'merchant_reference' => $payment->id,
                    ]);
                    // Check for a successful response
                    if ($response->successful()) {
                        $data = $response->json();
                        // Handle the response data here
                        return $data;
                    } else {
                        // Handle the error response here
                        $error = $response->json();
                        return $error;
                    }
                }

                // return redirect()->back()->with('success', 'Fees Successfully Added');
            } else {
                return redirect()->back()->with('error', 'Amount Can not be greater than Balance');
            }
        } else {

            return redirect()->back()->with('error', 'Amount can not be Zero');
        }
    }
}
