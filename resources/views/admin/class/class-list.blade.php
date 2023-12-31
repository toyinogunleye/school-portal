@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class List </h1>
            {{-- (Total : {{$getRecord->total()}}) --}}
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/class/add-class')}}" class="btn btn-primary">Add New Class</a>
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
                <h3 class="card-title">Search Class </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" placeholder="Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" value="{{Request::get('date')}}" name="date" placeholder="Enter email">
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/class/list')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>

            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Class List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      {{-- <th>Id</th> --}}
                      <th>Name</th>
                      <th>School Fees</th>
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
                        {{-- <td>{{$value->id}}</td> --}}
                        <td>{{$value->name}}</td>
                        <td>N{{ number_format($value->amount, 2) }}</td>
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

                            <a class="btn btn-primary btn-sm" style="margin-bottom:10px;" title="Edit" href="{{url('admin/class/edit/'.$value->id)}}" >Edit </a>
                            <a class="btn btn-danger btn-sm" style="margin-bottom:10px;" title="Delete"  href="{{url('admin/class/delete/'.$value->id)}}">Delete </a>

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
