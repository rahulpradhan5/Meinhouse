@extends('professional.layout.layout')
@section('content')
<div class="content-wrapper">

    <section class="content">
   <br>
   <div class="container-fluid">
                  <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
          <form method="POST" action="{{ url('edit-profile') }}" id="update-profile" name="update-profile" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" name="_token" value="VhgBkZreKlkjzGC6riQe5O8njh4MalfEJTaGpO4S"> --}}
            <div class="card-body row">

         	<div class="col-md-2">
                      <div class="profile-picture-container">
                          <div class="profile-picture-group">
                          <img class="profile-picture"  id="blah" src="{{ url('public/upload/pro_profile/'.$details->user_image) }}"
                          height="90" width="100" style="border-radius: 50%">
                          <label class="profile-picture-button" for="file-input">
                          <img src="https://meinhaus.ca/theme/images/icon-edit.png">
                          </label>
                          <input id="file-input" type="file" accept="image/png, image/jpeg" name="profile_image" onchange="readURL(this);">
                          </div>
                      </div>
         	</div>
            <div class="col-md-10">

            	 <div class="form-group row">
	               <label for="text" class="col-sm-2 col-form-label">Name</label>
	               <div class="col-sm-10">
	                  <input type="text" class="form-control" id="name" name="name" value="{{ $details->name }}">
	               </div>
	            </div>
	            <div class="form-group row">
	               <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
	               <div class="col-sm-10">
	                  <input type="text" class="form-control" id="email" name="email" value="{{ $details->email }}" readonly="">
	               </div>
	            </div>
	            <div class="form-group row">
	               <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
	               <div class="col-sm-10">
	                  <input type="text" class="form-control" id ="phone_no" name="phone_no" value="{{ $details->phone }}">
	               </div>
	            </div>
	            <div class="row">
	               <div class="col-12">
	                  <div class="card-footer">
	                     <button type="submit" class="btn btn-info" style="float:right;">Update</button>
	                  </div>
	               </div>
	            </div>

            </div>
         </div>
        </form>
         <!-- </form>-->
      </div>
   </div>
</section>


  </div>


@endsection
