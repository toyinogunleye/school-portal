@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exam Schedule
                {{-- (Total : {{$getRecord->total()}})</h1> --}}
          {{-- </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/examination/add-exam')}}" class="btn btn-primary">Add New Exam</a>
          </div>
        </div> --}}
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Exam Schedule </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Exam</label>
                    <select class="form-control" name="exam_id" required>
                        <option value="">Select</option>
                        @foreach ($getExam as $exam ){
                            <option {{(Request::get('exam_id') == $exam->id) ? 'selected' : ''}} value="{{$exam->id}}">{{$exam->name}}</option>
                        }
                        @endforeach
                    </select>
                  </div>

                   <div class="form-group col-md-3">
                    <label>Class</label>
                    <select class="form-control" name="class_id" required>
                        <option value="">Select</option>
                        @foreach ($getClass as $class ){
                            <option  {{(Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                        }
                        @endforeach
                    </select>
                  </div>


                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/examination/exam-schedule')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>



            @include('_message')

            @if(!empty($getRecord))
            <form action="{{ url('admin/examination/insert-exam-schedule')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="exam_id" value="{{Request::get('exam_id')}}">
                <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Exam List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Subject Name</th>
                      <th>Exam Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Exam Venue</th>
                      <th>Full Mark</th>
                      <th>Pass Mark</th>
                       {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                   <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($getRecord as $value )
                     <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value['subject_name']}}
                            <input type="hidden" value="{{$value['subject_id']}}" name="schedule[{{$i}}][subject_id]" class="form-control">
                        </td>
                        <td><input type="date" value="{{$value['exam_date']}}" name="schedule[{{$i}}][exam_date]" class="form-control"></td>
                        <td><input type="time" value="{{$value['start_time']}}" name="schedule[{{$i}}][start_time]"  class="form-control"></td>
                        <td><input type="time" value="{{$value['end_time']}}" name="schedule[{{$i}}][end_time]"  class="form-control"></td>
                        <td><input type="text" value="{{$value['exam_venue']}}" name="schedule[{{$i}}][exam_venue]"  class="form-control"></td>
                        <td><input type="text" value="{{$value['full_mark']}}" name="schedule[{{$i}}][full_mark]"  class="form-control"></td>
                        <td><input type="number" value="{{$value['pass_mark']}}" name="schedule[{{$i}}][pass_mark]"  class="form-control"></td>
                    </tr>
                    @php
                        $i++
                    @endphp
                    @endforeach
                   </tbody>
                </table>
                <div style="text-align: center; padding: 20px;">
                    <button class="btn btn-primary">Submit</button>
                </div>
                <div style="padding: 10px;">
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            </form>
          @endif
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
