@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent List (Total : {{$getRecord->total()}})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{url('admin/parent/add-parent')}}" class="btn btn-primary">Add New Parent</a>
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
                <h3 class="card-title">Search Parent</h3>
              </div>
            <form method="get" action="">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" placeholder="Name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name" placeholder="last_name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Phone</label>
                    <input type="text" class="form-control" value="{{Request::get('mobile_number')}}" name="mobile_number" placeholder="Phone Number">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                            <option value="">Select Gender</option>
                            <option {{ (Request::get('gender') == 'Male') ? 'selected': ''}} value="Male">Male</option>
                            <option {{ (Request::get('gender') == 'Female') ? 'selected': ''}} value="Female">Female</option>
                            <option {{ (Request::get('gender') == 'Others') ? 'selected': ''}} value="Others">Others</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label>occupation</label>
                    <input type="text" class="form-control" value="{{Request::get('occupation')}}" name="occupation" placeholder="occupation">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Address</label>
                    <input type="text" class="form-control" value="{{Request::get('address')}}" name="address" placeholder="address">
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
                    <label>Email address</label>
                    <input type="text" class="form-control" value="{{Request::get('email')}}" name="email" placeholder="Enter email">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Created Date</label>
                    <input type="date" class="form-control" value="{{Request::get('date')}}" name="date" placeholder="Enter email">
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{url('admin/parent/list')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a  >
                  </div>
                </div>
            </div>
            </form>
            </div>



            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Parent List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Profile Pic</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Occupation</th>
                      <th>Address</th>
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
                        <td>{{$value->name}} {{$value->last_name}} </td>
                        <td>{{$value->email}}</td>
                          <td>{{$value->gender}}</td>
                            <td>{{$value->mobile_number}}</td>
                             <td>{{$value->occupation}}</td>
                              <td>{{$value->address}}</td>
                          <td> {{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                        <td class=>

                                {{-- <a href="{{url('admin/student/view-student/'.$value->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a> --}}
                                <a href="{{url('admin/parent/edit-parent/'.$value->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></a>
                                <a href="{{url('admin/parent/delete-parent/'.$value->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                 <a href="{{url('admin/parent/my-student/'.$value->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-users"></i></a>

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
