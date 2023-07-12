@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Teacher</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->

              <form method="post" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>First Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('name')}}" name="name" required placeholder="Enter First Name">
                             <div style="color: red">{{$errors->first('name')}}</div>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Midlle Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('middle_name')}}" name="middle_name" required placeholder="Enter Middle Name">
                             <div style="color: red">{{$errors->first('middle_name')}}</div>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Last Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" required placeholder="Enter Surname">
                             <div style="color: red">{{$errors->first('last_name')}}</div>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Phone Number <span style="color: red">*</span></label>
                            <input type="number" class="form-control" value="{{old('mobile_number')}}" name="mobile_number" placeholder="Enter Phone Number">
                             <div style="color: red">{{$errors->first('mobile_number')}}</div>
                        </div>
                         <div class="form-group col-sm-4">
                            <label>Guarantor's Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('guarantor_name')}}" name="guarantor_name" required placeholder="FirstName, Surname">
                             <div style="color: red">{{$errors->first('guarantor_name')}}</div>
                        </div>
                         <div class="form-group col-sm-4">
                            <label>Guarantor's Number <span style="color: red">*</span></label>
                            <input type="number" class="form-control" value="{{old('guarantor_number"')}}" name="guarantor_number" required placeholder="Enter Guarantor Number">
                             <div style="color: red">{{$errors->first('guarantor_number"')}}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>Date of Birth <span style="color: red">*</span></label>
                            <input type="date" class="form-control" value="{{old('date_of_birth')}}" name="date_of_birth" required>
                            <div style="color: red">{{$errors->first('date_of_birth')}}</div>
                        </div>

                         <div class="form-group col-sm-4">
                            <label>Gender <span style="color: red">*</span></label>
                            <select class="form-control" required name="gender">
                                <option value="">Select Gender</option>
                                <option {{(old('gender')=='Male')? 'selected': ''}} value="Male">Male</option>
                                <option {{(old('gender')=='Female')? 'selected': ''}} value="Female">Female</option>
                                <option {{(old('gender')=='Others')? 'selected': ''}} value="Others">Others</option>
                            </select>
                             <div style="color: red">{{$errors->first('gender')}}</div>
                        </div>

                         <div class="form-group col-sm-4">
                            <label>Marital Status <span style="color: red">*</span></label>
                            <select class="form-control" required name="marital_status">
                                <option value="">Select Marital Status</option>
                                <option {{(old('marital_status')=='Single')? 'selected': ''}} value="Single">Single</option>
                                <option {{(old('marital_status')=='Married')? 'selected': ''}} value="Married">Married</option>
                                <option {{(old('marital_status')=='Others')? 'selected': ''}} value="Others">Others</option>
                            </select>
                             <div style="color: red">{{$errors->first('Marital_status')}}</div>
                        </div>


                          <div class="form-group col-sm-4">
                            <label>Religion <span style="color: red">*</span></label>
                            <select class="form-control" required name="religion">
                                <option value="">Select Religion</option>
                                <option {{(old('religion')=='Christianity')? 'selected': ''}}  value="Christianity">Christianity</option>
                                <option {{(old('religion')=='Islam')? 'selected': ''}}  value="Islam">Islam</option>
                                <option {{(old('religion')=='Others')? 'selected': ''}}  value="Others">Others</option>
                            </select>
                             <div style="color: red">{{$errors->first('religion')}}</div>
                        </div>

                         <div class="form-group col-sm-4">
                            <label>Current Address <span style="color: red">*</span></label>
                            {{-- <textarea class="form-control" value="{{old('caste')}}" name="caste" placeholder="Enter Caste" ></textarea> --}}
                            <input type="text" class="form-control" value="{{old('address')}}" name="address" required placeholder="Enter Address">
                            <div style="color: red">{{$errors->first('address')}}</div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Permanent Address <span style="color: red">*</span></label>
                            {{-- <textarea class="form-control" value="{{old('caste')}}" name="caste" placeholder="Enter Caste" ></textarea> --}}
                            <input type="text" class="form-control" value="{{old('permanent_address')}}" name="permanent_address" required placeholder="Enter Permanent Address">
                            <div style="color: red">{{$errors->first('permanent_address')}}</div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="form-group col-sm-4">
                            <label>Country <span style="color: red">*</span></label>
                            <input type="nationality" class="form-control" value="{{old('nationality')}}" name="nationality" required placeholder="Enter Country">
                             <div style="color: red">{{$errors->first('nationality')}}</div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>State<span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('state_of_origin')}}" name="state_of_origin" required placeholder="State">
                             <div style="color: red">{{$errors->first('state_of_origin')}}</div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>City <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('city')}}" name="city" required placeholder="Enter City">
                             <div style="color: red">{{$errors->first('city')}}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>Qualification <span style="color: red">*</span></label>
                            <select class="form-control" required name="qualification">
                                <option value="">Select Qualification</option>
                                <option {{(old('qualification')=='SSCE')? 'selected': ''}} value="SSCE">SSCE</option>
                                <option {{(old('qualification')=='NCE')? 'selected': ''}} value="NCE">NCE</option>
                                <option {{(old('qualification')=='Diploma')? 'selected': ''}} value="Diploma">Diploma</option>
                                <option {{(old('qualification')=='Degree')? 'selected': ''}} value="Degree">Degree</option>
                                <option {{(old('qualification')=='Masters')? 'selected': ''}} value="Masters">Masters</option>
                                <option {{(old('qualification')=='Doctorate')? 'selected': ''}} value="Doctorate">Doctorate</option>
                                <option {{(old('qualification')=='Others')? 'selected': ''}} value="Others">Others</option>
                            </select>
                             <div style="color: red">{{$errors->first('gender')}}</div>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Work Experience <span style="color: red">*</span></label>
                            {{-- <textarea class="form-control" value="{{old('caste')}}" name="caste" placeholder="Enter Caste" ></textarea> --}}
                            <input type="text" class="form-control" value="{{old('work_experience ')}}" name="work_experience" required placeholder="Year of Work Experience">
                            <div style="color: red">{{$errors->first('work_experience')}}</div>
                        </div>
                         <div class="form-group col-sm-4">
                            <label>Employment Date <span style="color: red">*</span></label>
                            <input type="date" class="form-control" value="{{old('employment_date')}}" name="employment_date" required>
                            <div style="color: red">{{$errors->first('employment_date')}}</div>
                        </div>
                    </div>



                      <div class="row">
                         <div class="form-group col-sm-4">
                            <label>Note <span style="color: red"></span></label>
                            {{-- <textarea class="form-control" value="{{old('caste')}}" name="caste" placeholder="Enter Caste" ></textarea> --}}
                            <input type="text" class="form-control" value="{{old('note')}}" name="note" placeholder="note">
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Profile Picture <span style="color: red">*</span></label>
                            <input type="file" class="form-control" name="profile_pic">
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Status<span style="color: red">*</span></label>
                            <select class="form-control" required name="status">
                                <option value="">Select Status</option>
                                <option {{(old('status')== 0)? 'selected': ''}} value="0">Active</option>
                                <option {{(old('status')== 1)? 'selected': ''}} value="1">Inactive</option>
                            </select>
                             <div style="color: red">{{$errors->first('status')}}</div>
                        </div>
                      </div>

                      <hr>

                      <div class="row">
                        <div class="form-group col-sm-6">
                              <label>Email <span style="color: red">*</span></label>
                              <input type="email" class="form-control" value="{{old('email')}}" name="email" required placeholder="Enter Email">
                              <div style="color: red">{{$errors->first('email')}}</div>
                          </div>

                          <div class="form-group col-sm-6">
                              <label>Password <span style="color: red">*</span></label>
                              <input type="text" class="form-control" value="{{old('password')}}" name="password" required placeholder="Enter Password">
                          </div>
                        </div>
                      </div>
                </div>


            </div>


        </div>
                <!-- /.card-body -->

            <div class="card-footer ">
                <button type="submit" class="btn btn-primary col-12">Submit</button>
            </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- general form elements -->

            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



@endsection
