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
                            <h4 class="section-heading">Drawings Request Details</h4>
                        </div>
                        <div class="col-lg-3">
                            @if(Auth::user()->usertype == 3)
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createDrawings">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Send Drawing Request
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
                                                    <th>Engineer ID</th>
                                                    <th>Drawing ID</th>
                                                    <th>AE Upload File</th>
                                                    <th>Architecture Status</th>
                                                    @if(Auth::user()->usertype != '3' && Auth::user()->usertype != '4')
                                                       <th>Upload</th>
                                                       @elseif(Auth::user()->usertype == '3' || Auth::user()->usertype == '4')
                                                       <th>Architecture Upload File</th>
                                                    @endif
                                                </tr>
                                            </thead>

                                            <tbody id="clientstable">

                                                @foreach ($drawdetails as $draw)
                                                    <tr>
                                                        <td>{{ $draw->clientid }}</td>
                                                        <td>{{ $draw->engineerid }}</td>
                                                        <td>{{ $draw->drawid }}</td>
                                                        <td><a target="_blank" href="/images/{{ $draw->drawimage }}" >View</a></td>
                                                        <td @if(Auth::user()->usertype=='4') data-title="Drawing Status" data-intro="Check your drawing status once all drawing uploaded click the view button" @endif>

                                                            @if($draw->status == '0' || $draw->status == null)
                                                                <span class="badge bg-danger" style="width:140px">Processing</span>
                                                                @else
                                                                <span class="badge bg-success" style="width:140px">All Drawing Uploaded</span>
                                                            @endif
                                                        </td>
                                                        @if(Auth::user()->usertype != '3' && Auth::user()->usertype != '4')
                                                        <td>
                                                        {{-- <button data-clientid="{{ $draw->clientid }}" data-package="{{ $draw->packagetype }}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw"  data-bs-toggle="modal" data-bs-target="#replyDrawingsmodal"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload</button> --}}
                                                        <a href="/uploaddraw/{{ $draw->drawid }}/{{ $draw->packagetype }}/{{ $draw->leadid }}" data-clientid="{{ $draw->clientid }}" data-package="{{ $draw->packagetype }}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw"  ><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload</a>
                                                    </td>
                                                    @elseif(Auth::user()->usertype == '3' || Auth::user()->usertype == '4')
                                                    <td>
                                                        <a href="/uploaddraw/{{ $draw->drawid }}/{{ $draw->packagetype }}/{{ $draw->leadid }}" data-clientid="{{ $draw->clientid }}" data-package="{{ $draw->packagetype }}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw"  ><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View </a>

                                                         {{-- <a href="uploaddraw/{{ $draw->drawid }}/{{ $draw->packagetype }}/{{ $draw->clientid }}" data-clientid="{{ $draw->clientid }}" data-package="{{ $draw->packagetype }}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw"  ><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View </a> --}}
                                                    </td>
                                                        @endif
                                                        {{-- <td>
                                                            @if($draw->officesededimage == '')
                                                                <span class="badge bg-danger" style="width:130px">Processing</span>
                                                                @else
                                                                <a href="/images/{{ $draw->officesededimage }}" style="width:130px;color:#fff" download class="badge bg-success">Download</a>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <button data-clientid="{{ $draw->clientid }}" data-drawid="{{ $draw->drawid }}" data-engineerid="{{ $draw->engineerid }}" class="m-auto d-block btn btn-primary btn-sm uploaddraw"  data-bs-toggle="modal" data-bs-target="#replyDrawingsmodal"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload</button>
                                                        </td> --}}


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
                    <input type="text" name="clientid" style="width: 95%" id="clientid" value="{{ $id }}"  readonly>
                    @if($leadid = App\Models\Client::where('clientcode',$id)->first())
                    <input type="hidden" name="leadid" value="{{ $leadid->leadid }}">
                    @endif

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
                        <option value="Luxury">Luxury</option>
                        <option value="Labour">Labour</option>
                    </select>
                </div>
                <div class="form-input mt-3">
                    <label for="">Upload Drawing File</label><span class="text-danger">*</span><br>
                    <input type="file" name="drawimage" style="width: 95%" id="drawimage" accept="application/pdf" required>
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
        <div class="modal-dialog modal-fullscreen">
            <form name="replyDrawings" id="replyDrawings" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Drawings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="form-input">
                    <label for="">Client ID</label><span class="text-danger">*</span><br>
                    <input type="text" name="replyclientid" style="width: 95%" id="replyclientid"  >
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Engineer ID</label><span class="text-danger">*</span><br>
                    <input type="text" name="replyengid" style="width: 95%" id="replyengid"  >
                    <span class="error-text name_error"></span>
                </div>
                <div class="form-input mt-3">
                    <label for="">Upload Drawing File</label><span class="text-danger">*</span><br>
                    <input type="file" name="officesededimage" style="width: 95%" id="officesededimage">
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
@endsection
