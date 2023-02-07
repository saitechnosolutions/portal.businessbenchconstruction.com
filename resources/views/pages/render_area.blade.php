<table id="areaexample" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>District Name</th>
            <th>District Code</th>
            <th>Taluk Name</th>
            <th>Taluk Code</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($areas as $area)
            <tr>
                <td>{{ $area->district_name }}</td>
                <td>{{ $area->district_code }}</td>
                <td>{{ $area->taluk_name }}</td>
                <td>{{ $area->taluk_code }}</td>
                <td>
                    <div class="action_container">
                        {{-- <button class="view_btn" data-bs-target=".view_area_modal" data-bs-toggle="modal"
                            data-area-id={{ $area->id }}>
                            <i class="fas fa-eye"></i>
                        </button> --}}
                        <button class="edit_btn" data-bs-target=".edit_area_modal" data-bs-toggle="modal"
                            data-area-id={{ $area->id }}>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete_btn" class="delete_btn" data-area-id={{ $area->id }}>
                            <i class="fas text-danger fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
