<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Designation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($designations as $designation)
            <tr class="odd">
                <td>{{ $designation->designation_name }}</td>
                <td>
                    <div class="action_container">
                        {{-- <button class="view_btn" data-bs-target=".view_designation_modal" data-bs-toggle="modal"
                            data-designation-id={{ $designation->id }}>
                            <i class="fas fa-eye"></i>
                        </button> --}}
                        <button class="edit_btn" data-bs-target=".edit_designation_modal" data-bs-toggle="modal"
                            data-designation-id={{ $designation->id }}>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete_btn" class="delete_btn" data-designation-id={{ $designation->id }}>
                            <i class="fas text-danger fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>

</table>
