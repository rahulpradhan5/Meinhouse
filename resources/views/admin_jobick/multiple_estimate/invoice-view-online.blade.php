<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width; initial-scale=1.0">

    <title>Meinhaus Invoice</title>

    <link rel="icon" href="Images/titleLogo.png" type="image/x-icon">

    <link rel="stylesheet" href="app.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"

        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"

        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<style>

    .upperTable th,

    .upperTable td {

        /*border: 1px solid rgb(51 51 51 / 20%);*/

        padding: 10px;

    }

    table{
    border: 1px solid rgb(51 51 51 / 20%);;
}

    th,

    td {

        padding: 10px 30px;

        font-weight: 500;
        text-align: center;

    }



    .upperTable th {

        color: white;

        text-align: center;

        background-color: #541a1a;

    }

    

    #pay_btn

    {

        

        /*margin: 25px auto;*/

        background: #136acd;

        border-radius: 200px;

        padding: 10px 25px;

        border: none;

        margin-left:20%;

    }

    #pay_btn a:hover{color: #fff;}

    #pay_btn a{color: #fff;text-decoration: none;}

    

</style>



<body>

    <?php error_reporting(0);?>

    <section class="container-lg container-fluid my-4 px-lg-5 px-3 px-md-4">

        <div class="px-lg-5">

            <div>

                <div

                    class="justify-content-lg-end justify-content-md-end justify-content-sm-end justify-content-center d-flex mb-4">

                    <a onclick="generatePDF()" href="javascript:;" class="btn btn-danger"><span

                            class="fa fa-download text-white"></span>&nbsp;Download pdf</a>

                </div>

                <div class="row">

                    <div class="col">

                        <div class="">

                            <img src="{{ url('public/image/logo-img.png') }}"

                                style="width: 12rem;" alt="" class="img-fluid my-2">

                            <div class="mb-3" style="font-size: 22px;font-weight: bolder;">Online

                                General

                                Contractor </div>

                        </div>

                        <ul class="list-unstyled my-lg-0 my-md-0 mt-4">

                            <li class="py-0.5"><b>Erik</b></li>
                            <li class="py-0.5">320, Hillside Drive</li>
                            <li class="py-0.5">Mississauga</li>
                            <li class="py-0.5">Ontario,L5M2L7</li>
                            <li class="py-0.5">6478079460</li>

                            <li class="">E.sommerfeld@outlook.com</li>

                        </ul>

                    </div>

                    <!-- <div class="col my-lg-0 my-md-0 my-sm-0 my-4 mx-lg-0 mx-md-0 mx-sm-4 justify-content-center d-flex">

                    <div style="border: 2px solid black;height:140px;width:150px ;">

                        <div class="text-center">(Happy Tradesman Photo)</div>

                    </div>

                </div> -->

                    <div class="col">

                        <div class="" style="text-align: right;font-size: 30px;"><b>INVOICE</b></div>

                        <ul class="list-unstyled" style="text-align: right;">

                            <li>{{ $booking_id }}</li>

                            <li class="py-3"><b>MeinHaus</b></li>

                            <li>Online General Contractor</li>

                            <li>251 Queen Street South Mississauga, ONL5M1L2</li>

                            <li class="pb-3">Canada</li>

                            <li>1(844)777-4287</li>

                            <li>www.meinhaus.ca</li>

                        </ul>

                    </div>

                </div>



            </div>



            <div class="justify-content-center d-flex align-items-center my-5">

                <div class="" style="width:100%; overflow-x:overlay">

                    <table class="upperTable w-100">

                        <tr>

                            <th>Project Area</th>

                            <th>Description</th>

                            <th>Item Total</th>

                            <th>Previously Paid</th>

                            <th>Due Now</th>

                            <th>Due Later</th>

                        </tr>

                        @foreach ($ms_filter as $key => $mf)

                        

                        <?php

                        

                            $check = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('service',$mf->service_id)->where('payment_status',1)->exists();

                            $var3 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('service',$mf->service_id)->first();

                            $var2 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('service',$mf->service_id)->where('payment_status',1)->sum('invoice_amount');

                            // $var4 = "";

                            // if($check) {$var4 = $var3->invoice_amount + $mf->reg_amount;} 

                            // else {$var4 = $mf->reg_amount;}

                            // $var5 = $var4 - $var3->invoice_amount;

                            $var4 = DB::table('multiple_estimate_services')->where('estimate_id',$id->id)->where('service_id',$mf->service_id)->first();

                            // echo $var4->service_id;

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

                            $var6aa = $var5 + $var3->invoice_amount;

                            $var6bb = $mf->amount-$var6aa;

                            

                        ?>

                        

                        <tr>

                            <td><?php $service_name = DB::table('services')->where('id',$mf->service_id)->get(); echo $service_name[0]->name; ?></td>

                            

                            <td class="text-danger">

                                {{ ucfirst(substr($mf->description,0,20)) }}@if (strlen($mf->description)>20)...

                               <a href="javascript:;" style="color:#136acd;text-decoration: none; font-size: 12px"

                               onclick="document.getElementById('id01{{$mf->id}}').style.display='block'" class="text-primary">Read More</a> @endif

                                <!--{{ $mf->description }}----------------->

                                <!--<span class="text-primary">-->

                                <!--    Read More-->

                                <!--</span>-->

                            </td>

                            

                            <div id="id01{{ $mf->id }}" class="w3-modal">

                                <div class="w3-modal-content">

                                    <div class="w3-container">

                                        <span

                                            onclick="document.getElementById('id01{{ $mf->id }}').style.display='none'"

                                            class="w3-button w3-display-topright">&times;</span>

                                        <h5><b>Description</b></h5>

                                        <p style="overflow-wrap: break-word;">{{ ucfirst($mf->description) }}</p>

                                        <br>

                                    </div>

                                </div>

                            </div>

                            

                            <td>${{ number_format($mf->amount,2) }}</td>

                            <td>${{ number_format($var5,2) }}</td>

                            <td>${{ number_format($var3->invoice_amount,2) }}</td>

                            <td>${{ number_format($var6bb,2) }}</td>

                        </tr>

                        @endforeach

                    </table>

                </div>

            </div>

            <hr style="height:5px; background-color:  red;">

            </hr>

            

            <?php

            

            use App\Models\MultipleEstimate;

            use App\Models\MultipleEstimateServices;

            $est_filter = MultipleEstimate::where('booking_show_id', $booking_id)->first();

            $pro_total = MultipleEstimateServices::where('estimate_id',$est_filter->id)->sum('amount');

            $var6 = MultipleEstimateServices::where('estimate_id',$est_filter->id)->sum('reg_amount');

            $var7 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('payment_status',1)->sum('invoice_amount');

            $var8 = $var6 + $var7;

            $var9 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('payment_status',0)->sum('invoice_amount');

            $var11 = $pro_total - $var8;

            $var12 = $var11 + 0.57;

            

            $var6a = DB::table('multiple_estimate_services')->where('estimate_id',$est_filter->id)->where('paying_status',1)->sum('reg_amount');

            $var6b = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('payment_status',1)->sum('invoice_amount');

            $var7a = $var6a + $var6b;



            ?>

            

            <div class=""><b>Notes: {{ $notes }}</b></div>

            <div class="justify-content-center d-flex align-items-center my-5">

                <div class="" style="width:100%; overflow-x:overlay">

                    <table class="w-100">

                        <tr>

                            <th class="" style="font-size: 20px; color: #541a1a;"><b>Invoice Summary</b></th>

                            <th class="" style="font-size: 20px; color: #541a1a;"><b>Payment History</b></th>

                            <th class="" style="font-size: 20px; color: #541a1a;"><b>Payable</b></th>

                        </tr>

                        <tr>

                            <td>Project Total: ${{ number_format($pro_total,2) }}</td>

                            <td>HST (HST NUMBER): $2.60</td>

                            <td>Grand Total: ${{ number_format($pro_total+2.60,2) }}</td>

                        </tr>

                        <tr>

                            <td>Previously Paid: ${{ number_format($var7a,2) }}</td>

                            <td>HST (HST NUMBER): $0.52</td>

                            <td>Grand Total: ${{ number_format($var7a+0.52,2) }}</td>

                        </tr>

                        <tr>

                            <td>Due Now: ${{ number_format($var9,2) }}</span></td>

                            <td>HST (HST NUMBER): $0.94</td>

                            <td>Grand Total: ${{ number_format($var9+0.94,2) }}</td>

                        </tr>

                    </table>

                </div>

            </div>

            <?php $check_pay_status = DB::table('multiple_estimate_invoices')->where('booking_id',$data[0]->booking_show_id)->where('id',$invoice_id)->first();?>

            <form action="{{url('multiple-estimate-invoice-view-online-payment-post/'.$invoice_id.'/'.$data[0]->booking_show_id)}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_test_51LZVObSBB4uLDn3soOtn35F6RzvKHwZL5l367GvWWD0EV2k5M0i1d1uWH8TG10X6YQNLI5liWMgqRhzI1uVa4Jby00By4FBbLw" id="payment-form">

            @csrf

            <div class=""><b>Pay with credit or debit card</b>

            @if($check_pay_status->payment_status == 0)

            <button class="" id="pay_btn" type="submit" 

              style="font-size:12px;text-decoration: none; color:white; cursor: -webkit-grab; cursor: grab;font-weight:bold;">Pay</button>@endif

              </div>

            <div class="row mt-4">

                <div class="col-lg-6 col-md-6 col-12">

                    

                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">

                                <input type="text" id="name" name="name" class='form-control' maxlength="100" placeholder="Name on card" />

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">

                                <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" id="card" name="card" placeholder="Card Number" class="form-control card-number" />

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">

                                <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" maxlength="3" id="cvv" name="cvv" placeholder="CVV" class="form-control card-cvc" />

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">

                                <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" maxlength="2" id="mm" name="mm" placeholder="MM" class="form-control card-expiry-month" />

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">

                                <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" id="yy" maxlength="4" name="yy" placeholder="YYYY" class="form-control card-expiry-year" />

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">

                                <input type="text" class="form-control" placeholder="${{ number_format($var9+0.94,2) }}" readonly disabled style="cursor:not-allowed"/>

                                <input type="hidden" name="amount" class="form-control" value="{{ $var9+0.94 }}"/>

                            </div>

                        </div>

                        <div class="d-flex my-3"> <input type="checkbox" style="width: 15px; cursor:pointer"

                                class="form-check" /><span>&nbsp;Save this card and

                                allow

                                MeinHaus

                                to</span></div>

                    </form>

                </div>

                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-sm-0 mb-4 justify-content-center d-flex">

                    <b>Balance Remaining <span style="font-size: 12px;">Incl HST</span>: ${{ number_format($var12,2) }}</b>

                </div>



            </div>

        </div>

        <footer class="px-lg-5 mt-4">

            <!--<p style="text-align: justify;">This amount is to be paid for the purpose of booking your project and-->

            <!--    getting scheduled with our team members. This deposit will be held in trust by MeinHaus Online General-->

            <!--    Contractor and not released to the service providers until satisfactory progress has been achieved.-->

            <!--    Deposit is refundable with fees where applicable. Purchase of project indicates you have read and agree-->

            <!--    with our <a href="https://meinhaus.ca/termsandconditions" style="font-weight: 500;">Terms of Use</a></p>-->

            <div class="text-center mt-4">

                <img src="http://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 12rem;" alt=""

                    class="img-fluid my-2">

                <div class="mb-3 text-center" style="font-size: 22px;font-weight: 500;">Online

                    General

                    Contractor </div>

            </div>

        </footer>

    </section>

    

    

    <section class="container-fluid" id="invoice" style="width:90%" hidden>

        <div class="">

            <div>

                <div class="row">

                    <div class="col">

                        <div class="">

                            <img src="{{ url('public/image/logo-img.png') }}"

                                style="width: 12rem;" alt="" class="img-fluid my-2">

                            <div class="mb-3" style="font-size: 22px;font-weight: bolder;">Online

                                General

                                Contractor </div>

                        </div>

                        <ul class="list-unstyled my-lg-0 my-md-0 mt-4">

                            <li class=""><b>Erik</b></li>

                            <li class="">320, Hillside Drive, Mississauga, Ontario, L5M2L7</li>

                            <li class="">6478079460</li>

                            <li class="">@outlook.com</li>

                        </ul>

                    </div>

                    <!-- <div class="col my-lg-0 my-md-0 my-sm-0 my-4 mx-lg-0 mx-md-0 mx-sm-4 justify-content-center d-flex">

                    <div style="border: 2px solid black;height:140px;width:150px ;">

                        <div class="text-center">(Happy Tradesman Photo)</div>

                    </div>

                </div> -->

                    <div class="col">

                        <div class="" style="text-align: right;font-size: 30px;"><b>INVOICE</b></div>

                        <ul class="list-unstyled" style="text-align: right;">

                            <li>{{ $booking_id }}</li>

                            <li class="py-3"><b>MeinHaus</b></li>

                            <li>Online General Contractor</li>

                            <li>251 Queen Street South Mississauga, ONL5M1L2</li>

                            <li class="pb-3">Canada</li>

                            <li>1(844)777-4287</li>

                            <li>www.meinhaus.ca</li>

                        </ul>

                    </div>

                </div>



            </div>



            <div class="" style="width:100%">

                <div class="" style="">

                    <table class="upperTable w-100 table-sm p-0 m-0">

                        <tr>

                            <th>Project Area</th>

                            <th>Item Total</th>

                            <th>Previously Paid</th>

                            <th>Due Now</th>

                            <th>Due Later</th>

                        </tr>

                        @foreach ($ms_filter as $key => $mf)

                        

                        <?php

                        

                            $check = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('service',$mf->service_id)->where('payment_status',1)->exists();

                            $var3 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('service',$mf->service_id)->first();

                            $var2 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('service',$mf->service_id)->where('payment_status',1)->sum('invoice_amount');

                            // $var4 = "";

                            // if($check) {$var4 = $var3->invoice_amount + $mf->reg_amount;} 

                            // else {$var4 = $mf->reg_amount;}

                            // $var5 = $var4 - $var3->invoice_amount;

                            $var4 = DB::table('multiple_estimate_services')->where('estimate_id',$id->id)->where('service_id',$mf->service_id)->first();

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

                            $var6aaa = $var5 + $var3->invoice_amount;

                            $var6bbb = $mf->amount-$var6aaa;

                            

                        ?>

                        

                        <tr>

                            <td><b><?php $service_name = DB::table('services')->where('id',$mf->service_id)->get(); echo $service_name[0]->name; ?></b> <br>

                            <div style="width: 10cm; overflow-wrap: break-word;">

                                {{ ucfirst($mf->description) }}

                            </div>

                            </td>

                            

                            <td>${{ number_format($mf->amount,2) }}</td>

                            <td>${{ number_format($var5,2) }}</td>

                            <td>${{ number_format($var3->invoice_amount,2) }}</td>

                            <td>${{ number_format($var6bbb,2) }}</td>

                        </tr>

                        @endforeach

                    </table>

                </div>

            </div>

            <hr style="height:5px; background-color:  red;">

            </hr>

            

            <?php

            

            // use App\Models\MultipleEstimate;

            // use App\Models\MultipleEstimateServices;

            $est_filter = MultipleEstimate::where('booking_show_id', $booking_id)->first();

            $pro_total = MultipleEstimateServices::where('estimate_id',$est_filter->id)->sum('amount');

            $var6 = MultipleEstimateServices::where('estimate_id',$est_filter->id)->sum('reg_amount');

            $var7 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('payment_status',1)->sum('invoice_amount');

            $var8 = $var6 + $var7;

            $var9 = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('payment_status',0)->sum('invoice_amount');

            $var11 = $pro_total - $var8;

            $var12 = $var11 + 0.57;

            

            

            $var6a = DB::table('multiple_estimate_services')->where('estimate_id',$est_filter->id)->where('paying_status',1)->sum('reg_amount');

            $var6b = DB::table('multiple_estimate_invoices_details')->where('booking_id',$data[0]->booking_show_id)->where('invoice_id',$invoice_id)->where('payment_status',1)->sum('invoice_amount');

            $var7a = $var6a + $var6b;



            ?>

            

            <div class=""><b>Notes: This invoice is for completeing broom halfway</b></div>

            <div class="justify-content-center d-flex align-items-center my-5">

                <div class="" style="width:100%; overflow-x:overlay">

                    <table class="w-100">

                        <tr>

                            <th class="" style="font-size: 20px; color: #541a1a;"><b>Invoice Summary</b></th>

                            <th class="" style="font-size: 20px; color: #541a1a;"><b>Payment History</b></th>

                            <th class="" style="font-size: 20px; color: #541a1a;"><b>Payable</b></th>

                        </tr>

                        <tr>

                            <td>Project Total: ${{ number_format($pro_total,2) }}</td>

                            <td>HST (HST NUMBER): $2.60</td>

                            <td>Grand Total: ${{ number_format($pro_total+2.60,2) }}</td>

                        </tr>

                        <tr>

                            <td>Previously Paid: ${{ number_format($var7a,2) }}</td>

                            <td>HST (HST NUMBER): $0.52</td>

                            <td>Grand Total: ${{ number_format($var7a+0.52,2) }}</td>

                        </tr>

                        <tr>

                            <td>Due Now: ${{ number_format($var9,2) }}</span></td>

                            <td>HST (HST NUMBER): $0.94</td>

                            <td>Grand Total: ${{ number_format($var9+0.94,2) }}</td>

                        </tr>

                    </table>

                </div>

            </div>

            <?php $check_pay_status = DB::table('multiple_estimate_invoices')->where('booking_id',$data[0]->booking_show_id)->where('id',$invoice_id)->first();?>

            <!--<form action="{{url('multiple-estimate-invoice-view-online-payment-post/'.$invoice_id.'/'.$data[0]->booking_show_id)}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_test_51LZVObSBB4uLDn3soOtn35F6RzvKHwZL5l367GvWWD0EV2k5M0i1d1uWH8TG10X6YQNLI5liWMgqRhzI1uVa4Jby00By4FBbLw" id="payment-form">-->

            <!--@csrf-->

            <!--<div class=""><b>Pay with credit or debit card</b>-->

            <!--@if($check_pay_status->payment_status == 0)-->

            <!--<button class="" id="pay_btn" type="submit" -->

            <!--  style="font-size:12px;text-decoration: none; color:white; cursor: -webkit-grab; cursor: grab;font-weight:bold;">Pay</button>@endif-->

            <!--  </div>-->

            <!--<div class="row mt-4">-->

            <!--    <div class="col-lg-6 col-md-6 col-12">-->

                    

            <!--            <div class="row">-->

            <!--                <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">-->

            <!--                    <input type="text" id="name" name="name" class='form-control' maxlength="100" placeholder="Name on card" />-->

            <!--                </div>-->

            <!--                <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">-->

            <!--                    <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" id="card" name="card" placeholder="Card Number" class="form-control card-number" />-->

            <!--                </div>-->

            <!--                <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">-->

            <!--                    <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" maxlength="3" id="cvv" name="cvv" placeholder="CVV" class="form-control card-cvc" />-->

            <!--                </div>-->

            <!--                <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">-->

            <!--                    <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" maxlength="2" id="mm" name="mm" placeholder="MM" class="form-control card-expiry-month" />-->

            <!--                </div>-->

            <!--                <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">-->

            <!--                    <input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" id="yy" maxlength="4" name="yy" placeholder="YYYY" class="form-control card-expiry-year" />-->

            <!--                </div>-->

            <!--                <div class="col-lg-4 col-md-4 col-sm-4 col-6 mb-2">-->

            <!--                    <input type="text" class="form-control" placeholder="${{ number_format($var9+0.94,2) }}" readonly disabled style="cursor:not-allowed"/>-->

            <!--                    <input type="hidden" name="amount" class="form-control" value="{{ $var9+0.94 }}"/>-->

            <!--                </div>-->

            <!--            </div>-->

            <!--            <div class="d-flex my-3"> <input type="checkbox" style="width: 15px; cursor:pointer"-->

            <!--                    class="form-check" /><span>&nbsp;Save this card and-->

            <!--                    allow-->

            <!--                    MeinHaus-->

            <!--                    to</span></div>-->

            <!--        </form>-->

            <!--    </div>-->

                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-sm-0 mb-4 ms-auto justify-content-center d-flex">

                    <b>Balance Remaining <span style="font-size: 12px;">Incl HST</span>: ${{ number_format($var12,2) }}</b>

                </div>



            </div>

        </div>

        <footer class="px-lg-5 mt-5">

            <!--<p style="text-align: justify;">This amount is to be paid for the purpose of booking your project and-->

            <!--    getting scheduled with our team members. This deposit will be held in trust by MeinHaus Online General-->

            <!--    Contractor and not released to the service providers until satisfactory progress has been achieved.-->

            <!--    Deposit is refundable with fees where applicable. Purchase of project indicates you have read and agree-->

            <!--    with our <a href="https://meinhaus.ca/termsandconditions" style="font-weight: 500;">Terms of Use</a></p>-->

            <div class="text-center mt-5">

                <img src="{{ url('public/image/logo-img.png') }}" style="width: 12rem;" alt=""

                    class="img-fluid my-2">

                <div class="mb-3 text-center" style="font-size: 22px;font-weight: 500;">Online

                    General

                    Contractor </div>

            </div>

        </footer>

    </section>



</body>









<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>



<script type="text/javascript" src="https://js.stripe.com/v2/"></script>





<script>

    function generatePDF() {

        document.getElementById('invoice').hidden = false;

        const element = document.getElementById('invoice');

        const opt = {

            filename: '{{ $data[0]->title }}.pdf'

        };

        html2pdf().set(opt).from(element).save();

        window.setTimeout(function() {

            document.getElementById('invoice').hidden = true;

        }, 0.2)

    }

</script>

   



   <script type="text/javascript">

      $(function() {

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {

        var $form = $(".require-validation"),

            inputSelector = ['input[type=email]', 'input[type=password]',

                'input[type=text]', 'input[type=file]', 'input[type=number]',

                'textarea'

            ].join(', '),

            $inputs = $form.find('.required').find(inputSelector),

            $errorMessage = $form.find('div.error'),

            valid = true;

        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {

            var $input = $(el);

            if ($input.val() === '') {

                $input.parent().addClass('has-error');

                $errorMessage.removeClass('hide');

                e.preventDefault();

            }

        });

        if (!$form.data('cc-on-file')) {

            e.preventDefault();

            Stripe.setPublishableKey('pk_test_51LZVObSBB4uLDn3soOtn35F6RzvKHwZL5l367GvWWD0EV2k5M0i1d1uWH8TG10X6YQNLI5liWMgqRhzI1uVa4Jby00By4FBbLw');

            Stripe.createToken({

                number: $('.card-number').val(),

                cvc: $('.card-cvc').val(),

                exp_month: $('.card-expiry-month').val(),

                exp_year: $('.card-expiry-year').val(),

                name: $('#card-name').val()

                

            }, stripeResponseHandler);

        }

    });

    function stripeResponseHandler(status, response) {

        if (response.error) {

            $('.error')

           

                .removeClass('hide')

                .find('.alert')

                .text(response.error.message);

        } else {

            /* token contains id, last4, and card type */

          var token = response['id'];

           

            $form.find('input[type=text]').empty();

            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

            $form.get(0).submit();

        }

    }

});

   </script>



<!--<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"> </script>-->











</html>