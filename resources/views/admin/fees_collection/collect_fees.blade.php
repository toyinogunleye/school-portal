@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Collect Fees </h1>
            {{-- (Total : {{$getRecord->total()}}) --}}
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
                <h3 class="card-title">Search Collect Fees Student </h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">

                  <div class="form-group col-md-2">
                    <label>Class</label>
                    <select class="form-control" name="class_id">
                        <option value="">Select Class</option>
                        @foreach ($getClass as $class )
                        <option {{ (Request::get('class_id') == $class->id ) ? 'selected' : '' }} value="{{ $class->id}}">{{$class->name }}</option>
                        @endforeach
                    </select>
                  </div>

                   <div class="form-group col-md-2">
                    <label>Admission No</label>
                    <input type="text" class="form-control" value="{{Request::get('admission_number')}}" name="admission_number" placeholder="Ender Admission Number">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Student First Name</label>
                    <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" placeholder="Name">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Student Middle Name</label>
                    <input type="text" class="form-control" value="{{Request::get('middle_name')}}" name="middle_name" placeholder="Name">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Student Last Name</label>
                    <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name" placeholder="Name">
                  </div>


                  <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/fees-collection/collect-fees')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
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
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Admission No</th>
                      <th>Student Name</th>
                      <th>Class Name</th>
                      <th>Total School Fees</th>
                      <th>Paid Amount</th>
                      <th>Created Date</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                  @php($i = 1)
                  <tbody>

                    @if(!empty($getRecord))
                        @forelse($getRecord as $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$value->admission_number}}</td>
                                <td>{{$value->name}} {{$value->middle_name}} {{$value->last_name}}</td>
                                <td>{{$value->class_name}}</td>
                                <td>N{{ number_format($value->class_amount, 2) }}</td>
                                <td>N0.00</td>
                                <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>

                                <td>
                                    <a href="{{ url('admin/fees-collection/collect-fees/add-fees/'.$value->id) }}" class="btn btn-success btn-sm" style="margin-bottom:10px;" title="Edit" >Collect Fees </a>
                                    {{-- <a class="btn btn-danger btn-sm" style="margin-bottom:10px;" title="Delete"  href="{{url('admin/class/delete/'.$value->id)}}">Delete </a> --}}
                                </td>

                            <tr>

                        @empty
                            <tr>
                            <td colspan="100%"> Record not found</td>
                            </tr>

                        @endforelse

                    @else
                        <tr>
                            <td colspan="100%"> Record not found</td>
                        </tr>
                    @endif


                  </tbody>
                </table>
                <div style="padding: 10px;">
                    @if(!empty($getRecord))
                         {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                     @endif
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
