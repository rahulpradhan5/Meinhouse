@extends('admin_jobick.layout.layout')
@section('head_title','User >> Detail View')
@section('content')
      
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row my-0 py-0">
                            <div class="col-12 col-sm-4 text-center my-auto">
                                <a href="#"><img
                                    src="@if($users->user_image){{url('public/uploads/users')}}/{{$users->user_image}}@else {{url('assets/jobick/images/logo.png')}}@endif"
                                    class="img-fluid ms-auto me-auto w-50 text-center" title="professional"></a>
                            </div>
                             <div class="col-12 col-sm-8 my-auto py-auto">
                                <div class="row mb-2">
                                    <div class="col-3">Name</div>
                                    <div class="col-1"><B>:</B></div>
                                    <div class="col-8">
                                        <span class="">{{$users->name}}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3 ">Email</div>
                                    <div class="col-1 "><B>:</B></div>
                                    <div class="col-8">
                                        <span class="">{{$users->email}}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">Phone</div>
                                    <div class="col-1"><B>:</B></div>
                                    <div class="col-8">
                                        <span class="">{{$users->phone}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            <!-- /.table-responsive -->
                        <!-- user previous bookings end-->

                    </div>
                    <!-- /.card-body -->
                    

                </div>
                <!-- /.card -->
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info border-transparent">
                        <h2 class="card-title " style="padding:0px">User Bookings</h2>
                    </div>
                                <!-- /.card-header -->
                    <div class=" card-body table-responsive">
                        <table id="example3" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Bookings ID</th>
                                    <th>Status</th>
                                    <th>Service</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @forelse($bookings as $key => $data)
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $data->booking_show_id}}</td>
                                    <td>@if($data->booking_status == 0)
                                        <div class="btn-highlight">
                                            Pending
                                        </div>
                                        @endif
                                        @if($data->booking_status == 1)
                                        <div class="btn-highlight1">
                                            Confirmed
                                        </div>
                                        @endif
                                        @if($data->booking_status == 2)
                                        <div class="btn-highlight2">
                                            Pro Cancelled
                                        </div>
                                        @endif
                                        @if($data->booking_status == 3)
                                        <div class="btn-highlight3">
                                            User Cancelled
                                        </div>
                                        @endif
                                        @if($data->booking_status == 4)
                                        <div class="btn-highlight3">
                                            Time Exceeds
                                        </div>
                                        @endif
                                        @if($data->booking_status == 5)
                                        <div class="btn-highlight5">
                                            Completed
                                        </div>
                                        @endif
                                        @if($data->booking_status == 6)
                                        <div class="btn-highlight6">
                                            Service Start
                                        </div>
                                        @endif
                                        @if($data->booking_status == 7)
                                        <div class="btn-highlight7">
                                            Payment Done
                                        </div>
                                        @endif
                                        @if($data->booking_status == 8)
                                        <div class="btn-highlight4">
                                            Admin Cancelled
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">{{
                                            $data['serviceDetails']['name']}}</div>
                                    </td>
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
            </div>
@endsection
