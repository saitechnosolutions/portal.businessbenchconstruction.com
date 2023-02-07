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


                        <div class="col-lg-3">

                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createLead">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Lead
                              </button>


                        </div>
                    </div>
                </div>
                <div class="col-lg-12">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>LEAD ID</th>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                    <th>Location</th>
                                                    <th>View</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="leadsstable">
                                                @if ($leads)
                                                    @foreach ($leads as $lead)
                                                        <tr>
                                                            <td>{{ $lead->leadid }}</td>
                                                            <td>{{ $lead->name }}</td>
                                                            <td><a href="tel:{{ $lead->mobile_num }}">{{ $lead->mobile_num }}</a></td>
                                                            <td>{{ $lead->email }}</td>
                                                            <td>{{ $lead->address }}</td>
                                                            <td><button class="btn btn-info text-white leadview" data-leadid={{ $lead->leadid }} ><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                                                            <td><button class="btn btn-primary text-white editlead" data-id="{{$lead->id}}" data-bs-toggle="modal" data-bs-target="#editLead"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                                                            <td><button class="btn btn-danger text-white" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>
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
                <form name="addLeadsdata" id="addLeadsdata" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>Basic Information</h6>
                                <div class="row">
                                    {{-- <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Lead ID</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="leadsid">
                                                <option value="">-- Choose Lead --</option>

                                                <option></option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
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
                                            <input type="email" name="emailid" id="emailid" class="form-control" style="width:100%">
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
                                            <input type="text" name="maplocation" id="maplocation" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Plot Area</label><span class="text-danger">*</span><br>
                                            <input type="text" name="plotarea" id="plotarea" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <h6 class="mt-3">Basic Information</h6>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Start Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="startdate" style="width: 100%" id="startdate">
                                            <span class="error-text password_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Budget Value</label><span class="text-danger">*</span><br>
                                            <input type="text" name="budgetvalue" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Payment</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="payment">
                                                <option>-- Choose Payment --</option>
                                                <option value="Total Investment">Total Investment</option>
                                                <option value="Loan">Loan</option>
                                            </select>
                                            <span class="error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Clients Availability on the site</label><span class="text-danger">*</span><br>
                                            <input type="text" name="availability" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Occupation</label><span class="text-danger">*</span><br>
                                            <input type="text" name="occupation" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">What kind of style do you prefer</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="qnone">
                                                <option>-- Choose Option --</option>
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
                                            <label for="">is there anyone with mobility problem or disability?</label><span class="text-danger">*</span><br>
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
                                        <label for="">Requirement (No Of Bedroom, Specific Details)</label><span class="text-danger">*</span><span class="error-text name_error"></span><br>
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
                                        <label for="">Family Members</label><span class="text-danger">*</span><span class="error-text name_error"></span><br>
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
                    <a href="" class="btn btn-primary btn-sm">Find Location</a>
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
                        <h5 class="text-center reqtit mb-3">Requirenments</h5>
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
                                            <select class="form-control" name="leadsid">
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
                                            <input type="text" name="maplocation" id="maplocation" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Plot Area</label><span class="text-danger">*</span><br>
                                            <input type="text" name="plotarea" id="plotarea" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <h6 class="mt-3">Basic Information</h6>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Start Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="startdate" style="width: 100%" id="startdate">
                                            <span class="error-text password_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Budget Value</label><span class="text-danger">*</span><br>
                                            <input type="number" name="budgetvalue" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Payment</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="payment">
                                                <option value="Total Investment">Total Investment</option>
                                                <option value="Loan">Loan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Clients Availability on the site</label><span class="text-danger">*</span><br>
                                            <input type="number" name="availability" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Occupation</label><span class="text-danger">*</span><br>
                                            <input type="text" name="occupation" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">What kind of style do you prefer</label><span class="text-danger">*</span><br>
                                            <select class="form-control" name="qnone">
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
                                            <label for="">Is there anyone with mobility problem or disability?</label><span class="text-danger">*</span><br>
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
@endsection
