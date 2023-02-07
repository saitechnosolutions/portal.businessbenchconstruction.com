@extends('layout.app')
@section('title','Estimates')
@section('main-content')

<section>
    {{-- {{ $getallclient }} --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-9">
                        <h4 class="section-heading">Create Main Estimate</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form name="addTempestimate" id="addTempestimate" action="/addTempestimate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                    <div class="container-fluid">
                        <div class="row">

                                <div class="col-lg-12">
                                    {{-- <h5>General Information</h5> --}}
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-input mt-3">
                                                    <label for="">Engineer Code</label><span class="text-danger">*</span><br>
                                                    <input type="text" name="engid" style="width: 95%" id="name" class="form-control" value="{{ $engid }}" readonly>
                                                    <span class="error-text name_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-input mt-3">
                                                    <label for="">Client Code</label><span class="text-danger">*</span><br>
                                                    <input type="text" name="clientid" style="width: 95%" id="password" class="form-control" value="{{ $clientid }}" readonly>
                                                    <span class="error-text password_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-input mt-3">
                                                    <label for="">Estimate ID</label><span class="text-danger">*</span><br>
                                                    <input type="text" name="estimateid" style="width: 95%" id="password" class="form-control" value="{{ $estid }}" readonly>
                                                    <span class="error-text password_error"></span>
                                                </div>
                                            </div>
                                            <label style="margin-top:25px;" for="">Add Stages</label>
                                            <table class="table table-borderless " >
                                                <tbody id="appendstageparent">


                                                <tr class="appendstage">

                                                    <td style="width:80%">
                                                        <select class="form-control js-example-basic-single" name="stages[]">
                                                            <option>-- Choose Stages --</option>
                                                            @if($stagemasters)
                                                                @foreach ($stagemasters as $stage)
                                                                    <option value="{{ $stage->stageid }}">{{ $stage->stagename }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>

                                                    <td style="width:20%">
                                                        <button type="button" class="btn btn-success addstage"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        <button type="button" class="btn btn-danger removestage" style="visibility: hidden"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>

                                                </tbody>

                                            </table>

                                            </div>
                                            <button type="submit" class="btn btn-success ">Create Main Estimate</button>
                                        </div>

                                </div>


                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    </section>
@endsection
