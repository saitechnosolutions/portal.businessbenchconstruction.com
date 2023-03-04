@extends('layout.app')
@section('title','Dashboard')
@section('main-content')

@if(Auth::user()->usertype == '1')

<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }}
         </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/zones">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/zone.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Zones</p>
                    <span>{{ $numofzones->count() }}</span>
                </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/clients">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Clients</p>
                    <span>{{ $numofclients->count() }}</span>
                </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/completed_works">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/projects.svg" class="img-fluid project-img"
                            alt="">
                    </div>
                    <p> Active Projects</p>
                    <span>
                        @if($activeprojects = App\Models\Client::where('completed_status',null)->get()->count())
                            {{ $activeprojects }}
                            @else
                            0
                        @endif
                    </span>
                </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/completed_works"><div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/projects.svg" class="img-fluid project-img"
                            alt="">
                    </div>
                    <p>Completed Projects</p>
                    <span>
                        @if($completedprojects = App\Models\Client::where('completed_status','100')->get()->count())
                            {{ $completedprojects }}
                            @else
                            0
                        @endif
                    </span>
                </div></a>
            </div>
            <div class="col-lg-3">
                <a href="/user">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Users</p>
                    <span>{{ $numofusers->count() }}</span>
                </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
                </a>
            </div>
        </div>
    </div>
</section>

@elseif(Auth::user()->usertype == '3')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">

            <div class="col-lg-3">
                <a href="/clients">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Clients</p>
                    <span>{{$clientcount->count()}}</span>
                </div>
            </a>
            </div>
            <div class="col-lg-3">
                <a href="/clients">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/projects.svg" class="img-fluid project-img"
                            alt="">
                    </div>
                    <p> Ongoing Projects</p>
                    <span>{{$activeproject->count()}}</span>
                </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/completed_works">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/projects.svg" class="img-fluid project-img"
                            alt="">
                    </div>
                    <p>Completed Projects</p>
                    <span>{{$completedproject->count()}}</span>
                </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/leads">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Leads</p>

                    <span>{{ $leadscount2->count() }}</span>
                </div>
            </a>
            </div>


        </div>
    </div>
</section>
@elseif(Auth::user()->usertype == '4')
<section class="box-groups">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">



    <div class="container-fluid">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            @if ($clients = App\Models\Client::where('clientcode',Auth::user()->userid)->first())

                    @if($engineer = App\Models\Engineer::where('engineerid',$clients->engineercode)->first())

                    <div class="col-lg-4" >
                        <div class="clientbox" data-title="Hi {{ Auth::user()->name }}" data-intro="Your Engineer Name and Mobile Number">
                            <p class="text-center" style="color:#8ec641;font-weight:bold;font-size:30px">{{ $engineer->name }}</p>
                            <p class="text-center">Engineer Name</p>
                            <p class="text-center"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>&nbsp;&nbsp;<a style="color:#000;" href="tel:{{ $engineer->phnumber }}">{{ $engineer->phnumber }}</a></p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="clientbox" data-title="Hi {{ Auth::user()->name }}" data-intro="Your Regional Engineer name and Mobile Number">
                            <p class="text-center" style="color:#8ec641;font-weight:bold;font-size:30px">
                                @if ($getrm = App\Models\User::where('userid',$engineer->rmid)->first())
                                    {{ $getrm->name }}

                            </p>
                            <p class="text-center">Regional Engineer</p>
                            <p class="text-center"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>&nbsp;&nbsp;<a href="tel:{{ $getrm->mobilenumber }}">{{ $getrm->mobilenumber }}</a></p>
                            @endif
                        </div>
                    </div>

                    @endif
            @endif


        </div>
    </div>
    <div class="container-fluid mt-5">
        <h4 class="section-heading"> Work Process </h4>
        <div class="row justify-content-center">

            <div class="col-lg-4">
                <div class="pendingdwork">
                    {{-- {{ $clientinfo->clientcode }} --}}
                    <h3>Pending Works</h3>
                    @if($currentstage1 = App\Models\Payment::where('clientid',$clientinfo->clientcode)->where('engid',$clientinfo->engineercode)->where('payment_status','1')->get()->count())
                    {{-- {{ $currentstage1 }} --}}
                @endif
                @if($getestimate = App\Models\twoestimate::where('clientid',$clientinfo->clientcode)->where('engineerid',$clientinfo->engineercode)->groupBy('stage_num')->get()->count())
                    {{-- {{ $getestimate }} --}}
                    <p>{{ round(100 - $currentstage1/$getestimate * 100) }}%</p>
                    @else
                    <p>0%</p>
                    @endif

                </div>
            </div>
            <div class="col-lg-4">
                <div class="completedwork">
                    <h3>Completed Works</h3>
                    @if($currentstage1 = App\Models\Payment::where('clientid',$clientinfo->clientcode)->where('engid',$clientinfo->engineercode)->where('payment_status','1')->where('esttype','0')->get()->count())
                    {{-- {{ $currentstage1 }} --}}
                @endif
                @if($getestimate = App\Models\twoestimate::where('clientid',$clientinfo->clientcode)->where('engineerid',$clientinfo->engineercode)->groupBy('stage_num')->get()->count())
                    {{-- {{ $getestimate }} --}}
                    <p>{{ round($currentstage1/$getestimate * 100) }}%</p>
                    @else
                    <p>0%</p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid mt-5">
        <h4 class="section-heading"> Payment Information </h4>
        <div class="row justify-content-center">

            <div class="col-lg-3">
                <div class="completedwork">

                    <h3 style="font-size:20px">Quoted Rate</h3>
                    @if($getestimateid)
                        @if($getestimateid->estid != null)
                            @if($quotedamt = App\Models\Stage::where('estid',$getestimateid->estid)->sum('dueamount'))
                                <p>{{ number_format($quotedamt,2) }}</p>
                                @else
                                {{-- <p>text</p> --}}
                            @endif
                            @endif
                            @else
                        <p>0</p>
                    @endif



                </div>
            </div>
            <div class="col-lg-3">
                <div class="pendingdwork">
                    <h3 style="font-size:20px">Payment Received</h3>
                    @if($currentstage1 = App\Models\Payment::where('clientid',$clientinfo->clientcode)->where('engid',$clientinfo->engineercode)->where('payment_status','1')->where('esttype','0')->sum('payamount'))
                       <p>  {{ number_format($currentstage1,2) }}</p>
                       @else
                       <p>0</p>
                    @endif

                </div>
            </div>
            <div class="col-lg-3">
                <div class="pendingdwork">
                    <h3 style="font-size:20px">Payment Pending</h3>

                    @if($getestimateid)
                        @if($getestimateid->estid != null)
                            @if($currentstage1 = App\Models\Payment::where('clientid',$clientinfo->clientcode)->where('engid',$clientinfo->engineercode)->where('payment_status','1')->where('esttype','0')->sum('payamount'))
                            <p>  {{ number_format($quotedamt - $currentstage1,2) }}</p>
                            @else
                            <p>0</p>
                            @endif
                        @else
                        <p>0</p>
                    @endif
                    @endif


                </div>
            </div>
            <div class="col-lg-3">
                <div class="pendingdwork">
                    <h3 style="font-size:20px">Additional Payment</h3>
                    @if($currentstage1 = App\Models\Payment::where('clientid',$clientinfo->clientcode)->where('engid',$clientinfo->engineercode)->where('payment_status','1')->where('esttype','1')->sum('payamount'))
                       <p>  {{ number_format($currentstage1,2) }}</p>
                       @else
                       <p>0</p>
                    @endif
                </div>
            </div>


        </div>
    </div>
</div>
<div class="col-lg-3">

        <div class="view_card_box2 " style="margin-top:15px">
        {{-- <div class="img">
            <img class="clientphoto" src="assets/images/dashboard/modal_img.png" alt="">
        </div> --}}


        <span class="code clientcode"></span>
        <p class="name clientname"></p>
        <p class="date"><span class="clientstartdate">@if($start_date == '') @else {{ $start_date }} @endif</span> - <span class="clientenddate">@if($end_date == '') @else {{ $end_date }} @endif</span></p>
        <p class="address clientaddress">
           {{$clientinfo->address}}
        </p>
        <p class="phone clientphone"><a href="jayascript:;">{{$clientinfo->mobilenumber}}</a></p>
        <p class="mail"><a href="javascript:;" class="role clientmail">{{$clientinfo->emailid}}</a></p>
        {{-- <h3 class="details">Dealership Details</h3> --}}
        <div class="dealer_details">

            <div class="inner">
                <h4>Region</h4>
                <h6 class="clientregion">{{ $clientinfo->zone }}</h6>
            </div>
            <div class="inner">
                <h4 class="">Area</h4>
                <h6 class="clientarea">{{ $clientinfo->area }}</h6>
            </div>
        </div>

        <h4 class="office_address" style="color:#8ec641">
            Plan Name
        </h4>
        <p>
            @if($clientinfo->planname == 1)
                Basic
            @endif
            @if($clientinfo->planname == 2)
                Standard
            @endif
            @if($clientinfo->planname == 3)
                Premium
            @endif
        </p>
        <h4 class="office_address" style="color:#8ec641">
            Current Stage
        </h4>
        <p>
            @if($currentstage = App\Models\Payment::where('clientid',$clientinfo->clientcode)->where('engid',$clientinfo->engineercode)->where('payment_status','1')->orderBy('id', 'DESC')->take(1)->first())

                                                                <p>{{ $currentstage->stageid }}</p>
                                                            @endif
        </p>
        {{-- <a href="" class="btn btn-primary location viewclientdetails">View Details</a> --}}
    </div>

</div>
</div>
</div>
</section>
@elseif(Auth::user()->usertype == '5' || Auth::user()->usertype == '14' || Auth::user()->usertype == '18' || Auth::user()->usertype == '20')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/clients">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Clients</p>
                    <span>{{ $numofclients->count() }}</span>
                </div>
            </a>
            </div>
           <div class="col-lg-3">
            <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
            </a>
            </div>
             <div class="col-lg-3">
                 <a href="/drawings">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Drawings</p>
                    <span>{{ $numofdrawings->count() }}</span>
                </div>
                </a>
            </div>

        </div>
    </div>
</section>
@elseif(Auth::user()->usertype == '7' || Auth::user()->usertype == '13')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/clients">
                    <div class="box">
                        <div class="icon">
                            <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                        </div>
                        <p>Total No of Clients</p>
                        <span>{{ $numofclients->count() }}</span>
                    </div>
                </a>
            </div>
           <div class="col-lg-3">
            <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
            </a>
            </div>
             <div class="col-lg-3">
                <a href="/estimatereq">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Estimates</p>
                    <span>{{ $estimaterequests->count() }}</span>
                </div>
            </a>
            </div>

        </div>
    </div>
</section>
@elseif(Auth::user()->usertype == '8')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/clients">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Clients</p>
                    <span>{{ $numofclients->count() }}</span>
                </div>
                </a>
            </div>
           <div class="col-lg-3">
            <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
            </a>
            </div>
             {{-- <div class="col-lg-3">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Estimates</p>
                    <span>{{ $estimaterequests->count() }}</span>
                </div>
            </div> --}}

        </div>
    </div>
</section>
@elseif(Auth::user()->usertype == '15')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/clients">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Clients</p>
                    <span>{{ $numofclients->count() }}</span>
                </div>
                </a>
            </div>
           <div class="col-lg-3">
            <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
            </a>
            </div>


        </div>
    </div>
</section>

@elseif(Auth::user()->usertype == '12')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/leads">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Leads</p>
                    <span>{{$leadscount5}}</span>
                </div>
                </a>
            </div>
           <div class="col-lg-3">
            <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
            </a>
            </div>


        </div>
    </div>
</section>
@elseif(Auth::user()->usertype == '2')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/leads">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Leads</p>
                    <span>{{$leadscount1->count()}}</span>
                </div>
            </a>
            </div>

           <div class="col-lg-3">
            <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
            </a>
            </div>


        </div>
    </div>
</section>
@elseif(Auth::user()->usertype == '11')
<section class="box-groups">
    <div class="container">
        <h4 class="section-heading"> Welcome {{ Auth::user()->name }} </h4>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <a href="/leads">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/clients.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Leads</p>
                    <span>{{$leadscount2->count()}}</span>
                </div>
            </a>
            </div>

           <div class="col-lg-3">
            <a href="/engineers">
                <div class="box">
                    <div class="icon">
                        <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                    </div>
                    <p>Total No of Engineers</p>
                    <span>{{ $numofengineers->count() }}</span>
                </div>
            </a>
            </div>

            <div class="col-lg-3">
                <a href="/clients">
                    <div class="box">
                        <div class="icon">
                            <img src="assets/images/dashboard/engineering.svg" class="img-fluid" alt="">
                        </div>
                        <p>Total No of Clients</p>
                        <span>{{ $numofengineers->count() }}</span>
                    </div>
                </a>
                </div>

        </div>
    </div>
</section>
@endif



@endsection
