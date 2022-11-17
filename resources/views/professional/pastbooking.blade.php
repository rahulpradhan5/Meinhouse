 
 @extends('professional.layout.layout')
@section('content')

@section('head_title', 'HISTORY')
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
   
        .label-danger {
            background-color: #d9534f;
        }

        .card-primary:not(.card-outline) .card-header {
            background-color: #17a2b8;
        }
r
        .label {
            display: inline;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
        .photos{
      width:30%;
      margin:0.5%;
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
            transition: all 0.5s ease-in-out;
            position: relative;
            border: 0rem solid transparent;
            border-radius: 1.25rem;
            /* box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgba(82, 63, 105, 0.05); */
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            height: auto;
        }
        </style>

<div class="row">
            <!-- /.row -->
            <!--start-->
            <!--         -->
            <div class="col-md-12">
              <div class="">
                <div class="card-header">
                  <h3 class="card-title">Completed jobs</h3>
                </div>
                <br />
                <div class="card-body">
                  @forelse($data as $key=> $value)
                  <div class="card">
                    <div class="card-body pt-0">
                     <h2 class="lead mt-3 text-warning" ><b>{{ucwords($value->name)}}</b></h2>
                     
                      <div class="row mt-4">
                        <div class="col-3">
                          
                          <p class="text-black text-sm">
                            <b>Job Title: </b> {{ucwords($value->name)}}
                          </p>
                          <p class="text-black text-sm">
                            <b>Customer Name: </b> {{ucwords($value->username)}}
                          </p>
                          <p class="text-black text-sm">
                            <b>Exact Address: </b>{{ucwords($value->address)}}
                          </p>
                          <p class="text-black text-sm">
                            <b>Date project commenced: </b> {{date('d.m.Y', strtotime($value->assign_date))}}
                          </p>
                          
                        </div>
                        <div class="col-3"> 
                           <div class="row">

                              <div class="col">

                                 <p class="text-black text-sm">
                                  <div class="col-6 mb-3">
                                    <p class="text-black text-sm">
                                        <b>Description: </b> {{ ucfirst(substr($value->notes,0,25)) }}
                                        @if (strlen($value->notes)>25)...

                                        <a data-bs-toggle="modal" data-bs-target="#read_more{{$value->id}}" href="javascript:;" style="color:blue;text-decoration: none; font-size: 12px" >Read More</a> 
                                        
                                        
                                        <div class="modal fade" id="read_more{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog">
                            
                                                    <div class="modal-content">
                            
                                                        <div class="modal-header">
                            
                                                            <h5 class="modal-title" id="exampleModalLabel">Project Notes</h5>
                            
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
  

                                 </p>

                              </div>

                            
                              <div >
                                <br>
                                <br><br>



</div>

                           </div>



                        </div>

                        <div class="col-3">

                            <div class="row">

                                <div class="col">
  
                                   <p class="text-black text-sm">
                                      <b>Photo Requirements</b><br>
                                      <?php 

                                              $mest_services  = DB::table('multiple_estimate_services')->where('id',$value->mest_service_id)->first();
                                              $requirements =DB::table('photo_requirement')->where('booking_id',$value->estimate_booking_id)->where('service_id', $mest_services->service_id )->pluck('requirement')
                                              ?>
                                                 
                                                 <p></p>
                                             @if(count($requirements))

                                             @foreach($requirements as $key => $requirement)
                                             <li > <p>{{$key+1}}.{{$requirement}}</p> </li>


                                             @endforeach

                                             @else

                                              <p> no requirements to show </p>
                     
                                            @endif
                                    </a>
                                   
                                   
                                   </p>

                                   <div class="modal fade" id="exampleModal2{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLabel">Add Photos</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                            </div>

                                            <div class="modal-body">
                                              <li class="list-group-item active">Photo requirements</li>

                                             
                                            </div>

                                            <div class="modal-footer">



                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"  style="float:right;">Close</button>

                                            </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>



                                   
<br>
<br>
<br>
                                   
  
                                </div>

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
                                      <a href="{{url('public/User_data_uploads/'.$udi->image)}}">
                                          <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/User_data_uploads/pdf.png')}}">
                                      </a>
                                  
                                  </div>
                                  
                                  @else
                                  
                                  <div class="photos">
                                      <a href="{{url('public/User_data_uploads/'.$udi->image)}}">
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
                                      <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}">
                                          <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/bid_attachment/pdf.png')}}">
                                      </a>
                                  
                                  </div>
                                  
                                  @else
                                  <div class="photos">
                                      <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}">
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
                                      <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}">
                                          <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/bid_attachment/pdf.png')}}">
                                      </a>
                                  
                                  </div>
                                  
                                  @else
                                  
                                  <div class="photos">
                                      <a href="{{url('public/multiple_bid_attachment/'.$if->image)}}">
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
                                  
                                  <a href=" target=" _blank"><img style="height:100px;width:100px;"></a>
                                  
                                  <div class="photos">
                                      <a href="{{url('public/User_data_uploads/'.$udi->image)}}">
                                          <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/User_data_uploads/pdf.png')}}" target="_blank">
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
                                      <a href="{{url('public/attachment/'.$value->attachment)}}" target="_blank">
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
  
<p class="text-primary px-2 my-2"> Project photos</p>


                        </div>

                        <div class="col-3">

                            <div class="col-6 mb-3">
                                <div  style="background-color:blue; color:white; padding: 5px; text-align: center; border-radius: 10px; height:100%">Project rate<br>
                                    ${{$value->pro_amount}} + HST

                                </div>

                             </div>

<?php
//$service = DB::table('services')->where('id',$mest_services->service_id)->get(); 
 $mest_services  = DB::table('multiple_estimate_services')->where('id',$value->mest_service_id)->first(); 
$pro_images=[];
$pro_images = DB::table('pro_site_image')->where('booking_id',$value->estimate_booking_id)->where('service_id',$mest_services->service_id)->pluck('image');
//echo 
?>

                           <div class="d-flex flex-row flex-wrap gallerys_pro{{$value->id}}">


                          

                        
                             
                           @if(count($pro_images))
                           @foreach($pro_images as $key=>$img)
                           <div class="photos" >
                             <a href="{{url('public/pro_site_images/'.$img)}}" target="_blank">
                                  <img style="width:100%; height:100%" class="img-thumbnail" src="{{url('public/pro_site_images/'.$img)}}" >
                                      </a>
                               
                             </div>
                          @endforeach
                          <p class="text-primary px-2 my-2"> Site photos uploaded by you </p>
          
                          
                            @endif
                           </div>
                        
                        </div>
                      </div>
                    </div>


                    <div class="card-footer d-flex justify-content-between">
                        <div> 
                         
                        <button class="btn  btn-danger text-white btn-xs mx-2" >Job completed &nbsp;</button>

                      </div>
                  </div>

            </div>
            @empty
            <p>No Previous jobs done</p>
            @endforelse
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
@foreach($data as $fn)
<script>
$(document).ready(function() {
    $('.gallerys_pro{{$fn->id}}').magnificPopup({
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
