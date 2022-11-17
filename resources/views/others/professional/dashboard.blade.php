<!-- Content Wrapper. Contains page content -->
@extends('professional.layout.layout')
@section('content')
<?php error_reporting(0); ?>
 <div class="content-wrapper">

    <input type="hidden" name="_token" value="kG1SyhGxKz9u9nxcyxD0XFNSqNMZhobsFT1toVQs"><section class="content-header">
   <!-- Content Header (Page header) -->
   <section class="content">
      <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        
         <!-- /.col -->
      </div>
      <!-- /.row -->
      <!--start-->
                   <div class="col-md-12">
         <div class="card card-primary">
            <div class="card-header">
               <h3 class="card-title">LEADS</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
               </div>
            </div>
            <br>
             
            <div class="card-body" style="display: block;">
			
			@foreach($leads as $key => $orderDetails)
                              <div class="card bg-light">
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
                           <p class="text-muted text-sm"><b>Service: </b> <?php $services = DB::table('services')->where('id',$booking_info[0]->service_id)->get(); echo $services[0]->name; ?> </p>
                           <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $booking_info[0]->address; ?></li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?php echo $booking_info[0]->phone_no; ?></li>
                              <li class="small"><span class="fa-li"><i class="fas fa-bookmark"></i></span> Description #: <?php echo $booking_info[0]->description; ?> </li>
                           </ul>
                        </div>
                        <div class="col-5 ">
                           <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fas fa-calendar-minus"></i></span> <?php echo date('D,d M Y',strtotime($booking_info[0]->date)) ?> </li>
                              <li class="small"><span class="fa-li"><i class="far fa-clock" ></i></span> {{$timeval}}</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <div class="text-right">
                        <a href="{{url("pro-reject/$orderDetails->booking_id")}}" class="btn btn-sm btn-primary">
                        Reject
                        </a>
                        <a href="{{url("pro-accept/$orderDetails->booking_id")}}" class="btn btn-sm btn-primary">
                        Accept
                        </a>
                     </div>
                  </div>
               </div>
			   
			   @endforeach
			   
                              
                             
                           </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
      <!--end-->
   </section>
</section>

  </div>
  </div>
  @endsection