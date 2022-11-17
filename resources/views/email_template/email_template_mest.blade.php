<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Estimate</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"
        integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<style>
    body {
        font-family: 'Open Sans', sans-serif;
    }

    h1 {

        font-size: 30px;

        text-transform: uppercase;

        font-weight: 500;

    }

    p {
        font-size: 15px;
        color: #000;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    hr {
        border-top: 1px solid #ccc;
    }

    body button {

        display: block;

        margin: 25px auto;

        background: #136acd;

        border-radius: 200px;

        padding: 15px 50px;

        border: none;

    }

    p.description-box {

        text-align: justify;

        width: 50%;

        float: left;

    }

    body button a {
        color: #fff;
        text-decoration: none;
    }

    a:hover,
    a:focus {
        color: #fff;
        text-decoration: none;
    }

    p a {
        color: #136acd;
        font-weight: 600;
    }

    p a:hover {
        color: #136acd;
    }

    .invoice {
        width: 950px;
        padding-top: 50px;
        margin: 0 auto;
        text-align: center;
    }

    .meinhaus-header .meinhuas-content {
        width: 50%;
        float: left;
    }

    .meinhaus-header .meinhuas-content img {
        width: 30%;
    }

    .estimate h1,
    .estimate p {
        text-align: right !important;
    }

    .meinhaus-header .meinhuas-content p {
        font-weight: 700;
        text-align: justify;
    }

    .estimate p {
        font-weight: normal !important;
    }

    .meinhuas-content ul li {
        list-style: none;
        margin-bottom: 5px;
    }

    .estimate ul {
        float: right;
        padding-right: 30px;
    }

    .estimate ul li span {}

    .estimate ul li b {}

    .table {
        width: 100%;
        border: 1px solid rgb(51 51 51 / 20%);

        border-spacing: 0;
    }

    thead tr {
        background: #541a1a;
    }

    thead tr th {
        text-align: left;
        color: #fff;
        padding: 10px 15px;
    }

    tbody tr td {
        padding: 10px 15px;
    }

    .hst {
        font-weight: normal;
    }

    .table-two {
        border: none;
    }

    .table-two {
        float: right;
        width: 41%;
        margin-top: 5px;
    }

    .table-two tbody tr th {
        text-align: right;
    }

    .table-two tbody tr td,
    .table-two tbody tr th {
        border-bottom: 1px solid rgb(51 51 51 / 20%)
    }

    .div-table {
        height: 300px;
    }

    .book img {
        width: 20%;
        margin: 0 auto;
        display: block;
    }

    .book h4 {
        text-align: center;
        margin-bottom: 0;
    }



    @media(max-width:1024px) {

        .main-section {
            width: 960px !important;
        }

        .table-two {
            width: 48%;
        }

    }

    @media(max-width:414px) {

        .main-section {
            width: auto;
        }

        .book p {

            font-size: 13px !important;

            text-align: justify !important;

        }

    }

    .main-section table tr {
        page-break-inside: avoid;
    }


    .main-section {
        width: 1140px;
        margin: 0 auto;
        padding: 30px 0px;
    }
</style>

<body>
    
    <?php error_reporting(0);?>

    <?php

    $user = DB::table('multiple_estimate')
        ->where('id', $bookingId)
        ->get();

    ?>

    <!--<div style="margin-right:65%;">-->
    <!--<button style="margin-bottom:-70px !important;"><a href="#">Book Your Project</a></button>-->
    <!--</div>-->

    <div style="margin-left:70%;">
        <button style="border-radius:10px;padding:10px;background-color:#e74c3c;margin-bottom:-10px !important;"><a
                onclick="generatePDF()" href="javascript:;"><i class="fas fa-download"></i>
                Download as PDF</a></button>
    </div>

    <div id="refresh">
        <section class="main-section">

            <div class="meinhaus-header">

                <div class="meinhuas-content" style="">

                    <img src="{{ url('public/image/logo-img.png') }}" alt="logo" srcset="">

                    <p>Thanks for choosing MeinHaus Online General Contractor for your home improvement Project! Please read
                        through our project estimate of your job carefully. If you wish to move forward and book your
                        project in, follow the next steps!</p>

                </div>

                <div class="meinhuas-content estimate">
                    <h1>Estimate</h1>

                    <p><b>MeinHaus</b></p>

                    <p>251 Queen Street South<br> Mississauga, ON L5M1L2 <br>Canada</p>

                    <p>1(844)777-4287<br>www.meinhaus.ca</p>

                </div>

            </div>

            <div class="meinhaus-header">

                <div class="meinhuas-content">
                    <h6 style="font-size:15px; margin-top: -50px;">BILL TO</h6>

                    <p>{{ ucwords($user[0]->name) }}</p>

                    <p style="font-weight: 400">{{ ucfirst($user[0]->locality) }} <br>{{ ucfirst($user[0]->city) }},
                        {{ ucfirst($user[0]->pincode) }} <br>{{ ucfirst($user[0]->state) }}</p>

                    <p style="font-weight: 400">{{ $user[0]->phone_no }}<br>{{ $user[0]->email }}</p>

                </div>

                <?php
                $cal_amount = DB::table('multiple_estimate_services')
                    ->where('estimate_id', $bookingId)->where('paying_status',1)
                    ->sum('amount');
                ?>
                <div class="meinhuas-content estimate">


                    <p style="margin-top:4%;"><b>Estimate Number :</b> <span>{{ $user[0]->booking_show_id }}</span><br>

                   
                        <b>Estimate Date :</b> <span>{{ $user[0]->date?date('F d, Y', strtotime($user[0]->date)):'NA' }} </span><br>

                        <b>Expires On :</b> <span>{{ $user[0]->date?date('F d, Y', strtotime($user[0]->date)):'NA' }}</span><br>

                        <b>Grand Total (CAD) :</b> <span><b>${{ number_format($cal_amount, 2) }}</b></span>
                    </p>


                </div>

            </div>

            <table class="table">

                <thead>

                    <tr style="white-space: nowrap">

                        <th>Project Area</th>

                        <th>Description</th>

                        <th>Deposit Amount</th>

                        <th>Project Cost</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <?php

                $ms_filter = DB::table('multiple_estimate_services')
                    ->where('estimate_id', $bookingId)
                    ->get();

                ?>

                <tbody>

                    @foreach ($ms_filter as $key => $ms)
                        <?php $service = DB::table('services')
                            ->where('id', $ms->service_id)
                            ->get(); ?>
                        <tr id="row{{ $key + 1 }}" @if ($ms->paying_status==0) style="background-color: #ecf0f1" @endif>

                            <td @if ($ms->paying_status==0) style="color: #bdc3c7" @endif><b>{{ ucwords($service[0]->name) }}</b></td>

                            <td @if ($ms->paying_status==0) style="color: #bdc3c7" @endif>{{ ucfirst(substr($ms->description, 0, 50)) }}@if (strlen($ms->description) > 50)
                                    ...
                                    <a href="javascript:;" style="color:#136acd;text-decoration: none; font-size: 12px"
                                        onclick="document.getElementById('id01{{ $ms->id }}').style.display='block'"
                                        class="">Read more</a>
                                @endif
                            </td>

                            <div id="id01{{ $ms->id }}" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span
                                            onclick="document.getElementById('id01{{ $ms->id }}').style.display='none'"
                                            class="w3-button w3-display-topright">&times;</span>
                                        <h5><b>Description</b></h5>
                                        <p style="overflow-wrap: break-word;">{{ ucfirst($ms->description) }}</p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <td @if ($ms->paying_status==0) style="color: #bdc3c7" @endif>${{ number_format($ms->reg_amount, 2) }}</td>

                            <td @if ($ms->paying_status==0) style="color: #bdc3c7" @endif>${{ number_format($ms->amount, 2) }}</td>

                            <td>
                                {{-- <a href="{{ url("paid-status/$ms->id") }}" class="button"
                                    style="border-radius:5px !important; padding: 5px 7px !important;
                margin: 0;background: #c0392b;color:white;font-size:11px;cursor:pointer;text-decoration:none;">Remove</a> --}}

                                @if ($ms->paying_status==1)
                                <button id="remove{{ $key + 1 }}"
                                style="border-radius:5px !important; padding: 5px 7px !important;
                margin: 0;background: #c0392b;color:white;font-size:11px;cursor:pointer;text-decoration:none;">Remove</button>
                                @elseif($ms->paying_status==0)
                                <button id="remove{{ $key + 1 }}"
                                style="border-radius:5px !important; padding: 5px 7px !important;width:55px;
                margin: 0;background: #16a085;color:white;font-size:11px;cursor:pointer;text-decoration:none;">Add</button>
                                @endif
                            </td>

                        </tr>

                        <script>
                            $("#remove{{ $key + 1 }}").on('click',function(e) {
                                e.preventDefault();

                                $.ajax({
                                    url: "{{ route('paying_status') }}",
                                    type: "GET",
                                    data: {
                                        s_id: {{ $ms->id }}
                                    },
                                    cache: false,
                                    success: function(data) {
                                        // var a = data.cal_amount;
                                        // var b = a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        // $("#s_total").text("$"+b);
                                        // var c = parseInt(a) * parseFloat(0.13);
                                        // var d = c.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        // $("#hst_amount").text("$"+d);
                                        // var e = parseInt(a) + parseInt(c);
                                        // var f = e.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        // $("#total").text("$"+f);
                                        // console.log(data.success);
                                        location.reload(true);
                                    }
                                });
                                // $("#refresh").load(window.location.href + " #refresh");

                                // alert("Heyy");
                                // console.log('Working');
                            });
                        </script>
                    @endforeach

                </tbody>



            </table>

            <div class="div-table">

                <table class="table table-two">

                    <tbody>

                        <tr style="white-space: nowrap;">




                            <th style="width:50%">Subtotal :</th>

                            <td>${{ number_format($cal_amount, 2) }}</td>

                        </tr>

                        <tr>

                            <th class="hst">HST 13% (830275681RRT0001)</th>

                            <?php

                            $subtotal = $cal_amount * 0.13;

                            $stotal = $cal_amount + $subtotal;

                            ?>

                            <td>${{ number_format($subtotal, 2) }}</td>

                        </tr>

                        <tr>

                            <th>Total :</th>

                            <td>${{ number_format($stotal, 2) }}</td>

                        </tr>

                    </tbody>

                    <tbody>

                        <?php
                        $cal_reg_amount = DB::table('multiple_estimate_services')
                            ->where('estimate_id', $bookingId)->where('paying_status',1)
                            ->sum('reg_amount');
                        ?>

                        <tr>

                            <th style="width:50%">Deposit for project Booking :</th>

                            <td>${{ number_format($cal_reg_amount, 2) }}</td>

                        </tr>

                        <tr>

                            <th class="hst">HST 13% (830275681RRT0001)</th>

                            <?php

                            $regtotal = $cal_reg_amount * 0.13;

                            $rtotal = $cal_reg_amount + $regtotal;

                            ?>

                            <td>${{ number_format($regtotal, 2) }}</td>

                        </tr>

                        <tr>

                            <th>Total :</th>

                            <td>${{ number_format($rtotal, 2) }}</td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="book">

                <?php

                $update = DB::table('multiple_estimate')
                    ->where('id', $bookingId)
                    ->update([
                        'reg_amount_tax' => $rtotal,
                    ]);

                ?>

                <?php $check = DB::table('multiple_estimate_services')->where('estimate_id', $bookingId)->where('paying_status',1)->count();?>

                @if ($check>=1)
                <button><a href="{{ url('online-pay-multiple-estimate/' . $bookingId) }}">Book Your Project</a></button>
                @else
                <button disabled style="background-color: #6396d0;cursor:not-allowed"><a href="#">Book Your Project</a></button>
                @endif


                <p>This amount is to be paid for the purpose of booking your project and getting scheduled with our team
                    members. This deposit will be held in trust by MeinHaus Online General Contractor and not released to
                    the service providers until satisfactory progress has been achieved. Deposit is refundable with fees
                    where applicable. Purchase of project indicates you have read and agree with our <a
                        href="https://meinhaus.ca/termsandconditions">Terms of Use</a></a></p>

                <img src="{{ url('public/image/logo-img.png') }}" alt="">

                <h4>Online General Contractor</h4>

            </div>

        </section>
    </div>


    <section class="main-section" hidden id="invoice" style="margin-top:0px;width:19cm !important;">

        <div class="meinhaus-header">
            <br>
            <div class="meinhuas-content">

                <img src="{{ url('public/image/logo-img.png') }}" alt="logo" srcset="">

            </div>

            <div class="meinhuas-content estimate">

                <h1>Estimate</h1>

                <p><b>MeinHaus</b></p>

                <p>251 Queen Street South<br> Mississauga, ON L5M1L2 <br>Canada</p>

                <p>1(844)777-4287<br>www.meinhaus.ca</p>

            </div>

        </div>

        <div class="meinhaus-header">

            <div class="meinhuas-content" style="margin-top: -180px">
                <h6 style="font-size:15px;">BILL TO</h6>

                <p>{{ ucwords($user[0]->name) }}</p>

                <p style="font-weight: 400">{{ ucfirst($user[0]->locality) }} <br>{{ ucfirst($user[0]->city) }},
                    {{ ucfirst($user[0]->pincode) }} <br>{{ ucfirst($user[0]->state) }}</p>

                <p style="font-weight: 400">{{ $user[0]->phone_no }}<br>{{ $user[0]->email }}</p>

            </div>

            <div class="meinhuas-content estimate">

                <p style="margin-top:4%;"><b>Estimate Number :</b> <span>{{ $user[0]->booking_show_id }}</span><br>

                         <b>Estimate Date :</b> <span>{{ $user[0]->date?date('F d, Y', strtotime($user[0]->date)):'NA' }} </span><br>

                        <b>Expires On :</b> <span>{{ $user[0]->date?date('F d, Y', strtotime($user[0]->date)):'NA' }}</span><br>

                    <b>Grand Total (CAD) :</b> <span><b>${{ number_format($cal_amount, 2) }}</b></span>
                </p>

            </div>

        </div>

        <?php

            $mes_filter = DB::table('multiple_estimate_services')
                ->where('estimate_id', $bookingId)->where('paying_status',1)
                ->get();

        ?>

        <div style="width: 100% !important;">
            <table class="table">

                <thead>

                    <tr>

                        <th>Project Area</th>

                        <th>Deposit Amount</th>

                        <th>Project Cost</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($mes_filter as $m)
                        <?php $service_pdf = DB::table('services')
                            ->where('id', $m->service_id)
                            ->get(); ?>
                        <tr>

                            <td><b>{{ ucwords($service_pdf[0]->name) }}</b><br>
                                <div style="width: 10cm; overflow-wrap: break-word;">
                                    {{ ucfirst($m->description) }}
                                </div>
                            </td>

                            <td>${{ number_format($m->reg_amount, 2) }}</td>

                            <td>${{ number_format($m->amount, 2) }}</td>

                        </tr>
                    @endforeach

                </tbody>



            </table>
        </div>

        <div class="div-table">

            <table class="table table-two">

                <tbody>

                    <tr style="white-space: nowrap;">




                        <th style="width:50%">Subtotal :</th>

                        <td>${{ number_format($cal_amount, 2) }}</td>

                    </tr>

                    <tr>

                        <th class="hst">HST 13% (830275681RRT0001)</th>


                        <td>${{ number_format($subtotal, 2) }}</td>

                    </tr>

                    <tr>

                        <th>Total :</th>

                        <td>${{ number_format($stotal, 2) }}</td>

                    </tr>

                </tbody>

                <tbody>

                    <tr>

                        <th style="width:50%">Deposit for project Booking :</th>

                        <td>${{ number_format($cal_reg_amount, 2) }}</td>

                    </tr>

                    <tr>

                        <th class="hst">HST 13% (830275681RRT0001)</th>


                        <td>${{ number_format($regtotal, 2) }}</td>

                    </tr>

                    <tr>

                        <th>Total :</th>

                        <td>${{ number_format($rtotal, 2) }}</td>

                    </tr>

                </tbody>

            </table>

        </div>

        <div class="book">


            <br><br><br>
            <img src="{{ url('public/image/logo-img.png') }}" alt="">
            <br>
            <h4>Online General Contractor</h4>

        </div>

    </section>



    <!--<script>
        -- >
        <
        !-- function generatePDF() {
            -- >
            <
            !--
            var a = document.getElementById("genHB");
            -- >
            <
            !--a.setAttribute("style", "visibility:hidden;");
            -- >
            <
            !--
            var b = document.getElementById("genHB2");
            -- >
            <
            !--b.setAttribute("style", "visibility:hidden;");
            -- >
            <
            !--
            const element = document.getElementById('invoice');
            -- >
            <
            !--
            const opt = {
                -- >
                <
                !--filename: 'invoice.pdf'-- >
                    <
                    !--
            };
            -- >
            <
            !--html2pdf().set(opt).from(element).save();
            -- >
            <
            !--window.setTimeout(function() {
                    location.reload()
                }, 100) -- >
                <
                !--
        }-- >
        <
        !--
    </script>-->

    <script>
        function generatePDF() {
            document.getElementById('invoice').hidden = false;
            const element = document.getElementById('invoice');
            const opt = {
                filename: '{{ $user[0]->title }}.pdf'
            };
            html2pdf().set(opt).from(element).save();
            window.setTimeout(function() {
                document.getElementById('invoice').hidden = true;
            }, 0.2)
        }
    </script>


</body>

</html>
