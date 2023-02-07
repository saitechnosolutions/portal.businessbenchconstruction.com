@extends('layout.app')
@section('title', 'Business Bench | Create Zone')
@section('main-content')

    <div class="modal-content creation_section">
        @if ($errors->any())
            <div class="custom_dismiss_alert">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible fade show alert_custom_waring">
                        <button type="button" class="btn-close custom_btn_close" data-bs-dismiss="alert"></button>
                        <strong>!!</strong> {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        <div class="modal-body">
            <button class="creation_of_btn">Zone Created</button>

            <div class="zone-box" style="padding-top:80px ">
                <h3 class="my-3 text-center">Zone Infomation</h3>

                <div class="row">
                    <div class="col-lg-6 row flex-direction-column">
                        <p class="text-center zone_text_content">
                            Name
                        </p>
                        <h3 class="text-center">Zone 1</h3>

                    </div>

                    <div class="col-lg-6 row flex-direction-column">
                        <p class="text-center zone_text_content">
                            District Infomation & Code
                        </p>
                        <h3 class="text-center">Chennai </h3>
                    </div>
                </div>
                <div class="rm_information_container">
                    <div class=" row flex-direction-column">
                        <h3 class="text-center">
                            RM Infomation
                        </h3>
                        <h4 class="text-center"><span class="rm_information_code"> SMM02</span> - Prakash ,<span
                                class="rm_information_code"> KMM01 </span> - Thangarajan </h4>
                    </div>
                </div>
                <div class="text-center">
                    <a href="/dashboard">
                        <button type="submit" class="zone_submit">Submit</button>
                    </a>
                </div>

            </div>

        </div>

    @endsection
