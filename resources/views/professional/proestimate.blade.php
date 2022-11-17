

@extends('professional.layout.layout')
@section('head_title','ASSIGNED PROJECTS')
@section('content')


<style type="text/css">

    .label-danger {

        background-color: #d9534f;

    }



    .card-primary:not(.card-outline) .card-header {

        background-color: #17a2b8;

    }

    .photos{
      width:30%;
      margin:0.5%;
    }

    .label {

        display: inline;

        padding: .2em .6em .3em;

        font-size: 75%;

        font-weight: 700;

        line-height: 1;

        color: #fff;

        text-align: center;

        white-space: nowrap;

        vertical-align: baseline;

        border-radius: .25em;

    }



    .label-success {

        background-color: #5cb85c;

    }



    .pt-0 {

     

       margin-top: 16px !important;

    }

    .card {

      margin-bottom: 1.875rem;

      background-color: #fff;

      transition: all .5s ease-in-out;

      position: relative;

      border: 0rem solid transparent;

      border-radius: 1.25rem;

      box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgba(82, 63, 105, 0.05);

      height: auto;

      }

</style>

@csrf



<!-- Info boxes -->

<div class="row">

    <div class="col-md-12">

        <div class=""> 
            <div class="card-header">

                <h3 class="card-title">Estimate</h3>

            </div>

            <br>

            <div class="card-body" >

              
                @foreach($data as $key=> $value)
                <div class="card">
                    <div class="card-body pt-0">
                     <h2 class="lead mt-3 text-warning"><b>Directly Assigned Opportunity</b></h2>
                     
                      <div class="row mt-4">
                        <div class="col-3">
                          
                            <p class="text-black text-sm">
                                <b>Job Title: </b> {{ucwords($value->name)}}
                              </p>
                              <?php $mest_services  = DB::table('multiple_estimate_services')->where('id',$value->mest_service_id)->first();?>
  
                              <p class="text-black text-sm"><b>Service: </b> <?php $service = DB::table('services')->where('id',$mest_services->service_id)->get(); echo $service[0]->name; ?> </p>
                              <p class="text-black text-sm"><b>Address: </b>
                              
                                <?php
                                $string = $value->address;
                                $val = preg_replace('/( )+/', ' ', $string);
                                $val_arr = str_getcsv($val); 
                                $result = implode(', ', $val_arr);
                                // return $result;
                                ?>
                                
                                {{ ucwords($result) }}</p>
 
                          
                        </div>
                        <div class="col-5 "> 
                           <div class="row">

                              <div class="col">

                                <p class="text-black text-sm">
                                    <b>Date assigned: </b> {{date('d.m.Y', strtotime($value->assign_date))}}
                                 </p>
                                 <p class="text-black text-sm">
                                    <b>Job Description: </b> {{ ucfirst(substr($value->notes,0,25)) }}
                                        @if (strlen($value->notes)>25)...

                                        <a data-bs-toggle="modal" data-bs-target="#read_more{{$value->id}}" href="javascript:;" style="color:blue;text-decoration: none; font-size: 12px" >Read More</a> 
                                        
                                        
                                        <div class="modal fade" id="read_more{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog">
                            
                                                    <div class="modal-content">
                            
                                                        <div class="modal-header">
                            
                                                            <h5 class="modal-title" id="exampleModalLabel">Project Description</h5>
                            
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            
                                                        </div>
                            
                                                        <div class="modal-body">
                                                          {{ ucfirst($value->notes) }}
                                                        </div>
                            
                                                        <div class="modal-footer">
                                                            
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                            
                                                        </div>
                            
                            
                                                    </div>
                            
                                                </div>
                            
                                            </div>
                                        
                                        @endif
                                 </p>

                              </div>

                              <div class="col-4">
                                <div style="background-color:blue; color:white; padding: 5px; text-align: center; border-radius: 10px;">Project rate<br>
                                    ${{$value->pro_amount}} + HST
                                 </div>
                              </div>


                           </div>



                        </div>

                        <div class="col-4">



                           <div class="d-flex flex-row flex-wrap gallerys{{$value->id}}">

                           @if($value->attachment==NULL)
<?php

                                $t = DB::table('multiple_estimate_bidding_images')->where('mest_service_id',$mest_services->id)->get();

                                ?>



<?php $usr_data_att = DB::table('multiple_estimate')->where('booking_show_id',$value->estimate_booking_id)->first();?>

@if($usr_data_att->user_data_id!=NULL)

<?php $usr_data_img = DB::table('user_data_images')->where('user_data_id',$usr_data_att->user_data_id)->get();?>


@foreach($usr_data_img as $udi)



<?php $extension2 = pathinfo(url('public/User_data_uploads/'.$udi->image), PATHINFO_EXTENSION);?>

@if($extension2=='pdf')




<div class="photos">
    <a href="{{url('public/User_data_uploads/'.$udi->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/User_data_uploads/pdf.png')}}">
    </a>

</div>

@else

<div class="photos">
    <a href="{{url('public/User_data_uploads/'.$udi->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail"
            src="{{url('public/User_data_uploads/'.$udi->image)}}">
    </a>

</div>

@endif



@if($loop->last)

@foreach($t as $if)



<?php $extension = pathinfo(url('public/multiple_bid_attachment/'.$if->image), PATHINFO_EXTENSION);?>

@if($extension=='pdf')

<div class="photos">
    <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/bid_attachment/pdf.png')}}">
    </a>

</div>

@else
<div class="photos">
    <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail"
            src="{{url('public/multiple_bid_attachment/'.$if->image)}}">
    </a>

</div>


@endif


@endforeach



@endif

@endforeach

@else

@if(count($t))

@foreach($t as $if)

<?php $extension = pathinfo(url('public/multiple_bid_attachment/'.$if->image), PATHINFO_EXTENSION);?>

@if($extension=='pdf')



<div class="photos">
    <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/bid_attachment/pdf.png')}}">
    </a>

</div>

@else

<div class="photos">
    <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail"
            src="{{url('public/multiple_bid_attachment/'.$if->image)}}">
    </a>

</div>


@endif

@endforeach

@else

<!--<div class="card text-center">-->

<!--    <div class="card-body">-->

<h4 class="mt-3 ml-3">Not Found..</h4>



<!--    </div>-->

<!--</div>-->

@endif


@endif

@else





<?php $usr_data_att = DB::table('multiple_estimate')->where('booking_show_id',$value->estimate_booking_id)->first();?>

@if($usr_data_att->user_data_id!=NULL)

<?php $usr_data_img = DB::table('user_data_images')->where('user_data_id',$usr_data_att->user_data_id)->get();?>


@foreach($usr_data_img as $udi)


<?php $extension2 = pathinfo(url('public/User_data_uploads/'.$udi->image), PATHINFO_EXTENSION);?>

@if($extension2=='pdf')

<a href="" target=" _blank"><img style="height:100px;width:100px;"></a>

<div class="photos">
    <a href="{{url('public/User_data_uploads/'.$udi->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/User_data_uploads/pdf.png')}}">
    </a>

</div>

@else


<div class="photos">
    <a href="{{url('public/User_data_uploads/'.$udi->image)}}" target="_blank">
        <img style="width:100%; height:100%" class="img-thumbnail"
            src="{{url('public/User_data_uploads/'.$udi->image)}}">
    </a>

</div>

@endif



@if($loop->last)






<div class="photos">
    <a href="{{url('public/attachment/'.$value->attachment)}}">
        <img style="width:100%; height:100%" class="img-thumbnail"
            src="{{url('public/attachment/'.$value->attachment)}}">
    </a>

</div>

@endif

@endforeach

@else


<div class="photos">
    <a href="{{ url('public/attachment/'.$value->attachment)}}" target="_blank"><span class="fa-li"></span>  <img style="width:100%; height:100%" class="img-thumbnail" src="{{ url('public/attachment/'.$value->attachment)}}" alt=""></a>

</div>
@endif
@endif
                           </div>


                         
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="float-end flex" >


                        @if($value->Complete_status == 1)
                          
                        <button class="btn text-white btn-xs" style="background:grey">
                         Job Completed    
                        </button>
                        @else
                        

                        @if($value->assign_status == 0)

                        <a href="{{url('pro/estimate/1/'.$value->id)}}" class="btn btn-xs btn-success">

                        Accept

                        </a>

                        <a href="{{url('pro/estimate/2/'.$value->id)}}" class="btn btn-xs btn-danger">

                        Decline

                        </a>

                    @elseif($value->assign_status == 1)

                        <a href="javascrpit:void(0);" class="btn btn-xs btn-success">

                        Accepted

                        </a>

                    @elseif($value->assign_status == 2)

                        <a href="javascrpit:void(0);" class="btn btn-xs btn-danger">

                        Declined

                        </a>

                    @endif
                    @endif

                         

                       

                     
                      </div>
                    </div>
                  </div>
           

               @endforeach

            </div>

            <!-- /.card-body -->

        </div>

        <!-- /.card -->

    </div>

</div>

    @endsection

    @section('script')

    <script type="text/javascript">

        function myFunction(id) {



            swal({



                title: "Are you sure?",



                text: "You will not be able to recover this detail!",



                type: "warning",



                showCancelButton: true,



                confirmButtonClass: 'btn-danger',



                confirmButtonText: 'Yes, delete it!',



                cancelButtonText: "No, cancel please!",



                closeOnConfirm: false,



                closeOnCancel: true



            },



                function (isConfirm) {



                    if (!isConfirm) return;



                    $.ajax({



                        url: "{{ url('admin/contactus/delete/') }}/" + id,



                        type: "GET",



                        dataType: "html",



                        success: function () {



                            swal("Done!", "Detail succesfully deleted!", "success");



                            location.reload();



                        },



                        error: function (xhr, ajaxOptions, thrownError) {



                            swal("Error deleting!", "Please try again", "error");



                        }



                    });



                });



        };



    </script>
   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js" integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@foreach($data as $fn)
<script>
$(document).ready(function() {
    $('.gallerys{{$fn->id}}').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        }
    });
});



</script>
@endforeach

    @endsection
    
