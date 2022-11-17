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

    <?php
    
        $user_data_estimate = DB::table('user_data_estimate')->where('id', $id)->first();
        $user_data = DB::table('user_data')->where('id', $user_data_estimate->user_data_id)->first();
        $user_project_data = DB::table('user_data_projectDetails')->where('id', $user_data_estimate->user_data_project_id)->first();

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

                    <p>{{ ucwords($user_data->name) }}</p>

                    <p style="font-weight: 400">{{ ucfirst($user_project_data->city) }}<br>
                        {{ ucfirst($user_project_data->Address) }}</p>

                    <p style="font-weight: 400">{{ $user_data->contact }}<br>{{ $user_data->email }}</p>

                </div>
                
                <div class="meinhuas-content estimate">


                    <p style="margin-top:4%;"><b>Estimate Number :</b> <span>{{ $user_data_estimate->booking_id }}</span><br>

                    <b>Estimate Date :</b> <span>NA </span><br>
                    
                    <b>Expires On :</b> <span>NA </span><br>



                        <b>Grand Total (CAD) :</b> <span><b>${{ number_format($user_data_estimate->amount, 2) }}</b></span>
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


                    </tr>

                </thead>

                

                <tbody>

                        <tr>

                            <td><b>{{ ucwords($user_project_data->Name) }}</b></td>

                            <td>{{ ucfirst(substr($user_project_data->description, 0, 50)) }}@if (strlen($user_project_data->description) > 50)
                                    ...
                                    <a href="javascript:;" style="color:#136acd;text-decoration: none; font-size: 12px"
                                        onclick="document.getElementById('id01').style.display='block'"
                                        class="">Read more</a>
                                @endif
                            </td>

                            <div id="id01" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span
                                            onclick="document.getElementById('id01').style.display='none'"
                                            class="w3-button w3-display-topright">&times;</span>
                                        <h5><b>Description</b></h5>
                                        <p style="overflow-wrap: break-word;">{{ ucfirst($user_project_data->description) }}</p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <td>${{ number_format($user_data_estimate->reg_amount, 2) }}</td>

                            <td>${{ number_format($user_data_estimate->amount, 2) }}</td>

                            

                        </tr>

                        

                </tbody>



            </table>

            <div class="div-table">

                <table class="table table-two">

                    <tbody>

                        <tr style="white-space: nowrap;">




                            <th style="width:50%">Subtotal :</th>

                            <td>${{ number_format($user_data_estimate->reg_amount, 2) }}</td>

                        </tr>

                        <tr>

                            <th class="hst">HST 13% (830275681RRT0001)</th>

                            <?php

                            $subtotal = $user_data_estimate->reg_amount * 0.13;

                            $stotal = $user_data_estimate->reg_amount + $subtotal;

                            ?>

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

                            <td>${{ number_format($user_data_estimate->reg_amount, 2) }}</td>

                        </tr>

                        <tr>

                            <th class="hst">HST 13% (830275681RRT0001)</th>

                            <?php

                            $regtotal = $user_data_estimate->reg_amount * 0.13;

                            $rtotal = $user_data_estimate->reg_amount + $regtotal;

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

                <button disabled style="background-color: #6396d0;cursor:not-allowed"><a href="#">Book Your Project</a></button>

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

                <p>{{ ucwords($user_data->name) }}</p>

                <p style="font-weight: 400">{{ ucfirst($user_project_data->city) }}<br>
                        {{ ucfirst($user_project_data->Address) }}</p>

                 <p style="font-weight: 400">{{ $user_data->contact }}<br>{{ $user_data->email }}</p>

            </div>

            <div class="meinhuas-content estimate">

                <p style="margin-top:4%;"><b>Estimate Number :</b> <span>{{ $user_data_estimate->booking_id }}</span><br>

                    <b>Estimate Date :</b> <span>NA </span><br>
                    <b>Expires On :</b> <span>NA </span><br>



                        <b>Grand Total (CAD) :</b> <span><b>${{ number_format($user_data_estimate->amount, 2) }}</b></span>
                    </p>

            </div>

        </div>
        

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

                    
                        <tr>

                            <td><b>{{ ucwords($user_project_data->Name) }}</b><br>
                                <div style="width: 10cm; overflow-wrap: break-word;">
                                    {{ ucfirst($user_project_data->description) }}
                                </div>
                            </td>

                            <td>${{ number_format($user_data_estimate->reg_amount, 2) }}</td>

                            <td>${{ number_format($user_data_estimate->amount, 2) }}</td>

                        </tr>

                </tbody>



            </table>
        </div>

        <div class="div-table">

            <table class="table table-two">

                <tbody>

                    <tr style="white-space: nowrap;">




                        <th style="width:50%">Subtotal :</th>

                        <td>${{ number_format($user_data_estimate->reg_amount, 2) }}</td>

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

                        <td>${{ number_format($user_data_estimate->reg_amount, 2) }}</td>

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
                filename: '{{ $user_data_estimate->title }}.pdf'
            };
            html2pdf().set(opt).from(element).save();
            window.setTimeout(function() {
                document.getElementById('invoice').hidden = true;
            }, 0.2)
        }
    </script>


</body>

</html>
