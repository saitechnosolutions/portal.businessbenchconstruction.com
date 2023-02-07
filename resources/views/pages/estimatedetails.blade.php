@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    @if (Auth::user()->usertype == '4')
                        @if($req = App\Models\estimaterequest::where('clientid',Auth::user()->userid)->first())
                                @if($req->admin_status == '2')
                                <div class="alert alert-success" role="alert">
                                    Estimate Approve for Client
                                </div>
                                @endif
                            {{-- <button  class="btn btn-success  " data-userid="{{ Auth::user()->userid }}">Estimate Approved</button> --}}
                            @if($req->admin_status == '4')
                                <button  class="btn btn-success clientapproveestimate " data-userid="{{ Auth::user()->userid }}">Approve Estimate</button>
                                <button  class="btn btn-danger  clientrejectestimate" data-userid="{{ Auth::user()->userid }}">Reject Estimated</button>
                            @endif
                            @if($req->admin_status == '6')
                            <div class="alert alert-danger" role="alert">
                                Estimate Reject for Client
                            </div>
                            @endif

                        @endif

                        {{-- @if($req = App\Models\estimaterequest::where('clientid',Auth::user()->userid)->where('admin_status',4)->first())
                            <button  class="btn btn-danger  clientrejectestimate" data-userid="{{ Auth::user()->userid }}">Reject Estimated</button>
                            @else
                            <button  class="btn btn-danger " data-userid="{{ Auth::user()->userid }}">Estimate Reject</button>
                        @endif --}}



                    @endif
                    @if (Auth::user()->usertype == '13')

                        @if($req = App\Models\estimaterequest::where('clientid',$clientid)->first())
                            @if($req->admin_status == '1' || $req->admin_status == '5')
                                <button class="btn btn-success qsheadapproveestimate m-auto d-block" data-estid="{{ $req->estimate_id }}">Approve Estimate</button>
                            @endif
                            @if($req->admin_status == '3')
                            <div class="alert alert-success" role="alert">
                                Estimate Approved for GM/QS Head
                              </div>
                            @endif
                            @if($req->admin_status == '4')
                            <div class="alert alert-success" role="alert">
                                AE Approve the Estimate
                              </div>
                            @endif
                            @if($req->admin_status == '5')
                            <div class="alert alert-danger" role="alert">
                                AE Approve the Estimate
                              </div>
                            @endif
                            @if($req->admin_status == '6')
                            <div class="alert alert-danger" role="alert">
                                Client Reject the Estimate
                              </div>
                            @endif

                        @endif

                    @endif
                </div>
                <div class="col-lg-12">


                    <table class="table table-bordered">
                        <h3>Client Estimate</h3>
                        <thead >
                            <tr >
                                <th colspan="6" class="text-center">Business Bench Construction Limited</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="text-center">Karur</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="text-center">Civil Works</th>
                            </tr>
                            <tr>
                                <th class="text-center">S.No</th>
                                <th class="text-center" style="width:500px">Stage Wise</th>
                                <th class="text-center" style="width:500px">Description of works</th>
                                <th class="text-center" style="width:300px">Actual Amount</th>
                                {{-- <th class="text-center" style="width:300px">Payment Status</th> --}}
                                 {{-- <th class="text-center" style="width:300px">Action</th> --}}
                                <th class="text-center">% Of Work Complete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($stages)

                                @php $i=1 @endphp
                                @foreach ($stages as $s)
                                <tr>
                                    <td class="text-center">@php echo $i++; @endphp</td>
                                    <td class="text-left">{{ $s->stage_title }}</td>
                                    <td class="text-left">{!! $s->descriptionofworks !!}</td>
                                    <td style="text-align: right">
                                        @if($stagesum = App\Models\Stage::where('stage_num',$s->stage_num)->where('estid',$s->estid)->first())
                                            {{ $stagesum->clientestimateamt }}
                                        @endif
                                    </td>

                                    <td style="text-align:center">
                                        @if($stagesum = App\Models\Stage::where('stage_num',$s->stage_num)->where('estid',$s->estid)->sum('amt'))
                                            {{ number_format(($stagesum/$totamt)*100,0) }}%
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ Auth::user()->usertype }} --}}
                    {{-- <h3 class="mt-5">AE Estimate</h3> --}}
                        @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '7' || Auth::user()->usertype == '13')
                            @if($stages)

                            @foreach ($stages as $s)
                                <h3 class="text-center" style="padding:25px 0px;">{{ $s->stage_title }}</h3>

                                <table class="table-primary table table-bordered" style="border-collapse: collapse">
                                    <thead >
                                        <tr>
                                            <th style="border:0"></th>
                                            <th style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">S.No</th>
                                            <th style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">Description of work</th>
                                            <th style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">Qty</th>
                                            <th style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">Unit</th>

                                            <th style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">Rate</th>
                                            {{-- <th>Per</th> --}}
                                            <th style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($stage = App\Models\Stage::where('stage_num',$s->stage_num)->where('estid',$s->estid)->get())
                                            @php $i=1 @endphp
                                                <tr >
                                                    <td rowspan="100" style="text-align:center;vertical-align: middle;white-space:nowrap;width:100px;position:relative;"><div class="rotatetext">
                                                        {{ $s->stage_title }}
                                                        {{-- How TO - Center Elements Vertically --}}

                                                    </div></td>
                                                </tr>
                                                @foreach ($stage as $st)
                                                    <tr>

                                                        <td style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">@php echo $i++ @endphp</td>
                                                        <td style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">{{ $st->descriptions }}</td>
                                                        <td style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">{{ $st->qty }}</td>
                                                        <td style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">{{ $st->unit }}</td>
                                                        <td style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">{{ $st->rate }}</td>
                                                        <td style="padding:20px 10px;text-align:center;vertical-align:middle" class="text-center">{{ $st->amt }}</td>
                                                    </tr>
                                                @endforeach
                                                @if($stageamt = App\Models\Stage::where('stage_num',$s->stage_num)->where('estid',$s->estid)->sum('amt'))
                                                    <tr>
                                                    <td colspan="5" class="text-center"><b>Total Amount</b></td>
                                                    <td>{{ number_format($stageamt,2) }}</td>
                                                </tr>
                                                @endif
                                                @if($clientestimateamt = App\Models\Stage::where('stage_num',$s->stage_num)->where('estid',$s->estid)->first())
                                                <tr>
                                                    <td colspan="5" class="text-center"><b>Client Estimate Amount</b></td>
                                                    <td>{{ number_format($clientestimateamt->clientestimateamt,2) }}</td>
                                                </tr>
                                            @endif

                                        @endif

                                </tbody>
                                </table>

                            @endforeach
                        @endif
                    @endif






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
                    <input type="text" class="form-control mt-2" id="payamt1" name="payamt" readonly>
                </div>
                <div class="form-group mt-3">
                    <label>Payment Method<span class="text-danger">*</span></label>
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
