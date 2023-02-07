@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="section-heading">AE Additional Estimate </h4>

                        </div>
                        {{-- AE Raise Payment --}}
                        {{-- {{ $getestimatedetails }} --}}


                        {{-- Client Pay Amount --}}







                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card p-3" >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Description Of Works</th>
                                {{-- @if(Auth::user()->usertype != '4')
                                    <th>Quantity</th>
                                    @else
                                @endif
                                @if(Auth::user()->usertype != '4')
                                    <th>Unit</th>
                                    @else
                                @endif
                                @if(Auth::user()->usertype != '4')
                                <th>Rate</th>
                                    @else
                                @endif --}}

                                <th>Amount</th>







                            </tr>
                        </thead>
                        <tbody>
                            @if($getestimatedetails)

                                @php $i=1; @endphp
                                @foreach ($getestimatedetails as $mailestimate)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>{{ $mailestimate->description }}</td>
                                        {{-- @if(Auth::user()->usertype != '4')
                                            <td>{{ $mailestimate->qty }}</td>
                                            <td>{{ $mailestimate->unit }}</td>
                                            <td>{{ number_format($mailestimate->rate,2) }}</td>
                                            @else
                                        @endif --}}

                                        <td>{{ number_format($mailestimate->amount,2) }}</td>
                                        @if(Auth::user()->usertype != '4')



                                        @else
                                        @endif

                                    </tr>
                                @endforeach
                                @if(Auth::user()->usertype != '4')
                                    <tr>
                                    <td colspan="2">Total Amount</td>
                                    <td>
                                        {{ $totamt }}
                                    </td>


                                </tr>
                                @endif
                                @if(Auth::user()->usertype == '4')
                                    <tr>
                                    <td colspan="2">Total Amount</td>
                                    <td>
                                        {{ $totamt }}
                                    </td>


                                </tr>
                                @endif

                            @endif
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="raisepayment" id="raisepayment" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Payment Raise</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Estimate ID</label>
                    <input type="text" class="form-control" id="payestid" name="payestid" readonly>
                </div>

                <div class="form-group mt-3">
                    <label>Stage Amount</label>

                    <input type="hidden" name="esttype" value="Additional">
                    <input type="text" class="form-control" id="payamt" name="payamt" readonly>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Raise Payment</button>
            </div>
          </div>
        </form>
        </div>
      </div>


      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="paymentpaid" id="paymentpaid" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Payment Pay</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Estimate ID</label>
                    <input type="text" class="form-control mt-2" id="payestid1" name="payestid">
                </div>
                <!--<div class="form-group mt-3">-->
                <!--    <label>Stage ID</label>-->
                <!--    <input type="text" class="form-control mt-2" id="payetageid1" name="payetageid">-->
                <!--</div>-->
                <input type="hidden" name="esttype" value="Additional">
                <div class="form-group mt-3">
                    <label>Stage Amount</label>
                    <input type="text" class="form-control mt-2" id="payamt1" name="payamt">
                </div>
                <div class="form-group mt-3">
                    <label>Payment Method</label>
                    <select class="form-control mt-2" name="paymentmenthod" required>
                        <option value="">-- Choose Payment Method --</option>
                        <option value="Cash">Cash</option>
                        <option value="Bank Transaction">Bank Transaction</option>
                        <option value="Cheque">Cheque</option>
                        <option value="UPI Transaction">UPI Transaction</option>
                    </select>
                </div>

                <input type="text" name="clientid" value="{{ Auth::user()->userid }}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Pay Amount</button>
            </div>
          </div>
        </form>
        </div>
      </div>

@endsection
