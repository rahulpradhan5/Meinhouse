@extends('admin_jobick.layout.layout')
@section('head_title','Custom Booking >> Create New')
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
                    <h4 class="card-title">Create New</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" name="add-sales" id="add-sales"
                        action="{{ url('admin/create-custom-booking-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            
                            <div class="form-group row mb-2">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <select id="user_id" name="user_id" class="form-control ">
                                        <option value="">Select User Name</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Select Service</label>
                                <div class="col-sm-10">
                                    <select id="service_id" name="service_id" class="form-control ">
                                        <option value="">Select Service Name</option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Select Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="date_picker" name="date" type="date" placeholder="Select Date" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="output mb-2">
                                <div id="red" class="colors red"> 
                                    <div class="form-group row" >
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Select Time</label>
                                        <div class="col-sm-10">
                                            <select name="time" id="time"  tabindex="-1" class="form-control">
                                                <option value="">Select Time</option>
                                                <option value="0">Morning(08:00 AM - 11:00 AM)</option>
                                                <option value="1">Midnoon(11:00 AM - 02:00 PM)</option>
                                                <option value="2">Afternoon(02:00 PM - 05:00 PM)</option>
                                                <option value="3">Evening(05:00 PM - 08:00 PM)</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Custom Amount</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Custom Amount">
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-2">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Select
                                    Professional</label>
                                <div class="col-sm-10">
                                    <select id="pro_id" name="pro_id" class="form-control ">
                                        <option value="">Select Professional Name</option>
                                        @foreach ($pro as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} -
                                                {{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter Address">
                                </div>
                            </div>
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3"
                                    class="col-sm-2 col-form-label">City/Municipality</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter City/Municipality">
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Province</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="Enter Province">
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Postal
                                    Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pin_code"
                                        name="pin_code" placeholder="Enter Postal Code">
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Contact
                                    Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone_no"
                                        name="phone_no" placeholder="Enter Contact Number">
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-2">
                                <label for="inputPassword3"
                                    class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea id="description" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
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
                $('.colors').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
    <script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#date_picker').attr('min',today);
</script>

    <script>
        var today = new Date();
        var tomorrow = new Date();
        tomorrow.setDate(today.getDate() + 1);
        flatpickr("#date", {
            clickOpens: true,
            dateFormat: "d-m-Y",
            minDate: tomorrow,
        });
    </script>
    <script>
        $.validator.methods.alphabetsOnly = function(value, element) {
            if (/^[a-zA-Z ]*$/.test(value) != !0)
                ab = !1;
            else
                ab = !0;
            return ab
        };

        $.validator.methods.customValidation = function(value, element) {

            if (/^\s/.test(value) == !0) ab = !1;
            else ab = !0;
            return ab
        };

        $.validator.methods.PhoneValidation = function(value, element) {
            if (/^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{8,15}$/.test(value) != !0)
                ab = !1;
            else
                ab = !0;
            return ab
        };
        $("#add-sales").validate({

            rules: {

                user_id: {
                    required: true
                },
                service_id: {
                    required: true

                },
                address: {
                    required: true,
                    minlength: 2,
                    maxlength: 70,
                    customValidation: !0,
                },
                locality: {
                    required: true,
                    minlength: 2,
                    maxlength: 70,
                    customValidation: !0,
                },
                city: {
                    required: true,
                    minlength: 2,
                    maxlength: 70,
                    alphabetsOnly: !0,
                    customValidation: !0,
                },
                pin_code: {
                    required: true,
                    minlength: 2,
                    maxlength: 8,
                    customValidation: !0,
                },
                state: {
                    required: true,
                    minlength: 2,
                    maxlength: 70,
                    alphabetsOnly: !0,
                    customValidation: !0,
                },
                phone_no: {
                    required: true,
                    customValidation: !0,
                    PhoneValidation: !0,
                },
                amount: {
                    required: true,
                    digits: true,
                    maxlength: 6,
                },
                description: {
                    required: true,
                    maxlength: 255,
                }


            },

            messages: {

                user_id: {
                    required: "*Please select the user.",
                },
                service_id: {
                    required: "*Please select the service.",
                },
                address: {
                    required: "*Please enter the address.",
                    minlength: "*Address contains atleast 2 characters.",
                    maxlength: "*Address contains maximum 70 characters.",
                    customValidation: "Address cannot be prefix by a space.",
                },
                locality: {
                    required: "*Please enter the locality.",
                    minlength: "*Locality contains atleast 2 characters.",
                    maxlength: "*Locality contains maximum 70 characters.",
                    customValidation: "Locality cannot be prefix by a space.",
                },
                city: {
                    required: "*Please enter the City/Municipality.",
                    minlength: "*City/Municipality contains atleast 2 characters.",
                    maxlength: "*City/Municipality contains maximum 70 characters.",
                    alphabetsOnly: "*City/Municipality contains only alphabets.",
                    customValidation: "City/Municipality cannot be prefix by a space.",

                },
                pin_code: {
                    required: "*Please enter the Postal Code.",
                    minlength: "*Postal Code contains atleast 2 characters.",
                    maxlength: "*Postal Code contains maximum 8 characters.",
                    customValidation: "Postal Code cannot be prefix by a space.",
                },
                state: {
                    required: "*Please enter the Province.",
                    minlength: "*Province contains atleast 2 characters.",
                    maxlength: "*Province contains maximum 70 characters.",
                    alphabetsOnly: "*Province contains only alphabets.",
                    customValidation: "Province cannot be prefix by a space.",
                },
                phone_no: {
                    required: "*Please enter the contact number.",
                    PhoneValidation: "*Please enter a valid contact number",
                    customValidation: "*Contact number cannot be prefix by a space."
                },
                amount: {
                    required: "*Please enter the amount.",
                    digits: "Please enter digits only.",
                    maxlength: "Amount can not be exceed more than 6 digits."
                },
                description: {
                    required: "*Please enter the brief description of the job.",
                    maxlength: "*Description contains maximum 255 characters.",
                },
                pro_id: {
                    required: "*Please select the professional.",
                }



            },
            errorElement: "label",
            wrapper: "label",
            errorPlacement: function(error, element) {
                offset = element.offset();
                error.insertAfter(element)
                error.css('color', 'red');
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }

        });
    </script>
@endsection
