@extends('admin_jobick.layout.layout')
@section('head_title','Project History')
@section('content')

    <div class="row">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Project History</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <?php $services = DB::select('select * from multiple_estimate_professionals where status = 1 and assign_status = 1 and admin_mark_complete = 1 order by id desc');?>

            <div class="card-body row">

                <div class="table-responsive">
                    <table id="example3" class="display" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>User Name</th>
                                 <th>Address</th>
                                <th>Service Name</th>
                             <!---th>site photos</th--->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $key=>$sr)
                            <?php $est_detail = DB::table('multiple_estimate_services')->where('id',$sr->mest_service_id)->first();?>
                            <?php $ser_name = DB::table('services')->where('id',$est_detail->service_id)->first();?>
                                <tr>
                                    <?php $est_user = DB::table('multiple_estimate')->where('booking_show_id',$sr->estimate_booking_id)->first();?>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><?php echo $est_user->title;?></td>
                                    <td><?php echo $est_user->name;?></td>
                                    
                                      <?php
                                        $array = explode(',',  $est_user->address);
                                        $str=implode(' ,',$array);
                                        ?>
                                        <td>{{ $str}}</td>
                                    
                                    
                                    <td>{{ $ser_name->name }}</td>
                                    <!---td>
                                        @if($sr->site_photo_status==NULL)

                                        <button class="btn text-white btn-xs ms-1" @if ($sr->site_img_no==NULL)
                                            data-bs-toggle="modal" data-bs-target="#sitePhotos{{ $sr->id }}" style="background-color:rgb(181, 181, 181)"
                                        @else
                                            disabled style="background-color:rgb(181, 181, 181);"
                                        @endif><i class="fas fa-image"></i>&nbsp; Site Photos</button>
                                        
                                        <div class="modal fade" id="sitePhotos{{ $sr->id }}" tabindex="-1" aria-labelledby="exampleModalLabelimg" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form action="{{ url('admin/siteImgNumber') }}" method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <h5>Number of Site Photos</h5>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control mt-2" name="site_img_no" placeholder="Enter No. of Photos" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;">
                                                                    <input type="hidden" name="site_id" value="{{ $sr->id }}">
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

                                        <button class="btn btn-info text-white btn-xs ms-1" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $sr->id }}"><i class="fas fa-image"></i>&nbsp; Site Photos</button>

                                        <div class="modal fade" id="exampleModal2{{ $sr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <?php $site_img = DB::table('pro_site_image')->where('service_id',$ser_name->id)->where('booking_id',$sr->estimate_booking_id)->get();?>
                                                            @foreach($site_img as $simg)
                                                            <div class="col-lg-3">
                                                                <div class="card text-center shadow-none">
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
                                    </td---->
                                
                                    <td class="d-flex">
                                        <a href="{{ url('admin/service-details/' . $sr->id) }}"
                                        class="btn btn-danger btn-xs sharp me-2  mt-3"><i class="fa fa-eye"
                                            aria-hidden="true"></i> </a>
                                        
                                         
                                       
                                        
                                    </td>
                                    <!---td> @if($sr->site_photo_status!=NULL)
                                        
                                        @if($sr->img_app_status=='0')
                                        <a href="{{ url("admin/update-img-approval/$sr->id") }}" class="btn btn-success btn-xs">Approve</a>
                                        @elseif($sr->img_app_status=='1')
                                        <a href="{{ url("admin/update-img-approval/$sr->id") }}" class="btn btn-danger btn-xs">Disapprove</a>
                                        @endif
                                        @endif</td-->
                                </tr>

                            

                                
                            @empty
                                <tr>
                                    <td>No data found !!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- </form>-->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
@endsection
