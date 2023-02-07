@extends('layout.app')
@section('title','Drawings')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-9">
                                {{-- <h4 class="section-heading">Package List</h4> --}}
                            </div>
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createDrawings">
                                    <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Package
                                  </button>
                            </div>
                        </div>
                    </div>
                <ul class="nav nav-pills  mb-5 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Services</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Drawing</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                          <h5>Basic</h5>
                                        </div>
                                        <div class="card-body">
                                            @if ($title1=App\Models\Packagetitle::where('id',1)->first())

                                                <h5 class="card-title">{{ $title1->title_name }}</h5>
                                            @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',1)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            @if ($title1=App\Models\Packagetitle::where('id',2)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',2)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',3)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',3)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    @if ($title1=App\Models\Packagetitle::where('id',4)->first())

                                    <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',4)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',5)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',5)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',6)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',6)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                            @if ($title1=App\Models\Packagetitle::where('id',7)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',7)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif

                                            @if ($title1=App\Models\Packagetitle::where('id',8)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',8)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',9)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',9)->where('packagetypes',1)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                                @if ($title1=App\Models\Packagetitle::where('id',10)->first())

                                                <h5 class="card-title">{{ $title1->title_name }}</h5>
                                            @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',10)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            @if ($title1=App\Models\Packagetitle::where('id',11)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',1)->where('packagetitle',11)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                        </div>
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                          <h5>Standard</h5>
                                        </div>
                                        <div class="card-body">
                                            @if ($title1=App\Models\Packagetitle::where('id',1)->first())

                                                <h5 class="card-title">{{ $title1->title_name }}</h5>
                                            @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',1)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            @if ($title1=App\Models\Packagetitle::where('id',2)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',2)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',3)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',3)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    @if ($title1=App\Models\Packagetitle::where('id',4)->first())

                                    <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',4)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',5)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',5)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',6)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',6)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                            @if ($title1=App\Models\Packagetitle::where('id',7)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',7)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif

                                            @if ($title1=App\Models\Packagetitle::where('id',8)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',8)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',9)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',9)->where('packagetypes',1)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                                @if ($title1=App\Models\Packagetitle::where('id',10)->first())

                                                <h5 class="card-title">{{ $title1->title_name }}</h5>
                                            @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',10)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            @if ($title1=App\Models\Packagetitle::where('id',11)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',2)->where('packagetitle',11)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                        </div>
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                          <h5>Premium</h5>
                                        </div>
                                        <div class="card-body">
                                            @if ($title1=App\Models\Packagetitle::where('id',1)->first())

                                                <h5 class="card-title">{{ $title1->title_name }}</h5>
                                            @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',1)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            @if ($title1=App\Models\Packagetitle::where('id',2)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',2)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',3)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',3)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    @if ($title1=App\Models\Packagetitle::where('id',4)->first())

                                    <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',4)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',5)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',5)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',6)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',6)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                            @if ($title1=App\Models\Packagetitle::where('id',7)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',7)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif

                                            @if ($title1=App\Models\Packagetitle::where('id',8)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',8)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        @if ($title1=App\Models\Packagetitle::where('id',9)->first())

                                        <h5 class="card-title">{{ $title1->title_name }}</h5>
                                    @endif

                                    @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',9)->where('packagetypes',1)->get())
                                        <ul>
                                        @foreach ($packagedesc as $desc)
                                            <li class="card-text">{{ $desc->packagedetails }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                                @if ($title1=App\Models\Packagetitle::where('id',10)->first())

                                                <h5 class="card-title">{{ $title1->title_name }}</h5>
                                            @endif

                                            @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',10)->get())
                                                <ul>
                                                @foreach ($packagedesc as $desc)
                                                    <li class="card-text">{{ $desc->packagedetails }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            @if ($title1=App\Models\Packagetitle::where('id',11)->first())

                                            <h5 class="card-title">{{ $title1->title_name }}</h5>
                                        @endif

                                        @if ($packagedesc=App\Models\Package_detail::where('packageid',3)->where('packagetitle',11)->get())
                                            <ul>
                                            @foreach ($packagedesc as $desc)
                                                <li class="card-text">{{ $desc->packagedetails }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Drawing</div>
                  </div>
                </div>


                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="createDrawings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="addDrawings" id="addDrawings" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Drawings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-input mt-3">
                            <label for="">Description Title</label><span class="text-danger">*</span><br>
                            <select class="form-control" name="desctitle">
                                <option>-- Choose Package --</option>
                                @if($packagetitle)
                                    @foreach ($packagetitle as $title)
                                        <option value="{{ $title->id }}">{{ $title->title_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-input mt-3">
                            <label for="">Package Name</label><span class="text-danger">*</span><br>
                            <select class="form-control" name="packagetitle">
                                <option>-- Choose Package Name --</option>
                                <option value="Basic">Basic</option>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                        <div class="form-input mt-3">
                            <label for="">Choose Type</label><span class="text-danger">*</span><br>
                            <select class="form-control" name="packagetitle">
                                <option>-- Choose Package Name --</option>
                                <option value="1">Services Details</option>
                                <option value="2">Drawings</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <thead>
                                <th>
                                    Add Description
                                </th>
                                <th>
                                    <button class="btn btn-success desc"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </th>
                            </thead>
                            <tbody id="adddesc">
                                <tr>
                                    <td>
                                        <textarea class="form-control" name="desc[]"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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


@endsection
