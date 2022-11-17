

@extends('admin_jobick.layout.layout')
@section('head_title','Custom Bookings')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Custom Bookings </h4>
                        <a href="{{url('admin/create-custom-booking')}}" class="btn btn-warning btn-sm sharp" style="float:right;margin-right: 10px;"><i class="fas fa-plus"></i>&nbsp; Create New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Booking Id</th>
                                        <th>User Name</th>
                                 
                                        <th>Service Name</th>
                                        <th>Email</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                     @foreach($bookings as $data)
                     <tr>
                      <td>{{$loop->iteration}}</td>
                      <td style="color: #0d9bef;">{{ $data->booking_show_id}}</td>
                      <td>{{ $data->name }}</td>

                     
                      <?php

                      $services=$data->service_id;
                      $arr=explode(',', $services);

                      $services=[];
                      for ($i=0; $i <count($arr) ; $i++) {

                        $int = (int)$arr[$i];
                        $service= DB::table('services')->where('id',$int)->pluck('name')->toArray();


                        array_push($services,implode("",$service));
                      }
                        ?>


                        <td>
                         @if(count($services))
                         {{implode(",",$services)}}
                         @else
                         NA
                         @endif

                        </td>







                      <td>@if($data->userDetails) {{$data->userDetails->email}} @else NA @endif</td>


                      <td>
                        <a href="{{url('admin/view-Custombooking')}}/{{$data->id}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
