@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Homework</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('teacher/homework/create-homework')}}" class="btn btn-primary">Create Homework</a>
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
                <h3 class="card-title">Search Homework </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>Class</label>
                    <input type="text" class="form-control" value="{{Request::get('class_name')}}" name="class_name" placeholder="Class Name">
                  </div>
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
                    <a href="{{url('teacher/homework')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a>
                  </div>
                </div>
            </div>
            </form>
            </div>



            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Homework List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>

                      <th>Class</th>
                      <th>Subject</th>
                        <th>Created By</th>
                      <th>Homework Date</th>
                      <th>Submission Date</th>
                      <th>Document</th>
                        {{-- <th>Description</th> --}}
                        <th>Created Date</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                   @php($i = 1)
                  <tbody>
                    @forelse($getRecord as $value)
                    <tr>
                        <td>{{$i++}}</td>

                        <td>{{$value->class_name}}</td>
                        <td>{{$value->subject_name}}</td>
                          <td>{{$value->created_by}}</td>

                        <td>{{date('d-m-Y H:i A', strtotime($value->homework_date))}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->submission_date))}}</td>
                        <td>
                            @if(!empty($value->getDocument()))
                                <a href="{{$value->getDocument()}}" class="btn btn-primary" download="">Download</a>

                            @endif

                               {{-- <img src="{{$value->getDocument()}}" style="height: 50px; width:50px; border-radius: 50px;"> --}}

                        </td>
                        {{-- <td>

                        @foreach ($value->getMessage as $message )
                            @if($message->message_to == 2)
                                 <div>Teacher</div>
                            @elseif ($message->message_to == 3)
                                <div>Student</div>
                            @elseif ($message->message_to == 4)
                                <div>Parent</div>
                            @endif
                        @endforeach

                        </td> --}}

                        {{-- <td>{{$value->description}}</td> --}}

                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                        <td>
                            {{-- <a href="{{url('admin/homework/view-homework/'.$value->id)}}" class="btn btn-primary btn-sm">view</a> --}}
                            <a href="{{url('teacher/homework/edit-homework/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                             <a href="{{url('teacher/homework/delete-homework/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                              <a href="{{url('teacher/homework/submitted-homework/'.$value->id)}}" class="btn btn-success btn-sm">Submitted Homework</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100%">Record not found.
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
