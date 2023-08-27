<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function addCollectFees()
    {



        $data['header_title'] = 'Add Collect Fees';
        return view('admin.fees_collection.add_collect_fees', $data);
    }
}
