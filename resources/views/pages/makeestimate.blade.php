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
                <form name="saveestimate" id="saveestimate" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
                                                    <input type="text" name="estimateid" style="width: 95%" id="password" class="form-control" value="{{ $estimateid }}" readonly>
                                                    <span class="error-text password_error"></span>
                                                </div>
                                            </div>
                                            <div class="card mt-5 pt-3 pb-3">

                                            <div class="d-flex align-items-start">
                                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    @if ($stagenames = App\Models\temptwoestimate::where('estid',$estimateid)->get())
                                                        @foreach ($stagenames as $stage)
                                                            <button class="nav-link" id="v-pills-{{ $stage->stage_num }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $stage->stage_num }}" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{ $stage->stage_num }}</button>
                                                        @endforeach
                                                    @endif

                                                </div>
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    @if ($stagenames = App\Models\temptwoestimate::where('estid',$estimateid)->get())
                                                    @foreach ($stagenames as $stage)
                                                    <div class="tab-pane fade show " id="v-pills-{{ $stage->stage_num }}" role="tabpanel" aria-labelledby="v-pills-{{ $stage->stage_num }}-tab">
                                                        {{-- {{ $stage->stage_num }} --}}

                                                        @if ($stagedetails = App\Models\stagemaster::where('stageid',$stage->stage_num)->get())
                                                        <table class="table table-bordered" style="overflow-x:scroll">
                                                            <thead>
                                                                <tr>
                                                                    {{-- <th style="width:150px">S.No</th> --}}
                                                                    <th style="width:150px">Qty</th>
                                                                    <th style="width:150px">Unit</th>
                                                                    <th style="width:500px">Description of Work</th>
                                                                    <th style="width:200px">Rate</th>
                                                                    {{-- <th style="width:150px">Per</th> --}}
                                                                    <th style="width:300px">Amount</th>
                                                                    <th><button type="button" class="btn btn-success stage1add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="stage1">
                                                            @foreach ($stagedetails as $details)
                                                            <tr>
                                                                <td>
                                                                    <div class="form-input mt-3">
                                                                        <input type="number" name="stageqty[]" id="stageqty" class="qty form-control" >
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-input mt-3">
                                                                        {{-- <input type="text" name="stageunit[]" class="form-control"> --}}
                                                                        <select class="form-control" name="stageunit[]">
                                                                            <option value="">-- UOM --</option>
                                                                            <option value="Cft">Cft</option>
                                                                            <option value="Sft">Sft</option>
                                                                            <option value="MT">MT</option>
                                                                            <option value="Nos">Nos</option>
                                                                            <option value="Rft">Rft</option>
                                                                            <option value="LN">LN</option>
                                                                            <option value="Coil">Coil</option>
                                                                            <option value="St">St</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-input mt-3">
                                                                        <textarea class="form-control" name="stagedesc[]" style="height:100px">{{ $details->description }}</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-input mt-3">
                                                                        <input type="number" name="stagerate[]" class="rate form-control" id="stageonerate1" >
                                                                    </div>
                                                                </td>
                                                                {{-- <td>
                                                                    <div class="form-input mt-3">
                                                                        <input type="text" name="stageper[]" class="form-control">
                                                                    </div>
                                                                </td> --}}
                                                                <td>
                                                                    <div class="form-input mt-3">
                                                                        <input type="number" name="stageamt[]" class="amt form-control" id="stageoneamt1" value="0">
                                                                        <input type="hidden" name="stagenum[]" class="form-control" id="" value="{{ $details->stageid }}">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success stage1add mb-3"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                </td>
                                                            </tr>

                                                            @endforeach
                                                            <tr>
                                                                <td colspan="3">Client Estimate Description</td>
                                                                <td colspan="3"><textarea class="form-control" name="clientestimatedesc[]"></textarea></td>

                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">Total Amount</td>
                                                                <td colspan="3"><input type="text" class="form-control stagetotamt" name="stagetotamt[]"></td>
                                                                <input type="hidden" name="calcstage[]" value="{{ $details->stageid }}">
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">Client Percentage</td>
                                                                <td colspan="3"><input type="number" class="form-control clientpercentage" name="clientpercentage[]"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">Client Estimate Amount</td>
                                                                <td colspan="3"><input type="text" class="form-control clientestimateamt" name="clientestimateamt[]"></td>
                                                            </tr>


                                                            <tr>
                                                                <td colspan="3">Payment Split</td>
                                                                <td colspan="3">
                                                                    <select class="form-control paymentsplit" name="paymentsplit[]" >
                                                                        <option value="">-- Choose --</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">Due Amount</td>
                                                                <td colspan="3"><input type="text" class="form-control dueamount" name="dueamount[]"></td>
                                                            </tr>
                                                            </tbody>

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
                                            <button type="submit" class="btn btn-success mt-3">Save Main Estimate</button>
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
