@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mark Grade</h1>

          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/examination/mark-grade/add')}}" class="btn btn-primary">Add Mark Grade</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">




            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mark Grade List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Grade</th>
                      <th>Percent From</th>
                      <th>Percent To</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                   @php($i = 1)
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->percent_from}}</td>
                        <td>{{$value->percent_to}}</td>
                         <td>{{$value->user_fname}} {{$value->user_lname}} {{$value->user_mname}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                        <td>
                            <a href="{{url('admin/examination/mark-grade/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                             <a href="{{url('admin/examination/mark-grade/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach

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
