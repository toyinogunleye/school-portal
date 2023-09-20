@extends('layouts.app')

@section('content')

         <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>Fees Payment </h1>

          </div>

          <div class="col-sm-6" style="text-align: right;">
            <button type="button" class="btn btn-primary" id="AddFees">Pay Fees</button>
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
                <h3 class="card-title">Payment Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Class Name</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Balance</th>
                      <th>Payment Type</th>
                      <th>Remarks</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Updated Date</th>
                       {{-- <th>Status</th> --}}
                    </tr>
                  </thead>

                  <tbody>
                    @php
                    $i = 1;
                  @endphp

                    @forelse ($getFees as $value )
                        <tr>
                        <td>{{ $i++ }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>N{{number_format($value->total_amount, 2) }}</td>
                            <td>N{{ number_format($value->paid_amount, 2) }}</td>
                            <td>
                                @if($value->balance > 0)
                                   <span style="color: red"> N{{number_format( $value->balance, 2) }}</span>
                                @else
                                N{{number_format( $value->balance, 2) }}

                                @endif
                            </td>
                            <td>{{ $value->payment_type }}</td>
                            <td>{{ $value->remark }}</td>
                            <td>{{ $value->created_fname }} {{ $value->created_mname }} {{ $value->created_lname }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                            {{-- <td>
                                 @if($value->is_payment == 0)
                                   <span style="color: red"> <b>Pending</b></span>
                                @else
                                 <span style="color: green"> <b>Successful</b></span>

                                @endif
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">Record not found</td>
                        </tr>

                    @endforelse
                  </tbody>
                </table>


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

  <div class="modal fade" id="AddFeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <form action="" method="POST">

        {{ csrf_field() }}


      <div class="modal-body">

        <div class="form-group">
            <label class="col-form-label">Class Name : {{ $getStudent->class_name }} </label>
          </div>

          <div class="form-group">
            <label class="col-form-label">Total Amount : N{{ number_format($getStudent->amount, 2) }} </label>
          </div>

           <div class="form-group">
            <label class="col-form-label">Paid Amount :  N{{ number_format($paid_amount, 2) }}  </label>
          </div>

           <div class="form-group">
            @php
            $balance = $getStudent->amount - $paid_amount;
            @endphp
                <label class="col-form-label">Balance : {{ number_format($balance, 2)}}  </label>
          </div>
          <div class="form-group">
            <label class="col-form-label">Amount  <span style="color: red;">*</span> </label>
            <input type="number" class="form-control" name="amount" required>
          </div>

          <div class="form-group">
            <label class="col-form-label">Payment Type <span style="color: red;">*</span> </label>
            <select class="form-control" name="payment_type" required>
                <option value="">Select</option>
                <option value="Transfer">Transfer</option>
                <option value="Cash">Cash</option>
                <option value="Online-Payment">Online Payment</option>
                <option value="Cheque">Cheque</option>
            </select>
          </div>


          <div class="form-group">
            <label class="col-form-label">Remark:</label>
            <textarea class="form-control" name="remark"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
    $('#AddFees').click(function(){
        $('#AddFeesModal').modal('show');
    });
</script>




@endsection
