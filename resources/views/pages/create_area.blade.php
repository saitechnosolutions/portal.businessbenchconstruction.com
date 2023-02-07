@extends('layout.app')
@section('title', 'Business Bench | Areas')
@section('main-content')
    <section>
        <div class="container-fluid">
            <div class="row table_container">
                <div class="col-lg-12">
                    <h4 class="section-heading">Area List</h4>
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive" id="re_render">
                                        <table id="areaexample" class="table display table-striped" style="width:100%">
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
                                                    <tr class="odd">
                                                        <td>{{ $area->district_name }}</td>
                                                        <td>{{ $area->district_code }}</td>
                                                        <td>{{ $area->taluk_name }}</td>
                                                        <td>{{ $area->taluk_code }}</td>
                                                        <td>
                                                            <div class="action_container">
                                                                {{-- <button class="view_btn" data-bs-target=".view_area_modal"
                                                                    data-bs-toggle="modal" data-area-id={{ $area->id }}>
                                                                    <i class="fas fa-eye"></i>
                                                                </button> --}}
                                                                <button class="edit_btn" data-bs-target=".edit_area_modal"
                                                                    data-bs-toggle="modal" data-area-id={{ $area->id }}>
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="delete_btn" class="delete_btn"
                                                                    data-area-id={{ $area->id }}>
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
                        data-bs-target=".create_area_modal">
                        <img src="/assets/images/dashboard/adduser.svg" class="img-fluid create_btn_image">Create Area
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade create_area_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Area Creation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">Create Area</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="create_area" method="post" id="add_area_form">
                                @csrf
                                <div class="zone-box create-area-zone-box">
                                    <h4 class="my-3">District Infomation</h4>
                                    <div class="field_groups_district">
                                        <div class="row extra_fields position-relative">
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label for="">Name</label><span class="text-danger">*</span><br>
                                                    <input type="text" name="district_name" class="district_name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label for="">Code</label><span class="text-danger">*</span><br>
                                                    <input type="text" name="district_code" class="district_code">
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
                                                    <input type="text" name="taluk_name[]"
                                                        class="taluk_name_input taluk_name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label for="">Code</label><span class="text-danger">*</span><br>
                                                    <input type="text" name="taluk_code[]"
                                                        class="taluk_code_input taluk_code">
                                                </div>
                                            </div>
                                            <div class="taluk_plus"><i class="fas fa-plus"></i></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary savearea">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade view_area_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Area Creation</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">View Area</h4>
                    <div id="view_form_data">
                        <div class="preloader_container">
                            <img src="{{ asset('assets/images/dashboard/preloader.gif') }}" alt="preloader_logo">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade edit_area_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Area Creation</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">Edit Area</h4>
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
