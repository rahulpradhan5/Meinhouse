@extends('website.layouts.master')
@section('after-style')
<style type="text/css">
    .flatpickr-day.flatpickr-disabled, .flatpickr-day.flatpickr-disabled:hover {
    cursor: not-allowed;
    color: rgba(72, 72, 72, 0.5)!important;
}
.simplepicker-btn:hover {
    color: #000!important;
}
.add-add{
    color: #fff;
    background-color: #1e9bd0;
    border-color: #1e9bd0;
    width: 8%;
    margin-left: 1%;
    padding: 13px;
}
a.add-add:hover {
    color: #f8b94b!important;
}
.submit-butn {
    background-color: #1e9bd0;
    border-color: #1e9bd0;
    width: 102%;
    color: aliceblue!important;
    padding: 2%;
}
a.hover-add:hover{
    color: #f8b94b!important;
}
.widget .widget-title.pop:after {
    background-color: #f7a71e;
    
}
.widget .widget-title {
    margin-bottom: 5px!important;
}
.btn-info {
    margin-top: 4px;
    color: #fff;
    background-color: #f7a71e;
    border-color: #f7a71e;
}
.bookingf {
    margin-top: 1%!important;
}
</style>
@endsection
@section('content')
	 <!-- page-title -->
        <div class="ttm-page-title-row" style="padding-top: 226px;">
            <div class="ttm-page-title-row-bg-layer ttm-bg-layer" style="background-color: rgba(24, 35, 51, 0.57)!important;"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="title-box ttm-textcolor-white">
                            <div class="page-title-heading">
                                <h1 class="title">Get a free Quote</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; / &nbsp;</span>
                                <span><span>Submit A Custom Request</span></span>
                            </div>  
                        </div>
                    </div><!-- /.col-md-12 -->  
                </div><!-- /.row -->  
            </div><!-- /.container -->                      
        </div><!-- page-title end-->

         
    <!--site-main start-->
    <div class="site-main" style="padding-top: 0px;">

        <!-- sidebar -->
        <div class="sidebar ttm-sidebar-left ttm-bgcolor-grey break-991-colum clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 content-area">
                        <!-- ttm-service-single-content-are -->
                        <div class="ttm-service-single-content-area">
                           <div id="review_form_wrapper">
                                    <div class="comment-respond">
                                    	  @if ($errors->any())
                                              <div class="alert alert-danger">
                                                 <ul>
                                                    @foreach ($errors->all() as $error)
                                                       <li>{{ $error }}</li>
                                                    @endforeach
                                                 </ul>
                                                 
                                              </div>
                                            @endif
                                            @if (session('error'))
						                      <div class="alert alert-danger">
						                          {{ session('error') }}
						                      </div>
						                  @endif
						                  @if (session('success'))
						                      <div class="alert alert-success">
						                          {{ session('success') }}
						                      </div>
						                  @endif
                                        <h4 class="service-title text-center">HOW CAN WE HELP ?</h4>
                                        <hr style="margin-top: 0rem;" />
                                        <form action="{{route('custom-booking-post')}}" method="post" id="custom_bookings" name="custom_bookings" class="comment-form" enctype="multipart/form-data">
                                            @csrf
                                            <!-- <p class="comment-notes">
                                                <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                                            </p> -->
                                             <div class="comment-form-rating bookingf" >
                                                <label for="comment" class="ser-title">SELECT SERVICES&nbsp;<span class="required">*</span></label>
                                                
                                                <div class="row" >
                                                    <div class="col-lg-12" style="display: flex;">
                                                    <select class="js-example-basic-multiple" name="service_id[]" id="service_id" multiple="multiple">
                                                        <option value="">Select Services</option>
                                                        @foreach($services as $service)
                                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>
                                                <label style="color: red;"><label id="service_id-error" class="error" for="service_id" style=""></label></label>
                                            </div>
                                            
                                            <div class="comment-form-rating bookingf new_address" >
                                                <label for="comment" class="ser-title">WHERE DO YOU NEED A SERVICE ?&nbsp;<span class="required">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                         <table style="margin: 0px 7px 1.75em">
                                                            <tr>
                                                                <td colspan="3"><h6><u>Type of Address</u></h6></td>
                                                            </tr>
                                                           <tr>
                                                                <td><input type="radio" name="address_type" id="address_type" value="0">&nbsp;Home</td>
                                                                <td><input type="radio" name="address_type" id="address_type" value="1">&nbsp;Office</td>
                                                                <td><input type="radio" name="address_type" id="address_type" value="2">&nbsp;Other</td>
                                                                <td></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    
                                                </div>
                                                <label style="color: red;display: none;">
                                                <label id="address_type-error" class="error" for="address_type"></label>
                                                </label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name" autocomplete="off" value="{{old('name')}}">  
                                                    </div>
                                                </div><br>
                                               <div class="row">
                                                    <div class="col-md-12">
                                                        <input class="form-control" id="address" name="address" type="text" placeholder="Enter your address(House No,Building Street,Area)" autocomplete="off" value="{{old('phone_no')}}">
                                                    </div>
                                               </div>
                                               <br>
                                                    <div class="row">
                                                    
                                                    <div class="col-lg-12 col-md-12">
                                                         <input class="form-control" id="city" name="city" type="text" placeholder="City/Municipality" autocomplete="off" value="{{old('city')}}">
                                                        
                                                    </div>
                                                    
                                                </div> 

                                                <br>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                         <input class="form-control" id="pin_code" name="pin_code" type="text" placeholder="Postal Code" autocomplete="off" value="{{old('pin_code')}}">
                                                        
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                         <input class="form-control" id="state" name="state" type="text" placeholder="Province" autocomplete="off" value="{{old('state')}}">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <br>
                                                @if(auth::check() && count($addresses)>0)
                                                <a class="hover-add" style="float: right;cursor: pointer;" onclick="changeAddress()">Use an existing address</a>
                                                @endif
                                                
                                            </div>
                                                

                                            <div class="comment-form-rating bookingf old_address" style="display: none;">
                                                <label for="comment" class="ser-title">WHERE DO YOU NEED A SERVICE ?&nbsp;<span class="required">*</span></label>
                                                
                                                <div class="row" >
                                                    <div class="col-lg-12" style="display: flex;">
                                                     @if(count($addresses)>0)
                                                    <select name="address_id" id="address_id" tabindex="-1" class="form-control">
                                                    		<option value="">Select the address</option>
                                                        @foreach($addresses as $value)
                                                            <option value="{{$value->id}}"{{$value->id == old('address') ? 'selected' : ''}}>{{$value->area}},{{$value->locality}},{{$value->city}},{{$value->state}},{{$value->pin_code}}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                    </div>
                                                </div>
                                                <a class="hover-add" style="float: right;cursor: pointer;" onclick="addAddress()">Add a new address</a>
                                            </div>

                                            <p class="comment-form-comment bookingf">

                                                <label for="comment" class="ser-title">WHEN SHOULD WE SEND SOMEONE ?&nbsp;<span class="required">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input class="form-control simplepicker-btn" id="date" name="date" type="text" placeholder="Add Available Date" autocomplete="off" value="{{old('date')}}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                         <select name="time" id="time"  tabindex="-1" class="form-control">
                                                            <option value="">Select Time</option>
                                                            <option value="0">Morning(08:00 AM - 11:00 AM)</option>
                                                            <option value="1">Midnoon(11:00 AM - 02:00 PM)</option>
                                                            <option value="2">Afternoon(02:00 PM - 05:00 PM)</option>
                                                            <option value="3">Evening(05:00 PM - 08:00 PM)</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <input class="form-control simplepicker-btn" id="date" name="date" type="text" placeholder="Add Available Date" style="border-top: none!important;border-left: none!important;border-right: none!important;background-color: transparent!important;" autocomplete="off"> -->
                                                
                                            </p>
                                            <p class="comment-form-author bookingf">
                                                <label for="author" class="ser-title">CONTACT NUMBER&nbsp;<span class="required">*</span></label>
                                                <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="Enter your contact number" autocomplete="off" value="{{old('phone_no')}}">
                                            </p>
                                            <p class="comment-form-author bookingf">
                                                <label for="author" class="ser-title">EMAIL ID&nbsp;<span class="required">*</span></label>
                                                <input class="form-control" id="email_id" name="email_id" type="text" placeholder="Enter your email id" autocomplete="off" value="{{old('phone_no')}}">
                                            </p>
                                            <div class="comment-form-rating bookingf" >
                                                <label for="comment" class="ser-title">SELECT CUSTOM AMOUNT&nbsp;<span class="required">*</span></label>
                                                
                                                <div class="row" >
                                                    <div class="col-lg-12" style="display: flex;">
                                                    <select name="price" id="price"  tabindex="-1" class="form-control">
                                                    <option value="">Select Custom Amount</option>
                                                    <option value="Less Than 1000">Less Than 1000</option>
                                                    <option value="1000-3000">1000-3000</option>
                                                    <option value="3000-4000">3000-4000</option>
                                                    <option value="5000+">5000+</option>
                                                </select>
                                                    </div>
                                                </div>
                                                <label style="color: red;"><label id="price-error" class="error" for="price" style=""></label></label>
                                            </div>
                                            <p class="comment-form-email bookingf">
                                                <label for="email" class="ser-title">WHAT DO YOU NEED DONE ?&nbsp;<span class="required">*</span></label>
                                               <textarea class="form-control" id="description" name="description" cols="45" placeholder="Give us a brief description of the job you need completed. Don’t worry, the trade we match you with will be in touch to confirm all details before starting!" rows="8"  value="{{old('description')}}" ></textarea>
                                            </p>
                                            <p class="comment-form-email bookingf">
                                                <label for="email" class="ser-title">SELECT IMAGES&nbsp;<span class="required">*</span></label>
                                                <label for="email">Please upload 3 photos from different angles</label>
                                               
											   <input class="form-control" id="images" name="images[]" type="file"  autocomplete="off" multiple="">
                                            </p>
                                          
                                            <p class="form-submit">
                                                <input name="submit" type="submit" class="submit btn btn-fill btn-dark submit-butn" value="Submit" >
                                            </p>
                                        </form>
                                    </div>
                                </div>
                        </div>
                        <!-- ttm-service-single-content-are end -->
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!-- sidebar end -->



    </div><!--site-main end-->


@endsection
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  var today = new Date();
  var tomorrow = new Date();
  tomorrow.setDate(today.getDate()+1);
   flatpickr("#date", {
    clickOpens:true,
    dateFormat:"d-m-Y",
    minDate: tomorrow,
   });
  </script>
  <script type="text/javascript">
      function changeAddress() {
          $('.new_address').hide();

          $('.old_address').show();
      }
      function addAddress() {
          $('.old_address').hide();

          $('.new_address').show();
      }
  </script>
  <script type="text/javascript">
       
       $('#promo').click(function() {

            var code = $('#promocode').val();
             $.ajax({
                  url: "{{URL::to('apply/promo')}}",
                  type: 'POST',
                  // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                  data: {
                    _method: 'POST',
                    code: code,
                    _token:  '{{ csrf_token() }}',
                  },
                  success: function(response){
                    if(response['response_code'] == 200){

                        $('#promomessage').html(response['response_message']);
                        $('#code').val(response['code']);
                    }

                    if(response['response_code'] == 400){
                        
                        $('#promomessage').html(response['response_message']);
                        
                    }
                  }
                });
       });
  </script>
  <script>
      $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
  </script>
@endsection