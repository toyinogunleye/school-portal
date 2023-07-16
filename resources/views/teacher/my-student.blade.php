@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Student List </h1>
            {{-- (Total : {{$getRecord->total()}})< --}}
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
                <h3 class="card-title">Search Student </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-2">
                    <label>Admission No</label>
                    <input type="text" class="form-control" value="{{Request::get('admission_number')}}" name="admission_number" placeholder="Admission Number">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" placeholder="Name">
                  </div>
                   <div class="form-group col-md-2">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" value="{{Request::get('middle_name')}}" name="middle_name" placeholder="Middle Name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name" placeholder="Last Name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Class</label>
                    <input type="text" class="form-control" value="{{Request::get('class')}}" name="class" placeholder="Class">
                  </div>
                   <div class="form-group col-md-2">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option value="">Select Gender</option>
                            <option {{ (Request::get('gender') == 'Male') ? 'selected': ''}} value="Male">Male</option>
                            <option {{ (Request::get('gender') == 'Female') ? 'selected': ''}} value="Female">Female</option>
                            <option {{ (Request::get('gender') == 'Others')? 'selected': ''}} value="Others">Others</option>
                        </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label>Created Date</label>
                    <input type="date" class="form-control" value="{{Request::get('date')}}" name="date" placeholder="Enter email">
                  </div>


                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('teacher/my-student')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>



            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0"  style="overflow: auto;">
                <table class="table ">
                  <thead>
                    <tr>

                      <th>S/N</th>
                      <th>Profile Pic</th>
                      <th>Student Name</th>
                      <th>Class</th>
                      <th>Admission Number</th>
                      <th>Gender</th>
                      <th>Email</th>

                      <th>Created Date</th>

                    </tr>
                  </thead>
                   @php($i = 1)

                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                         <td>{{$i++}}</td>
                        <td>
                            @if(!empty($value->getProfile()))
                                <img src="{{$value->getProfile()}}" style="height: 50px; width:50px; border-radius: 50px;">
                            @else
                                <img src="{{ asset('public/upload/profile/default-profile.png') }}" alt="Image" style="height: 50px; width:50px; border-radius: 50px;">
                            @endif
                        </td>
                        <td>{{$value->name}} {{$value->middle_name}} {{$value->last_name}}</td>
                        <td><b>{{$value->class_name}}</b></td>
                        <td><b>{{$value->admission_number}}</b></td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                    </tr>
                    @endforeach

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
