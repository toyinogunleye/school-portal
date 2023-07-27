@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css')}}">
<style type="text/css">
    .select2-container .select2-selection--single
    {
        height: 40px;
    }
</style>
{{-- <link rel="stylesheet" href="{{ url('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}
@endsection

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Send Email</h1>
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
            @include('_message')

              <form method="post" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" value="{{old('subject')}}" name="subject" required placeholder="Type Subject">
                      <span style="color: red">{{$errors->first('subject')}}</span>
                  </div>


                <div class="form-group">
                  <label>Users (Student / Parent / Teacher)</label>
                  <select name="user_id" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                  </select>
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
                  <button type="submit" class="btn btn-primary">Send Email</button>
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

<script src="{{url('public/plugins/select2/js/select2.full.min.js')}}"></script>


<script type="text/javascript">
  $(function () {

    $('.select2').select2({
        ajax: {
            url: '{{ url('admin/communicate/search_user') }}',
            dataType: 'json',
            delay: 250,
            data: function(data){
                return {
                    search: data.term,
                };
            },
            processResults: function(response){
                return {
                    results:response
                };
            },
        }
    });


    //Add text editor
    $('#compose-textarea').summernote({
        height: 200,

    })
  })
</script>


@endsection
