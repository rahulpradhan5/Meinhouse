@extends('admin_jobick.layout.layout')
@section('head_title','Estimate >> Professional Assignment')
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
    <?php
    $check = DB::table('multiple_estimate_professionals')
        ->where('mest_service_id', $data[0]->id)
        ->where('status', 1)
        ->exists();
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Professional Assignment</h4>
                </div>
                <div class="card-body">

                    <form class="form-horizontal" method="POST" name="add-sales" id="add-sales"
                        action="{{ url('admin/assign-service-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Booking
                                        ID</b></label>
                                <div class="col-sm-10 mt-1">
                                    <font color="red"><b>{{ $bookingId }}</b></font>
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

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Assign
                                        Direct</b></label>
                                <div class="col-sm-10">
                                    <select name="professional" class="form-control" required>
                                        <?php
                                        $pro = DB::table('users')
                                            ->where('role_id', 3)
                                            ->get(['id', 'name']);
                                        ?>
                                        @foreach ($pro as $key => $value)
                                            <option value="{{ $value->id }}">{{ ucwords($value->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Pro
                                        Amount</b></label>
                                <div class="col-sm-10">
                                    <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" class="form-control" name="customamount" maxlength="20" required
                                        placeholder="Enter Professional Amount">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Start
                                        Date</b></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="sdate" id="date_picker" required
                                        placeholder="Select Start Date">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Notes</b></label>
                                <div class="col-sm-10">
                                    <textarea row="5" cols="20" class="form-control" name="notes" required placeholder="Enter Description"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Attachment</b></label>
                                <?php $usr_data_att = DB::table('multiple_estimate')->where('booking_show_id',$bookingId)->first();?>
                                @if($usr_data_att->user_data_id!=NULL)
                                <div class="col-sm-8">
                                    <input type="file" required class="form-control" name="attachment">
                                </div>
                                
                                <?php $usr_data_img = DB::table('user_data_images')->where('user_data_id',$usr_data_att->user_data_id)->count();?>
                                <div class="col-sm-2">
                                    <span class="btn text-danger btn-sm mt-2 rounded-none" disabled style="background-color: rgb(247, 247, 247)"><b><i class="fas fa-check text-success"></i>&nbsp; {{ $usr_data_img }} Attached</b></span>
                                </div>
                                @else
                                <div class="col-sm-10">
                                    <input type="file" required class="form-control" name="attachment">
                                </div>
                                @endif
                            </div>

                            <?php $address_book = DB::table('multiple_estimate')
                                ->where('id', $data[0]->estimate_id)
                                ->get(); ?>
                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Address</b></label>
                                <div class="col-sm-10">
                                    <input type="text" maxlength="240" class="form-control"
                                        value="{{ $address_book[0]->address }}" disabled style="background-color: rgb(247, 247, 247)">
                                    <input type="hidden" value="{{ $address_book[0]->address }}" name="address">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1"
                                    class="col-sm-2 col-form-label"><b>City/Municipality</b></label>
                                <div class="col-sm-10">
                                    <input type="text" maxlength="240" class="form-control"
                                        value="{{ $address_book[0]->city }}" disabled style="background-color: rgb(247, 247, 247)">
                                    <input type="hidden" value="{{ $address_book[0]->city }}" name="city">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Province</b></label>
                                <div class="col-sm-10">
                                    <input type="text" maxlength="240" class="form-control"
                                        value="{{ $address_book[0]->state }}" disabled style="background-color: rgb(247, 247, 247)">
                                    <input type="hidden" value="{{ $address_book[0]->state }}" name="province">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><b>Postal
                                        Code</b></label>
                                <div class="col-sm-10">
                                    <input type="text" maxlength="7" class="form-control"
                                        value="{{ $address_book[0]->pincode }}" disabled style="background-color: rgb(247, 247, 247)">
                                    <input type="hidden" value="{{ $address_book[0]->pincode }}" name="postal_code">
                                </div>
                            </div>

                            <input type="hidden" name="booking_id" value="{{ $address_book[0]->booking_show_id }}">
                            <input type="hidden" name="mest_service_id" value="{{ $data[0]->id }}">


                        </div>

                        @if ($check == null)
                            <div class="card-footer">
                                <center><button type="submit" class="btn btn-info">Finish</button></center>
                            </div>
                        @endif

                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
         var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#date_picker').attr('min',today);
    </script>
@endsection
