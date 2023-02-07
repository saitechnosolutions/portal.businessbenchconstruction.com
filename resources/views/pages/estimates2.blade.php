@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @if(Auth::user()->usertype != '4')
                        <div class="col-lg-9">
                            <h4 class="section-heading">Estimates List</h4>
                        </div>
                        @endif

                        <div class="col-lg-3">
                            @if(Auth::user()->usertype == '3')
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#sendEstimaterequest">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Send Estimate Request
                              </button>
                              @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Requests</button>
                                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Uploaded</button>

                                  </div>
                            </div>
                            <div class="col-lg-10">

                                {{-- AE Page Estimate Request --}}


                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="userdetails">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>

                                                            <th>Engineer ID</th>
                                                            <th>Client ID</th>
                                                            <th>Admin Status</th>

                                                            @if(Auth::user()->usertype == '1' || Auth::user()->usertype == '2')
                                                                <th>Create Main Estimates</th>
                                                            @endif
                                                            @if(Auth::user()->usertype == '1' || Auth::user()->usertype == '2')
                                                                <th>Create Master Estimates</th>
                                                            @endif

                                                        </tr>
                                                    </thead>
                                                    <tbody id="clientstable">
                                                        @foreach ($estimaterequest as $est)
                                                        <tr>

                                                            <td>{{ $est->engineerid }}</td>
                                                            <td>{{ $est->clientid }}</td>
                                                            <td>
                                                                @if($est->admin_status == 0)

                                                                    <span class="badge bg-danger">Pending</span>

                                                                @else

                                                                    <span class="badge bg-success">Uploaded</span>

                                                                @endif
                                                            </td>
                                                            @if(Auth::user()->usertype == '1' || Auth::user()->usertype == '2')
                                                            <td>
                                                                <a style="width:50px" href="/createmainest/{{ $est->engineerid }}/{{ $est->clientid }}" class="btn btn-success m-auto d-block"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                            </td>
                                                            @endif
                                                            @if(Auth::user()->usertype == '1' || Auth::user()->usertype == '2')
                                                            <td>
                                                                <a style="width:50px" href="createmasterest/{{ $est->engineerid }}/{{ $est->clientid }}" class="btn btn-success m-auto d-block"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                            </td>
                                                        @endif


                                                        </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">


                                    </div>

                                  </div>




                            </div>
                        </div>
                    </div>





    </section>



      <div class="modal fade" id="sendEstimaterequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                        <select class="form-control" name="clientcode" required>
                            <option value="">-- Choose Client Code --</option>
                            @if($getclients = App\Models\Client::where('engineercode',$userid)->get())
                                @foreach ($getclients as $clients)
                                    <option value="{{ $clients->clientcode }}">{{ $clients->clientcode }}</option>
                                @endforeach
                            @endif
                        </select>
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

      <div class="modal fade" id="createestimatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content ">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Select Estimate Type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <button type="submit" class="btn btn-success createmainest"  style="width:270px;margin-bottom:20px">
                        Create Main Estimate For Client
                    </button>
                </form>
                <form>
                    <button type="submit" class="btn btn-success createmasterest" style="width:270px">
                        Create Master Estimate For AE
                      </a>
                </form>

            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
          </div>
        </div>
      </div>
@endsection
