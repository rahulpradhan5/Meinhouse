@extends('admin_jobick.layout.layout')
@section('head_title','Services')
@section('content')
                     <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Services Management</h4>
                        <a href="{{url('admin/add-service')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Services</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Service Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($services as $key => $data)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $data->name }}</td>
                                    <td><img src="{{ url('assets/services/'.$data->service_image) }}" height="50" width="50"></td>
                                    <td>
                                        @if($data->service_type == 0)
                                        <div class="btn-highlight">
                                        Time
                                        </div>
                                        @endif
                                        @if($data->service_type == 1)
                                        <div class="btn-highlight">
                                        Area
                                        </div>
                                        @endif
                                        @if($data->service_type == 2)
                                        <div class="btn-highlight">
                                        Free Quote
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('admin/view-service')}}/{{$data->id}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{url('admin/edit-service')}}/{{$data->id}}" class="btn btn-info btn-xs sharp"><i class="fas fa-edit "></i></a>
                                        
                                        <button  class="btn btn-danger shadow btn-xs sharp sweet-confirm" onclick="sweetfunc('{{$data->id}}')"><i class="fa fa-trash"></i></button>
                                        <a href="{{url('admin/delete-service')}}/{{$data->id}}" style="display:none" id="delete{{$data->id}}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>                
                                        
                                        <?php if($data->status=='1'){ ?>
                                        <a href="javascript:void()" id="active<?php echo $data->id;?>" onclick="myfunction('{{$data->id}}')" class="btn btn-success btn-sm">Active</a>                
                                        <?php }else{?>
                                        <a href="javascript:void()" id="active<?php echo $data->id; ?>" onclick="myfunction('{{$data->id}}')" class="btn btn-danger btn-sm">InActive</a>                
                                        <?php }?>
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
    function myfunction(id) {
        var active ="#active";
        let result = active.concat(id);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{url('admin/service_status')}}",
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