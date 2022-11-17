@extends('professional.layout.layout')
@section('head_title', 'ADMIN MESSAGES')
@section('content')
<?php error_reporting(0); ?>
<style type="text/css">
    .btn-highlight {
        text-align: center;
        background-color: #ffc107;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight1 {
        background-color: #07baff;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight2 {
        background-color: #0c4fca;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight3 {
        background-color: #961622;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight4 {
        background-color: #0f899c;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight5 {
        background-color: #0f8e36;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight6 {
        background-color: #ff5707;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight7 {
        background-color: #de3bac;
        text-align: center;
        padding: 3px 5px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

</style>



<div class="row" style="display: none;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Admin Messages</h4>
                <!--<a href="{{ url('admin/create-multiple-estimate') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create-->
                <!--    New</a>-->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Booking ID</th>
                                <th>Service</th>
                                <!--<th>Pro Name</th>-->
                                <!--<th>User Name</th>-->
                                <th>Message</th>

                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key=>$msg)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <?php $title = DB::table('multiple_estimate')->where('booking_show_id', $msg->booking_id)->pluck('title'); ?>
                                <td>{{ $title[0] }}
                                    @if($msg->is_new ==1)
                                    <sup class=" badge-xs badge badge-success">New</span>
                                        @endif
                                </td>
                                <?php
                                $service = DB::table('services')->where('id', $msg->service_id)->first();
                                ?>
                                <td>{{$service->name}}</td>



                                <td>

                                    {{ ucfirst(substr($msg->msg,0,20)) }}

                                    @if (strlen($msg->msg)>20)...

                                    <a data-bs-toggle="modal" data-bs-target="#read_more{{$msg->id}}" href="javascript:;" style="color:#136acd;text-decoration: none; font-size: 12px" class="text-primary">Read More</a>


                                    <div class="modal fade" id="read_more{{ $msg->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>

                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                </div>

                                                <div class="modal-body">
                                                    {{ ucfirst($msg->msg) }}
                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>

                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ url('pro/messages/delete') }}/{{ $msg->id }}" id="delete{{ $userDetails->id }}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>

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
    </div>
</div>
@endsection

@section('script')
<script>
    function sweetfunc(id) {
        var active = "delete";
        let result = active.concat(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    console.log(result)
                    document.getElementById(result).click();
                }
            });
    }
</script>
@endsection