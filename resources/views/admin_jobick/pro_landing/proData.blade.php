@extends('admin_jobick.layout.layout')
@section('head_title','Pro Data')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pro Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Trade</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($proData as $key=>$p)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->city }}</td>
                                    <td>{{ $p->phone }}</td>
                                    <td>{{ $p->email }}</td>
                                         <td>@if(!empty($p['services']))
       {{$p['services']->pluck('name')->implode(', ') }}
     
    @endif</td>
     <td>
                                        <a href="{{ url("admin/pro-data/details/$p->id") }}" class="btn btn-primary btn-xs sharp"><i class="fas fa-eye"></i></a>
                                                                         <a href="{{ url("admin/pro-data/delete/$p->id") }}" class="btn btn-danger btn-xs sharp"><i class="fas fa-trash"></i></a>

                                    
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
