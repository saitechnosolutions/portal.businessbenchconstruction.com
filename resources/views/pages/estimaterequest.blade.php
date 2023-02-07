@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-lg-6">
                            <h4 class="section-heading">Main Estimate Request</h4>
                        </div>

                        <div class="col-lg-6">
                            {{-- <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#estimatereq">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimate Request
                              </button> --}}
                              {{-- <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createLead">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Estimate
                              </button> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered mt-4" id="example1">
                                    <thead>
                                        <th>Date</th>
                                        <th>Engineer ID</th>
                                                                        <th>Client ID</th>
                                                                        <th>Status</th>
                                                                        <th>Create Estimate</th>
                                                                        <th>Actions</th>
                                                                        <th>View Design</th>

                                                                        @if(Auth::user()->usertype == '13')
                                                                            <th>Assigned to</th>
                                                                        @endif
                                    </thead>
                                    <tbody id="clientstable">
                                        @foreach ($estimatereq as $est)
                                         <tr>
                                            <td>{{ $est->created_at }}</td>
                                            <td>{{ $est->engineerid }}</td>
                                            <td>{{ $est->clientid }}</td>
                                            <td class="text-center">
                                                @if($est->admin_status == 0)
                                                    <span class="badge bg-danger" style="width:120px">Processing</span>
                                                @elseif($est->admin_status == 1)
                                                    <span class="badge bg-primary" style="width:120px">Estimate Created</span>
                                                    @elseif($est->admin_status == 2)
                                                    <span class="badge bg-success" style="width:120px">Client Approved</span>
                                                    @elseif($est->admin_status == 3)
                                                    <span class="badge bg-success" style="width:150px">QS Head/GM Approved</span>
                                                    @elseif($est->admin_status == 4)
                                                    <span class="badge bg-success" style="width:120px">AE Approve</span>
                                                    @elseif($est->admin_status == 5)
                                                    <span class="badge bg-success" style="width:120px">AE Reject</span>
                                                    @elseif($est->admin_status == 6)
                                                    <span class="badge bg-success" style="width:120px">Client Reject</span>
                                                @endif
                                            </td>

                                                                        <td>
                                                                            <div class="d-flex justify-content-center">
                                                                                @if($est->admin_status == 1 || $est->admin_status == 2)
                                                                                <a style="margin-right:10px;pointer-events:none" href="/createmainest/{{ $est->engineerid }}/{{ $est->clientid }}" class="btn btn-success" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                                                <a data-bs-toggle="modal" style="margin-right:10px;pointer-events:none" data-engid="{{ $est->engineerid }}" data-clientid="{{ $est->clientid }}" data-bs-target="#uploadestimate" class="btn btn-primary createbtn" ><i class="fa fa-upload" aria-hidden="true" ></i></a>
                                                                                @else
                                                                                <a style="margin-right:10px" href="/createmainest/{{ $est->engineerid }}/{{ $est->clientid }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                                                <a data-bs-toggle="modal" data-engid="{{ $est->engineerid }}" data-clientid="{{ $est->clientid }}" data-bs-target="#uploadestimate" class="btn btn-primary createbtn"><i class="fa fa-upload" aria-hidden="true" ></i></a>
                                                                                @endif

                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex justify-content-center">
                                                                                @if($est->estimate_id == '')
                                                                                    <span class="badge bg-danger mt-2">No data</span>
                                                                                    @else
                                                                                    <a style="width:50px;color:#fff" href="/editestimate/{{ $est->estimate_id }}" class="btn btn-info m-auto d-block"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                                    <a style="width:50px;color:#fff" href="/estimatedetails/{{ $est->engineerid }}/{{ $est->clientid }}" class="btn btn-info m-auto d-block"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                @endif



                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            @if($leaddetails = App\Models\Drawing::where('leadid',$est->leadid)->first())
                                                                                <a style="width:50px;color:#fff" href="/uploaddraw/{{$leaddetails->drawid}}/{{$leaddetails->packagetype}}/{{$leaddetails->leadid}}" class="btn btn-info m-auto d-block"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                            @endif

                                                                        </td>
                                                                        @if(Auth::user()->usertype == '13')
                                                                            <td>
                                                                                 @if($est->assigned_to == null)
                                                                                    <button class="btn btn-primary text-white quantityallocation" data-estid="{{$est->id}}"><i class="fa fa-users" aria-hidden="true"></i></button>
                                                                                        @else
                                                                                    <span class="badge bg-success">{{$est->assigned_to}}</span>
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

    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-heading">Additional Estimate Request</h4>
                </div>
                <div class="col-lg-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table  mt-4" id="example2">
                                    <thead>
                                        <th>Date</th>
                                        <th>Engineer ID</th>
                                                                        <th>Client ID</th>
                                                                        <th>Additional Estimate ID</th>
                                                                        <th>AE Estimate</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>

                                    </thead>
                                    <tbody id="clientstable">
                                        @if ($additionalestmasters)
                                            @foreach ($additionalestmasters as $est)
                                                <tr>
                                                    <td>{{ $est->created_at }}</td>
                                                    <td>{{ $est->engineerid }}</td>
                                                    <td>{{ $est->clientid }}</td>
                                                    <td>{{ $est->additionalestid }}</td>
                                                    <td>
                                                        <a href="/additionalestview/{{$est->additionalestid}}" class="btn btn-info text-white"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                        @if($est->approval_status == '1')
                                                            <span class="badge bg-info">AE Raise Additional Estimate</span>
                                                        @endif
                                                        @if($est->approval_status == '2')
                                                            <span class="badge bg-info " >QS Providing the quote</span>
                                                        @endif
                                                        @if($est->approval_status == '3')
                                                            <span class="badge bg-info " >QS Head/GM Approved</span>
                                                        @endif
                                                        @if($est->approval_status == '4')
                                                            <span class="badge bg-info " >AE Approved</span>
                                                        @endif
                                                        @if($est->approval_status == '5')
                                                            <span class="badge bg-info " >Client Approved Estimate</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(Auth::user()->usertype == '11' || Auth::user()->usertype == '13')
                                                            {{-- {{ $est->approval_status }} --}}
                                                            @if($est->approval_status < 3)
                                                                <button class="btn btn-warning approveaddnest" data-clientid="{{ $est->clientid }}" data-addiestid="{{ $est->additionalestid }}">Approve</button>
                                                                @else
                                                                <button class="btn btn-warning" >Approved</button>
                                                            @endif

                                                            {{-- <a href="/uploadaddtionalest/{{$est->additionalestid}}" class="btn btn-info text-white"><i class="fa fa-plus" aria-hidden="true"></i></a> --}}
                                                        @endif

                                                        @if(Auth::user()->usertype == '7')
                                                        @if ($estcreate = App\Models\additionalestmaster::where('additionalestid',$est->additionalestid)->get())
                                                            @if($estcreate->count() == 0)
                                                                <a href="/uploadaddtionalest/{{$est->additionalestid}}" class="btn btn-info text-white"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                                @else

                                                            @endif
                                                        @endif
                                                        <a href="/qsadditionalestview/{{$est->additionalestid}}" class="btn btn-info text-white"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <a href="/editaddtionalest/{{$est->additionalestid}}" class="btn btn-info text-white"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                        @endif

                                                    </td>
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
    </section>


      <div class="modal fade" id="estimatereq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                        {{-- <select class="form-control" name="clientcode" required>
                            <option value="">-- Choose Client Code --</option>

                        </select> --}}
                        <input type="text" name="clientcode" class="form-control" value="" readonly>
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

      <div class="modal fade" id="uploadestimate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="estimatebulkupload" id="estimatebulkupload" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Estimate</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" class="estid" name="estid" placeholder="Estimate ID" value="{{ $estimateid }}" readonly>
                <input type="file" class="form-control mt-3" name="estimate_import">
                <input type="text" class="form-control mt-3" name="engid" id="engid" readonly>
                <input type="text" class="form-control mt-3" name="clientid" id="clientid" readonly>
                <div class="alert alert-warning mt-3" role="alert">
                    Note : Once Upload the Estimate check your Engineer ID & Client ID
                  </div>
            </div>

            <div class="modal-footer">
                <a href="/import_excel/estimateimport.csv" download class="btn btn-success">Download Sample</a>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload Estimate</button>
            </div>
          </div>
        </form>
        </div>
      </div>

 <div class="modal fade" id="assignquantitysurveyor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="assignquantity" id="assignquantity" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Assign Quantity Surveyor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">


                <div class="form-input mt-3">
                    <label for="">Select Quantity Surveyor</label><span class="text-danger">*</span><br>
                    <select class="form-control" name="quantitysurveyorname">

                        <option>-- Choose Quantity Surveyor --</option>
                        @if($quantitysurveyor)
                             @foreach ($quantitysurveyor as $archi)
                             <option value="{{ $archi->userid }}">{{ $archi->name }}</option>
                         @endforeach
                        @endif

                    </select>
                </div>

                <input type="hidden" name="surveyorid" id="surveyorid">
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
