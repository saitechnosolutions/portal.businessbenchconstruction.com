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
                        <h4 class="section-heading">Create Additional Estimate</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form name="saveadditionalest" id="saveadditionalest" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf

                    <div class="container-fluid">
                        <div class="row">

                             <div class="col-lg-12">
                                    {{-- <h5>General Information</h5> --}}
                                    <div class="row">

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
                                                        <textarea class="form-control" name="stagedesc[]" style="height:100px"></textarea>
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

                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success stage1add mb-3"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>


                                            {{-- <tr>
                                                <td colspan="3">Client Estimate Description</td>
                                                <td colspan="3"><textarea class="form-control" name="clientestimatedesc"></textarea></td>

                                            </tr> --}}
                                            <tr>
                                                <td colspan="3">Total Amount</td>
                                                <td colspan="3"><input type="text" class="form-control stagetotamt" name="stagetotamt"></td>

                                            </tr>
                                            <tr>
                                                <td colspan="3">Client Percentage</td>
                                                <td colspan="3"><input type="number" class="form-control clientpercentage" name="clientpercentage"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Client Estimate Amount</td>
                                                <td colspan="3"><input type="text" class="form-control clientestimateamt" name="clientestimateamt"></td>
                                            </tr>


                                            <tr>
                                                <td colspan="3">Payment Split</td>
                                                <td colspan="3">
                                                    <select class="form-control paymentsplit" name="paymentsplit" >
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
                                                <td colspan="3"><input type="text" class="form-control dueamount" name="dueamount"></td>
                                            </tr>
                                            @foreach ($aeadditionalestimates as $details)
                                            @endforeach
                                            <input type="hidden" name="engineerid" value="{{ $details->engineerid }}">
                                            <input type="hidden" name="clientid" value="{{ $details->clientid }}">
                                            <input type="hidden" name="additionalestid" value="{{ $details->additionalestid }}">
                                            </tbody>

                                        </table>



                                    </div>
                                            <button type="submit" class="btn btn-success mt-3">Upload Main Estimate</button>
                                     </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </section>
@endsection
