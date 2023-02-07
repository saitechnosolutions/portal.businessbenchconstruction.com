@extends('layout.app')
@section('title', 'Estimates')
@section('main-content')

@if (Session::get('Success-Estimate'))
        <div class="alert alert-success bg-success alert-dismissible fade show float-alert" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            <strong class="text-white">Updated Successfully</strong>
        </div>
    @endif

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-9">
                            <h4 class="section-heading">Edit Main Estimate</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action="/update_estimates" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8">
                        @csrf

                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-lg-12">
                                    {{-- <h5>General Information</h5> --}}
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-input mt-3">
                                                <label for="">Engineer Code</label><span
                                                    class="text-danger">*</span><br>
                                                <input type="text" name="engid" style="width: 95%" id="name"
                                                    class="form-control" value="{{ $viewengid }}" readonly>
                                                <span class="error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-input mt-3">
                                                <label for="">Client Code</label><span
                                                    class="text-danger">*</span><br>
                                                <input type="text" name="clientid" style="width: 95%" id="password"
                                                    class="form-control" value="{{ $viewclientid }}" readonly>
                                                <span class="error-text password_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-input mt-3">
                                                <label for="">Estimate ID</label><span
                                                    class="text-danger">*</span><br>
                                                <input type="text" name="estimateid" style="width: 95%" id="password"
                                                    class="form-control" value="{{ $viewestimateid }}" readonly>
                                                    <input type="hidden" value="{{$viewestimateid}}" name="hidden_estid">
                                                <span class="error-text password_error"></span>
                                            </div>
                                        </div>
                                        <div class="card mt-5 pt-3 pb-3">

                                            <div class="d-flex align-items-start">
                                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                                    aria-orientation="vertical">
                                                    @if ($stagenames = App\Models\Stage::where('estid',$viewestimateid)->groupBy('stage_num')->get())
                                                        @foreach ($stagenames as $stage)
                                                            <button class="nav-link" id="v-pills-{{ $stage->stage_num }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $stage->stage_num }}" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{ $stage->stage_num }}</button>
                                                        @endforeach
                                                    @endif

                                                </div>
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    @if ($stagenames = App\Models\Stage::where('estid', $viewestimateid)->groupBy('stage_num')->get())
                                                        @foreach ($stagenames as $stage)
                                                            <div class="tab-pane fade show "
                                                                id="v-pills-{{ $stage->stage_num }}" role="tabpanel"
                                                                aria-labelledby="v-pills-{{ $stage->stage_num }}-tab">
                                                                {{-- {{ $stage->stage_num }} --}}

                                                                @if ($stagedetails = App\Models\Stage::where('stage_num', $stage->stage_num)->get())
                                                                    <table class="table table-bordered"
                                                                        style="overflow-x:scroll">
                                                                        <thead>
                                                                            <tr>
                                                                                {{-- <th style="width:150px">S.No</th> --}}
                                                                                <th style="width:150px">Qty</th>
                                                                                <th style="width:150px">Unit</th>
                                                                                <th style="width:500px">Description of Work
                                                                                </th>
                                                                                <th style="width:200px">Rate</th>
                                                                                {{-- <th style="width:150px">Per</th> --}}
                                                                                <th style="width:300px">Amount</th>
                                                                                <th><button type="button"
                                                                                        class="btn btn-success stage1add"><i
                                                                                            class="fa fa-plus"
                                                                                            aria-hidden="true"></i></button>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="stage1">
                                                                            @foreach ($stagedetails as $details)
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-input mt-3">

                                                                                            <input type="text"
                                                                                                name="stageqty[]"
                                                                                                id="stageqty"
                                                                                                class="qty form-control" value="{{$details->qty}}">
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-input mt-3">
                                                                                            {{-- <input type="text"
                                                                                                name="stageunit[]"
                                                                                                class="form-control" value="{{$details->unit}}"> --}}
                                                                                                <select class="form-control" name="stageunit[]">
                                                                                                    <option value="">-- UOM --</option>
                                                                                                    <option value="Cft" @if($details->unit == "Cft") selected @endif>Cft</option>
                                                                                                    <option value="Sft" @if($details->unit == "Sft") selected @endif>Sft</option>
                                                                                                    <option value="MT" @if($details->unit == "MT") selected @endif>MT</option>
                                                                                                    <option value="Nos" @if($details->unit == "Nos") selected @endif>Nos</option>
                                                                                                    <option value="Rft" @if($details->unit == "Rft") selected @endif>Rft</option>
                                                                                                    <option value="LN" @if($details->unit == "LN") selected @endif>LN</option>
                                                                                                    <option value="Coil" @if($details->unit == "Coil") selected @endif>Coil</option>
                                                                                                    <option value="St" @if($details->unit == "St") selected @endif>St</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-input mt-3">
                                                                                            <textarea class="form-control" name="stagedesc[]" style="height:100px">{{ $details->descriptions }}</textarea>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-input mt-3">
                                                                                            <input type="text"
                                                                                                name="stagerate[]"
                                                                                                class="rate form-control"
                                                                                                id="stageonerate1" value="{{$details->rate}}">
                                                                                        </div>
                                                                                    </td>

                                                                                    <td>
                                                                                        <div class="form-input mt-3">
                                                                                            <input type="text"
                                                                                                name="stageamt[]"
                                                                                                class="amt form-control"
                                                                                                id="stageoneamt1" value="{{ $details->amt }}">
                                                                                            <input type="hidden"
                                                                                                name="stagenum[]"
                                                                                                class="form-control"
                                                                                                id=""
                                                                                                value="{{ $details->stage_num }}">
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <button type="button"
                                                                                        class="btn btn-success stage1add mb-3"><i
                                                                                            class="fa fa-plus"
                                                                                            aria-hidden="true"></i></button>
                                                                                        <button type="button"
                                                                                            class="btn btn-danger clear_estimate"><i
                                                                                                class="fa fa-trash"
                                                                                                aria-hidden="true"></i></button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <tr>
                                                                            <td colspan="3">Client Estimate Description</td>
                                                                            <td colspan="3"><textarea class="form-control" name="clientestimatedesc[]">{{$details->clientestimatedesc}}</textarea></td>

                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">Total Amount</td>
                                                                            <td colspan="3"><input type="text" class="form-control stagetotamt" name="stagetotamt[]" value="{{$details->stagetotamt}}"></td>
                                                                            <input type="hidden" name="calcstage[]" value="{{ $details->stage_num }}">
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">Client Percentage</td>
                                                                            <td colspan="3"><input type="number" class="form-control clientpercentage" name="clientpercentage[]" value="{{$details->clientpercentage}}"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">Client Estimate Amount</td>
                                                                            <td colspan="3"><input type="text" class="form-control clientestimateamt" name="clientestimateamt[]" value="{{$details->clientestimateamt}}"></td>
                                                                        </tr>


                                                                        <tr>
                                                                            <td colspan="3">Payment Split</td>
                                                                            <td colspan="3">
                                                                                <select class="form-control paymentsplit" name="paymentsplit[]" >
                                                                                    <option value="">-- Choose --</option>
                                                                                    <option value="1" @if($details->paymentsplit == '1') selected @endif>1</option>
                                                                                    <option value="2" @if($details->paymentsplit == '2') selected @endif>2</option>
                                                                                    <option value="3" @if($details->paymentsplit == '3') selected @endif>3</option>
                                                                                    <option value="4" @if($details->paymentsplit == '4') selected @endif>4</option>
                                                                                    <option value="5" @if($details->paymentsplit == '5') selected @endif>5</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">Due Amount</td>
                                                                            <td colspan="3"><input type="text" class="form-control dueamount" name="dueamount[]" value="{{ $details->dueamount }}"></td>
                                                                        </tr>
                                                                    </table>
                                                                @endif
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
                                    <button type="submit" class="btn btn-success mt-3">Update Main Estimate</button>
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
