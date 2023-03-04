@extends('layout.app')
@section('title','Users')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <h4 class="section-heading">Users List</h4>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <!--<th>User Type</th>-->
                                                    {{-- <th>View</th> --}}
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="userstable">
                                                @foreach ($getusers as $users)
                                                        <tr>
                                                            <td><a style="text-decoration:underline;cursor:pointer" class="viewid" data-viewid="{{ $users->userid }}">{{ $users->userid }}</a></td>
                         <td>{{ $users->name }}</td>
                         <!--<td>{{ $users->role }}</td>-->
                         <td>
                             @if($designation = App\Models\Designation::where('id',$users->role)->first())
                                {{$designation->designation_name}}
                             @endif
                            {{-- <!--@if($users->usertype == 1)-->
                            <!--    Super Admin-->
                            <!--    @elseif($users->usertype == 2)-->
                            <!--    Office User-->
                            <!--    @elseif($users->usertype == 3)-->
                            <!--    AE-->
                            <!--    @elseif($users->usertype == 4)-->
                            <!--    Client-->
                            <!--    @elseif($users->usertype == 5)-->
                            <!--    RM-->
                            <!--@endif--> --}}
                        </td>
                         <td>
                             <button data-user='{{ $users->userid }}' data-id="{{$users->id}}" data-bs-toggle="modal" data-bs-target="#edit_user" class="useredit btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                         </td>
                         <td>
                             <button data-user='{{ $users->userid }}' class="btn btn-danger btn-sm deleteuser" id="deleteuser"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                         </td>
                                                        </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createuser">
                        <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create User
                      </button>
                      <div class="clickhereimg mt-3">
                        <img class="img-fluid m-auto d-block" src="assets/images/clickhereimg.png" alt="">
                  </div>
                        <div class="view_card_box">
                            {{-- <div class="img">
                                <img src="assets/images/dashboard/modal_img.png" alt="">
                            </div> --}}
                            <span class="code usercode">KM01</span>
                            <p class="name username">Ramesh</p>
                            {{-- <p class="client_id">Client Id -3120</p> --}}
                            <p class="phone usermbl"><a href="jayascript:;">+91 82156 6520</a></p>
                            <p class="mail usermail"><a href="javascript:;" class="role">Prakash@Businessbench.in</a></p>
                            <p class="role">Role</p>
                            <p class="type userrole">Owner</p>
                        </div>




                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="createuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">User Creation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <form id="adduserdata" name="adduserdata" action="edit_engineer" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <h5>Personal Information</h5> --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 95%" id="name" required >
                                            <span class="error-text name_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Password</label><span class="text-danger">*</span><br>
                                            <input type="text" name="password" style="width: 95%" id="password" required>
                                            <span class="error-text password_error"></span>
                                            <span class="error-text password_good" style="color:green"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="tel" name="mobilenumber" style="width: 95%" id="phnumber" required>
                                            <span class="error-text phnum_error"></span>
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="email" name="email" style="width: 95%" id="email" required><br>
                                            <span class="error-text email_error"></span>
                                        </div>

                                        <div class="form-input mt-3">
                                            <label for="">Profile Picture (400 X 400)</label><span class="text-danger">*</span><br>
                                            <input type="file" name="profilepic" accept="image/*" style="width: 95%" id="profilepic" required>
                                            <span class="error-text "></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-input">
                                            <label for="">Designation</label><span class="text-danger">*</span><br>
                                            <select class="form-select designation" id="role" name="designation_list" required>
                                                <option value="">-- Select Designation --</option>
                                                @if($designations)
                                                    @foreach ($designations as $desig)
                                                        <option value={{ $desig->id }}>{{ $desig->designation_name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            <span class="error-text role_error"></span>
                                        </div>

                                        <!-- <div class="form-input mt-3">-->
                                        <!--    <label for="">Select Region</label><span class="text-danger">*</span><br>-->
                                        <!--    <select class="form-select selectregion" id="role" name required>-->
                                        <!--        <option value="">-- Select Region --</option>-->
                                        <!--        @if($region)-->
                                        <!--            @foreach ($region as $reg)-->
                                        <!--                <option value={{ $reg->zone_id }}>{{ $reg->zone_id }}</option>-->
                                        <!--            @endforeach-->
                                        <!--        @endif-->

                                        <!--    </select>-->
                                        <!--    <span class="error-text role_error"></span>-->
                                        <!--</div>-->

                                        <div class="form-group checkout-box mt-3">
                                            <label for="">Menu Permission</label><span class="text-danger">*</span><br>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" value="0" name="stagemaster" id="stagemaster">
                                                <label class="form-check-label" for="stagemaster">
                                                  Stage Master
                                                </label>
                                              </div>
                                              <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" value="0" name="zone" id="zonemenu" >
                                                <label class="form-check-label" for="zonemenu">
                                                  Zones
                                                </label>
                                              </div>

                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="area" id="areamenu" >
                                                <label class="form-check-label" for="areamenu">
                                                  Area
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="draws" id="drawingmenu" >
                                                <label class="form-check-label" for="drawingmenu">
                                                  Drawings
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="engineers"  id="engineersmenu" >
                                                <label class="form-check-label" for="engineersmenu">
                                                  Engineers
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="users" id="usersmenu" >
                                                <label class="form-check-label" for="usersmenu">
                                                  Users
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="client" id="clientsmenu" >
                                                <label class="form-check-label" for="clientsmenu">
                                                  Clients
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="estimate" id="estimatemenu" >
                                                <label class="form-check-label" for="estimatemenu">
                                                  Estimate
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="leads" id="leadsmenu" >
                                                <label class="form-check-label" for="leadsmenu">
                                                  Leads
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="0" name="designation" id="designationmenu" >
                                                <label class="form-check-label" for="designationmenu">
                                                  Designation
                                                </label>
                                              </div>

                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary saveuser">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">User Edit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ajax-load"><img src="assets/images/loading-buffering.gif"></div>
                {{-- <h4 class="section-heading">Create User</h4> --}}
                <div class="container">
                    <form action="edit_users" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-lg-12">
                            {{-- <h5>Personal Information</h5> --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <input type="hidden" value="" name="edit_user_id" class="edit_user_id">
                                            <label for="">Name</label><span class="text-danger">*</span><br>
                                            <input type="text" name="name" style="width: 95%" id="name">

                                        </div>

                                        <div class="form-input mt-3">
                                            <label for="">Mobile Number</label><span class="text-danger">*</span><br>
                                            <input type="text" name="mobile" style="width: 95%" id="mobilenumber">
                                        </div>
                                        <div class="form-input mt-3">
                                            <label for="">E-mail</label><span class="text-danger">*</span><br>
                                            <input type="text" name="mail" style="width: 95%" id="email">

                                        </div>
                                        <div class="form-input mt-3">
                                            <input type="hidden" name="old_user" class="old_user_img">
                                            <label for="">Profile Picture (400 X 400)</label><span class="text-danger">*</span><br>
                                            <input type="file" name="profilepic" style="width: 95%">
                                        </div>
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" id="changepass" >
                                            <label class="form-check-label" for="changepass">
                                              Change Password
                                            </label>
                                        </div>
                                        <div class="form-input mt-2 edit_pass">
                                            <input type="hidden" name="hide_password" class="hide_password">
                                            <input type="text" name="password" style="width: 95%" id="password">

                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-input">
                                            <label for="">Designation</label><span class="text-danger">*</span><br>
                                            <select class="form-select role" id="role" name="role">
                                                <option value="">-- Select Designation --</option>
                                            </select>

                                        </div>
                                        <div class="form-group mt-3 checkboxes">
                                            <label for="">Menu Permission</label><span class="text-danger">*</span><br>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input projectmenu" type="checkbox"  name="projectmenu" id="projectmenu"  >
                                                <label class="form-check-label" for="projectmenu">
                                                  Projects
                                                </label>
                                              </div>
                                              <div class="form-check ">
                                                <input class="form-check-input zonemenu" type="checkbox"  name="zonemenu" id="zonemenu" >
                                                <label class="form-check-label" for="zonemenu">
                                                  Zones
                                                </label>
                                              </div>

                                              <div class="form-check">
                                                <input class="form-check-input areamenu" type="checkbox"  name="areamenu" id="areamenu" >
                                                <label class="form-check-label" for="areamenu">
                                                  Area
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input drawingmenu" type="checkbox" name="drawingmenu" id="drawingmenu" >
                                                <label class="form-check-label" for="drawingmenu">
                                                  Drawings
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input engineersmenu" type="checkbox"  name="engineersmenu" id="engineersmenu" >
                                                <label class="form-check-label" for="engineersmenu">
                                                  Engineers
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input usersmenu" type="checkbox" name="usersmenu" id="usersmenu" >
                                                <label class="form-check-label" for="usersmenu">
                                                  Users
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input clientsmenu" type="checkbox"  name="clientsmenu" id="clientsmenu" >
                                                <label class="form-check-label" for="clientsmenu">
                                                  Clients
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input estimatemenu" type="checkbox"  name="estimatemenu" id="estimatemenu" >
                                                <label class="form-check-label" for="estimatemenu">
                                                  Estimate
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input leadsmenu" type="checkbox"  name="leadsmenu" id="leadsmenu" >
                                                <label class="form-check-label" for="leadsmenu">
                                                  Leads
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input designationmenu" type="checkbox"  name="designationmenu" id="designationmenu" >
                                                <label class="form-check-label" for="designationmenu">
                                                  Designation
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>

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

    @if (Session::get('Success-User'))
        <div class="alert alert-success bg-success alert-dismissible fade show float-alert" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            <strong class="text-white">Updated Successfully</strong>
        </div>
    @endif
@endsection
