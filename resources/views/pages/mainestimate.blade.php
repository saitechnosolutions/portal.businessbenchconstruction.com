@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    @if(Auth::user()->usertype == '3')
                    @if($req = App\Models\estimaterequest::where('estimate_id',$estid)->first())
                            @if($req->admin_status == '3')
                                <button class="btn btn-success aeapproveestimate " data-estid="{{ $req->estimate_id }}">Approve Estimate</button>
                            @endif
                            @if($req->admin_status == '2')
                            <div class="alert alert-success" role="alert">
                                Client Approved the estimate
                              </div>
                            @endif
                            @if($req->admin_status == '4')
                            <div class="alert alert-success" role="alert">
                                AE Approved the estimate
                              </div>
                            @endif
                            @if($req->admin_status == '5')
                            <div class="alert alert-danger" role="alert">
                                AE Reject the estimate
                              </div>
                            @endif
                            @if($req->admin_status == '3')
                                <button class="btn btn-danger aerejectmainestimate " data-estid="{{ $req->estimate_id }}">Reject Estimate</button>
                            @endif
                        @if($req->admin_status == '6')
                            <button class="btn btn-success aeapproveestimate " data-estid="{{ $req->estimate_id }}">Approve Estimate</button>
                            <div class="alert alert-danger mt-3" role="alert">
                                Client Reject the estimate
                              </div>
                        @endif

                        @endif
                    @endif
        </div>
                <div class="col-lg-12">
                        <h4 class="section-heading">AE Estimate</h4>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3" >
                        @if($stages)

                        @foreach ($stages as $s)
                        <div class="card" style="padding:0 25px;margin:20px 0px">


                            <h3 class="text-center" style="padding:25px 0px;">{{ $s->stage_title }}</h3>

                            <table class="table-primary table table-bordered" style="border-collapse: collapse">
                                <thead >
                                    <tr>
                                        <th style="border:0;padding:20px 10px"></th>
                                        <th style="padding:20px 10px;text-align:center;vertical-align:middle">S.No</th>
                                        <th style="padding:20px 10px;text-align:center;vertical-align:middle">Description of work</th>
                                        <th style="padding:20px 10px;text-align:center;vertical-align:middle">Qty</th>
                                        <th style="padding:20px 10px;text-align:center;vertical-align:middle">Unit</th>

                                        <th style="padding:20px 10px;text-align:center;vertical-align:middle">Rate</th>
                                        {{-- <th>Per</th> --}}
                                        <th style="padding:20px 10px;text-align:center;vertical-align:middle">Actual Amount</th>
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

                                                    <td style="padding:20px 10px;text-align:center;vertical-align:middle">@php echo $i++ @endphp</td>
                                                    <td style="padding:20px 10px;text-align:center;vertical-align:middle">{{ $st->descriptions }}</td>
                                                    <td style="padding:20px 10px;text-align:center;vertical-align:middle">{{ $st->qty }}</td>
                                                    <td style="padding:20px 10px;text-align:center;vertical-align:middle">{{ $st->unit }}</td>
                                                    <td style="padding:20px 10px;text-align:center;vertical-align:middle">{{ number_format($st->rate,2) }}</td>
                                                    <td style="padding:20px 10px;text-align:center;vertical-align:middle">{{ number_format($st->amt,2) }}</td>
                                                </tr>
                                            @endforeach
                                            @if($stageamt = App\Models\Stage::where('stage_num',$s->stage_num)->where('estid',$s->estid)->sum('amt'))
                                                <tr>
                                                <td colspan="5" class="text-center"><b>Total Amount</b></td>
                                                <td class="text-center">{{ number_format($stageamt,2) }}</td>
                                            </tr>
                                            @endif
                                            @if($clientestimateamt = App\Models\Stage::where('stage_num',$s->stage_num)->where('estid',$s->estid)->first())
                                            <tr>
                                                <td colspan="5" class="text-center"><b>Client Estimate Amount</b></td>
                                                <td class="text-center">{{ number_format($clientestimateamt->clientestimateamt,2) }}</td>
                                            </tr>
                                        @endif

                                    @endif

                            </tbody>
                            </table>
                        </div>
                        @endforeach
                    @endif

                </div>
                </div>
            </div>
        </div>
    </section>
@endsection
