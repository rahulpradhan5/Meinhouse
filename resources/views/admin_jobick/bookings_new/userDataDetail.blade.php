@extends('admin_jobick.layout.layout')
@section('head_title','Booking >> Detail View')

@section('content')
    <div class="row">

        <div class="col-lg-6">

    
        <div class="card">

                <div class="card-header">

                    <h4 class="card-title">Details</h4>

                </div>
<br>
                <div class="card-body">

                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>User Name</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($userData->name) }}

                        </div>

                    </div>

                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>Phone</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($userData->contact) }}

                        </div>

                    </div>

                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>Email</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($userData->email) }}

                        </div>

                    </div>

    <!--                <div class="row mb-2">-->

    <!--                    <div class="col-3">-->

    <!--                        <h5>Service</h5>-->

    <!--                    </div>-->

    <!--                    <div class="col-1"><B>:</B></div>-->

    <!--                    <div class="col-8"><span class="">-->

    <!--                    @if(!empty($userData['services']))-->

    <!--   {{$userData['services']->pluck('name')->implode(', ') }}-->

     

    <!--@endif-->

                       

    <!--                    </span>-->

    <!--                    </div>-->

    <!--                </div>-->
                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>Date of submission</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ Carbon\Carbon::parse($userData->created_at)->format('d M Y') }}

                        </div>

                    </div>
                    @if($ProjectDetails!=NULL)
                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>Project Name</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($ProjectDetails->Name) }}

                        </div>

                    </div>

                  

                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>City</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($ProjectDetails->city) }}

                        </div>

                    </div>
                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>Address</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($ProjectDetails->Address) }}

                        </div>

                    </div>
                    
                    

                    <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>Project time limit</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($ProjectDetails->Time) }}

                        </div>

                    </div>

                  

  <div class="row mb-3 mt-2">

                        <div class="col-5">

                            <h5>Project Description</h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6"><span class=""> {{ ucwords($ProjectDetails->description) }}

                        </div>

                    </div>
                    <div class="row mb-3 mt-2">
<br>
                        <div class="col-5">

                            <h5>Images </h5>

                        </div>

                        <div class="col-1"><B>:</B></div>

                        <div class="col-6 d-flex"><span class=""> 

                        </div>

                    </div>   
                    
                    <div class="row my-1 gallerys">
                        @foreach($Images as $key=>$value)
                        <div class="col-3">
                            
                            <a href="{{asset('public/User_data_uploads')}}/{{$value}}" target="_blank">
                                <div >
                                 
                                        <img src="{{asset('public/User_data_uploads')}}/{{$value}}" class="mb-3 img-thumbnail" style="border-radius:20px;height:100px; width:200px; " >
                                  
                                </div>
                            </a>
                                                                              
                        </div>

                       @endforeach

                      
                           
                    </div>
                  
                  

                  @else



    <div class="row mb-3 mt-2">

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
        
        <div class="col-lg-6">
                    <div class="card">

                <div class="card-header">

                    <h4 class="card-title">Convert to estimate</h4>

                </div>

                <div class="card-body">

                  <form class="form-horizontal" method="POST" name="add-sales" id="add-sales"
                        action="{{ url('admin/create-multiple-estimate-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-5 col-form-label">Title</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="Enter Title"
                                        value="{{$ProjectDetails->Name}}" maxlength="240" disabled style="background-color: rgb(247, 247, 247)">
                                        <input type="hidden" name="title" value="{{$ProjectDetails->Name}}">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-5 col-form-label">User Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="User Name" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $userData->name }}">
                                        <input type="hidden" name="user_id" value="{{ $userData->name }}">
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-5 col-form-label">User Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" placeholder="User Email" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $userData->email }}">
                                        <input type="hidden" name="email" value="{{ $userData->email }}">
                                </div>
                            </div>



                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-5 col-form-label">Address</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="address" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $ProjectDetails->Address }}">
                                        <input type="hidden" name="address" value="{{ $ProjectDetails->Address }}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-5 col-form-label">Street Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="locality" name="locality"
                                        placeholder="Enter Street Name" maxlength="100">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-5 col-form-label">City/Municipality</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="city" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $ProjectDetails->city }}">
                                        <input type="hidden" name="city" value="{{ $ProjectDetails->city }}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-5 col-form-label">Province</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="Enter Province">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-5 col-form-label">Postal Code</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="pin_code" name="pin_code"
                                        placeholder="Enter Postal Code">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="inputPassword3" class="col-sm-5 col-form-label">Contact Number</label>
                                <div class="col-sm-7">
                                    <input type="text"
                                        onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;"
                                        class="form-control" id="phone_no" disabled style="background-color: rgb(247, 247, 247)"
                                        value="{{ $userData->contact }}">
                                        <input type="hidden" name="phone_no" value="{{ $userData->contact }}">
                                </div>
                            </div>
                            
                            <input type="hidden" name="user_data_id" value="{{ $userData->id }}">



<?php
$services=DB::table('services')->where('status',1)->get();
?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row mb-2 increment">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Select Service</label>
                                        <div class="col-sm-6">
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
                                        <label for="inputPassword3" class="col-sm-5 col-form-label">Custom Amount</label>
                                        <div class="col-sm-6">
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
                                        <label for="inputPassword3" class="col-sm-5 col-form-label">Registration
                                            Amount</label>
                                        <div class="col-sm-6">
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
                                        <label for="inputPassword3" class="col-sm-5 col-form-label">Description</label>
                                        <div class="col-sm-6">
                                            <textarea id="description" class="form-control" name="description[]" required placeholder="Enter Description"></textarea>
                                        </div>
                                        <!--<div class="col-sm-1" >-->
                                        <!--    <button class="btn btn-success" id="add4" type="button"><i class="fas fa-plus"></i></button>-->
                                        <!--</div>-->
                                    </div>

                                    <div class="clone hide" hidden>

                                        <div class="hdtuto">
                                            <div class="form-group row mb-2">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label"></label>
                                                <div class="col-sm-6">
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
                                                <label for="inputEmail3" class="col-sm-5 col-form-label"></label>
                                                <div class="col-sm-6">
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
                                                <label for="inputEmail3" class="col-sm-5 col-form-label"></label>
                                                <div class="col-sm-6">
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
                                                <label for="inputEmail3" class="col-sm-5 col-form-label"></label>
                                                <div class="col-sm-6">
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
                            <button type="submit" class="btn btn-info">Convert</button>
                        </div>
                    </form>
                </div>
            

                


            

             

                </div>

            </div>
            
        </div>

    </div>

@endsection

@section('script')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js" integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function() {
    $('.gallerys').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        }
    });
});
</script>

@endsection