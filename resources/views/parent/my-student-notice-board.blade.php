@extends('layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>My Student Notice Board</h1>
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
                            <h3 class="card-title">Search Notice Board </h3>
                        </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{Request::get('title')}}" name="title" placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Notice Date From</label>
                                        <input type="date" class="form-control" value="{{Request::get('notice_date_from')}}" name="notice_date_from">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Notice Date To</label>
                                        <input type="date" class="form-control" value="{{Request::get('notice_date_to')}}" name="notice_date_to">
                                    </div>


                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{url('parent/my-student-notice-board')}}" class="btn btn-success" type="submit" style="margin-top: 30px;">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @foreach ($getRecord as $value )
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="mailbox-read-info">
                                    <h5>{{$value->title}}</h5>
                                    <h6 style="font-weight: bold; color:#000; font-size:16px; margin-top:10px"> {{ date('d-m-y h:m:s', strtotime($value->notice_date)) }}</h6>
                                </div>
                                <!-- /.mailbox-read-info -->

                                <!-- /.mailbox-controls -->
                                <div class="mailbox-read-message">{!! $value->message !!} </div>
                                <!-- /.mailbox-read-message -->
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    @endforeach
                    <div class="col-md-12" style="padding: 10px;">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>


</div>

@endsection
