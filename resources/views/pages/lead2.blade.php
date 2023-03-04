@extends('layout.app')
@section('title','Leads')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-lg-9">
                            <h4 class="section-heading">Leads List</h4>
                        </div>

                        @if(Auth::user()->usertype == '12')
                            <div class="col-lg-3">
                             <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createLead">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Lead
                              </button>
                        </div>
                        @endif

                    </div>
                </div>
                <div class="col-lg-12">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">

                                    {{-- Telecaller Head View --}}

                                    @if(Auth::user()->usertype == '12')
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>LEAD ID</th>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                    <th>Location</th>
                                                    <th>Assignee</th>
                                                    <th>Assigned to</th>
                                                    {{-- <th>View</th>--}}
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="leadsstable">
                                                @if ($leads)
                                                    @foreach ($leads as $lead)
                                                        <tr>
                                                            <td>{{ $lead->leadid }}</td>
                                                            <td>{{ $lead->user_name }}</td>
                                                            <td><a href="tel:{{ $lead->phone_number }}" >{{ $lead->phone_number }}</a></td>
                                                            <td>{{ $lead->email }}</td>
                                                            <td>{{ $lead->location }}</td>
                                                            <td>
                                                                @if($lead->telecaller_assign_id== '0')
                                                                    <span class="badge bg-danger">Not Assigned</span>
                                                                    @else
                                                                @if($telecallername = App\Models\User::where('userid',$lead->telecaller_assign_id)->first())
                                                                {{ $telecallername->userid }} | {{ $telecallername->name }}
                                                                @endif
                                                                    {{-- {{ $lead->telecaller_assign_id }} --}}
                                                                @endif
                                                            </td>
                                                            <td><button class="btn btn-primary text-white assignedto" data-telecaller_assign_id="{{ $lead->telecaller_assign_id }}" data-leadid={{ $lead->leadid }}><i class="fa fa-users" aria-hidden="true"></i></button></td>
                                                            {{-- <td><button class="btn btn-info text-white leadview" data-leadid={{ $lead->leadid }} ><i class="fa fa-eye" aria-hidden="true"></i></button></td> --}}
                                                            {{-- <td><button class="btn btn-primary text-white editlead" data-id="{{$lead->leadid}}" data-bs-toggle="modal" data-bs-target="#editLead"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td> --}}

                                                            <td><button class="btn btn-danger text-white leaddelete" data-leadid="{{ $lead->leadid }}" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                    @endif


                                    {{-- Telecaller View --}}
                                    @if(Auth::user()->usertype == '2' || Auth::user()->usertype == '11' || Auth::user()->usertype == '1')
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>LEAD ID</th>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                    <th>Location</th>
                                                    <th>Assignee</th>
                                     <th>Assigned to</th>
                                                    {{-- <th>View</th> --}}
                                                    {{-- <th>Delete</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody id="leadsstable">
                                                @if ($leads)
                                                    @foreach ($leads as $lead)
                                                        <tr>
                                                            <td>{{ $lead->leadid }}</td>
                                                            <td>{{ $lead->user_name }}</td>
                                                            <td><a href="tel:{{ $lead->phone_number }}" >{{ $lead->phone_number }}</a></td>
                                                            <td>{{ $lead->email }}</td>
                                                            <td>{{ $lead->location }}</td>
                                                            <td>
                                                                @if($lead->ae_assign_id== '0')
                                                                    <span class="badge bg-danger">Not Assigned</span>
                                                                    @else
                                                                    @if($assignee = App\Models\Engineer::where('engineerid',$lead->ae_assign_id)->first())
                                                                    {{ $assignee->engineerid }} | {{ $assignee->name }}
                                                                    {{-- {{ $lead->ae_assign_id }} --}}
                                                                    @endif

                                                                @endif
                                                            </td>
                                                             <td><button class="btn btn-primary text-white assignedtoeng" data-engid="{{ $lead->ae_assign_id }}" data-leadid={{ $lead->leadid }}><i class="fa fa-users" aria-hidden="true"></i></button></td>
                                                            {{-- <td><button class="btn btn-info text-white leadview" data-leadid={{ $lead->leadid }} ><i class="fa fa-eye" aria-hidden="true"></i></button></td> --}}
                                                            {{-- <td><button class="btn btn-primary text-white editlead" data-id="{{$lead->leadid}}" data-bs-toggle="modal" data-bs-target="#editLead"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td> --}}

                                                            {{-- <td><button class="btn btn-danger text-white" ><i class="fa fa-trash" aria-hidden="true"></i></button></td> --}}
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                    @endif


                                    {{-- AE Page View --}}
                                    @if(Auth::user()->usertype == '3')
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>LEAD ID</th>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                    <th>Location</th>
                                                    <th>AE Assign ID</th>
                                                    <th>Requirement Form</th>
                                                    <th>Drawing Request</th>
                                                    <th>Lead Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="leadsstable">
                                                @if ($leads)
                                                    @foreach ($leads as $lead)
                                                        <tr>
                                                            <td>{{ $lead->leadid }}</td>
                                                            <td>{{ $lead->user_name }}</td>
                                                            <td><a href="tel:{{ $lead->phone_number }}" >{{ $lead->phone_number }}</a></td>
                                                            <td>{{ $lead->email }}</td>
                                                            <td>{{ $lead->location }}</td>
                                                            <td>
                                                                @if($lead->ae_assign_id== '0')
                                                                    <span class="badge bg-danger">Not Assigned</span>
                                                                    @else
                                                                    {{ $lead->ae_assign_id }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($requirementid = App\Models\Lead::where('leadid',$lead->leadid)->first())
                                                                    @else
                                                                    <button class="btn btn-primary text-white addrequirement" data-bs-toggle="modal" data-bs-target="#createLead2" data-name="{{ $lead->user_name }}" data-email="{{ $lead->email }}" data-location="{{ $lead->location }}" data-mblnum="{{ $lead->phone_number }}" data-leadid="{{ $lead->leadid }}"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                @endif

                                                                <button class="btn btn-primary text-white editlead" data-id="{{$lead->leadid}}" data-bs-toggle="modal" data-bs-target="#editLead"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                <button class="btn btn-info text-white leadview" data-leadid={{ $lead->leadid }} ><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                            </td>
                                                            <td>
                                                                @if ($dracount = App\Models\Drawing::where('leadid',$lead->leadid)->get())

                                                                        @if($dracount->count() >= 1)

                                                                                <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                            @else
                                                                            <button class="btn btn-info text-white drawrequest" data-leadid={{ $lead->leadid }} data-bs-toggle="modal" data-bs-target="#createDrawings"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                        @endif
                                                                @endif
                                                                @if ($dracount = App\Models\Drawing::where('leadid',$lead->leadid)->first())

                                                                        @if($dracount->officesededimage != null)
                                                                            <a class="btn btn-success" href="images/{{$dracount->officesededimage}}" download><i class="fa fa-download" aria-hidden="true"></i></a>
                                                                            @else

                                                                        @endif


                                                                @endif

                                                                {{-- <button class="btn btn-info text-white" data-leadid={{ $lead->leadid }} ><i class="fa fa-download" aria-hidden="true"></i></button> --}}
                                                            </td>
                                                            <td>
                                                                @if($lead->leadstatus == null)
                                                                    <button class="btn btn-danger text-white leadstatuschange" data-leadid="{{ $lead->leadid }}" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                                                    @else
                                                                    <span class="badge bg-success">Converted</span>
                                                                @endif

                                                            </td>

                                                            {{-- <td><button class="btn btn-danger text-white" ><i class="fa fa-trash" aria-hidden="true"></i></button></td> --}}
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="createLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Lead Creation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addLead" id="addLead" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>Basic Information</h6>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 100%" id="name" required>
                                            <span class="error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="tel" name="phnumber" id="phnumber" class="form-control" style="width:100%" required>
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="email" name="emailid" id="emailid" class="form-control" style="width:100%" required>
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Location</label><span class="text-danger">*</span><br>
                                            <input type="text" name="location" id="location" class="form-control" style="width:100%" required>
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
              <button type="submit" class="btn btn-primary saveengineer">Save </button>
            </div>
        </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="leadview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close lead_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="leadaddress">
                    <p id="leadids"></p>
                    <p id="leadname"></p>
                    <p id="mobilenumber"></p>
                    <p id="leademail"></p>
                    <p id="leadaddress"></p>
                    <a href="" class="btn btn-primary btn-sm" id="leadloc">Find Location</a>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6 mt-3 text-center">
                        <h5 class="sitedetails mb-3">Site Details</h5>
                        <p id="siteaddress"></p>
                    </div>
                    <div class="col-lg-6 mt-3 text-center">
                        <h5 class="plotarea">Plot Area</h5>
                        <p id="plotsqft"></p>
                        {{-- <p>Square Feet</p> --}}
                    </div>
                </div>
                <div class="divider"></div>
                <p class="mt-4" id="basicdetails">Basic Details</p>
                <div class="row mt-5">

                    <div class="col-lg-6">
                        <h5 class="text-center reqtit mb-3">Requirements</h5>
                        <ul id="req">

                        </ul>

                    </div>
                    <div class="col-lg-6">
                        <h5 class="text-center budgettit">Budget</h5>
                        <p class="text-center budgetvalue">₹<span id="budgetvalue"></span></p>
                        <p></p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row mt-5 mb-5">
                    <div class="col-lg-6">
                        <h5 class="text-center reqtit mb-3">Project Duration</h5>
                        <div class="row">
                            <div class="col-lg-6 text-center">
                                <p id="leadstartdate" class="text-center"></p>
                                <p class="text-center"><b>Start Date</b></p>
                            </div>
                            <div class="col-lg-6">
                                <p id="leadenddate" class="text-center"></p>
                                <p class="text-center"><b>End Date</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <h5 class="text-center reqtit mb-3">Members & Age</h5>
                        <ul id="familydetails">

                        </ul>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Lead Edit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ajax-load"><img src="assets/images/loading-buffering.gif"></div>
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addLeadsdata" action="update_lead" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>Basic Information</h6>
                                <div class="row">
                                    {{-- <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Lead ID</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="leadsid">
                                                <option value="">-- Choose Lead --</option>

                                                <option></option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <input type="hidden" value="" name="edit_lead_id" class="edit_lead_id">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 100%" id="name">
                                            <span class="error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="tel" name="phnumber" id="phnumber" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="text" name="emailid" id="emailid" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>

                                    <h6 class="mt-3">Site Information</h6>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">Address</label><span class="text-danger">*</span><br>
                                            <textarea class="form-control" name="address" id="address"></textarea>
                                            <span class="error-text email_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Google Map link</label><span class="text-danger">*</span><br>
                                            <input type="url" name="maplocation" id="maplocation" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Plot Area</label><span class="text-danger">*</span><br>
                                            <input type="number" name="plotarea" id="plotarea" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                     @php
                                                    $today = date("Y-m-d");
                                             @endphp
                                    <h6 class="mt-3">Basic Information</h6>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Start Date</label><span class="text-danger">*</span><br>
                                            <input type="date" min="@php echo $today; @endphp" name="startdate" style="width: 100%" id="startdate">
                                            <span class="error-text date_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate" min="@php echo $today; @endphp">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Budget Value</label><span class="text-danger">*</span><br>
                                            <input type="number" name="budgetvalue" style="width: 100%" id="enddate">
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Payment</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="payment">
                                                <option value="Total Investment">Total Investment</option>
                                                <option value="Loan">Loan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Clients Availability on the site</label><span class="text-danger">*</span><br>
                                            <!--<input type="text" name="availability" style="width: 100%" id="enddate" required>-->
                                            <select class="form-select" name="availability" required>
                                                <option value="">-- Choose Option --</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Occupation</label><br>
                                            <input type="text" name="occupation" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">What kind of style do you prefer</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="qnone">
                                                <option>-- Choose Option --</option>
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                                <option>Option 4</option>
                                            </select>
                                            <span class="error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">How much time do you prefer to spend in the different areas of the house?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qntwo" style="width: 100%" id="enddate">
                                            <span class="error-text "></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">What kind of spaces are more important to you?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnthree" style="width: 100%" id="enddate">
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">
                                                Is there anyone with mobility problem or disability?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnfour" style="width: 100%" id="enddate">
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">Your long term plan about the house</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnfive" style="width: 100%" id="enddate">
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">How private the house should be?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnsix" style="width: 100%" id="enddate">
                                            <span class="error-text "></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 ">
                                        <div class="form-input mt-3">
                                        <label for="">Requirement (No Of Bedroom, Specific Details)</label><span class="text-danger">*</span><br>
                                        <input type="hidden" name="hidden_lead_id" class="hidden_leadid">
                                        <table class="table table-borderless">
                                            <tr>

                                                <td>
                                                    <button type="button" class="btn btn-success editaddreq">Add</button>
                                                </td>
                                            </tr>
                                            <tbody id="editaddreq">

                                            </tbody>
                                        </table>
                                        <span class="error-text name_error"></span>
                                    </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-input mt-3">
                                            <label for="">Family Members</label><span class="text-danger">*</span><br>
                                            <table class="table table-borderless">
                                                <tr>

                                                    <td>
                                                        <button type="button" class="btn btn-success editaddfamily">Add</button>
                                                    </td>
                                                </tr>
                                                <tbody id="editfamilyadd">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary saveengineer">Save </button>
            </div>
        </form>
          </div>
        </div>
      </div>

      @if (Session::get('Success-Lead'))
        <div class="alert alert-success bg-success alert-dismissible fade show float-alert" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            <strong class="text-white">Updated Successfully</strong>
        </div>
    @endif


    <div class="modal fade" id="assignedto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Assigned to</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="assigntelecaller" id="assigntelecaller" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                <div class="form-input mt-3">
                    <input type="hidden" name="leadid" id="leadassign">
                    <label for="">Select Telecaller</label><span class="text-danger">*</span><br>
                    <select class="form-select" name="telecaller" id="telecallerassign">
                        <option value="">-- Select Telecaller --</option>
                        @if($telecaller)
                            @foreach ($telecaller as $tele)
                                <option value="{{ $tele->userid }}">{{ $tele->userid }} | {{ $tele->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span class="error-text "></span>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="assignedtoe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Assigned to</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="assignae" id="assignae" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                <div class="form-input mt-3">
                    <input type="hidden" name="leadid" id="leadassign1">
                    <label for="">Select AE</label><span class="text-danger">*</span><br>
                    <select class="form-select" name="ae" id="assignaeid">
                        <option value="">-- Select AE --</option>
                        @if($ae)
                            @foreach ($ae as $a)
                                <option value="{{ $a->engineerid }}">{{ $a->engineerid }} | {{ $a->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span class="error-text "></span>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="createDrawings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="addDrawings" id="addDrawings" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Drawings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="form-input mt-3">
                    <label for="">LEAD ID</label><span class="text-danger">*</span><br>
                    <input type="text" name="leadid" style="width: 95%" id="leadid2" readonly>
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Engineer ID</label><span class="text-danger">*</span><br>
                    <input type="text" name="engineerid" style="width: 95%" id="engineerid" value="@if(Auth::user()->usertype == '3') {{ Auth::user()->userid }} @else @endif"  readonly>
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Package Type</label><span class="text-danger">*</span><br>
                    <select class="form-select" name="package" required>
                        <option value="">-- Choose Package Type --</option>
                        <!--<option value="Basic">Basic</option>-->
                        <!--<option value="Standard">Standard</option>-->
                        <!--<option value="Premium">Premium</option>-->
                        <option value="Basic">Basic</option>
                                            <option value="Standard">Standard</option>
                                            <option value="Premium">Premium</option>
                                            <option value="Luxury">Luxury</option>
                                            <option value="Labour">Labour</option>
                    </select>
                </div>
                <div class="form-input mt-3">
                    <label for="">Upload Drawing File</label><span class="text-danger">*</span><br>
                    <input type="file" name="drawimage" style="width: 95%" id="drawimage"  required>
                    <span class="error-text name_error"></span>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload</button>
            </div>

          </div>
            </form>
        </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Maximum Count Reached</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Drawing Target Reached
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="Leadstatuschange" id="Leadstatuschange" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Lead Status</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="leadid3" id="leadid3">
                <select class="form-select" name="leadstatus" required>
                    <option value="">-- Choose Lead Status --</option>
                    <option value="1">Converted</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </div>
            </form>
        </div>
      </div>

      <!--<div class="modal fade" id="createLead3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
      <!--  <div class="modal-dialog modal-lg">-->
      <!--    <div class="modal-content">-->
      <!--      <div class="modal-header">-->
      <!--        <h5 class="modal-title" id="exampleModalLabel">Lead Creation</h5>-->
      <!--        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
      <!--      </div>-->
      <!--      <div class="modal-body">-->
      <!--          {{-- <h4 class="section-heading">Create User</h4> --}}-->
      <!--          <form name="addLeadsdata" id="addLeadsdata1" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">-->
      <!--              @csrf-->

      <!--          <div class="container">-->
      <!--              <div class="row">-->
      <!--                  <div class="col-lg-12">-->
      <!--                      <h6>Basic Information</h6>-->
      <!--                          <div class="row">-->
      <!--                              {{-- <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Lead ID</label><span class="text-danger">*</span><br>-->
      <!--                                      <select class="form-control" name="leadsid">-->
      <!--                                          <option value="">-- Choose Lead --</option>-->

      <!--                                          <option></option>-->
      <!--                                      </select>-->
      <!--                                  </div>-->
      <!--                              </div> --}}-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Name</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="name" style="width: 100%" id="name">-->
      <!--                                      <span class="error-text name_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Mobile Number</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="tel" name="phnumber" id="phnumber" class="form-control" style="width:100%">-->
      <!--                                      <span class="error-text role_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">E-mail</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="email" name="emailid" id="emailid" class="form-control" style="width:100%">-->
      <!--                                      <span class="error-text role_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->

      <!--                              <h6 class="mt-3">Site Information</h6>-->
      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Address</label><span class="text-danger">*</span><br>-->
      <!--                                      <textarea class="form-control" name="address" id="address"></textarea>-->
      <!--                                      <span class="error-text email_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Google Map link</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="maplocation" id="maplocation" class="form-control" style="width:100%">-->
      <!--                                      <span class="error-text role_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Plot Area</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="plotarea" id="plotarea" class="form-control" style="width:100%">-->
      <!--                                      <span class="error-text role_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <h6 class="mt-3">Basic Information</h6>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Start Date</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="date" name="startdate" style="width: 100%" id="startdate">-->
      <!--                                      <span class="error-text password_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">End Date</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="date" name="enddate" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text mobilenumber_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Budget Value</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="budgetvalue" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text mobilenumber_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Payment</label><span class="text-danger">*</span><br>-->
      <!--                                      <select class="form-control" name="payment">-->
      <!--                                          <option>-- Choose Payment --</option>-->
      <!--                                          <option value="Total Investment">Total Investment</option>-->
      <!--                                          <option value="Loan">Loan</option>-->
      <!--                                      </select>-->
      <!--                                      <span class="error-text name_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Clients Availability on the site</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="availability" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text mobilenumber_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-6">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Occupation</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="occupation" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text mobilenumber_error"></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">What kind of style do you prefer</label><span class="text-danger">*</span><br>-->
      <!--                                      <select class="form-control" name="qnone">-->
      <!--                                          <option>-- Choose Option --</option>-->
      <!--                                          <option value="Apartments">Apartments</option>-->
      <!--                                          <option value="Bungalows">Bungalows</option>-->
      <!--                                          <option value="Villas">Villas</option>-->
      <!--                                          <option value="Eco-friendly homes">Eco-friendly homes</option>-->
      <!--                                          <option value="Farmhouses">Farmhouses</option>-->
      <!--                                      </select>-->

      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">How much time do you prefer to spend in the different areas of the house?</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="qntwo" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text "></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->

      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">What kind of spaces are more important to you?</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="qnthree" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text "></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Is there anyone with mobility problem or disability?</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="qnfour" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text "></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">Your long term plan about the house</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="qnfive" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text "></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-12">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                      <label for="">How private the house should be?</label><span class="text-danger">*</span><br>-->
      <!--                                      <input type="text" name="qnsix" style="width: 100%" id="enddate">-->
      <!--                                      <span class="error-text "></span>-->
      <!--                                  </div>-->
      <!--                              </div>-->

      <!--                              <div class="col-lg-12 ">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                  <label for="">Requirement (No Of Bedroom, Specific Details)</label><span class="text-danger">*</span><span class="error-text name_error"></span><br>-->
      <!--                                  <table class="table table-borderless">-->
      <!--                                      <tr>-->
      <!--                                          <td>-->
      <!--                                              <input type="text" class="form-control" name="requirenments[]" style="width: 100%" id="enddate">-->
      <!--                                          </td>-->
      <!--                                          <td>-->
      <!--                                              <button type="button" class="btn btn-success addreq">Add</button>-->
      <!--                                          </td>-->
      <!--                                      </tr>-->
      <!--                                      <tbody id="addreq">-->

      <!--                                      </tbody>-->
      <!--                                  </table>-->
      <!--                              </div>-->
      <!--                              </div>-->
      <!--                              <div class="col-lg-12 ">-->
      <!--                                  <div class="form-input mt-3">-->
      <!--                                  <label for="">Family Members</label><span class="text-danger">*</span><span class="error-text name_error"></span><br>-->
      <!--                                  <table class="table table-borderless">-->
      <!--                                      <tr>-->
      <!--                                          <td>-->
      <!--                                              <input type="text" class="form-control" name="member[]" style="width: 100%" id="enddate">-->
      <!--                                          </td>-->
      <!--                                          <td>-->
      <!--                                              <input type="text" class="form-control" name="age[]" style="width: 100%" id="enddate">-->
      <!--                                          </td>-->
      <!--                                          <td>-->
      <!--                                              <button type="button" class="btn btn-success addfamily">Add</button>-->
      <!--                                          </td>-->
      <!--                                      </tr>-->
      <!--                                      <tbody id="familyadd">-->

      <!--                                      </tbody>-->
      <!--                                  </table>-->
      <!--                              </div>-->
      <!--                              </div>-->
      <!--                          </div>-->

      <!--                  </div>-->
      <!--              </div>-->
      <!--          </div>-->


      <!--      </div>-->
      <!--      <div class="modal-footer">-->
      <!--        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
      <!--        <button type="submit" class="btn btn-primary ">Save </button>-->
      <!--      </div>-->
      <!--  </form>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->

      <div class="modal fade" id="createLead2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Lead Creation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addLeadsdata" id="addLeadsdata" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>Basic Information</h6>
                            <input type="hidden" name="leadid" id="leadid5">
                                <div class="row">
                                    {{-- <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Lead ID</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="leadsid">
                                                <option value="">-- Choose Lead --</option>

                                                <option></option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 100%" id="name2" required>
                                            <span class="error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="tel" name="phnumber" id="phnumber" class="form-control" style="width:100%" required>
                                            <span class="error-text phnum_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="email" name="emailid" id="emailid" class="form-control" style="width:100%" required>
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>

                                    <h6 class="mt-3">Site Information</h6>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">Address</label><span class="text-danger">*</span><br>
                                            <textarea class="form-control" name="address" id="address" required></textarea>
                                            <span class="error-text email_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Google Map link</label><span class="text-danger">*</span><br>
                                            <input type="url" name="maplocation" id="maplocation" class="form-control" style="width:100%" required>
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Plot Area</label><span class="text-danger">*</span><br>
                                            <input type="number" name="plotarea" id="plotarea" class="form-control" style="width:100%" required>
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <h6 class="mt-3">Basic Information</h6>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            @php
                                                    $today = date("Y-m-d");
                                             @endphp
                                            <label for="">Start Date</label><span class="text-danger">*</span><br>
                                            <input type="date" min="@php echo $today; @endphp" name="startdate" style="width: 100%" id="startdate" required>
                                            <span class="error-text password_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate" required min="@php echo $today; @endphp">
                                            <span class="error-text date_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Budget Value</label><span class="text-danger">*</span><br>
                                            <input type="number" name="budgetvalue" style="width: 100%" id="enddate" required>
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Payment</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="payment" required>
                                                <option value="">-- Choose Payment --</option>
                                                <option value="Total Investment">Total Investment</option>
                                                <option value="Loan">Loan</option>
                                            </select>
                                            <span class="error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Clients Availability on the site</label><span class="text-danger">*</span><br>
                                            <input type="text" name="availability" style="width: 100%" id="" required>
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Occupation</label><span class="text-danger">*</span><br>
                                            <input type="text" name="occupation" style="width: 100%" id="" required>
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">What kind of style do you prefer</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="qnone" required>
                                                <option value="">-- Choose Option --</option>
                                                <option value="Apartments">Apartments</option>
                                                <option value="Bungalows">Bungalows</option>
                                                <option value="Villas">Villas</option>
                                                <option value="Eco-friendly homes">Eco-friendly homes</option>
                                                <option value="Farmhouses">Farmhouses</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">How much time do you prefer to spend in the different areas of the house?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qntwo" style="width: 100%" id="" required>
                                            <span class="error-text "></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">What kind of spaces are more important to you?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnthree" style="width: 100%" id="" required>
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">Is there anyone with mobility problem or disability?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnfour" style="width: 100%" id="" required>
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">Your long term plan about the house</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnfive" style="width: 100%" id="" required>
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">How private the house should be?</label><span class="text-danger">*</span><br>
                                            <input type="text" name="qnsix" style="width: 100%" id="" required>
                                            <span class="error-text "></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 ">
                                        <div class="form-input mt-3">
                                        <label for="">Requirement (No Of Bedroom, Specific Details)</label><span class="error-text name_error"></span><br>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="requirenments[]" style="width: 100%" id="enddate">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success addreq">Add</button>
                                                </td>
                                            </tr>
                                            <tbody id="addreq">

                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-input mt-3">
                                        <label for="">Family Members</label><span class="error-text name_error"></span><br>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="member[]" style="width: 100%" id="enddate">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="age[]" style="width: 100%" id="enddate">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success addfamily">Add</button>
                                                </td>
                                            </tr>
                                            <tbody id="familyadd">

                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary ">Save </button>
            </div>
        </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="leadviewnodata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              {{-- <h5 class="modal-title" id="exampleModalLabel">No Data </h5> --}}
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="assets/images/no-data.png" class="img-fluid">
              <h5 class="text-center"><b>No Data Found</b></h5>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
          </div>
        </div>
      </div>

@endsection
