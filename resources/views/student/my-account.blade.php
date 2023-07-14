@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$getRecord->name}} {{$getRecord->middle_name}} {{$getRecord->last_name}}  </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/teacher/add-teacher')}}" class="btn btn-primary">Edit Teacher</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{$getRecord->getProfile()}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$getRecord->name}} {{$getRecord->middle_name}} {{$getRecord->last_name}}</h3>

                <p class="text-muted text-center">Active</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Phone Number</b> <a class="float-right">{{$getRecord->mobile_number}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$getRecord->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Class</b> <a class="float-right">{{$getRecord->class_name}}</a>
                  </li>
                </ul>

                <a href="{{url('admin/teacher/edit-teacher/'.$getRecord->id)}}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Bio</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Education</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Guarantor Info</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class=" active tab-pane" id="activity">
                    <div class="card-body">
                        <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Full Name</td>
                                <td>{{$getRecord->name}} {{$getRecord->middle_name}} {{$getRecord->last_name}}</td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>{{$getRecord->mobile_number}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$getRecord->email}}</td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>{{$getRecord->date_of_birth}}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{$getRecord->gender}}</td>
                            </tr>
                            <tr>
                                <td>Marital Status</td>
                                <td>{{$getRecord->marital_status}}</td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>{{$getRecord->nationality}}</td>
                            </tr>
                            <tr>
                                <td>State of Origin</td>
                                <td>{{$getRecord->state_of_origin}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$getRecord->city}}</td>
                            </tr>
                            <tr>
                                <td>Current Address</td>
                                <td>{{$getRecord->address}}</td>
                            </tr>
                            <tr>
                                <td>Permanent Address</td>
                                <td>{{$getRecord->permanent_address}}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>

                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="card-body">
                        <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Institution Attended</td>
                                <td>{{$getRecord->school_attended}} </td>
                            </tr>
                            <tr>
                                <td>Course</td>
                                <td>{{$getRecord->course_study}}</td>
                            </tr>
                            <tr>
                                <td>Qualification</td>
                                <td>{{$getRecord->qualification}}</td>
                            </tr>
                            <tr>
                                <td>Year of Graduation</td>
                                <td>{{$getRecord->graduated_year}}</td>
                            </tr>
                            <tr>
                                <td>Years of Experience</td>
                                <td>{{$getRecord->work_experience}}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                  </div>

                   <div class="tab-pane" id="settings">
                    <!-- The timeline -->
                    <div class="card-body">
                        <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Guarantor Name</td>
                                <td>{{$getRecord->guarantor_name}} </td>
                            </tr>
                            <tr>
                                <td>Guarantor Phone number</td>
                                <td>{{$getRecord->guarantor_number}}</td>
                            </tr>
                            <tr>
                                <td>Guarantor Address</td>
                                <td>{{$getRecord->guarantor_address}}</td>
                            </tr>

                        </tbody>
                        </table>
                    </div>
                  </div>


                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->

    <!-- /.content -->
  </div>

@endsection
