@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Class Timetable </h1>
            <p style="color: blue">({{$getStudent->name }} {{$getStudent->middle_name }} {{$getStudent->last_name }})</p>
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
                        <h3 class="card-title"> <b >{{ $getClass->name }} - {{ $getSubject->name }} </b></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead style="color:darkblue">
                                <tr>
                                    <th>Week</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Venue</th>
                                </tr>
                            </thead>
                        <tbody>
                             @foreach ($getRecord as $valueW )
                                <tr>
                                    <td>{{$valueW['week_name']}}</td>
                                    <td>{{ !empty($valueW['start_time']) ? date('h:i A',strtotime($valueW['start_time'])) : '' }}</td>
                                     <td>{{ !empty($valueW['end_time']) ? date('h:i A',strtotime($valueW['end_time'])) : '' }}</td>
                                    <td>{{$valueW['venue']}}</td>
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




