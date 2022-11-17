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

</style>
@endsection
@section('content')
	 <!-- page-title -->
        <div class="ttm-page-title-row" style="background-image: url('{{ asset('services/'.$service->service_desc_image)}}');padding-top: 226px;">
            <div class="ttm-page-title-row-bg-layer ttm-bg-layer" style="background-color: rgba(24, 35, 51, 0.57)!important;"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="title-box ttm-textcolor-white">
                            <div class="page-title-heading">
                                <h1 class="title">{{$service->name ? $service->name : 'NA'}}</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; / &nbsp;</span>
                                <span><span>{{$service->name ? $service->name : 'NA'}}</span></span>
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
                    <div class="col-lg-4 widget-area sidebar-left ttm-col-bgcolor-yes ttm-bg ttm-left-span">
                        <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                         <aside class="widget contact-widget service-desc">
                            <div class="service-header text-center">
                                <div>
                                    <img class="service-img" src="{{url('services/'.$service->service_image)}}">
                                </div>
                                <div>
                                    <h3 class="widget-title ser-title">{{$service->name ? $service->name : 'NA'}}</h3>      
                                </div>
                            </div>
                            @if($service->service_type == 1)
                            <div class="service-det">
                                <span class="service-time">For the first {{$service->time ? $service->time : 'NA'}} sqft</span>
                                <span class="service-price text-right">$ {{$service->price ? $service->price : 'NA'}}</span>
                            </div>
                             <div class="service-det">
                                <span class="service-time">For each additional per sqft</span>
                                <span class="service-price text-right">$ {{$service->add_price ? $service->add_price : 'NA'}}</span>
                            </div>
                            @else
                             <div class="service-det">
                                <span class="service-time">For the first {{$service->time ? $service->time : 'NA'}} hour</span>
                                <span class="service-price text-right">$ {{$service->price ? $service->price : 'NA'}}</span>
                            </div>
                             <div class="service-det">
                                <span class="service-time">For each additional hour</span>
                                <span class="service-price text-right">$ {{$service->add_price ? $service->add_price : 'NA'}}</span>
                            </div>
                            @endif
                           
                            <div class="service-content">
                                <p class="text-justify">{{$service->description ? $service->description : 'NA'}}</p>
                            </div>
                        </aside>


                        <aside class="widget widget-nav-menu">
                            <h3 class="widget-title pop">Popular Services</h3>
                            <ul class="widget-menu">
                                @foreach($popular_services as $value)
                                    <li><a href="{{url('job/'.$value->id)}}" class="hover-color">{{$value->name ? $value->name : 'NA'}}</a></li>
                                @endforeach
                            </ul>
                        </aside>
                       
                    </div>
                    <div class="col-lg-7 content-area">
                        <!-- ttm-service-single-content-are -->
                        <div class="ttm-service-single-content-area">
                           <div id="review_form_wrapper">
                                    <div class="comment-respond">
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
                                        <h4 class="service-title">{{$service->name ? $service->name : 'NA'}}</h4>
                                        <hr style="margin-top: 0rem;" />
                                        <form action="{{route('job-post')}}" method="post" id="bookings" name="bookings" class="comment-form">
                                            @csrf
                                            <!-- <p class="comment-notes">
                                                <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                                            </p> -->
                                            <input type="hidden" name="service_id" value="{{$service->id}}" id="service_id">
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
                                                    <div class="col-lg-6 col-md-6">
                                                         <input class="form-control" id="locality" name="locality" type="text" placeholder="Locality/Town" autocomplete="off" value="{{old('locality')}}">
                                                        
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                         <input class="form-control" id="city" name="city" type="text" placeholder="City/District" autocomplete="off" value="{{old('city')}}">
                                                        
                                                    </div>
                                                    
                                                </div>

                                                <br>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                         <input class="form-control" id="pin_code" name="pin_code" type="text" placeholder="Pin Code" autocomplete="off" value="{{old('pin_code')}}">
                                                        
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                         <input class="form-control" id="state" name="state" type="text" placeholder="State" autocomplete="off" value="{{old('state')}}">
                                                        
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
                                                <label for="author" class="ser-title">Contact Number&nbsp;<span class="required">*</span></label>
                                                <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="Enter your contact number" autocomplete="off" value="{{old('phone_no')}}">
                                            </p>
                                            <p class="comment-form-author bookingf">
                                                <label for="author" class="ser-title">ARE THERE ANY TIMING CONSTRAINTS ?&nbsp;<span class="required">*</span></label>
                                                <textarea class="form-control" placeholder="Let us know about any timing constraints." id="timing_constraints" name="timing_constraints" cols="45" rows="8"  value="{{old('timing_constraints')}}"></textarea>
                                            </p>
                                            <p class="comment-form-email bookingf">
                                                <label for="email" class="ser-title">WHAT DO YOU NEED DONE ?&nbsp;<span class="required">*</span></label>
                                               <textarea class="form-control" id="description" name="description" cols="45" placeholder="Give us a brief description of the job you need completed. Don’t worry, the trade we match you with will be in touch to confirm all details before starting!" rows="8"  value="{{old('description')}}" ></textarea>
                                            </p>
                                            @if($service->service_type == 1)
                                                <p class="comment-form-author bookingf">
                                                    <label for="est_area" class="ser-title">Estimated Area(in sqft)&nbsp;<span class="required">*</span></label>
                                                    <input class="form-control" id="est_area" name="est_area" type="text" placeholder="Please enter the estimated area" autocomplete="off" value="{{old('est_area')}}">
                                                </p>
                                            @endif
                                            <p class="comment-form-author bookingf">
                                                <label for="author" class="ser-title">Add Promocode&nbsp;<span class="required">*</span></label>
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8">
                                                     <input class="form-control" id="promocode" name="promocode" type="text" placeholder="Enter Promocode" autocomplete="off" value="{{old('promocode')}}">
                                                     <input type="hidden" name="code" id="code" value="">
                                                     <span id="promomessage"></span>    
                                                </div>

                                                <div class="col-lg-4 col-md-4">
                                                     <a class="btn btn-info" id="promo" name="promo">Apply Promocode</a>
                                                    
                                                </div>  
                                                
                                            </div>
                                        </p>
                                            <p class="form-submit">
                                                <input name="submit" type="submit" class="submit btn btn-fill btn-dark submit-butn" value="Continue" >
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
@endsection