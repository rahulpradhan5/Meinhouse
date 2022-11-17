@extends('admin_jobick.layout.layout')
@section('content')
            <div class="row page-titles">
            <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{url('admin/testimonials')}}">Testimonials</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Testimonials</h4>
                        <a href="{{url('admin/add-testimonial')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Testimonial</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($testimonials as $key => $data)
                                <tr>
                                <td> {{$loop->iteration}} </td>
                                <td><img src="{{url('public/testimonial/'.$data->testimonial_image) }}" height="50" width="50"></td>
                                <td> {{$data->name}} </td>
                                <td>
                                    <a href="{{url('admin/view-testimonial')}}/{{$data->id}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye " aria-hidden="true"></i></a>
                                    <a href="{{url('admin/edit-testimonial')}}/{{$data->id}}" class="btn btn-info btn-xs sharp"><i class="fas fa-edit "></i></a>
                                    <button  class="btn btn-danger shadow btn-xs sharp sweet-confirm" onclick="sweetfunc('{{$data->id}}')"><i class="fa fa-trash"></i></button>
                                    <a href="{{url('admin/delete-testimonial')}}/{{$data->id}}" style="display:none" id="delete{{$data->id}}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>                
                                    
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