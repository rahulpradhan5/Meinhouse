@extends('website.layouts.master')
@section('meta')
<title>  Plumbing Services Mississauga | Plumbing Company | Meinhaus  </title>
<meta name="description" content="Plumbing Services Mississauga: Meinhaus will connect you with Mississauga's trusted nearby plumbing company for tap repair work, pipe cleaning, and emergency work.">
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
                                <h1 class="title">Plumbing Services Mississauga</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; / &nbsp;</span>
                                <span><span>Plumbing Services Mississauga</span></span>
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
                                        <h4 class="service-title">Plumbing company in Mississauga 
</h4>
                                        <hr style="margin-top: 0rem;" />
                                        <form action=""  id="bookings" name="bookings" class="comment-form">
                                        
                                            <!-- <p class="comment-notes">
                                                <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                                            </p> -->
                                           
                                             <!--new box-->
                                        <h2 class="ser-title">Introduction</h2>
                                        <p>If you are looking for a reliable plumbing service in Mississauga that best suits your preferences and budget, then we can help you with that. We have a large network of plumbers for every kind of need such as supply or installation of several kinds of toilets, faucets, showerheads, bidets, handheld showers, hand showers, drains, body sprays, tub spouts and much more. Reach out to us for your plumbing needs and we will connect you to the nearby pros who will provide you 100% satisfaction with their work. These plumbers in Mississauga are fully licensed and equipped with all the necessary tools required to do the job effectively. </p>
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
                                         Why choose us for plumbing in Mississauga
                                        </h2>
                                        <blockquote>
                                          <p>Choosing us for plumbing solutions could be the viable choice as we will connect you with the renowned plumbing company in Mississauga that has a team of professional plumbers who are well-experienced and offer quality services on time. They understand their client’s needs and provide upfront, flexible and transparent services. These emergency plumbers in Mississauga have a higher level of workmanship and provide standard 24/7 services.</p>

<p>There are several other reasons why you should choose plumbing services in Mississauga, these include: </p>
<ol  start="1">
<li><strong>1.&nbsp Guaranteed work:</strong> We believe in offering the best to our clients and connect them with the most professional and renowned emergency plumbers in Mississauga near them, which guarantee quality and reliability in their work. They have a team of professional plumbers who will work according to your preferences. You can rely on these experts to get complete work done timely as per your needs that best suits your budget. Plumbing company in Mississauga strive to offer the highest standard service.</li>
<li><strong>2.&nbsp Health and safety:</strong> We understand the importance of your belongings and property and connect you with those plumbing companies who consider their client’s health and safety as their priority. These professionals work according to the set policies and procedure to ensure that your property and other belongings are not damaged during the plumbing work. Moreover, as they are skilled professionals, you do not need to concerned about the safety issues while they provide you with the services.</li>

<li><strong>3.&nbsp Full-service solution:</strong> Whether you are looking for the installation of toilets, faucets, bidets, hand showers, drains, tub spouts, body sprays, handheld showers or repair of taps, hand showers, and toilets, our consulted professionals are pro at everything. They hold several years of experience and have a team that is skilled in a wide variety of plumbing in Mississauga.</li>
</ol>

<p><b>Plumbing services in Mississauga </b></p>

<p>When it comes to quality plumbing services, we provide you with the most trustable plumbers near you, on whom you can rely for your needs. Our consulted professionals have years of experience in providing a wide variety of quality plumbing services to various fields. These are the certified plumbers who ensure that their clients get 100% satisfaction from their services and provide up to the mark work to give a good value of your money. Their several plumbing services include: </p>

<ol>
    <li><strong>1.&nbsp Drain cleaning:</strong> This is one of the most common problems that every household goes through. Sinks and bathrooms often develop serious clogs due to which people face great difficulty while using washroom and cleaning utensils. To get rid of this problem, the drain in your home should be cleaned regularly. To get this done, contact us so we can connect you to a professional plumber near you.</li>

<li><strong>2.&nbsp Repairing tap leaks:</strong> Leaking taps in your home are both irritating and creates a seepage problem, which needs to be corrected immediately. It is a primary service that our consulted plumbers will offer you. Whether its tap fixing or repiping, these plumbers are skilled at every piping and leaking issues. </li>

<li><strong>3.&nbsp Sewer repair:</strong> Sewers often create a mess with its foul smell, slow drainage and unusual noises in it. Sewers are something that no one would like to deal with. To help you out of this issue, we will provide the best plumbers near you who will find out the issue and repair it for you. </li>

<li><strong>4.&nbsp Water heater issues:</strong> there can be several issues with water heaters such as getting less warm water or the system not working at all. These water heater issues can only be solved by skilled and experienced plumbers. We will provide you with the most trained plumbers to get your water heater issues solved.</li></ol>
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