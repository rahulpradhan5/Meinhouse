@extends('professional.layout.layout')
@section('head_title', 'ONGOING JOBS')
@section('content')
    
        
    <style type="text/css">
        .label-danger {
            background-color: #d9534f;
        }
    
        .card-primary:not(.card-outline) .card-header {
            background-color: #17a2b8;
        }
    
        r .label {
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
    
        .photos {
            width: 30%;
            margin: 0.5%;
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
                <h1 class="card-title">Ongoing Jobs</h1>
            </div>
            <br />
            <div class="card-body">
                @foreach ($data as $key => $value)
                    <div class="card card border-2 border-primary">
                        <div class="card-body pt-0">
                            <h2 class="lead mt-3 text-warning"style="font-weight:600;font-size:20px;" ><b>{{ ucwords($value->name) }}</b></h2>

                            <div class="row mt-4">
                                <div class="col-3">

                                   
                                    <p class="text-black text-sm" style="font-size:13px;"  >
                                        <b>Customer Name: </b> {{ ucwords($value->username) }}
                                    </p>
                                    <p class="text-black text-sm" style="font-size:13px;" >
                                        <b>Exact Address: </b>
                                        <?php
                                        $string = $value->address;
                                        $val = preg_replace('/( )+/', ' ', $string);
                                        $val_arr = str_getcsv($val); 
                                        $result = implode(', ', $val_arr);
                                        // return $result;
                                        ?>
                                        
                                        {{ ucwords($result) }}
                                    </p>
                                    <p class="text-black text-sm" style="font-size:13px;" >
                                        <b>Date project commenced: </b>
                                        {{ date('d.m.Y', strtotime($value->assign_date)) }}
                                    </p>

                                </div>
                                <div class="col-3">
                                    <div class="row">

                                        <div class="col">

                                           
                                            <div class="col-6 mb-3">
                                                <p class="text-black text-sm"style="font-size:13px;">
                                                    <b>Description: </b> {{ ucfirst(substr($value->notes, 0, 25)) }}
                                                    @if (strlen($value->notes) > 25)
                                                        ...

                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#read_more{{ $value->id }}"
                                                            href="javascript:;"
                                                            style="color:blue;text-decoration: none; font-size: 12px">Read
                                                            More</a>


                                                        <div class="modal fade" id="read_more{{ $value->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">

                                                            <div class="modal-dialog">

                                                                <div class="modal-content">

                                                                    <div class="modal-header">

                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Project Description</h5>

                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>

                                                                    </div>

                                                                    <div class="modal-body">
                                                                        {{ ucfirst($value->notes) }}
                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm"
                                                                            data-bs-dismiss="modal">Close</button>

                                                                    </div>


                                                                </div>

                                                            </div>

                                                        </div>
                                                    @endif
                                                </p>



                                            </div>


                                   

                                        </div>


                                        <div>
                                            <br>
                                            <br><br>



                                        </div>

                                    </div>



                                </div>

                                <div class="col-3">

                                    <div class="row">

                                        <div class="col">

                                            <p class="text-black text-sm" style="font-size:13px;" >
                                                <b>Photo Requirements</b><br>
                                               <?php

                                                            $mest_services = DB::table('multiple_estimate_services')
                                                                ->where('id', $value->mest_service_id)
                                                                ->first();
                                                            $requirements = DB::table('photo_requirement')
                                                                ->where('booking_id', $value->estimate_booking_id)
                                                                ->where('service_id', $mest_services->service_id)
                                                                ->pluck('requirement');
                                                            ?>

                                                            <p></p>
                                                          
                                                            @if (count($requirements))
                                                                @foreach ($requirements->slice(0,2) as $key => $requirement)
                                                                    <li class="">
                                                                        <p style="font-size:13px;">{{ $key + 1 }}.{{ $requirement }}</p>
                                                                    </li>
                                            
                                                                @endforeach
                                                            @else
                                                                <p class=""> no requirements to show </p>
                                                            @endif
                                                            @if(count($requirements)>2)
                                                            <a class="text-primary" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $value->id }}"style="font-weight:500">view all</a>
                                                            @endif


                                            </p>

                                            <div class="modal fade" id="exampleModal2{{ $value->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <h5 class="modal-title" id="exampleModalLabel">Add Photos
                                                            </h5>

                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>

                                                        </div>

                                                        <div class="modal-body">
                                                            <li class="list-group-item active">Photo requirements</li>
     @foreach ($requirements as $key => $requirement)
                                                                    <li class="list-group-item ">
                                                                        <p style="font-size:13px;">{{ $key + 1 }}.{{ $requirement }}</p>
                                                                    </li>
                                            
                                                                @endforeach
                                                           
                                                        </div>

                                                        <div class="modal-footer">



                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal"
                                                                style="float:right;">Close</button>

                                                        </div>

                                                        </form>

                                                    </div>

                                                </div>

                                            </div>




                                            <br>
                                            <br>
                                            <br>


                                        </div>
                                          <?php
                                    //$service = DB::table('services')->where('id',$mest_services->service_id)->get();
                                    $mest_services = DB::table('multiple_estimate_services')
                                        ->where('id', $value->mest_service_id)
                                        ->first();
                                    $pro_images = [];
                                    $pro_images = DB::table('pro_site_image')
                                        ->where('booking_id', $value->estimate_booking_id)
                                        ->where('service_id', $mest_services->service_id)
                                        ->pluck('image');
                                    //echo
                                    ?>
                                        
                                        <!-- Magnific PopUp Work -->
                                         <div class="d-flex flex-row flex-wrap gallerys_pro{{$value->id}}">
                                        @if (count($pro_images))
                                            @foreach ($pro_images as $key => $img)
                                                <div class="photos">
                                                    <a href="{{ url('public/pro_site_images/' . $img) }}"
                                                        target="_blank">
                                                        <img style="width:100%; height:100%" class="img-thumbnail"
                                                            src="{{ url('public/pro_site_images/' . $img) }}">
                                                    </a>

                                                </div>
                                            @endforeach
                                            <p class="text-primary px-2 my-2"style="font-weight:500"> Site photos uploaded by you </p>
                                        @else
                                            @if ($value->site_image_no != null)
                                                <button href="javascrpit:void(0);"class="btn btn-xs btn-info"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $value->id }}">
                                                    Photo Upload({{ $value->site_image_no }})
                                            @endif
                                            </button>


                                            <div class="modal fade" id="exampleModal{{ $value->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add site
                                                                photos</h5>
                                                            <button type="button" class="close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ url('pro/site-images/post') }}"
                                                                id="update-profile" name="update-profile"
                                                                enctype="multipart/form-data">

                                                                @csrf
                                                                <?php $mest_services = DB::table('multiple_estimate_services')
                                                                    ->where('id', $value->mest_service_id)
                                                                    ->first();
                                                                ?>
                                                                <input type="file" name="images[]"
                                                                    class="form control"
                                                                    accept="image/png, image/gif, image/jpeg" multiple
                                                                    required />
                                                                <input type="hidden" name="booking_id"
                                                                    value="{{ $value->estimate_booking_id }}">
                                                                <input type="hidden" name="service_id"
                                                                    value="{{ $mest_services->service_id }}">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $value->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">upload
                                                                photos</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                      
                                        <!--End Of Magnific PopUp-->




                                    </div>

                                  


                                </div>

                                <div class="col-3">

                                  

                                  
  <div class="d-flex flex-row flex-wrap gallerys{{$value->id}}">


                                            @if ($value->attachment == null)
                                                <?php

                                                $t = DB::table('multiple_estimate_bidding_images')
                                                    ->where('mest_service_id', $mest_services->id)
                                                    ->get();

                                                ?>



                                                <?php $usr_data_att = DB::table('multiple_estimate')
                                                    ->where('booking_show_id', $value->estimate_booking_id)
                                                    ->first(); ?>

                                                @if ($usr_data_att->user_data_id != null)
                                                    <?php $usr_data_img = DB::table('user_data_images')
                                                        ->where('user_data_id', $usr_data_att->user_data_id)
                                                        ->get(); ?>


                                                    @foreach ($usr_data_img as $udi)
                                                        <?php $extension2 = pathinfo(url('public/User_data_uploads/' . $udi->image), PATHINFO_EXTENSION); ?>

                                                        @if ($extension2 == 'pdf')
                                                            <div class="photos">
                                                                <a href="{{ url('public/User_data_uploads/' . $udi->image) }}"
                                                                    target="_blank">
                                                                    <img style="width:100%; height:100%"
                                                                        class="img-thumbnail"
                                                                        src="{{ url('public/User_data_uploads/pdf.png') }}">
                                                                </a>

                                                            </div>
                                                        @else
                                                            <div class="photos">
                                                                <a href="{{ url('public/User_data_uploads/' . $udi->image) }}"
                                                                    target="_blank">
                                                                    <img style="width:100%; height:100%"
                                                                        class="img-thumbnail"
                                                                        src="{{ url('public/User_data_uploads/' . $udi->image) }}">
                                                                </a>

                                                            </div>
                                                            
                                                            
                                                        @endif



                                                        @if ($loop->last)
                                                            @foreach ($t as $if)
                                                                <?php $extension = pathinfo(url('public/multiple_bid_attachment/' . $if->image), PATHINFO_EXTENSION); ?>

                                                                @if ($extension == 'pdf')
                                                                    <div class="photos">
                                                                        <a href="{{ url('public/multiple_bid_attachment/' . $if->image) }}"
                                                                            target="_blank">
                                                                            <img style="width:100%; height:100%"
                                                                                class="img-thumbnail"
                                                                                src="{{ url('public/bid_attachment/pdf.png') }}">
                                                                        </a>

                                                                    </div>
                                                                @else
                                                                    <div class="photos">
                                                                        <a href="{{ url('public/multiple_bid_attachment/' . $if->image) }}"
                                                                            target="_blank">
                                                                            <img style="width:100%; height:100%"
                                                                                class="img-thumbnail"
                                                                                src="{{ url('public/multiple_bid_attachment/' . $if->image) }}">
                                                                        </a>

                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @if (count($t))
                                                        @foreach ($t as $if)
                                                            <?php $extension = pathinfo(url('public/multiple_bid_attachment/' . $if->image), PATHINFO_EXTENSION); ?>

                                                            @if ($extension == 'pdf')
                                                                <div class="photos">
                                                                    <a href="{{ url('public/multiple_bid_attachment/' . $if->image) }}"
                                                                        target="_blank">
                                                                        <img style="width:100%; height:100%"
                                                                            class="img-thumbnail"
                                                                            src="{{ url('public/bid_attachment/pdf.png') }}">
                                                                    </a>

                                                                </div>
                                                            @else
                                                                <div class="photos">
                                                                    <a href="{{ url('public/multiple_bid_attachment/' . $if->image) }}"
                                                                        target="_blank">
                                                                        <img style="width:100%; height:100%"
                                                                            class="img-thumbnail"
                                                                            src="{{ url('public/multiple_bid_attachment/' . $if->image) }}">
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
                                                <?php $usr_data_att = DB::table('multiple_estimate')
                                                    ->where('booking_show_id', $value->estimate_booking_id)
                                                    ->first(); ?>

                                                @if ($usr_data_att->user_data_id != null)
                                                    <?php $usr_data_img = DB::table('user_data_images')
                                                        ->where('user_data_id', $usr_data_att->user_data_id)
                                                        ->get(); ?>


                                                    @foreach ($usr_data_img as $udi)
                                                        <?php $extension2 = pathinfo(url('public/User_data_uploads/' . $udi->image), PATHINFO_EXTENSION); ?>

                                                        @if ($extension2 == 'pdf')
                                                            <a href="" target=" _blank"><img
                                                                    style="height:100px;width:100px;"></a>

                                                            <div class="photos">
                                                                <a href="{{ url('public/User_data_uploads/' . $udi->image) }}"
                                                                    target="_blank">
                                                                    <img style="width:100%; height:100%"
                                                                        class="img-thumbnail"
                                                                        src="{{ url('public/User_data_uploads/pdf.png') }}"
                                                                        target="_blank">
                                                                </a>

                                                            </div>
                                                        @else
                                                            <div class="photos">
                                                                <a href="{{ url('public/User_data_uploads/' . $udi->image) }}"
                                                                    target="_blank">
                                                                    <img style="width:100%; height:100%"
                                                                        class="img-thumbnail"
                                                                        src="{{ url('public/User_data_uploads/' . $udi->image) }}">
                                                                </a>

                                                            </div>
                                                            
                                                        @endif



                                                        @if ($loop->last)
                                                            <div class="photos">
                                                                <a href="{{ url('public/attachment/' . $value->attachment) }}"
                                                                    target="_blank">
                                                                    <img style="width:100%; height:100%"
                                                                        class="img-thumbnail"
                                                                        src="{{ url('public/attachment/' . $value->attachment) }}">
                                                                </a>

                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="photos">
                                                        <a href="{{ url('public/attachment/' . $value->attachment) }}"
                                                            target="_blank"><span class="fa-li"></span> <img
                                                                style="width:100%; height:100%" class="img-thumbnail"
                                                                src="{{ url('public/attachment/' . $value->attachment) }}"
                                                                alt=""></a>

                                                    </div>
                                                @endif
                                            @endif




                                        </div>
                                        
                                        
                                    
                                        
                                    <p class="text-primary px-2 my-2"style="font-weight:500"> Project photos</p>      
                                   
  <div class="col-6 mb-3"style="float:right">
                                        <div
                                            style="background-color:blue; color:white; padding:10px; text-align: center; border-radius: 10px; height:100%;margin-top:100px;">
                                            Project rate<br>
                                            ${{ $value->pro_amount }} + HST

                                        </div>

                                    </div>
                                </div>
                                
                            </div>
                        </div>


                        <div class="card-footer d-flex justify-content-between">
                            <div>
                                <button data-bs-toggle="modal" data-bs-target="#pro_notes{{ $value->id }}"
                                    class="btn btn-xs btn-success">
                                    Project Notes
                                </button>

                                <div class="modal fade" id="pro_notes{{ $value->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>

                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ url('pro/send-notes') }}" method="POST">
                                                    @csrf
                                                    <?php $mest_serv = DB::table('multiple_estimate_services')
                                                        ->where('id', $value->mest_service_id)
                                                        ->first(); ?>
                                                    <?php $serv_id = DB::table('services')
                                                        ->where('id', $mest_serv->service_id)
                                                        ->first(); ?>
                                                    <input type="hidden" name="service_id"
                                                        value="{{ $serv_id->id }}">
                                                    <input type="hidden" name="booking_id"
                                                        value="{{ $value->estimate_booking_id }}">
                                                    <div class="form-group">
                                                        <!--<label>Description</label>-->
                                                        <textarea type="text" name="notes" class="form-control" placeholder="Enter Description..."></textarea>
                                                    </div>
                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>

                                            </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>


                            <div>
                                <button data-bs-toggle="modal" data-bs-target="#msg_cust{{ $value->id }}"
                                    class="btn btn-xs btn-secondary">
                                    Message Customer
                                </button>

                                <div class="modal fade" id="msg_cust{{ $value->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLabel">Message To Customer
                                                </h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>

                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ url('pro/msg-customer') }}" method="POST">
                                                    @csrf
                                                    <?php $mest_serv = DB::table('multiple_estimate_services')
                                                        ->where('id', $value->mest_service_id)
                                                        ->first(); ?>
                                                    <?php $serv_id = DB::table('services')
                                                        ->where('id', $mest_serv->service_id)
                                                        ->first(); ?>
                                                    <input type="hidden" name="customer_id"
                                                        value="{{ $value->customer_id }}">
                                                    <input type="hidden" name="service_id"
                                                        value="{{ $serv_id->id }}">
                                                    <input type="hidden" name="booking_id"
                                                        value="{{ $value->estimate_booking_id }}">
                                                    <div class="form-group">
                                                        <!--<label>Description</label>-->
                                                        <textarea type="text" name="msg" class="form-control" placeholder="Write a Message..."></textarea>
                                                    </div>
                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>

                                            </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div> <a href="javascrpit:void(0);"class="btn btn-xs text-white "
                                    style="background:blue;">
                                    Customer support
                                </a></div>
                            <div>
                                @if($value->mark_complete=='0')
                                <a href="{{ url("pro/markComplete/$value->id") }}"
                                    class="btn  btn-danger text-white btn-xs mx-2">Mark as complete &nbsp;</a>
                                    @else
                  <a class="btn text-white float-end btn-xs mx-2" style="background-color:#7f8fa6">Completed &nbsp;</a>
                  @endif

                            </div>
                        </div>

                    </div>
                    
                @endforeach
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




