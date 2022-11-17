@extends('admin_jobick.layout.layout')
@section('head_title','Project >> Edit')
@section('content')
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Project Detail</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" name="update-service"
                        action="{{url('admin/multiple-estimate/edit-post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">User Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="user_id"
                                    placeholder="User name" value="{{ucwords($data[0]->name)}}" required>
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">User Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="name" name="email"
                                    placeholder="User Email" value="{{ucwords($data[0]->email)}}" required>
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Select Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mdate" name="date"
                                    placeholder="{{ $data[0]->date }}">
                                    <!--value="<?php if(empty($data[0]->date)){echo "Null";}else{echo $data[0]->date;}?>"-->
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Address" value="{{ucwords($data[0]->address)}}" required>
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">City/Municipality</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City/Municipality" required value="{{$data[0]->city}}">
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Province</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter Province" required value="{{$data[0]->state}}">
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Postal Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pin_code" name="pin_code" placeholder="Enter Postal Code" required value="{{$data[0]->pincode}}">
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Contact Number" required value="{{$data[0]->phone_no}}">
                            </div>
                        </div>
                        
                        @foreach ($ms_filter as $key => $mf)
                            <input type="hidden" name="est_id[]" value="{{ $mf->estimate_id }}">
                            <input type="hidden" name="child_id[]" value="{{ $mf->id }}">
                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label"><i class="fas fa-circle fa-sm"
                                        style="color:#bdc3c7"></i>&nbsp; Select Service</label>
                                <div class="col-sm-10">
                                    <select id="service_id" name="service_id[]" class="form-control" required>
                                        <!--<option value="">Select Service Name</option>-->
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                @if ($service->id == $mf->service_id) selected @endif>{{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Custom Amount</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $mf->amount }}"
                                        onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                        class="form-control" id="amount" name="amount[]"
                                        placeholder="Enter Custom Amount" required>
                                </div>
                            </div>

                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label" style="white-space: nowrap">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration Amount</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $mf->reg_amount }}"
                                        onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                        class="form-control" id="reg_amount" name="reg_amount[]"
                                        placeholder="Enter Registration Amount" min="1" required>
                                </div>
                            </div>

                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description</label>
                                <div class="col-sm-10">
                                    <textarea id="description" class="form-control" name="description[]" required>{{ $mf->description }}</textarea>
                                </div>
                            </div>
                        @endforeach

                        <input type="hidden" name="booking_id" value="{{$data[0]->booking_show_id}}">
                        <input type="hidden" name="e_id" value="{{$data[0]->id}}">
                        <input type="hidden" name="est_title" value="{{$data[0]->title}}">

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function() {
            $('#colorselector').change(function() {
                $('.timees').hide();
                $('.colors').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
    
@endsection
