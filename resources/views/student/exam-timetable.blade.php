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
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search My Homeworks </h3>


                      <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    {{-- <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->



      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown" style="margin-top: -20px">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bars"></i>
          <span class="badge badge-warning navbar-badge">{{count($getRecord)}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Search Homework</span>
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a> --}}
          <form method="get" action="">

            <div class="form-group col-md-12">
                Subject
                    <input type="text" class="form-control" value="{{Request::get('subject_name')}}" name="subject_name" placeholder="Subject Name">
            </div>

            <div class="dropdown-divider"></div>

            <div class="input-group col-md-12">
                                <input type="search" class="form-control" value="{{Request::get('subject_name')}}" name="subject_name" placeholder="Type your keywords here" value="Lorem ipsum">
                                <div class="input-group-append">
                                    <button type="submit" class="btn  btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>

            <div class="form-group col-md-12">
                    Date From
                    <input type="date" class="form-control" value="{{Request::get('homework_date_from')}}" name="homework_date_from">
            </div>

            <div class="dropdown-divider"></div>

            <div class="form-group col-md-12">
                   Date To
                    <input type="date" class="form-control" value="{{Request::get('homework_date_to')}}" name="homework_date_to">
            </div>

            <div class="dropdown-divider"></div>

            <div class="form-group col-md-12">
                   Submission Date From
                    <input type="date" class="form-control" value="{{Request::get('submission_date_from')}}" name="submission_date_from">
            </div>

            <div class="dropdown-divider"></div>

            <div class="form-group col-md-12">
                   Submission Date To
                    <input type="date" class="form-control" value="{{Request::get('submission_date_to')}}" name="submission_date_to">
            </div>

            <div class="dropdown-divider"></div>

            <div class="form-group col-md-12">
                    <button class="btn btn-sm btn-primary col-md-12" type="submit">Search</button>
                    {{-- <a href="{{url('student/my-homework')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a> --}}
            </div>
          </form>

          <div class="dropdown-divider"></div>
          <a href="{{url('student/my-homework')}}" class="dropdown-item dropdown-footer">See All Homeworks</a>
        </div>
      </li>


    </ul>
  </nav>



              </div>




            {{-- <form method="get" action="">
            <div class="card-body">
                <div class="row">

                  <div class="form-group col-md-2">
                    <label>Subject</label>
                    <input type="text" class="form-control" value="{{Request::get('subject_name')}}" name="subject_name" placeholder="Subject Name">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Date From</label>
                    <input type="date" class="form-control" value="{{Request::get('homework_date_from')}}" name="homework_date_from">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Date To</label>
                    <input type="date" class="form-control" value="{{Request::get('homework_date_to')}}" name="homework_date_to">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Submission Date From</label>
                    <input type="date" class="form-control" value="{{Request::get('submission_date_from')}}" name="submission_date_from">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Submission Date To</label>
                    <input type="date" class="form-control" value="{{Request::get('submission_date_to')}}" name="submission_date_to">
                  </div>


                  <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('student/my-homework')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a>
                  </div>
                </div>
            </div>
            </form>
            </div> --}}



            @include('_message')

            @foreach ($getRecord as $value )

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $value['name'] }}</h3>
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
                    @foreach($value['exam'] as $valueS)
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

                    @empty
                    <tr>
                        <td colspan="100%">Record not found.
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                <div style="padding: 10px;">
                {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                </div>

              </div>
              <!-- /.card-body -->
            </div>
             @endforeach
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
