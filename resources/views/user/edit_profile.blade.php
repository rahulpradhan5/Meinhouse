@extends('user.layout.layout') @section('content')


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168384510-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-168384510-1');
</script>
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" > -->
<style type="text/css">
  
@keyframes  type{ 
  from { width: 0; } 
} 

@keyframes  type2{
  0%{width: 0;}
  50%{width: 0;}
  100%{ width: 100; } 
} 

@keyframes  blink{
  to{opacity: .0;}
}

::selection{
  background: black;
}

.box1{
  float: left;
  border: 2px solid #1e9bd0;
  width: 100%;
  padding-bottom: 1%;
  padding: 0px 0px;
  min-height:0px;
  border-radius: 10px;
  box-shadow: 0px 6px 1px rgba(16,36,30,.13);
  border: 1px solid #ccc;
  box-shadow: 4px 5px 3px 4px #d8d8d8;
  margin-bottom: 2%;
}
  #top-icon{
    font-weight: bold;
    float: right;
    margin-top: 1%;
   right: 5px;
   padding: 4px 4px;
   color: rgba(0, 150, 255, 1.00);
   position: relative;
   font-size: 21px;
 }
.block{
    float: left;
    color: #0000006e;
    padding: 3px 8px;
}

#delete-icon{
  float: right;
  color: #b71c1ce0;
  font-size: 20px;
  position: relative;
  right: 2%;
}
#location{
float: left;
font-size: 60px;

}
  .box2{
    border: 2px solid #1e9bd0;
    width: 1000px;
    height: 180px;
    margin-top: 15px;
    background-color:  #f0f5f5;
    border-radius: 10px;
    box-shadow: 0 2px 6px 1px rgba(16,36,30,.13);
    border: none;
    margin-left: 60px;
    margin-top: 20px;

  }
  .1
  .button1{
    margin-left: 20px;
    margin-bottom: 20px;

  }
  .box1 p{
    /* margin-left: 20px; */
    /* margin-top: 2px; */
    margin: 0;
    padding: 5px 10px;
  }
  .box2 p{
    margin-left: 20px;
    margin-top: 10px;
  }
  .section4{
     box-shadow: 0 2px 6px 1px rgba(16,36,30,.13);
     border-radius: 10px;
     width: 1130px;
     margin-left: 107px;
     background-color: white !important;
  }
  .section4 .td1{
    margin-top: 40px;
    color: lime; 
    font-family: "Courier";
    font-size: 20px;
    margin: 10px 0 0 10px;
    white-space: nowrap;
    overflow: hidden;
    width: 30em;
    animation: type 4s steps(20, end);
  }
  .profile-picture-container .profile-picture-group {
    position: relative;
    width: 94px;
    height: 94px;
    display: block;
    margin: 0 auto;
  }
  .profile-picture-container .profile-picture-group .profile-picture {
    border-radius: 50%;
    max-width: 100%;
    max-height: 100%;
  }
  .profile-picture-container .profile-picture-group .profile-picture-button {
    position: absolute;
    bottom: 0;
    right: 0;
    margin-bottom: 0;
    cursor: pointer;
  }
  .profile-input{
    width: 884px!important;
    height: 45px!important;

  }
  input#file-input {
      display: none;
  }
  .table td, .table th {
    border-top: 0px;
  }
  #location-one{
    font-size: 60px;
  }
</style>

        <div class="ttm-page-title-row text-center">

<div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

<div class="container">

    <div class="row">

        <div class="col-md-12"> 

            <div class="title-box ttm-textcolor-white">

                <div class="page-title-heading">

                    <h1 class="title">Edit Profile</h1>

                </div><!-- /.page-title-captions -->

                <!-- <div class="breadcrumb-wrapper">

                    <span>

                        <a title="Homepage" href="http://quantumits.online/erikhall/public"><i class="fa fa-home"></i></a>

                    </span>

                    <span class="ttm-bread-sep">&nbsp; HOME &nbsp;</span>

                    <span class="text-primary">&nbsp; >> &nbsp;</span>

                    <span><span>User Login</span></span>

                </div>  --> 

            </div>

        </div><!-- /.col-md-12 -->  

    </div><!-- /.row -->  

</div><!-- /.container -->                      

</div><!-- page-title end-->

<div class="site-main">
<div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">
<div class="container">
<div class="row">
<div class="col-md-8">
  <h4 class="service-title">Profile</h4>
</div>
<div class="col-md-4" >
    
</div>

</div>
<form method="POST" action="{{route('update-profile')}}" id="" name="update-profile" enctype="multipart/form-data">
@csrf
  <div class="row">
  <div class="col-12">
     <div class="featured-imagebox featured-imagebox-post ttm-box-view-left-image row">
        
        <div class="row">
          <div class="col-2">
              <div class="profile-picture-container">
                  <div class="profile-picture-group">
                  <img class="profile-picture"  id="blah" src="@if($user->user_image){{url('public/uploads/users')}}/{{$user->user_image}}@else http://meinhausca.com/public/pros_images/user-dump.png @endif"
                  height="90" width="100" style="border-radius: 50%">
                  <label class="profile-picture-button" for="file-input">
                  <img src="http://meinhausca.com/public/theme/images/icon-edit.png">
                  </label>
                  <input id="file-input" type="file" accept="image/png, image/jpeg, image/jpg" name="profile_image" onchange="readURL(this);">
                  </div>
             </div>
            
          </div>
          <div class="col-10">
          @if(Session::has('message'))
                        <p    class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif   
                                                                           
              <div class="form-group">
                <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Full Name</h5>
               <input type="text" name="name" id="name" class="form-control profile-input" placeholder="Name" value="{{$user->name}}">
                  @error('name')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
              <div class="form-group">
                <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">EMAIL</h5>
               <input type="text" name="email" id="email" class="form-control profile-input" placeholder="Email" value="{{$user->email}}" disabled="" style="background-color: #e9ecef!important;cursor: no-drop;">
                
              </div>
              <div class="form-group">
                <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Phone Number</h5>
               <input type="text" name="phone_no" id="phone_no" class="form-control profile-input" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" placeholder="Phone Number" value="{{$user->phone}}"> 
                 @error('phone_no')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
              </div>
              <button class="text-right" style="float: right;background-color: #1e9bd0;margin-right: -50px">Update</button>
          </div>
        </div>


      </div><!-- featured-imagebox-post end-->
  </div>
</div>
</form>
</div>

<div class="container">
<div class="row">
<div class="col-md-8">
  <h4 class="service-title">Profile</h4>
</div>
<div class="col-md-4" >
    
</div>

</div>
<form method="POST" action="{{route('update-password')}}" id="change-password-user" name="change-password-user" enctype="multipart/form-data">
@csrf      
<div class="row">
  <div class="col-12">
     <div class="featured-imagebox featured-imagebox-post ttm-box-view-left-image row">
        
        <div class="row">
        <div class="col-2">
                  <i class="fa fa-unlock-alt" id="location" style="margin-left: 31px;margin-top: 10px;"></i>
          </div>
          <div class="col-10">
           @if(Session::has('pmessage'))
                        <p    class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('pmessage') }}</p>
           @endif 
          
           @if(Session::has('error'))
                        <p    class="alert alert-danger">{{ Session::get('error') }}</p>
           @endif 
                              
              <div class="form-group">
                <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Current Password</h5>
               <input type="password" name="current_password" id="current_password" class="form-control profile-input" placeholder="Current Password">
                  @error('current_password')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
              </div>
              <div class="form-group">
                <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">New Password</h5>
               <input type="password" name="new_password" id="new_password" class="form-control profile-input" placeholder="New Password">
                 @error('new_password')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
              </div>
              <div class="form-group">
                <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Confirm New Password</h5>
               <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control profile-input" placeholder="Confirm New Password">    
              @error('new_password_confirmation')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
              </div>
              <button class="text-right" style="float: right;background-color: #1e9bd0;margin-right: -50px">Update Password</button>
          </div>
        </div>


      </div><!-- featured-imagebox-post end-->
  </div>
</div>
</form>
</div>
<div id="address_div"></div>
<div class="container" >
<div class="row">
<div class="col-md-8">
  <h4 class="service-title">Address</h4>
</div>
<div class="col-md-4" >
    
</div>

</div>

<div class="row">
  <div class="col-12">
     <div class="featured-imagebox featured-imagebox-post ttm-box-view-left-image row">
        <!-- new deg start-->
        <div class="container adddress-all" >
           <div class="row">
            <div class="col-md-1">
              <i class="fa fa-home" id="location"></i>
              </div>
              <div class="col-md-11">
              
                    @if(Session::has('amessage'))
                              <p    class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('amessage') }}</p>
                @endif   
               
              <div class="col-md-12">
             <button class="add-address btn btn-primary" style="float:right;cursor: pointer">Add address</button>
            @foreach($addresses as $address)
              <div class="box1" style="margin-top: 11px;">
                    <p>{{$address->name}}<i class='fa fa-edit edit-address' id="top-icon" onclick="editAddress('{{$address->id}}')"></i></p> 
                    <span class="block">{{$address->area}}, {{$address->locality}}</span>
                     <span class="block" style="clear: both;">{{$address->state}}</span>
                      <span class="block" style="clear: both;">Pin Code:</span> <span class="block">{{$address->pin_code}}</span>
                      @if($address->primary == 1)
                       <span class="block" style="clear: both; color: #000; font-weight: bold;">DEFAULT ADDRESS</span>
                      
                      @else
                      <a href="{{url('add-primary-address')}}/{{$address->id}}">
                       <span class="block" style="clear: both; color: #000; font-weight: bold;">MAKE THIS DEFAULT ADDRESS</span>
                      </a>
                      
                      @endif

              <a href="{{url('delete-address')}}/{{$address->id}}"><i class="fa fa-trash" id="delete-icon"></i></a>
              </div>
            @endforeach  
                 
              </div>             
               
</div> 
            <!--12-->
            
           </div>
        </div> 
        <!--new deg end -->
        <!-- add-address -->
        
        <!-- end-new-address -->
       <form method="POST" action="{{route('add-address')}}" id="add-address" name="add-address" enctype="multipart/form-data">
           @csrf                 <div class="row add-addttess" style="display: none;">
            <div class="col-md-12">
               <div class="bs-example" style="float: left;margin-left: 17%;padding-bottom: 2%;">
         
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Address type</h5>
          <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" name="address_type" id="customRadio1" value="0" checked>
          <label class="custom-control-label" for="customRadio1">Home</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" name="address_type" id="customRadio2" value="1">
          <label class="custom-control-label" for="customRadio2">Office</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" name="address_type" id="customRadio3" value="2">
          <label class="custom-control-label" for="customRadio3">Others</label>
          </div>
          </div>
          </div><!--col-12-->
          <div class="col-md-2 text-center">
          <i class="fa fa-home" id="location-one"></i>
          </div>
          <div class="col-md-10">
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Name</h5>
          <input type="text" name="address_name" id="address_name" class="form-control profile-input" placeholder="Please enter the name" >
            @error('address_name')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Address(House No,Building Street,Area)</h5>
          <input type="text" name="address" id="address" class="form-control profile-input" placeholder="Please enter the address">
             @error('address')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
          </div>
          
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Locality/Town</h5>
          <input type="text" name="locality" id="locality" class="form-control profile-input" placeholder="Please enter the locality">
           @error('locality')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">City/District</h5>
          <input type="text" name="city" id="city" class="form-control profile-input" placeholder="Please enter the city"> 
           @error('city')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Pin Code</h5>
          <input type="text" name="pin_code" id="pin_code" class="form-control profile-input" placeholder="Please enter the pincode">   
           @error('pin_code')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">State</h5>
          <input type="text" name="state" id="state" class="form-control profile-input" placeholder="Please enter the state">   
           @error('state')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
          </div>
          <div class="form-group">
          <input type="checkbox" name="is_primary" id="is_primary" class="" value="1">
          Make This Default Address    
          </div>
          <a class="btn btn-danger" style="float: right;margin-right:12px;padding:13px 34px; color:white; font-size:12px;" onclick="cancel()">Cancel</a>
          <button class="text-right" style="float: right;background-color: #1e9bd0;margin-right:12px;">Submit</button>
          </div>
          </div>
        </form>

        <!-- edit-address -->

        <form method="POST" action="{{route('edit-address-post')}}" id="edit-address" name="edit-address" enctype="multipart/form-data">
    @csrf                     <input type="hidden" class="custom-control-input" name="edit_id" id="edit_id">
          <div class="row edit-addttess" style="display: none;">
              <div class="col-md-12">
                <div class="bs-example" style="float: left;margin-left: 17%;padding-bottom: 2%;">
          
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Address type</h5>
          <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" name="edit_address_type" id="edit_home" value="0">
          <label class="custom-control-label" for="edit_home">Home</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" name="edit_address_type" id="edit_office" value="1">
          <label class="custom-control-label" for="edit_office">Office</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" name="edit_address_type" id="edit_others" value="2">
          <label class="custom-control-label" for="edit_others">Others</label>
          </div>
          </div>
          </div><!--col-12-->
          <div class="col-md-2 text-center">
          <i class="fa fa-home" id="location-one"></i>
          </div>
          <div class="col-md-10">
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Name</h5>
          <input type="text" name="edit_address_name" id="edit_address_name" class="form-control profile-input" placeholder="Please enter the name" >
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Address(House No,Building Street,Area)</h5>
          <input type="text" name="edit_address" id="edit_address" class="form-control profile-input" placeholder="Please enter the address">
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Locality/Town</h5>
          <input type="text" name="edit_locality" id="edit_locality" class="form-control profile-input" placeholder="Please enter the locality">    
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">City/District</h5>
          <input type="text" name="edit_city" id="edit_city" class="form-control profile-input" placeholder="Please enter the city">    
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">Pin Code</h5>
          <input type="text" name="edit_pin_code" id="edit_pin_code" class="form-control profile-input" placeholder="Please enter the pincode">    
          </div>
          <div class="form-group">
          <h5 class="pull-center" style="font-size: 17px;margin-bottom: 11px;">State</h5>
          <input type="text" name="edit_state" id="edit_state" class="form-control profile-input" placeholder="Please enter the state">    
          </div>
          <div class="form-group">
          <input type="checkbox" name="edit_is_primary" id="edit_is_primary" class="" value="1">
          Make This Default Address    
          </div>
          <a class="btn btn-danger" style="float: right;margin-right:12px;padding:13px 34px; color:white; font-size:12px;" onclick="cancelEdit()">Cancel</a>
          <button class="text-right" style="float: right;background-color: #1e9bd0;margin-right:12px;">Submit</button>
          </div>
          </div>
        </form>
        <!-- end-edit-address -->
      </div>
  </div>
</div> 
</div>
</div>

</div>
   <!-- Javascript -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://meinhaus.ca/theme/js/tether.min.js"></script>

<script src="https://meinhaus.ca/theme/js/bootstrap.min.js"></script>

<script src="https://meinhaus.ca/theme/js/color-switcher.js"></script> 

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
<script type="text/javascript">
$('.edit-address').click(function() {


$('.adddress-all').hide();
$('.edit-addttess').show();
});

$('.add-address').click(function() {
  $('.adddress-all').hide();
  $('.add-addttess').show();
});
</script>
<script type="text/javascript">
  
  function editAddress(id){

    $.ajax({
        url: "{{URL::to('edit-address')}}",
        type: 'POST',
        // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {
          _method: 'POST',
          id: id,
          _token:  '{{ csrf_token() }}',
        },
        success: function(response){
          console.log(response)
          $('#edit_id').val(response['data']['id'])
          $('#edit_address_name').val(response['data']['name'])
          $('#edit_address').val(response['data']['area'])
          $('#edit_locality').val(response['data']['locality'])
          $('#edit_city').val(response['data']['city'])
          $('#edit_state').val(response['data']['state'])
          $('#edit_pin_code').val(response['data']['pin_code'])
          if(response['data']['primary'] == 1){
            $('#edit_is_primary').prop('checked','true')
          }

          if(response['data']['address_type'] == 0){
            $('#edit_home').prop('checked','true')
          }


          if(response['data']['address_type'] == 1){
            $('#edit_office').prop('checked','true')
          }


          if(response['data']['address_type'] == 2){
            $('#edit_others').prop('checked','true')
          }


        }
    });
  }
</script>
<script type="text/javascript">
function cancel(){

$('.adddress-all').show();
$('.add-addttess').hide();
    $('html, body').animate({
        scrollTop: $("#address_div").offset().top
    }, 'fast');
}

function cancelEdit(){

$('.adddress-all').show();
$('.edit-addttess').hide();
    $('html, body').animate({
        scrollTop: $("#address_div").offset().top
    }, 'fast');
}
</script>

@endsection
