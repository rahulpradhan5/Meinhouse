 
@extends('professional.layout.layout')
@section('content')
<style type="text/css">
   body {font-family: Arial;}
   /* Style the tab */
   .tab {
   overflow: hidden;
   border: 1px solid #ccc;
   background-color: #f1f1f1;
   }
   /* Style the buttons inside the tab */
   .tab button {
   background-color: inherit;
   float: left;
   border: none;
   outline: none;
   cursor: pointer;
   padding: 14px 16px;
   transition: 0.3s;
   font-size: 17px;
   width: 50%;
   }
   /* Change background color of buttons on hover */
   .tab button:hover {
   background-color: #ddd;
   }
   /* Create an active/current tablink class */
   .tab button.active {
   background-color: #ccc;
   }
   /* Style the tab content */
   .tabcontent {
   display: none;
   padding: 6px 12px;
   border: 1px solid #ccc;
   border-top: none;
   }
   [data-theme-version="dark"] .bg-light{
      background-color: #252531 !important;
   }
</style>
   <div class="row">
      <div class="card">
         <div class="card-header ">
            <h3 class="card-title ">Bookings</h3>
         </div>
         <div class="tab">
           <a href="{{url('pro/bookings')}}"><button class="tablinks active" style="border-right: solid;border-color: #001f3f29;">Upcoming</button></a> 
           <a href="{{url('pro/past-bookings')}}"><button class="tablinks" onclick="openCity(event, 'Past')">Past</button></a>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form class="form-horizontal" >
            @csrf
            <div class="card-body">
               <div class="card bg-light">
                  <div class="card-body ">
                     <div class="row d-flex align-items-stretch">
                        @forelse ($bookings as $booking)
                        <label   value="{{$booking['bookingsDetail']['id']}}" name= "bookings[]"></label>
                        <div class="col-12 ">
                            <a href="{{url('pro/booking-details')}}/{{$booking['bookingsDetail']['id']}}">
                           <div class="card"><br>
                            <div class="card-body ">
                                 <div class="row">
                                    <div class="col-7">
                                       <h2 class="lead"><b>{{$booking['bookingsDetail']['name']}}</b></h2>
                                       <p class="text-muted text-sm"><b>Booking ID: </b> {{$booking['bookingsDetail']['booking_show_id']}} <br>
                                       <b>Service: </b> {{$booking['bookingsDetail']['serviceDetails']['name']}} </p>
                                       <ul class="ml-4 mb-0 fa-ul text-muted">
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$booking['bookingsDetail']['address']}}, {{$booking['bookingsDetail']['area']}}, {{$booking['bookingsDetail']['city']}}, {{$booking['bookingsDetail']['pin_code']}}</li>
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + {{$booking['bookingsDetail']['phone_no']}}</li>
                                          <li class="small"><span class="fa-li"><i class="fas fa-bookmark"></i></span> Description #: {{$booking['bookingsDetail']['description']}} </li>
                                       </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                       Date: {{$booking['bookingsDetail']['date']}}
                                       
                                    </div>
                                 </div>
                              </div>
                              <div class=" card-footer ">
                                 @if($booking->status == 1)
                                 <div class="text-center btn badge  " style="background: #32571A;color:white;padding: 1.5% !important; float:right">
                                    <i class="fas fa-user"></i>
                                    Accepted
                                  </div>
                                   @endif
                                   @if($booking->status == 6)
                                  <div class="text-center btn badge" style="background: #3DACF7;padding: 1.5% !important; float:right">
                                    <i class="fas fa-user"></i>
                                    Service Start
                                  </div>
                                   @endif
                              </div>
                           </div>
                           </a>
                        </div>
                        @empty
                        <p>No upcoming bookings yet.</p>
                        @endforelse
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
  
  @endsection