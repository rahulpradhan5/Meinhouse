@extends('admin_jobick.layout.layout')
@section('head_title','Project >>  Multiple Invoice >> Create New')
@section('content')
      
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Invoice</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" name="update-service"
                        action="{{url('admin/create-multiple-estimate-invoice-post')}}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-2">
                            <div class="col-2">
                                <h5>Project Title</h5>
                            </div>
                            <!--<div class="col-1"><B>:</B></div>-->
                            <div class="col-10 me-auto"><font color="red"><b>{{ $data[0]->title }}</b></font></div>
                        </div>
                        @foreach ($ms_filter as $key => $mf)
                            <input type="hidden" name="est_id[]" value="{{ $mf->estimate_id }}">
                            <input type="hidden" name="child_id[]" value="{{ $mf->id }}">
                            <input type="hidden" name="service_id[]" value="{{ $mf->service_id }}">
                            <input type="hidden" name="description[]" value="{{ $mf->description }}">
                            <input type="hidden" name="inv_booking_id[]" value="{{$data[0]->booking_show_id}}">
                            
                            <h6 class="mt-4 mb-3"><b>Item #{{ $key+1 }}</b></h6>
                            
                            <div class="row mb-2">
                                <div class="col-2">
                                    <h6>Service Type</h6>
                                </div>
                                <!--<div class="col-1"><B>:</B></div>-->
                                <div class="col-10 me-auto"><font color="red"><b><?php $service_name = DB::table('services')->where('id',$mf->service_id)->get(); echo $service_name[0]->name; ?></b></font></div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-2">
                                    <h6>Project Description</h6>
                                </div>
                                <!--<div class="col-1"><B>:</B></div>-->
                                <div class="col-10 me-auto"><font color="red"><b>{{ $mf->description }}</b></font></div>
                            </div>
                            
                            <?php
                            
                            $var1 = DB::table('multiple_estimate_invoices')->where('booking_id',$data[0]->booking_show_id)->where('payment_status',1);
                            $var2 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('service',$mf->service_id)->where('payment_status',1)->sum('invoice_amount');
                            $check = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('service',$mf->service_id)->where('payment_status',1)->exists();
                            $var4 = DB::table('multiple_estimate_services')->where('estimate_id',$id)->where('service_id',$mf->service_id)->first();
                            $var5 = '';
                            if($check && $var4->paying_status==1)
                            {
                                $var5 = $var2 + $mf->reg_amount;
                            }
                            elseif($check && $var4->paying_status==0)
                            {
                                $var5 = $var2;
                            }
                            elseif(empty($check) && $var4->paying_status==1)
                            {
                                $var5 = $mf->reg_amount;
                            }
                            else
                            {
                                $var5 = 0;
                            }
                            
                            
                            ?>
                            
                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Total Previously Paid</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $var5 }}" class="form-control" disabled style="background-color: rgb(247, 247, 247)">
                                    <input type="hidden" value="{{ $var5 }}" class="form-control" name="reg_amount[]">
                                </div>
                            </div>
                            
                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Total Price</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $mf->amount }}" class="form-control" disabled style="background-color: rgb(247, 247, 247)">
                                    <input type="hidden" value="{{ $mf->amount }}" class="form-control" name="amount[]">
                                </div>
                            </div>
                            
                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">New Invoice Amount</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" name="invoice_amount[]" placeholder="Enter Invoice Amount">
                                </div>
                            </div>
                            
                        @endforeach
                        
                        
                        <div class="form-group mb-2 row mt-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label"><b>Notes</b></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="note" placeholder="Write Notes..." required></textarea>
                            </div>
                        </div>
                        

                        <input type="hidden" name="booking_id" value="{{$data[0]->booking_show_id}}">
                        <input type="hidden" name="e_id" value="{{$data[0]->id}}">
                        <input type="hidden" name="est_title" value="{{$data[0]->title}}">
                        <input type="hidden" name="email" value="{{$data[0]->email}}">
                        
                        

                        <div class="card-footer me-0">
                            <!--<button type="submit" name="action" value="Send Email" class="btn btn-primary">Send Email</button>-->
                            <button type="submit" name="action" value="Save" class="btn btn-info ms-1">Send Invoice</button> 
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