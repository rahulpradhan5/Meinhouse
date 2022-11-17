@extends('admin_jobick.layout.layout')
@section('head_title','Bookings')
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
                                        <th>Project Title</th>
                                        <th>User Name</th>
                                         <th> Project Address</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                         <th>Convert to estimate</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iteration=1;
                                    ?>
                                @foreach($userData as $key=>$u)
                                 <?php
                                    $detail=DB::table('user_data_projectDetails')->where('user_data_id',$u->id)->first();
                                    
                                    ?>
                               @if($detail!=NULL)
                                <tr>
                                    
                                   
                                    <td>{{ $iteration}}</td>
                                    @if($detail!=NULL)<td>{{$detail->Name}}</td>@else<td>N.A</td>@endif
                                    <td>{{ $u->name }}</td>
                                   <td>{{$detail->Address}} ,{{$detail->city}}</td>
                                    <td>{{ $u->email }}</td>
                                 
                                        
                                    <td class="d-flex">
                                        
                                        <a href="{{ url("admin/view-booking/single/$u->id") }}" class="btn btn-primary btn-sm sharp mx-1"><i class="fas fa-eye"></i></a>
                                        <a href="{{ url("admin/bookings/cancel/single/$u->id") }}"  onclick="return confirm('Are you sure?')"class="btn btn-danger btn-sm sharp"><i class="fas fa-trash"></i></a>
                                        
                                    </td>
                                    <td><a href="{{ url("admin/convertEstimate/$u->id") }}" target="_blank" class="btn btn-info btn-sm text-white">Convert to estimate</a>
</td>
                                </tr>
                                <?php $iteration++; ?>
                               @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
