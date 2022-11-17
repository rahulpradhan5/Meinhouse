@extends('admin_jobick.layout.layout')
@section('head_title','Professionals >> Detail View')
<?php error_reporting(0);?>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-4 text-center">
                            <a href="#"><img
                                    src="@if($users->user_image){{url('public/upload/pro_profile')}}/{{$users->user_image}}@else {{url('assets/jobick/images/logo.png')}}@endif"
                                    class="img-fluid ms-auto me-auto w-50 text-center" title="professional"></a>
                        </div>

                        <div class="col-12 col-sm-8">
                            <h3 class="user-name m-t-0 mb-0">{{$users->name}}</h3>
                            <p class="">{{$users->email}}</p>
                            <p class="">{{$users->phone}}</p>
                            <p class="">
                                <?php $s = $users->created_at;
                                $date = strtotime($s);
                                echo date('d-m-Y', $date);  ?>
                            </p>


                            <span class="">
                                @for($i=0;$i < $review_avg ; $i++) <i class="fa fa-star"
                                    aria-hidden="true" style="color: coral;"></i>
                                @endfor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($users->is_listed == 1)
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Professional Details</h4>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#Profile"><i class="la la-home me-2"></i> Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Availability"><i class="la la-user me-2"></i>Availability</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Bookings"><i class="la la-phone me-2"></i> Bookings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Reviews"><i class="la la-envelope me-2"></i> Reviews</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="Profile" role="tabpanel">
                                    <div class="pt-4">
                                        <h3 class=" mb-2">Business Listing</h3>
                                        <div class="row mb-2">
                                            <div class="col-4">Company name</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->company_name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4 ">Full Business</div>
                                            <div class="col-1 "><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->business_address}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Business Phone No</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->phone_no}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Name</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Address</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->address}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">City/Municipality</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->city}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Province</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->province}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Postal Code</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->postal_code}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Experience</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->experience}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Vehicle Owner</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">@if($prodetails->vehicle_owner == 1)
                                                                    Yes
                                                                @endif
                                                                @if($prodetails->vehicle_owner == 0)
                                                                    No
                                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Insurance</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">
                                                    @php

                                                    $ext = File::extension($prodetails->insurance);

                                                    @endphp

                                                    @if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx')

                                                    <a href="{{url('public/upload/pro_doc/'.$prodetails->insurance)}}" class="img-fluid" target="_blank">{{$prodetails->insurance}}</a>

                                                    @endif

                                                    @if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif')

                                                    <a href="javascript:void()" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong"><img src="{{url('public/upload/pro_doc/'.$prodetails->insurance)}}" style="height:100px; width:auto;" class="img-fluid" ></a>

                                                    @endif
                                                </span>
                                               
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalLong">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Insurance</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                        <img class="img-fluid" style="" src="{{url('public/upload/pro_doc/'.$prodetails->insurance)}}" alt="insta_img">
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Distance</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->distance}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Criminal Offence</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">
                                                    @if($prodetails->criminal_offence == 1)
                                                    Yes
                                                    @endif
                                                    @if($prodetails->criminal_offence == 0)
                                                    No
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Payment Status</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">
                                                    @if($users->is_payment == 1)
                                                        Payment Done
                                                    @endif
                                                    @if($users->is_payment == 0)
                                                        Payment Not Done
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="mt-2 mb-2">Account/Company Information</h3>
                                        <div class="row mb-2">
                                            <div class="col-4">EIN Number</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->ein_no}}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-4">Account First Name</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->acc_first_name}}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-4">Account Last Name</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->acc_last_name}}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-4">SSN Number</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->ssn_no}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Date of Birth</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->dob}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Routing Number</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->routing_no}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">Account Number</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->account_no}}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="mt-2 mb-2">Add License certification</h3>
                                        <div class="row mb-2">
                                            <div class="col-4">License Number</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6">
                                                <span class="">{{$prodetails->license_no}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">License Doc</div>
                                            <div class="col-1"><B>:</B></div>
                                            <div class="col-6"><span class="">
                                            @php

                                            $ext = File::extension($prodetails->license_doc);

                                            @endphp

                                            @if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx')

                                            <a href="{{url('public/upload/pro_doc/'.$prodetails->license_doc)}}" class="img-fluid" target="_blank">{{$prodetails->license_doc}}</a>

                                            @endif

                                            @if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif')

                                            <a href="javascript:void()"type="button"  data-bs-toggle="modal" data-bs-target="#basicModal" > <img src="{{url('public/upload/pro_doc/'.$prodetails->license_doc)}}" style="height:100px; width:auto" class="img-fluid" ></a>

                                            @endif
                                            </span>
                                    <!-- Modal -->
                                            <div class="modal fade" id="basicModal">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content modal-lg">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">License</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img style="" class="img-fluid" src="{{url('public/upload/pro_doc/'.$prodetails->license_doc)}}" alt="insta_img">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="mt-2 mb-2">Services</h3>
                                        <div class="row mb-2">
                                            @foreach ($proservices as $key => $value)
                                                <div class="col-md-3 col-4 col-sm-4 col-lg-3 mb-1">
                                                    <div class="circle-mid-img">
                                                        <a><img class="img-fluid" style="height: 85px;
                                                                                        border-radius: 100%;
                                                                                        border: 1px solid gray;
                                                                                        box-shadow: 3px 3px 5px #1e9bd0;"  src="{{url('assets/services')}}/{{$value['serviceDetails']['service_image']}}">
                                                        <span class="app-s mt-2 mb-2" style=" display: block">{{$value['serviceDetails']['name'] }}</span></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Availability">
                                    <div class="pt-4">
                                        <h4>Availability</h4>
                                        <div class="row">
                                            <h3>Monday</h3>
                                            <div class="col-6 col-md-2">
                                                @if($monday['morning'] == 1)
                                                    <button class="btn btn-success ">08:00-11:00AM</button>
                                                @else
                                                    <button class="btn btn-dark ">08:00-11:00AM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($monday['midnoon'] == 1)
                                                    <button class="btn btn-success ">11:00-02:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">11:00-02:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($monday['afternoon'] == 1)
                                                    <button class="btn btn-success ">02:00-05:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">02:00-05:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($monday['evening'] == 1)
                                                    <button class="btn btn-success ">05:00-08:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">05:00-08:00PM</button>
                                                @endif
                                            </div>
                                            
                                            <h3 class="mt-3">Tuesday</h3>
                                            <div class="col-6 col-md-2">
                                                @if($tuesday['morning'] == 1)
                                                    <button class="btn btn-success ">08:00-11:00AM</button>
                                                @else
                                                    <button class="btn btn-dark ">08:00-11:00AM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($tuesday['midnoon'] == 1)
                                                    <button class="btn btn-success ">11:00-02:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">11:00-02:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($tuesday['afternoon'] == 1)
                                                    <button class="btn btn-success ">02:00-05:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">02:00-05:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($tuesday['evening'] == 1)
                                                    <button class="btn btn-success ">05:00-08:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">05:00-08:00PM</button>
                                                @endif
                                            </div>

                                            <h3 class="mt-3">Wednesday</h3>
                                            <div class="col-6 col-md-2">
                                                @if($wednesday['morning'] == 1)
                                                    <button class="btn btn-success ">08:00-11:00AM</button>
                                                @else
                                                    <button class="btn btn-dark ">08:00-11:00AM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($wednesday['midnoon'] == 1)
                                                    <button class="btn btn-success ">11:00-02:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">11:00-02:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($wednesday['afternoon'] == 1)
                                                    <button class="btn btn-success ">02:00-05:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">02:00-05:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($wednesday['evening'] == 1)
                                                    <button class="btn btn-success ">05:00-08:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">05:00-08:00PM</button>
                                                @endif
                                            </div>

                                            <h3 class="mt-3">Thursday</h3>
                                            <div class="col-6 col-md-2">
                                                @if($thursday['morning'] == 1)
                                                    <button class="btn btn-success ">08:00-11:00AM</button>
                                                @else
                                                    <button class="btn btn-dark ">08:00-11:00AM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($thursday['midnoon'] == 1)
                                                    <button class="btn btn-success ">11:00-02:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">11:00-02:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($thursday['afternoon'] == 1)
                                                    <button class="btn btn-success ">02:00-05:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">02:00-05:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($thursday['evening'] == 1)
                                                    <button class="btn btn-success ">05:00-08:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">05:00-08:00PM</button>
                                                @endif
                                            </div>

                                            <h3 class="mt-3">Friday</h3>
                                            <div class="col-6 col-md-2">
                                                @if($friday['morning'] == 1)
                                                    <button class="btn btn-success ">08:00-11:00AM</button>
                                                @else
                                                    <button class="btn btn-dark ">08:00-11:00AM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($friday['midnoon'] == 1)
                                                    <button class="btn btn-success ">11:00-02:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">11:00-02:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($friday['afternoon'] == 1)
                                                    <button class="btn btn-success ">02:00-05:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">02:00-05:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($friday['evening'] == 1)
                                                    <button class="btn btn-success ">05:00-08:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">05:00-08:00PM</button>
                                                @endif
                                            </div>

                                            <h3 class="mt-3">Saturday</h3>
                                            <div class="col-6 col-md-2">
                                                @if($saturday['morning'] == 1)
                                                    <button class="btn btn-success ">08:00-11:00AM</button>
                                                @else
                                                    <button class="btn btn-dark ">08:00-11:00AM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($saturday['midnoon'] == 1)
                                                    <button class="btn btn-success ">11:00-02:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">11:00-02:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($saturday['afternoon'] == 1)
                                                    <button class="btn btn-success ">02:00-05:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">02:00-05:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($saturday['evening'] == 1)
                                                    <button class="btn btn-success ">05:00-08:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">05:00-08:00PM</button>
                                                @endif
                                            </div>

                                            <h3 class="mt-3">Sunday</h3>
                                            <div class="col-6 col-md-2">
                                                @if($sunday['morning'] == 1)
                                                    <button class="btn btn-success ">08:00-11:00AM</button>
                                                @else
                                                    <button class="btn btn-dark ">08:00-11:00AM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($sunday['midnoon'] == 1)
                                                    <button class="btn btn-success ">11:00-02:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">11:00-02:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($sunday['afternoon'] == 1)
                                                    <button class="btn btn-success ">02:00-05:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">02:00-05:00PM</button>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2">
                                                @if($sunday['evening'] == 1)
                                                    <button class="btn btn-success ">05:00-08:00PM</button>
                                                @else
                                                    <button class="btn btn-dark ">05:00-08:00PM</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Bookings">
                                    <div class="pt-4">
                                        <h4>Bookings</h4>
                                        <table id="example3" class="display" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Bookings ID</th>
                                                    <th>Status</th>
                                                    <th>Service</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bookings as $key => $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $data->booking_show_id}}</td>
                                                    <td>@if($data->booking_status == 0)
                                                        Pending
                                                    
                                                        @endif
                                                        @if($data->booking_status == 1)
                                                        
                                                        Confirmed
                                                        
                                                        @endif
                                                        @if($data->booking_status == 2)
                                                        
                                                        Pro Cancelled
                                                        
                                                        @endif
                                                        @if($data->booking_status == 3)
                                                        
                                                        User Cancelled
                                                        
                                                        @endif
                                                        @if($data->booking_status == 4)
                                                        
                                                        Time Exceeds
                                                        
                                                        @endif
                                                        @if($data->booking_status == 5)
                                                        
                                                        Completed
                                                    
                                                        @endif
                                                        @if($data->booking_status == 6)
                                                        
                                                        Service Start
                                                    
                                                        @endif
                                                        @if($data->booking_status == 7)
                                                        
                                                        Payment Done
                                                    
                                                        @endif
                                                        @if($data->booking_status == 8)
                                                        
                                                        Admin Cancelled
                                                    
                                                        @endif </td>
                                                
                                                    <td>{{ $data['serviceDetails']['name']}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <div class="pt-4">
                                        <h4>This is message title</h4>
                                        <table id="example3" class="display" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>User</th>
                                                    <th>Rating</th>
                                                    <th>Review</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reviews as $key => $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>@if($data->userDetails){{$data['userDetails']['name']}}@endif</td>
                                                    <td>
                                                        @php
                                                        $stars = intval($data->stars);
                                                        @endphp
                                                        <span>
                                                            @for($i=0;$i < $stars ; $i++)
                                                            <i class="fa fa-star" aria-hidden="true" style="color: coral;"></i>
                                                        @endfor </span>
                                                    </td>
                                                    <td>{{$data->reviews}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
