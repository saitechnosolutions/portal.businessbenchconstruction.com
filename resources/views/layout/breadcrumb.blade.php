<div class="container-fluid mt-3">
    <div class="row">
            <div class="col-lg-10">
                <div class="breadcrumb flat ">
                    @if (Request::segment(1) != 'dashboard')

                        <a style="text-transform: capitalize" class="active">Dashboard</a>

                    @endif


                <?php $segments = ''; ?>

                @foreach(Request::segments() as $segment)



                <?php $segments .= '/'.$segment; ?>





                @if($segment == 'clientdetails')

                        <a href="/clients">Clients</a>
                @endif
                @if($segment == 'drawingdetails')
                        <a href="/clients">Clients</a>
                @endif
                @if($segment == 'uploaddraw')

                        <a href="/clients">Clients</a>


                        <a>Drawing Details</a>



                @endif

                @if($segment == 'paymentdetails')

                        <a href="/clients">Clients</a>


                @endif
                @if($segment == 'workcompletedetails')

                        <a href="/clients">Clients</a>

                @endif

                @if($segment == 'processofworks')

                        <a href="/clients">Clients</a>

                @endif

                @if($segment == 'paymentcreation')

                    <a href="/clients">Clients</a>

            @endif


                    <a style="text-transform: capitalize">{{$segment}}</a>

            @endforeach


                </div>

            </div>
            @if (Request::segment('1') != 'dashboard')
            <div class="col-lg-2 text-end">
                <a onclick="window.history.back()" class="btn btn-secondary mt-4" style="width:100px"><i class="fas fa-angle-double-left"></i> &nbsp;Back</a>
            </div>
            @endif

    </div>
</div>

