@extends('admin_jobick.layout.layout')
@section('head_title','USER>>USER DATA')
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
                                     
                                        <th>User Name</th>
                                      <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                       
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iteration=1;
                                    ?>
                                @foreach($userData as $key=>$u)
                                 <?php
                                    $detail=DB::table('user_data_projectDetails')->where('user_data_id',$u->id)->exists();
                                    
                                    ?>
                           @if(!$detail)
                                <tr>
                                    
                                   
                                    <td>{{ $iteration}}</td>
                                 
                                    <td>{{ $u->name }}</td>
                                     <td>{{ $u->contact}}</td>
                                  
                                    <td>{{ $u->email }}</td>
                                 
                                        
                                    <td class="d-flex">
                                        
                                        <!---a href="{{ url("admin/convertEstimate/$u->id") }}" class="btn btn-primary btn-sm sharp mx-1"><i class="fas fa-eye"></i></a------->
                                        <a href="{{ url("admin/users-data/delete/$u->id") }}"  onclick="return confirm('Are you sure?')"class="btn btn-danger btn-sm sharp"><i class="fas fa-trash"></i></a>
                                        
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
