@extends('professional.layout.layout')
@section('head_title','SITE PHOTOS')
@section('content')



    <div class="row">

        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">Site Photos</h3>

            </div>

            @if (count($errors) > 0)

                <div class="alert alert-danger">

                    <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- /.card-header -->

            <!-- form start -->



            <?php $services = DB::table('multiple_estimate_professionals')->where('pro_id',Auth::user()->id)->where('status',1)->where('assign_status',1)->where('site_notification_status','0')->orWhere('site_notification_status','1')->orderby('id','desc')->get();?>



            <div class="card-body row">



                <div class="table-responsive">

                    <table id="example3" class="display" style="width: 100%">

                        <thead>

                            <tr>

                                <th></th>

                                <th>Booking ID</th>

                                <th>Service Name</th>

                                <th>Site Photos</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($services as $key=>$sr)

                            <?php $est_detail = DB::table('multiple_estimate_services')->where('id',$sr->mest_service_id)->first();?>

                            <?php $ser_name = DB::table('services')->where('id',$est_detail->service_id)->first();?>

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $sr->estimate_booking_id }}</td>

                                    <td>{{ $ser_name->name }}</td>

                                    <td>

                                        @if($sr->site_photo_status==NULL)



                                        <button class="btn btn-xs sharp btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $sr->id }}"><i class="fas fa-plus"></i></button>



                                        @else



                                        <button class="btn btn-xs sharp btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $sr->id }}"><i class="fas fa-eye"></i></button>



                                        @endif

                                    </td>

                                </tr>



                                <div class="modal fade" id="exampleModal{{ $sr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLabel">Add Photos</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                            </div>

                                            <div class="modal-body">

                                                <form method="POST" action="{{ url('pro/site-images/post') }}" id="update-profile"

                                                    name="update-profile" enctype="multipart/form-data">

                                                    @csrf

                                                    <input type="file" name="images[]" class="form control" multiple required />

                                                    <input type="hidden" name="booking_id" value="{{ $sr->estimate_booking_id }}">

                                                    <input type="hidden" name="service_id" value="{{ $ser_name->id }}">

                                                    <input type="hidden" name="id" value="{{ $sr->id }}">



                                            </div>

                                            <div class="modal-footer">



                                                <button type="submit" class="btn btn-info" style="float:right;">Add</button>

                                            </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>



                                <div class="modal fade" id="exampleModal2{{ $sr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog modal-lg">

                                        <div class="modal-content">

                                            <div class="modal-body">

                                                <div class="row">

                                                    <?php $site_img = DB::table('pro_site_image')->where('booking_id',$sr->estimate_booking_id)->where('service_id',$ser_name->id)->where('pro_id',Auth::user()->id)->get();?>

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

