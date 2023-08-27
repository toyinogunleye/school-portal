@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Attendance</h1>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mark Attendance </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                   <div class="form-group col-md-3">
                    <label>Class</label>
                    <select class="form-control" name="class_id" id="getClass" required>
                        <option value="">Select</option>
                        @foreach ($getClass as $class ){
                            <option  {{(Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                        }
                        @endforeach
                    </select>
                  </div>

                   <div class="form-group col-md-3">
                    <label>Attendance Date</label>
                    <input type="date" class="form-control" id="getAttendanceDate" value="{{Request::get('attendance_date')}}" name="attendance_date" required />
                  </div>


                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/attendance/student')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>
            {{-- @include('_message') --}}

            @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
                <div class="body>">
                    <div class="card-header">
                        <h3 class="card-title">Student List</h3>
                    </div>
                    <div class="card-body p-0" style="overflow: auto;">
                        <table class="table table-striped">

                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Student Name</th>
                                    <th>Attendance</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                     $i = 1;
                                @endphp

                                @if(!empty($getStudent) && !empty($getStudent->count()))

                                @foreach ($getStudent as $value )
                                    @php

                                    $attendance_type = '';
                                    $getAttendance = $value->getAttendance($value->id, Request::get('class_id'), Request::get('attendance_date'));

                                    if(!empty($getAttendance->attendance_type)){
                                        $attendance_type = $getAttendance->attendance_type;
                                    }

                                    @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        {{-- <td>{{$value->roll_number}}</td> --}}
                                         <td>{{$value->name}} {{$value->middle_name}} {{$value->last_name}}</td>
                                         <td>
                                            <label style="margin-right: 10px;">
                                                <input value="1" id="{{ $value->id }}" class="saveAttendance" type="radio" {{ ($attendance_type == '1') ? 'checked' : '' }} name="attendance{{$value->id}}"/> Present
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="2" id="{{ $value->id }}" class="saveAttendance" type="radio" {{ ($attendance_type == '2') ? 'checked' : '' }} name="attendance{{$value->id}}"/> Late
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="3" id="{{ $value->id }}" class="saveAttendance" type="radio" {{ ($attendance_type == '3') ? 'checked' : '' }} name="attendance{{$value->id}}"/> Absent
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="4" id="{{ $value->id }}" class="saveAttendance" type="radio" {{ ($attendance_type == '4') ? 'checked' : '' }} name="attendance{{$value->id}}"/> Half Day
                                            </label>
                                         </td>

                                    </tr>
                                @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            @endif


            <!-- /.card -->
          </div>

          {{-- @endif --}}
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('script')

<script type="text/javascript">


$('.saveAttendance').change(function(e){

    var student_id = $(this).attr('id');
    var attendance_type = $(this).val();
    var class_id = $('#getClass').val();
    var attendance_date = $('#getAttendanceDate').val();

    $.ajax({
        type: "POST",
        url: "{{ url('admin/attendance/student/save') }}",
        data : {
             '_token' : " {{ csrf_token() }} ",
             student_id : student_id,
             attendance_type : attendance_type,
             class_id : class_id,
             attendance_date : attendance_date,

        },
        dataType : "json",
        success: function(data) {
           alert(data.message);

        }
    });

});


</script>



@endsection
