@extends('admin_jobick.layout.layout')
@section('head_title','Admin Account >> Edit Profile')
@section('content')
    <!-- @if (session('error'))
      <div class="alert alert-danger">
         {{ session('error') }}
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success">
         {{ session('success') }}
      </div>
      @endif -->
      
    
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
    <div class="row">
        <div class="card">
            <form method="POST" action="{{url('admin/edit-profile-post')}}" id="update-profile" name="update-profile" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                    <div class="col-md-2">
                            <div class="profile-picture-container mr-4 p-4">
                                <div class="profile-picture-group">
                                <img class="profile-picture"  id="blah" src="{{Auth::user()->user_image ? url('public/uploads/users/'.Auth::user()->user_image): url('assets/jobick/images/logo.png')}}"
                                height="90" width="100" style="border-radius: 50%">
                                <label class="profile-picture-button" for="file-input">
                                <!-- <img src="{{url('public/image/icon-edit.png')}}"> -->
                                </label>
                                <input id="file-input" style="padding-top:20px;" type="file" accept="image/png, image/jpeg" name="profile_image" onchange="readURL(this);">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-10">
                        
                        <div class="form-group row mb-2">
                        <label for="text" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
                        </div>
                        </div>
                        <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" readonly="">
                        </div>
                        </div>
                        <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id ="phone_no" name="phone_no" value="{{Auth::user()->phone}}">
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
        </div>
    </div>	
@endsection
@section('scripts')
<script type="text/javascript">
var public_url = $('meta[name="base_url"]').attr('content'); 
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah')
          .attr('src', e.target.result)
          .width(100)
          .height(90);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection