@extends('layout.app')
@section('title','Estimates')
@section('main-content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if($stage9 = App\Models\Stage::where('stage_num','9')->get())
                @if($stage9->count() != 0)
                <h3 class="text-center" style="padding:25px 0px;">{{ $getestimate->stageninetitle }}</h3>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Description of work</th>
                            <th>Rate</th>
                            <th>Per</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Approval Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                    @foreach ($stage9 as $st9)
                        <tr>
                            <td>@php echo $i++ @endphp</td>
                            <td>{{ $st9->qty }}</td>
                            <td>{{ $st9->unit }}</td>
                            <td>{{ $st9->descriptions }}</td>
                            <td>{{ $st9->rate }}</td>
                            <td>{{ $st9->per }}</td>
                            <td>{{ number_format($st9->amt,2) }}</td>
                            <td>
                                @if($st9->payment_status == 0)
                                <button class="btn btn-danger btn-sm m-auto d-block getestimatepayment" data-id={{ $st9->id }} data-amt={{ $st9->amt }} data-paymenthod="{{ $st9->payment_method }}" data-estid="{{ $st9->estid }}" data-bs-toggle="modal" data-bs-target="#paymentmodal" >Pay</button>
                                    @else
                                    <button class="btn btn-success btn-sm m-auto d-block">Paid</button>

                                @endif
                            </td>
                            <td>
                                @if($st9->approval_status == 0)
                                    <span class="badge  bg-danger m-auto d-block" style="width:100px">Pending</span>
                                    @elseif($st9->approval_status == 1)
                                    <span class="badge  bg-warning m-auto d-block" style="width:100px">Processing</span>
                                    @else
                                    <span class="badge  bg-success m-auto d-block" style="width:100px">Approved</span>

                                @endif
                            </td>

                        </tr>
                    @endforeach

                </tbody>
                </table>
                @endif

            @endif
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="paymentmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation Of Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <h5 class="text-center mb-4">Estimation Details</h5>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="text-center" style="color:#8EC641">Estimate ID</p>
                        <h6 class="text-center" id="estmateid"></h6>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-center" style="color:#8EC641">Payment Method</p>
                        <h6 class="text-center" id="paymentmd"></h6>
                    </div>
                </div>
                <div class="col-lg-12 mt-4 mb-3">
                    <p class="text-center">Amount Details</p>
                    <h5 class="text-center" id="totamt" style="color:#8EC641"></h5>
                </div>
                <input type="hidden" id="payid">
                <button class="btn btn-success btn-block stagepay m-auto d-block " style="width:150px">Pay</button>
            </div>
          {{-- <button class="stagepay btn btn-success stagepay" data-id="{{ $st1->id }}">Pay</button> --}}
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection
