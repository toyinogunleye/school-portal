@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class Subject List </h1>
            {{-- (Total : {{$getRecord->total()}}) --}}
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/class-subject/add')}}" class="btn btn-primary">Add Subject to Class</a>
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
                  <div class="form-group col-md-3">
                    <label>Class Name</label>
                    <input type="text" class="form-control" value="{{Request::get('class_name')}}" name="class_name" placeholder="Class Name">
                  </div>


                  <div class="form-group col-md-3">
                    <label>Subject Name</label>
                    <input type="text" class="form-control" value="{{Request::get('subject_name')}}" name="subject_name" placeholder="Subject Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" value="{{Request::get('date')}}" name="date" placeholder="Enter email">
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/class-subject/list')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>

            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Class Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Id</th>
                      <th>Class Name</th>
                      <th>Subject Name</th>
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
                         <td>{{$value->subject_name}}</td>
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
                            <a class="btn btn-info btn-sm" title="Edit" href="{{url('admin/class-subject/edit/'.$value->id)}}" ><i class="fas fa-pencil-alt"></i>Edit All </a>
                            <a class="btn btn-primary btn-sm" title="Edit" href="{{url('admin/class-subject/edit-single/'.$value->id)}}" ><i class="fas fa-pencil-alt"></i> Edit Single</a>
                            <a class="btn btn-danger btn-sm" title="Delete"  href="{{url('admin/class-subject/delete/'.$value->id)}}"><i class="fas fa-trash"> </i> Delete </a>

                            {{-- <a href="{{url('admin/admin/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                             <a href="{{url('admin/admin/delete/'.$value->id)}}" class="btn btn-danger">Delete</a> --}}
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
