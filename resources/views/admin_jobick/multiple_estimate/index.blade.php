@extends('admin_jobick.layout.layout')
@section('head_title','Projects')

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
                    <h4 class="card-title">Projects Management</h4>
                    <!--<a href="{{ url('admin/create-multiple-estimate') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create-->
                    <!--    New</a>-->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Project Title</th>
                                    <th>User Name</th>
                                    <!---th>Email</th---->
                                    <th>Address</th>
                                    <th>Action</th>
                                    <th>Assign</th>
                                </tr>
                            </thead>

                            <tbody>
                                     <?php $looped=1;?>                     
                                @forelse($mult_est as $key=>$userDetails)
                                
                                <?php
                                $projects=DB::table('multiple_estimate_professionals')->where('estimate_booking_id',$userDetails->booking_show_id)->count();
                                $count=DB::table('multiple_estimate_services')->where('estimate_id',$userDetails->id)->count();
                                ?>
                                
                                @if($projects!=$count)
                                 <tr>
                                   
                                        <td>{{$looped}}</td>
                                     <?php $looped++; ?>
                                        <td><?php echo $userDetails->title;?></td>
                                        <td>{{ $userDetails->name }}</td>

                                        <?php
                                        $pro_id = DB::table('estimate_professionals')
                                            ->join('users', 'estimate_professionals.pro_id', '=', 'users.id')
                                            ->where('estimate_booking_id', $userDetails->booking_show_id)
                                            ->where('estimate_professionals.status', 1)
                                            ->where('assign_status', 1)
                                            ->get('name');
                                        ?>

                                        <!---td>{{ $userDetails->email }}</td---->
                                        
                                         <?php
                                        $array = explode(',',  $userDetails->address);
                                        $str=implode(' ,',$array);
                                        ?>
                                        <td>{{ $str}}</td>
                                       
                                        <td>
                                            <!--<a href="{{ url('admin/multiple-estimate/view/' . $userDetails->id) }}"-->
                                            <!--    class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"-->
                                            <!--        aria-hidden="true"></i></a>-->
                                            <a href="{{ url('admin/multiple-booking-invoice-view/' . $userDetails->id) }}"
                                                class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>
                                            <a href="{{ url('admin/multiple-estimate/edit/' . $userDetails->id) }}"
                                                class="btn btn-info btn-xs sharp"><i class="fas fa-edit "></i></a>

                                            <button class="btn btn-danger shadow btn-xs sharp sweet-confirm"
                                                onclick="sweetfunc('{{ $userDetails->id }}')"><i
                                                    class="fa fa-trash"></i></button>
                                            <a href="{{ url('admin/multiple-estimate/delete') }}/{{ $userDetails->id }}"
                                                style="display:none" id="delete{{ $userDetails->id }}"
                                                class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{url('admin/services-view/'.$userDetails->id)}}"
                                                class="btn btn-danger btn-xs sharp"><i class="fa fa-arrow-right"
                                                    aria-hidden="true"></i></a>
                                        </td>
                         <!--               <td>-->
                    					<!--    @if($userDetails->payment_status==1)-->
                    					<!--    <a href="{{url('admin/multiple-estimate-invoice-view/'.$userDetails->id.'/'.$userDetails->booking_show_id)}}" class="btn btn-success btn-xs">Invoice</a>-->
                    					<!--    @endif-->
                    					<!--</td>-->
                                    </tr>
                                   
                                @endif
                                   
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
