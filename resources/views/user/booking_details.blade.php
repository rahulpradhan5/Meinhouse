@extends('user.layout.layout') @section('content')
<style type="text/css">

<!-- Google Fonts-->
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

* {
	margin: 0px;
	padding: 0px;
}
 .modal-backdrop {
  position: relative!important;
}
.modal-title {
	margin-bottom: 0;
	line-height: 1.5;
	color: #fff;
	font-weight: bold;
	/* text-align: center; */
	padding-left: 26%;
	padding-top: 1px;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-family: 'Poppins', sans-serif !important;
}
.side-close {
	float: right;
	position: relative;
	right: -45%;
	font-size: 27px;
	margin-top: -16%;
}
.center-img {
	float: none;
	margin: 0px auto;
	border: 3px solid #fff;
	height: 80px;
	width: 80px;
	/* opacity: 1.4; */
	/* background-color: #565353; */
	border-radius: 50px;
}
.title-text {
	text-align: center;
	font-size: 19px;
	color: #fff;
	padding: 5px 0px;
	font-weight: 700;
	margin: 0;
	cursor: pointer;
	font-family: 'Poppins', sans-serif !important;
}
label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  transition: all .2s;
  color: #C7C7C7;
}

input.star:checked~label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked~label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked~label.star:before {
  color: #F62;
}

label.star:hover {
  transform: rotate(-15deg) scale(1.3);
}

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
.user-rating {
     font-size: 30px;
    padding-top: 0px;
    float: left;
    padding-bottom: 12px;
    margin-left: 36%;
    display: inline-block;
}
.user-rating input {
    opacity: 0;
    position: relative;
    left: -15px;
    z-index: 2;
    cursor: pointer;
}
.user-rating span.star:before {
    color: #777777;
    content:"ï€†";
    /*padding-right: 5px;*/
}
.user-rating span.star {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    position: relative;
    z-index: 1;
}
.user-rating span {
    margin-left: -15px;
}
.user-rating span.star:before {
    color: #777777;
    content:"\f006";
    /*padding-right: 5px;*/
}
.user-rating input:hover + span.star:before, .user-rating input:hover + span.star ~ span.star:before, .user-rating input:checked + span.star:before, .user-rating input:checked + span.star ~ span.star:before {
    color: #ffd100;
    content:"\f005";
}

.selected-rating{
    color: #ffd100;
    font-weight: bold;
    font-size: 3em;
}
#user {
	float: left;
	/* text-align: center; */
	/* margin:0px auto; */
	margin-left: 28%;
	font-size: 43px;
	margin-top: 19%;
	color: #fff;
}
.center-star {
	text-align: center;
	color: #fde25c;
	min-height: 0px;
}
.modal-body {
	position: relative;
	-webkit-box-flex: 1;
	-ms-flex: 1 1 auto;
	flex: 1 1 auto;
	/* padding: 1rem; */
	background-color: rgba(25,60,157,0.9);
}
.form-control {
	display: block;
	width: 100%;
 padding: .375rem .75rem;
	font-size: 1rem;
	font-family: 'Poppins', sans-serif !important;
	line-height: 1.5;
	color: #495057;
	background-color: #fff;
	background-clip: padding-box;
	border: 1px solid #ced4da;
 border-radius: .25rem;
	transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
textarea {
	border: 1px solid #d8d7d7 !important;
	/* padding-top: 4%; */
	overflow: auto;
	margin-top: 3%;
	resize: vertical;
	height: 115px;/* padding: 9px 4px; */
}
.modal-header {
	border-bottom: none !important;
	/* float: none; */
	-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	/* margin: 0px auto; */
	background-color: #1e9bd0;
}
.modal-footer {
	border-top: none !important;
	float: none;
	width: 100%;
	margin: 0px auto;
	background-color: #1e9bd0;
}
.modal-footer>:not(:last-child) {
	margin-right: 4.25rem;
}
.btn-secondary {
	color: #1e9bd0;
	width: 39%;
	padding: 5px 28px;
	border-radius: 20px;
	border: 2px solid #40bcf1;
	background-color: #fff !important;
	font-family: 'Poppins', sans-serif !important;
	color: #1edb0;
}
.btn-secondary:hover {
	color: #000;
	transition: 1s all;
	background-color: #fff !important;
	border-color: #1e9bd0 !important;
}
.modal-header .close {
	/* padding: 0rem !important; */
    /* margin: 0rem 0rem 0rem !important; */
	color: #fff;
	height: 40px;
	margin-top: -1%;
	margin-right: 1%;
	width: 40px;
	padding: 0px;
	background-color: #cccccc6b;
	opacity: 1!important;
	border-radius: 20px;
}
/**************************Responsive Modal********************************/
 @media only screen and (max-width:768px) and (min-width:421px) {
.modal-header {
	border-bottom: none !important;
	/* float: none; */
	-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	/* margin: 0px auto; */
	background-color: #1e9bd0;
}
.modal-title {
	margin-bottom: 0;
	line-height: 1.5;
	color: #fff;
	width: 100%;
	float: none;
	margin: 0px auto;
	font-weight: bold;
	text-align: center !important;
	font-size: 15px;
	padding: 0;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-family: 'Poppins', sans-serif !important;
}
.modal-header .close {
	/* padding: 0rem !important; */
    /* margin: 0rem 0rem 0rem !important; */
	color: #fff;
	height: 35px;
	margin-top: -7%;
	margin-right: -6%;
	width: 35px;
	padding: 0px 6px;
	background-color: #cccccc6b;
	opacity: 1!important;
	border-radius: 20px;
}
}
 @media only screen and (max-width:420px) and (min-width:220px) {
.modal-header {
	border-bottom: none !important;
	/* float: none; */
	-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	/* margin: 0px auto; */
	background-color: #1e9bd0;
}
.modal-title {
	margin-bottom: 0;
	line-height: 1.5;
	color: #fff;
	width: 100%;
	float: none;
	margin: 0px auto;
	font-weight: bold;
	text-align: center !important;
	font-size: 15px;
	padding: 0;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-family: 'Poppins', sans-serif !important;
}
.modal-header .close {
	/* padding: 0rem !important; */
    /* margin: 0rem 0rem 0rem !important; */
	color: #fff;
	height: 35px;
	margin-top: -7%;
	margin-right: -6%;
	width: 35px;
	padding: 0px 6px;
	background-color: #cccccc6b;
	opacity: 1!important;
	border-radius: 20px;
}
.modal-body {
	position: relative;
	-webkit-box-flex: 1;
	-ms-flex: 1 1 auto;
	flex: 1 1 auto;
	/* padding: 1rem; */
	padding: 12px 13px;
	background-color: rgba(25,60,157,0.9);
}
.btn-secondary {
	color: #fff;
	width: 45%;
	padding: 5px 28px;
	border-radius: 20px;
	border: 2px solid #40bcf1;
	font-family: 'Poppins', sans-serif !important;
	background-color: #1e9bd0 !important;
}
.modal-footer {
	border-top: none !important;
	float: none;
	margin: 0px auto;
	width: 100%;
	background-color: #1e9bd0;
}
.modal-footer>:not(:last-child) {
	margin-right: 6%;
}
.modal-footer>:not(:first-child) {
	margin-left: -4%;
	margin-right: 4%;
}


</style>
@endsection

@section('content')

<!-- page-title -->

<div class="ttm-page-title-row text-center">

   <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <div class="title-box ttm-textcolor-white">

               <div class="page-title-heading">

                  <h1 class="title">Dashboard</h1>

               </div>

               <!-- /.page-title-captions -->

            </div>

         </div>

         <!-- /.col-md-12 -->  

      </div>

      <!-- /.row -->  

   </div>

   <!-- /.container -->                      

</div>

<!-- page-title end-->

<div class="site-main">

   <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">

      <div class="container">

         <div class="row">

            <div class="col-md-8">

               <h4 class="service-title">Service Details</h4>

            </div>

            <!--   <div class="col-md-4" >

               <button class="text-right" style="float: right;background-color: #1e9bd0;">View All Jobs</button>

               </div> -->

         </div>

      </div>

      <section class="py-0">

         <div class="container">

            <div class="row">

               <div class="main-section mt-2">

                  <div class="col-md-12">

                     <div class="large-box">


                        <h2 class="head">Service Details</h2>

                     </div>

                    

                     <!--large-box-->

                  </div>

                  @php

                  if($booking->time == 0){

                  $timeval = 'Morning(8-11 AM)';

                  }

                  if($booking->time == 1){

                  $timeval = 'Midnoon(11-2 PM)';

                  }

                  if($booking->time == 2){

                  $timeval = 'Afternoon(2-5 PM)';

                  }

                  if($booking->time == 3){

                  $timeval = 'Evening(5-8 PM)';

                  }

                  @endphp

                  <div class="col-md-12" style="border-bottom: 1px solid #1ec1e6;">

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

                     <div class="row">

                        <div class="col-md-6">

                           <div class="border-bottom-left mt-2">
                               
                               

                              <a href="#" class="info" style="padding-top: 3%">Name</a><span class="side-info">{{$booking->name}}</span>
                              <span class="side-info1" style="font-weight:700!important;">{{$booking->booking_show_id}}</span>
                              
                              <span class="side-info1">{{$booking->area}}</span>

                              <span class="side-info-top">{{$booking->locality}}</span>

                              <span class="side-info1-center"style="clear: both; float: left;">{{$booking->city}}</span>

                              <span class="side-info1-bottom" style="clear: both; float: left;">{{$booking->pin_code}} - {{$booking->state}}</span>

                           </div>

                        </div>

                        <!--div-->

                        <div class="col-md-6">

                           <div class="border-bottom-inner mt-2">

                              <a class="info-anchr">DAY OR TIME</a><span class="side-info"

                                 style="float:right;">{{date('D,d M Y',strtotime($booking->date))}}</span>

                              <i class="fa fa-clock-o" id="clock"></i><span class="side-info-inner">{{$timeval}}</span>

                              <a class="info-anchr">SERVICE</a><span class="side-info-install">{{$booking['serviceDetails']['name']}}</span>

                              <a class="info-anchr">SERVICE PROVIDER</a>
                              <span class="side-info-install" style="left: 26rem;">{{$booking['proDetails']['name'] ? $booking['proDetails']['name'] : 'NA'}}</span>
                              <a class="info-anchr">SERVICE PROVIDER RATING</a>
                              <span class="side-info-install" style="left: 26rem;">
                              
                              @if(isset($review_avg))   
                              @for($i=0;$i<round($review_avg);$i++)
                              <i class="fa fa-star" style="color: gold!important;"></i>
                              @endfor
                              @else
                              <i class="fa fa-star" style="color: gold!important;"></i>
                              <i class="fa fa-star" style="color: gold!important;"></i>
                              <i class="fa fa-star" style="color: gold!important;"></i>
                              <i class="fa fa-star" style="color: gold!important;"></i>
                              <i class="fa fa-star-half" style="color: gold!important;"></i>
                              @endif
                              </span>
                              @if($count>0)
                              <a class="info-anchr">Jobs Done</a>
                              <span class="side-info-install" style="left: 26rem;">{{$count}}</span>
                              @endif
                             

                           </div>

                        </div>

                     </div>

                  </div>

                  <div class="col-md-12">

                     <a href="#" class="info-mid">Service Charge</a>

                  </div>

                  <div class="col-md-12" style="border-bottom: 1px solid #1ec1e6;">

                     @if($booking->booking_status == 5 || $booking->booking_status == 7)
                     @if($booking->custom_booking == 1)
                        <div class="border-bottom-down-2 mt-2">
    
                            <span class="side-info1-left">Total Amount<a
    
                               class="info-panel-one">$ {{$booking->amount}}</a></span>
    
                         </div>
                     @else
                         @if($booking['serviceDetails']['service_type'] == 0)
                         <div class="border-bottom-down-2 mt-2">
    
                            <span class="side-info1-inner">Total Service Time<a
    
                               class="info-panel">{{gmdate("H:i", $booking->total_service_time)}}</a></span>
    
                            <span class="side-info1-left">Total Amount<a
    
                               class="info-panel-one">$ {{$booking->amount}}</a></span>
    
                         </div>
                         @else
                         <div class="border-bottom-down-2 mt-2">
    
                            <span class="side-info1-inner">Total Sqfts<a
    
                               class="info-panel">{{$booking->total_sqfs}}</a></span>
    
                            <span class="side-info1-left">Total Amount<a
    
                               class="info-panel-one">$ {{$booking->amount}}</a></span>
    
                         </div>
                         @endif
                         @endif
                     @else
                     @if($booking->custom_booking == 1)
                        <div class="border-bottom-down-2 mt-2">
    
                            <span class="side-info1-left">Total Amount<a
    
                               class="info-panel-one">$ {{$booking->amount}}</a></span>
    
                         </div>
                     @else
                         @if($booking['serviceDetails']['service_type'] == 0)
                         <div class="border-bottom-down-2 mt-2">
            
                            <span class="side-info1-inner">For the first {{$booking['serviceDetails']['time']}} hour<a
    
                               class="info-panel">$ {{$booking['serviceDetails']['price']}}</a></span>
    
                            <span class="side-info1-left">for Each Additional Hour<a
    
                               class="info-panel-one">$ {{$booking['serviceDetails']['add_price']}}</a></span>
    
                         </div>
                         @else
                         <div class="border-bottom-down-2 mt-2">
            
                            <span class="side-info1-inner">Estimated area(sqft) {{$booking['serviceDetails']['time']}} sqft<a
    
                               class="info-panel">$ {{$booking['serviceDetails']['price']}}</a></span>
    
                            <span class="side-info1-left">for Each Additional sqft<a
    
                               class="info-panel-one">$ {{$booking['serviceDetails']['add_price']}}</a></span>
    
                         </div>
                         @endif
                     @endif
                     @endif

                     <div class="col-md-12 pb-2 pt-2" style="clear:both;">

                        <a class="info-down-side">Status</a>

                        <div class="py-0">

                           @if($booking->booking_status == 0)

                           <h3 class="my-button-1" style="margin-top:3%;cursor: default;">Pending</h3>

                           @endif

                           @if($booking->booking_status == 1)

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Confirmed</button>

                           @endif

                           @if($booking->booking_status == 5)
                           

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Payment Pending</button>

                           @endif

                           @if($booking->booking_status == 6)

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Service Start</button>

                           @endif

                           @if($booking->booking_status == 2)

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Rejected</button>

                           @endif

                           @if($booking->booking_status == 3)

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Cancelled</button>

                           @endif

                           @if($booking->booking_status == 4)

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Time Exceeds</button>

                           @endif

                           @if($booking->booking_status == 7)

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Payment Completed</button>

                           @endif

                           @if($booking->booking_status == 8)

                           <button class="my-button-1" style="margin-top:3%;cursor: default;">Admin Cancel</button>

                           @endif

                        </div>

                     </div>

                     <div class="col-md-12 pb-2 pt-2" style="clear:both;">

                    @if($booking->booking_status == 0 || $booking->booking_status == 1)

                    <a href="{{URL::previous()}}"><button class="my-button" style="float: left;position: relative;margin-top: 3%;letter-spacing:1px;left: 39rem;background-color: #054816!important;">Go Back</button></a>
        <a id="cancelBookingBtn" ><button class="my-button" style="margin-top:3%;background-color: #1e9bd0!important;">Cancel Booking</button></a>

                    @endif

                    @if($booking->booking_status ==7)
                    
                    <!--<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-primary" style="margin-top:15px;">Review Professional</button>-->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="">Review Professional</button>


                    @endif
                    
                    @if($booking->booking_status == 5 )
                    
                    <form action="{{route('user.payment.make')}}" method="POST" name="pay">
                        @csrf
                        <input type="hidden" name="amount" id="amount" value="{{$booking->amount}}">
                        <input type="hidden" name="booking_id" id="booking_id" value="{{$booking->id}}">
                        <button type="submit" class="btn btn-primary float-right" style="margin-top: 26px;">Pay Now</button>
                    </form>
                    
                    @if(isset($booking->pdf))
                    <a href="{{url('invoices/'.$booking->pdf)}}" target="_blank"><button class="my-button-1" style="margin-top: 26px;">Generate Invoice</button></a>
                    @endif

                    @endif
                    
                    <!-- @if($booking->booking_status == 2)

                    <a href="{{URL::previous()}}"><button class="my-button" style="float: left;position: relative;margin-top: 3%;letter-spacing:1px;left: 39rem;background-color: #054816!important;">Go Back</button></a>

                     <a href="{{url('job/'.$booking->service_id.'/?booking_id='.$booking->id)}}" class="my-button" style="margin-top:3%;background-color: #1e9bd0!important;">Rebook</a> 

                    @endif -->

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </section>

   </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review Proffesional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="center-img"><i class="fa fa-user" aria-hidden="true" id="user"></i> </div>
        <h3 class="title-text">{{$booking['proDetails']['name']}}</h3>
        <form method="post" id="user-rating-form" name="user-rating-form" action="{{route('prof-review-post')}}">
             @csrf
               
              <input type="hidden" name="pro_id" value="{{$booking->pro_id}}">
               <input type="hidden" id="selected-rating" name="stars" value="">
        <div class="center-star">
            <span class="user-rating">
                    <input type="radio" name="rating" value="5"><span class="star"></span>

                        <input type="radio" name="rating" value="4"><span class="star"></span>

                        <input type="radio" name="rating" value="3"><span class="star"></span>

                        <input type="radio" name="rating" value="2"><span class="star"></span>

                        <input type="radio" name="rating" value="1"><span class="star"></span>
                    </span>
             <!--<i class="fa fa-star" aria-hidden="true"></i>
             <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>--> </div>

          <div class="form-group">
              
               
            <textarea class="form-control" id="reviews" name="reviews" placeholder="Write Something"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Not Now</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>
<!--cancel booking reason modal-->
  <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Reason For Cancellation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{url('user/cancel-booking/'.$booking->id)}}" method="ANY" name="cancel-booking" id="cancel-booking">
            @csrf
      <div class="modal-body">    
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Please provide valid Reason for cancellation of the booking</label>

          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="cancel_reason_u" name="cancel_reason_u"></textarea>
            <input type="hidden" name="booking_id" id="booking_id" value="{{$booking->id}}">
          </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Send message</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--modal end-->
</div>
</div>
</div>

@section('script')

<script type="text/javascript">
$('#user-rating-form').on('change','[name="rating"]',function(){
  $('#selected-rating').val($('[name="rating"]:checked').val());
});
</script>
<script type="text/javascript">
  $('#cancelBookingBtn').click(function() {
    $('#cancelModal').modal('show');
  });
</script>

@endsection