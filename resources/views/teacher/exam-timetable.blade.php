@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Exam Timetable</h1>
          </div>
          {{-- <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('student/homework/submitted-homework')}}" class="btn btn-primary">Submitted Homeworks</a>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          {{-- <div class="card"> --}}



            @include('_message')

            @foreach ($getRecord as $value )

              <h2 style="font-size: 32px; margin-bottom: 15px;"> Class : <span style="color:blue"> {{ $value['class_name'] }} </span></h2>

              @foreach ($value['exam'] as $exam )

                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Exam Name: <span style="color:darkslateblue "> <b>{{ $exam['exam_name'] }} </span></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0" style="overflow: auto;">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>S/N</th>
                        <th>Subject Name</th>
                        <th>Day</th>
                        <th>Exam Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Exam Venue</th>
                        <th>Full Mark</th>
                        <th>Pass Mark</th>
                        {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    @php($i = 1)
                    <tbody>

                            @foreach($exam['subject'] as $valueS)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$valueS['subject_name']}}</td>
                                <td>{{ date('l', strtotime($valueS['exam_date'])) }}</td>
                                <td>{{ date('d-m-Y', strtotime($valueS['exam_date'])) }}</td>
                                <td>{{ date('h:i: A', strtotime($valueS['start_time'])) }}</td>
                            <td>{{ date('h:i: A', strtotime($valueS['end_time'])) }}</td>
                                <td>{{$valueS['exam_venue']}}</td>
                                <td>{{$valueS['full_mark']}}</td>
                                <td>{{$valueS['pass_mark']}}</td>


                            @endforeach


                    </tbody>
                    </table>
                    {{-- <div style="padding: 10px;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div> --}}

                </div>
                <!-- /.card-body -->
                </div>
                @endforeach
             @endforeach

        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
