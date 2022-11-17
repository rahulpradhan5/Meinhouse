@extends('admin_jobick.layout.layout')
@section('head_title','Professionals >> Edit')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Professionals</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" name="update-service" action="{{url('admin/update-professional')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company name</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="company_name" value="{{$prodetails->company_name}} "required>

                    </div>

                    </div>



                    <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Full Business Address</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="business_address"
                            value="{{$prodetails->business_address}}">

                        <input type="hidden" class="form-control" id="editId" name="editId" value="{{$prodetails->id}}">

                        <input type="hidden" class="form-control" id="editId" name="pro_id" value="{{$prodetails->pro_id}}">

                    </div>

                    </div>









                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Business Phone No</label>

                    <div class="col-sm-10">

                      <input type="text" class="form-control" id="name" name="phone_no" value="{{$prodetails->phone_no}}"required>

                    </div>

                  </div>

                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="nme" name="name" value="{{$users->name}}" required>

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="address"
                            value="{{$prodetails->address}}" required>

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">City/Municipality</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="city" value="{{$prodetails->city}}"required>

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Province</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="province"
                            value="{{$prodetails->province}}"required>

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Postal Code</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="postal_code"
                            value="{{$prodetails->postal_code}}"required>

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Experience</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="experience"
                            value="{{$prodetails->experience}}"required>

                    </div>

                </div>





                <div class="form-group ">

                    <div class="col-sm-2 col-form-label">

                        <label class="wrapper" for="states">Vehicle Owner</label>

                    </div>

                    <div class="col-sm-10">

                        <div>

                            <select id="colorselector" name="vehicle_owner" class="form-control">
                                @if($prodetails->vehicle_owner=='1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @else
                                    <option  value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @endif
                            </select>

                        </div>

                    </div>

                </div>







                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Insurance Doc</label>

                    <div class="col-sm-10">

                        <input type="file" class="form-control" name="passport_loc" id="file1" accept="application/pdf,application/vnd.ms-excel,image/x-png,image/gif,image/jpeg">

                        <input type="text" hidden name="OLDpassport_loc" value="{{$prodetails->insurance}}">



                    </div>

                </div>

                <!-- <img src="{{url('prosdoc/'.$prodetails->insurance)}}" width="50px" style="border-radius:50%"> -->







                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Distance</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="distance"
                            value="{{$prodetails->distance}}">

                    </div>

                </div>





                <div class="form-group ">

                    <div class="col-sm-2 col-form-label">

                        <label class="wrapper" for="states">Criminal Offence</label>

                    </div>

                    <div class="col-sm-10">

                        <div>

                            <select id="colorselector" name="criminal_offence" class="form-control">

                                @if($prodetails->criminal_offence=='1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                @else
                                    <option  value="1">Yes</option>
                                    <option selected value="0">No</option>
                                @endif

                            </select>

                        </div>

                    </div>

                </div>



                <div class="form-group ">

                    <div class="col-sm-2 col-form-label">

                        <label class="wrapper" for="states">Payment Status</label>

                    </div>

                    <div class="col-sm-10">

                        <div>

                            <select id="colorselector" name="is_payment" class="form-control">
                                @if($users->is_payment=='1')
                                    <option selected value="1">Payment Done</option>

                                    <option value="0">Payment Not Done</option>
                                @else
                                    <option value="1">Payment Done</option>

                                    <option selected value="0">Payment Not Done</option>
                                @endif
                            </select>

                        </div>

                    </div>

                </div>



                <h3 class="top-text">Account/Company Information</h3>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">EIN Number</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="ein_no" value="{{$prodetails->ein_no}}">

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Account First Name</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="acc_first_name"
                            value="{{$prodetails->acc_first_name}}">

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Account Last Name</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="acc_last_name"
                            value="{{$prodetails->acc_last_name}}">

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">SSN Number</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="ssn_no" value="{{$prodetails->ssn_no}}">

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Date of Birth</label>

                    <div class="col-sm-10">

                        <input type="date" class="form-control" id="name" name="dob" value="{{$prodetails->dob}}">

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Routing Number</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="routing_no"
                            value="{{$prodetails->routing_no}}">

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Account Number</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="account_no"
                            value="{{$prodetails->account_no}}">

                    </div>

                </div>



                <h3 class="top-text">Add License certification</h3>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">License Number</label>

                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="license_no"
                            value="{{$prodetails->license_no}}">

                    </div>

                </div>



                <div class="form-group ">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">License Doc</label>

                    <div class="col-sm-10">

                        <input type="file" class="form-control" name="file" id="file" accept="application/pdf,application/vnd.ms-excel,image/x-png,image/gif,image/jpeg">

                        <input type="text" hidden name="OldImg" value="{{$prodetails->license_doc}}">



                    </div>

                </div>

                <!-- <img src="{{url('prosdoc/'.$prodetails->license_doc)}}" width="50px" style="border-radius:50%"> -->



            </div>

            <!-- /.card-body -->

            <div class="card-footer">

                <button type="submit" class="btn btn-info">Update Now</button>

            </div>

            </form>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
