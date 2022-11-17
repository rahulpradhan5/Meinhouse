<!-- Content Wrapper. Contains page content -->

@extends('professional.layout.layout')
@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">LEADS</h3>
            </div>
            <div class="card-body" style="display: ;">
            @if(count($leads))
               @foreach($leads as $value)
               <div class="row">
                  @php
                  if($value['bookingsDetail']['time'] == 0){
                  $timeval = 'Morning(8-11 AM)';
                  }
                  if($value['bookingsDetail']['time'] == 1){
                  $timeval = 'Midnoon(11-2 PM)';
                  }
                  if($value['bookingsDetail']['time'] == 2){
                  $timeval = 'Afternoon(2-5 PM)';
                  }
                  if($value['bookingsDetail']['time'] == 3){
                  $timeval = 'Evening(5-8 PM)';
                  }
                  @endphp
                  <div class="card-body ">
                     <div class="row">
                        <div class="col-sm-6">
                           <h2 class="lead"><b>@if($value['bookingsDetail']['userDetails']!=NULL)
                           {{$value['bookingsDetail']['userDetails']['name']}}
                           @endif
                           </b></h2>
                           <p class="text-muted text-sm"><b>Service: </b> {{$value['bookingsDetail']['serviceDetails']['name']}} </p>
                           <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$value['bookingsDetail']['address']}}</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{$value['bookingsDetail']['phone_no']}}</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-bookmark"></i></span> Description #: {{$value['bookingsDetail']['description']}} </li>
                           </ul>
                        </div>
                        <div class="col-sm-4 mt-5 pt-2">
                           <ul class=" mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fas fa-calendar-minus"></i></span> {{date('D,d M Y',strtotime($value['bookingsDetail']['date']))}} </li>
                              <li class="small"><span class="fa-li"><i class="far fa-clock" ></i></span> {{$timeval}}</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <div class="col-md-3 ms-auto">
                        <a href="{{url('pro/pro-reject',$value->booking_id)}}" class="ms-auto btn btn-sm btn-primary">
                        Reject
                        </a>
                        <a href="{{url('pro/pro-accept',$value->booking_id)}}" class="btn btn-sm btn-primary">
                        Accept
                        </a>
                     </div>
                  </div>
               </div>
               <hr>
               @endforeach
               @else
               <div class="card bg-primary h4 m-5 my-auto" style="">
                  <center>No Bookings Available</center>
               </div>
               @endif
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </div>

@endsection