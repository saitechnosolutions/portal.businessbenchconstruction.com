@extends('layout.app')
@section('title','Estimates')
@section('main-content')

    <section>

        <div class="container-fluid mt-3">
            <div class="row">
            <div class="col-lg-9">
                <h4 class="section-heading">Process of Works</h4>
            </div>
            <div class="col-lg-3">
                @if(Auth::user()->usertype == '3')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Upload Processing Works
                  </button>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="lightbox_img">
                <span class="close_img">&times;</span>
                <div class="lightbox_inner">
                    <img src="">
                </div>
            </div>
            @if ($processofworks)
                @foreach ($processofworks as $works)
                    <div class="col-lg-3">
                        <div class="drawingdetails process_imgs">
                            <div class="drawing_images">
                                <img src="/images/{{ $works->imagename }}" class="img-fluid">
                            </div>
                            <div class="img_content">
                                <span>Uploaded at: {{date('d-m-Y',strtotime($works->created_at))}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        </div>
    </section>




      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <form name="processimageupload" id="processimageupload" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Image Upload</h5>
              <button type="button" class="close" data-bs-toggle="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                    <div class="form-input">
                        {{-- <label for="">Client ID</label><span class="text-danger">*</span><br> --}}
                        {{-- <select class="form-control" name="clientcode" required>
                            <option value="">-- Choose Client Code --</option>

                        </select> --}}
                        <input type="text" name="clientcode" class="form-control" value="{{ $clientid }}" id="clientcode" readonly>
                        {{-- <input type="text" name="estid" style="width: 100%" id="estid"  readonly> --}}
                    </div>
                    <div class="form-input mt-3">
                        <label for="">Eng ID</label><span class="text-danger">*</span><br>
                        <input type="text" name="engineercode" value="{{ $engid }}" style="width: 100%" id="engineercode"  readonly>
                        <span class="error-text password_error"></span>

                    </div>
                    <label for="">Upload Image</label><span class="text-danger" style="margin-top:30px">*</span><br>
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <input type="file" class="form-control" name="processcompleteimages[]" style="width: 100%" id="enddate">
                            </td>
                            <td>
                                <button type="button" class="btn btn-success imgadd2"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        <tbody id="viewimage">

                        </tbody>
                    </table>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload Images</button>
            </div>
          </div>
        </form>
        </div>
      </div>


      <div class="modal fade" id="viewimagelarge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Work Completed Image</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="" class="img-fluid" id="showimg">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
      </div>
@endsection
