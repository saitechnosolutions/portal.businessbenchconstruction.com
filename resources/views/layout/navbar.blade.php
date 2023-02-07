
    <header class="@if(Auth::user()->usertype == '1') superadmin @elseif(Auth::user()->usertype == '2') telecaller @elseif(Auth::user()->usertype == '3') ae @elseif(Auth::user()->usertype == '4') client @elseif(Auth::user()->usertype == '5') architect @elseif(Auth::user()->usertype == '7') qs @elseif(Auth::user()->usertype == '8') rm @elseif(Auth::user()->usertype == '9') rm @elseif(Auth::user()->usertype == '10') technicalhead @elseif(Auth::user()->usertype == '11') gm @elseif(Auth::user()->usertype == '12') telecaller @elseif(Auth::user()->usertype == '13') qs @elseif(Auth::user()->usertype == '14') architect @else superadmin @endif">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <div class="logo">
                        <img src="/assets/images/bb_color_logo.svg" alt="">
                    </div>
                </div>

                {{-- CLients Navbar --}}
                {{-- Home
                Videos
                Stages
                Estimate
                Payments
                Drawings --}}

                <div class="col-lg-7">
                    <div class="navbar" >
                        <ul>
                            <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/dashboard') active @endif"><a href="/dashboard">Home</a></li>

                            @if(Auth::user()->drawings == '1')
                                @if(Auth::user()->usertype == '5' || Auth::user()->usertype == '14' || Auth::user()->usertype == '18' || Auth::user()->usertype == '20' )
                                    <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/drawings') active @endif"><a href="/drawings">Projects</a></li>
                                    @else
                                    <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/drawings') active @endif"><a href="/drawings">Drawings</a></li>
                                @endif

                            @endif
                            @if(Auth::user()->engineers == '1')
                                <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/engineers') active @endif"><a href="/engineers">Engineers</a></li>
                            @endif
                            @if(Auth::user()->users == '1')
                                <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/user') active @endif"><a href="/user">Users</a></li>
                            @endif
                            @if(Auth::user()->clients == '1')
                            <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/clients') active @endif"><a href="/clients">Clients</a></li>
                        @endif

                        @if(Auth::user()->estimates == '1')
                            @if(Auth::user()->usertype == '7' || Auth::user()->usertype == '13')
                                <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/estimatereq') active @endif"><a href="/estimatereq">Projects</a></li>
                                @else
                                <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/estimatereq') active @endif"><a href="/estimatereq">Estimate</a></li>
                            @endif

                        @endif
                        {{-- @if(Auth::user()->estimates == '1')
                            <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/package') active @endif"><a href="/package">Package</a></li>
                        @endif --}}
                         @if(Auth::user()->leads == '1')
                            <li class="@if(url()->current()=='https://businessbenchportal.saitechnosolutions.net/leads') active @endif"><a href="/leads">Leads</a></li>
                         @endif

                            @if(Auth::user()->users == '1' && Auth::user()->engineers == '1' && Auth::user()->drawings == '1' && Auth::user()->area == '1' && Auth::user()->zones == '1' && Auth::user()->project == '1')
                            <li class="dropdown">
                                <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                  Master
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @if(Auth::user()->zones == '1')
                                    <li><a href="/zones">Zones</a></li>
                                    @endif

                            {{-- @if(Auth::user()->project == '1')
                                    <li><a href="javascript:;">Projects</a></li>
                                @endif --}}
                                @if(Auth::user()->project == '1')
                                    <li><a href="/stages">Stages</a></li>
                                @endif
                                @if(Auth::user()->area == '1')
                                <li><a href="/areas">Area</a></li>
                                @endif
                                     @if(Auth::user()->designation == '1')
                                     <li><a href="/designation">Designation</a></li>
                                     @endif


                                </ul>
                            </li>
                            @endif

                            @if(Auth::user()->usertype == '4')

                                {{-- <li><a href="/dashboard">Diagram</a></li>
                                <li><a href="/dashboard">Estimates</a></li> --}}
                                <li><a href="/clientdetails/{{ Auth::user()->userid }}" >Details</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!--<div class="col-lg-2 ">-->
                <!--    <div class="admin_logo">-->
                <!--        <img src="/assets/images/663338.png" alt="test" /> <span></span> <i class="fas fa-angle-down"></i>-->
                <!--        <div class="notificationdetails">-->


                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-lg-3">
                    <div class="topicons">
                        <div class="admin_logo">
                            @if($notification = App\Models\Notification::where('notificationview','=',Auth::user()->userid)->where('notificationstatus',0)->get())

                                @if($notification->count() == 0)
                                <div class="notifyicon" >
                                    <div class="notificationcount">0</div>
                                    <img src="/assets/images/alarm.png" alt="test" style="background-color:#fff;border-radius:50px;padding:10px"/>
                                </div>
                                @else
                                <div class="notifyicon" >
                                    <div class="notificationcount">{{ $notification->count() }}</div>
                                    <img src="/assets/images/alarm.gif" alt="test" style="background-color:#fff;border-radius:50px;padding:10px"/>
                                </div>
                                @endif
                            @endif


                        {{-- <img src="/assets/images/alarm.gif" alt="test" style="background-color:#fff;border-radius:50px;padding:10px"/> --}}
                         <div class="notificationdetails" style="overflow-y:scroll">
                           <ul class="list-group">
                               @if($notification = App\Models\Notification::where('notificationview','=',Auth::user()->userid)->orderBy('id','DESC')->take(6)->get())
                                    @if($notification->count() == 0)
                                        <div class="nonotification">
                                            <img src="/assets/images/alarm.gif" class="img-fluid" style="width:150px;height:150px;margin:0 auto;display:block">
                                            <li class="list-group-item" style="font-size:12px">No Notification Found</li>
                                        </div>

                                          @else
                                          @foreach($notification as $n)

                                                <li class="list-group-item" style="font-size:12px; @if($n->notificationstatus == '0') background-color:#ccc; @endif">

                                                    {{$n->purposename}}<br><span class="badge bg-success">{{$n->created_at}}</span>
                                                    </li>
                                          @endforeach
                                    @endif


                               @endif

</ul>

                        </div>

                    </div>
                    <div class="admin_logo" style="width:250px;color:#fff;">

                        @if(Auth::user()->user_img)
                        <img src="/users/{{ Auth::user()->user_img }}" class="profilepic" alt="test" />

                        @else
                            <img src="/assets/images/663338.png" class="profilepic" alt="test" />
                        @endif
                        <span></span>
                        <span style="font-size:15px">
                            {{ Auth::user()->name }}<br>
                            @if($designation = App\Models\Designation::where('id',Auth::user()->role)->first())

                                <span >{{ $designation->designation_name  }}</span><br>
                             @endif
                             <span style="font-size:12px">{{Auth::user()->userid}}</span>
                        </span>


                        <div class="user_details">

                            <a href="/logout"> <i class="fas fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
