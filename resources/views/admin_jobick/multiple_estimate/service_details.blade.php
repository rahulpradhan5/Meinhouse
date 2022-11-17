@extends('admin_jobick.layout.layout')
@section('head_title','Estimate >> Assign Professional >> Details')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Professional Details</h4>
                </div>
                <div class="card-body">

                    <?php $data = DB::table('multiple_estimate_professionals')->where('mest_service_id',$service_id)->get();?>
                    @foreach($data as $key=>$value)
                    <?php $pro_id = DB::table('users')->where('id',$value->pro_id)->first(); ?>

                    <div class="row">
                        <div class="col-sm-4 mt-1"><b>{{ucwords($pro_id->name)}}</b></div>
                        <div class="col-sm-2 mt-2"><b>:</b></div>
                        <div class="col-sm-6">
                            @if($value->status == 0)
                                <a href="{{url('admin/sales/mestconfirmStatus/'.$value->id)}}" class="btn btn-primary btn-xs">Confirm</a>
                            @elseif($value->status == 1)
                                <a href="{{url('admin/sales/mestrejectStatus/'.$value->id)}}" class="btn btn-danger btn-xs">Reject</a>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-4 mt-1"><b>Status</b></div>
                        <div class="col-sm-2 mt-2"><b>:</b></div>
                        <div class="col-sm-6">
                            @if($value->assign_status == 0)
                                <div class="btn btn-primary btn-xs"><a href="javascript:void(0);" style="text-decoration:none;color:white;">Pending</a></div>
                            @elseif($value->assign_status == 1)
                                <div class="btn btn-success btn-xs"><a href="javascript:void(0);" style="text-decoration:none;color:white;">Confirmed</a></div>
                            @elseif($value->assign_status == 2)
                                <div class="btn btn-danger btn-xs"><a href="javascript:void(0);" style="text-decoration:none;color:white;">Declined</a></div>
                            @endif
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bidding Details</h4>
                </div>
                <div class="card-body">

                    <?php
                        $bid_data = DB::table('multiple_estimates_bidding')->join('users', 'multiple_estimates_bidding.proff_id', "=", 'users.id')
                        ->where('multiple_estimates_bidding.mest_service_id', $service_id)
                        ->get(array('name','multiple_estimates_bidding.id',
                        'multiple_estimates_bidding.booking_id',
                        'multiple_estimates_bidding.proff_id',
                        'multiple_estimates_bidding.accept_status',
                        'multiple_estimates_bidding.assign_status',
                        'multiple_estimates_bidding.pro_amount',
                        'multiple_estimates_bidding.start_date',
                        'multiple_estimates_bidding.notes',
                        'multiple_estimates_bidding.bidding_amount',
                        'multiple_estimates_bidding.comment'
                        ));
                    ?>

                    <?php $check_pro = DB::table('multiple_estimate_professionals')->where('mest_service_id',$service_id)->first();?>
                    @foreach($bid_data as $key=>$value)

                    <div class="row">

                        <div class="col-sm-7">
                            <p class=""><b>Name : </b>{{ucwords($value->name)}}</p>
                            <p class=""><b>Start Date : </b>{{date('d.m.Y', strtotime($value->start_date))}}</p>
                            <p class=""><b>Amount : </b>{{$value->pro_amount}}</p>

                            <p class=""><b>Bidding Amount : </b>@if($value->bidding_amount!=NULL)<i class="fas fa-dollar-sign" ></i> {{$value->bidding_amount}}@else Not Found @endif</p>

                            @if($value->accept_status!=2 && $value->assign_status!=1 && $value->assign_status!=2 && $value->bidding_amount!=NULL && $value->comment!=NULL && $check_pro == null)
                            <a href="{{url('admin/reject-mest-bid-pro/'.$value->id)}}" class="btn btn-danger text-white float-left mr-3 btn-xs mt-3 mb-2">Reject</a>
                            <a href="{{url('admin/accept-mest-bid-pro/'.$value->id)}}" class="btn btn-success text-white float-left btn-xs mt-3 mb-2">Accept</a>
                            
                            @endif

                        </div>

                        <div class="col-sm-5">
                            <p class=""><b>Description : </b>{{$value->notes}}</p>
                            <p class="mt-1"><b>Status : </b>@if($value->accept_status==0) <span class="badge" style="background-color:rgba(255, 184, 31, 0.84);color:white;">Pending</span>
                            @elseif($value->accept_status==1) <span class="badge badge-success" style="background-color:#0abde3;color:white;">Submitted</span>
                            @elseif($value->accept_status==2 && $value->assign_status==1) <span class="badge badge-success" style="background-color:#00b894;color:white;">Accepted</span>
                            @elseif($value->accept_status==3) <span class="badge badge-danger" style="background-color:rgba(223, 26, 26, 0.84);color:white;">Rejected</span>@endif</p>
                            <p class=""><b>Comment : </b>@if($value->comment!=NULL) {{$value->comment}} @else There is no comment. @endif</p>

                        </div>

                    </div>
                    <hr>

                    @endforeach

                </div>
            </div>

        </div>
    </div>

@endsection
