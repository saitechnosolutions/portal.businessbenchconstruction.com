@extends('layout.app')
@section('title','Engineers')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <h4 class="section-heading">Engineers List</h4>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Engineer ID</th>
                                                    <th>Name</th>
                                                    <th>Area</th>
                                                    <th>Region</th>
                                                    <th>Project Completed</th>
                                                    <th>Project Pending</th>
                                                    @if(Auth::user()->usertype != '12' || Auth::user()->usertype != '2')
                                                        @else
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    @endif

                                                    @if(Auth::user()->usertype == '15')
                                                        <th>Assigned to</th>
                                                    @endif

                                                </tr>
                                            </thead>
                                            <tbody id="engineerstable">
                                                @if(Auth::user()->usertype == '8')
                                                    @if($getengineers = App\Models\Engineer::where('rmid',Auth::user()->userid)->get())
                                                        @foreach ($getengineers as $engineers)
                                                        <tr>
                                                            <td style="text-transform: uppercase;text-decoration:underline;cursor:pointer"><a class="engineerview" data-engineerview="{{ $engineers->engineerid }}">{{ $engineers->engineerid }}</a></td>
                                                            <td>{{ $engineers->name }}</td>
                                                            <td>{{ $engineers->dealershiparea }}</td>
                                                            <td>{{ $engineers->dealershipregion }}</td>
                                                            <td>
                                                                @if($noofclients = App\Models\Client::where('engineercode',$engineers->engineerid)->where('completed_status',100)->get())
                                                                    {{ $noofclients->count() }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($noofclients = App\Models\Client::where('engineercode',$engineers->engineerid)->where('completed_status',null)->get())
                                                                    {{ $noofclients->count() }}
                                                                @endif
                                                            </td>
                                                            @if(Auth::user()->usertype != '12' || Auth::user()->usertype != '2')
                                                        @else
                                                              <td>
                                                                    <button class="btn btn-secondary btn-sm edit_engineer" data-id="{{ $engineers->id }}" data-bs-toggle="modal" data-bs-target="#editEngineers"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm engineerdelete" data-engid="{{ $engineers->engineerid }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                </td>
                                                    @endif


                                                            @if(Auth::user()->usertype == '15')
                                                            <td>
                                                                @if($engineers->rmid == '')
                                                                <button class="btn btn-primary text-white assignedtorm" data-engid={{ $engineers->engineerid }}><i class="fa fa-users" aria-hidden="true"></i></button>
                                                                @else
                                                                 @if($name = App\Models\User::where('userid','=',$engineers->rmid)->first())
                                                                <span class="badge bg-success">{{$name->name}}</span>
                                                            @endif
                                                                <!--<span class="badge bg-info">{{ $engineers->rmid }}</span>-->
                                                                @endif

                                                            </td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    @else

                                                    @if($getengineers = App\Models\Engineer::get())
                                                    @foreach ($getengineers as $engineers)
                                                    <tr>
                                                        <td style="text-transform: uppercase;text-decoration:underline;cursor:pointer"><a class="engineerview" data-engineerview="{{ $engineers->engineerid }}">{{ $engineers->engineerid }}</a></td>
                                                        <td>{{ $engineers->name }}</td>
                                                        <td>{{ $engineers->dealershiparea }}</td>
                                                        <td>{{ $engineers->dealershipregion }}</td>
                                                        <td>
                                                            @if($noofclients = App\Models\Client::where('engineercode',$engineers->engineerid)->where('completed_status',100)->get())
                                                                {{ $noofclients->count() }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($noofclients = App\Models\Client::where('engineercode',$engineers->engineerid)->where('completed_status',null)->get())
                                                                {{ $noofclients->count() }}
                                                            @endif
                                                        </td>
                                                        @if(Auth::user()->usertype != '12' || Auth::user()->usertype != '2')
                                                            @else
                                                            <td>
                                                            <button class="btn btn-secondary btn-sm edit_engineer" data-id="{{ $engineers->id }}" data-bs-toggle="modal" data-bs-target="#editEngineers"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm engineerdelete" data-engid="{{ $engineers->engineerid }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                        </td>
                                                        @endif

                                                        @if(Auth::user()->usertype == '15')
                                                        <td>
                                                            @if($engineers->rmid == '')
                                                            <button class="btn btn-primary text-white assignedtorm" data-engid={{ $engineers->engineerid }}><i class="fa fa-users" aria-hidden="true"></i></button>
                                                            @else
                                                             @if($name = App\Models\User::where('userid','=',$engineers->rmid)->first())
                                                                <span class="badge bg-success">{{$name->name}}</span>
                                                            @endif
                                                            <!--<span class="badge bg-info">{{ $engineers->rmid }}</span>-->
                                                            @endif

                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                @endif
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
                    @if(Auth::user()->usertype == '1' || Auth::user()->usertype == '10' || Auth::user()->usertype == '11')
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createEngineers">
                        <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Engineer
                      </button>
                    @endif

                      <div class="clickhereimg mt-3">
                        <img class="img-fluid m-auto d-block" src="assets/images/clickhereimg.png" alt="">
                  </div>

                        <div class="view_card_box engineer_view" style="margin-top:85px">
                        <div class="img">
                            <img class="engineerphoto" src="assets/images/dashboard/modal_img.png" alt="">
                        </div>
                        <span class="code engineercode">KM01</span>
                        <p class="name engineername">Ramesh</p>
                        <p class="date"><span class="engineerstartdate">12-2022</span> - <span class="engineerenddate">05-2024</span></p>
                        <p class="address engineeraddress">
                            No.5/301,2nd floor, Thirukampuliyur,
                            Bypass, Karur, Tamil Nadu 639002
                        </p>
                        <p class="phone engineerphone"><a href="jayascript:;">+91 82156 6520</a></p>
                        <p class="mail"><a href="javascript:;" class="role engineermail">Prakash@Businessbench.in</a></p>
                        <h3 class="details">Dealership Details</h3>
                        <div class="dealer_details">

                            <div class="inner">
                                <h4>Region</h4>
                                <h6>Area</h6>
                            </div>
                            <div class="inner">
                                <h4 class="engineerregion">Karur</h4>
                                <h6 class="engineerarea">Area</h6>
                            </div>
                        </div>
                        <h5 class="office_address">
                            Office Address
                        </h5>

                            <a href="" class="location engineerlocation">Find Location</a></button>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="createEngineers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Engineer Creation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addEngineerdata" id="addEngineerdata" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <h5>Personal Information</h5> --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 100%" id="name" required>
                                            <span class="error-text name_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Start Date</label><span class="text-danger">*</span><br>
                                              @php
                                                    $today = date("Y-m-d");
                                             @endphp
                                            <input type="date" min="@php echo $today; @endphp" name="startdate" id="startdate" style="width: 100%" id="startdate" required>
                                            <span class="error-text password_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate" required min="@php echo $today; @endphp">
                                            <span class="error-text date_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Address</label><span class="text-danger">*</span><br>
                                            <textarea class="form-control" name="address" id="address" required></textarea>
                                            <span class="error-text address_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Google Map link</label><span class="text-danger">*</span><br>
                                            <input type="url" name="maplocation" id="maplocation" class="form-control" style="width:100%" required>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        {{-- <div class="form-input mt-3">
                                            <label for="">Profile Picture (400 X 400)</label><span class="text-danger">*</span><br>
                                            <input type="file" name="name" style="width: 95%" id="profilepic">
                                            <span class="error-text name_error"></span>
                                        </div> --}}
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="tel" name="phnumber" id="phnumber" class="form-control" style="width:100%" required>
                                            <span class="error-text phnum_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="email" name="emailid" id="email" class="form-control" style="width:100%" required>
                                            <span class="error-text email_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Aadhar Card</label><span class="text-danger">*</span><br>
                                            <input type="file" name="aadhardocument" accept="application/pdf" id="aadhardocument" class="form-control" style="width:100%" required>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Region</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="dealershipregion" id="dealershipregion" required>
                                                <option value="">-- Select Region --</option>
                                                @foreach ($district as $district)
                                                    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Area</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="dealershiparea" id="dealershiparea" required>
                                                <option value="">-- Select Areas --</option>

                                            </select>
                                            {{-- <input type="text" name="mblnumber" class="form-control" style="width:100%"> --}}
                                            <span class="error-text role_error"></span>
                                        </div>


                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">Photo</label><span class="text-danger">*</span><br>
                                            <input type="file" name="photo" class="form-control" id="photo" accept="image/*" style="width:100%" required>
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

      <div class="modal fade" id="editEngineers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Engineer Update</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ajax-load"><img src="assets/images/loading-buffering.gif"></div>
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form name="addEngineerdata" action="edit_engineer" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <h5>Personal Information</h5> --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <input type="hidden" value="" class="edit_engineer_id" name="edit_engineer_id">
                                            <input type="hidden" value="" class="aadhar_img" name="aadhar_img">
                                            <input type="hidden" value="" class="photo_img" name="photo_img">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 100%" id="name">
                                            <span class="error-text name_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Start Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="startdate" style="width: 100%" id="startdate">
                                            <span class="error-text password_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">End Date</label><span class="text-danger">*</span><br>
                                            <input type="date" name="enddate" style="width: 100%" id="enddate">
                                            <span class="error-text mobilenumber_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Address</label><span class="text-danger">*</span><br>
                                            <textarea class="form-control" name="address" id="address"></textarea>
                                            <span class="error-text email_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Google Map link</label><span class="text-danger">*</span><br>
                                            <input type="text" name="maplocation" id="maplocation" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        {{-- <div class="form-input mt-3">
                                            <label for="">Profile Picture (400 X 400)</label><span class="text-danger">*</span><br>
                                            <input type="file" name="name" style="width: 95%" id="profilepic">
                                            <span class="error-text name_error"></span>
                                        </div> --}}
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="tel" name="phnumber" id="phnumber" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="text" name="emailid" id="emailid" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Aadhar Card</label><span class="text-danger">*</span><br>
                                            <input type="file" name="aadhardocument" id="aadhardocument" class="form-control" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Region</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="dealershipregion" id="editregion">
                                                <option>-- Select Region --</option>

                                            </select>
                                            <span class="error-text role_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Area</label><span class="text-danger">*</span><br>
                                            <select class="form-select" name="dealershiparea" id="editarea">
                                                <option>-- Select Areas --</option>

                                            </select>
                                            {{-- <input type="text" name="mblnumber" class="form-control" style="width:100%"> --}}
                                            <span class="error-text role_error"></span>
                                        </div>


                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-input mt-3">
                                            <label for="">Photo</label><span class="text-danger">*</span><br>
                                            <input type="file" name="photo" class="form-control" id="photo" style="width:100%">
                                            <span class="error-text role_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Exist Photo</label><span class="text-danger">*</span><br>
                                            <img src="" width="100%" class="exist_img">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-3">
                                            <label for="">Exist Aadhar</label><span class="text-danger">*</span><br>
                                            <img src="" width="100%" class="exist_img">
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary editengineer">Save </button>
            </div>
        </form>
          </div>
        </div>
      </div>

      @if (Session::get('Success-engineer'))
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
                <form name="assignengineer" id="assignengineer" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                <div class="form-input mt-3">
                    <input type="hidden" name="engid" id="engid1">
                    <label for="">Select RM</label><span class="text-danger">*</span><br>
                    <select class="form-select" name="assigneng">
                        <option value="">-- Select RM --</option>

                        @if($getrm = App\Models\User::where('role',8)->get())

                        @foreach ($getrm as $users)
                                <option value="{{ $users->userid }}">{{ $users->userid }} | {{ $users->name }}</option>
                            @endforeach
                        @endif

                    </select>
                    <span class="error-text "></span>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Assign Engineer</button>
            </div>
        </form>
          </div>
        </div>
      </div>
@endsection
