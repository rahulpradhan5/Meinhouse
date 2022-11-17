@extends('admin_jobick.layout.layout')
@section('head_title','Project >> Multiple Invoice')
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


    
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Invoices</h4>
                    <a href="{{ url('admin/create-multiple-estimate-invoice/'.$data[0]->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create
                        New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Booking Id</th>
                                    <!--<th>Registration Amount</th>-->
                                    <th>Total Amount</th>
                                    <th>Invoice Amount</th>
                                    <th>Payment Status</th>
                                    <th>Date of Creation</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse($inv as $key=>$i)
                                
                                    <?php 
                                    
                                    $amount_total = DB::table('multiple_estimate_invoices_details')->where('invoice_id',$i->id)->sum('total_amount');
                                    $invoice_total = DB::table('multiple_estimate_invoices_details')->where('invoice_id',$i->id)->sum('invoice_amount');
                                    
                                    ?>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $i->booking_id }}</td>
                                        <!--<td><b>$</b> {{ $i->reg_amount }}</td>-->
                                        <td><b class="text-secondary">$</b>{{ number_format($amount_total,2) }}</td>
                                        <td><b class="text-secondary">$</b>{{ number_format($invoice_total,2) }}</td>
                                        <td>
                                            @if($i->payment_status==0)
                                            <span class="badge" style="background-color:#f39c12;color:white;">pending</span>
                                            @elseif($i->payment_status==1)
                                            <span class="badge" style="background-color:#2ecc71;color:white;">completed</span>
                                            @endif
                                        </td>
                                        <td>{{ $i->created_at }}</td>
                                    </tr>
                                @empty
                                    <!--<tr>-->
                                    <!--    <td class="text-center">No data found !!</td>-->
                                    <!--</tr>-->
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