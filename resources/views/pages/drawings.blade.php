@extends('layout.app')
@section('title','Drawings')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-9">
                            <h4 class="section-heading">Drawings List</h4>
                        </div>
                        <div class="col-lg-3">
                            @if(Auth::user()->usertype == 3)
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createDrawings">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Upload Drawings
                              </button>
                            @endif



                        </div>
                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive">

                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Client ID</th>
                                                    <th>Lead ID</th>
                                                    <th>Name</th>
                                                    <th>Drawing ID</th>
                                                    <th>AE Upload File</th>
                                                    @if(Auth::user()->usertype != '14')
                                                        <th>Architect Status</th>
                                                    @endif

                                                    @if(Auth::user()->usertype != '3' && Auth::user()->usertype != '4')
                                                       <th>Upload</th>
                                                       @elseif(Auth::user()->usertype == '3' || Auth::user()->usertype == '4')
                                                       <th>Architec Upload File</th>

                                                    @endif
                                                    @if(Auth::user()->usertype == '14')
                                                        <th>Assigned to</th>
                                                    @endif
                                                    @if(Auth::user()->usertype == '18')
                                                        <th>Assigned to</th>
                                                    @endif

                                                </tr>
                                            </thead>

                                            <tbody id="clientstable">

                                                @foreach ($getdrawings as $draw)
                                                    <tr>
                                                        <td>@if($draw->clientid == null) <span class="badge bg-secondary">Client ID N/A</span> @else {{ $draw->clientid }} @endif</td>
                                                        <td>{{ $draw->leadid }}</td>
                                                        <td>
                                                            @if ($getdrawname = App\Models\Client::where('leadid',$draw->leadid)->first())
                                                                {{ $getdrawname->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $draw->drawid }}</td>
                                                        <td><a href="/images/{{ $draw->drawimage }}" download>Download</a></td>
                                                        <td>
                                                            @if($draw->status == null)
                                                                <span class="badge bg-danger" style="width:140px">Processing</span>
                                                                @else
                                                                <span class="badge bg-success" style="width:140px">All Drawing Uploaded</span>
                                                            @endif
                                                        </td>
                                                        @if(Auth::user()->usertype != '14')
                                                         <td>
                                                            @if($draw->clientid == null)
                                                                @if($draw->status == null)
                                                                    <button data-clientid="{{ $draw->clientid }}" data-leadid="{{$draw->leadid}}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw w-100"  data-bs-toggle="modal" data-bs-target="#replyDrawingsmodal"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload</button>
                                                                    @else
                                                                    <button data-clientid="{{ $draw->clientid }}" data-leadid="{{$draw->leadid}}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw w-100" >&nbsp;&nbsp;File Uploaded</button>
                                                                @endif

                                                                @else
                                                                @if($draw->status == null)
                                                                    <a href="uploaddraw/{{ $draw->drawid }}/{{ $draw->packagetype }}/{{ $draw->leadid }}" data-leadid="{{ $draw->leadid }}" data-package="{{ $draw->packagetype }}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw"  ><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload</a>
                                                                    @else
                                                                    <a href="uploaddraw/{{ $draw->drawid }}/{{ $draw->packagetype }}/{{ $draw->leadid }}" data-leadid="{{ $draw->leadid }}" data-package="{{ $draw->packagetype }}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw"  ><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View</a>
                                                                @endif

                                                            @endif


                                                        </td>
                                                    @endif

                                                         @if(Auth::user()->usertype == '14')
                                                       <td>
                                                        @if($draw->assigned_to == null)
                                                            <button class="btn btn-primary text-white assignedtoarchitect" data-drawid={{ $draw->drawid }}><i class="fa fa-users" aria-hidden="true"></i></button>
                                                            @else
                                                            @if($name = App\Models\User::where('userid','=',$draw->assigned_to)->first())
                                                                <span class="badge bg-success">Assigned to {{$name->name}}</span>
                                                            @endif

                                                        @endif

                                                         </td>
                                                    @endif

                                                    @if(Auth::user()->usertype == '18')
                                                       <td>
                                                        @if($draw->assign_to_strceng == null)
                                                            <button class="btn btn-primary text-white assignedtostructuraleng" data-drawid={{ $draw->drawid }}><i class="fa fa-users" aria-hidden="true"></i></button>
                                                            @else
                                                             @if($name = App\Models\User::where('userid','=',$draw->assign_to_strceng)->first())
                                                                <span class="badge bg-success">Assigned to {{$name->name}}</span>
                                                            @endif
                                                            <!--<span class="badge bg-success">Assigned to {{$draw->assign_to_strceng}}</span>-->
                                                        @endif

                                                         </td>
                                                    @endif


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

                </div>
            </div>
        </div>
    </section>

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

                <div class="form-input">
                    <label for="">Client ID</label><span class="text-danger">*</span><br>
                    <select class="form-control" name="clientid">
                        <option>-- Select Client --</option>
                        @foreach ($getclients as $clients)
                            <option value="{{ $clients->clientcode }}">{{ $clients->clientcode }}</option>
                        @endforeach
                    </select>
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Engineer ID</label><span class="text-danger">*</span><br>
                    <input type="text" name="engineerid" style="width: 95%" id="engineerid" value="@if(Auth::user()->usertype == '3') {{ Auth::user()->userid }} @else @endif"  readonly>
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Package Type</label><span class="text-danger">*</span><br>
                    <select class="form-control" name="package">
                        <option>-- Choose Package Type --</option>
                        <option value="Basic">Basic</option>
                        <option value="Standard">Standard</option>
                        <option value="Premium">Premium</option>
                    </select>
                </div>
                <div class="form-input mt-3">
                    <label for="">Upload Drawing File</label><span class="text-danger">*</span><br>
                    <input type="file" name="drawimage" style="width: 95%" id="drawimage" required accept="application/pdf">
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

      <div class="modal fade" id="replyDrawingsmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="replyDrawings" id="replyDrawings" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Drawings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="form-input">
                    <label for="">Lead ID</label><span class="text-danger">*</span><br>
                    <input type="text" name="replyclientid" style="width: 95%" id="replyclientid"  readonly>
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Engineer ID</label><span class="text-danger">*</span><br>
                    <input type="text" name="replyengid" style="width: 95%" id="replyengid"  readonly>
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Upload Drawing File</label><span class="text-danger">*</span><br>
                    <input type="file" name="officesededimage" style="width: 95%" id="officesededimage" accept="application/pdf">
                    <span class="error-text name_error"></span>
                </div>
                <input type="hidden" name="replydraw" id="drawid">
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload</button>
            </div>

          </div>
            </form>
        </div>
      </div>

      <div class="modal fade" id="assigndraw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="assigndraw" id="assigndrawing" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Drawings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">


                <div class="form-input mt-3">
                    <label for="">Select Architect</label><span class="text-danger">*</span><br>
                    <select class="form-control" name="architect">

                        <option>-- Choose Architect --</option>
                        @if($getartect)
                             @foreach ($getartect as $archi)
                             <option value="{{ $archi->userid }}">{{ $archi->name }}</option>
                         @endforeach
                        @endif

                    </select>
                </div>

                <input type="hidden" name="drawid" id="drawid1">
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Assign the Project</button>
            </div>

          </div>
            </form>
        </div>
      </div>

      <div class="modal fade" id="assigndraw2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="assignstructuraleng" id="assignstructuraleng" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Drawings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">


                <div class="form-input mt-3">
                    <label for="">Select Structural Engineer</label><span class="text-danger">*</span><br>
                    <select class="form-control" name="structuraleng">

                        <option>-- Choose Structural Engineer --</option>
                        @if($getstructuraleng)
                             @foreach ($getstructuraleng as $archi)
                             <option value="{{ $archi->userid }}">{{ $archi->name }}</option>
                         @endforeach
                        @endif

                    </select>
                </div>

                <input type="hidden" name="drawid" id="drawid2">
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Assign the Project</button>
            </div>

          </div>
            </form>
        </div>
      </div>
@endsection
