@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Homework</h1>
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

                   <div class="form-group">
                    <label>Class</label><span style="color: red">*</span>
                    <select class="form-control" id="getClass" name="class_id" required>
                        <option value="">Select Class</option>
                            @foreach ($getClass as $class )
                            <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                            @endforeach
                    </select>
                      <span style="color: red">{{$errors->first('class_id')}}</span>
                  </div>

                  <div class="form-group">
                    <label>Subject</label><span style="color: red">*</span>
                    <select class="form-control" name="subject_id" id="getSubject" required>
                        <option value="">Select Subject</Select>
                    </select>
                      <span style="color: red">{{$errors->first('subject_id')}}</span>
                  </div>

                  <div class="form-group">
                    <label>Homework Date</label><span style="color: red">*</span>
                    <input type="date" class="form-control" value="{{old('homework_date')}}" name="homework_date" required>
                      <span style="color: red">{{$errors->first('homework_date')}}</span>
                  </div>

                  <div class="form-group">
                    <label>submission Date</label><span style="color: red">*</span>
                    <input type="date" class="form-control" value="{{old('submission_date')}}" name="submission_date" required>
                      <span style="color: red">{{$errors->first('submission_date')}}</span>
                  </div>

                   <div class="form-group">
                    <label>Document</label>
                    <input type="file" class="form-control"  name="document_file">
                      <span style="color: red">{{$errors->first('document_file')}}</span>
                  </div>

                   <div class="form-group">
                    <label>Description</label><span style="color: red">*</span>
                    <textarea id="compose-textarea"  name="description" class="form-control" style="height: 300px" required> </textarea>
                    <span style="color: red">{{$errors->first('description')}}</span>
                  </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create Homework</button>
                </div>
              </form>
            </div>


          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



@endsection

@section('script')

<script src="{{url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>


<script type="text/javascript">
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
        height: 200,
    });

    $('#getClass').change(function(){
        var class_id = $(this).val();
        $.ajax({
            type:"POST",
            url: "{{url('teacher/ajax_get_subject')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                class_id: class_id,
            },
            dataType : "json",
            success: function(data){
                $('#getSubject').html(data.success);

            }
        });

    });


  });
</script>


@endsection
