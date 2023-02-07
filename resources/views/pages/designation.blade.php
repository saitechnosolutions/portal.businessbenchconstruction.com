@extends('layout.app')
@section('title', 'Business Bench | Designations')
@section('main-content')
    <section>
        <div class="container-fluid">
            <div class="row table_container">
                <div class="col-lg-12">
                    <h4 class="section-heading">Designation List</h4>
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive" id="re_render">
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
                                                                {{-- <button class="view_btn"
                                                                    data-bs-target=".view_designation_modal"
                                                                    data-bs-toggle="modal"
                                                                    data-designation-id={{ $designation->id }}>
                                                                    <i class="fas fa-eye"></i>
                                                                </button> --}}
                                                                <button class="edit_btn"
                                                                    data-bs-target=".edit_designation_modal"
                                                                    data-bs-toggle="modal"
                                                                    data-designation-id={{ $designation->id }}>
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <!--<button class="delete_btn" class="delete_btn"-->
                                                                <!--    data-designation-id={{ $designation->id }}>-->
                                                                <!--    <i class="fas text-danger fa-trash-alt"></i>-->
                                                                <!--</button>-->
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
                        data-bs-target=".create_designation_modal">
                        <img src="/assets/images/dashboard/adduser.svg" class="img-fluid create_btn_image">Create
                        Designation
                    </button>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade create_designation_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Designation Creation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">Create Designation</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" id="add_designation_form">
                                @csrf
                                <div class="zone-box create-designation-zone-box">

                                    <div class="field_groups_district">
                                        <div class="row extra_fields position-relative">
                                            <div class="col-lg-12">
                                                <div class="form-input">
                                                    <label for="">Designation Name</label><span
                                                        class="text-danger">*</span><br>
                                                    <input type="text" name="designation_name" class="designation_name"
                                                        placeholder="Enter designation....">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary savedesignation">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade view_designation_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">designation Creation</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">View designation</h4>
                    <div id="view_form_data">
                        <div class="preloader_container">
                            <img src="{{ asset('assets/images/dashboard/preloader.gif') }}" alt="preloader_logo">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade edit_designation_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">designation Creation</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="section-heading">Edit designation</h4>
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
