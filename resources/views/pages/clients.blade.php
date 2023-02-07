@extends('layout.app')
@section('title','Clients')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <h4 class="section-heading">Clients List </h4>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">

                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Client ID</th>
                                                    <th>Engineer Code</th>
                                                    <th>Name</th>
                                                    <th>Current Stage</th>
                                                    <th>Payment Stage</th>
                                                    <th>View</th>

                                                    <th>Status</th>
                                                    {{-- <th>Delete</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody id="clientstable">
                                                @if(Auth::user()->usertype == 8)
                                                    @if($getclients = App\Models\Client::where('rmid',Auth::user()->userid)->get())
                                                        @foreach($getclients as $cl)
                                                            <tr>
                                                        <td><a style="cursor:pointer;text-decoration:underline;" class="clientdetails" data-clientview = {{ $cl->clientcode }}>{{ $cl->clientcode }}</a></td>
                                                        <td>{{ $cl->engineercode }}</td>
                                                        <td>{{ $cl->name }}</td>
                                                        <td>
                                                            @if($currentstage = App\Models\Payment::where('clientid',$cl->clientcode)->where('engid',$cl->engineercode)->where('payment_status','1')->orderBy('id', 'DESC')->take(1)->first())

                                                                {{ $currentstage->stageid }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($currentstage1 = App\Models\Payment::where('clientid',$cl->clientcode)->where('engid',$cl->engineercode)->where('payment_status','1')->get()->count())
                                                                {{-- {{ $currentstage1 }} --}}
                                                            @endif
                                                            @if($getestimate = App\Models\twoestimate::where('clientid',$cl->clientcode)->where('engineerid',$cl->engineercode)->groupBy('stage_num')->get()->count())
                                                                {{-- {{ $getestimate }} --}}
                                                                {{ round($currentstage1/$getestimate * 100) }}%
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if($cl->completed_status == 100)
                                                                <a style="pointer-events: none" class="btn btn-info text-white btn-sm" href="clientdetails/{{ $cl->clientcode }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                @else
                                                                @if($cl->clientapprovalstatus == 2)
                                                                    <a class="btn btn-info text-white btn-sm" href="clientdetails/{{ $cl->clientcode }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                    @else
                                                                    <a style="pointer-events: none" class="btn btn-info text-white btn-sm" href="clientdetails/{{ $cl->clientcode }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                @endif

                                                            @endif

                                                        </td>
                                                        <td>
                                                            {{-- <button class="btn btn-secondary btn-sm clientstatuschange" data-clientid="{{ $cl->clientcode }}"><i class="fa fa-pencil" aria-hidden="true"></i></button> --}}

                                                            @if(Auth::user()->usertype=='10' || Auth::user()->usertype=='11')
                                                                    @if($cl->clientapprovalstatus == '1')
                                                                        <span class="clientstatuschange badge bg-primary" style="cursor:pointer" data-clientid="{{ $cl->clientcode }}">Pending</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '2')
                                                                        <span class="badge bg-success clientstatuschange" style="cursor:pointer" data-clientid="{{ $cl->clientcode }}">Approved</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '3')
                                                                        <span class="badge bg-danger clientstatuschange" style="cursor:pointer" data-clientid="{{ $cl->clientcode }}">Rejected</span>
                                                                    @endif
                                                                @else
                                                                    @if($cl->clientapprovalstatus == '1')
                                                                        <span class="badge bg-primary" style="cursor:pointer">Pending</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '2')
                                                                        <span class="badge bg-success" style="cursor:pointer">Approved</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '3')
                                                                        <span class="badge bg-danger" style="cursor:pointer">Rejected</span>
                                                                    @endif
                                                            @endif


                                                        </td>
                                                        {{-- <td>
                                                            <button class="btn btn-danger btn-sm clientdelete" data-engid="{{ $cl->clientcode }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                        </td> --}}
                                                    </tr>
                                                        @endforeach
                                                    @endif
                                                    @else
                                                    @foreach ($getallclient as $cl)
                                                    <tr>
                                                        <td><a style="cursor:pointer;text-decoration:underline;" class="clientdetails" data-clientview = {{ $cl->clientcode }}>{{ $cl->clientcode }}</a></td>
                                                        <td>{{ $cl->engineercode }}</td>
                                                        <td>{{ $cl->name }}</td>
                                                        <td>
                                                            @if($currentstage = App\Models\Payment::where('clientid',$cl->clientcode)->where('engid',$cl->engineercode)->where('payment_status','1')->orderBy('id', 'DESC')->take(1)->first())

                                                                {{ $currentstage->stageid }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($currentstage1 = App\Models\Payment::where('clientid',$cl->clientcode)->where('engid',$cl->engineercode)->where('payment_status','1')->get()->count())
                                                                {{-- {{ $currentstage1 }} --}}
                                                            @endif
                                                            @if($getestimate = App\Models\twoestimate::where('clientid',$cl->clientcode)->where('engineerid',$cl->engineercode)->groupBy('stage_num')->get()->count())
                                                                {{-- {{ $getestimate }} --}}
                                                                {{ round($currentstage1/$getestimate * 100) }}%
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if($cl->completed_status == 100)
                                                                <a style="pointer-events: none" class="btn btn-info text-white btn-sm" href="clientdetails/{{ $cl->clientcode }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                @else
                                                                @if($cl->clientapprovalstatus == 2)
                                                                    <a class="btn btn-info text-white btn-sm" href="clientdetails/{{ $cl->clientcode }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                    @else
                                                                    <a style="pointer-events: none" class="btn btn-info text-white btn-sm" href="clientdetails/{{ $cl->clientcode }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                @endif

                                                            @endif

                                                        </td>
                                                        <td>
                                                            {{-- <button class="btn btn-secondary btn-sm clientstatuschange" data-clientid="{{ $cl->clientcode }}"><i class="fa fa-pencil" aria-hidden="true"></i></button> --}}

                                                            @if(Auth::user()->usertype=='10' || Auth::user()->usertype=='11')
                                                                    @if($cl->clientapprovalstatus == '1')
                                                                        <span class="clientstatuschange badge bg-primary" style="cursor:pointer" data-clientid="{{ $cl->clientcode }}">Pending</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '2')
                                                                        <span class="badge bg-success clientstatuschange" style="cursor:pointer" data-clientid="{{ $cl->clientcode }}">Approved</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '3')
                                                                        <span class="badge bg-danger clientstatuschange" style="cursor:pointer" data-clientid="{{ $cl->clientcode }}">Rejected</span>
                                                                    @endif
                                                                @else
                                                                    @if($cl->clientapprovalstatus == '1')
                                                                        <span class="badge bg-primary" style="cursor:pointer">Pending</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '2')
                                                                        <span class="badge bg-success" style="cursor:pointer">Approved</span>
                                                                    @endif
                                                                    @if($cl->clientapprovalstatus == '3')
                                                                        <span class="badge bg-danger" style="cursor:pointer">Rejected</span>
                                                                    @endif
                                                            @endif


                                                        </td>
                                                        {{-- <td>
                                                            <button class="btn btn-danger btn-sm clientdelete" data-engid="{{ $cl->clientcode }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                                @endif

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    @if(Auth::user()->usertype == '3')
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createCLients">
                        <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Client
                      </button>
                    @endif

                      <div class="clickhereimg mt-3">
                            <img class="img-fluid m-auto d-block" src="assets/images/clickhereimg.png" alt="">
                      </div>
                        <div class="view_card_box engineer_view" style="margin-top:15px">
                        {{-- <div class="img">
                            <img class="clientphoto" src="assets/images/dashboard/modal_img.png" alt="">
                        </div> --}}


                        <span class="code clientcode"></span>
                        <p class="name clientname"></p>
                        <p class="date"><span class="clientstartdate">12-2022</span> - <span class="clientenddate">05-2024</span></p>
                        <p class="address clientaddress">
                            No.5/301,2nd floor, Thirukampuliyur,
                            Bypass, Karur, Tamil Nadu 639002
                        </p>
                        <p class="phone clientphone"><a href="jayascript:;">+91 82156 6520</a></p>
                        <p class="mail"><a href="javascript:;" class="role clientmail">Prakash@Businessbench.in</a></p>
                        {{-- <h3 class="details">Dealership Details</h3> --}}
                        <div class="dealer_details">

                            <div class="inner">
                                <h4>Region</h4>
                                <h6 class="clientregion">Area</h6>
                            </div>
                            <div class="inner">
                                <h4 class="">Area</h4>
                                <h6 class="clientarea">Area</h6>
                            </div>
                        </div>
                        {{-- <h5 class="office_address">
                            Office Address
                        </h5> --}}

                        {{-- <a href="" class="btn btn-primary location viewclientdetails">View Details</a> --}}
                    </div>

                </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="createCLients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Client Creation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ajax-load"><img src="/assets/images/loading-buffering.gif"></div>
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addClientsdata" id="addClientsdata" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <h5>Personal Information</h5> --}}



                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-input mt-3">
                                        <label for="">Lead ID</label><span class="text-danger">*</span><br>
                                        <select class="form-control leadid" name="leadid">
                                            <option value="">-- Choose Leads --</option>
                                            @if($leads)
                                                @foreach ($leads as $l)
                                                    <option value="{{ $l->leadid }}">{{ $l->leadid }} | {{ $l->user_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error-text name_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Name</label><span class="text-danger">*</span><br>
                                        <input type="text" name="name" class="leadname" style="width: 100%" id="name" required>
                                        <span class="error-text name_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Project Start Date</label><span class="text-danger">*</span><br>
                                        <input type="date" class="leadstart" name="startdate" style="width: 100%" id="startdate" required>
                                        <span class="error-text password_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Expected End Date</label><span class="text-danger">*</span><br>
                                        <input type="date" class="leadend" name="enddate" style="width: 100%" id="enddate" required>
                                        <span class="error-text password_error"></span>
                                    </div>

                                    <div class="form-input mt-3">
                                        <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                        <input type="tel" name="phnumber" id="phnumber" class="form-control leadmobile" style="width:100%" required>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">E-mail</label><span class="text-danger">*</span><br>
                                        <input type="email" name="emailid" id="emailid" class="form-control leadmail" style="width:100%" required>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Project Estimated Value</label><span class="text-danger">*</span><br>
                                        <input type="text" name="estimatedvalue" class="form-control leadvalue" style="width:100%" id="estimatedvalue" required>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Address</label><span class="text-danger">*</span><br>
                                        <textarea class="form-control leadaddresss" name="address" id="address" required></textarea>
                                        <span class="error-text email_error"></span>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input mt-3">
                                        <label for="">Engineer Code</label><span class="text-danger">*</span><br>
                                        <input type="text" name="engineercode" id="engineercode" class="form-control" style="width:100%" value="{{ Auth::user()->userid }}" readonly required>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Type Of Services</label><span class="text-danger">*</span><br>
                                        <select class="form-control" name="services" id="services" required>
                                            <option value="">-- Select Services --</option>
                                            <option value="Construction">Construction</option>
                                            <option value="Renovation">Renovation</option>
                                            <option value="Interior & Exterior">Interior & Exterior</option>
                                            <option value="Elevation">Elevation</option>
                                            <option value="Industrial Construction">Industrial Construction</option>
                                        </select>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Choose Package</label><span class="text-danger">*</span><br>
                                        <select class="form-control" name="package" id="services" required>
                                            <option value="">-- Package --</option>
                                            <option value="1">Basic</option>
                                            <option value="2">Standard</option>
                                            <option value="3">Premium</option>
                                            <option value="4">Luxury</option>
                                            <option value="5">Labour</option>

                                        </select>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Region</label><span class="text-danger">*</span><br>
                                        <select class="form-control" name="dealershipregion" id="dealershipregion" required>
                                            <option value="">-- Select Region --</option>
                                            @foreach ($district as $district)
                                                <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Area</label><span class="text-danger">*</span><br>
                                        <select class="form-control" name="dealershiparea" id="dealershiparea" required>
                                            <option value="">-- Select Areas --</option>

                                        </select>
                                        {{-- <input type="text" name="mblnumber" class="form-control" style="width:100%"> --}}
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label for="">Google Map Location</label><span class="text-danger">*</span><br>
                                        <input type="text" name="maplocation" class="form-control maplink" style="width:100%" id="plotarea" required>
                                        <span class="error-text role_error"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-input mt-3">
                                                <label for="">Plot Area</label><span class="text-danger">*</span><br>
                                                <input type="number" name="plotarea" class="form-control leadploat" style="width:100%" id="plotareatext">
                                                <span class="error-text role_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input mt-3">
                                                <label for="">UOM</label><span class="text-danger">*</span><br>
                                                <select class="form-control" name="plotareauom">
                                                    <option value="Sqft" selected>Sqft</option>
                                                    <option value="acres">acres</option>
                                                    <option value="hectares">hectares</option>
                                                    <option value="Sqyd">Sqyd</option>
                                                </select>
                                                <span class="error-text role_error"></span>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- {{ $rmid }} --}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-input mt-3">
                                                <label for="">Construction Area</label><span class="text-danger">*</span><br>
                                                <input type="number" name="constructionarea" class="form-control" style="width:100%" id="constructionarea">
                                                <span class="error-text constructionareaerror"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input mt-3">
                                                <label for="">UOM</label><span class="text-danger">*</span><br>
                                                <select class="form-control" name="plotareauom">
                                                    <option value="Sqft" selected>Sqft</option>
                                                    <option value="acres">acres</option>
                                                    <option value="hectares">hectares</option>
                                                    <option value="Sqyd">Sqyd</option>
                                                </select>
                                                <span class="error-text role_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    @if($rmid)
                                    <input type="hidden" name="rmid" value="{{ $rmid->rmid }}">
                                    @endif


                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary check_client">Save </button>
            </div>
        </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="clientstatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="clientstatus" id="clientapproval" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Client Status</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <label for="">Client Status</label><span class="text-danger">*</span><br> --}}
                            <select class="form-control" name="clientstatus" required>
                                <option value="">-- Select Status --</option>
                                <option value="2">Approve Client</option>
                                <option value="3">Reject Client</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="clientapprovalid" id="clientapprovalid">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Status</button>
            </div>
          </div>
        </form>
        </div>
      </div>
@endsection
