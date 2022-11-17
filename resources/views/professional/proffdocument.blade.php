@extends('professional.layout.layout')
@section('head_title','DOCUMENTS')
@section('content')
<?php error_reporting(0);?>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Update Documents</h3>
         </div>
         <div class="card-body mt-0">
            <form class="form-horizontal" method="POST" action="{{ url('pro/proff-documents') }}" id="documents" name="documents" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row mb-2">
                     <input type="hidden" value="{{ $details->id }}" name="id">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">License Number</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $details->license_no }}" id="license_no" name="license_no">
                     </div>
                  </div>
                  <div class="form-group row mb-2">
                     <label for="inputfile" class="col-sm-2 col-form-label">License Document</label>
                     <div class="col-sm-10">
                        <div class="">
                           <input type="file" class="form-control" name="license_doc" accept="image/jpeg,image/png,application/pdf,image/jpg"id="license_doc"><br>
                           <img src="{{ url('public/upload/pro_doc/'.$details->license_doc) }}" height="100px" width="100px">
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <button type="submit" class="btn btn-info">Update</button>
                  </div>
                  <!-- /.card-footer -->
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
