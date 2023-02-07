<table id="zoneexample" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Zone_ID</th>
            <th>District Name</th>
            <th>District Code</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($zones as $zone)
            <tr class="odd">
                <td>{{ $zone->zone_id }}</td>
                <td>{{ $zone->district_name }}</td>
                <td>{{ $zone->district_code }}</td>
                <td>
                    <div class="action_container">
                        {{-- <button class="view_btn" data-bs-target=".view_zone_modal" data-bs-toggle="modal"
                            data-zone-id={{ $zone->id }}>
                            <i class="fas fa-eye"></i>
                        </button> --}}
                        <button class="edit_btn" data-bs-target=".edit_zone_modal" data-bs-toggle="modal"
                            data-zone-id={{ $zone->id }}>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete_btn" class="delete_btn" data-zone-id={{ $zone->id }}>
                            <i class="fas text-danger fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>

</table>
