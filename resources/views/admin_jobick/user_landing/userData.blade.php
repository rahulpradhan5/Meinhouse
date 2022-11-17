@extends('admin_jobick.layout.layout')
@section('head_title','Professionals >> Customer Services')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($userData as $key=>$u)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->contact }}</td>
                                    <td>{{ $u->email }}</td>
                                 
                                        <td> @if(!empty($u['services']))
       {{$u['services']->pluck('name')->implode(', ') }}

     
    @endif</td>
                                    <td>
                                        <a href="{{ url("admin/users-data/details/$u->id") }}" class="btn btn-primary btn-xs sharp"><i class="fas fa-eye"></i></a>
                                        <a href="{{ url("admin/users-data/delete/$u->id") }}" class="btn btn-danger btn-xs sharp"><i class="fas fa-trash"></i></a>

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
