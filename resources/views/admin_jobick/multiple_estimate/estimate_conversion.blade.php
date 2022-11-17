@extends('admin_jobick.layout.layout')
@section('head_title','Convert Into Estimate')
<?php error_reporting(0);?>
@section('content')
     
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                 @error('user_id')
                                <li style="color:red;">The name must not contain any numbers,special characters</li>
                                @enderror
                                
                                  @error('title')
                                <li style="color:red;">{{$message}}</li>
                                @enderror
                                  @error('phone_no')
                                <li style="color:red;">{{$message}}</li>
                                @enderror
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Estimate</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" name="add-sales" id="add-sales"
                        action="{{ url('admin/create-multiple-estimate-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter Title"
                                        value="{{$ProjectDetails->Name}}" maxlength="240" disabled style="background-color: rgb(247, 247, 247)">
                                        <input type="hidden" name="title" value="{{$ProjectDetails->Name}}">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="User Name" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $userData->name }}">
                                        <input type="hidden" name="user_id" value="{{ $userData->name }}">
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label">User Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="User Email" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $userData->email }}">
                                        <input type="hidden" name="email" value="{{ $userData->email }}">
                                </div>
                            </div>



                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $ProjectDetails->Address }}">
                                        <input type="hidden" name="address" value="{{ $ProjectDetails->Address }}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Street Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="locality" name="locality"
                                        placeholder="Enter Street Name" maxlength="100">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">City/Municipality</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="city" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $ProjectDetails->city }}">
                                        <input type="hidden" name="city" value="{{ $ProjectDetails->city }}">
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
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Postal Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pin_code" name="pin_code"
                                        placeholder="Enter Postal Code">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                        class="form-control" id="phone_no" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $userData->contact }}">
                                        <input type="hidden" name="phone_no" value="{{ $userData->contact }}">
                                </div>
                            </div>
                            
                            <input type="hidden" name="user_data_id" value="{{ $userData->id }}">





                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row mb-2 increment">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Select Service</label>
                                        <div class="col-sm-9">
                                            <select id="service_id" name="service_id[]" class="form-control" required>
                                                <option value="">Select Service Name</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-success btn-xs mt-3 sharp" id="add" type="button"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>




                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row increment2 mb-2">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Custom Amount</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                                class="form-control" id="amount" name="amount[]"
                                                placeholder="Enter Custom Amount" required>
                                        </div>
                                        <!--<div class="col-sm-1" >-->
                                        <!--    <button class="btn btn-success" id="add2" type="button"><i class="fas fa-plus"></i></button>-->
                                        <!--</div>-->
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row increment3 mb-2">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Registration
                                            Amount</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                                class="form-control" id="reg_amount" name="reg_amount[]"
                                                placeholder="Enter Registration Amount" min="1" required>
                                        </div>
                                        <!--<div class="col-sm-1" >-->
                                        <!--    <button class="btn btn-success" id="add3" type="button"><i class="fas fa-plus"></i></button>-->
                                        <!--</div>-->
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row increment4 mb-2">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea id="description" class="form-control" name="description[]" required placeholder="Enter Description"></textarea>
                                        </div>
                                        <!--<div class="col-sm-1" >-->
                                        <!--    <button class="btn btn-success" id="add4" type="button"><i class="fas fa-plus"></i></button>-->
                                        <!--</div>-->
                                    </div>

                                    <div class="clone hide" hidden>

                                        <div class="hdtuto">
                                            <div class="form-group row mb-2">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <select id="service_id" name="service_id[]"
                                                        class="myfrm form-control">
                                                        <option value="">Select Service Name</option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger btn-xs sharp mt-3" id="remove" type="button"><i
                                                            class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="clone2 hide" hidden>
                                        <div class="hdtuto2">
                                            <div class="form-group row mb-2">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                                        class="form-control" id="amount" name="amount[]"
                                                        placeholder="Enter Custom Amount">
                                                </div>

                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger" hidden id="remove2"
                                                        type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clone3 hide" hidden>
                                        <div class="hdtuto3">
                                            <div class="form-group row mb-2">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                                        class="form-control" id="amount" name="reg_amount[]"
                                                        placeholder="Enter Registration Amount" min="1">
                                                </div>

                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger" hidden id="remove3"
                                                        type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clone4 hide" hidden>
                                        <div class="hdtuto4">
                                            <div class="form-group row mb-2">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <textarea id="description" class="form-control" name="description[]" placeholder="Enter Description"></textarea>
                                                </div>

                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger" hidden id="remove4"
                                                        type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                            <script type="text/javascript">
                                $(document).ready(function() {

                                    $("#add").click(function() {
                                        var lsthmt1 = $(".clone").html();
                                        var lsthmt2 = $(".clone2").html();
                                        var lsthmt3 = $(".clone3").html();
                                        var lsthmt4 = $(".clone4").html();

                                        $(".increment4").after(lsthmt4);
                                        $(".increment4").after(lsthmt3);
                                        $(".increment4").after(lsthmt2);
                                        $(".increment4").after(lsthmt1);


                                    });
                                    $("body").on("click", "#remove", function() {
                                        $(this).parents(".hdtuto").remove();
                                        $("#remove2").parents(".hdtuto2").remove();
                                        $("#remove3").parents(".hdtuto3").remove();
                                        $("#remove4").parents(".hdtuto4").remove();
                                    });
                                });
                            </script>







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