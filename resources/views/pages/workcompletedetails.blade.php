@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>

        <div class="container-fluid mt-3">
            <div class="col-lg-9">
                <h4 class="section-heading">Completion of Works</h4>
            </div>
            <div class="row">
                @if ($estimaterequests == '')
                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @elseif($estimaterequests->estimate_id == null)
                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @else
                    <div class="col-lg-4">
                        <div class="nav flex-column  nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @if ($stages = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->groupBy('stage_num')->get())
                            @php $i=1; @endphp
                                @foreach ($stages as $splitestimate)
                                    <button class="nav-link text-left" id="v-pills-{{ $splitestimate->stage_num }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $splitestimate->stage_num }}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        Stage @php echo $i++ @endphp -
                                        @if($stagetitle = App\Models\stagemaster::where('stageid',$splitestimate->stage_num)->first())
                                            {{ $stagetitle->stagename }}
                                        @endif
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="tab-content" id="v-pills-tabContent">

                                @if ($estimaterequests == '')
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @elseif($estimaterequests->estimate_id == null)
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @else

                                    @if ($stage = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->groupBy('stage_num')->get())

                                            @foreach ($stage as $s)

                                            <div class="tab-pane fade show " id="v-pills-{{ $s->stage_num }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                @if(Auth::user()->usertype == '3')
                                                    <div class="row">
                                                        @if($completionofworks = App\Models\completionofwork::where('estid',$s->estid)->where('stageid',$s->stage_num)->where('allimages_status',1)->get())

                                                            @if($completionofworks->count() == 0)
                                                                <div class="col-lg-12">
                                                                    <div class="clientdetailsbox imageupload" data-clientid = {{ $clientid }} data-estid = {{ $s->estid }} data-stageid ="{{ $s->stage_num }}" data-ae="{{ $estimaterequests->engineerid }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                        <div class="clientcontent">
                                                                            <div class="clienticons">
                                                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                                <img src="/assets/images/estimates.svg" class="img-fluid">
                                                                            </div>
                                                                            <h5 class="text-center mt-3">Upload Image</h5>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <button class="btn btn-success m-auto d-block allimagesupload" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}">All images uploaded</button>
                                                                </div>
                                                                @else
                                                                <div class="alert alert-success" role="alert">
                                                                    {{ $s->stage_num }} Approved all images please proceed next stage...
                                                                  </div>
                                                            @endif
                                                        @endif
                                                        {{-- <div class="col-lg-12">
                                                            <div class="clientdetailsbox imageupload" data-clientid = {{ $clientid }} data-estid = {{ $s->estid }} data-stageid ="{{ $s->stage_num }}" data-ae="{{ $estimaterequests->engineerid }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <div class="clientcontent">
                                                                    <div class="clienticons">
                                                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                        <img src="/assets/images/estimates.svg" class="img-fluid">
                                                                    </div>
                                                                    <h5 class="text-center mt-3">Upload Image</h5>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button class="btn btn-success m-auto d-block allimagesupload" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}">All images uploaded</button>
                                                        </div> --}}

                                                </div>
                                                @endif

                                                <div class="row mt-5">
                                                    @if ($completeimage = App\Models\completionofwork::where('estid',$estimaterequests->estimate_id)->where('stageid',$s->stage_num)->get())
                                                        @foreach ($completeimage as $img)
                                                            <div class="col-lg-4">
                                                                <div class="imgbox" >

                                                                @if(Auth::user()->usertype == '4')
                                                                        @if($img->image_status == 0)
                                                                            <img src="/assets/images/processingimg.svg" class="img-fluid img-thumbnail mt-3">
                                                                            @else
                                                                            <img src="/images/{{ $img->imagenames }}" class="img-fluid img-thumbnail mt-3">
                                                                        @endif
                                                                    @else
                                                                    <img src="/images/{{ $img->imagenames }}" data-imgname="{{ $img->imagenames }}" class="viewimg img-fluid img-thumbnail mb-2">
                                                                        @if ($img->image_status == '1')
                                                                            <span class="badge bg-success" style="margin:10px auto;display:block;width:120px">RM Approved</span>
                                                                        @endif
                                                                        @if ($img->client_status == '1')
                                                                        <span class="badge bg-success" style="margin:10px auto;display:block;width:120px">Client Approved</span>
                                                                    @endif
                                                                        @if ($img->image_status == '2')
                                                                            <span class="badge bg-danger" style="margin:10px auto;display:block;width:120px">RM Reject</span>
                                                                        @endif
                                                                        @if ($img->client_status == '2')
                                                                        <span class="badge bg-danger" style="margin:10px auto;display:block;width:120px">Client Reject</span>
                                                                    @endif
                                                                        @if ($img->image_status == '0')
                                                                            <span class="badge bg-primary" style="margin:10px auto;display:block;width:120px">RM Pending</span>
                                                                        @endif
                                                                        @if ($img->client_status == '0')
                                                                        <span class="badge bg-primary" style="margin:10px auto;display:block;width:120px">Client Pending</span>
                                                                    @endif

                                                                    @if(Auth::user()->usertype == '8')
                                                                        <div class="text-center">

                                                                        <button class="btn btn-success approveimg" data-id="{{ $img->id }}" ><i class="fa fa-check" aria-hidden="true"></i></button>
                                                                        <button class="btn btn-danger rejectimg" data-id="{{ $img->id }}"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                                                    </div>
                                                                    @endif


                                                                @endif
                                                                 </div>
                                                                @if($img->image_status != 0)
                                                                @if(Auth::user()->usertype == '4')

                                                                <div class="text-center mt-3">
                                                                    @if ($img->client_status == '1')
                                                                        <span class="badge bg-success"  style="margin:10px auto;display:block;width:120px">Client Approved</span>
                                                                    @endif
                                                                    @if ($img->client_status == '2')
                                                                    <span class="badge bg-danger" style="margin:10px auto;display:block;width:120px">Client Reject</span>
                                                                    @endif
                                                                    @if ($img->client_status == '0')
                                                                        <span class="badge bg-primary" style="margin:10px auto;display:block;width:120px">Client Pending</span>
                                                                    @endif
                                                                    {{-- {{ $img->client_status }} --}}
                                                                    <button class="btn btn-success clientapproveimg" data-id="{{ $img->id }}" ><i class="fa fa-check" aria-hidden="true"></i></button>
                                                                    <button class="btn btn-danger clientrejectimg" data-id="{{ $img->id }}"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                                                </div>
                                                                @endif
                                                                @endif


                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>


                                            </div>
                                            @endforeach

                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>


                @endif

            </div>
        </div>
    </section>




      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <form name="imageupload" id="imageupload" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Image Upload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              {{-- <button type="button" class="close" data-bs-toggle="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> --}}
            </div>
            <div class="modal-body">

                    <div class="form-input">
                        <label for="">Estimate ID</label><span class="text-danger">*</span><br>
                        {{-- <select class="form-control" name="clientcode" required>
                            <option value="">-- Choose Client Code --</option>

                        </select> --}}
                        <input type="hidden" name="clientcode" class="form-control" id="clientcode" readonly>
                        <input type="text" name="estid" style="width: 100%" id="estid"  readonly>
                    </div>
                    <div class="form-input mt-3">
                        <label for="">Stage ID</label><span class="text-danger">*</span><br>
                        <input type="hidden" name="engineercode" style="width: 100%" id="engineercode"  readonly>
                        <span class="error-text password_error"></span>

                        <input type="text" name="stageid" style="width: 100%" id="stageid"  readonly>
                    </div>
                    <label for="">Upload Image</label><span class="text-danger" style="margin-top:30px">*</span><br>
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <input type="file" class="form-control" name="completeimages[]" accept="image/png, image/jpg, image/jpeg" style="width: 100%" id="enddate">
                            </td>
                            <td>
                                <button type="button" class="btn btn-success imgadd"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        <tbody id="viewimage">

                        </tbody>
                    </table>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload Images</button>
            </div>
          </div>
        </form>
        </div>
      </div>


      <div class="modal fade" id="viewimagelarge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Work Completed Image</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="" class="img-fluid" id="showimg">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
      </div>
@endsection
