@extends('admin_jobick.layout.layout')
@section('content')
<div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('admin/blog')}}">Blogs</a></li>
        </ol>
    </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Blogs</h4>
                        <a href="{{url('admin/add-blog')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Blogs</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Publishing Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                @foreach($blog as $b)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><img src="{{ url('public/upload/blogs/'.$b->blog_image) }}" height="50" width="50"></td>
                                    <td>{{ $b->title }}</td>
                                    <td>{!! substr($b->description,0,250) !!}..</td>
                                    <td>{{ $b->date }}</td>
                                    <td style="white-space: nowrap">
                                        <a href="{{url("admin/view-blog/$b->id")}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>
                                        <a href="{{url("admin/edit-blog/$b->id")}}" class="btn btn-info btn-xs sharp"><i class="fa fa-edit"></i></a>
                                        <button  class="btn btn-danger shadow btn-xs sharp sweet-confirm" onclick="sweetfunc('{{$b->id}}')"><i class="fa fa-trash"></i></button>
                                        <a href="{{url('admin/delete-blog')}}/{{$b->id}}" style="display:none" id="delete{{$b->id}}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>                
                                        
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