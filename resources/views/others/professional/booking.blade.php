 
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
   .btntext{
        
        width: 14%;
        float: right;
        padding-right: 2.5%;
        padding-top: 1%;
        padding-bottom: 1%;
        margin-right: 2%;
        border-radius: 14%;
   }
</style>
 <div class="content-wrapper">

    <section class="content"><br>
   <div class="container-fluid">
                  <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Bookings</h3>
            <!--<div class="card-header p-2">
               -->
            <!--</div>
               <h3 class="card-title">Bookings</h3>-->
         </div>
         <div class="tab">
           <a href="{{url('proff-bookings')}}"><button class="tablinks active" style="border-right: solid;border-color: #001f3f29;">Upcoming</button></a> 
           <a href="{{url('past-bookings')}}"><button class="tablinks" onclick="openCity(event, 'Past')">Past</button></a>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form class="form-horizontal" >
            <input type="hidden" name="_token" value="VhgBkZreKlkjzGC6riQe5O8njh4MalfEJTaGpO4S">            <div class="card-body">
               <div class="card card-solid">
                  <div class="card-body pb-0">
                     <div class="row d-flex align-items-stretch">
                        @foreach($booking as $key => $orderDetails)
						<div class="col-12 ">
                            <a href="https://meinhaus.ca/pro/booking/detail/441">
                           <div class="card bg-light"><br>
                            <div class="card-body pt-0">
                                 <div class="row">
                                    <div class="col-7">
                                       <h2 class="lead"><b><?php
						    $booking_info = DB::table('bookings')->where('id',$orderDetails->booking_id)->get(); $user_id = $booking_info[0]->user_id;
							$user_info = DB::table('users')->where('id',$user_id)->get();
							echo $user_info[0]->name;
							
							if($booking_info[0]->time=='0'){
								$timeval = 'Morning(8-11 AM)';
							}
							if($booking_info[0]->time=='1'){
								$timeval = 'Midnoon(11-2 PM)';
							}
							if($booking_info[0]->time=='2'){
								$timeval = 'Afternoon(2-5 PM)';
							}
							if($booking_info[0]->time=='3'){
								$timeval = 'Evening(5-8 PM)';
							}
							
						   ?></b></h2>
                                       <p class="text-muted text-sm"><b>Booking ID: </b> <?php echo $booking_info[0]->booking_show_id; ?> <br>
                                       <b>Service: </b> <?php $services = DB::table('services')->where('id',$booking_info[0]->service_id)->get(); echo $services[0]->name; ?> </p>
                                       <ul class="ml-4 mb-0 fa-ul text-muted">
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $booking_info[0]->address; ?></li>
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?php echo $booking_info[0]->phone_no; ?></li>
                                          <li class="small"><span class="fa-li"><i class="fas fa-bookmark"></i></span> Description #: <?php echo $booking_info[0]->description; ?> </li>
                                       </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                       Date: <?php echo $booking_info[0]->date; ?>
                                       
                                    </div>
                                 </div>
                              </div>
                              <div class="card-footer">
                                 @if($orderDetails->status == 1)
                                 <div class="text-right btntext" style="background: #32571A;color:white;">
                                    <i class="fas fa-user"></i>
                                    Accepted
                                  </div>
                                   @endif
                                   @if($orderDetails->status == 6)
                                  <div class="text-right btntext" style="background: #3DACF7;padding-right: 1.5%!important;">
                                    <i class="fas fa-user"></i>
                                    Service Start
                                  </div>
                                   @endif
                              </div>
							
                           </div>
                           </a>
                        </div>
						
						 @endforeach
                                         
                                             </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>

  </div>
  
  @endsection