@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Submit My Homework</h1>
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
                  <button type="submit" class="btn btn-primary">Submit Homework</button>
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


    $('#compose-textarea').summernote({
        height: 200,
    });

  });
</script>


@endsection
