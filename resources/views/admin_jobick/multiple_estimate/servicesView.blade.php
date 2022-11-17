@extends('admin_jobick.layout.layout')
@section('head_title','Project >> Assign Professional')
@section('content')
<?php error_reporting(0); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<div class="row">
    @foreach ($ms_filter as $ms)
 <?php $check = DB::table('multiple_estimate_professionals')
                ->where('mest_service_id', $ms->id)
                ->where('status', 1)
                //->where('assign_status',1)
                  ->exists();?>
                
                @if(!$check)
                <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <!-- form start -->
                <div class="d-lg-flex d-md-flex d-sm-flex">
                    <div class="card-body" style="padding-right: 0px;">


                        <div class="row">

                            <div class="col">

                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Booking ID</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-4">
                                        <span class="">{{ $m_est[0]->booking_show_id }}</span>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Service Name</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-4">
                                        <span class=""><?php $service = DB::table('services')
                                                            ->where('id', $ms->service_id)
                                                            ->get();
                                                        echo $service[0]->name; ?></span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0;"><b>Project
                                            Description</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-4" style="padding-right:0">
                                        <span class="">{{ ucwords(substr($ms->description,0,25)) }}
                                            @if (strlen($ms->description) > 25)
                                            ...

                                            <a data-bs-toggle="modal" data-bs-target="#read_more{{ $ms->id }}" href="javascript:;" style="color:blue;text-decoration: none; font-size: 12px">Read
                                                More</a>


                                            <div class="modal fade" id="read_more{{ $ms->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Project Description</h5>

                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                        </div>

                                                        <div class="modal-body">
                                                            {{ ucfirst($ms->description) }}
                                                        </div>

                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>

                                                        </div>


                                                    </div>

                                                </div>

                                            </div>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Amount</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-3">
                                        <span class="">{{ ucwords($ms->amount) }}</span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Registration Amount</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-3">
                                        <span class="">{{ ucwords($ms->reg_amount) }}</span>
                                    </div>

                                </div>

                            </div>


                            <div class="col ms-5">

                                <!-- Job Title -->

                                <div class="row mt-3 ">
                                    <div class="col-sm-4" style="padding:0"><b>Job Title</b></div>
                                    <div class="col-sm-2"><b>:</b></div>
                                    <div class="col-sm-6">
                                        <span class="">{{ $m_est[0]->title }}</span>
                                    </div>

                                </div>

                                <!-- Customer Name -->

                                <div class="row mt-3">
                                    <div class="col-sm-4" style="padding:0"><b>Customer Name</b></div>
                                    <div class="col-sm-2"><b>:</b></div>
                                    <div class="col-sm-6">
                                        <span class="">{{ $m_est[0]->name }}</span>
                                    </div>

                                </div>


                                <!-- Customer Address -->

                                <div class="row mt-3">
                                    <div class="col-sm-4" style="padding:0"><b>Address</b></div>
                                    <div class="col-sm-2"><b>:</b></div>
                                    <div class="col-sm-6">
                                        <span class="">{{ $m_est[0]->address }}</span>
                                    </div>

                                </div>



                            </div>
                            <?php
                            //dd($m_est[0]);
                            $images = NULL;
                            if ($m_est[0]->user_data_id) {
                                $images = DB::table('user_data_images')->where('user_data_id', $m_est[0]->user_data_id)->pluck('image');
                            }
                            //dd($images);
                            ?>
                            <div class="col">

                                <div class="btn">
                                    @if($images!=NULL)

                                    <img src="{{ URL('public/User_data_uploads') }}/{{$images[0]}}" class=" cursor-pointer m-2 img-fluid rounded" onclick="magni()" width="200px" height="200px;">
                                    <div class="newgalary" style="display: none;">
                                        @foreach($images as $image)
                                        <?php
                                        $i = 1;
                                        ?>
                                        <a id="new<?php echo $i; ?>" href="{{ URL('public/User_data_uploads') }}/{{$image}}"> <img src="{{ URL('public/pro_site_images/'.$simg->image) }}" class="img-responsive rounded p-2" width="100px;" height="100px;">
                                        </a>
                                        <?php
                                        $i = $i + 1;
                                        ?>
                                        <!-- <img src="{{ URL('public/User_data_uploads') }}/{{$image}}" data-bs-toggle="modal" data-bs-target="#exampleModal3" class=" cursor-pointer m-2 img-fluid rounded"  width="200px" height="200px;"> -->
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                <img src="https://www.ncenet.com/wp-content/uploads/2020/04/No-image-found.jpg" class=" m-2 img-fluid rounded" width="100px" height="100px;">
                            </div>
                            @endif
                        </div>
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row gallerys_site">
                                            @if($images!=NULL)
                                            @foreach($images as $img)
                                            <div class="col-lg-3">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <a href="{{ URL('public/User_data_uploads/'.$img) }}" target="_blank"><img src="{{ URL('public/User_data_uploads') }}/{{$img}}" style="height:100px;width:150px;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <br>
                                        <a href="javascript:;" class="btn btn-danger btn-xs float-end" data-bs-dismiss="modal">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $check = DB::table('multiple_estimate_professionals')
                ->where('mest_service_id', $ms->id)
                ->where('status', 1)
                ->exists();
            if ($check != NULL) {
                $data = DB::table('multiple_estimate_professionals')
                    ->where('mest_service_id', $ms->id)
                    ->where('status', 1)
                    ->first();
                $prodetails = DB::table('users')->where('id', $data->pro_id)->first();
                //dd($prodetails);
                //$pro_id=explode(" ",$pro_id);
            }
            ?>
            <div class="card-footer">
                <!-- <a href="{{ url('public/admin/service/details/'.$ms->id) }}" class="btn btn-primary text-white float-left btn-xs">Details &nbsp;<i class="fas fa-arrow-right fa-xs"></i></a>
                <span class="m-3">
                    <a href="{{ url('public/admin/multiple-booking-invoice-view/' . $mst_id)}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="{{ url('public/admin/multiple-estimate/service-edit/' . $mst_id.'/'.$ms->id) }}" class="btn btn-info btn-xs sharp"><i class="fas fa-edit "></i></a>
                </span> -->
                <?php $check_req = DB::table('photo_requirement')->where('booking_id', $m_est[0]->booking_show_id)->where('service_id', $service[0]->id)->exists(); ?>
                @if($check_req==NULL)
                <button data-bs-toggle="modal" data-bs-target="#exampleModal{{$ms->id}}" class="btn btn-danger text-white ms-2 btn-xs">Photo Requirements</button>
                @else
                <button data-bs-toggle="modal" data-bs-target="#exampleModal2{{$ms->id}}" class="btn btn-secondary text-white ms-2 btn-xs">View Requirements</button>
                <?php $get_req = DB::table('photo_requirement')->where('booking_id', $m_est[0]->booking_show_id)->where('service_id', $service[0]->id)->get(); ?>
                <div class="modal fade" id="exampleModal2{{$ms->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Photo Requirements</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12" id="requireDetails{{$ms->service_id}}">
                                        @foreach($get_req as $gr)
                                        <div class="form-group row mb-2" id="inp{{$gr->id}}">
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{$gr->requirement}}" disabled style="background-color: rgb(247, 247, 247)">

                                            </div>
                                            <div class="col-sm-1">
                                                <!-- href="{{url("admin/delete-requirement/$gr->id")}}" -->
                                                <a class="btn btn-danger btn-xs mt-3 sharp" onclick="deleteDetails(id='<?php echo $gr->id; ?>',service_id='{{$ms->service_id}}')"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                                        <input type="hidden" id="datacount" value="<?php echo count($get_req); ?>">



                                    </div>
                                </div>


                                <form action="{{url('admin/photo_requirement_post')}}" method="post">
                                    @csrf
                                    <input type="hidden" id="book" name="booking_id" value="{{ $m_est[0]->booking_show_id }}">
                                    <input type="hidden" id="serv" name="service_id" value="{{$ms->service_id}}">
                                    <input type="hidden" id="main_id" name="main_id" value="{{$ms->estimate_id}}">

                                    <div class="row" id="savereq_input{{$ms->service_id}}" <?php if (count($get_req) >= '5') { ?>style="display: none;" <?php  } ?>>
                                        <div class="col-sm-12">

                                            <div class="form-group row mb-2 increment{{$ms->id}}">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control service" name="requirement[]" id="first_inp{{$gr->id}}" placeholder="Enter Detail " required>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-success btn-xs mt-3 sharp" id="savebtndetails" onclick="saveRequireDetails(input='first_inp{{$gr->id}}',service_id='{{$ms->service_id}}')" type="button"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clone{{$ms->id}} hide" hidden>

                                        <div class="hdtuto{{$ms->id}}">

                                            <div class="form-group row mb-2">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control service" name="requirement[]" placeholder="Enter Detail">
                                                </div>

                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger btn-xs sharp mt-3" id="remove{{$ms->id}}" type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                <!-- <button type="submit" class="btn btn-success btn-sm" id="show_btn">Submit</button> -->
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    $("#show_btn").addClass('d-none');
                    $('#first_inp').keyup(function() {
                        var check_string = jQuery.trim($('#first_inp').val());
                        if (check_string.length < 1) {
                            $("#show_btn").addClass('d-none');
                        } else {
                            $("#show_btn").removeClass('d-none');
                        }
                    });
                </script>
                @endif
                <div class="modal fade" id="exampleModal{{$ms->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Photo Requirements</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('admin/photo_requirement_post')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $m_est[0]->booking_show_id }}">
                                    <input type="hidden" name="service_id" value="{{ $service[0]->id }}">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row mb-2 increment{{$ms->id}}">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control service" name="requirement[]" placeholder="Enter Detail " required>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-success btn-xs mt-3 sharp" id="add{{$ms->id}}" type="button"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clone{{$ms->id}} hide" hidden>
                                        <div class="hdtuto{{$ms->id}}">
                                            <div class="form-group row mb-2">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control service" name="requirement[]" placeholder="Enter Detail">
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger btn-xs sharp mt-3" id="remove{{$ms->id}}" type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    $(document).ready(function() {
                        $("#add{{$ms->id}}").click(function() {
                            //console.log('hi');
                            var lsthmt1 {
                                {
                                    $ms - > id
                                }
                            } = $(".clone{{$ms->id}}").html();
                            $(".increment{{$ms->id}}").after(lsthmt1 {
                                {
                                    $ms - > id
                                }
                            });
                        });
                        $("body").on("click", "#remove{{$ms->id}}", function() {
                            $(this).parents(".hdtuto{{$ms->id}}").remove();
                        });
                    });
                </script>
                @if ($check == null)
                <a href="{{ url('admin/multiple-estimate-bid/' . $ms->id . '/' . $m_est[0]->booking_show_id) }}" class="btn btn-success text-white float-end ms-3 btn-xs">Bid &nbsp;<i class="fas fa-arrow-right fa-xs"></i></a>
                <a href="{{ url('admin/assign-service/' . $ms->id . '/' . $m_est[0]->booking_show_id) }}" class="btn btn-info text-white float-end btn-xs mx-2">Assign &nbsp;<i class="fas fa-arrow-right fa-xs"></i></a>
                <a href="{{url('admin/service-email-view/' . $ms->id . '/' . $m_est[0]->booking_show_id)}}" class="btn btn-danger text-white float-end btn-xs">Create Link &nbsp;<i class="fas fa-arrow-right fa-xs"></i></a>
                @else
                <a class="btn btn-secondary text-white float-end btn-xs" disabled>Assigned</a>
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>
    
</div>


                @endif
    
@endforeach
</div>


@endsection

@section('script')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js" integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.gallerys').magnificPopup({
            type: 'image',
            delegate: 'a',
            gallery: {
                enabled: true
            }
        });
    });
    $(document).ready(function() {
        $('.newgalary').magnificPopup({
            type: 'image',
            delegate: 'a',
            gallery: {
                enabled: true
            }
        });
    });
    var magni = () => {
        $('#new1').click();
    }

    function showRequirephotos() {
        console.log(document.getElementById("numberofphotos456").value)
        var max = 5;
        var require = document.getElementById("numberofphotos456");
        if (require.value > max) {
            require.value = max;
            document.getElementById("maxerror").style.display = "";
        } else if (document.getElementById("numberofphotos456").value < max) {
            document.getElementById("maxerror").style.display = "none";
        }
        if (require.value == 0) {
            document.getElementById("photodetailsdiv").style.display = "none";
            document.getElementById("photodetail1").style.display = "none";
            $("#site_img_details1").removeAttr("required");
            document.getElementById("photodetail2").style.display = "none";
            $("#site_img_details2").removeAttr("required");
            document.getElementById("photodetail3").style.display = "none";
            $("#site_img_details3").removeAttr("required");
            document.getElementById("photodetail4").style.display = "none";
            $("#site_img_details4").removeAttr("required");
            document.getElementById("photodetail5").style.display = "none";
            $("#site_img_details5").removeAttr("required");
        }
        if (require.value == 1) {
            document.getElementById("photodetailsdiv").style.display = "";
            document.getElementById("photodetail1").style.display = "";
            $("#site_img_details1").attr("required", "required");
            document.getElementById("photodetail2").style.display = "none";
            $("#site_img_details2").removeAttr("required");
            document.getElementById("photodetail3").style.display = "none";
            $("#site_img_details3").removeAttr("required");
            document.getElementById("photodetail4").style.display = "none";
            $("#site_img_details4").removeAttr("required");
            document.getElementById("photodetail5").style.display = "none";
            $("#site_img_details5").removeAttr("required");
        }
        if (require.value == 2) {
            document.getElementById("photodetailsdiv").style.display = "";
            document.getElementById("photodetail1").style.display = "";
            $("#site_img_details1").attr("required", "required");
            document.getElementById("photodetail2").style.display = "";
            $("#site_img_details2").attr("required", "required");
            document.getElementById("photodetail3").style.display = "none";
            $("#site_img_details3").removeAttr("required");
            document.getElementById("photodetail4").style.display = "none";
            $("#site_img_details4").removeAttr("required");
            document.getElementById("photodetail5").style.display = "none";
            $("#site_img_details5").removeAttr("required");
        }
        if (require.value == 3) {
            document.getElementById("photodetailsdiv").style.display = "";
            document.getElementById("photodetail1").style.display = "";
            $("#site_img_details1").attr("required", "required");
            document.getElementById("photodetail2").style.display = "";
            $("#site_img_details2").attr("required", "required");
            document.getElementById("photodetail3").style.display = "";
            $("#site_img_details3").attr("required", "required");
            document.getElementById("photodetail4").style.display = "none";
            $("#site_img_details4").removeAttr("required");
            document.getElementById("photodetail5").style.display = "none";
            $("#site_img_details5").removeAttr("required");
        }
        if (require.value == 4) {
            document.getElementById("photodetailsdiv").style.display = "";
            document.getElementById("photodetail1").style.display = "";
            $("#site_img_details1").attr("required", "required");
            document.getElementById("photodetail2").style.display = "";
            $("#site_img_details2").attr("required", "required");
            document.getElementById("photodetail3").style.display = "";
            $("#site_img_details3").attr("required", "required");
            document.getElementById("photodetail4").style.display = "";
            $("#site_img_details4").attr("required", "required");
            document.getElementById("photodetail5").style.display = "none";
            $("#site_img_details5").removeAttr("required");
        }
        if (require.value == 5) {
            document.getElementById("photodetailsdiv").style.display = "";
            document.getElementById("photodetail1").style.display = "";
            $("#site_img_details1").attr("required", "required");
            document.getElementById("photodetail2").style.display = "";
            $("#site_img_details2").attr("required", "required");
            document.getElementById("photodetail3").style.display = "";
            $("#site_img_details3").attr("required", "required");
            document.getElementById("photodetail4").style.display = "";
            $("#site_img_details4").attr("required", "required");
            document.getElementById("photodetail5").style.display = "";
            $("#site_img_details5").attr("required", "required");
        }

    }
    var service_id;
    var booking_id;
    var id;
    function fetchData(service_id, booking_id) {
        var ser = service_id;
        var book = booking_id;
        $.ajax({
            url:"{{route('fetchData')}}",
            data:{
                main_id:'<?php echo $id;?>',
                service_id:ser,
                booking_id:book
            },
            type:'get',
            beforeSend:function(){
                console.log('wait....')
            },
            success:function(data){
                console.log(data);
                document.getElementById("requireDetails"+ser).innerHTML = data;
            }
        })
    }
var input ;
var service_id;
    function saveRequireDetails(input,service_id) {
        var inp = $("#"+input).val();
        var booking_id = $("#book").val();
        var service_id = service_id;
        console.log(inp);
        console.log(booking_id);
        console.log(service_id);
        if (inp != "") {
            $.ajax({
                url: "{{route('photo_requirement_get')}}",
                data: {
                    input: inp,
                    booking_id: booking_id,
                    service_id: service_id,
                    main_id: '<?php echo $id; ?>'
                },
                type: 'get',
                beforeSend: function() {
                    document.getElementById(input).value = "";
                    console.log("wait....");
                    document.getElementById("savebtndetails").setAttribute("disabled", true)
                },
                success: function(data) {
                    $("#savebtndetails").attr("disabled", false);
                    if (data[0].length < 5) {
                        $("#savereq_input"+service_id).css("display", "");
                    } else {
                        $("#savereq_input"+service_id).css("display", "none");
                    }
                    fetchData(service_id = data[1], booking_id = booking_id);
                    
                }
            });
        }
    }



    var id;


    function deleteDetails(id,service_id) {
        var ser = service_id;
        var delid = id;
        console.log(ser)
        $.ajax({
            url: "{{route('delete-requirement')}}",
            data: {
                id: delid,
                main_id: '<?php echo $ms->estimate_id; ?>'
            },
            type: 'get',
            success: function(data) {
                console.log(data);
                if (data != '') {
                    document.getElementById("inp" + delid).remove();
                }
                if (data[0].length < 5) {
                    $("#savereq_input"+ser).css("display", "");
                } else {
                    $("#savereq_input"+ser).css("display", "none");
                }
            }
        })
    }
</script>


@endsection