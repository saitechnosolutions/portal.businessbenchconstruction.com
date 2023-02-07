@extends('layout.app')
@section('title','Completed Projects')
@section('main-content')

    <section>
        {{-- {{ $getallclient }} --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="section-heading">Completed Works</h4>
                        </div>

                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="row">
                                    @foreach($works as $data)
                                        <div class="col-lg-3">
                                            
                                                <div class="clientdetailsbox completed" data-id="{{$data->engineercode}}" data-bs-toggle="modal" data-bs-target="#view_works">
                                                    <div class="clientcontent">
                                                        <div class="clienticons">
                                                            {{-- <i class="fa fa-map" aria-hidden="true"></i> --}}
                                                            <img src="/assets/images/bb_folder_img.png" class="img-fluid">
                                                        </div>
                                                        <h5 class="text-center mt-3">{{$data->name}}</h5>
                                                        <h6>{{$data->clientcode}}</h6>
                                                    </div>

                                                </div>
                                            
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="view_works" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content modal-xl">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body completed_body">
                
                

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        
          </div>
        </div>
      </div>

      
        
    </div>
      </div>


      
@endsection
