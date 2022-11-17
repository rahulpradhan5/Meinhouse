@extends('professional.layout.layout')

@section('content')



<style type="text/css">

    .label-danger {



        background-color: #d9534f;



    }



    .card-primary:not(.card-outline) .card-header {



        background-color: #17a2b8;



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

</style>



<!--@csrf-->



<!-- Info boxes -->



<div class="row">





    <div class="col-md-12">



        <div class="">



            <div class="card-header">



                <h3 class="card-title">Bidding</h3>



            </div>



            <br>







            <div class="card-body">



                @forelse($data as $key=> $value)

                <div class="card">
                    <div class="card-body pt-0">
                     <h2 class="lead mt-3 text-warning"><b>Directly Assigned Opportunity</b></h2>
                     
                      <div class="row mt-4">
                        <div class="col-3">
                          
                            <p class="text-black text-sm">
                                <b>Job Title: </b>{{ucwords($value->name)}}
                              </p>
                              <?php $mest_services  = DB::table('multiple_estimate_services')->where('id',$value->mest_service_id)->first();?>

                              <p class="text-black text-sm"><b>Service: </b>  <?php $service = DB::table('services')->where('id',$mest_services->service_id)->get(); echo $service[0]->name; ?> </p>
                              <p class="text-black text-sm"><b>Address: </b>{{$value->eb_locality}}</p>
                              <p class="text-black text-sm"><b>Maximum Bid: </b><b class="text-secondary">$</b>{{$value->pro_amount}}</p>
                              <p class="text-black text-sm"><b>Bidding Amount: </b>{{ $value->bidding_amount==NULL? "NA" : "$".$value->bidding_amount }}</p>
 
                          
                        </div>
                        <div class="col-5 "> 
                           <div class="row">

                              <div class="col">

                                <p class="text-black text-sm">
                                    <b>Date assigned: </b> {{date('d.m.Y', strtotime($value->start_date))}}
                                 </p>
                                 <p class="text-black text-sm">
                                    <b>Job Description: </b> {{ ucfirst(substr($value->notes,0,25)) }}
                                        @if (strlen($value->notes)>25)...

                                        <a data-bs-toggle="modal" data-bs-target="#read_more{{$value->id}}" href="javascript:;" style="color:#136acd;text-decoration: none; font-size: 12px" class="text-primary">Read More</a> 
                                        
                                        
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

                            


                           </div>



                        </div>

                        <div class="col-4">



                           <div class="d-flex flex-row flex-wrap gallerys{{$value->id}}">

                           <?php

$t = DB::table('multiple_estimate_bidding_images')->where('mest_service_id',$mest_services->id)->get();

?>





<?php $usr_data_att = DB::table('multiple_estimate')->where('booking_show_id',$value->booking_id)->first();?>

@if($usr_data_att->user_data_id!=NULL)

<?php $usr_data_img = DB::table('user_data_images')->where('user_data_id',$usr_data_att->user_data_id)->get();?>


@foreach($usr_data_img as $udi)



<?php $extension2 = pathinfo(url('public/User_data_uploads/'.$udi->image), PATHINFO_EXTENSION);?>

@if($extension2=='pdf')

<div class="photos">
<a href="{{url('public/User_data_uploads/'.$udi->image)}}" target="_blank">
<img src="{{url('public/User_data_uploads/pdf.png')}}" style="height:100px;width:100px;">
</a>

</div>



@else
<div class="photos">
<a href="{{url('public/User_data_uploads/'.$udi->image)}}" target="_blank">
<img src="{{url('public/User_data_uploads/'.$udi->image)}}" style="height:100px;width:100px;">
</a>

</div>



@endif

@if($loop->last)

@foreach($t as $if)

<?php $extension = pathinfo(url('public/multiple_bid_attachment/'.$if->image), PATHINFO_EXTENSION);?>

@if($extension=='pdf')


        <div class="photos">
<a href="{{url('public/multiple_bid_attachment/'.$if->image)}}" target="_blank">
<img src="{{url('public/bid_attachment/pdf.png')}}" style="height:100px;width:100px;">
</a>

</div>

@else
<div class="photos">
<a href="{{url('public/multiple_bid_attachment/'.$if->image)}}" target="_blank">

<img src="{{url('public/multiple_bid_attachment/'.$if->image)}}" style="height:100px;width:100px;">
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

<img src="{{url('public/bid_attachment/pdf.png')}}" style="height:100px;width:100px;">
</a>

</div>
        

        @else
        <div class="photos">
<a href="{{url('public/multiple_bid_attachment/'.$if->image)}}" target="_blank">

<img   src="{{url('public/multiple_bid_attachment/'.$if->image)}}" style="height:100px;width:100px;">
</a>

</div>

       

        @endif

@endforeach

@else

<!--<div class="card text-center">-->

<!--    <div class="card-body">-->

<h4 class="mt-3 ml-3">Not Images found</h4>



<!--    </div>-->

<!--</div>-->

@endif





@endif

                           </div>


                         
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
<form method="post" action="{{ url('pro/bid/update') }}" class="mt-4">

@csrf

@if($value->bidding_amount==NULL)

<input type="hidden" name="bid_id" value="{{ $value->id }}">

<div class="form-group">

    <input type="hidden" value="{{$value->pro_amount}}" name="check_bid_amount">

<div class="d-flex ">

    <div class="col-4"><input type="text"
        onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
        name="bidding_amount" class="form-control" placeholder="Enter Bidding Amount.." required>
    </div>


    <div class="col-4 mx-2"> <textarea class="form-control " rows="3" placeholder="Enter Comments.." name="comment"
        maxlength="300" required></textarea>
    </div>
    @if($value->bidding_amount==NULL)

<div class="col-4 mt-4"> <input type="submit" class="btn btn-xs btn-primary float-end" value="Submit Bid">
</div>
 @endif
    </div>

    @error('bidding_amount')

    <div class="validate_err">{{ $message }}</div>

    @enderror
   
</div>

@endif
@if($value->bidding_amount!=NULL)<button class="btn btn-xs btn-primary float-end" disabled>Submitted..</button>
@endif








<!--<a href="#" class="btn btn-sm btn-primary">Send</a>-->



</form>
                    </div>
                  </div>      

               @empty

               <div class="card bg-light">

                  <center><br>No Bid Available<br><br></center>

               </div>

               @endforelse



            </div>



            <!-- /.card-body -->



        </div>



        <!-- /.card -->



    </div>



</div>



    @endsection
     @section('script')
    
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