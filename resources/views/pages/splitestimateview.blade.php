@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="section-heading">Split Estimate </h4>

                        </div>
                        {{-- AE Raise Payment --}}
                        {{-- {{ $getestimatedetails }} --}}
                        {{-- @if(Auth::user()->usertype == '3')
                            <div class="col-lg-2">
                            @if($raisebutton = App\Models\Payment::where('estimateid',$estid)->where('stageid',$stage)->first())
                                <button class="btn btn-success raisebutton" data-estid="{{ $estid }}" data-stageid="{{ $stage }}" data-amount="{{ $totamt }}" data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>Already Payment Raised</button>
                                @else
                                <button class="btn btn-success raisebutton" data-estid="{{ $estid }}" data-stageid="{{ $stage }}" data-amount="{{ $totamt }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Raise Payment</button>
                            @endif

                            </div>
                        @endif --}}

                        {{-- Client Pay Amount --}}
                        {{-- @if(Auth::user()->usertype == '3')
                            <div class="col-lg-2">
                            @if($raisebutton = App\Models\Payment::where('estimateid',$estid)->where('stageid',$stage)->first())
                                @if($raisebutton->payment_status == '2')
                                    <button class="btn btn-success paymentapprove" data-estid="{{ $estid }}" data-stageid="{{ $stage }}" data-amount="{{ $totamt }}" >Approve Status</button>
                                    @else
                                    <button class="btn btn-success paynowbtn" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estid="{{ $estid }}" data-stageid="{{ $stage }}" data-amount="{{ $totamt }}" disabled>Approve Status</button>
                                @endif
                            @endif

                        </div>
                        @endif --}}


                            {{-- @if(Auth::user()->usertype == '4')
                            <div class="col-lg-2">
                                 @if($raisebutton = App\Models\Payment::where('estimateid',$estid)->where('stageid',$stage)->first())
                                @if($raisebutton->payment_status == '0')
                                    <button class="btn btn-success paynowbtn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-clientid="{{$raisebutton->clientid}}" data-estid="{{ $estid }}" data-stageid="{{ $stage }}" data-amount="{{ $totamt }}">Pay Amount</button>
                                    @else
                                    <button class="btn btn-success paynowbtn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-clientid="{{$raisebutton->clientid}}" data-estid="{{ $estid }}" data-stageid="{{ $stage }}" data-amount="{{ $totamt }}" disabled>Pay Amount</button>
                                @endif
                            @endif
                            </div>
                            @endif --}}



                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if($raisebutton = App\Models\Payment::where('estimateid',$estid)->where('stageid',$stage)->first())
                        @if($raisebutton->payment_status == '1')
                        <div class="alert alert-success" role="alert">
                            Payment Approved
                        </div>
                        @endif
                        @if($raisebutton->payment_status == '0')
                        <div class="alert alert-danger" role="alert">
                            Payment Raised
                        </div>
                        @endif
                        @if($raisebutton->payment_status == '2')
                        <div class="alert alert-warning" role="alert">
                            Amount Paid
                        </div>
                        @endif

                        @else
                        <div class="alert alert-danger" role="alert">
                            Payment Pending
                        </div>
                    @endif

                </div>
                <div class="col-lg-12">
                    <div class="card p-3" >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Description Of Works</th>
                                @if(Auth::user()->usertype != '4')
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
                                @endif

                                <th>Amount</th>
                                {{-- @if(Auth::user()->usertype != '4')
                                <th>5% Rentention Amount</th>
                                @else
                                @endif --}}

                                {{-- @if(Auth::user()->usertype != '4')
                                    <th>Balance Amount</th>
                                    @else
                                @endif --}}

                                @if(Auth::user()->usertype != '4')
                                    <th>% Work Completed</th>
                                    @else
                                @endif


                            </tr>
                        </thead>
                        <tbody>
                            @if($getestimatedetails)
                                @php $i=1; @endphp
                                @foreach ($getestimatedetails as $mailestimate)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>{{ $mailestimate->descriptions }}</td>
                                        @if(Auth::user()->usertype != '4')
                                            <td>{{ $mailestimate->qty }}</td>
                                            <td>{{ $mailestimate->unit }}</td>
                                            <td>{{ number_format($mailestimate->rate,2) }}</td>
                                            @else
                                        @endif

                                        <td>{{ number_format($mailestimate->amt,2) }}</td>
                                        @if(Auth::user()->usertype != '4')
                                        {{-- <td>{{ number_format($mailestimate->rentation_amt,2) }}</td> --}}
                                        {{-- <td>{{ number_format($mailestimate->balance_amt,2) }}</td> --}}
                                        <td>{{ number_format($mailestimate->balance_amt/$totamt*100,1) }}</td>
                                        @else
                                        @endif

                                    </tr>
                                @endforeach
                                {{-- @if(Auth::user()->usertype != '4')
                                    <tr>
                                    <td colspan="5">Total Amount</td>
                                    <td>
                                        {{ $totamt }}
                                    </td>
                                    <td>
                                        {{ $rentationamt }}
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
                                @endif --}}

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
                    <label>Stage ID</label>
                    <input type="text" class="form-control" id="payetageid" name="payetageid" readonly>
                </div>
                <div class="form-group mt-3">
                    <label>Stage Amount</label>
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
                <div class="form-group mt-3">
                    <label>Stage ID</label>
                    <input type="text" class="form-control mt-2" id="payetageid1" name="payetageid">
                </div>
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
            <input type="hidden" class="form-control mt-2" id="clientid" name="clientid">

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
