@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mark Register</h1>


      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search Mark Register </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Exam</label>
                    <select class="form-control" name="exam_id" required>
                        <option value="">Select</option>
                        @foreach ($getExam as $exam ){
                            <option {{(Request::get('exam_id') == $exam->exam_id) ? 'selected' : ''}} value="{{$exam->exam_id}}">{{$exam->exam_name}}</option>
                        }
                        @endforeach
                    </select>
                  </div>

                   <div class="form-group col-md-3">
                    <label>Class</label>
                    <select class="form-control" name="class_id" required>
                        <option value="">Select</option>
                        @foreach ($getClass as $class ){
                            <option  {{(Request::get('class_id') == $class->class_id) ? 'selected' : ''}} value="{{$class->class_id}}">{{$class->class_name}}</option>
                        }
                        @endforeach
                    </select>
                  </div>


                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/examination/mark-register')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>



            @include('_message')

            @if(!empty($getSubject) && !empty($getSubject->count()))


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mark Register</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>STUDENTS  NAME</th>
                      @foreach ($getSubject as $subject )
                      <th>{{$subject->subject_name}} <br />
                        ( {{$subject->subject_type}} : {{$subject->pass_mark}}/{{$subject->full_mark}})
                      </th>
                      @endforeach
                       <th>ACTION</th>
                    </tr>
                  </thead>
                   <tbody>
                         @php
                            $i = 1;
                        @endphp

                    @if(!empty($getStudent) && !empty($getStudent->count()))

                        @foreach ($getStudent as $student )
                        <form name="post"  class="SubmitForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="student_id" value="{{$student->id}}">
                            <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">

                            <tr>
                                <td>{{$i++}} </td>
                                <td>{{$student->name}} {{$student->last_name}} </td>
                                    @php
                                    $i = 1;
                                    $totalStudentMarks = 0;
                                    $totalFullMarks = 0;
                                    $totalPassMarks = 0;
                                    $pass_fail_val = 0;

                                    @endphp
                                    @foreach ($getSubject as $subject )

                                    @php

                                        $totalMark = 0;
                                        $totalFullMarks = $totalFullMarks + $subject->full_mark;
                                        $totalPassMarks = $totalPassMarks + $subject->pass_mark;


                                        $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'),
                                         $subject->subject_id);

                                         if(!empty($getMark)){

                                            $totalMark =  $getMark->class_work + $getMark->home_work + $getMark->test_mark + $getMark->exam_mark;
                                         }

                                         $totalStudentMarks = $totalStudentMarks + $totalMark;

                                    @endphp
                                        <td>
                                            <div style="margin-bottom: 10px" >
                                                Class work

                                                <input type="hidden" name="mark[{{ $i }}][full_mark]" value="{{$subject->full_mark}}">
                                                <input type="hidden" name="mark[{{ $i }}][pass_mark]" value="{{$subject->pass_mark}}">

                                                <input type="hidden" name="mark[{{ $i }}][id]" value="{{$subject->id}}">
                                                <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{$subject->subject_id}}" class="form-control">
                                                <input type="number" name="mark[{{ $i }}][class_work]" id="class_work_{{$student->id}}{{$subject->subject_id}}" style="width: 200px" class="form-control" placeholder="Enter Mark"
                                                value="{{ !empty($getMark) ? $getMark->class_work : ''}}">

                                            </div>

                                            <div style="margin-bottom: 10px" >
                                                Home work
                                                <input type="number" name="mark[{{ $i }}][home_work]"  id="home_work_{{$student->id}}{{$subject->subject_id}}"  value="{{ !empty($getMark) ? $getMark->home_work : ''}}" style="width: 200px"  class="form-control"
                                               placeholder="Enter Mark">
                                            </div>

                                            <div style="margin-bottom: 10px" >
                                                Test Mark
                                                <input type="number" name="mark[{{ $i }}][test_mark]" id="test_mark_{{$student->id}}{{$subject->subject_id}}"  value="{{ !empty($getMark) ? $getMark->test_mark : ''}}" style="width: 200px"  class="form-control" placeholder="Enter Mark">
                                            </div>

                                            <div style="margin-bottom: 10px" >
                                                Exam
                                                <input type="number" name="mark[{{ $i }}][exam_mark]" style="width: 200px" id="exam_mark_{{$student->id}}{{$subject->subject_id}}"  value="{{ !empty($getMark) ? $getMark->exam_mark : ''}}" class="form-control" placeholder="Enter Mark">
                                            </div>

                                             <div style="margin-bottom: 10px" >
                                                 <button type="button" class="btn btn-primary SaveSingleSubject" id="{{ $student->id }}" data-val="{{ $subject->subject_id }}"
                                                    data-exam="{{Request::get('exam_id')}}" data-schedule="{{ $subject->id }}" data-class="{{Request::get('class_id')}}">
                                                    Save Mark
                                                </button>
                                             </div>

                                             @if(!empty($getMark))
                                              <div style="margin-bottom: 10px" >
                                               <b>Total Mark: </b>{{ $totalMark }} <br />
                                               <b>Passing Mark: </b>{{ $subject->pass_mark }} <br />

                                               @php
                                                  $getLoopGrade = App\Models\MarkGradeModel::getGrade($totalMark);
                                               @endphp
                                               @if(!empty($getLoopGrade))
                                                <b>Grade: </b>{{ $getLoopGrade }} <br />
                                               @endif

                                                @if(!empty($getLoopGrade))
                                                @if( $getLoopGrade !== 'F' )
                                                <span style="color: green; font-weight:bold;">Pass</span>
                                               @else
                                               <span style="color: red; font-weight:bold;">Fail</span>
                                               @php
                                                   $pass_fail_val = 1;
                                               @endphp
                                               @endif
                                               @endif



                                               {{-- @if( $totalMark >= $subject->pass_mark )
                                                Remark: <span style="color: green; font-weight:bold;">Pass</span>
                                               @else
                                               Remark: <span style="color: red; font-weight:bold;">Fail</span>
                                               @php
                                                   $pass_fail_val = 1;
                                               @endphp
                                               @endif --}}
                                             </div>
                                             @endif




                                        </td>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                     <td style="min-width: 250px;">
                                        <button type="submit" class="btn btn-success">Save All</button>

                                        @if(!empty($totalStudentMarks))


                                            <br />
                                            <br />

                                            <b>Total Subjects Mark:</b> {{ $totalFullMarks }}
                                            <br />
                                            <b>Total Passing Mark:</b> {{ $totalPassMarks }}
                                            <br />
                                            <b>Total  Students Mark:</b> {{ $totalStudentMarks }}
                                            <br />

                                            @php
                                              $percentage = ($totalStudentMarks * 100) / $totalFullMarks;
                                              $getGrade = App\Models\MarkGradeModel::getGrade($percentage);
                                            @endphp
                                            <br />
                                           <b>Percantage:</b> {{ round($percentage, 2) }}%
                                           <br />
                                           @if(!empty($getGrade))
                                           <b>Grade:</b> {{ $getGrade }}
                                           @endif
                                           <br />

                                            @if(!empty($getGrade))
                                           @if($getGrade !== 'F')
                                                Result: <span style="color: green; font-weight:bold;">Pass</span>
                                            @else
                                               Result: <span style="color: red; font-weight:bold;">Fail</span>
                                            @endif
                                            @endif


                                            {{-- @if($pass_fail_val == 0)
                                                Result: <span style="color: green; font-weight:bold;">Pass</span>
                                            @else
                                               Result: <span style="color: red; font-weight:bold;">Fail</span>
                                            @endif --}}

                                        @endif



                                     </td>
                            </tr>
                        </form>
                        @endforeach

                    @endif
                   </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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

$('.SubmitForm').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('teacher/submit-mark-register') }}",
        data : $(this).serialize(),
        dataType : "json",
        success: function(data){
            alert(data.message);

        }
    });
})

$('.SaveSingleSubject').click(function(e){
    var student_id = $(this).attr('id');
    var subject_id = $(this).attr('data-val');
    var exam_id = $(this).attr('data-exam');
    var class_id = $(this).attr('data-class');
    var id = $(this).attr('data-schedule');
    var class_work = $('#class_work_'+student_id+subject_id).val();
    var home_work = $('#home_work_'+student_id+subject_id).val();
    var test_mark = $('#test_mark_'+student_id+subject_id).val();
    var exam_mark = $('#exam_mark_'+student_id+subject_id).val();

    $.ajax({
        type: "POST",
        url: "{{ url('teacher/single-submit-mark-register') }}",
        data : {
             '_token' : " {{ csrf_token() }} ",
            id : id,
            student_id : student_id,
            subject_id : subject_id,
            exam_id : exam_id,
            class_id : class_id,
            class_work : class_work,
            home_work : home_work,
            test_mark : test_mark,
            exam_mark : exam_mark,

        },
        dataType : "json",
        success: function(data){
            alert(data.message);

        }
    });

});

</script>



@endsection
