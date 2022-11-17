@extends('admin_jobick.layout.layout')
@section('content')
<div class="row page-titles">
    <ol class="breadcrumb">
    <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href=""> Booking Transactions</a></li>
    </ol>
</div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>User Name</th>
                                        <th>Booking ID</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trans as $key =>  $tran)
                                        <tr>
                                            <td class="table-text">
                                                <div>{{$loop->iteration}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>@if($tran->userDetails) {{$tran['userDetails']['name']}} @else NA @endif</div>
                                            </td>
                                            <td class="table-text">
                                                <div>@if($tran->bookingDetails){{$tran['bookingDetails']['booking_show_id']}} @else NA @endif</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$tran->transaction_id}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$tran->amount}}</div>
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