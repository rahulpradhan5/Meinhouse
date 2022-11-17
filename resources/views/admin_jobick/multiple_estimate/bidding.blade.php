@extends('admin_jobick.layout.layout')
@section('head_title','Estimate >> Bidding')
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
                    <h4 class="card-title">Bidding</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" name="add-sales" id="add-sales"
                        action="{{ url('admin/multiple-bidding-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Booking ID</b></label>
                                <div class="col-sm-10 mt-1">
                                    <font color="red"><b>{{ $booking_id }}</b></font>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Service Name</b></label>
                                <div class="col-sm-10 mt-1">
                                    <font color="red"><b><?php $service = DB::table('services')->where('id',$data[0]->service_id)->get(); echo $service[0]->name; ?></b></font>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Project
                                        Description</b></label>
                                <div class="col-sm-10 mt-1">
                                    <font color="red"><b>{{ ucfirst($data[0]->description) }}</b></font>
                                </div>
                            </div>

                            <style>
                                .select2-selection__choice {
                                    color: black !important;
                                }
                            </style>
                            <div class="form-group row mb-3">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Assign
                                        Direct</b></label>
                                <div class="col-sm-10">

                                    <select class="multi-select" name="professional[]" multiple="multiple" required
                                        id="check_pro">
                                        <?php

                                        $pro = DB::table('users')
                                            ->where('role_id', 3)
                                            ->get(['id', 'name']);
                                        $pro_check = DB::table('multiple_estimates_bidding')
                                            ->where('mest_service_id', $data[0]->id)
                                            ->get(['proff_id']);

                                        // $t = App\User::select("*")
                                        // ->whereDoesntHave('clearing')
                                        // ->get();

                                        // $pro = App\User::whereDoesntHave('clearing')->get();

                                        // $pro = DB::table('users')->leftJoin('estimates_bidding', 'users.id', "=", 'estimates_bidding.proff_id')
                                        // ->where('estimates_bidding.booking_id', $data[0]->booking_show_id)->where('users.id','!=','estimates_bidding.proff_id')
                                        // ->get(array('users.id','users.name'));

                                        // $t = DB::table('users AS u1')->select('u1.id','u1.name')->join('estimates_bidding AS e2','e2.proff_id','=','u1.id')->whereNull('e2.proff_id')->get();

                                        ?>

                                        @foreach ($pro as $key => $value)
                                            <option value="{{ $value->id }}">{{ ucwords($value->name) }}</option>
                                        @endforeach

                                    </select>

                                    <script>
                                        @foreach ($pro_check as $pc)
                                            // console.log({{ $pc->proff_id }});
                                            for (var oo of document.querySelectorAll('#check_pro > option')) {
                                                // console.log(oo.value,{{ $pc->proff_id }})
                                                if (oo.value == {{ $pc->proff_id }}) {
                                                    oo.remove();
                                                }
                                            }
                                        @endforeach
                                    </script>

                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Pro Amount</b></label>
                                <div class="col-sm-10">
                                    <!--<select class="form-control" name="customamount" id="" required>-->
                                    <!--    <option selected disabled>Select Professional Amount</option>-->
                                    <!--    <option value="0 to 5,000">0 to 5,000</option>-->
                                    <!--    <option value="5,000 to 20,000">5,000 to 20,000</option>-->
                                    <!--    <option value="20,000 to above">20,000 to above</option>-->
                                    <!--</select>-->
                                    <input type="text" class="form-control" name="customamount" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" maxlength="20" required placeholder="Enter Professional Amount">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Start Date</b></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="txtDate" name="sdate" required
                                        placeholder="Select Start Date">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Attachment</b></label>
                                <?php $usr_data_att = DB::table('multiple_estimate')->where('booking_show_id',$booking_id)->first();?>
                                @if($usr_data_att->user_data_id!=NULL)
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="attachment[]" multiple>
                                </div>
                                
                                <?php $usr_data_img = DB::table('user_data_images')->where('user_data_id',$usr_data_att->user_data_id)->count();?>
                                <div class="col-sm-2">
                                    <span class="btn text-danger btn-sm mt-2 rounded-none" disabled style="background-color: rgb(247, 247, 247)"><b><i class="fas fa-check text-success"></i>&nbsp; {{ $usr_data_img }} Attached</b></span>
                                </div>
                                @else
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="attachment[]" multiple>
                                </div>
                                @endif
                                
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Locality /
                                        Area</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="locality"
                                        placeholder="Enter Locality / Area">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Notes</b></label>
                                <div class="col-sm-10">
                                    <textarea row="5" cols="20" class="form-control" name="notes" required placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                        <input type="hidden" name="mest_service_id" value="{{ $data[0]->id }}">



                        <?php
                        $check = DB::table('multiple_estimate_professionals')
                            ->where('mest_service_id', $data[0]->id)
                            ->where('status', 1)
                            ->exists();
                        ?>
                        @if ($check == null)
                            <center><button type="submit" class="btn btn-info" style="width:90px;">Finish</button>
                            </center>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    
    $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);

    
    $('#txtDate').attr('min', maxDate);
});
</script>