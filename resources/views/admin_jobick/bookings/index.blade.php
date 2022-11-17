@extends('admin_jobick.layout.layout')
@section('head_title','Bookings')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bookings Management</h4>
                        <a href="{{url('admin/CustomBookings')}}" class="btn btn-warning btn-sm sharp" style="float:right;margin-right: 10px;"><i class="fas fa-list"></i>&nbsp; Custom Bookings</a>                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>	 	 	 	
                                        <th>Booking Id</th>
                                        <th>User Name</th>
                                        <th>Pro Assigned </th>
                                        <th>Service Name</th>
                                        <th>Email</th>
                                        <th>Booking Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                     @foreach($bookings as $data)
                     <tr>
                      <td>{{$loop->iteration}}</td>
                      <td style="color: #0d9bef;">{{ $data->booking_show_id}}</td>
                      <td>{{ $data->name }}</td>
                      <td>@if($data->proDetails) {{$data->proDetails->name}} @else NA @endif</td>
                      <td>@if($data->serviceDetails) {{$data->serviceDetails->name}} @else NA @endif</td>
                      <td>@if($data->userDetails) {{$data->userDetails->email}} @else NA @endif</td>
                      <td>
                        @if($data->booking_status == 0)
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
                        <a href="{{url('admin/view-booking')}}/{{$data->id}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                   @endforeach
                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection