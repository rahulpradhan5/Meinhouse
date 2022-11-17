@extends('admin_jobick.layout.layout')

@section('head_title','Users')

@section('content')

              

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">Users Management</h4>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="example3" class="display" style="width: 100%">

                                <thead>

                                    <tr>

                                        <th></th>

                                        <th></th>

                                        <th>Name</th>

                                        <th>Email</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($user as $key => $userDetails)

                                        <tr>

                                            <td>{{$key + 1}}</td>

                                            <td><img class="rounded-circle" width="35" src="@if($userDetails->user_image){{url('public/uploads/users')}}/{{$userDetails->user_image}}@else {{url('assets/jobick/images/logo.png')}}@endif" alt=""></td>

                                            <td>{{$userDetails->name}}</td>

                                            <td>{{$userDetails->email}}</td>

                                            <td>                  

                                                <a href="{{url('admin/view-user')}}/{{$userDetails->id}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-eye"></i></a>

                                                <button  class="btn btn-danger shadow btn-xs sharp sweet-confirm" onclick="sweetfunc('{{$userDetails->id}}')"><i class="fa fa-trash"></i></button>

                                                <a href="{{url('admin/delete-user')}}/{{$userDetails->id}}" style="display:none" id="delete{{$userDetails->id}}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>                

                                              

                                                <?php if($userDetails->status=='1'){ ?>

                                                <a href="javascript:void()" id="active<?php echo $userDetails->id;?>" onclick="myfunction('{{$userDetails->id}}')" class="btn btn-success btn-sm">Active</a>                

                                                <?php }else{?>

                                                <a href="javascript:void()" id="active<?php echo $userDetails->id; ?>" onclick="myfunction('{{$userDetails->id}}')" class="btn btn-danger btn-sm">InActive</a>                

                                                <?php }?>

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

@section('script')

<script>

    function myfunction(id) {

        var active ="#active";

        let result = active.concat(id);

        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{url('admin/user_status')}}",

            data:{ id: id, '_token': "{{csrf_token()}}" },

            success: function (data) {

                if (data == '1') {

                    $(result).css("background-color", "#dc3545");

                    $(result).html('InActive');

                } else {

                    $(result).css("background-color", "#28a745");

                    $(result).html('Active');



                }

            }

        });

    }

</script>

<script>

	function sweetfunc(id) {

        var active ="delete";

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