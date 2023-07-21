@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Notice Board</h1>
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
                    <label>Title</label>
                    <input type="text" class="form-control" value="{{old('title')}}" name="title" required placeholder="title">
                      <span style="color: red">{{$errors->first('title')}}</span>
                  </div>

                  <div class="form-group">
                    <label>Notice Date</label>
                    <input type="date" class="form-control" value="{{old('notice_date')}}" name="notice_date" required>
                      <span style="color: red">{{$errors->first('notice_date')}}</span>
                  </div>

                  <div class="form-group">
                    <label>Publish Date</label>
                    <input type="date" class="form-control" value="{{old('publish_date')}}" name="publish_date" required>
                      <span style="color: red">{{$errors->first('publish_date')}}</span>
                  </div>

                  <div class="form-group">
                    <label style="display: block;">Message To</label>
                    <label style="margin-right:25px"><input type="checkbox" value="3" name="message_to[]" >Students</label>
                    <label style="margin-right:25px"><input type="checkbox" value="4" name="message_to[]" >Parents</label>
                    <label><input type="checkbox" value="2" name="message_to[]">Teachers</label>
                  </div>


                   <div class="form-group">
                    <label>Message</label>
                    <textarea id="compose-textarea"  name="message" class="form-control" style="height: 300px"> </textarea>
                    <span style="color: red">{{$errors->first('message')}}</span>
                  </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit Message</button>
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

<script src="{{url('public/dist/plugins/summernote/summernote-bs4.min.js')}}"></script>


<script type="text/javascript">
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
        height: 200,

    })
  })
</script>


@endsection
