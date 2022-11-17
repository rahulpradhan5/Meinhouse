@extends('admin_jobick.layout.layout')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Contact Us</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Cell Phone</th>
                                        <th>Email</th>
                                        <th>Venue</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contact as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->phone }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->venue }}</td>
                                        <td style="white-space: nowrap">
                                            <a href="{{url('admin/view-contact')}}/{{$c->id}}" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>
                                            <button  class="btn btn-danger shadow btn-xs sharp sweet-confirm" onclick="sweetfunc('{{$c->id}}')"><i class="fa fa-trash"></i></button>
                                            <a href="{{url('admin/delete-contact')}}/{{$c->id}}" style="display:none" id="delete{{$c->id}}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>                
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