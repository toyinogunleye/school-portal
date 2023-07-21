@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notice Board</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/communicate/notice-board/add')}}" class="btn btn-primary">Add New Notice Board</a>
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
                <h3 class="card-title">Search Admin </h3>
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
            </div>



            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Notice Board List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>

                      <th>Title</th>
                      {{-- <th>Message</th> --}}
                      <th>Notice Date</th>
                      <th>Publish Date</th>
                        <th>Message To</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                   @php($i = 1)
                  <tbody>
                    @forelse($getRecord as $value)
                    <tr>
                        <td>{{$i++}}</td>
                        {{-- <td>{{$value->id}}</td> --}}
                        <td>{{$value->title}}</td>
                        {{-- <td>{{$value->message}}</td> --}}
                        <td>{{date('d-m-Y H:i A', strtotime($value->notice_date))}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->publish_date))}}</td>
                        <td>

                        @foreach ($value->getMessage as $message )
                            @if($message->message_to == 2)
                                 <div>Teacher</div>
                            @elseif ($message->message_to == 3)
                                <div>Student</div>
                            @elseif ($message->message_to == 4)
                                <div>Parent</div>
                            @endif
                        @endforeach

                        </td>

                        <td>{{$value->created_by}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                        <td>
                            <a href="{{url('admin/communicate/notice-board/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                             <a href="{{url('admin/communicate/notice-board/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
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
