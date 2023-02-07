<div class="row animi-container fallIn">
    <div class="col-lg-12">
        <form id="edit_zone_form">
            @csrf
            <div class="zone-box ">
                <h4 class="my-3">Zone Infomation</h4>
                <div class="form-input">
                    <label for="">Name</label><span class="text-danger">*</span><br>
                    <input type="text" class="zone_id_input zone_id" name="zone_id" style="width: 95%"
                        autocomplete="off" value="{{ $data->zone_id }}">
                </div>
                <h4 class="my-4">District Infomation</h4>
                <div class="field_groups">
                    <div class="row extra_fields position-relative">
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label for="">Name</label><span class="text-danger">*</span><br>
                                <select class="form-select district_name_input district_name zone_district_name_select"
                                    name="district_name">
                                    <option value="" disabled> Select District Name
                                    </option>

                                    @foreach ($districtName as $districtN)
                                        <option value="{{ $districtN }}"
                                            {{ $districtN == $data->district_name ? 'selected' : '' }}>
                                            {{ $districtN }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label for="">Code</label><span class="text-danger">*</span><br>
                                <select class="form-select district_code  district_code_input zone_district_code_select"
                                    name="district_code">
                                    <option value="" disabled>Select District Code</option>

                                    @foreach ($districtCode as $districtC)
                                        <option value="{{ $districtC }}"
                                            {{ $districtC == $data->district_code ? 'selected' : '' }}>
                                            {{ $districtC }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary editzone">Update Chnages</button>
            </div>
        </form>
    </div>
</div>
