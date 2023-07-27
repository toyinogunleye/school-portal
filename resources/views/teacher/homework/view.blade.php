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
              <a href="{{url('admin/homework/create-homework')}}" class="btn btn-primary">Create Homework</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          {{-- <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search Homework </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>Title</label>
                    <input type="text" class="form-control" value="{{Request::get('title')}}" name="title" placeholder="Title">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Notice Date From</label>
                    <input type="date" class="form-control" value="{{Request::get('notice_date_from')}}" name="notice_date_from">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Notice Date To</label>
                    <input type="date" class="form-control" value="{{Request::get('notice_date_to')}}" name="notice_date_to">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Publish Date From</label>
                    <input type="date" class="form-control" value="{{Request::get('publish_date_from')}}" name="publish_date_from">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Publish Date To</label>
                    <input type="date" class="form-control" value="{{Request::get('publish_date_to')}}" name="publish_date_to">
                  </div>
                    <div class="form-group col-md-2">
                    <label>Message To</label>
                    <select class="form-control" name="message_to">
                            <option value="">Select</option>
                            <option {{ (Request::get('message_to') == 4) ? 'selected': ''}} value="4">Parents</option>
                            <option {{ (Request::get('message_to') ==  3) ? 'selected': ''}} value="3">Students</option>
                            <option {{ (Request::get('message_to') ==  2) ? 'selected': ''}} value="2">Teachers</option>
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/communicate/notice-board')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a>
                  </div>
                </div>
            </div>
            </form>
            </div> --}}



            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Homework List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">

                 <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Class</td>
                                @foreach ($getClass as $class )
                                <td >{{$class->name}}</td>
                                @endforeach

                            </tr>
                            <tr>
                                <td>Subject</td>
                               @foreach ($getSubject as $subject )
                                <td>{{$subject->subject_name}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td>{{$getRecord->created_by}}</td>
                            </tr>
                            <tr>
                                <td>Homework Date</td>
                                <td>{{date('d-m-Y H:i A', strtotime($getRecord->homework_date))}}</td>
                            </tr>
                            <tr>
                                <td>Submission Date</td>
                                 <td>{{date('d-m-Y H:i A', strtotime($getRecord->submission_date))}}</td>
                            </tr>
                            <tr>
                                <td>Document</td>
                                <td>
                            @if(!empty($getRecord->getDocument()))
                                <a href="{{$getRecord->getDocument()}}" class="btn btn-primary" download="">Download</a>

                            @endif

                               {{-- <img src="{{$value->getDocument()}}" style="height: 50px; width:50px; border-radius: 50px;"> --}}

                        </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{$getRecord->description}}</td>
                            </tr>

                        </tbody>
                        </table>





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
