@extends('website.layouts.master')
@section('content')
 <!-- page-title -->

 <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Tomorrow&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">


        <div class="ttm-page-title-row text-center">

            <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

            <div class="container">

                <div class="row">

                    <div class="col-md-12"> 

                        <div class="title-box ttm-textcolor-white">

                            <div class="page-title-heading">

                                <h1 class="title">Dashboard</h1>

                            </div><!-- /.page-title-captions -->

                        </div>

                    </div><!-- /.col-md-12 -->  

                </div><!-- /.row -->  

            </div><!-- /.container -->                      

        </div><!-- page-title end-->

   <div class="site-main">
   <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h4 class="service-title">Bookings</h4>
          </div>
        <!--   <div class="col-md-4" >
              <button class="text-right" style="float: right;background-color: #1e9bd0;">View All Jobs</button>
          </div> -->
          
        </div>
      </div>
      <section class="pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding:0;">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab"  href="{{url('user/dashboard')}}"
                                
                                style="background-color:#1e9bd0;font-family: 'Poppins', sans-serif;">Upcoming</a>
                            <a class="nav-item nav-link " id="nav-profile-tab"  href="{{url('user/dashboard/past')}}"
                                style="background-color:#ccc;font-family: 'Poppins', sans-serif;">Past</a>
                          

                        </div>
                    </nav>
                </div>
                <div class="col-md-12 tab-content py-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        style="border: 1px solid #ccc7c7;
                            border-radius: 10px;
                            padding: 12px 9px;
                            padding-bottom: 2%;background-color: #ffffff38;">
                         @forelse($bookings as $value)
                         @php
                          if($value->time == 0){

                          $timeval = 'Morning(08:00 AM - 11:00 AM)';
                          }

                          if($value->time == 1){

                          $timeval = 'Midnoon(11:00 AM - 02:00 PM)';
                          }

                          if($value->time == 2){

                          $timeval = 'Afternoon( 02:00 PM - 05:00 PM)';
                          }

                          if($value->time == 3){

                          $timeval = 'Evening(05:00 PM - 08:00 PM)';
                          }
                          @endphp
                        <a href="{{url('user/booking-details/'.$value->id)}}">
                        <div class="border-bottom-inner-side mt-2">
                            @if($value->booking_status == 5)
                            <h2 class="head">$ {{$value->amount}}</h2>
                            @else
                            <h2 class="head">$ {{$value['serviceDetails']['price']}}</h2>
                            @endif
                            <span class="side-info" style="margin-bottom: 55px;margin-top: -37px;font-weight:700;">{{$value->booking_show_id}}</span>
                            <p class="info">Service:</p><span class="side-info">{{$value['serviceDetails']['name']}}</span>
                            <span class="side-info1">{{date('D,d M Y',strtotime($value->date))}}</span>
                            <span class="side-info2">{{$timeval}}</span>
                            <div class="py-0" style="clear:both;">
                                @if($value->custom_booking == 1)
                                <p class="head" style="color:black;">Amount : $ {{$value->amount}}</p>
                                @endif
                              @if($value->booking_status == 0)
                                <button class="my-button text-white">Pending</button>
                              @endif
                              @if($value->booking_status == 1)
                                <button class="my-button text-white">Confirmed</button>
                              @endif
                              @if($value->booking_status == 5)
                                <button class="my-button text-white">Payment Pending</button>
                              @endif
                               @if($value->booking_status == 6)
                                <button class="my-button text-white">Service Start</button>
                              @endif
                            </div>
                        </div>
                        </a>
                        @empty
                        <div class="border-bottom-inner-side mt-2 text-center" style="border: none!important;padding-bottom: 0%!important;padding: 0px!important;">
                          <!-- <h2 style="font-size: 27px;">No Bookings Yet</h2> -->
                          <img src="{{asset('image/no-data3.png')}}" height="132px">
                        </div>
                        @endforelse
                    </div>
                  
                  </div>
              </div>
          </div>
        </section>
   </div>

</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

@endsection