@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Class & Subject </h1>
           <p style="color: red;"> </p>
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
                <h3 class="card-title">My Class & Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Class Name</th>
                      <th>Subject Name</th>
                      <th>Subject Type</th>
                      <th>Created Date</th>
                    </tr>
                  </thead>
                  @php($i = 1)
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                         <td>{{$i++}}</td>
                        <td>{{$value->class_name}}</td>
                        <td>{{$value->subject_name}}</td>
                        <td>{{$value->subject_type}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>

                    </tr>
                    @endforeach

                  </tbody>
                </table>
                <div style="padding: 10px;">
                {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
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
