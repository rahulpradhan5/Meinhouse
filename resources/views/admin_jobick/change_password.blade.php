@extends('admin_jobick.layout.layout')
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
    <div class="row page-titles">
        <ol class="breadcrumb">
           <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="">Change Password</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="card">
        <form method="POST" action="{{url('admin/change-password-post')}}" id="change-password" name="change-password" enctype="multipart/form-data">
        @csrf
        <div class="card-body row">

        <div class="col-md-12">
            
                <div class="form-group row mb-2">
                <label for="text" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="new_password" name="new_password" >
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id ="confirm_password" name="confirm_password">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" style="float:right;">Change Password</button>
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