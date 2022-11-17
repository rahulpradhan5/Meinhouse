@extends('admin_jobick.layout.layout')
@section('content')
             <div class="row page-titles">
            <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>

<li class="breadcrumb-item active "><a href="{{url('admin/promo')}}">Promocode</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Promo Codes</h4>
                        <a href="{{url('admin/add-promo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add PromoCode</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Price</th>
                                        <th>Starting Date</th>
                                        <th>Ending Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($promocodes as $key => $data)
                                <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->code }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{$data->start_date}}</td>
                                    <td>{{$data->end_date}}</td>

                                <td>   
                                    <a href="{{url('admin/view-promo')}}/{{$data->id}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                                    <button  class="btn btn-danger shadow btn-xs sharp sweet-confirm" onclick="sweetfunc('{{$data->id}}')"><i class="fa fa-trash"></i></button>
                                    <a href="{{url('admin/delete-promo')}}/{{$data->id}}" style="display:none" id="delete{{$data->id}}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>                
                                    <a href="{{url('admin/edit-promo')}}/{{$data->id}}" class="btn btn-success shadow btn-xs sharp"><i class="fa fa-edit"></i></a>
                                    @if($data->status=='1')
                                    <a href="javascript:void()" id="active{{$data->id}}" onclick="myfunction('{{$data->id}}')" class="btn btn-success btn-sm">Active</a>                
                                    @else
                                    <a href="javascript:void()" id="active{{$data->id}}" onclick="myfunction('{{$data->id}}')" class="btn btn-danger btn-sm">InActive</a>                
                                    @endif
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
            url: "{{url('admin/promo_status')}}",
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