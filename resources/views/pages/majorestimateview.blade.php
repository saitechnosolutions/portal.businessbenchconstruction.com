@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-9">
                            <h4 class="section-heading">Major Estimate</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3" >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Description Of Works</th>
                                {{-- <th>Quantity</th>
                                <th>Unit</th>
                                <th>Rate</th> --}}
                                <th>Amount</th>
                                {{-- <th>5% Rentention Amount</th>
                                <th>Balance Amount</th>
                                <th>% Work Completed</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if($getestimatedetails)
                                @php $i=1; @endphp
                                @foreach ($getestimatedetails as $mailestimate)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>{{ $mailestimate->descriptions }}</td>
                                        {{-- <td>{{ $mailestimate->qty }}</td>
                                        <td>{{ $mailestimate->unit }}</td>
                                        <td>{{ number_format($mailestimate->rate,2) }}</td> --}}
                                        <td>{{ number_format($mailestimate->amt,2) }}</td>
                                        {{-- <td>{{ number_format($mailestimate->rentation_amt,2) }}</td>
                                        <td>{{ number_format($mailestimate->balance_amt,2) }}</td>
                                        <td>{{ number_format($mailestimate->balance_amt/$totamt*100,1) }}</td> --}}
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"><b>Total Amount</b></td>
                                    <td>
                                        @if($totamt1 = App\Models\Stage::where('estid',$estid)->sum('amt'))
                                            {{ number_format($totamt1,2) }}
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @if($totamt2 = App\Models\Stage::where('estid',$estid)->sum('rentation_amt'))
                                            {{ number_format($totamt2,2) }}
                                        @endif
                                    </td> --}}
                                    {{-- <td>
                                        @if($totamt3 = App\Models\Stage::where('estid',$estid)->sum('balance_amt'))
                                            {{ number_format($totamt3,2) }}
                                        @endif
                                    </td> --}}
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection
