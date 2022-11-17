@extends('admin_jobick.layout.layout')
@section('head_title','Estimates')

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
                    <h4 class="card-title">Estimate Management</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Project Title</th>
                                    <th>User Name</th>
                                    <th>Address</th>
                                    <th>Project Price</th>
                                    <th>Registration Amount</th>
                                    <th>Phone</th>
                                   
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mult_est as $key=>$userDetails)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        
                                        <td>{{ $userDetails->title }}</td>
                                        <td>{{ $userDetails->name }}</td>
                                        <?php
                                        $array = explode(',',  $userDetails->address);
                                        $str=implode(' ,',$array);
                                        ?>
                                        <td>{{ $str}}</td>
                                        <?php
                                        $price=0;
                                        $reg=0;
                                        $amount=DB::table('multiple_estimate_services')->where('estimate_id',$userDetails->id)->get();
                                        foreach($amount as $key5=>$value4){
                                            $price+=$value4->amount;
                                            $reg+=$value4->reg_amount+$value4->reg_amount_amount_tax;
                                        }
                                        ?>
                                        <td>${{$price}}</td>
                                        <td>${{$reg}}</td>

                                        <?php
                                        $pro_id = DB::table('estimate_professionals')
                                            ->join('users', 'estimate_professionals.pro_id', '=', 'users.id')
                                            ->where('estimate_booking_id', $userDetails->booking_show_id)
                                            ->where('estimate_professionals.status', 1)
                                            ->where('assign_status', 1)
                                            ->get('name');
                                        ?>

                                        <td>{{ $userDetails->phone_no }}</td>
                                       
                                       
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
