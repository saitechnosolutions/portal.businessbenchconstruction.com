@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">


                    <table class="table table-bordered">
                        {{-- <h3>Client Estimate</h3> --}}
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
                                {{-- <th class="text-center" style="width:500px">Description of works</th> --}}
                                <th class="text-center" style="width:300px">Actual Amount</th>
                                <th class="text-center" style="width:300px">Payment Status</th>
                                 <th class="text-center" style="width:300px">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if($payments)

                                @php $i=1 @endphp
                                @foreach ($payments as $s)
                                <tr>
                                    <td class="text-center">@php echo $i++; @endphp</td>
                                    <td class="text-left">

                                        {{ $s->stageid }}
                                        @if ($stagemasters = App\Models\stagemaster::where('stageid',$s->stageid)->first())
                                            {{ $stagemasters->stagename }}
                                        @endif
                                        @if($advancepayment = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('approval_status','6')->first())
                                            @if($advancepayment->paymentsno == '1')
                                                + Advance Payment
                                            @endif
                                        @endif


                                    </td>

                                    <td style="text-align: right">
                                       {{ number_format($s->payamount,2) }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">



                {{-- @if(Auth::user()->usertype == '4')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '0')
                                <span class="badge bg-success">AE Raise Payment</span>
                        @endif
                    @endif
                @endif --}}

                {{-- @if(Auth::user()->usertype == '4')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '1')
                                <span class="badge bg-success">Forwarded to QS</span>
                        @endif
                    @endif
                @endif --}}



                {{-- @if(Auth::user()->usertype == '4')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '2')
                                <span class="badge bg-success">Forwarded to GM</span>
                        @endif
                    @endif
                @endif
                @if(Auth::user()->usertype == '4')
                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '3')
                            <span class="badge bg-success">GM Approved</span>
                    @endif
                @endif
            @endif --}}
                {{-- @if(Auth::user()->usertype == '4')

                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '4')
                            <span class="badge bg-success">RM Approved</span>
                    @endif
                @endif
            @endif--}}

            {{-- AE --}}

                @if(Auth::user()->usertype == '3')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '0')
                                <span class="badge bg-success">AE Raise Payment</span>
                        @endif
                        @if($raisebutton->approval_status == '5')
                            <span class="badge bg-info">Waiting</span>
                        @endif
                        @if($raisebutton->approval_status == '6')
                            <span class="badge bg-success">Payment Pending</span>
                        @endif
                        @if($raisebutton->approval_status == '1' )
                        <span class="badge bg-primary">QS Review Completed</span>
                    @endif
                        @if($raisebutton->approval_status == '2' )
                            <span class="badge bg-primary">QS Head Approved</span>
                        @endif
                        @if($raisebutton->approval_status == '3' )
                            <span class="badge bg-primary">Client Amount Paid</span>
                        @endif
                        @if($raisebutton->approval_status == '4' )
                    <span class="badge bg-primary">Approved</span>
                @endif
                    @endif
                @endif

                                    {{-- Client --}}

                @if(Auth::user()->usertype == '4')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '0')
                                <span class="badge bg-success">AE Raise Payment</span>
                        @endif
                        @if($raisebutton->approval_status == '5' || $raisebutton->approval_status == '6')
                            <span class="badge bg-info">Waiting</span>
                        @endif
                        @if($raisebutton->approval_status == '1' )
                        <span class="badge bg-primary">QS Review Completed</span>
                     @endif
                     @if($raisebutton->approval_status == '2' )
                        <span class="badge bg-primary">QS Head Approved</span>
                    @endif
                    @if($raisebutton->approval_status == '3' )
                    <span class="badge bg-primary">Client Amount Paid</span>
                @endif
                @if($raisebutton->approval_status == '4' )
                    <span class="badge bg-primary">Payment Approve AE</span>
                @endif
                    @endif
                @endif

                                    {{-- Region Manager --}}

                @if(Auth::user()->usertype == '8')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '0')
                                <span class="badge bg-success">AE Raise Payment</span>
                        @endif
                        @if($raisebutton->approval_status == '5' || $raisebutton->approval_status == '6')
                            <span class="badge bg-info">Waiting</span>
                        @endif
                        @if($raisebutton->approval_status == '1' )
                        <span class="badge bg-primary">QS Review Completed</span>
                    @endif
                    @if($raisebutton->approval_status == '2' )
                        <span class="badge bg-primary">QS Head Approved</span>
                    @endif
                    @if($raisebutton->approval_status == '3' )
                    <span class="badge bg-primary">Client Amount Paid</span>
                @endif
                @if($raisebutton->approval_status == '4' )
                    <span class="badge bg-primary">Payment Approve AE</span>
                @endif
                    @endif
                @endif

                {{-- Quantity Surveyor --}}
                @if(Auth::user()->usertype == '7')

                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())

                    @if($raisebutton->approval_status == '0')
                            <span class="badge bg-success">AE Raise Payment</span>
                    @endif
                    @if($raisebutton->approval_status == '5' || $raisebutton->approval_status == '6')
                        <span class="badge bg-info">Waiting</span>
                    @endif

                    @if($raisebutton->approval_status == '1' )
                        <span class="badge bg-primary">QS Review Completed</span>
                    @endif
                    @if($raisebutton->approval_status == '2' )
                        <span class="badge bg-primary">QS Head Approved</span>
                    @endif
                    @if($raisebutton->approval_status == '3' )
                        <span class="badge bg-primary">Client Amount Paid</span>
                    @endif
                    @if($raisebutton->approval_status == '4' )
                    <span class="badge bg-primary">Payment Approve AE</span>
                @endif

                @endif
            @endif

            {{-- Quantity Surveyor Head --}}

            @if(Auth::user()->usertype == '13')

                 @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())

                    @if($raisebutton->approval_status == '0')
                            <span class="badge bg-success">AE Raise Payment</span>
                    @endif
                    @if($raisebutton->approval_status == '5' || $raisebutton->approval_status == '6')
                        <span class="badge bg-info">Waiting</span>
                    @endif

                    @if($raisebutton->approval_status == '1' )
                        <span class="badge bg-primary">QS Review Completed</span>
                    @endif

                    @if($raisebutton->approval_status == '2' )
                        <span class="badge bg-primary">QS Head Approved</span>
                    @endif
                    @if($raisebutton->approval_status == '3' )
                        <span class="badge bg-primary">Client Amount Paid</span>
                    @endif
                    @if($raisebutton->approval_status == '4' )
                    <span class="badge bg-primary">Payment Approve AE</span>
                @endif
                 @endif
            @endif

                {{-- @if(Auth::user()->usertype == '3')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '1')
                                <span class="badge bg-success">Forwarded to QS</span>
                        @endif
                    @endif
                @endif

                @if(Auth::user()->usertype == '3')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '2')
                                <span class="badge bg-success">Forwarded to GM</span>
                        @endif
                    @endif
                @endif --}}

                {{-- @if(Auth::user()->usertype == '3')
                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '3')
                                <span class="badge bg-success">GM Approved</span>
                        @endif
                    @endif
                @endif


                @if(Auth::user()->usertype == '3')
                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '4')
                            <span class="badge bg-success">RM Approved</span>
                    @endif
                @endif
            @endif --}}

                {{-- @if(Auth::user()->usertype == '11')
                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '2')
                                <span class="badge bg-success">Verified QS</span>
                        @endif
                    @endif
                @endif

                @if(Auth::user()->usertype == '11')
                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '3')
                                <span class="badge bg-success">GM Approved</span>
                        @endif
                    @endif
                @endif --}}

                {{-- @if(Auth::user()->usertype == '11')
                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '4')
                            <span class="badge bg-success">RM Approved</span>
                    @endif
                @endif
            @endif --}}

                {{-- @if(Auth::user()->usertype == '7')

                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '1')
                            <span class="badge bg-success">Received Payment</span>
                    @endif
                @endif
            @endif --}}

            {{-- @if(Auth::user()->usertype == '7')

                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '2')
                            <span class="badge bg-success">Forwarded to GM</span>
                    @endif
                @endif
            @endif --}}

            {{-- @if(Auth::user()->usertype == '7')
                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '3')
                                <span class="badge bg-success">GM Approved</span>
                        @endif
                    @endif
                @endif --}}

                {{-- @if(Auth::user()->usertype == '7')
                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '4')
                            <span class="badge bg-success">RM Approved</span>
                    @endif
                @endif
            @endif --}}

                {{-- @if(Auth::user()->usertype == '8')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '1')
                                <span class="badge bg-success">Forwarded to QS</span>
                        @endif

                    @endif
                @endif --}}

                {{-- @if(Auth::user()->usertype == '8')

                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '2')
                                <span class="badge bg-success">Forwarded to GM</span>
                        @endif
                    @endif
                @endif --}}
                {{-- @if(Auth::user()->usertype == '8')
                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                        @if($raisebutton->approval_status == '3')
                                <span class="badge bg-success">GM Approved</span>
                        @endif
                    @endif
                @endif --}}

                {{-- @if(Auth::user()->usertype == '8')
                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                    @if($raisebutton->approval_status == '4')
                            <span class="badge bg-success">RM Approved</span>
                    @endif
                @endif
            @endif --}}
                                    </td>
                                    <td class="text-center">

                                        {{-- AE --}}

                                        @if(Auth::user()->usertype == '3')

                                            @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                                                @if($raisebutton->approval_status == '6')
                                                    <button class="btn btn-success raisebutton w-100" data-estimateid="{{ $s->estimateid }}" data-amount="{{ $s->payamount }}" data-stageid="{{ $s->stageid }}" data-esttype="{{ $s->esttype }}" data-id="{{ $s->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Raise Payment</button>
                                                @endif
                                                @if($raisebutton->approval_status == '5')
                                                    <button class="btn btn-warning w-100" >Waiting for payment</button>
                                                @endif
                                                @if($raisebutton->approval_status == '0')
                                                    <button class="btn btn-success w-100" >Payment Raised</button>
                                                @endif
                                                @if($raisebutton->approval_status == '1')
                                                    <button class="btn btn-success w-100" >QS Review Completed</button>
                                                @endif
                                            @if($raisebutton->approval_status == '2')
                                        <button class="btn btn-success w-100" >QS Head Approved</button>
                                    @endif
                                    @if($raisebutton->approval_status == '3')
                                        <button class="btn btn-success w-100 approvepaybtn" data-esttype={{ $s->esttype }} data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-id="{{ $s->id }}" >Approve Payment</button>
                                    @endif
                                    @if($raisebutton->approval_status == '4')
                                    <button class="btn btn-success w-100" >Payment Approve AE</button>
                                @endif


                                            @endif
                                        @endif

                                        {{-- CLient --}}
                                        @if(Auth::user()->usertype == '4')

                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '6')
                                                    <button class="btn btn-warning  w-100" data-estimateid="{{ $s->estimateid }}" data-amount="{{ $s->payamount }}" data-stageid="{{ $s->stageid }}" data-id="{{ $s->id }}" >Waiting for payment</button>
                                                @endif
                                            @if($raisebutton->approval_status == '0')
                                                <button class="btn btn-success  w-100" data-estimateid="{{ $s->estimateid }}" data-amount="{{ $s->payamount }}" data-stageid="{{ $s->stageid }}" data-id="{{ $s->id }}" >AE Payment Raised</button>
                                            @endif
                                            @if($raisebutton->approval_status == '5')
                                                <button class="btn btn-warning w-100" >Waiting for payment</button>
                                            @endif
                                            @if($raisebutton->approval_status == '1')
                                                <button class="btn btn-success w-100" >QS Review Completed</button>
                                            @endif
                                            @if($raisebutton->approval_status == '2')
                                                <button class="btn btn-success w-100 paynowbtn" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-id="{{ $s->id }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $s->payamount }}">Pay Amount</button>
                                            @endif
                                            @if($raisebutton->approval_status == '3')
                                                <button class="btn btn-success w-100" >Amount paid</button>
                                            @endif
                                            @if($raisebutton->approval_status == '4')
                                    <button class="btn btn-success w-100" >Payment Approve AE</button>
                                @endif

                                        @endif
                                    @endif

                                    {{-- Region Manager --}}

                                    @if(Auth::user()->usertype == '8')

                                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '0')
                                            <button class="btn btn-success  w-100" data-estimateid="{{ $s->estimateid }}" data-amount="{{ $s->payamount }}" data-stageid="{{ $s->stageid }}" data-id="{{ $s->id }}" >AE Payment Raised</button>
                                        @endif
                                        @if($raisebutton->approval_status == '5')
                                            <button class="btn btn-warning w-100" >Waiting for payment</button>
                                        @endif
                                        @if($raisebutton->approval_status == '1')
                                                <button class="btn btn-success w-100" >QS Review Completed</button>
                                            @endif
                                            @if($raisebutton->approval_status == '2')
                                            <button class="btn btn-success w-100" >QS Head Approved</button>
                                        @endif
                                        @if($raisebutton->approval_status == '3')
                                        <button class="btn btn-success w-100" >Client Amount paid</button>
                                    @endif
                                    @if($raisebutton->approval_status == '4')
                                    <button class="btn btn-success w-100" >Payment Approve AE</button>
                                @endif

                                    @endif
                                @endif

                                {{-- Quantity Surveyor --}}

                                @if(Auth::user()->usertype == '7')

                                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                                    @if($raisebutton->approval_status == '0')
                                        <button class="btn btn-success w-100 forwardtoqtysurveyor" data-esttype="{{ $s->esttype }}" data-id="{{ $s->id }}" data-estimateid="{{ $s->estimateid }}" data-amount="{{ $s->payamount }}" data-stageid="{{ $s->stageid }}" data-id="{{ $s->id }}" >Forward to QS Head</button>
                                    @endif
                                    @if($raisebutton->approval_status == '5')
                                        <button class="btn btn-warning w-100" >Waiting for payment</button>
                                    @endif
                                    @if($raisebutton->approval_status == '1')
                                        <button class="btn btn-success w-100" >QS Review Completed</button>
                                    @endif
                                    @if($raisebutton->approval_status == '2')
                                        <button class="btn btn-success w-100" >QS Head Approved</button>
                                    @endif
                                    @if($raisebutton->approval_status == '3')
                                        <button class="btn btn-success w-100" >Client Amount paid</button>
                                    @endif
                                    @if($raisebutton->approval_status == '4')
                                    <button class="btn btn-success w-100" >Payment Approve AE</button>
                                @endif
                                @endif
                            @endif

                            {{-- QS HEAD --}}
                            @if(Auth::user()->usertype == '13')

                                @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                                    @if($raisebutton->approval_status == '0')
                                        <button class="btn btn-success w-100 forwardtoqtysurveyorhead" data-id="{{ $s->id }}" data-estimateid="{{ $s->estimateid }}" data-amount="{{ $s->payamount }}" data-stageid="{{ $s->stageid }}" data-id="{{ $s->id }}" >Forward to QS Head</button>
                                    @endif
                                    @if($raisebutton->approval_status == '5')
                                        <button class="btn btn-warning w-100" >Waiting for payment</button>
                                    @endif
                                    @if($raisebutton->approval_status == '1')
                                        <button class="btn btn-success w-100 approveforclient" data-id="{{ $s->id }}" data-estimateid="{{ $s->estimateid }}" data-amount="{{ $s->payamount }}" data-stageid="{{ $s->stageid }}" data-esttype="{{ $s->esttype }}" data-id="{{ $s->id }}">Approve for client</button>
                                    @endif
                                    @if($raisebutton->approval_status == '2')
                                        <button class="btn btn-success w-100" >QS Head Approved</button>
                                    @endif
                                    @if($raisebutton->approval_status == '3')
                                        <button class="btn btn-success w-100" >Client Amount paid</button>
                                    @endif
                                    @if($raisebutton->approval_status == '4')
                                    <button class="btn btn-success w-100" >Payment Approve AE</button>
                                @endif
                                @endif
                            @endif

                                    {{-- @if(Auth::user()->usertype == '3')

                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                            @if($raisebutton->payment_status == '2')
                                                <button class="btn btn-success paymentapprove w-100 mt-2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}"  >Approve Status</button>
                                                @else
                                                <button class="btn btn-success paynowbtn w-100 mt-2" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}"  disabled>Approve Status</button>
                                            @endif
                                        @endif

                                    @endif --}}

                                    {{-- @if(Auth::user()->usertype == '8')
                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '0')
                                            <button class="btn btn-success forwardtoqtysurveyor w-100" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" >Forwarded to QS</button>
                                            @else
                                            <button class="btn btn-success forwardtoqtysurveyor w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Forwarded to QS</button>

                                        @endif
                                        @else

                                    @endif --}}
                                    {{-- @endif
                                    @if(Auth::user()->usertype == '8')
                                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '2' || $raisebutton->approval_status == '1')
                                            <button class="btn btn-success approvepaybtn w-100" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Processing..</button>
                                            @else
                                            <button class="btn btn-success approvepaybtn w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Forwarded to QS</button>
                                        @endif
                                        @endif
                                        @endif --}}
                                    {{-- @if(Auth::user()->usertype == '8')
                                    @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '3')
                                            <button class="btn btn-success approvepaybtn w-100" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" >Approve</button>
                                            @else
                                            <button class="btn btn-success approvepaybtn w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Forwarded to QS</button>
                                        @endif
                                        @endif
                                        @endif
                                        @if(Auth::user()->usertype == '8')
                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                            @if($raisebutton->approval_status == '4')
                                                <button class="btn btn-success approvepaybtn w-100" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Payment Approved</button>
                                                @else
                                                <button class="btn btn-success approvepaybtn w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Forwarded to QS</button>
                                            @endif
                                            @endif
                                            @endif --}}

                                    {{-- @if(Auth::user()->usertype == '7')
                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '1')
                                            <button class="btn btn-success forwardtogm w-100" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" >Forwarded to GM</button>
                                            @else
                                            <button class="btn btn-success forwardtogm w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Forwarded to GM</button>
                                        @endif
                                 @endif
                                    @endif --}}


                                    {{-- @if(Auth::user()->usertype == '4')
                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('id',$s->id)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '4')
                                            @if($raisebutton->payment_status == '0')
                                                <button class="btn btn-success paynowbtn w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" >Pay Now</button>
                                                @elseif($raisebutton->payment_status == '1')
                                                <button class="btn btn-success w-100"data-clientid="{{$raisebutton->clientid}}" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" >Approved</button>
                                                @else
                                                <button class="btn btn-success w-100"  data-clientid="{{$raisebutton->clientid}}"  data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" >Amount Paid</button>
                                            @endif

                                            @else
                                            <button class="btn btn-success paynowbtn w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}"  disabled>Pay Now</button>
                                        @endif
                                    @endif
                                    @endif --}}

                                    {{-- @if(Auth::user()->usertype == '11')
                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                        @if($raisebutton->approval_status == '2')
                                            <button class="btn btn-success approvegm w-100" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" >Approve</button>
                                            @else
                                            <button class="btn btn-success approvegm w-100" data-bs-toggle="modal" data-clientid="{{$raisebutton->clientid}}" data-bs-target="#exampleModal2" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Approve</button>
                                        @endif
                                 @endif
                                    @endif --}}


                                    {{-- @if(Auth::user()->usertype == '8')

                                        @if($raisebutton = App\Models\Payment::where('estimateid',$s->estimateid)->where('stageid',$s->stageid)->first())
                                            @if($raisebutton->approval_status == '4')
                                                <span class="badge bg-info">Waiting for approval</span>
                                                @else
                                                @if($raisebutton->payment_status == '3')
                                                    <button class="btn btn-success paynowbtn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-clientid="{{$raisebutton->clientid}}" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}">AE Raised Payment</button>
                                                    @else
                                                    <button class="btn btn-success paynowbtn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-clientid="{{$raisebutton->clientid}}" data-estimateid="{{ $s->estimateid }}" data-stageid="{{ $s->stageid }}" data-amount="{{ $stagesum }}" disabled>Pay Amount</button>
                                                @endif

                                            @endif
                                            @else
                                            <span class="badge bg-danger text-center">Payment Pending</span>
                                        @endif

                                    @endif --}}

                                    </td>
                                    {{-- <td style="text-align:center">
                                        @if($stagesum = App\Models\Stage::where('stage_num',$s->stageid)->where('estid',$s->estimateid)->sum('amt'))
                                            {{ number_format(($stagesum/$totamt)*100,0) }}%
                                        @endif
                                    </td> --}}
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ Auth::user()->usertype }} --}}
                    {{-- <h3 class="mt-5">AE Estimate</h3> --}}
                        @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '7')

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
                    <input type="text" class="form-control" id="payestimateid" name="payestimateid" readonly>
                </div>
                <div class="form-group mt-3">
                    <label>Stage ID</label>
                    <input type="text" class="form-control" id="payetageid" name="payetageid" readonly>
                </div>
                <div class="form-group mt-3">
                    <label>Stage Amount</label>
                    <input type="text" class="form-control" id="payamt" name="payamt" readonly>
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" name="esttype" id="esttype">
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
                    <input type="text" class="form-control mt-2" id="payestimateid1" name="payestimateid" readonly>
                </div>
                <div class="form-group mt-3">
                    <label>Stage ID</label>
                    <input type="text" class="form-control mt-2" id="payetageid1" name="payetageid" readonly>
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
            <input type="hidden" id="id1" name="id">

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
