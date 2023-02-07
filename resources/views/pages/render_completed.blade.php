<div class="completed-box">
    <table>
        <tr>
            <th>Lead ID</th>
            <th>Clinet Name</th>
            <th>Type of Services</th>
            <th>Address</th>
            <th>Mobile Number</th>
        </tr>
        <tr>
            <td>{{$client_data->leadid}}</td>
            <td>{{$client_data->name}}</td>
            <td>{{$lead_data->email}}</td>
            <td><div class="address_com">{{$client_data->address}}</div></td>
            <td>{{$client_data->mobilenumber}}</td>
        </tr>
        <tr>
            <th>Budget Value</th>
            <th>Payment</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Plotarea</th>
        </tr>
        @php
            $first_date = $client_data->projectstartdate;
            $second_date = $client_data->expecteddate;
            $newDateone = date("d-m-Y", strtotime($first_date));
            $newDatetwo = date("d-m-Y", strtotime($second_date));
        @endphp
        <tr>
            <td>{{$lead_data->budgetvalue}}</td>
            <td>{{$lead_data->payment}}</td>
            <td>{{$newDateone}}</td>
            <td>{{$newDatetwo}}</td>
            <td>{{$client_data->plotarea}}</td>
        </tr>
        <tr>
            <th>Type of Services</th>
        </tr>
        <tr>
            <td>{{$client_data->typeofservices}}</td>
        </tr>
    </table>
</div>

<div class="completed_imgs">
    <div class="row justify-content-center mt-4">
    @foreach($complete_data as $data)
        <div class="col-lg-3">
            <div class="finished_img">
                <img src="images/{{$data->imagenames}}">
            </div>
        </div>
    @endforeach
    </div>
</div>