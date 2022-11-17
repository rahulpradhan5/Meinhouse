
@extends('professional.layout.layout')
@section('content')
<div class="content-wrapper">

    <section class="content"><br>
   <div class="container-fluid">
                        <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Documents</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->

         <form class="form-horizontal" method="POST" action="{{ url('proff-documents') }}" id="documents" name="documents" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" name="_token" value="VhgBkZreKlkjzGC6riQe5O8njh4MalfEJTaGpO4S"> --}}
            <div class="card-body">
               <div class="form-group row">
                   <input type="hidden" value="{{ $details->id }}" name="id">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">License Number</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->license_no }}" id="license_no" name="license_no">
                  </div>
               </div>
               <div class="form-group row">
                <label for="inputfile" class="col-sm-2 col-form-label">License Document</label>
                  <div class="col-sm-10">
                    <div class="field_wrapper">

                        <input type="file" class="form-control" name="license_doc" id="license_doc"><br>
                        <img src="{{ url('public/upload/pro_doc/'.$details->license_doc) }}" height="100px" width="100px">
                    </div>
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-info" style="float:right;">Update</button>
               </div>
               <!-- /.card-footer -->
         </form>
         </div>
      </div>
   </div>
</section>

  </div>
@endsection
