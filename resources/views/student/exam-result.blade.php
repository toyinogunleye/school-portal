@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>My Exam Results  </h1>
               {{-- (Total : {{$getRecord->total()}}) --}}
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            @foreach ($getRecord as $value )
            <div class="col-md-12">
               @include('_message')
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">{{ $value['exam_name'] }}</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>S/N</th>
                              <th>Subject</th>
                              <th>Class Work</th>
                              <th>Home Work</th>
                              <th>Test Mark</th>
                              <th>Exam Mark</th>
                              <th>Total Score</th>
                              <th>Pass Marks</th>
                              <th>Full Marks</th>
                              <th>Grade</th>
                              <th>Remarks</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php
                           $i = 1;
                           $total_score = 0;
                           $full_mark = 0;
                           $result_validation = 0;
                           @endphp
                           @foreach ($value['subject'] as $exam)
                            @php
                                $total_score = $total_score + $exam['total_score'];
                                $full_mark = $full_mark + $exam['full_mark'];

                            @endphp
                           <tr>
                              <td>{{$i++}} </td>
                              <td style="width: 200px">{{ $exam['subject_name'] }}</td>
                              <td>{{ $exam['class_work'] }}</td>
                              <td>{{ $exam['home_work'] }}</td>
                              <td>{{ $exam['test_mark'] }}</td>
                              <td>{{ $exam['exam_mark'] }}</td>
                               <td>
                                @if($exam['total_score'] >= $exam['pass_mark'])
                                    <span style="color: green">{{$exam['total_score']}}</span>
                                @else
                                <span style="color: red">{{$exam['total_score']}}</span>
                                @endif
                              </td>
                              {{-- <td>{{ $exam['total_score'] }}</td> --}}
                              <td>{{ $exam['pass_mark'] }}</td>
                              <td>{{ $exam['full_mark'] }}</td>
                              <td>
                                @php
                                // $percentage = ($totalStudentMarks * 100) / $totalFullMarks;
                                $getGrade = App\Models\MarkGradeModel::getGrade($exam['total_score']);
                                @endphp
                                 @if(!empty($getGrade))
                                <b>{{ $getGrade }}</b>
                                @endif
                              </td>

                              <td>
                                {{-- @php --}}
                                {{-- // $percentage = ($totalStudentMarks * 100) / $totalFullMarks; --}}
                                {{-- // $getGrade = App\Models\MarkGradeModel::getGrade($exam['total_score']); --}}
                                {{-- @endphp --}}
                                 @if(!empty($getGrade))
                               @if($getGrade !== 'F')
                               <span style="color: green; font-weight: bold;">Pass</span>
                               @else
                               <span style="color: red; font-weight:bold;">Failed</span>

                               @endif
                                @endif
                              </td>

                              {{-- <td>
                                @if($exam['total_score'] >= $exam['pass_mark'])
                                    <span style="color: green; font-weight: bold;">Pass</span>
                                @else
                                @php
                                $result_validation = 1;
                                @endphp
                                <span style="color: red; font-weight:bold;">Failed</span>
                                @endif
                              </td> --}}
                           </tr>
                            @endforeach

                            <tr>
                                <td colspan="2">
                                    <b>Grand Total: {{$total_score}}/{{$full_mark}}  </b>
                                </td>
                                 <td colspan="2">
                                   @php
                                $percentage = ($total_score * 100) / $full_mark;
                                $getLoopGrade = App\Models\MarkGradeModel::getGrade($percentage);
                                 @endphp
                                    <b>Percentage: {{ round(($percentage), 2) }}% </b>
                                </td>
                                <td colspan="2">
                                   <b> Grade: {{$getLoopGrade}}</b>
                                </td>
                                <td colspan="6">
                                    <b>Remark:
                                        @if (!empty($getLoopGrade))
                                        @if($getLoopGrade !== 'F')
                                    <span style="color: green;">Pass</span>
                                    @else
                                    <span style="color: red;">Fail</span>
                                    @endif

                                        @endif


                                     </b>
                                    {{-- <b>Remark: @if($result_validation == 0 )
                                         <span style="color: green;">Pass</span>
                                         @else
                                         <span style="color: red;">Fail</span>
                                         @endif
                                     </b> --}}
                                </td>
                            </tr>

                        </tbody>

                     </table>
                     <div style="padding: 10px;">
                        {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            @endforeach
            <!-- /.col -->
         </div>
         <!-- /.row -->
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
@endsection
