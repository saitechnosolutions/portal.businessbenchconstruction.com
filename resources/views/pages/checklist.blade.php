@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>

        <div class="container-fluid mt-3">
            <div class="col-lg-9">
                <h4 class="section-heading">Checklist</h4>
            </div>
            <div class="row">
                @if ($estimaterequests == '')
                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @elseif($estimaterequests->estimate_id == null)
                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                    @else
                    <div class="col-lg-3">
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

                    <div class="col-lg-9">
                        <div class="tab-content" id="v-pills-tabContent">

                                @if ($estimaterequests == '')
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @elseif($estimaterequests->estimate_id == null)
                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:500px">
                                    @else

                                    @if ($stage = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->groupBy('stage_num')->get())

                                            @foreach ($stage as $s)

                                            <div class="tab-pane fade show " id="v-pills-{{ $s->stage_num }}" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                                <div class="row">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Description</th>
                                                                <th>Status</th>
                                                                <th>Comments</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($stages = App\Models\Stage::where('estid',$estimaterequests->estimate_id)->where('stage_num',$s->stage_num)->get())
                                                                @foreach ($stages as $st)
                                                                    <tr>
                                                                        <td>{{ $st->descriptions }}</td>
                                                                        <td>
                                                                            @if(Auth::user()->usertype == '4' || Auth::user()->usertype == '3')
                                                                                @if($st->completed_status == '0')
                                                                                    <span class="badge bg-primary checkstatus" style="width:100px;cursor:pointer" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}" data-status="0" >Review Pending</span>
                                                                                @endif
                                                                                @else
                                                                                @if($st->completed_status == '0')
                                                                                    <span class="badge bg-primary checkstatus" style="width:100px;cursor:pointer" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}" data-status="0" data-bs-toggle="modal" data-bs-target="#checkliststatus">Review Pending</span>
                                                                                @endif
                                                                            @endif

                                                                            @if(Auth::user()->usertype == '4' || Auth::user()->usertype == '3')
                                                                                    @if($st->completed_status == '1')
                                                                                        <span class="badge bg-success checkstatus" style="width:100px;cursor:pointer" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}" data-status="1" >Completed</span>
                                                                                    @endif
                                                                                @else
                                                                                @if($st->completed_status == '1')
                                                                                    <span class="badge bg-success checkstatus" style="width:100px;cursor:pointer" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}" data-status="1" data-bs-toggle="modal" data-bs-target="#checkliststatus">Completed</span>
                                                                                @endif
                                                                            @endif

                                                                            @if(Auth::user()->usertype == '4' || Auth::user()->usertype == '3')
                                                                                @if($st->completed_status == '2')
                                                                                    <span class="badge bg-danger checkstatus" style="width:100px;cursor:pointer" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}" data-status="2">Rejected</span>
                                                                                @endif
                                                                                @else
                                                                                @if($st->completed_status == '2')
                                                                                    <span class="badge bg-danger checkstatus" style="width:100px;cursor:pointer" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}" data-status="2" data-bs-toggle="modal" data-bs-target="#checkliststatus">Rejected</span>
                                                                                @endif
                                                                            @endif



                                                                        </td>
                                                                        <td>

                                                                            @if(Auth::user()->usertype == '8')
                                                                                <button class="btn btn-primary addcomments" data-bs-toggle="modal" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}" data-bs-target="#addComments"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                            @endif

                                                                            <button class="btn btn-primary viewcomments" data-bs-toggle="modal" data-bs-target="#viewComments" data-descnum="{{ $st->id }}" data-stageid="{{ $s->stage_num }}" data-estid="{{ $estimaterequests->estimate_id }}" data-clientid="{{ $clientid }}"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            @endif
                                                        </tbody>

                                                    </table>


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




      <div class="modal fade" id="addComments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <form name="savecomments" id="savecomments" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Comments</h5>
              <button type="button" class="close" data-bs-toggle="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                    <div class="form-input">
                        {{-- <label for="">Estimate ID</label><span class="text-danger">*</span><br> --}}
                        {{-- <select class="form-control" name="clientcode" required>
                            <option value="">-- Choose Client Code --</option>

                        </select> --}}
                        <input type="hidden" name="clientcode" class="form-control" id="clientcode" readonly>
                        <input type="hidden" name="estid" style="width: 100%" id="estid"  readonly>
                    </div>
                    <div class="form-input mt-3">



                        <input type="hidden" name="stageid" style="width: 100%" id="stageid"  readonly>
                        <input type="hidden" name="descid" style="width: 100%" id="descid"  readonly>
                        <textarea class="form-control" style="height:200px" name="checklistdesc" placeholder="Write your comments...."></textarea>
                    </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Comments</button>
            </div>
          </div>
        </form>
        </div>
      </div>


      <div class="modal fade" id="viewcomments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Comments</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody id="commentsdata">

                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="checkliststatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form name="updatestatus" id="updatestatus" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-input">

                    <input type="hidden" name="clientcode" class="form-control clientcode" id="clientcode" readonly>
                    <input type="hidden" name="estid" class="estid" style="width: 100%" id="estid"  readonly>

                </div>
                <div class="form-input mt-3">
                    <input type="hidden" name="stageid" class="stageid" style="width: 100%" id="stageid"  readonly>
                    <input type="hidden" name="descid" class="descid" style="width: 100%" id="descid"  readonly>
                    <select class="form-control" name="status">
                        <option value="">-- Choose Status --</option>
                        <option value="0">Review Pending</option>
                        <option value="1">Completed</option>
                        <option value="2">Reject</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
            </form>
        </div>
      </div>
@endsection
