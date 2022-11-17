<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    

<div class="container my-5">

        
     

    <div class="row">
                    
        <div class="row">
           
                        <div class="row">
     
             <div class="col-10 mx-auto">
         <div class="card card-info border-0 shadow-sm">
            
             <div class="m-4">
                 <?php $auth_id = $id;?>
                <!-- card beginning -->
                        <div style="display:flex; width:100%;border-bottom: rgb(216, 212, 212) 1px solid ;">

                               

                                    <div style="width:35%; " class="sub-div-left">
                                        

                                        <div style="display:flex;border-bottom: rgb(216, 212, 212) 1px solid;">
                                            
                                            <?php
                                             $professional=DB::table('users')->where('id',$auth_id)->first();
                                             $details=DB::table('pro_details')->where('pro_id',$auth_id)->first();
                                             $services=DB::table('pro_services')->where('pro_id',$auth_id)->pluck('service_id');
                                            ?>
                                            <div class="mb-3">

                                                <img src="{{ url('public/upload/pro_profile/'.$professional->user_image) }}" style="border-radius: 50%; width:80px; height:80px">
                                            </div>
                                            <div class="m-2" style="margin-left:5%">
                                                <h4 class="text-capitalize">{{  ucfirst($professional->name)}}</h4>
                                                <p>{{$details->company_name}}</p>
                                            </div> 

                                        </div>


                                        <div class="ms-4 mt-4 mb-4">
                                            <div>
                                                <p class="fs-18" style="font-weight: 500;">Services Offered : </p>
                                            </div>

                                            <div class="ms-5 fs-16">
                                            
                                                <ul>
                                                    
                                                   @foreach($services->slice(0, 5)  as $key=>$ser)
                                                        <li>-<?php 
                                                        $service=DB::table('services')->where('id',$ser)->first();
                                                        echo $service->name;
                                                        ?></li>                                                   
                                                   @endforeach
                                                </ul>
                                            </div>
                                        </div>


                                    </div>
                                    
                                    

                                    <div style="width:60%;" class="sub-div-right ms-5 mb-4">
                                        
                                        <h4 class="m-2">Average Rating</h4>

                                        <div style="display:flex; justify-content: space-evenly;">
                                            <div style="background-color:#f7f7f7; border-radius: 20px; display: flex; justify-content: space-evenly; padding:4%;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                                <div style="width:15%">


                                                    <img class="mt-4" style="width:100%" src="{{url('/public/image/star.jpeg')}}">



                                                </div>
                                                <div>

                                                    <p class="fs-22" style="color:#1d79ce ;"><b>{{round($review_avg)}}/5</b></p>

                                                </div>
                                                <div style="display:flex;">


                                                    <div class="ms-3 me-3" style="display:flex; flex-direction: column;">

                                                        <div class="m-2">
                                                            Average rating 
            
                                                        </div>
                                                    <div class="m-2">
                                                        Responsive
                                                    </div>
                                                    <div class="m-2">
                                                        Reputation
                                                    </div>
                                                    <div class="m-2">
                                                        Great Work
                                                    </div>

                                                    </div>

                                                    <div class="ms-3 me-3" style="display:flex; flex-direction: column;">

                                                        <div class="progress m-3">
                                                            <?php
                                                            $avg_rate=0;
                                                            //if($review_avg == 0)
                                                            
                                                            if($review_avg >0 && $review_avg <1)
                                                             $avg_rate=25;
                                                            if($review_avg >1 && $review_avg <2)
                                                            $avg_rate=50;
                                                               if($review_avg >3 && $review_avg <4)
                                                            $avg_rate=75;
                                                           if($review_avg >4 && $review_avg <5)
                                                            $avg_rate=100;
                                                            ?>
                                                            <div class="progress-bar w-75" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress m-3">
                                                            <div class="progress-bar w-50" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress m-3">
                                                            <div class="progress-bar w-100" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress m-3">
                                                            <div class="progress-bar w-100" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    <div>
                                                        Great Work
                                                    </div>

                                                    </div>

                                                
                                                





                                                </div>

                                            </div>
                                        </div>
                                    </div>

                        </div>
             </div>
             <!-- form start -->
             <div class="card-body pt-0">
     
                 
                    <div class="pb-3" style="border-bottom: rgb(216, 212, 212) 1px solid;">

                        <h4>Customer Reviews</h4>

                    </div>

                    <div class="reviews mt-4">

                        <!-- review 1 -->

                      @foreach($reviews as $key => $data)
                      <div class="mb-3" style="background-color:#f7f7f7; border-radius: 20px; display: flex; padding:4%; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                            <div style="display:flex;border-right: rgb(216, 212, 212) 1px solid;">
                                <div class="mb-3">

                                    <img src="{{$data['userDetails']['user_image'] ? url('public/uploads/users/'.$data['userDetails']['user_image']) : url('assets/jobick/images/logo.png')}}" style="border-radius: 50%; width:60px; height:60px">
                                </div>
                                <div class="m-2 me-5" style="margin-left:5%; ">
                                    <h4 class="text-capitalize">{{$data['userDetails']['name']}}</h4>
                                    <p class="fs-16" style="color:#bbbbbb">{{$data->Project_title}}</p>
                                </div> 

                            </div>
<?php
$service=DB::table('services')->where('id',$data->service_id)->first();
?>
                            <div class="ms-4">
                                <p style="font-size: 15px;">{{$service->name}}</p>
                                
                                <p class="mt-2 fs-10">{{$data->reviews}}</p>
                            </div>

                            <div style="margin-inline-start: 50%;">
                                <p class="fs-18" style="color:#1d79ce ;">{{$data->stars}}/5</p>
                               
                                <p class="fs-15" style="color:#bbbbbb">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                      @endforeach
                       
                        
                    </div>
                   
             
         </div>
         </div></div>
         </div>
     
     
     
     </div>
     </div>
            
                
        </div>
</body>
</html>
