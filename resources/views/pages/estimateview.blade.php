@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    {{-- @if($estimaterequests == '')
                    <div class="alert alert-primary mb-5" role="alert">
                        Request Not Send
                      </div>

                      @else
                        @if($estimaterequests->admin_status == 3)
                            <div class="alert alert-primary mb-5" role="alert">
                                Estimated Created
                            </div>
                            @elseif($estimaterequests->admin_status == 2)
                            <div class="alert alert-primary mb-5" role="alert">
                                Client Approved the estimate
                            </div>
                            @else
                            <div class="alert alert-primary mb-5" role="alert">
                                Request Send
                            </div>
                        @endif
                    @endif --}}
                    <div class="row">

                        <div class="col-lg-6">
                            <h4 class="section-heading">Estimates</h4>
                        </div>
                        <div class="col-lg-3">
                            @if(Auth::user()->usertype == 3)
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createadditionalest">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Additional Estimate
                              </button>
                            @endif
                        </div>


                        <div class="col-lg-3">
                            @if($estimaterequests == '')
                                @if(Auth::user()->usertype == '3')

                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#estimatereq">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimate Request
                              </button>
                                @endif

                              @else
                               @if(Auth::user()->usertype != '4' || Auth::user()->usertype != '8')
                                 <button type="button" class="btn btn-primary w-100" disabled data-bs-toggle="modal" data-bs-target="#estimatereq">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimate Request
                              </button>
                               @endif

                            @endif

                              {{-- <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createLead">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Estimate
                              </button> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        @if(Auth::user()->usertype != '4' )
                            <div class="col-lg-4">
                            @if($estimaterequests == '')
                                <div class="clientdetailsbox nodata">
                                    <div class="clientcontent">
                                        <div class="clienticons">
                                            {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                            <img src="/assets/images/estimates.svg" class="img-fluid">
                                        </div>
                                        <h5 class="text-center mt-3">AE Estimates</h5>
                                    </div>

                                </div>
                                @else
                                @if($estimaterequests->estimate_id == null)
                                <div class="clientdetailsbox nodata">
                                    <div class="clientcontent">
                                        <div class="clienticons">
                                            {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                            <img src="/assets/images/estimates.svg" class="img-fluid">
                                        </div>
                                        <h5 class="text-center mt-3">AE Estimates</h5>
                                    </div>

                                </div>
                                    @else
                                {{-- {{ $estimaterequests->admin_status }} --}}
                                @if ($estimaterequests->admin_status == 3 || $estimaterequests->admin_status == 4 || $estimaterequests->admin_status == 2)
                                    <a href="/mainestimateview/{{ $estimaterequests->estimate_id }}">
                                        <div class="clientdetailsbox">
                                            <div class="clientcontent">
                                                <div class="clienticons">
                                                    {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                                    <img src="/assets/images/estimates.svg" class="img-fluid">
                                                </div>
                                                <h5 class="text-center mt-3">AE Estimates</h5>
                                            </div>

                                        </div>
                                    </a>
                                    @else
                                    <div class="clientdetailsbox nodata">
                                        <div class="clientcontent">
                                            <div class="clienticons">
                                                {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                                <img src="/assets/images/estimates.svg" class="img-fluid">
                                            </div>
                                            <h5 class="text-center mt-3">AE Estimates</h5>
                                        </div>

                                    </div>

                                @endif

                                @endif

                            @endif


                        </div>
                        <div class="col-lg-4">
                            @if($estimaterequests == '')
                                <div class="clientdetailsbox nodata">
                                    <div class="clientcontent">
                                        <div class="clienticons">
                                            {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                            <img src="/assets/images/estimates.svg" class="img-fluid">
                                        </div>
                                        <h5 class="text-center mt-3">Client Estimates</h5>
                                    </div>

                                </div>
                                @else
                                @if($estimaterequests->estimate_id == null)
                                <div class="clientdetailsbox nodata">
                                    <div class="clientcontent">
                                        <div class="clienticons">
                                            {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                            <img src="/assets/images/estimates.svg" class="img-fluid">
                                        </div>
                                        <h5 class="text-center mt-3">Client Estimates</h5>
                                    </div>

                                </div>
                                    @else
                                    {{-- @dd($estimaterequests); --}}
                                    @if ($estimaterequests->admin_status == 3 || $estimaterequests->admin_status == 4 || $estimaterequests->admin_status == 2)
                                    <a href="/estimatedetails/{{ $estimaterequests->engineerid }}/{{ $estimaterequests->clientid }}">
                                        <div class="clientdetailsbox">
                                            <div class="clientcontent">
                                                <div class="clienticons">
                                                    {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                                    <img src="/assets/images/estimates.svg" class="img-fluid">
                                                </div>
                                                <h5 class="text-center mt-3">Client Estimates</h5>
                                            </div>

                                        </div>
                                    </a>
                                    @else
                                    <div class="clientdetailsbox nodata">
                                        <div class="clientcontent">
                                            <div class="clienticons">
                                                {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                                <img src="/assets/images/estimates.svg" class="img-fluid">
                                            </div>
                                            <h5 class="text-center mt-3">Client Estimates</h5>
                                        </div>

                                    </div>
                                    @endif

                                @endif

                            @endif

                        </div>
                        @else
                            <div class="col-lg-4">
                            @if($estimaterequests == '')
                                <div class="clientdetailsbox nodata">
                                    <div class="clientcontent">
                                        <div class="clienticons">
                                            {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                            <img src="/assets/images/estimates.svg" class="img-fluid">
                                        </div>
                                        <h5 class="text-center mt-3">Client Estimates</h5>
                                    </div>

                                </div>
                                @else
                                @if($estimaterequests->estimate_id == null)
                                <div class="clientdetailsbox nodata">
                                    <div class="clientcontent">
                                        <div class="clienticons">
                                            {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                            <img src="/assets/images/estimates.svg" class="img-fluid">
                                        </div>
                                        <h5 class="text-center mt-3">Client Estimates</h5>
                                    </div>

                                </div>
                                    @else
                                    @if ($estimaterequests->admin_status == 4 || $estimaterequests->admin_status == 2)
                                    <a href="/estimatedetails/{{ $estimaterequests->engineerid }}/{{ $estimaterequests->clientid }}">
                                        <div class="clientdetailsbox" data-title="View the Estimate" data-intro="View the estimate and approve" >
                                            <div class="clientcontent">
                                                <div class="clienticons">
                                                    {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                                    <img src="/assets/images/estimates.svg" class="img-fluid">
                                                </div>
                                                <h5 class="text-center mt-3">Client Estimates</h5>
                                            </div>

                                        </div>
                                    </a>
                                    @else
                                    <div class="clientdetailsbox nodata">
                                        <div class="clientcontent">
                                            <div class="clienticons">
                                                {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                                <img src="/assets/images/estimates.svg" class="img-fluid">
                                            </div>
                                            <h5 class="text-center mt-3">Client Estimates</h5>
                                        </div>
                                    </div>
                                    @endif

                                @endif

                            @endif

                        </div>
                        @endif

                    </div>


                </div>

                </div>
            </div>


        </div>
        <div class="container-fluid mt-3">
            <div class="col-lg-9">
                <h4 class="section-heading">Split Estimate</h4>
            </div>
            <div class="row">

                @if ($estimaterequests == '')
                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @elseif($estimaterequests->estimate_id == null)
                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @else
                    @if(Auth::user()->usertype == '3')
                    @if ($estimaterequests->admin_status == 4 || $estimaterequests->admin_status == 2 || $estimaterequests->admin_status == 3)
                    <div class="col-lg-4">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @if ($stages = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->groupBy('stage_num')->get())
                            @php $i=1; @endphp
                                @foreach ($stages as $splitestimate)
                                    <button class="nav-link " id="v-pills-{{ $splitestimate->stage_num }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $splitestimate->stage_num }}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        Stage @php echo $i++ @endphp -
                                        @if($stagetitle = App\Models\stagemaster::where('stageid',$splitestimate->stage_num)->first())
                                            {{ $stagetitle->stagename }}
                                        @endif
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="tab-content" id="v-pills-tabContent">

                                @if ($estimaterequests == '')
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @elseif($estimaterequests->estimate_id == null)
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @else
                                    @if ($stage = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->groupBy('stage_num')->get())

                                            @foreach ($stage as $s)

                                            <div class="tab-pane fade show " id="v-pills-{{ $s->stage_num }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <a href="/splitestimateview/{{ $estimaterequests->estimate_id }}/{{ $s->stage_num }}">
                                                    <div class="clientdetailsbox">
                                                        <div class="clientcontent">
                                                            <div class="clienticons">
                                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                <img src="/assets/images/estimates.svg" class="img-fluid">
                                                            </div>
                                                            <h5 class="text-center mt-3">Split Estimate</h5>
                                                        </div>

                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach

                                    @endif
                                @endif
                            </div>
                    </div>
                        @else
                        <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @endif
                    @endif
                    @if(Auth::user()->usertype == '4')
                    @if ($estimaterequests->admin_status == 4 || $estimaterequests->admin_status == 2)
                    <div class="col-lg-4">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @if ($stages = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->groupBy('stage_num')->get())
                            @php $i=1; @endphp
                                @foreach ($stages as $splitestimate)
                                    <button class="nav-link " id="v-pills-{{ $splitestimate->stage_num }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $splitestimate->stage_num }}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        Stage @php echo $i++ @endphp -
                                        @if($stagetitle = App\Models\stagemaster::where('stageid',$splitestimate->stage_num)->first())
                                            {{ $stagetitle->stagename }}
                                        @endif
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="tab-content" id="v-pills-tabContent">

                                @if ($estimaterequests == '')
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @elseif($estimaterequests->estimate_id == null)
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @else
                                    @if ($stage = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->groupBy('stage_num')->get())

                                            @foreach ($stage as $s)

                                            <div class="tab-pane fade show " id="v-pills-{{ $s->stage_num }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <a href="/splitestimateview/{{ $estimaterequests->estimate_id }}/{{ $s->stage_num }}">
                                                    <div class="clientdetailsbox">
                                                        <div class="clientcontent">
                                                            <div class="clienticons">
                                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                <img src="/assets/images/estimates.svg" class="img-fluid">
                                                            </div>
                                                            <h5 class="text-center mt-3">Split Estimate</h5>
                                                        </div>

                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach

                                    @endif
                                @endif
                            </div>
                    </div>
                        @else
                        <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @endif
                    @endif


                    </div>


                @endif

            </div>

            <div class="container-fluid mt-3">
            <div class="col-lg-9">
                <h4 class="section-heading">Additional Estimates</h4>
            </div>
            <div class="row">
                @if($getadditionalest = App\Models\aeadditionalestimate::where('clientid',$clientid)->groupBy('additionalestid')->get())
                    @foreach($getadditionalest as $additional)
                        <div class="col-lg-4 justify-content-center">
                            @if(Auth::user()->usertype == '3')
                                <a href="/additionalestview/{{$additional->additionalestid}}">
                                    @else
                                    <a >
                            @endif

                         <div class="clientdetailsbox">
                            <div class="clientcontent">
                                <div class="clienticons">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    <img src="/assets/images/estimates.svg" class="img-fluid">
                                </div>
                                <h5 class="text-center mt-3">{{$additional->additionalesttitle}}</h5>
                            </div>
                        </div>
                    </a>
            <button class="btn-sm btn btn-success m-auto d-block">
                @if($additional->approval_status == '1')
                AE Raise Additional Estimate
            @endif
            @if($additional->approval_status == '2')
                QS Providing the quote
            @endif
            @if($additional->approval_status == '3')
                QS Head/GM Approved
            @endif
            @if($additional->approval_status == '4')
                AE Approved Estimate
            @endif
            @if($additional->approval_status == '5')
                Client Approved Estimate
            @endif

            </button>

            @if(Auth::user()->usertype == '3')
                @if($qsestimate = App\Models\additionalestmaster::where('additionalestid',$additional->additionalestid)->get())
                    @if($qsestimate->count() != '0')
                        <a href="/qsadditionalestview/{{ $additional->additionalestid }}" class="btn btn-success btn-sm" style="width:200px;margin:15px auto;display:block">View Estimate</a>
                    @endif
                @endif
            @endif

            @if(Auth::user()->usertype == '4')
                @if($additional->approval_status == '4' || $additional->approval_status == '5' || $additional->approval_status == '6')
                @if($qsestimate = App\Models\additionalestmaster::where('additionalestid',$additional->additionalestid)->get())
                @if($qsestimate->count() != '0')
                    <a href="/qsadditionalestview/{{ $additional->additionalestid }}" class="btn btn-success btn-sm" style="width:200px;margin:15px auto;display:block" data-title="View Additional Estimate" data-intro="View Additional Estimate Accept & Reject">View Estimate</a>
                @endif
            @endif
                @endif

            @endif


                </div>
                    @endforeach

                @endif


            </div>
        </div>
    </section>




      <div class="modal fade" id="estimatereq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="estimaterequest" id="estimaterequest" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Estimate Request</h5>
              <button type="button" class="close" data-bs-toggle="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                    <div class="form-input mt-3">

                        <label for="">Client Code</label><span class="text-danger">*</span><br>
                        {{-- <select class="form-control" name="clientcode" required>
                            <option value="">-- Choose Client Code --</option>

                        </select> --}}
                        <input type="text" name="clientcode" class="form-control" value="{{ $clientid }}" readonly>
                        @if($leadid = App\Models\Client::where("clientcode",$clientid)->first())
                            <input type="hidden" name="leadid" value="{{$leadid->leadid}}">
                        @endif

                    </div>
                    <div class="form-input mt-3">
                        <label for="">Engineer ID</label><span class="text-danger">*</span><br>
                        <input type="text" name="engineercode" style="width: 100%" id="engineercode" value="{{ Auth::user()->userid }}" readonly>
                        <span class="error-text password_error"></span>
                    </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Send Request</button>
            </div>
          </div>
        </form>
        </div>
      </div>

<div class="modal fade" id="createadditionalest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <form name="saveadditionalestimate" id="saveadditionalestimate" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Additional Estimate</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-input mt-3">

                                <label for="">Client Code</label><span class="text-danger">*</span><br>
                                {{-- <select class="form-control" name="clientcode" required>
                                    <option value="">-- Choose Client Code --</option>

                                </select> --}}
                                <input type="text" name="clientcode" class="form-control" value="{{ $clientid }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-input mt-3">
                        <label for="">Engineer ID</label><span class="text-danger">*</span><br>
                        <input type="text" name="engineercode" style="width: 100%" id="engineercode" value="{{ Auth::user()->userid }}" readonly>
                        <span class="error-text password_error"></span>
                    </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input mt-3">
                        <label for="">Additional Estimate Title</label><span class="text-danger">*</span><br>
                        <input type="text" name="additionaltitle" style="width: 100%" required>
                        <span class="error-text password_error"></span>
                    </div>
                        </div>
                        <div class="row mt-5">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            {{-- <th style="width:150px">Qty</th> --}}
                                                                            {{-- <th style="width:150px">Unit</th> --}}
                                                                            <th style="width:500px">Description of Work</th>
                                                                            {{-- <th style="width:200px">Rate</th> --}}
                                                                            {{-- <th style="width:150px">Per</th> --}}
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button" class="btn btn-success stage10add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage10">
                                                                        <tr>
                                                                            {{-- <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenqty[]" id="stagetenqty1" class="qty">
                                                                                </div>
                                                                            </td> --}}
                                                                            {{-- <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenunit[]">
                                                                                </div>
                                                                            </td> --}}
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stagetendesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            {{-- <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenrate[]" class="rate" id="stagetenrate1">
                                                                                </div>
                                                                            </td> --}}
                                                                            {{-- <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenper[]" >
                                                                                </div>
                                                                            </td> --}}
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenamt[]" class="amt" id="stagetenamt1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                            </div>

                                                        </div>

                    </div>



            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
        </div>
      </div>

@endsection
