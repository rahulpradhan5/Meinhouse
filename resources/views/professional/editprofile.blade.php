@extends('professional.layout.layout')
@section('head_title','PROFILE')
@section('content')
   <div class="row">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>
         </div>
          @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
         <!-- /.card-header -->
         <!-- form start -->
          <form method="POST" action="{{ url('pro/edit-profile') }}" id="update-profile" name="update-profile" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">

         	<div class="col-md-2">
                      <div class="profile-picture-container">
                          <div class="profile-picture-group">
                              @if($details->user_image!=NULL)
                          <img class="profile-picture"  id="blah" src="{{ url('public/upload/pro_profile/'.$details->user_image) }}"
                          height="90" width="100" style="border-radius: 50%">
                          @else
                          <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="" height="90" width="100" style="border-radius: 50%">
                          @endif
                          <label class="profile-picture-button" for="file-input">
                          <img src="https://meinhaus.ca/public/image/icon-edit.png">
                          </label>
                          <input id="file-input" style="display:none"type="file" accept="image/png, image/jpeg" name="profile_image" onchange="readURL(this);">
                          </div>
                      </div>
         	</div>
            <div class="col-md-10">

            	 <div class="form-group row mb-2">
	               <label for="text" class="col-sm-2 col-form-label">Name</label>
	               <div class="col-sm-10">
	                  <input type="text" class="form-control" id="name" name="name" value="{{ $details->name }}">
	               </div>
	            </div>
	            <div class="form-group row mb-2">
	               <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
	               <div class="col-sm-10">
	                  <input type="text" class="form-control" id="email" name="email" value="{{ $details->email }}" readonly="">
	               </div>
	            </div>
	            <div class="form-group row mb-2">
	               <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
	               <div class="col-sm-10">
	                  <input type="text" class="form-control" id ="phone_no" name="phone_no" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" value="{{ $details->phone }}">
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
@endsection
