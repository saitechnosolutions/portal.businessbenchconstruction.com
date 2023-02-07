@extends('layout.app')
@section('title', 'Business Bench | Zones')
@section('main-content')
    <section>
        <div class="container-fluid">
            <div class="row table_container">
                <div class="col-lg-12">
                    <h4 class="section-heading">Zone List</h4>
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive" id="re_render">
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
                                                                {{-- <button class="view_btn" data-bs-target=".view_zone_modal"
                                                                    data-bs-toggle="modal" data-zone-id={{ $zone->id }}>
                                                                    <i class="fas fa-eye"></i>
                                                                </button> --}}
                                                                <button class="edit_btn" data-bs-target=".edit_zone_modal"
                                                                    data-bs-toggle="modal" data-zone-id={{ $zone->id }}>
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="delete_btn" class="delete_btn"
                                                                    data-zone-id={{ $zone->id }}>
                                                                    <i class="fas text-danger fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 modal_popup_btn">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target=".create_zone_modal">
                        <img src="/assets/images/dashboard/adduser.svg" class="img-fluid create_btn_image">Create Zone
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade create_zone_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zone Creation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">Create Zone</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="add_zone_form">
                                @csrf
                                <div class="zone-box ">
                                    <h4 class="my-3">Zone Infomation</h4>
                                    <div class="form-input">
                                        <label for="">Name</label><span class="text-danger">*</span><br>
                                        <input type="text" class="zone_id_input zone_id" name="zone_id"
                                            style="width: 95%" autocomplete="off">
                                    </div>
                                    <h4 class="my-4">District Infomation</h4>
                                    <div class="field_groups">
                                        <div class="row extra_fields position-relative">
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label for="">Name</label><span class="text-danger">*</span><br>
                                                    <select
                                                        class="form-select district_name_input district_name zone_district_name_select"
                                                        name="district_name[]">
                                                        <option selected value="" disabled> Select District Name
                                                        </option>
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district }}">{{ $district }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label for="">Code</label><span class="text-danger">*</span><br>
                                                    <select
                                                        class="form-select district_code  district_code_input zone_district_code_select"
                                                        name="district_code[]">
                                                        <option selected value="">Select District Code</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="plus zone_plus"><i class="fas fa-plus"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary savezone">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="modal fade view_zone_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">zone Creation</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">View Zone</h4>
                    <div id="view_form_data">
                        <div class="preloader_container">
                            <img src="{{ asset('assets/images/dashboard/preloader.gif') }}" alt="preloader_logo">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade edit_zone_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Zone Creation</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">Edit Zone</h4>
                    <div id="edit_form_data">
                        <div class="preloader_container">
                            <img src="{{ asset('assets/images/dashboard/preloader.gif') }}" alt="preloader_logo">
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>
@endsection
{{--  --}}
