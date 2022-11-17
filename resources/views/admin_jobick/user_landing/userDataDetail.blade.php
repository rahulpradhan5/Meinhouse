@extends('admin_jobick.layout.layout')
@section('head_title','Professionals >> Detail View')

@section('content')
    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-header">

                    <h4 class="card-title">Details</h4>

                </div>

                <div class="card-body">

                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>User Name</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($userData->name) }}

                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Phone</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($userData->contact) }}

                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Email</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($userData->email) }}

                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Service</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class="">

                        @if(!empty($userData['services']))

       {{$userData['services']->pluck('name')->implode(', ') }}

     

    @endif

                       

                        </span>

                        </div>

                    </div>
                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Date of submission</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ Carbon\Carbon::parse($userData->created_at)->format('d M Y') }}

                        </div>

                    </div>
                    @if($ProjectDetails!=NULL)
                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Project Name</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($ProjectDetails->Name) }}

                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Project Description</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($ProjectDetails->description) }}

                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>City</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($ProjectDetails->city) }}

                        </div>

                    </div>
                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Address</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($ProjectDetails->Address) }}

                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-3">

                            <h5>Project time limit</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8"><span class=""> {{ ucwords($ProjectDetails->Time) }}

                        </div>

                    </div>

                  


                    <div class="row mb-2">
<br>
                        <div class="col-3">

                            <h5>Images :</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-8 d-flex"><span class=""> 

                        </div>

                    </div>   
                    
                    <div class="row my-3">
                     
                        
                        @foreach($Images as $key=>$value)
                       
                        <div class="col-4">
                            <img src="{{asset('public/User_data_uploads')}}/{{$value}}" style="height: 250px; width:300px" class="img-fluid">
                                                                          
                                </div>

                       @endforeach

                      
                           
                    </div>
                  
                  

                  @else



    <div class="row mb-2">

        <div class="col-3">

            <h5>Project Details</h5>

        </div>

        <div class="col-1"><B>:</B></div>

        <div class="col-8"><span class=""> No details provided by user
    
        </div>
    </div>
<br>
                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection

