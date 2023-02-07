@isset($data)
    <div class="row animi-container fallIn">
        <div class="col-lg-12">
            <form action="">
                @csrf
                <div class="zone-box">
                    <h4 class="my-3">District Infomation</h4>
                    <div class="field_groups_district">
                        <div class="row extra_fields position-relative">
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label for="">Name</label><span class="text-danger">*</span><br>
                                    <input type="text" name="district_name" class="district_name"
                                        value="{{ $data->district_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label for="">Code</label><span class="text-danger">*</span><br>
                                    <input type="text" name="district_code" value="{{ $data->district_code }}"
                                        class="district_code" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="my-4">Taluk Infomation</h4>
                    <div class="taluk_field_groups">
                        <div class="row extra_fields position-relative">
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label for="">Name</label><span class="text-danger">*</span><br>
                                    <input type="text" name="taluk_name" value="{{ $data->taluk_name }}"
                                        class="taluk_name_input taluk_name" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label for="">Code</label><span class="text-danger">*</span><br>
                                    <input type="text" name="taluk_code" value="{{ $data->taluk_code }}"
                                        class="taluk_code_input taluk_code" disabled>
                                </div>
                            </div>
                            {{-- <div class="taluk_plus"><i class="fas fa-plus"></i></div> --}}
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
@endisset
