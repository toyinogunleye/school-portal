@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Student   </h1>
          </div>
          {{-- <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/parent/add-parent')}}" class="btn btn-primary">Add New Parent</a>
          </div> --}}
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
                <h3 class="card-title">My Student</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Profile Pic</th>
                      <th>Student Name</th>
                      <th>Email</th>
                      {{-- <th>Parent Name</th> --}}
                      <th>Gender</th>
                      <th>Class</th>
                      <th>Status</th>
                      <th>Created Date</th>
                       <th>Action</th>
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
                        <td>{{$value->email}}</td>
                        {{-- <td>{{$value->parent_name}} {{$value->parent_last_name}}</td> --}}
                         <td>{{$value->gender}}</td>
                        <td><b>{{$value->class_name}}</b></td>
                        <td> {{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                        <td>{{$value->email}}</td>

                        <td class=>
                            {{-- {{url('admin/student/view-student/'.$value->id)}} --}}

                                <a href="" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{url('parent/my-student/subject/'.$value->id)}}" class="btn btn-primary btn-sm">Subject</a>
                                {{-- <a href="{{url('admin/parent/delete-student/'.$value->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                                {{-- <a href="{{url('admin/parent/assign-student-parent-delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</i></a> --}}

                        </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                </table>
                {{-- <div style="padding: 10px;">
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div> --}}

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
