@extends('layout.app')
@section('title','Payments')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="section-heading">Payment Details</h4>
                        </div>

                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive">

                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Client ID</th>
                                                    <th>Estimate ID</th>
                                                    <th>Stage ID</th>
                                                    <th>Engineer ID</th>
                                                    <th>Amount</th>
                                                    <th>Payment Raise Date</th>
                                                    <th>Amount Pay Date</th>
                                                    <th>Payment Approved Date</th>
                                                    <th>Payment Status</th>
                                                    <th>Payment Method</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if($payments)
                                                    @foreach ($payments as $pay)
                                                        <tr>
                                                            <td>{{ $pay->clientid }}</td>
                                                            <td>{{ $pay->estimateid }}</td>
                                                            <td>{{ $pay->stageid }}</td>
                                                            <td>{{ $pay->engid }}</td>
                                                            <td>{{ $pay->payamount }}</td>
                                                            <td>{{ $pay->payment_raise_date }}</td>
                                                            <td>{{ $pay->payment_pay_date }}</td>
                                                            <td>{{ $pay->payment_approved_date }}</td>
                                                            <td>
                                                                @if($pay->payment_status == 0)
                                                                    <span class="badge bg-info">Amount Raised</span>
                                                                @endif
                                                                @if($pay->payment_status == 2)
                                                                    <span class="badge bg-warning">Amount Paid</span>
                                                                @endif
                                                                @if($pay->payment_status == 1)
                                                                    <span class="badge bg-success">Payment Approved</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $pay->payment_mode }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>
    </section>



@endsection
