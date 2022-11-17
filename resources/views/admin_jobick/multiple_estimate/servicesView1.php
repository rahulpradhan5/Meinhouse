@extends('admin_jobick.layout.layout')
@section('head_title','Project >> Assign Professional')
@section('content')
<?php error_reporting(0);?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     

    <div class="row">
        @foreach ($ms_filter as $ms)
            
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <!-- form start -->
                    <div class="d-lg-flex d-md-flex d-sm-flex">
                    <div class="card-body" style="padding-right: 0px;">
    
    
                        <div class="row" >
    
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

                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#read_more{{ $ms->id }}"
                                                            href="javascript:;"
                                                            style="color:blue;text-decoration: none; font-size: 12px">Read
                                                            More</a>


                                                        <div class="modal fade" id="read_more{{ $ms->id }}"
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
                                                                        {{ ucfirst($ms->description) }}
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
                                    <div  class="col-sm-4" style="padding:0"><b>Job Title</b></div>
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
    $images=NULL;
    if ($m_est[0]->user_data_id) {
        $images= DB::table('user_data_images')->where('user_data_id',$m_est[0]->user_data_id)->pluck('image');

    }
    //dd($images);
    ?>
                            <div class="col">
    
                                <div class="btn">
                                    @if($images!=NULL)
                                    <img src="{{asset('public/User_data_uploads')}}/{{$images[0]}}"  data-bs-toggle="modal" data-bs-target="#exampleModal3" class=" cursor-pointer m-2 img-fluid rounded" width="200px" height="200px;"></div>
    @else
    <img src="https://www.ncenet.com/wp-content/uploads/2020/04/No-image-found.jpg"  class=" m-2 img-fluid rounded" width="100px" height="100px;"></div>
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
                                                              <a href="{{url('public/User_data_uploads/'.$img)}}" target="_blank"><img src="{{asset('public/User_data_uploads')}}/{{$img}}" style="height:100px;width:150px;"></a>
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

                       if ($check!=NULL) {
                        $data=DB::table('multiple_estimate_professionals')
                        ->where('mest_service_id', $ms->id)
                        ->where('status', 1)
                        ->first();
                        $prodetails = DB::table('users')->where('id',$data->pro_id)->first();
                       //dd($prodetails);
                        //$pro_id=explode(" ",$pro_id);
                       }
                    ?>
                    
                    <div class="card-footer">
                        <a href="{{url('admin/service/details/'.$ms->id)}}" class="btn btn-primary text-white float-left btn-xs">Details &nbsp;<i class="fas fa-arrow-right fa-xs"></i></a>
                        <span class="m-3">

							<a href="{{ url('admin/multiple-booking-invoice-view/' . $mst_id)}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye" aria-hidden="true"></i></a>
							<a href="{{ url('admin/multiple-estimate/service-edit/' . $mst_id.'/'.$ms->id) }}" class="btn btn-info btn-xs sharp"><i class="fas fa-edit "></i></a>
							
					    </span>
					    
					    <?php $check_req = DB::table('photo_requirement')->where('booking_id',$m_est[0]->booking_show_id)->where('service_id',$service[0]->id)->exists();?>
					    @if($check_req==NULL)
					    
					    <button data-bs-toggle="modal" data-bs-target="#exampleModal{{$ms->id}}" class="btn btn-danger text-white ms-2 btn-xs">Photo Requirements</button>
					    
					    @else
					    
					    <button data-bs-toggle="modal" data-bs-target="#exampleModal2{{$ms->id}}" class="btn btn-secondary text-white ms-2 btn-xs">View Requirements</button>
					    
					    <?php $get_req = DB::table('photo_requirement')->where('booking_id',$m_est[0]->booking_show_id)->where('service_id',$service[0]->id)->get();?>
					    <div class="modal fade" id="exampleModal2{{$ms->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Photo Requirements</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @foreach($get_req as $gr)
                                        <div class="form-group row mb-2">
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{$gr->requirement}}" disabled style="background-color: rgb(247, 247, 247)">
                
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="{{url("admin/delete-requirement/$gr->id")}}" class="btn btn-danger btn-xs mt-3 sharp"><i
                                                        class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                
                
                
                
                                    </div>
                                </div>
                                
                                
                                <form action="{{url('admin/photo_requirement_post')}}" method="post">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $m_est[0]->booking_show_id }}">
                    <input type="hidden" name="service_id" value="{{ $service[0]->id }}">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group row mb-2 increment{{$ms->id}}">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]" id="first_inp"  placeholder="Enter Detail " required>

                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-success btn-xs mt-3 sharp" id="add{{$ms->id}}" type="button"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="clone{{$ms->id}} hide" hidden>

                    <div class="hdtuto{{$ms->id}}">

                        <div class="form-group row mb-2">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]"  placeholder="Enter Detail">
                            </div>

                            <div class="col-sm-1">
                                <button class="btn btn-danger btn-xs sharp mt-3" id="remove{{$ms->id}}" type="button"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                
                            
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success btn-sm" id="show_btn">Submit</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      
                      
                      <script>
                          $("#show_btn").addClass('d-none');
                          
                          $('#first_inp').keyup(function(){

                            var check_string = jQuery.trim($('#first_inp').val());
                        
                            if (check_string.length < 1) {
                                $("#show_btn").addClass('d-none');
                            }
                            else{
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
                <form action="{{url('admin/photo_requirement_post')}}" method="post">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $m_est[0]->booking_show_id }}">
                    <input type="hidden" name="service_id" value="{{ $service[0]->id }}">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group row mb-2 increment{{$ms->id}}">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]"  placeholder="Enter Detail " required>

                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-success btn-xs mt-3 sharp" id="add{{$ms->id}}" type="button"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="clone{{$ms->id}} hide" hidden>

                    <div class="hdtuto{{$ms->id}}">

                        <div class="form-group row mb-2">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]"  placeholder="Enter Detail">
                            </div>

                            <div class="col-sm-1">
                                <button class="btn btn-danger btn-xs sharp mt-3" id="remove{{$ms->id}}" type="button"><i
                                        class="fas fa-minus"></i></button>
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
                                          var lsthmt1{{$ms->id}} = $(".clone{{$ms->id}}").html();
                                          $(".increment{{$ms->id}}").after(lsthmt1{{$ms->id}});
       });
                                      $("body").on("click", "#remove{{$ms->id}}", function() {
                                          $(this).parents(".hdtuto{{$ms->id}}").remove();
  
                                      });
                                  });
  </script>


                        @if ($check == null)
                        <a href="{{ url('admin/multiple-estimate-bid/' . $ms->id . '/' . $m_est[0]->booking_show_id) }}"
                            class="btn btn-success text-white float-end ms-3 btn-xs">Bid &nbsp;<i
                            class="fas fa-arrow-right fa-xs"></i></a>
                        <a href="{{ url('admin/assign-service/' . $ms->id . '/' . $m_est[0]->booking_show_id) }}"
                            class="btn btn-info text-white float-end btn-xs mx-2">Assign &nbsp;<i
                                class="fas fa-arrow-right fa-xs"></i></a>
                                <a href="{{url('admin/service-email-view/' . $ms->id . '/' . $m_est[0]->booking_show_id)}}"  class="btn btn-danger text-white float-end btn-xs">Create Link &nbsp;<i
                                    class="fas fa-arrow-right fa-xs"></i></a>
                        @else
                        
                        <a class="btn btn-secondary text-white float-end btn-xs" disabled>Assigned</a>
                        @endif
                        
                    </div>
                    
                </div>

                
                
                <!-- /.card -->
                
            </div>
            @if($check!=NULL)
            <div class="row">
     
             <div class="col-12">
         <div class="card card-info">
             <div class="card-header">
                 <b>Pro assigned</b>
               </div>
             <!-- form start -->
             <div class="card-body">
     
                 <div class="d-flex flex-lg-row flex-sm-column justify-content-between  flex-grow-0  mb-3">
                     <div class="align-self-start mr-auto">
     
                         <div class="d-flex flex-column ">
                                                         <img src="
                                                         @if($prodetails->user_image){{url('public/upload/pro_profile')}}/{{$prodetails->user_image}}@else {{url('assets/jobick/images/logo.png')}}@endif" class="rounded-circle img-thumbnail" style="width: 200px;">
     
                                                         <h5 class=" px-5 mt-1 pt-2"><strong>{{$prodetails->name}} <span class="badge bg-primary">4.5</span></strong></h5>
                                                         <a href="{{url('admin/view-professional')}}/{{$prodetails->id}}" class="mx-5 px-4 py-1 text-primary cursor-pointer">View profile </a>
     
                                                     
     
                         </div>
                         <br>
     
                     
                     </div>
                     <div>
                         <div class = "d-flex flex-row  mb-3 gallerys">
                             <?php $site_img = DB::table('pro_site_image')->where('booking_id',$m_est[0]->booking_show_id)->where('service_id',$ms->service_id)->get();?>
                             @if($site_img->count()>0)
                            @foreach($site_img as $simg)
                           
<a target="_blank"href="{{url('public/pro_site_images/'.$simg->image)}}"> <img src="{{url('public/pro_site_images/'.$simg->image)}}" class = "img-responsive rounded p-2" width="100px;" height="100px;">
</a>                                   
                            @endforeach
                            @else
                            
                              <b>No images found</b>
                            @endif
                         </div>
                         <br>
                         <b class="d-flex justify-content-center" >site photos</b>
                     </div>
                  <div> 
                     <div class="d-flex justify-content-center"><button data-bs-toggle="modal" data-bs-target="#msg_pro{{$ms->id}}" class="btn btn-success text-white btn-md mt-5">Message pro&nbsp;<i class="fa fa-comment"></i></button></div>
                     
                     
                     <div class="modal fade" id="msg_pro{{ $ms->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Message To Professional</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>

                                <div class="modal-body">
                                  <form action="{{ url('admin/msg-pro') }}" method="POST">
                                      @csrf
                                      <?php $mest_pro = DB::table('multiple_estimate_professionals')->where([['mest_service_id',$ms->id],['status','1'],['assign_status','1']])->first(); ?>
                                      <?php $serv_id = DB::table('services')->where('id',$ms->service_id)->first(); ?>
                                      <input type="hidden" name="pro_id" value="{{$mest_pro->pro_id}}">
                                      <input type="hidden" name="service_id" value="{{$serv_id->id}}">
                                      <input type="hidden" name="booking_id" value="{{$mest_pro->estimate_booking_id}}">
                                      <div class="form-group">
                                          <!--<label>Description</label>-->
                                          <textarea type="text" name="msg" class="form-control" placeholder="Write a Message..."></textarea>
                                      </div>
                                </div>

                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm">Send</button>

                                </div>

                                </form>

                            </div>

                        </div>

                    </div>
                     
                     
                  </div>
                 </div>
     
     
     
     
             </div>
     
                                 
             <div class="card-footer">
                 <a href="" class="btn btn-danger text-white float-left btn-xs ">Customer Support &nbsp;</a>&nbsp;&nbsp;
                 <button data-bs-toggle="modal" data-bs-target="#view_notes{{$data->id}}" class="btn btn-info text-white float-left btn-xs"><i class="fas fa-eye"></i> &nbsp;Project Notes</button>
                 
                 
                 <div class="modal fade" id="view_notes{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="exampleModalLabel">Project Notes</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>

                            <div class="modal-body">
                              <?php $pro_notes = DB::table('project_notes')->where('booking_id',$m_est[0]->booking_show_id)->where('service_id',$service[0]->id)->get();?>
                              @if(count($pro_notes))
                              @foreach($pro_notes as $note_key => $note_value)
                              
                              <p><b>{{ $note_key+1 }}.</b> {{ ucfirst($note_value->notes) }}</p>
                              
                              @endforeach
                              @else
                              <p>Not Found!</p>
                              @endif
                            </div>

                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>

                            </div>


                        </div>

                    </div>

                </div>
                 
                 
                 
                 
                  @if($data->mark_complete=='0')
                  <a href="{{url("admin/mark-complete/$data->id")}}" class="btn  text-white float-end btn-xs mx-2" style="background-color:blue">Mark as complete &nbsp;</a>
                  @else
                  <a class="btn text-white float-end btn-xs mx-2" style="background-color:#7f8fa6">Completed &nbsp;</a>
                  @endif
                        
                                         <a href=""
                     class="btn btn-primary text-white float-end ms-3 btn-xs">Progress Invoice  &nbsp;</a>
                
                                     </div>
             
         </div>
         </div></div>
         
     @endif       
                
        </div>
	
      
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
</script>
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
</script>


@endsection


















@extends('admin_jobick.layout.layout')
@section('head_title','Project >> Assign Professional')
@section('content')

     
     <?php $ms = DB::table('multiple_estimate_professionals')->where('status',1)->where('assign_status',1)->where('id',$id)->first();?>

    <div class="row">

        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <!-- form start -->
                    <div class="d-lg-flex d-md-flex d-sm-flex">
                    <div class="card-body" style="padding-right: 0px;">
    
    
                        <div class="row" >
    
                            <div class="col">
    
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Booking ID</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-4">
                                        <span class="">{{ $ms->estimate_booking_id }}</span>
                                    </div>
                                </div>
            
            
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Service Name</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-4">
                                    <span class="">
                                        <?php $est_detail = DB::table('multiple_estimate_services')->where('id',$ms->mest_service_id)->first();?>
                                        <?php $ser_name = DB::table('services')->where('id',$est_detail->service_id)->first();?>
                                        <?php $est_user = DB::table('multiple_estimate')->where('booking_show_id',$ms->estimate_booking_id)->first(); ?>
                                        {{ $ser_name->name }}
                                    </span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0;"><b>Project
                                            Description</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-4" style="padding-right:0">
                                    <span class="">{{ ucwords(substr($est_detail->description,0,25)) }}
                                    
                                    @if (strlen($est_detail->description) > 25)
                                                        ...

                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#read_more{{ $est_detail->id }}"
                                                            href="javascript:;"
                                                            style="color:blue;text-decoration: none; font-size: 12px">Read
                                                            More</a>


                                                        <div class="modal fade" id="read_more{{ $est_detail->id }}"
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
                                                                        {{ ucfirst($est_detail->description) }}
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
                                                    </span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Amount</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-3">
                                    <span class="">{{ ucwords($est_detail->amount) }}</span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-6" style="padding-right:0"><b>Registration Amount</b></div>
                                    <div class="col-sm-1"><b>:</b></div>
                                    <div class="col-sm-3">
                                    <span class="">{{ ucwords($est_detail->reg_amount) }}</span>
                                    </div>
            
                                </div>
                                
                            </div>
    
    
                            <div class="col ms-5">
    
                                <!-- Job Title -->
    
                                <div class="row mt-3 ">
                                    <div  class="col-sm-4" style="padding:0"><b>Job Title</b></div>
                                    <div class="col-sm-2"><b>:</b></div>
                                    <div class="col-sm-6">
                                        <span class="">{{ $est_user->title }}</span>
                                    </div>
            
                                </div>
    
                                <!-- Customer Name -->
    
                                <div class="row mt-3">
                                    <div class="col-sm-4" style="padding:0"><b>Customer Name</b></div>
                                    <div class="col-sm-2"><b>:</b></div>
                                    <div class="col-sm-6">
                                        <span class="">{{ $est_user->name }}</span>
                                    </div>
            
                                </div>
    
    
                                <!-- Customer Address -->
    
                                <div class="row mt-3">
                                    <div class="col-sm-4" style="padding:0"><b>Address</b></div>
                                    <div class="col-sm-2"><b>:</b></div>
                                    <div class="col-sm-6">
                                        <span class="">{{ $est_user->address }}</span>
                                    </div>
            
                                </div>
    
    
    
                            </div>
    <?php
    //dd($m_est[0]);
    $images=NULL;
    if ($est_user->user_data_id) {
        $images= DB::table('user_data_images')->where('user_data_id',$est_user->user_data_id)->pluck('image');

    }
    //dd($images);
    ?>
                            <div class="col">
    
                                <div class="btn">
                                    @if($images!=NULL)
                                    <img src="{{asset('public/User_data_uploads')}}/{{$images[0]}}"  data-bs-toggle="modal" data-bs-target="#exampleModal3" class=" cursor-pointer m-2 img-fluid rounded" width="200px" height="200px;"></div>
    @else
    <img src="https://www.ncenet.com/wp-content/uploads/2020/04/No-image-found.jpg"  class=" m-2 img-fluid rounded" width="100px" height="100px;"></div>
    @endif
                                </div>
                                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row">
                                                  @if($images!=NULL)
                                                  @foreach($images as $img)
                                                  <div class="col-lg-3">
                                                      <div class="card text-center">
                                                          <div class="card-body">
                                                              <a href="{{url('public/User_data_uploads/'.$img)}}" target="_blank"><img src="{{asset('public/User_data_uploads')}}/{{$img}}" style="height:100px;width:150px;"></a>
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
                        ->where('mest_service_id', $est_detail->id)
                        ->where('status', 1)
                        ->exists();

                       if ($check!=NULL) {
                        $data=DB::table('multiple_estimate_professionals')
                        ->where('mest_service_id', $est_detail->id)
                        ->where('status', 1)
                        ->first();
                        $prodetails = DB::table('users')->where('id',$data->pro_id)->first();
                       //dd($prodetails);
                        //$pro_id=explode(" ",$pro_id);
                       }
                    ?>
                    
                    <div class="card-footer">
                        
                            <?php $check_req = DB::table('photo_requirement')->where('booking_id', $ms->estimate_booking_id)->where('service_id',$ser_name->id)->exists();
                            $get_req = DB::table('photo_requirement')->where('booking_id', $ms->estimate_booking_id)->where('service_id',$ser_name->id)->get()
                            ?>
					    @if($check_req==NULL)
					    
					    <button data-bs-toggle="modal" data-bs-target="#exampleModal{{$ms->id}}" class="btn btn-danger text-white ms-2 btn-xs">Photo Requirements</button>
					    
					    @else
					    
					    <button data-bs-toggle="modal" data-bs-target="#exampleModal2{{$ms->id}}" class="btn btn-secondary text-white ms-2 btn-xs">View Requirements</button>
                        <!--a href="{{url('admin/service/details/'.$ms->id)}}" class="btn btn-primary text-white float-left btn-xs">Details &nbsp;<i class="fas fa-arrow-right fa-xs"></i></a--->
                        <span class="m-3">

							<!--a href="{{ url('admin/multiple-booking-invoice-view/' . $est_user->id)}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye" aria-hidden="true"></i></a---->
							<!--a href="{{ url('admin/multiple-estimate/service-edit/' . $est_user->id.'/'.$ms->mest_service_id) }}" class="btn btn-info btn-xs sharp"><i class="fas fa-edit "></i></a---->
						
					    </span>
@endif



   <div class="modal fade" id="exampleModal2{{$ms->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Photo Requirements</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @foreach($get_req as $gr)
                                        <div class="form-group row mb-2">
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{$gr->requirement}}" disabled style="background-color: rgb(247, 247, 247)">
                
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="{{url("admin/delete-requirement/$gr->id")}}" class="btn btn-danger btn-xs mt-3 sharp"><i
                                                        class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                
                
                
                
                                    </div>
                                </div>
                                
                                
                                <form action="{{url('admin/photo_requirement_post')}}" method="post">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $ms->estimate_booking_id }}">
                    <input type="hidden" name="service_id" value="{{$ser_name->id}}">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group row mb-2 increment{{$ms->id}}">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]" id="first_inp"  placeholder="Enter Detail " required>

                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-success btn-xs mt-3 sharp" id="add{{$ms->id}}" type="button"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="clone{{$ms->id}} hide" hidden>

                    <div class="hdtuto{{$ms->id}}">

                        <div class="form-group row mb-2">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]"  placeholder="Enter Detail">
                            </div>

                            <div class="col-sm-1">
                                <button class="btn btn-danger btn-xs sharp mt-3" id="remove{{$ms->id}}" type="button"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                
                            
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success btn-sm" id="show_btn">Submit</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      
                      
                      <script>
                          $("#show_btn").addClass('d-none');
                          
                          $('#first_inp').keyup(function(){

                            var check_string = jQuery.trim($('#first_inp').val());
                        
                            if (check_string.length < 1) {
                                $("#show_btn").addClass('d-none');
                            }
                            else{
                                $("#show_btn").removeClass('d-none');
                            }
                        
                        });
                      </script>
					    
					    
				
					    
					    
					    
					    
					    <div class="modal fade" id="exampleModal{{$ms->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Photo Requirements</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/photo_requirement_post')}}" method="post">
                    @csrf
                <input type="hidden" name="booking_id" value="{{ $ms->estimate_booking_id }}">
                    <input type="hidden" name="service_id" value="{{$ser_name->id}}">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group row mb-2 increment{{$ms->id}}">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]"  placeholder="Enter Detail " required>

                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-success btn-xs mt-3 sharp" id="add{{$ms->id}}" type="button"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="clone{{$ms->id}} hide" hidden>

                    <div class="hdtuto{{$ms->id}}">

                        <div class="form-group row mb-2">
                            <div class="col-sm-10">
                                <input type="text" class="form-control service" name="requirement[]"  placeholder="Enter Detail">
                            </div>

                            <div class="col-sm-1">
                                <button class="btn btn-danger btn-xs sharp mt-3" id="remove{{$ms->id}}" type="button"><i
                                        class="fas fa-minus"></i></button>
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
                                          var lsthmt1{{$ms->id}} = $(".clone{{$ms->id}}").html();
                                          $(".increment{{$ms->id}}").after(lsthmt1{{$ms->id}});
       });
                                      $("body").on("click", "#remove{{$ms->id}}", function() {
                                          $(this).parents(".hdtuto{{$ms->id}}").remove();
  
                                      });
                                  });
  </script>


                        @if ($check == null)
                        <a href="{{ url('admin/multiple-estimate-bid/' . $ms->id . '/' . $est_user->booking_show_id) }}"
                            class="btn btn-success text-white float-end ms-3 btn-xs">Bid &nbsp;<i
                            class="fas fa-arrow-right fa-xs"></i></a>
                        <a href="{{ url('admin/assign-service/' . $ms->id . '/' . $est_user->booking_show_id) }}"
                            class="btn btn-info text-white float-end btn-xs mx-2">Assign &nbsp;<i
                                class="fas fa-arrow-right fa-xs"></i></a>
                                <a href="{{url('admin/service-email-view/' . $ms->id . '/' . $est_user->booking_show_id)}}"  class="btn btn-danger text-white float-end btn-xs">Create Link &nbsp;<i
                                    class="fas fa-arrow-right fa-xs"></i></a>
                        @elseif($check != null)
                        <?php $site_photos = DB::table('multiple_estimate_professionals')->where('mest_service_id', $est_detail->id)->first();?>
                        @if ($site_photos->site_photo_status==NULL)

                        <span style="margin-inline:17%"><button class="btn text-white btn-xs ms-1 photo-req-btn" @if ($site_photos->site_img_no==NULL)
                            data-bs-toggle="modal" data-bs-target="#sitePhotos{{ $ms->id }}" style="background-color:#800000"
                        @else
                            disabled style="background-color:rgb(181, 181, 181);"
                        @endif><i class="fas fa-image"></i>&nbsp; Site Photos</button>
                        </span>

                        <div class="modal fade" id="sitePhotos{{ $ms->id }}" tabindex="-1" aria-labelledby="exampleModalLabelimg" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{ url('admin/siteImgNumber') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <h5>Number of Site Photos</h5>
                                                <div class="form-group">
                                                    <input type="text" class="form-control mt-2" name="site_img_no" placeholder="Enter No. of Photos" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;">
                                                    <input type="hidden" name="site_id" value="{{ $site_photos->id }}">
                                                </div>
                                            </div>
                                            <br>
                                            <a href="javascript:;" class="btn btn-danger btn-xs float-end" data-bs-dismiss="modal">Close</a>
                                            <button type="submit" class="btn btn-info btn-xs fload-end">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @else

                        <span style="margin-inline:17%"><button class="btn btn-info text-white btn-xs ms-1" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $ms->id }}"><i class="fas fa-image"></i>&nbsp; Site Photos</button>
                    </span>
                        <div class="modal fade" id="exampleModal2{{ $ms->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <?php $site_img = DB::table('pro_site_image')->where('booking_id',$est_user->booking_show_id)->where('service_id',$est_detail->service_id)->get();?>
                                            @foreach($site_img as $simg)
                                            <div class="col-lg-3">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <a href="{{url('public/pro_site_images/'.$simg->image)}}" target="_blank"><img src="{{url('public/pro_site_images/'.$simg->image)}}" style="height:100px;width:150px;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <br>
                                        <a href="javascript:;" class="btn btn-danger btn-xs float-end" data-bs-dismiss="modal">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endif
                        <a class="btn btn-secondary text-white float-end btn-xs" disabled>Assigned</a>
                        @endif
                    </div>
                    
                </div>

                
                
                <!-- /.card -->
                
            </div>
            @if($check!=NULL)
            <div class="row">
     
             <div class="col-12">
         <div class="card card-info">
             <div class="card-header">
                 <b>Pro Assigned</b>
               </div>
             <!-- form start -->
             <div class="card-body">
     
                 <div class="d-flex flex-lg-row flex-sm-column justify-content-between  flex-grow-0  mb-3">
                     <div class="align-self-start mr-auto">
     
                         <div class="d-flex flex-column ">
                                                         <img src="
                                                         @if($prodetails->user_image){{url('public/upload/pro_profile')}}/{{$prodetails->user_image}}@else {{url('assets/jobick/images/logo.png')}}@endif" class="rounded-circle img-thumbnail" style="width: 200px;">
     
                                                         <h5 class=" px-5 mt-1 pt-2"><strong>{{$prodetails->name}} <span class="badge bg-primary">4.5</span></strong></h5>
                                                         <a href="{{url('admin/view-professional')}}/{{$prodetails->id}}" class="mx-5 px-4 py-1 text-primary cursor-pointer">View profile </a>
     
                                                     
     
                         </div>
                         <br>
     
                     
                     </div>
                     <div>
                         <div class = "d-flex flex-row  mb-3 gallerys">
                             <?php $site_img = DB::table('pro_site_image')->where('booking_id',$est_user->booking_show_id)->where('service_id',$est_detail->service_id)->get();?>
                             @if($site_img->count()>0)
                            @foreach($site_img as $simg)
                            
                            <a  target=_blank" href="{{url('public/pro_site_images/'.$simg->image)}}">
                           
                                        <img src="{{url('public/pro_site_images/'.$simg->image)}}" class = "img-responsive rounded p-2" width="100px;" height="100px;">
                                        </a>
                                   
                            @endforeach
                            @else
     <b>No images found</b>
                            @endif
                         </div>
                         <br>
                         <b class="d-flex justify-content-center" >site photos</b>
                     </div>
                  <div> 
                     <div class="d-flex justify-content-center"><button data-bs-toggle="modal" data-bs-target="#msg_pro{{$ms->id}}" class="btn btn-success text-white btn-md mt-5">Message pro&nbsp;<i class="fa fa-comment"></i></button></div>
                     
                     
                     <div class="modal fade" id="msg_pro{{ $ms->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Message To Professional</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>

                                <div class="modal-body">
                                  <form action="{{ url('admin/msg-pro') }}" method="POST">
                                      @csrf
                                      <?php $mest_serv = DB::table('multiple_estimate_services')->where('id',$ms->mest_service_id)->first(); ?>
                                      <?php $serv_id = DB::table('services')->where('id',$mest_serv->service_id)->first(); ?>
                                      <input type="hidden" name="pro_id" value="{{$ms->pro_id}}">
                                      <input type="hidden" name="service_id" value="{{$serv_id->id}}">
                                      <input type="hidden" name="booking_id" value="{{$ms->estimate_booking_id}}">
                                      <div class="form-group">
                                          <!--<label>Description</label>-->
                                          <textarea type="text" name="msg" class="form-control" placeholder="Write a Message..."></textarea>
                                      </div>
                                </div>

                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm">Send</button>

                                </div>

                                </form>

                            </div>

                        </div>

                    </div>
                  </div>
                 </div>
     
     
     
     
             </div>
     
                                 
             <div class="card-footer">
                 <a href="" class="btn btn-danger text-white float-left btn-xs ">Customer Support &nbsp;</a>
                   <button data-bs-toggle="modal" data-bs-target="#view_notes{{$data->id}}" class="btn btn-info text-white float-left btn-xs"><i class="fas fa-eye"></i> &nbsp;Project Notes</button>
                 
                 
                 <div class="modal fade" id="view_notes{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="exampleModalLabel">Project Notes</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>

                            <div class="modal-body">
                                
                                <?php $mest_services  = DB::table('multiple_estimate_services')->where('id',$ms->mest_service_id)->first();?>
  
                             <?php $service = DB::table('services')->where('id',$mest_services->service_id)->get();  ?> 
                             
                              <?php $pro_notes = DB::table('project_notes')->where('booking_id',$ms->estimate_booking_id)->where('service_id', $service[0]->id)->get();?>
                              @if(count($pro_notes))
                              @foreach($pro_notes as $note_key => $note_value)
                              
                              <p><b>{{ $note_key+1 }}.</b> {{ ucfirst($note_value->notes) }}</p>
                              
                              @endforeach
                              @else
                              <p>No notes found!</p>
                              @endif
                            </div>

                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>

                            </div>


                        </div>

                    </div>

                </div>
                 
                   @if($ms->admin_mark_complete=='0')
                  <a href="{{url("admin/admin-mark-complete/$data->id")}}" class="btn  text-white float-end btn-xs mx-2" style="background-color:blue">Mark as complete &nbsp;</a>
                  @else
                  <a class="btn text-white float-end btn-xs mx-2" style="background-color:#7f8fa6">Completed &nbsp;</a>
                  @endif
                  
                    <?php
                    $mest=DB::table('multiple_estimate')->where('booking_show_id',$ms->estimate_booking_id)->first();
                    ?>
                    
                    @if($mest->payment_status==1)
                    					    <a href="{{url('admin/multiple-estimate-invoice-view/'.$mest->id.'/'.$mest->booking_show_id)}}" target="_blank" class="btn btn-primary text-white float-end ms-3 btn-xs">Progress Invoice </a>
                    					    @endif
                        
                                      
                                     </div>
             
         </div>
         </div></div>
         
     @endif       
                
        </div>
	
      
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
</script>


@endsection