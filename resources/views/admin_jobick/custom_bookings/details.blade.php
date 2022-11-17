@extends('admin_jobick.layout.layout')
@section('head_title','Custom Bookings Management
')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Custom Bookings Management</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Booking Id</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->booking_show_id}}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">User Name</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->name}}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Service Name</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <?php

                        $services=$bookings->service_id;
                        $arr=explode(',', $services);

                        $services=[];
                        for ($i=0; $i <count($arr) ; $i++) {

                          $int = (int)$arr[$i];
                          $service= DB::table('services')->where('id',$int)->pluck('name')->toArray();


                          array_push($services,implode("",$service));
                        }
                          ?>



                           @if(count($services))
                           {{implode(",",$services)}}
                           @else
                           NA
                           @endif

                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Date</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->date}}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Phone</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->phone_no}}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Address</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->area}}</span>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">City/Municipality</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->city}}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Postal code</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->pincode}}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Province</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->state}}</span>
                    </div>
                </div>
              
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">What do you need done?</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->description}}</span>
                    </div>
                </div>

                @php
                if($bookings->time == 0){
                $timeval = 'Morning(8-11 AM)';
                }
                if($bookings->time == 1){
                $timeval = 'Midnoon(11-2 PM)';
                }
                if($bookings->time == 2){
                $timeval = 'Afternoon(2-5 PM)';
                }
                if($bookings->time == 3){
                $timeval = 'Evening(5-8 PM)';
                }
                @endphp
                <!----div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Pro Assigned</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->pro_id ? $bookings['proDetails']['name'] : 'NA'}}</span>
                    </div>
                </!----div----->
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Time</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$timeval}}</span>
                    </div>
                </div>
                @php
                if($bookings->booking_status == 0){
                $book ='Pending';
                }
                if($bookings->booking_status == 1){
                $book ='Confirmed';
                }
                if($bookings->booking_status == 2){
                $book ='Pro Cancelled';
                }
                if($bookings->booking_status == 3){
                $book ='User Cancelled';
                }
                if($bookings->booking_status == 4){
                $book ='Time Exceeds';
                }
                if($bookings->booking_status == 5){
                $book = 'Completed';
                }
                if($bookings->booking_status == 6){
                $book ='Service Start';
                }
                if($bookings->booking_status ==7){
                $book ='Payment Done';
                }
                if($bookings->booking_status == 8){
                $book ='Admin Cancelled';
                }
                @endphp

                <!---div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Booking Status</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$book}}</span>
                    </div>
                </!---div-->
                @if($bookings->booking_status == 2)
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4 col-sm-4">Cancel Reason</label>
                    <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                    <div class="col-6 col-sm-6">
                        <span class="">{{$bookings->cancel_reason}}</span>
                    </div>
                </div>
                @endif
                <div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-4 col-sm-4">Amount</label>
                        <label for="inputEmail3" class="col-2 col-sm-2 "><B>:</B></label>
                        <div class="col-6 col-sm-6">
                            <span class="">{{$bookings->amount}}</span>
                        </div>
                    </div>
                </div>
               




                <div class="row">
                    <div class="col-12">
                        <div class="card-footer">
                            @if($bookings->booking_status == 1)
                            <button class="btn btn-danger" onclick="myFunction({{$bookings->id}})">Cancel
                                Booking</button>
                            @endif

                            @if($bookings->booking_status == 7)
                            <button class="btn btn-primary" onclick="myFunctions({{$bookings->id}})">Pay to
                                Professional</button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
     <script type="text/javascript">
      function myFunction(id){
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this booking!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                  $.ajax({
                      url: "{{ url('admin/bookings/cancel/') }}/"+id,
                      type: "GET",
                      dataType: "html",
                      success: function () {
                          swal("Done!", "Booking cancelled!", "success");
                          location.reload();
                      },
                      error: function (xhr, ajaxOptions, thrownError) {
                          swal("Error deleting!", "Please try again", "error");
                      }
                  });
                }
            });
      };
    </script>
         <script type="text/javascript">
      function myFunctions(id){
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this payment!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('admin/bookings/payment/') }}/"+id,
                        type: "GET",
                        dataType: "html",
                        success: function () {
                            swal("Done!", "Payment done to Professional!", "success");
                            location.reload();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error making payment!", "Please try again", "error");
                        }
                    });
                }
            });
          }
    </script>
    @endsection
