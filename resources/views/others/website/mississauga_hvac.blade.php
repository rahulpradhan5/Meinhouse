@extends('website.layouts.master')
@section('meta')
<title>HVAC company in Mississauga | HVAC Contractors | Meinhaus  </title>
<meta name="description" content=" HVAC company in Mississauga: Meinhaus has a wide network of heating and air conditioning contractors that provides your reliable solutions at an affordable rate. ">
@endsection
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
        <div class="ttm-page-title-row" style="background-image: ; padding-top: 226px;">
            <div class="ttm-page-title-row-bg-layer ttm-bg-layer" style="background-color: rgba(24, 35, 51, 0.57)!important;"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="title-box ttm-textcolor-white">
                            <div class="page-title-heading">
                                <h1 class="title">Heating and air conditioning Mississauga</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; / &nbsp;</span>
                                <span><span>Heating and air conditioning Mississauga </span></span>
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
                                    <img class="service-img" src="https://meinhaus.ca/services/1581927982.png">
                                </div>
                                <div>
                                    <h3 class="widget-title ser-title">Electrical</h3>      
                                </div>
                            </div>
                                                         <div class="service-det">
                                <span class="service-time">For the first 2 hour</span>
                                <span class="service-price text-right">$ 96</span>
                            </div>
                             <div class="service-det">
                                <span class="service-time">For each additional hour</span>
                                <span class="service-price text-right">$ 96</span>
                            </div>
                                                       
                            <div class="service-content">
                                <p class="text-justify">All electricians are ESA certified and should be used exclusively for everything electrical in a home. Materials, if needed, are additional and will be quoted by your Pro.</p>
                            </div>
                        </aside>


                        <aside class="widget widget-nav-menu">
                            <h3 class="widget-title pop">Popular Services</h3>
                            <ul class="widget-menu">
                                                                    <li><a href="https://meinhaus.ca/job/7" class="hover-color">Appliance Install</a></li>
                                                                    <li><a href="https://meinhaus.ca/job/1" class="hover-color">Appliance Repair</a></li>
                                                                    <li><a href="https://meinhaus.ca/job/29" class="hover-color">Architecture.</a></li>
                                                                    <li><a href="https://meinhaus.ca/job/15" class="hover-color">Furniture Assembly</a></li>
                                                                    <li><a href="https://meinhaus.ca/job/14" class="hover-color">Flooring &amp; Tile Services</a></li>
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
                                        <h4 class="service-title">Heating and air conditioning Mississauga</h4>
                                        <hr style="margin-top: 0rem;" />
                                        <form action=""  id="bookings" name="bookings" class="comment-form">
                                        
                                            <!-- <p class="comment-notes">
                                                <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                                            </p> -->
                                           
                                             <!--new box-->
                                        <h2 class="ser-title">Introduction</h2>
                                        <p>If you are looking for a HVAC in Mississauga that provides excellent services for heating and air conditioning installation or repair, then we can help you with that. To live a comfortable life, you need to look after regular maintenance and repair of your home appliances. To fulfill this need, we will connect you to the nearby HVAC contractors in Mississauga who will provide superior heating air conditioning services on a fair budget. We have a wide network of renowned HVAC Company in Mississauga who will offer you the best heating and air conditioning services you deserve. 
 </p>
                                          <hr style="margin-top: 0rem;" />
                                            <!-- end box-->
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
                                                                                            </div>
                                                

                                            <div class="comment-form-rating bookingf old_address" style="display: none;">
                                                <label for="comment" class="ser-title">WHERE DO YOU NEED A SERVICE ?&nbsp;<span class="required">*</span></label>
                                                
                                           
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
                                        <hr style="margin-top: 0rem;" />
                                        
                                        <h2 class="ser-title">
                                        Why choose us for HVAC in Mississauga
                                        </h2>
                                        <blockquote>
                                          <p>Choosing us for your HVAC needs could be the right choice, as we connect our clients with the most professional HVAC contractors in Mississauga. These professionals hold years of experience and strive to offer the quality services to the customers. We have a large network of HVAC Company in Mississauga, which comprises of a team of professionals on whom you can rely for your HVAC needs. Whether it is an installation of heating and air conditioning appliances or repair work, these contractors are pro at everything. They will ensure to provide you with standard services 24/7. 
</p>

<p>There are several more reasons why you should choose us for HVAC in Mississauga. These include: </p>
<ol  start="1">
<li><strong>1.&nbsp Full-service solution:</strong> Our consulted professionals for HVAC needs are skilled in various type of work. They hold years of experience and strive to offer quality service in various types of works such as installation of heating and air appliances, maintenance, repair and much more. They are pro at everything.</li>
<li><strong>2.&nbsp Guaranteed work:</strong> We know that you deserve the best and accordingly connect you with the most renowned and professional HVAC Company near you. Our consulted companies guarantee quality and reliability in their work. They have a team of skilled HVAC workers who understand the needs of their clients and provide flexible services. They are trustable professionals who will provide work with timeliness and better quality that gives a good value of your money. Their guaranteed and high standard services are something on which you can rely on.</li>

<li><strong>3.&nbsp Safety:</strong> We understand the importance of your property and belongings and consult those professionals who keep their client’s preferences at the top. The work done by these professionals are according to the set guidelines and policies. These professionals ensure that the other appliances of your house are not damaged during the work. 
</li>
</ol>

<p><b>Services of HVAC Company in Mississauga  </b></p>

<p>When it comes to quality HVAC services, we are here to provide you with the most trustable professionals for HVAC work who will provide you with the best solutions for your HVAC needs. These professionals are known for flexibility in their work, which means they will work according to the client’s needs and preferences. They are skilled in variety of HVAC work such as installation of heating and air conditioning appliances, maintenance and repairing work. Moreover, these professionals will regularly visit your house for the series of tests and checks to ensure that you have received the best service. 
 </p>
 <p>There are various services of our HVAC services. These include:</p>

<ol>
    <li><strong>1.&nbsp Central AC installations:</strong> These HVAC companies supply and install the best quality commercial and residential air conditioning appliances. The variety of air conditioning installed by them includes central air, multi head heating pumps, and ductless mini splits. They offer guaranteed appliances for their client’s to provide them with the best service that proves worth of their money. </li>

<li><strong>2.&nbsp Repair services: </strong>  To ensure that you deserve the best through their services, these professionals provide repair and diagnostic services of various appliances such as air conditioners, water heaters, boilers, HRV’s, Hydronic systems, gas fireplaces and much more.  </li>

<li><strong>3.&nbsp Annual maintenance services:</strong> After providing you the HVAC service, these professionals make annual visit to your home to inspect your appliances to find issues and resolve them to avoid any further risk. 
 </li></ol>
                                        </blockquote>
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
 
@endsection