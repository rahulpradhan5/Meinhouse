@extends('professional.layout.layout')
@section('content')

<style type="text/css">
   .button {
   background-color: #17a2b8;
   border: none;
   color: white;
   padding: 30px;
   text-align: center;
   text-decoration: none;
   display: inline-block;
   font-size: 16px;
   margin: 4px 2px;
   cursor: pointer;
   }
   .button5 {border-radius: 50%;}
</style>
   <div class="row">
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
   <div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Booking Details</h3>
   </div>
      <!-- /.card-header -->
      <div class="card ">
      <br>
      <div class="card-body pt-0">
         <div class="row">
            <div class="col-7">
               <h2 class="lead"><b>{{$booking->userDetails->name}}</b></h2>
               <p class="text-muted text-sm"><b>Booking Id: </b> {{$booking->booking_show_id}}<br> 
               <b>Service: </b> {{$booking['serviceDetails']['name']}} </p>
               <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$booking->address}}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{$booking->phone_no}}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-bookmark"></i></span> Description #: {{$booking->description}} </li>
                  @if($booking['serviceDetails']['service_type'] == 1)
                  <li class="small"><span class="fa-li"><i class="fas fa-bookmark"></i></span> Estimated Area #: {{$booking->es_sqfs}} sqft</li>
                  @endif
               </ul>
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
            <div class="col-5 ">
               <br>
               <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small"><span class="fa-li"><i class="fas fa-calendar-minus"></i></span> {{date('D,d M Y',strtotime($booking->date))}} </li>
                  <li class="small"><span class="fa-li"><i class="far fa-clock"></i></span>{{$timeval}}</li>
               </ul>
            </div>
         </div>
         <br>
         <H4>Service Charge</H4>
         <!--for box layout Start -->
         @if($booking->custom_booking == 0)
          <div class="card ">
              <div class="card-body pt-0">
                @if($booking->booking_status == 5 || $booking->booking_status == 7)
                    @if($booking['serviceDetails']['service_type'] == 0)
                     <div class="row">
                        <div class="col-7"><br>
                           <h2 class="lead"><b>Total Time</b></h2>
                           <h2 class="lead"><b>Amount</b></h2>
                           
                        </div>
                        <div class="col-5 "><br>
                          <h2 class="lead"><b>:  {{gmdate("H:i", $booking->total_service_time)}} </b></h2>
                          <h2 class="lead"><b>: $ {{$booking->amount}} </b></h2>
                        </div>
                     </div>
                     @else
                     <div class="row">
                        <div class="col-7"><br>
                           <h2 class="lead"><b>Total sqft</b></h2>
                           <h2 class="lead"><b>Amount</b></h2>
                           
                        </div>
                        <div class="col-5 "><br>
                          <h2 class="lead"><b>:  {{$booking->total_sqfs ? $booking->total_sqfs : 'NA'}} </b></h2>
                          <h2 class="lead"><b>: $ {{$booking->amount}} </b></h2>
                        </div>
                     </div>
                     @endif
                 @else
                     @if($booking['serviceDetails']['service_type'] == 0)
                     <div class="row">
                        <div class="col-7"><br>
                           <h2 class="lead"><b>For the First {{$booking['serviceDetails']['time']}} Hour</b></h2>
                           <h2 class="lead"><b>For each Additional Hour</b></h2>
                           
                        </div>
                        <div class="col-5 "><br>
                          <h2 class="lead"><b>: $ {{$booking['serviceDetails']['price']}} </b></h2>
                          <h2 class="lead"><b>: $ {{$booking['serviceDetails']['add_price']}} </b></h2>
                        </div>
                     </div>
                     @else
                     <div class="row">
                        <div class="col-7"><br>
                           <h2 class="lead"><b>For the First {{$booking['serviceDetails']['time']}} sqft</b></h2>
                           <h2 class="lead"><b>For each Additional sqft</b></h2>
                           
                        </div>
                        <div class="col-5 "><br>
                          <h2 class="lead"><b>: $ {{$booking['serviceDetails']['price']}} </b></h2>
                          <h2 class="lead"><b>: $ {{$booking['serviceDetails']['add_price']}} </b></h2>
                        </div>
                     </div>
                     @endif
                 @endif
                  </div>   
          </div>
          @else
          <div class="card ">
              <div class="card-body pt-0">
                @if($booking->booking_status == 5 || $booking->booking_status == 7)
                    @if($booking['serviceDetails']['service_type'] == 0)
                     <div class="row">
                        <div class="col-7"><br>
                           <!--<h2 class="lead"><b>Total Time</b></h2>-->
                           <h2 class="lead"><b>Amount</b></h2>
                           
                        </div>
                        <div class="col-5 "><br>
                          <!--<h2 class="lead"><b>:  {{gmdate("H:i", $booking->total_service_time)}} </b></h2>-->
                          <h2 class="lead"><b>: $ {{$booking->amount}} </b></h2>
                        </div>
                     </div>
                     @else
                     <div class="row">
                        <div class="col-7"><br>
                           <!--<h2 class="lead"><b>Total sqft</b></h2>-->
                           <h2 class="lead"><b>Amount</b></h2>
                           
                        </div>
                        <div class="col-5 "><br>
                          <!--<h2 class="lead"><b>:  {{$booking->total_sqfs ? $booking->total_sqfs : 'NA'}} </b></h2>-->
                          <h2 class="lead"><b>: $ {{$booking->amount}} </b></h2>
                        </div>
                     </div>
                     @endif
                 @else
                     @if($booking['serviceDetails']['service_type'] == 0)
                     <div class="row">
                        <div class="col-7"><br>
                           <h2 class="lead"><b>Amount</b></h2>
                           <!--<h2 class="lead"><b>For each Additional Hour</b></h2>-->
                           
                        </div>
                        <div class="col-5 "><br>
                          <h2 class="lead"><b>: $ {{$booking->amount}} </b></h2>
                          <!--<h2 class="lead"><b>: $ {{$booking['serviceDetails']['add_price']}} </b></h2>-->
                        </div>
                     </div>
                     @else
                     <div class="row">
                        <div class="col-7"><br>
                           <h2 class="lead"><b>Amount</b></h2>
                           <!--<h2 class="lead"><b>For each Additional sqft</b></h2>-->
                           
                        </div>
                        <div class="col-5 "><br>
                          <h2 class="lead"><b>: $ {{$booking->amount}} </b></h2>
                          <!--<h2 class="lead"><b>: $ {{$booking['serviceDetails']['add_price']}} </b></h2>-->
                        </div>
                     </div>
                     @endif
                 @endif
                  </div>   
          </div>
          @endif
      </div>
      @if($booking->custom_booking == 0)
          @if($booking->booking_status == 1)
          <div class="card-footer">
             <div style="text-align: center;">
                <a id="digitPasswordbtn"  class="button button5">Start</a>
    	   	</div> 
    	  </div>
    	  @endif
    	  @if($booking->booking_status == 6)
          <div class="card-footer">
             <div style="text-align: center;">
                <a id="endServicebtn"  class="button button5">End</a>
    	   	</div> 
    	  </div>
    	  @endif    
	  @else
	    @if($booking->booking_status == 1)
          <div class="card-footer">
             <div style="text-align: center;">
                <a id="digitPasswordbtn"  class="button button5">Start Custom Service</a>
    	   	</div> 
    	  </div>
    	  @endif
    	  @if($booking->booking_status == 6)
          <div class="card-footer">
             <div style="text-align: center;">
                <a id="endServicebtn"  class="button button5">End Service</a>
    	   	</div> 
    	  </div>
    	  @endif
	  @endif
    
    
@if($booking->booking_status == 1)
<div class="row" style="margin-bottom: 10px;">
      <div class="col-md-4">
        
      </div>
      <div class="col-md-2"   >
        <a href="{{url('pro/bookings')}}"  class="btn btn-primary">Go Back</a>
      </div>
      <div class="col-md-2">
        <a id="cancelBookingBtn" class="btn btn-danger" >Cancel Booking</a>
      </div>
      <div class="col-md-4">
        
      </div>     
</div>
@else
<div class="row" style="margin-bottom: 10px;">
     
      <div class="col-md-12"  style="text-align: center;" >
        <a href="{{url('pro/bookings')}}"  class="btn btn-primary">Go Back</a>
      </div>
          
</div>
@endif
<div id="digitPassword" class="modal " tabindex="-1" role="dialog" aria-labelledby="digitPasswordlbl" aria-hidden="true">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-sm vertical-align-center">
         <div class="modal-content" style="width: 172%;">
            <div class="modal-header" style="display: block;">
               <button type="button" class="close"  data-bs-dismiss="modal" aria-hidden="true"></button>
               <h4 class="modal-title" id="digitPasswordlbl">Enter your four-digit OTP:</h4>
               <p>We have sent an OTP to registered user email address. Please enter the OTP to confirm before starting a service.</p>
            </div>
             <form action="{{url('pro/verify-otp-start')}}" method="POST" name="start-service" id="start-service">
                 @csrf
            <div class="modal-body" style="text-align: center;">
               <div class="form-group row">
                  <div class="col-md-3">
                  </div>
                 
                  <div class="col-md-6">
                     <input class="digit text-center" type="text" required id="firstdigit" size="1" maxlength="1" tabindex="0" name="otp[]">
                     <input class="digit text-center" type="text" required id="firstdigit" size="1" maxlength="1" tabindex="1" name="otp[]">
                     <input class="digit text-center" type="text" required id="thirddigit" size="1" maxlength="1"  tabindex="2" name="otp[]" >
                     <input class="digit text-center" type="text" required id="fourthdigit" size="1" maxlength="1" tabindex="3" name="otp[]"> 
                     <input type="hidden" name="booking_id" id="booking_id" value="{{$booking->id}}">
                  </div>
                  <div class="col-md-3">
                  </div>
               </div>
               <div class="form-group" >
                  <div class="col-sm-9 col-sm-offset-3 text-center">
                     <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                     <button type="submit" class="btn btn-default digit" tabindex="3">Submit</button>
                  </div>
               </div>
            </div>
             </form>
         </div>
      </div>
   </div>
</div>
<div id="endService" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="digitPasswordlbl" aria-hidden="true">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-sm vertical-align-center">
         <div class="modal-content" style="width: 172%;">
            <div class="modal-header" style="display: block;">
               <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="digitPasswordlbl">Enter your four-digit OTP:</h4>
               <p>We have sent an OTP to registered user email address. Please enter the OTP to confirm before ending a service.</p>
            </div>
             <form action="{{url('pro/verify-otp-end')}}" method="POST" name="start-service">
                 @csrf
            <div class="modal-body" style="text-align: center;">
               <div class="form-group row">
                  <div class="col-md-3">
                  </div>
                 
                  <div class="col-md-6">
                     <input class="digit text-center" type="text" required id="firstdigit" size="1" maxlength="1" tabindex="0" name="otp[]">
                     <input class="digit text-center" type="text" required id="firstdigit" size="1" maxlength="1" tabindex="1" name="otp[]">
                     <input class="digit text-center" type="text" required id="thirddigit" size="1" maxlength="1"  tabindex="2" name="otp[]" >
                     <input class="digit text-center" type="text" required id="fourthdigit" size="1" maxlength="1" tabindex="3" name="otp[]"> 
                     <input type="hidden" name="booking_id" id="booking_id" value="{{$booking->id}}">
                  </div>
                  <div class="col-md-3">
                  </div>
               </div>
               <div class="form-group" >
                  <div class="col-sm-9 col-sm-offset-3 text-center">
                     <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                     <button type="submit" class="btn btn-default digit" tabindex="3">Submit</button>
                  </div>
               </div>
            </div>
             </form>
         </div>
      </div>
   </div>
</div>
 <!-- Modal -->
  <div class="modal fade" id="servError" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Unable to proceed</h4>
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p id="message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Reason For Cancellation</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <form action="{{url('pro/cancel-booking')}}" method="POST" name="cancel-booking" id="cancel-booking">
            @csrf
      <div class="modal-body">    
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Please provide valid Reason for cancellation of the booking</label>

          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="cancel_reason" name="cancel_reason"></textarea>
            <input type="hidden" name="booking_id" id="booking_id" value="{{$booking->id}}">
          </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Send message</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>

$( document ).ready(function() {

    $('#digitPasswordbtn').click(function() {

        $.ajax({
          url: "{{URL::to('pro/match')}}",
          type: 'POST',
          // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
          data: {
            _method: 'POST',
            bookingId: "{{$booking->id}}",
            _token:  '{{ csrf_token() }}',
          },
          success: function(response){
            if(response['response_code'] == 200){

                $('#digitPassword').modal('show');
            }

            if(response['response_code'] == 400){
                
                $('#servError').modal('show');
                $('#message').empty();
                $('#message').html(response['response_message']);
                

            }
          }
        });

        

    });

    $(":input[type='text']").keyup(function(event){

        if ($(this).next('[type="text"]').length > 0){

            $(this).next('[type="text"]')[0].focus();

        }else{

            if ($(this).parent().next().find('[type="text"]').length > 0){

                $(this).parent().next().find('[type="text"]')[0].focus();

            }

        }

    });

    $('#digitPassword').on('shown.bs.modal', function (e) {

        $("#firstdigit").focus();

    });

});

</script>
<script>

$( document ).ready(function() {

    $('#endServicebtn').click(function() {

        $.ajax({
          url: "{{URL::to('pro/otp-end')}}",
          type: 'POST',
          // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
          data: {
            _method: 'POST',
            bookingId: "{{$booking->id}}",
            _token:  '{{ csrf_token() }}'
          },
          success: function(response){
            if(response['response_code'] == 200){

                $('#endService').modal('show');
            }

            if(response['response_code'] == 400){
                
                $('#servError').modal('show');
                $('#message').empty();
                $('#message').html(response['response_message']);
                
            }
          }
        });      

    });

    $(":input[type='text']").keyup(function(event){

        if ($(this).next('[type="text"]').length > 0){

            $(this).next('[type="text"]')[0].focus();

        }else{

            if ($(this).parent().next().find('[type="text"]').length > 0){

                $(this).parent().next().find('[type="text"]')[0].focus();

            }

        }

    });

    $('#endService').on('shown.bs.modal', function (e) {

        $("#firstdigit").focus();

    });

});

</script>
<script type="text/javascript">
  $('#cancelBookingBtn').click(function() {
    $('#cancelModal').modal('show');
  });
</script>
@endsection

