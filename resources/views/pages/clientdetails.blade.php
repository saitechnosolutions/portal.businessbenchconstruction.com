@extends('layout.app')
@section('title','Clients')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="section-heading">Clients Details</h4>
                        </div>

                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">



                                @if($client = App\Models\twoestimate::where('clientid',$id)->first())
                                    {{-- {{ $client->estid }} --}}
                                @if ($getstages = App\Models\Stage::where('estid',$client->estid)->get()->count())
                                    {{-- {{ $getstages }} --}}
                                @endif
                                @if ($completedcount = App\Models\Stage::where('estid',$client->estid)->where('completed_status','1')->get()->count())
                                    {{-- {{ $completedcount }} --}}
                                    <h4 class="text-center"><b>Works Completed</b></h4>
                                        <div class="progress mt-3 mb-4" style="height: 30px;">
                                    <div class="progress-bar bg-success progress-bar-animated progress-bar-striped" role="progressbar" style="width: {{ number_format($completedcount/$getstages*100,1) }}%;" aria-valuenow="{{ number_format($completedcount/$getstages*100,1) }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($completedcount/$getstages*100,1) }}%</div>
                                  </div>

                                @endif
                                @endif


                        </div>
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="row">

                                        <div class="col-lg-4">
                                            <a href="/drawingdetails/{{ $id }}">
                                                <div class="clientdetailsbox" @if(Auth::user()->usertype == '4') data-title="Drawings" data-intro="This is your project drawings. Open the section View the drawing and approve" @endif>
                                                    <div class="clientcontent">
                                                        <div class="clienticons">

                                                            {{-- <i class="fa fa-map" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/diagram.svg" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Drawings</h5>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4">
                                            <a href="/estimateview/{{ $id }}">
                                                <div class="clientdetailsbox" @if(Auth::user()->usertype == '4') data-title="Estimate" data-intro="This is your project Estimate. Open the section View the estimate and approve " @endif>
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/estimates.svg" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Estimates</h5>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                        @if (Auth::user()->usertype == '3')
                                        <div class="col-lg-4">
                                            {{-- <a href="/dia"> --}}
                                                <div class="clientdetailsbox client_edit" data-id="{{ $id }}" data-bs-toggle="modal" data-bs-target="#editCLients">
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-pencil" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/modifications.svg" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Modification</h5>
                                                    </div>

                                                </div>
                                            {{-- </a> --}}
                                        </div>
                                        @endif

                                        <div class="col-lg-4">
                                            <a href="/paymentdetails/{{ $id }}">
                                                <div class="clientdetailsbox" @if(Auth::user()->usertype == '4') data-title="Payment History" data-intro="This is your project Payment History. Open the section View the Project History" @endif>
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-money" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/receipt.png" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Payments History</h5>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4">
                                            <a href="/workcompletedetails/{{ $id }}">
                                                <div class="clientdetailsbox" @if(Auth::user()->usertype == '4') data-title="Completion of works" data-intro="This is your project Works. Open the section View the Project works & approve the images" @endif>
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-building" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/workcompletion.svg" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Completion Of Work</h5>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                        @if(Auth::user()->usertype == '8' || Auth::user()->usertype == '15')
                                        <div class="col-lg-4">
                                            <a href="/checklist/{{ $id }}">
                                                <div class="clientdetailsbox">
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-building" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/workcompletion.svg" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Checklist</h5>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                        <div class="col-lg-4">
                                            <a href="/processofworks/{{ $clientview->engineercode }}/{{ $id }}">
                                                <div class="clientdetailsbox" @if(Auth::user()->usertype == '4') data-title="Process of works" data-intro="This is your Process of works. Open the section View the Project Work images" @endif>
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-building" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/workcompletion.svg" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Process of Works</h5>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-lg-4">
                                            <a href="/paymentcreation/{{ $clientview->engineercode }}/{{ $id }}">
                                                <div class="clientdetailsbox " @if(Auth::user()->usertype == '4')  data-title="Payments" data-intro="This is your Payments. Open the section pay the amount" @endif>
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-pencil" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/modifications.svg" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">Payments</h5>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addClientsdata" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <h5>Personal Information</h5> --}}



                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 100%" id="name">
                                            <span class="error-text name_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Project Start Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="startdate" style="width: 100%" id="startdate">
                                            <span class="error-text password_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Expected End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate">
                                            <span class="error-text password_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Address</label><span class="text-danger">*</span><br>
                                            <textarea class="form-control" name="address" id="address"></textarea>
                                            <span class="error-text email_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="text" name="phnumber" id="phnumber" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="text" name="emailid" id="emailid" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Project Estimated Value</label><span class="text-danger">*</span><br>
                                            <input type="text" name="estimatedvalue" class="form-control" style="width:100%" id="estimatedvalue">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Google Map Location</label><span class="text-danger">*</span><br>
                                            <input type="text" name="maplocation" class="form-control" style="width:100%" id="plotarea">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Engineer Code</label><span class="text-danger">*</span><br>
                                            <input type="text" name="engineercode" id="engineercode" class="form-control" style="width:100%" value="{{ Auth::user()->userid }}" readonly>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Type Of Services</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="services" id="services">
                                                <option>-- Select Services --</option>
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
                                            <select class="form-control" name="package" id="services">
                                                <option>-- Package --</option>
                                                <option value="1">Basic</option>
                                                <option value="2">Standard</option>
                                                <option value="3">Premium</option>

                                            </select>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Region</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="dealershipregion" id="dealershipregion">
                                                <option>-- Select Region --</option>
                                                @foreach ($district as $dis)
                                                    <option value="{{ $dis->district_code }}">{{ $dis->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Area</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="dealershiparea" id="dealershiparea">
                                                <option>-- Select Areas --</option>

                                            </select>
                                            {{-- <input type="text" name="mblnumber" class="form-control" style="width:100%"> --}}
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Plot Area</label><span class="text-danger">*</span><br>
                                            <input type="text" name="plotarea" class="form-control" style="width:100%" id="plotarea">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Construction Area</label><span class="text-danger">*</span><br>
                                            <input type="text" name="constructionarea" class="form-control" style="width:100%" id="plotarea">
                                            <span class="error-text role_error"></span>
                                        </div>



                                    </div>

                                </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save </button>
            </div>
        </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editCLients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Client Creation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ajax-load"><img src="/assets/images/loading-buffering.gif"></div>
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addClientsdata" action="/update_users" enctype="multipart/form-data" method="post">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <h5>Personal Information</h5> --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <input type="hidden" value="" name="edit_client_id" class="edit_client_id">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 100%" id="name">
                                            <span class="error-text name_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Project Start Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="startdate" style="width: 100%" id="startdate">
                                            <span class="error-text password_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Expected End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate">
                                            <span class="error-text password_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Address</label><span class="text-danger">*</span><br>
                                            <textarea class="form-control" name="address" id="address"></textarea>
                                            <span class="error-text email_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="text" name="phnumber" id="phnumber" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="text" name="emailid" id="emailid" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Project Estimated Value</label><span class="text-danger">*</span><br>
                                            <input type="text" name="estimatedvalue" class="form-control" style="width:100%" id="estimatedvalue">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Google Map Location</label><span class="text-danger">*</span><br>
                                            <input type="text" name="maplocation" class="form-control" style="width:100%" id="plotarea">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Engineer Code</label><span class="text-danger">*</span><br>
                                            <input type="text" name="engineercode" id="engineercode" class="form-control" style="width:100%" value="{{ Auth::user()->userid }}">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Type Of Services</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="services" id="services">
                                                <option>-- Select Services --</option>
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
                                            <select class="form-control" name="package" id="services">
                                                <option>-- Package --</option>
                                                <option value="1">Basic</option>
                                                <option value="2">Standard</option>
                                                <option value="3">Premium</option>

                                            </select>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Region</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="dealershipregion" id="dealershipregion">
                                                <option>-- Select Region --</option>
                                                @foreach ($district as $district)
                                                    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Area</label><span class="text-danger">*</span><br>
                                            <select class="form-control shiparea" name="dealershiparea" id="dealershiparea">
                                                <option>-- Select Areas --</option>

                                            </select>
                                            {{-- <input type="text" name="mblnumber" class="form-control" style="width:100%"> --}}
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Plot Area</label><span class="text-danger">*</span><br>
                                            <input type="text" name="plotarea" class="form-control" style="width:100%" id="plotarea">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Construction Area</label><span class="text-danger">*</span><br>
                                            <input type="text" name="constructionarea" class="form-control" style="width:100%" id="plotarea">
                                            <span class="error-text role_error"></span>
                                        </div>



                                    </div>

                                </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save </button>
            </div>
        </form>
          </div>
    </div>
      </div>
@endsection
