@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @if(Auth::user()->usertype != '4')
                        <div class="col-lg-9">
                            <h4 class="section-heading">Estimates List</h4>
                        </div>
                        @endif

                        <div class="col-lg-3">
                            @if(Auth::user()->usertype != '4')
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createEstimate">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Estimate
                              </button>
                              @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(Auth::user()->usertype != '4')

                                <div class="userdetails">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Estimate ID</th>
                                                    <th>Engineer ID</th>
                                                    <th>Client ID</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="clientstable">
                                                @foreach ($estimates as $est)
                                                <tr>
                                                    <td><a href="/estimatedetails/{{ $est->estid }}" style="text-decoration:underline;cursor: pointer;">{{ $est->estid }}</a></td>
                                                    <td>{{ $est->eng_code }}</td>
                                                    <td>{{ $est->clientcode }}</td>
                                                    <td>{{ $est->clientname }}</td>
                                                    <td>
                                                        @if($est->status == '1')
                                                            <span class="badge bg-success">Approved</span>
                                                            @else
                                                            <span class="badge bg-danger">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm estimatesdelete" data-estid="{{ $est->estid }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
                                @else
                                {{-- <div class="col-lg-12">
                                    <h4 class="section-heading">Estimates List1</h4>
                                </div> --}}
                                <div class="container">
                                    <div class="col-lg-12">
                                        <h4 class="section-heading" style="margin-left:0px;margin-bottom:0px">Main Estimate</h4>
                                    </div>
                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-3 ">
                                            <a href="/ovrlestimate/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">Main Estimate</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4 class="section-heading" style="margin-left:0px;margin-bottom:10px;margin-top:40px;">Stage Wise Estimates</h4>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stageone/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stageonetitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stagetwo/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stagetwotitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stagethree/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stagethreetitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stagefour/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stagefourtitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stagefive/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stagefivetitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stagesix/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stagesixtitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stageseven/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stageseventitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stageeight/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stageeighttitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stagenine/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stageninetitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stageten/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stageeentitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4 class="section-heading" style="margin-left:0px;margin-bottom:10px;margin-top:40px;">Additional Estimates</h4>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stageten/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stageeentitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <a href="/stageten/{{ $usrviewestimates->estid }}">
                                                <div class="folder text-center">
                                                    <div class="folder-icon">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <p class="folder-title mt-3">{{ $usrviewestimates->stageeentitle }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>




                                    </div>
                                </div>

                                @endif




    </section>

    <div class="modal fade" id="createEstimate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <form name="addEstimates" id="addEstimates" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Estimate</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex align-items-start">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">General Details</button>
                                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Stage 1</button>
                                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Stage 2</button>
                                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 3</button>
                                    <button class="nav-link" id="v-pills-stage4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-stage4" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 4</button>
                                    <button class="nav-link" id="v-pills-stage5-tab" data-bs-toggle="pill" data-bs-target="#v-pills-stage5" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 5</button>
                                    <button class="nav-link" id="v-pills-stage6-tab" data-bs-toggle="pill" data-bs-target="#v-pills-stage6" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 6</button>
                                    <button class="nav-link" id="v-pills-stage7-tab" data-bs-toggle="pill" data-bs-target="#v-pills-stage7" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 7</button>
                                    <button class="nav-link" id="v-pills-stage8-tab" data-bs-toggle="pill" data-bs-target="#v-pills-stage8" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 8</button>
                                    <button class="nav-link" id="v-pills-stage9-tab" data-bs-toggle="pill" data-bs-target="#v-pills-stage9" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 9</button>
                                    <button class="nav-link" id="v-pills-stage10-tab" data-bs-toggle="pill" data-bs-target="#v-pills-stage10" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Stage 10</button>
                                    {{-- <button class="nav-link" id="v-pills-stage10-tab" data-bs-toggle="pill" data-bs-target="#v-pills-finalreport" type="button" role="tab" aria-controls="v-pills-finalreport" aria-selected="false">Final Report</button> --}}
                                  </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                            @csrf
                                            {{-- @dd($estid); --}}
                                            <input type="hidden" name="estid" value="{{ $estid }}">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    {{-- <h5>General Information</h5> --}}
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-input mt-3">
                                                                    <label for="">Engineer Code</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="engineercode" style="width: 95%" id="name">
                                                                    <span class="error-text name_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Client Code</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="clientcode" style="width: 95%" id="password">
                                                                    <span class="error-text password_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Client Name</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="clientname" style="width: 95%" id="mobilenumber">
                                                                    <span class="error-text mobilenumber_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 1 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage1title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 2 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage2title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 3 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage3title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 4 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage4title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">

                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 5 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage5title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 6 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage6title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 7 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage7title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 8 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage8title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 9 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage9title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>
                                                                <div class="form-input mt-3">
                                                                    <label for="">Stage 10 title</label><span class="text-danger">*</span><br>
                                                                    <input type="text" name="stage10title" style="width: 95%" id="email">
                                                                    <span class="error-text email_error"></span>
                                                                </div>

                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            @csrf


                                            <div class="container mb-4">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        {{-- <h5>General Information</h5> --}}
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div class="table-responsive-lg">

                                                                    <table class="table table-bordered" style="overflow-x:scroll">
                                                                        <thead>
                                                                            <tr>
                                                                                {{-- <th style="width:150px">S.No</th> --}}
                                                                                <th style="width:150px">Qty</th>
                                                                                <th style="width:150px">Unit</th>
                                                                                <th style="width:500px">Description of Work</th>
                                                                                <th style="width:200px">Rate</th>
                                                                                <th style="width:150px">Per</th>
                                                                                <th style="width:300px">Amount</th>
                                                                                <th ><button type="button" class="btn btn-success stage1add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="stage1">
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stageoneqty[]" id="stageoneqty1" class="qty">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stageoneunit[]">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <textarea class="form-control" name="stageonedesc[]"></textarea>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stageonerate[]" class="rate" id="stageonerate1">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stageoneper[]" >
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stageoneamt[]" class="amt" id="stageoneamt1">
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
                                            </div>


                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                                            <div class="container mb-4">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div class="table-responsive-lg">

                                                                    <table class="table table-bordered" style="overflow-x:scroll">
                                                                        <thead>
                                                                            <tr>
                                                                                {{-- <th style="width:150px">S.No</th> --}}
                                                                                <th style="width:150px">Qty</th>
                                                                                <th style="width:150px">Unit</th>
                                                                                <th style="width:500px">Description of Work</th>
                                                                                <th style="width:200px">Rate</th>
                                                                                <th style="width:150px">Per</th>
                                                                                <th style="width:300px">Amount</th>
                                                                                <th ><button type="button" class="btn btn-success stage2add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="stage2">
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stagetwoqty[]" id="stagetwoqty1" class="qty">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stagetwounit[]">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <textarea class="form-control" name="stagetwodesc[]"></textarea>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stagetworate[]" class="rate" id="stagetworate1">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stagetwoper[]" >
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-input mt-3">
                                                                                        <input type="text" name="stagetwoamt[]" class="amt" id="stagetwoamt1">
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
                                            </div>
                                        {{-- <button type="submit" class="btn btn-primary m-auto d-block">Save Stage 1</button> --}}

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button" class="btn btn-success stage3add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage3">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagethreeqty[]" id="stagethreeqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagethreeunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stagethreedesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagethreerate[]" class="rate" id="stagethreerate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagethreeper[]" >
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagethreeamt[]" class="amt" id="stagethreeamt1">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stage4" role="tabpanel" aria-labelledby="v-pills-stage4-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button" class="btn btn-success stage4add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage4">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefourqty[]" id="stagefourqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefourunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stagefourdesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefourrate[]" class="rate" id="stagefourrate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefourper[]" >
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefouramt[]" class="amt" id="stagefouramt1">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stage5" role="tabpanel" aria-labelledby="v-pills-stage5-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button" type="button" class="btn btn-success stage5add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage5">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefiveqty[]" id="stagefiveqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefiveunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stagefivedesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefiverate[]" class="rate" id="stagefiverate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefiveper[]" >
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagefiveamt[]" class="amt" id="stagefiveamt1">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stage6" role="tabpanel" aria-labelledby="v-pills-stage6-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button" type="button" class="btn btn-success stage6add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage6">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesixqty[]" id="stagesixqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesixunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stagesixdesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesixrate[]" class="rate" id="stagesixrate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesixper[]" >
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesixamt[]" class="amt" id="stagesixamt1">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stage7" role="tabpanel" aria-labelledby="v-pills-stage7-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button"  class="btn btn-success stage7add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage7">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesevenqty[]" id="stagesevenqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesevenunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stagesevendesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesevenrate[]" class="rate" id="stagesevenrate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesevenper[]" >
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagesevenamt[]" class="amt" id="stagesevenamt1">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stage8" role="tabpanel" aria-labelledby="v-pills-stage8-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button"  class="btn btn-success stage8add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage8">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stageeightqty[]" id="stageeightqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stageeightunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stageeightdesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stageeightrate[]" class="rate" id="stageeightrate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stageeightper[]" >
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stageeightamt[]" class="amt" id="stageeightamt1">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stage9" role="tabpanel" aria-labelledby="v-pills-stage9-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button" type="button" class="btn btn-success stage9add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage9">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagenineqty[]" id="stagenineqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagenineunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stageninedesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stageninerate[]" class="rate" id="stageninerate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagenineper[]" >
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagenineamt[]" class="amt" id="stagenineamt1">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stage10" role="tabpanel" aria-labelledby="v-pills-stage10-tab">
                                        <div class="container mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive-lg">

                                                                <table class="table table-bordered" style="overflow-x:scroll">
                                                                    <thead>
                                                                        <tr>
                                                                            {{-- <th style="width:150px">S.No</th> --}}
                                                                            <th style="width:150px">Qty</th>
                                                                            <th style="width:150px">Unit</th>
                                                                            <th style="width:500px">Description of Work</th>
                                                                            <th style="width:200px">Rate</th>
                                                                            <th style="width:150px">Per</th>
                                                                            <th style="width:300px">Amount</th>
                                                                            <th ><button type="button" class="btn btn-success stage10add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="stage10">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenqty[]" id="stagetenqty1" class="qty">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenunit[]">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <textarea class="form-control" name="stagetendesc[]"></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenrate[]" class="rate" id="stagetenrate1">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-input mt-3">
                                                                                    <input type="text" name="stagetenper[]" >
                                                                                </div>
                                                                            </td>
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
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="v-pills-finalreport" role="tabpanel" aria-labelledby="v-pills-finalreport-tab">...</div> --}}
                                  </div>
                            </div>
                        </div>
                    </div>


                  </div>

            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Estimates</button>
            </div>

          </div>
            </form>
        </div>
      </div>


@endsection
