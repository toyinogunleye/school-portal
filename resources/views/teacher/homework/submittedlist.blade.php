@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Submitted Homework</h1>
          </div>
          {{-- <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/homework/create-homework')}}" class="btn btn-primary">Create Homework</a>
          </div> --}}
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
                <h3 class="card-title">Search Submitted Homework </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>First Name</label>
                    <input type="text" class="form-control" value="{{Request::get('first_name')}}" name="first_name" placeholder="Student First Name">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" value="{{Request::get('middle_name')}}" name="middle_name" placeholder="Student Middle Name">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name" placeholder="Student Last Name">
                  </div>


                  <div class="form-group col-md-2">
                    <label>Submit Date From</label>
                    <input type="date" class="form-control" value="{{Request::get('submission_date_from')}}" name="submission_date_from">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Submit Date To</label>
                    <input type="date" class="form-control" value="{{Request::get('submission_date_to')}}" name="submission_date_to">
                  </div>


                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/homework/submitted-homework/'.$homework_id)}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a>
                  </div>
                </div>
            </div>
            </form>
            </div>



            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Submitted Homework List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Student Name</th>
                      <th>Document</th>
                      <th>Description</th>
                      <th>Submitted Date</th>
                    </tr>
                  </thead>
                   @php($i = 1)
                  <tbody>
                    @forelse($getRecord as $value)
                       <td>{{$i++}}</td>
                       <td>{{$value->first_name}} {{$value->middle_name}} {{$value->last_name}}</td>
                        <td>
                            @if(!empty($value->getDocument()))
                                <a href="{{$value->getDocument()}}" class="btn btn-primary" download="">Download</a>
                            @endif
                        </td>
                        <td>{{$value->description}}</td>
                        <td>{{$value->created_at}}</td>

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
