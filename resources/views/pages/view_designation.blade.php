<div class="row animi-container fallIn">
    <div class="col-lg-12">
        <form method="post" id="view_designation_form">
            @csrf
            <div class="zone-box create-designation-zone-box">
                <div class="field_groups_district">
                    <div class="row extra_fields position-relative">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <label for="">Designation Name</label><span class="text-danger">*</span><br>
                                <input type="text" name="designation_name" class="designation_name"
                                    placeholder="Enter designation...." value="{{ $data->designation_name }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
