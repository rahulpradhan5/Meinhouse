@extends('professional.layout.layout')
@section('content')
<div class="content-wrapper">

    <section class="content"><br>
   <div class="container-fluid">
                  <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Update Banking and Additional Information</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form class="form-horizontal" method="POST" action="{{ url('proff-banking') }}" name="banking" id="banking" enctype="multipart/form-data">
            {{-- <input type="hidden" name="_token" value="VhgBkZreKlkjzGC6riQe5O8njh4MalfEJTaGpO4S"> --}}
            @csrf
            <div class="card-body">
                <input type="hidden" value="{{ $details->id }}" name="id">
               <div class="form-group row">
                  <label for="text" class="col-sm-2 col-form-label">Routing Number</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->routing_no }}" id="routing_no" name="routing_no">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="text" class="col-sm-2 col-form-label">Account Number</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->account_no }}" id="account_no" name="account_no">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="text" class="col-sm-2 col-form-label">City</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->city }}" id="city" name="city">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="text" class="col-sm-2 col-form-label">Province</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->province }}" id="province" name="province">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="text" class="col-sm-2 col-form-label">Postal Code</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->postal_code }}" id="postal_code" name="postal_code">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="text" class="col-sm-2 col-form-label">Experience</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->experience }}" name="experience">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="text" class="col-sm-2 col-form-label">How many Kilometers are you willing to travel to provide service from home?</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" value="{{ $details->distance }}" id="distance" name="distance">
                  </div>
               </div>
               <div class="form-group row">
                <label for="inputfile" class="col-sm-2 col-form-label">Insurance</label>
                  <div class="col-sm-10">
                     <div class="field_wrapper">

                        <input type="file" class="form-control" name="insurance" id="insurance"><br>
                            <img src="{{ url('public/upload/pro_ins/'.$details->insurance) }}" height="100px" width="100px">
                        </div>
                  </div>
               </div>

               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-info" style="float:right;">Update</button>
               </div>
            </div>
            <!-- /.card-footer -->
         </form>
      </div>
   </div>
</section>

  </div>

@endsection
