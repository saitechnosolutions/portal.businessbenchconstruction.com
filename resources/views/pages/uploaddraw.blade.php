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
                            <h4 class="section-heading">Upload Drawings</h4>
                        </div>
                        {{-- {{ Auth::user()->usertype }} --}}
                        <div class="col-lg-3">
                            @if(Auth::user()->usertype == 20)
                                <button class="btn btn-success m-auto d-block alluploaded" data-leadid={{ $leadid }} data-drawid={{ $drawid }}>All Files Uploaded</button>
                            @endif

                        </div>

                    </div>
<section class="box-groups" style="padding:10px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Drawings</p>
                    {{-- {{ Auth::user()->usertype }} --}}
                    @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '5' || Auth::user()->usertype == '14' || Auth::user()->usertype == '7' || Auth::user()->usertype == '13' || Auth::user()->usertype == '20' || Auth::user()->usertype == '18')
                        @if($totdrawings = App\Models\uploaddrawing::where('leadid',$leadid)->get())
                         <span>{{$totdrawings->count()}}</span>
                        @endif
                    @endif
                        @if(Auth::user()->usertype == '4' )
                            @if($totdrawings = App\Models\uploaddrawing::where('leadid',$leadid)->where('ae_status',1)->get())
                                <span>{{$totdrawings->count()}}</span>
                            @endif
                        @endif

                </div>
            </div>
            <div class="col-lg-3">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Approved Drawings</p>
                     @if($clientapproved = App\Models\uploaddrawing::where('leadid',$leadid)->where('clientside_status',1)->get())
                        <span>{{$clientapproved->count()}}</span>
                    @endif


                </div>
            </div>
            <div class="col-lg-3">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Rejected Drawings</p>

                     @if($clientreject = App\Models\uploaddrawing::where('leadid',$leadid)->where('clientside_status',2)->get())
                        <span>{{$clientreject->count()}}</span>
                    @endif



                </div>
            </div>
            <div class="col-lg-3">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Approval Pending</p>
                    @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '5' || Auth::user()->usertype == '14'||  Auth::user()->usertype == '7' || Auth::user()->usertype == '13' || Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                     @if($approvalpending = App\Models\uploaddrawing::where('leadid',$leadid)->where('clientside_status',null)->get())
                        <span>{{$approvalpending->count()}}</span>
                    @endif
                    @endif
                    @if(Auth::user()->usertype == '4')
                        @if($approvalpending = App\Models\uploaddrawing::where('leadid',$leadid)->where('clientside_status',null)->where('ae_status',1)->get())
                            <span>{{$approvalpending->count()}}</span>
                        @endif
                    @endif
                    <!--<span>00</span>-->
                </div>
            </div>
        </div>
    </div>
    </section>
            <section>
                <ul class="nav nav-pills  justify-content-center nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link @if(Auth::user()->usertype == '5' || Auth::user()->usertype == '4' || Auth::user()->usertype == '3' || Auth::user()->usertype == '14')  active @endif" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Architect</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link @if(Auth::user()->usertype == '18' || Auth::user()->usertype == '20')  active @endif" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Structural Engineering</button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Quantity Surveyor</button>
                    </li> --}}
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade @if(Auth::user()->usertype == '5'||  Auth::user()->usertype == '4' ||  Auth::user()->usertype == '3' || Auth::user()->usertype == '14') show active @endif" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="userdetails">
                                        <div class="d-flex align-items-start">
                                            <div class="col-lg-4 position-relative">
                                                <div class="position-absolute" style="right:30px;top:10px">

                                                <span class="badge bg-success">Approved</span>
                                                <span class="badge bg-secondary">Pending</span>
                                                <span class="badge bg-danger">Rejected</span>

                                                </div>


                                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <button class="nav-link " id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All</button>
                                                    @if($pactype == 'Basic')
                                                        @if($packagearchitect)
                                                            @foreach ($packagearchitect as $pac)
                                                                <button class="nav-link" @if($pac->basicpack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true">{{ $pac->drawingname }}

                                                                    <span class="badge bg-success position-absolute" style="right:85px">
                                                                        @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                            {{ $approved->count() }}
                                                                        @endif

                                                                    </span>
                                                                     <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                        @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                            {{ $pending->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-danger position-absolute" style="right:25px">
                                                                        @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                            {{ $reject->count() }}
                                                                        @endif

                                                                    </span>
                                                                </button>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                    @if($pactype == 'Standard')
                                                        @if($packagearchitect)
                                                            @foreach ($packagearchitect as $pac)
                                                                <button class="nav-link @if($pac->id == '1') active @else @endif" @if($pac->standardpack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true">{{ $pac->drawingname }}

                                                                    <span class="badge bg-success position-absolute" style="right:85px">
                                                                        @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                            {{ $approved->count() }}
                                                                        @endif

                                                                    </span>
                                                                     <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                        @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                            {{ $pending->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-danger position-absolute" style="right:25px">
                                                                        @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                            {{ $reject->count() }}
                                                                        @endif

                                                                    </span>
                                                                </button>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    {{-- {{ $pactype }} --}}
                                                    @if($pactype == 'Premium')

                                                        @if($packagearchitect)
                                                            @foreach ($packagearchitect as $pac)
                                                                <button class="position-relative nav-link @if($pac->id == '1') active @else @endif" @if($pac->premiumpack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true">{{ $pac->drawingname }}

                                                                <span class="badge bg-success position-absolute" style="right:85px">
                                                                    @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                        {{ $approved->count() }}
                                                                    @endif

                                                                </span>
                                                                <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                    @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                        {{ $pending->count() }}
                                                                    @endif

                                                                </span>
                                                                <span class="badge bg-danger position-absolute" style="right:25px">
                                                                    @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                        {{ $reject->count() }}
                                                                    @endif

                                                                </span>
                                                            </button>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                    @if($pactype == 'Luxury')

                                                        @if($packagearchitect)
                                                            @foreach ($packagearchitect as $pac)
                                                                <button class="position-relative nav-link @if($pac->id == '1') active @else @endif" @if($pac->luxurypack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true">{{ $pac->drawingname }}

                                                                <span class="badge bg-success position-absolute" style="right:85px">
                                                                    @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                        {{ $approved->count() }}
                                                                    @endif

                                                                </span>
                                                                <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                    @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                        {{ $pending->count() }}
                                                                    @endif

                                                                </span>
                                                                <span class="badge bg-danger position-absolute" style="right:25px">
                                                                    @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                        {{ $reject->count() }}
                                                                    @endif

                                                                </span>
                                                            </button>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                    {{-- <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
                                                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                                                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button> --}}
                                                  </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                                        @if(Auth::user()->usertype == '5' || Auth::user()->usertype == '14')
                                                            <div class="clientdetailsbox imageupload"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <div class="clientcontent">
                                                                <div class="clienticons">
                                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                    <img src="/assets/images/estimates.svg" class="img-fluid">
                                                                </div>
                                                                <h5 class="text-center mt-3">Upload Image</h5>
                                                            </div>
                                                        </div>
                                                        @endif

                                                         <div class="col-lg-12">
                                                                @if($packagefile = App\Models\uploaddrawing::where('leadid',$leadid)->where('pactype',1)->get())
                                                                <div class="row">
                                                                    @if($packagefile->count() != '0')

                                                                        @foreach ($packagefile as $files)

                                                                                <div class="col-lg-4">

                                                                                            @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '5' || Auth::user()->usertype == '14' || Auth::user()->usertype == '7' || Auth::user()->usertype == '13' || Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                                                        <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success mb-2">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger mb-2">Client Rejected</div>
                                                                                                 @endif

                                                                                                  @if($files->ae_status == 1)
                                                                                                <div class="badge bg-success mb-2">AE Approved</div>
                                                                                                    @elseif($files->ae_status == 2)
                                                                                                <div class="badge bg-danger mb-2">AE Rejected</div>
                                                                                                 @endif

                                                                                            <div class="drawicon ">

                                                                                                        <!--<img src="/images/{{ $files->filename }}" class="img-fluid">-->
                                                                                                        <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">

                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>
                                                                                                <h6 class="badge bg-info" style="font-size:14px">{{$files->pacname}}</h6>

                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                            @if(Auth::user()->usertype == '5' || Auth::user()->usertype == '14')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif

                                                                                            @if(Auth::user()->usertype == '3')
                                                                                                    @if($files->ae_status == 0 || $files->ae_status == null)
                                                                                                        <a  class="btn btn-success aeapprove" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                        <a   class="btn btn-danger aereject" data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                    @endif

                                                                                                @endif

                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif


                                                                                         @if(Auth::user()->usertype == '4')
                                                                                            @if($files->ae_status == 1)
                                                                                                <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger">Client Rejected</div>
                                                                                                 @endif

                                                                                                  @if($files->ae_status == 1)
                                                                                                <div class="badge bg-success mb-2">AE Approved</div>
                                                                                                    @elseif($files->ae_status == 2)
                                                                                                <div class="badge bg-danger mb-2">AE Rejected</div>
                                                                                                 @endif

                                                                                            <div class="drawicon">
                                                                                                {{-- <i class="fa fa-file-archive-o" aria-hidden="true"></i> --}}
                                                                                                <!--<img src="/images/{{ $files->filename }}" class="img-fluid">-->
                                                                                                <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">
                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>
                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" data-title="View Drawing" data-intro="View the drawings "  class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                                                            @if(Auth::user()->usertype == '5' || Auth::user()->usertype == '14')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif
                                                                                            {{-- <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}

                                                                                                @if(Auth::user()->usertype == '4')
                                                                                                    @if($files->clientside_status == 0 || $files->clientside_status == null)
                                                                                                    <a  class="btn btn-success clientapprove" data-title="Approve Drawing" data-intro="Approve the drawings proceed the next step" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                    <a   class="btn btn-danger clientreject" data-title="Reject Drawing" data-intro="Reject the drawings " data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                    @endif

                                                                                                @endif
                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif
                                                                                            @endif


                                                                                </div>

                                                                        @endforeach
                                                                    @else
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:600px">
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                </div>
                                                                @endif
                                                            </div>
                                                    </div>


                                                    @if($packagearchitect)
                                                        @foreach ($packagearchitect as $pac)
                                                        <div class="tab-pane fade " id="v-pills-{{ $pac->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $pac->id }}-tab">


                                                            <div class="col-lg-12">
                                                                @if($packagefile = App\Models\uploaddrawing::where('leadid',$leadid)->where('pacid',$pac->id)->get())
                                                                <div class="row">
                                                                    @if($packagefile->count() != '0')

                                                                        @foreach ($packagefile as $files)

                                                                                <div class="col-lg-4">

                                                                                            @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '5' || Auth::user()->usertype == '14' || Auth::user()->usertype == '7' || Auth::user()->usertype == '13' || Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                                                        <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success mb-2">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger mb-2">Client Rejected</div>
                                                                                                 @endif

                                                                                                  @if($files->ae_status == 1)
                                                                                                <div class="badge bg-success mb-2">AE Approved</div>
                                                                                                    @elseif($files->ae_status == 2)
                                                                                                <div class="badge bg-danger mb-2">AE Rejected</div>
                                                                                                 @endif

                                                                                            <div class="drawicon ">

                                                                                                        <!--<img src="/images/{{ $files->filename }}" class="img-fluid">-->
                                                                                                        <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">

                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>

                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                            @if(Auth::user()->usertype == '5' || Auth::user()->usertype == '14')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif
                                                                                            @if(Auth::user()->usertype == '3')
                                                                                                @if($files->ae_status == 0 || $files->ae_status == null)
                                                                                                    <a  class="btn btn-success aeapprove" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                    <a   class="btn btn-danger aereject" data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                    @endif
                                                                                                @endif

                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif


                                                                                         @if(Auth::user()->usertype == '4')
                                                                                            @if($files->ae_status == 1)
                                                                                                <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger">Client Rejected</div>
                                                                                                 @endif

                                                                                            <div class="drawicon">
                                                                                                {{-- <i class="fa fa-file-archive-o" aria-hidden="true"></i> --}}
                                                                                                <!--<img src="/images/{{ $files->filename }}" class="img-fluid">-->
                                                                                                <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">
                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>
                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                            @if(Auth::user()->usertype == '5' || Auth::user()->usertype == '14')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif

                                                                                                @if(Auth::user()->usertype == '4')
                                                                                                @if($files->clientside_status == 0 || $files->clientside_status == null)
                                                                                                    <a  class="btn btn-success clientapprove" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                    <a   class="btn btn-danger clientreject" data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                @endif
                                                                                                @endif
                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif
                                                                                            @endif


                                                                                </div>

                                                                        @endforeach
                                                                    @else
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:600px">
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif


                                                    {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> --}}
                                                  </div>
                                            </div>

                                          </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if(Auth::user()->usertype == '18' || Auth::user()->usertype == '20') show active @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="userdetails">
                                        <div class="d-flex align-items-start">
                                            <div class="col-lg-4 position-relative">
                                                <div class="position-absolute" style="right:30px;top:10px">

                                                    <span class="badge bg-success">Approved</span>
                                                    <span class="badge bg-secondary">Pending</span>
                                                    <span class="badge bg-danger">Rejected</span>

                                                    </div>
                                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                                    <button class="nav-link active" id="nav-all1-tab" data-bs-toggle="tab" data-bs-target="#nav-all1" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All</button>
                                                    @if($pactype == 'Basic')
                                                        @if($packagestructural)
                                                            @foreach ($packagestructural as $pac)
                                                                <button class="nav-link @if($pac->id == '1') active @else @endif" @if($pac->basicpack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true" >{{ $pac->drawingname }}

                                                                    <span class="badge bg-success position-absolute" style="right:85px">
                                                                        @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                            {{ $approved->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                        @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                            {{ $pending->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-danger position-absolute" style="right:25px">
                                                                        @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                            {{ $reject->count() }}
                                                                        @endif

                                                                    </span>
                                                                </button>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                    @if($pactype == 'Standard')
                                                        @if($packagestructural)
                                                            @foreach ($packagestructural as $pac)
                                                                <button class="nav-link @if($pac->id == '1') active @else @endif" @if($pac->standardpack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true">{{ $pac->drawingname }}

                                                                    <span class="badge bg-success position-absolute" style="right:85px">
                                                                        @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                            {{ $approved->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                        @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                            {{ $pending->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-danger position-absolute" style="right:25px">
                                                                        @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                            {{ $reject->count() }}
                                                                        @endif

                                                                    </span>
                                                                </button>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    {{-- {{ $pactype }} --}}
                                                    @if($pactype == 'Premium')
                                                        @if($packagestructural)
                                                            @foreach ($packagestructural as $pac)
                                                                <button class="nav-link @if($pac->id == '1') active @else @endif" @if($pac->premiumpack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true">{{ $pac->drawingname }}

                                                                    <span class="badge bg-success position-absolute" style="right:85px">
                                                                        @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                            {{ $approved->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                        @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                            {{ $pending->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-danger position-absolute" style="right:25px">
                                                                        @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                            {{ $reject->count() }}
                                                                        @endif

                                                                    </span>
                                                                </button>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                     @if($pactype == 'Luxury')
                                                        @if($packagestructural)
                                                            @foreach ($packagestructural as $pac)
                                                                <button class="nav-link @if($pac->id == '1') active @else @endif" @if($pac->luxurypack == '1')  @else disabled style="background-color:#D9D9D9;cursor:not-allowed" @endif  id="v-pills-{{ $pac->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $pac->id }}" type="button" role="tab" aria-controls="v-pills-{{ $pac->id }}" aria-selected="true">{{ $pac->drawingname }}

                                                                    <span class="badge bg-success position-absolute" style="right:85px">
                                                                        @if($approved = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',1)->get())
                                                                            {{ $approved->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-secondary position-absolute" style="right:55px">
                                                                        @if($pending = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',null)->get())
                                                                            {{ $pending->count() }}
                                                                        @endif

                                                                    </span>
                                                                    <span class="badge bg-danger position-absolute" style="right:25px">
                                                                        @if($reject = App\Models\uploaddrawing::where('pacid',$pac->id)->where('leadid',$leadid)->where('clientside_status',2)->get())
                                                                            {{ $reject->count() }}
                                                                        @endif

                                                                    </span>
                                                                </button>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                    {{-- <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
                                                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                                                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button> --}}
                                                  </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="nav-all1" role="tabpanel" aria-labelledby="nav-all1-tab">
                                     @if(Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                            <div class="clientdetailsbox imageupload"  data-bs-toggle="modal" data-bs-target="#exampleModal11">
                                                            <div class="clientcontent">
                                                                <div class="clienticons">
                                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                    <img src="/assets/images/estimates.svg" class="img-fluid">
                                                                </div>
                                                                <h5 class="text-center mt-3">Upload Image</h5>
                                                            </div>
                                                        </div>
                                                        @endif

                                                         <div class="col-lg-12">
                                                                @if($packagefile = App\Models\uploaddrawing::where('leadid',$leadid)->where('pactype',2)->get())
                                                                <div class="row">
                                                                    @if($packagefile->count() != '0')

                                                                        @foreach ($packagefile as $files)

                                                                                <div class="col-lg-4">

                                                                                            @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '5' || Auth::user()->usertype == '14' || Auth::user()->usertype == '7' || Auth::user()->usertype == '13' || Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                                                        <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success mb-2">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger mb-2">Client Rejected</div>
                                                                                                 @endif
        @if($files->ae_status == 1)
                                                                                                <div class="badge bg-success mb-2">AE Approved</div>
                                                                                                    @elseif($files->ae_status == 2)
                                                                                                <div class="badge bg-danger mb-2">AE Rejected</div>
                                                                                                 @endif
                                                                                            <div class="drawicon ">

                                                                                                        <!--<img src="/images/{{ $files->filename }}" class="img-fluid">-->
                                                                                                        <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">

                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>
                                                                                                <h6 class="badge bg-info" style="font-size:14px">{{$files->pacname}}</h6>

                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                            @if(Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif

                                                                                            @if(Auth::user()->usertype == '3')
                                                                                            @if($files->ae_status == 0 || $files->ae_status == null)
                                                                                                    <a  class="btn btn-success aeapprove" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                    <a   class="btn btn-danger aereject" data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                @endif
                                                                                                @endif

                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif


                                                                                         @if(Auth::user()->usertype == '4')
                                                                                            @if($files->ae_status == 1)
                                                                                                <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                {{-- @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger">Client Rejected</div>
                                                                                                 @endif --}}
@if($files->ae_status == 1)
                                                                                                <div class="badge bg-success mb-2">AE Approved</div>
                                                                                                    @elseif($files->ae_status == 2)
                                                                                                <div class="badge bg-danger mb-2">AE Rejected</div>
                                                                                                 @endif

                                                                                            <div class="drawicon">
                                                                                                {{-- <i class="fa fa-file-archive-o" aria-hidden="true"></i> --}}
                                                                                                <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">
                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>
                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                            @if(Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif
                                                                                            {{-- <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}

                                                                                                {{-- @if(Auth::user()->usertype == '4')
                                                                                                @if($files->clientside_status == 0 || $files->clientside_status == null)
                                                                                                    <a  class="btn btn-success clientapprove" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                    <a   class="btn btn-danger clientreject" data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                @endif
                                                                                                @endif --}}
                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif
                                                                                            @endif


                                                                                </div>

                                                                        @endforeach
                                                                    @else
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:600px">
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                </div>
                                                                @endif
                                                            </div>
                                                    </div>

                                                    @if($packagestructural)
                                                        @foreach ($packagestructural as $pac)
                                                        <div class="tab-pane fade @if($pac->id==1) show active @else @endif" id="v-pills-{{ $pac->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $pac->id }}-tab">
                                                            {{-- @if(Auth::user()->usertype == 5)
                                                            <div class="col-lg-12">
                                                                <form name="uploaddrawings" class="uploaddrawings" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                                                    @csrf

                                                                    <input type="file" class="form-control" name="uploadfile" style="width:250px" required accept="application/pdf">
                                                                    <input type="hidden" name="pacid" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid" value="{{ $leadid }}">
                                                                    <button type="submit" class="btn btn-success mt-3" style="width:250px">Upload</button>

                                                                </form>

                                                            </div>
                                                            @endif --}}

                                                            <div class="col-lg-12">
                                                                @if($packagefile = App\Models\uploaddrawing::where('leadid',$leadid)->where('pacid',$pac->id)->get())
                                                                <div class="row">
                                                                    @if($packagefile->count() != '0')

                                                                        @foreach ($packagefile as $files)

                                                                                <div class="col-lg-4">

                                                                                            @if(Auth::user()->usertype == '3' || Auth::user()->usertype == '5' || Auth::user()->usertype == '14' || Auth::user()->usertype == '7' || Auth::user()->usertype == '13')
                                                                                            <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success mb-2">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger mb-2">Client Rejected</div>
                                                                                                 @endif

                                                                                            <div class="drawicon ">


                                                                                                        <!--<img src="/images/{{ $files->filename }}" class="img-fluid">-->
                                                                                                        <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">


                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>

                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                            @if(Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif
                                                                                            {{-- <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                                                                            @if(Auth::user()->usertype == '3')
                                                                                            @if($files->ae_status == 0 || $files->ae_status == null)
                                                                                                    <a  class="btn btn-success aeapprove" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                    <a   class="btn btn-danger aereject" data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                @endif
                                                                                                @endif

                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif


                                                                                         @if(Auth::user()->usertype == '4')
                                                                                            @if($files->ae_status == 1)
                                                                                                <div class="drawingdetails">
                                                                                        <div class="drawingcontent">
                                                                                                @if($files->clientside_status == 1)
                                                                                                <div class="badge bg-success">Client Approved</div>
                                                                                                    @elseif($files->clientside_status == 2)
                                                                                                <div class="badge bg-danger">Client Rejected</div>
                                                                                                 @endif

                                                                                            <div class="drawicon">
                                                                                                {{-- <i class="fa fa-file-archive-o" aria-hidden="true"></i> --}}
                                                                                                <img src="/assets/images/PDF_file_icon.svg.png" class="img-fluid">
                                                                                            </div>
                                                                                            <div class="drawtit mb-4">
                                                                                                {{-- <h6>{{ $files->filename }}</h6> --}}
                                                                                                <h6>{{ $files->filename }}</h6>
                                                                                            </div>
                                                                                            <a href="/images/{{ $files->filename }}" target="_blank" class="btn btn-default" style="color:#fff;background-color:#8EC641"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                                                                {{-- <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                                                                                @if(Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
                                                                                            <a  class="btn btn-danger deletedrawing" data-draid="{{ $files->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            @endif

                                                                                                @if(Auth::user()->usertype == '4')
                                                                                                @if($files->clientside_status == 0 || $files->clientside_status == null)
                                                                                                    <a  class="btn btn-success clientapprove" data-id="{{ $files->id }}"  style="color:#fff;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                    <a   class="btn btn-danger clientreject" data-id="{{ $files->id }}" style="color:#fff;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                                                @endif
                                                                                                @endif
                                                                                                 </div>
                                                                                    </div>
                                                                                        @endif
                                                                                            @endif


                                                                                </div>

                                                                        @endforeach
                                                                    @else
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <img src="/assets/images/processingimg.svg" class="img-fluid m-auto d-block" style="width:600px">
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif


                                                    {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> --}}
                                                  </div>
                                            </div>

                                          </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                  </div>


                </section>
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
                    <input type="text" name="clientid" value="{{ $leadid }}" readonly>
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
                    <input type="file" name="drawimage" style="width: 95%" id="drawimage">
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

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="uploaddrawings" class="uploaddrawings" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Architect Image Upload</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th >Drawing Name</th>
                            <th>File Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pactype == 'Basic')
                            @if($packagearchitect)
                                @foreach ($packagearchitect as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" class="form-control" accept="application/pdf" @if($pac->basicpack == '1')  @else style="background-color:#ccc;pointer-events:none;cursor:not-allowed" @endif  >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>


                                </tr>
                                @endforeach
                            @endif
                        @endif
                        @if($pactype == 'Standard')
                            @if($packagearchitect)
                                @foreach ($packagearchitect as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" accept="application/pdf" class="form-control" @if($pac->standardpack == '1')  @else style="background-color:#ccc;pointer-events:none;cursor:not-allowed" @endif >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        @endif

                        @if($pactype == 'Premium')
                            @if($packagearchitect)
                                @foreach ($packagearchitect as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" accept="application/pdf" class="form-control" @if($pac->premiumpack == '1')  @else style="background-color:#ccc;pointer-events:none;cursor:not-allowed" @endif >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        @endif

                         @if($pactype == 'Luxury')
                            @if($packagearchitect)

                                @foreach ($packagearchitect as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" accept="application/pdf" class="form-control" @if($pac->luxurypack == '1')  @else style="background-color:#ccc;pointer-events:none;cursor:not-allowed" @endif >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        @endif

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


      <div class="modal fade" id="exampleModal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="uploaddrawings" class="uploaddrawings" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Structural Image Upload</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th >Drawing Name</th>
                            <th>File Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pactype == 'Basic')
                            @if($packagestructural)
                                @foreach ($packagestructural as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" accept="application/pdf" class="form-control" @if($pac->basicpack == '1')  @else style="background-color:#ccc;pointer-events:none;cursor:not-allowed" @endif  >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>


                                </tr>
                                @endforeach
                            @endif
                        @endif
                        @if($pactype == 'Standard')
                            @if($packagestructural)
                                @foreach ($packagestructural as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" accept="application/pdf" class="form-control" @if($pac->standardpack == '1')  @else disabled @endif >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        @endif

                        @if($pactype == 'Premium')
                            @if($packagestructural)
                                @foreach ($packagestructural as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" accept="application/pdf" class="form-control" @if($pac->premiumpack == '1')  @else disabled @endif >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        @endif

                         @if($pactype == 'Luxury')
                            @if($packagestructural)
                                @foreach ($packagestructural as $pac)
                                <tr>
                                    <td>{{ $pac->drawingname }}</td>
                                    <td>
                                        <input type="file" name="uploadfile[]" accept="application/pdf" class="form-control" @if($pac->luxurypack == '1')  @else disabled @endif >
                                        <input type="hidden" name="pacid[]" value="{{ $pac->id }}">
                                                                    <input type="hidden" name="pacname[]" value="{{ $pac->drawingname }}">
                                                                    <input type="hidden" name="drawid[]" value="{{ $drawingid }}">
                                                                    <input type="hidden" name="leadid[]" value="{{ $leadid }}">
                                                                    <input type="hidden" name="pactype[]" value="{{ $pac->engtype }}">
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        @endif

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
@endsection
