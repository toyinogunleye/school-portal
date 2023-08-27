@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Attendance</h1>
            {{$getStudent->name}} {{$getStudent->middle_name}} {{$getStudent->last_name}}
            <p style="color: blue">Total: {{ $getRecord->total()}} </p>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search List </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">

                   <div class="form-group col-md-2">
                    <label>Class</label>
                    <select class="form-control" name="class_id">
                        <option value="">Select</option>
                        @foreach ($getClass as $class ){
                            <option  {{(Request::get('class_id') == $class->class_id) ? 'selected' : ''}} value="{{$class->class_id}}">{{$class->class_name}}</option>                        }
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label>Attendance Date</label>
                    <input type="date" class="form-control" value="{{Request::get('attendance_date')}}" name="attendance_date"/>
                  </div>

                  <div class="form-group col-md-2">
                    <label>Start Attendance Date</label>
                    <input type="date" class="form-control" value="{{Request::get('start_attendance_date')}}" name="start_attendance_date" >
                  </div>

                   <div class="form-group col-md-2">
                    <label>End Attendance Date</label>
                    <input type="date" class="form-control" value="{{Request::get('end_attendance_date')}}" name="end_attendance_date" >
                  </div>

                  <div class="form-group col-md-2">
                    <label>Attendance Type</label>
                    <select class="form-control" name="attendance_type">
                        <option value="">Select</option>
                        <option {{(Request::get('attendance_type') == 1) ? 'selected' : ''}} value="1">Present</option>
                        <option {{(Request::get('attendance_type') == 2) ? 'selected' : ''}} value="2">Late</option>
                        <option {{(Request::get('attendance_type') == 3) ? 'selected' : ''}} value="3">Absent</option>
                        <option {{(Request::get('attendance_type') == 4) ? 'selected' : ''}} value="4">Half Day</option>
                    </select>
                  </div>


                  <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('parent/my-student/attendance/'.$getStudent->id) }}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>

             @include('_message')


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attendance List</h3>
                    </div>
                    <div class="card-body p-0" style="overflow: auto;">
                        <table class="table table-striped">
                            <thead>
                                <tr>

                                    <th>Class Name</th>
                                    <th>Attendance</th>
                                    <th>Attendance Date</th>
                                    <th>Created Date</th>

                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($getRecord as $value )
                                    <tr>
                                        <td>{{$value->class_name}}</td>
                                        <td>
                                            @if($value->attendance_type == 1)
                                                Present
                                            @elseif($value->attendance_type == 2)
                                                Late
                                            @elseif($value->attendance_type == 3)
                                                <span style="color: red">Absent</span>
                                            @elseif($value->attendance_type == 4)
                                                Half Day
                                            @endif
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($value->attendance_date))}}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->created_at))}}</td>
                                    </tr>

                                @empty
                                <tr>
                                    <td colspan="100%">Record not found</td>
                                </tr>

                                @endforelse



                            </tbody>
                        </table>

                        @if(!empty($getRecord))
                        <div style="padding: 10px; float: right;">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                        @endif

                    </div>
                </div>


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

</script>



@endsection
