@extends('professional.layout.layout')
@section('head_title', 'DIRECT ASSIGNS')
@section('content')
    <style type="text/css">
        .label-danger {
            background-color: #d9534f;
        }

        .card-primary:not(.card-outline) .card-header {
            background-color: #17a2b8;
        }

        .label {
            display: inline;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
        .photos{
      width:30%;
      margin:0.5%;
    }
        .label-success {
            background-color: #5cb85c;
        }

        .pt-0 {
            margin-top: 16px !important;
        }

        .card {
            margin-bottom: 1.875rem;
            background-color: #fff;
            transition: all 0.5s ease-in-out;
            position: relative;
            border: 0rem solid transparent;
            border-radius: 1.25rem;
            /* box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgba(82, 63, 105, 0.05); */
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            height: auto;
        }
    </style>




    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="card-header">
                    <h3 class="card-title">Directly Assigned Opportunity</h3>
                </div>
                <br />
               
                <div class="card-body">
                    <div class="card">
                      <div class="card-body pt-0">
                       <h2 class="lead mt-3 text-warning" ><b>Directly Assigned Opportunity</b></h2>
                       
                        <div class="row mt-4">
                          <div class="col-3">
                            
                            <p class="text-black text-sm">
                              <b>Job Title: </b> Web Developer
                            </p>
                            <p class="text-black text-sm">
                              <b>Location: </b> New Delhi
                            </p>
                            
                          </div>
                          <div class="col-5 "> 
                             <div class="row">
  
                                <div class="col">
  
                                   <p class="text-black text-sm">
                                      <b>Date to be completed: </b> 12/10/2022
                                   </p>
                                   <p class="text-black text-sm">
                                      <b>Job Description: </b> Frontend
                                   </p>
  
                                </div>
  
                                <div class="col-4">
                                   <div style="background-color:blue; color:white; padding: 5px; text-align: center; border-radius: 10px;">Project rate<br>
                                      $880 + HST
  
                                   </div>
                                </div>
  
  
                             </div>
  
  
  
                          </div>
  
                          <div class="col-4">
  
  
  
                             <div class="d-flex flex-row flex-wrap">
  
                          
                              <div class="photos" >
                                 <a href="https://1.bp.blogspot.com/-gOfHPSYWMVo/WAWlPrm-IBI/AAAAAAAAD4g/fwE_ihqLJ4o8uHlTHiA1e7HD9MLtb2rWACLcB/s640/laying-brick-wall.jpg">
                                      <img style="width:100%; height:100%" class="img-thumbnail" src="https://1.bp.blogspot.com/-gOfHPSYWMVo/WAWlPrm-IBI/AAAAAAAAD4g/fwE_ihqLJ4o8uHlTHiA1e7HD9MLtb2rWACLcB/s640/laying-brick-wall.jpg">
                                          </a>
                                   
                                 </div>
                                 <div class="photos" >
   
                                    <a href="https://1.bp.blogspot.com/-67JIrwcHc44/WAWlGbIulRI/AAAAAAAAD4c/fnAex5so3qIRgluyuGd3J4zpxMQjTUo7ACLcB/s640/reinforced%2Bsteel.png
   ">
                                      <img style="width:100%; height:100%" class="img-thumbnail" src="https://1.bp.blogspot.com/-67JIrwcHc44/WAWlGbIulRI/AAAAAAAAD4c/fnAex5so3qIRgluyuGd3J4zpxMQjTUo7ACLcB/s640/reinforced%2Bsteel.png
   ">
                                          </a>
                                 </div>
                                 <div class="photos">
                                 <a href="https://3.bp.blogspot.com/-Vjz7drj-m-Q/VhZHRrLYUXI/AAAAAAAADuk/MOsdN7X8dvk/s640/dscf0511.jpg
   ">
                                      <img style="width:100%; height:100%" class="img-thumbnail" src="https://3.bp.blogspot.com/-Vjz7drj-m-Q/VhZHRrLYUXI/AAAAAAAADuk/MOsdN7X8dvk/s640/dscf0511.jpg
   ">
                                          </a>
                                 </div>

                                 <div class="photos" >
                                    <a href="https://2.bp.blogspot.com/-_w3_IWrBQw0/VsWrUcmEVOI/AAAAAAAADwI/UxSdQ5Jc6mk/s640/Curved-Staircase.jpeg

">
                                   <img style="width:100%; height:100%" class="img-thumbnail" src="https://2.bp.blogspot.com/-_w3_IWrBQw0/VsWrUcmEVOI/AAAAAAAADwI/UxSdQ5Jc6mk/s640/Curved-Staircase.jpeg

">
                                       </a>
                                    </div>
                                    <div class="photos">
                                    <a href="https://3.bp.blogspot.com/-4vr6aqzTy4Q/VsW-PsI9m8I/AAAAAAAADwc/kdNUQltGJ68/s640/steep%2Bstairs.jpg
">
                                   <img style="width:100%; height:100%" class="img-thumbnail" src="https://3.bp.blogspot.com/-4vr6aqzTy4Q/VsW-PsI9m8I/AAAAAAAADwc/kdNUQltGJ68/s640/steep%2Bstairs.jpg
">
                                       </a>
                                    </div>
                             </div>
  
  
                           
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="float-end flex" style="width:65%">
  
                          
  
                             <span class="float-start" >
                                <span><b>$ </b></span> <input type="number" name="bid" style="width:30%"> <span> <b>Bid</b></span>
                             </span>
  
                         
                          <a
                            href="javascrpit:void(0);"
                            class="btn btn-xs btn-info"
                          >
  
                          Submit Bid & Accept
                           
                          </a>
                          <a
                            href="javascrpit:void(0);"
                            class="btn btn-xs btn-success"
                          >
                            Accept Job
                          </a>
                          <a
                            href="javascrpit:void(0);"
                            class="btn btn-xs btn-danger"
                          >
                           
                            Decline Job
                          </a>
                       
                        </div>
                      </div>
                    </div>
            </div>
        </div>
    </div>

@endsection
