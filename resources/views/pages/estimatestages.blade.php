@extends('layout.app')
@section('title','Estimate Stages')
@section('main-content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-lg-9">
                            <h4 class="section-heading">Estimate Stages</h4>
                        </div>


                        <div class="col-lg-3">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#importstages">
                                <img src="/assets/images/dashboard/adduser.svg" class="img-fluid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Import Stages
                              </button>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="userdetails">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Stage ID</th>
                                                    <th>Stage Name</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="estimatestage">
                                                @if($stages)
                                                    @foreach ($stages as $s)
                                                        <tr>
                                                            <td>{{ $s->stageid }}</td>
                                                            <td>{{ $s->stagename }}</td>
                                                            <td>{{ $s->description }}</td>
                                                            <td>
                                                                <button class="btn btn-info editstage" data-edit="{{ $s->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                                <button class="btn btn-danger deletestage" data-delete="{{ $s->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>

                                        </table>
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



    <div class="modal fade" id="importstages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="estimaterequest" id="stagemasterimport" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Stages</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p style="color:red">Please Follow the Stage ID <span style="color:red">*</span></p>
                    <input type="file" name="import_stage" class="form-control" required>

            </div>
            <div class="modal-footer">
                <a href="/import_excel/STAGE_IMPORT.csv" download class="btn btn-info">Download Sample</a>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </form>
        </div>
      </div>

      <div class="modal fade" id="editstage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="estimaterequest" id="stageupdate" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Stages</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <input type="text" class="form-control" name="stageid" id="stageid" placeholder="Stage ID">
                <input type="text" class="form-control mt-3" name="stagename" id="stagename" placeholder="Stage Name">
                <textarea class="form-control mt-3" name="description" id="description" placeholder="Description"></textarea>
                <input type="hidden" name="id" id="sid" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
        </div>
      </div>

@endsection
