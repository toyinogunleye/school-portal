@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Class Teacher List </h1>
           <p style="color: red;"> (Total : {{$getRecord->total()}})</p>
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/assign-class-teacher/add')}}" class="btn btn-primary">Assign New Class Teacher</a>
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
                <h3 class="card-title">Search Class Subject</h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>Class Name</label>
                    <input type="text" class="form-control" value="{{Request::get('class_name')}}" name="class_name" placeholder="Class Name">
                  </div>


                  <div class="form-group col-md-2">
                    <label>Teacher Name</label>
                    <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" placeholder="First Name">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name" placeholder="Last Name">
                  </div>
                   <div class="form-group col-md-2">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="">Select Status</option>
                            <option {{ (Request::get('status') == '100') ? 'selected': ''}} value="100">Active</option>
                            <option {{ (Request::get('status') == '1') ? 'selected': ''}} value="1">Inactive</option>
                        </select>
                  </div>

                  <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/assign-class-teacher/list')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>

            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Asssign Class Teacher List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Id</th>
                      <th>Class Name</th>
                      <th>Teacher Name</th>
                      <th>Status</th>
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
                        <td>{{$value->id}}</td>
                        <td>{{$value->class_name}}</td>
                         <td>{{$value->teacher_name}} {{$value->teacher_last_name}}</td>
                        <td>
                            @if($value->status == 0)
                            Active
                            @else
                            Inactive
                            @endif
                        </td>
                        <td>{{$value->created_by_name}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                        <td>
                            <a class="btn btn-info btn-sm" title="Edit" href="{{url('admin/assign-class-teacher/edit/'.$value->id)}}" ></i>Edit All </a>
                            <a class="btn btn-primary btn-sm" title="Edit" href="{{url('admin/assign-class-teacher/edit-single/'.$value->id)}}" ></i> Edit Single</a>
                            <a class="btn btn-danger btn-sm" title="Delete"  href="{{url('admin/assign-class-teacher/delete/'.$value->id)}}"> </i> Delete </a>
                        </td>
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
