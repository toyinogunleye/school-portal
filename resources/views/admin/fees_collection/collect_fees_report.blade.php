@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>Fees Payment Reports </h1>

          </div>



        </div>
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search Payment Report </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">

                    <div class="form-group col-md-2">
                    <label>Admission No </label>
                    <input type="text" class="form-control" value="{{Request::get('admission_number')}}" name="admission_number" />
                  </div>


                  <div class="form-group col-md-2">
                    <label>Student First Name</label>
                    <input type="text" class="form-control" value="{{Request::get('student_fname')}}" name="student_fname"/>
                  </div>

                   <div class="form-group col-md-2">
                    <label>Student Middle Name</label>
                    <input type="text" class="form-control" value="{{Request::get('student_mname')}}" name="student_mname"/>
                  </div>

                  <div class="form-group col-md-2">
                    <label>Student Last Name</label>
                    <input type="text" class="form-control" value="{{Request::get('student_lname')}}" name="student_lname"/>
                  </div>
                    <div class="form-group col-md-2">
                    <label>Class</label>
                    <select class="form-control" name="class_id">
                        <option value="">Select</option>
                        @foreach ($getClass as $class )
                            <option  {{(Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label>Payment Type</label>
                    <select class="form-control" name="payment_type">
                        <option value="">Select</option>
                            <option  {{(Request::get('payment_type') == 'Cash') ? 'selected' : ''}} value="Cash">Cash </option>
                            <option  {{(Request::get('payment_type') == 'Transfer') ? 'selected' : ''}} value="Transfer">Transfer </option>
                            <option  {{(Request::get('payment_type') == 'Cheque') ? 'selected' : ''}} value="Cheque">Cheque </option>
                            <option  {{(Request::get('payment_type') == 'Online-Payment') ? 'selected' : ''}} value="Online-Payment">Online Payment </option>

                    </select>
                  </div>


                  <div class="form-group col-md-2">
                    <label>Payment Date</label>
                    <input type="date" class="form-control" value="{{Request::get('payment_date')}}" name="payment_date" >
                  </div>
                  <div class="form-group col-md-2">
                    <label>Date From</label>
                    <input type="date" class="form-control" value="{{Request::get('date_from')}}" name="date_from" >
                  </div>
                   <div class="form-group col-md-2">
                    <label>Date To</label>
                    <input type="date" class="form-control" value="{{Request::get('date_to')}}" name="date_to" >
                  </div>
                  <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/fees-collection/collect-fees-report')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>


            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Fees Payment Reports</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Admission No</th>
                      <th>Student Name</th>
                      <th>Class Name</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Balance</th>
                      <th>Payment Type</th>
                      <th>Remarks</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Updated Date</th>
                       {{-- <th>Status</th> --}}
                    </tr>
                  </thead>

                  <tbody>
                    @php
                    $i = 1;
                  @endphp

                    @forelse ($getRecord as $value )
                        <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value->admission_number }}</td>
                        <td>{{ $value->student_fname }} {{ $value->student_mname }} {{ $value->student_lname }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>N{{number_format($value->total_amount, 2) }}</td>
                            <td>N{{ number_format($value->paid_amount, 2) }}</td>
                            <td>
                                @if($value->balance > 0)
                                   <span style="color: red"> N{{number_format( $value->balance, 2) }}</span>
                                @else
                                N{{number_format( $value->balance, 2) }}

                                @endif
                            </td>
                            <td>{{ $value->payment_type }}</td>
                            <td>{{ $value->remark }}</td>
                            <td>{{ $value->created_fname }} {{ $value->created_mname }} {{ $value->created_lname }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                            {{-- <td>
                                 @if($value->is_payment == 0)
                                   <span style="color: red"> <b>Pending</b></span>
                                @else
                                 <span style="color: green"> <b>Successful</b></span>

                                @endif
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">Record not found</td>
                        </tr>

                    @endforelse
                  </tbody>
                </table>
                 <div style="padding: 10px;">
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection


