@extends('layout.app')
@section('title','Estimates')
@section('main-content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr >
                            <th colspan="4" class="text-center">Business Bench Construction Limited</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-center">Karur</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-center">Civil Works</th>
                        </tr>
                        <tr>
                            <th class="text-center">S.No</th>
                            <th class="text-center" style="width:500px">Stage Wise</th>
                            <th class="text-center" style="width:300px">Amount</th>
                            <th class="text-center">% Of Work Complete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-left">{{ $getestimate->stageonetitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stageoneamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stageoneamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @if($getestimate->stagetwotitle != '')
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-left">{{ $getestimate->stagetwotitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagetwoamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagetwoamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stagethreetitle != '')
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-left">{{ $getestimate->stagethreetitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagethreeamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagethreeamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stagefourtitle != '')
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-left">{{ $getestimate->stagefourtitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagefouramt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagefouramt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stagefivetitle != '')
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-left">{{ $getestimate->stagefivetitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagefiveamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagefiveamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stagesixtitle != '')
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-left">{{ $getestimate->stagesixtitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagesixamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagesixamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stageseventitle != '')
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-left">{{ $getestimate->stageseventitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagesevenamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagesevenamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stageeighttitle != '')
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-left">{{ $getestimate->stageeighttitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stageeightamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stageeightamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stageninetitle != '')
                        <tr>
                            <td class="text-center">9</td>
                            <td class="text-left">{{ $getestimate->stageninetitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagenineamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagenineamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        @endif
                        @if($getestimate->stageeentitle != '')
                        <tr>
                            <td class="text-center">10</td>
                            <td class="text-left">{{ $getestimate->stageeentitle }}</td>
                            <td style="text-align: right">
                                {{ number_format($stagetenamt,2) }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format(($stagetenamt/$estimatetotamt)*100,0) }}%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-center"><b>Total</b></td>
                            <td style="text-align: right">
                                <b>{{ number_format($estimatetotamt,2) }}</b>
                            </td>
                            <td style="text-align:center">
                                <b>100%</b>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
