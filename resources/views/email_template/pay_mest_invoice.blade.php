<!DOCTYPE html>

<html lang="en" >

<head>

  <meta charset="UTF-8">

  <title>Invoice</title>

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"-->



  <!-- Essential JS 2 Calendar's dependent material theme -->

            <link href="{{url('public/css/base_material.css')}}" rel="stylesheet" type="text/css" />

            <link href="{{url('public/css/button_material.css')}}" rel="stylesheet" type="text/css" />

            <link href="{{url('public/css/calender_material.css')}}" rel="stylesheet" type="text/css" />



            <!-- Essential JS 2 all script -->

            <!-- <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script> -->



            <!-- Essential JS 2 Calendar's dependent scripts -->

            <script src="{{url('public/js/ej2-base.min.js')}}" type="text/javascript"></script>

            <script src="{{url('public/js/ej2-inputs.min.js')}}" type="text/javascript"></script>

            <script src="{{url('public/js/ej2-buttons.min.js')}}" type="text/javascript"></script>

            <script src="{{url('public/js/ej2-lists.min.js')}}" type="text/javascript"></script>

            <script src="{{url('public/js/ej2-popups.min.js')}}" type="text/javascript"></script>

            <script src="{{url('public/js/ej2-calendars.min.js')}}" type="text/javascript"></script>

</head>

<style>

  /**/

  *, *:before, *:after {

-moz-box-sizing: border-box!important; -webkit-box-sizing: border-box!important; box-sizing: border-box!important;

}





.header {

  height: 50px!important;

  width: 420px!important;

  background: rgba(66, 66, 66, 1)!important;

  text-align: center!important;

  position:relative!important;

  z-index: 100!important;

}



.header h1 {

  margin: 0!important;

  padding: 0!important;

  font-size: 20px!important;

  line-height: 50px!important;

  font-weight: 100!important;

  letter-spacing: 1px!important;

  color: #fff!important;

}



.left, .right {

  position: absolute!important;

  width: 0px!important;

  height: 0px!important;

  border-style: solid!important;

  top: 50%!important;

  margin-top: -7.5px!important;

  cursor: pointer!important;

}



.left {

  border-width: 7.5px 10px 7.5px 0!important;

  border-color: transparent rgba(160, 159, 160, 1) transparent transparent!important;

  left: 20px!important;

}



.right {

  border-width: 7.5px 0 7.5px 10px!important;

  border-color: transparent transparent transparent rgba(160, 159, 160, 1)!important;

  right: 20px!important;

}



.magenta { background: rgb(133, 3, 65)!important; }

.pink { background: rgb(255, 0, 179)!important; }

.red { background: rgb(255, 0, 0)!important; }

.purple {background: rgb(153, 0, 255)!important; }



.details {

  position: relative!important;

  width: 420px!important;

  height: 75px!important;

  background: rgba(164, 164, 164, 1)!important;

  margin-top: 5px!important;

  border-radius: 4px!important;

}



.details.in {

  -webkit-animation: moveFromTopFade .5s ease both!important;

  -moz-animation: moveFromTopFade .5s ease both!important;

  animation: moveFromTopFade .5s ease both!important;

}



.details.out {

  -webkit-animation: moveToTopFade .5s ease both!important;

  -moz-animation: moveToTopFade .5s ease both!important;

  animation: moveToTopFade .5s ease both!important;

}



.arrow {

  position: absolute!important;

  top: -5px!important;

  left: 50%!important;

  margin-left: -2px!important;

  width: 0px!important;

  height: 0px!important;

  border-style: solid!important;

  border-width: 0 5px 5px 5px!important;

  border-color: transparent transparent rgba(164, 164, 164, 1) transparent!important;

  transition: all 0.7s ease!important;

}



.events {

  height: 75px!important;

  padding: 7px 0!important;

  overflow-y: auto!important;

  overflow-x: hidden!important;

}



.events.in {

  -webkit-animation: fadeIn .3s ease both!important;

  -moz-animation: fadeIn .3s ease both!important;

  animation: fadeIn .3s ease both!important;

}



.events.in {

  -webkit-animation-delay: .3s!important;

  -moz-animation-delay: .3s!important;

  animation-delay: .3s!important;

}



.details.out .events {

  -webkit-animation: fadeOutShrink .4s ease both!important;

  -moz-animation: fadeOutShink .4s ease both!important;

  animation: fadeOutShink .4s ease both!important;

}



.events.out {

  -webkit-animation: fadeOut .3s ease both!important;

  -moz-animation: fadeOut .3s ease both!important;

  animation: fadeOut .3s ease both!important;

}



.event {

  font-size: 16px!important;

  line-height: 22px!important;

  letter-spacing: .5px!important;

  padding: 2px 16px!important;

  vertical-align: top!important;

}



.event.empty {

  color: #eee;

}



.event-category {

  height: 10px;

  width: 10px;

  display: inline-block;

  margin: 6px 0 0;

  vertical-align: top;

}



.event span {

  display: inline-block;

  padding: 0 0 0 7px;

}



.legend {

  position: absolute;

  bottom: 0;

  width: 100%;

  height: 30px;

  background: rgba(60, 60, 60, 1);

  line-height: 30px;



}



.entry {

  position: relative;

  padding: 0 0 0 25px;

  font-size: 13px;

  display: inline-block;

  line-height: 30px;

  background: transparent;

}



.entry:after {

  position: absolute;

  content: '';

  height: 5px;

  width: 5px;

  top: 12px;

  left: 14px;

}



.entry.magenta:after { background: rgb(133, 3, 65); }

.entry.pink:after { background: rgb(255, 0, 179); }

.entry.red:after { background: rgb(255, 0, 0); }

.entry.purple:after { background: rgb(153, 0, 255); }



/* Animations are cool!  */

@-webkit-keyframes moveFromTopFade {

  from { opacity: .3; height:0px; margin-top:0px; -webkit-transform: translateY(-100%); }

}

@-moz-keyframes moveFromTopFade {

  from { height:0px; margin-top:0px; -moz-transform: translateY(-100%); }

}

@keyframes moveFromTopFade {

  from { height:0px; margin-top:0px; transform: translateY(-100%); }

}



@-webkit-keyframes moveToTopFade {

  to { opacity: .3; height:0px; margin-top:0px; opacity: 0.3; -webkit-transform: translateY(-100%); }

}

@-moz-keyframes moveToTopFade {

  to { height:0px; -moz-transform: translateY(-100%); }

}

@keyframes moveToTopFade {

  to { height:0px; transform: translateY(-100%); }

}



@-webkit-keyframes fadeIn  {

  from { opacity: 0; }

}

@-moz-keyframes fadeIn  {

  from { opacity: 0; }

}

@keyframes fadeIn  {

  from { opacity: 0; }

}



@-webkit-keyframes fadeOut  {

  to { opacity: 0; }

}

@-moz-keyframes fadeOut  {

  to { opacity: 0; }

}

@keyframes fadeOut  {

  to { opacity: 0; }

}



@-webkit-keyframes fadeOutShink  {

  to { opacity: 0; padding: 0px; height: 0px; }

}

@-moz-keyframes fadeOutShink  {

  to { opacity: 0; padding: 0px; height: 0px; }

}

@keyframes fadeOutShink  {

  to { opacity: 0; padding: 0px; height: 0px; }

}



  /**/

    body{font-family: 'Open Sans', sans-serif;}

    h1

    {

        font-size: 25px;

        font-weight: 700;

    }

    p{font-size: 15px;color: #000;margin-top: 15px;margin-bottom: 15px;}

    hr{border-top: 1px solid #ccc;}

    body button

    {



        margin: 25px auto;

        background: #136acd;

        border-radius: 200px;

        padding: 15px 50px;

        border: none;

    }

    body button a:hover{color: #fff;}

    body button a{color: #fff;text-decoration: none;}

    a:hover, a:focus{color: #fff;text-decoration: none;}

    p a{color: #136acd;font-weight: 600;}

    p a:hover{color: #136acd;}

    .invoice {width: 950px;padding-top: 50px;margin: 0 auto;text-align: center;}

    .meinhaus-header .meinhuas-content {width: 50%;float: left;}

    .meinhaus-header .meinhuas-content img{width: 30%;}

    .estimate h1{margin-bottom:-15px;}

    .estimate h1,.estimate p{text-align: right!important;}

    .meinhaus-header .meinhuas-content p{font-weight: 700;text-align: justify;}

    .estimate p{font-weight: normal!important;}

    .meinhuas-content ul li{list-style: none;margin-bottom: 5px;}

    .estimate ul{float: right;padding-right: 30px;}

    .estimate ul li span{}

    .estimate ul li b{}

    .meinhuas-content ul{padding-left: 0;}

    .table{width: 100%;border: 1px solid rgb(51 51 51 / 20%);

    border-spacing: 0;}

    .thead-tr{background:#541a1a;}

    .thead-tr-th{text-align: left;color: #fff;padding: 10px 15px;}

    .tbody-tr-td{padding: 10px 15px;}

    .hst{font-weight: normal;}

    .table-two{border: none;}

    .table-two{float: right;width: 41%;margin-top: 5px;}

    .table-two tbody tr th{text-align: right;font-size: 15px;}

    .table-two tbody tr td,.table-two tbody tr th{border-bottom: 1px solid rgb(51 51 51 / 20%)}

    .book img{width: 20%;margin: 0 auto;display: block;}

    .book h4{text-align: center;margin-bottom: 0;}

p.description-box

{

    text-align: justify;

    width: 50%;

    float: left;

}

    @media(max-width:1024px)

    {

    .main-section{width: 960px!important;}

    .table-two{width: 48%;}

    }

    @media(max-width:414px)

    {

       .main-section{width: auto;}

       .table-two{width: 47%;}

       .book p

        {

         font-size: 13px!important;

         text-align: justify!important;

        }

    }

    .main-section{width: 1140px;margin: 0 auto; padding: 30px 0px 13% 0px;}

    .main-calender{width: 1140px;margin: 0 auto;}

    .main-calender .col-lg-6{width: 50%;float: left;}

    .main-calender p{font-size: 18px;margin-bottom: 0;}

</style>

<body>

    <?php

        $user = DB::table('multiple_estimate')->where('id',$bookingId)->get();
        $booking_id = $user[0]->booking_show_id;

     ?>

<div style="margin-left:80%;">
    <button style="border-radius:10px;padding:10px;background-color:#e74c3c;margin-bottom:-30px !important;"><a onclick="generatePDF()" href="javascript:;"><i class="fas fa-download"></i> Download as PDF</a></button>
</div>


<section class="main-section">

<div class="meinhaus-header">

    <div class="meinhuas-content">

        <img src="{{url('public/image/logo-img.png')}}" alt="logo" srcset="">

        <ul>
            <p>{{ ucwords($user[0]->name) }}</p>

            <p style="font-weight: 400">{{ ucfirst($user[0]->locality) }} <br>{{ ucfirst($user[0]->city) }}, {{ ucfirst($user[0]->pincode) }} <br>{{ ucfirst($user[0]->state) }}</p>

            <p  style="font-weight: 400">{{ $user[0]->phone_no }}<br>{{ $user[0]->email }}</p>


            <!--<p style="font-weight:400;text-align:left">-->
            <!--  <b>{{ucwords($user[0]->name)}}</b><br>-->
            <!--  {{ucfirst($user[0]->address)}}<br>-->
            <!--  {{$user[0]->phone_no}}<br>{{$user[0]->email}}-->
            <!--</p>-->


        </ul>

    </div>



    <?php
        $cal_amount = DB::table('multiple_estimate_services')->where('estimate_id',$user[0]->id)->where('paying_status',1)->sum('amount');
        $cal_reg_amount = DB::table('multiple_estimate_services')->where('estimate_id',$user[0]->id)->where('paying_status',1)->sum('reg_amount');
    ?>

    <div class="meinhuas-content estimate">

      <h1>Invoice</h1>

      <p>{{$user[0]->booking_show_id}}</p>

      <p><b>MeinHaus</b></p>

      <p>251 Queen Street South<br> Mississauga, ON L5M1L2 <br>Canada</p>

      <p>1(844)777-4287<br>www.meinhaus.ca</p>

    </div>

</div>



<table class="table">

    <thead class="thead-tr">

      <tr class="thead-tr" style="white-space: nowrap">

        <th class="thead-tr-th">Project Area</th>

        <th class="thead-tr-th">Description</th>

        <th class="thead-tr-th">Deposit Amount</th>

        <th class="thead-tr-th">Project Cost</th>

        <th class="thead-tr-th">Action</th>

      </tr>

    </thead>

    <?php

    $ms_filter = DB::table('multiple_estimate_services')->where('estimate_id',$user[0]->id)->get();

    ?>

    <tbody class="tbody-tr-td">

        @foreach($ms_filter as $key => $ms)
        <?php $service = DB::table('services')->where('id',$ms->service_id)->get();?>

      <tr class="tbody-tr-td">

        <td class="tbody-tr-td"><b>{{ ucwords($service[0]->name) }}</b></td>

        <td class="tbody-tr-td"><b>{{ ucfirst(substr($ms->description,0,50)) }}@if (strlen($ms->description)>50)...
           <a href="javascript:;" style="color:#136acd;text-decoration: none; font-size: 12px"
           onclick="document.getElementById('id01{{$ms->id}}').style.display='block'" class="">Read more</a> @endif</b></td>

           <div id="id01{{$ms->id}}" class="w3-modal">
         <div class="w3-modal-content">
           <div class="w3-container">
             <span onclick="document.getElementById('id01{{$ms->id}}').style.display='none'" class="w3-button w3-display-topright">&times;</span>
             <h5><b>Description</b></h5>
             <p style="overflow-wrap: break-word;">{{ucfirst($ms->description)}}</p>
             <br>
           </div>
         </div>
       </div>
      </div>

        <td class="tbody-tr-td">${{number_format($ms->reg_amount, 2)}}</td>

        <td class="tbody-tr-td">${{number_format($ms->amount, 2)}}</td>

        <td>
            @if ($ms->paying_status==1)
            <span style="color: #bdc3c7">Added</span>
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
                    location.reload(true);
                    $("#ref_div").load(window.location.href + " #ref_div");
                }
            });

        });
    </script>

     @endforeach

    </tbody>

  </table>



  <div class="div-table">

  <table class="table table-two">

    <tbody class="tbody-tr-td">

        <tr class="tbody-tr-td">

            <th>Subtotal :</th>

            <td class="tbody-tr-td">${{number_format($cal_reg_amount, 2)}}

        </tr>

        <tr class="tbody-tr-td">

            <th class="hst"><b>HST 13% (830275681RRT0001)</b></th>

            <?php

                $subtotal = $cal_reg_amount*0.13;

                $stotal = $cal_reg_amount+$subtotal;

            ?>

            <td class="tbody-tr-td">${{number_format($subtotal, 2)}}</td>

        </tr>

        <tr class="tbody-tr-td">

        <th style="width:50%">Total :</th>

        <td class="tbody-tr-td">${{number_format($stotal, 2)}}</td>

        </tr>


        </tbody>



  </table>

</div>

<?php
    $update = DB::table('multiple_estimate')
        ->where('id', $user[0]->id)
        ->update([
            'reg_amount_tax' => $stotal,
        ]);

    ?>



</section>


<section class="main-section" id="invoice" style="width:90%" hidden>

<div class="meinhaus-header">

    <div class="meinhuas-content">

        <img src="{{url('public/image/logo-img.png')}}" alt="logo" srcset="">

        <ul>



            <p>{{ ucwords($user[0]->name) }}</p>

            <p style="font-weight: 400">{{ ucfirst($user[0]->locality) }} <br>{{ ucfirst($user[0]->city) }}, {{ ucfirst($user[0]->pincode) }} <br>{{ ucfirst($user[0]->state) }}</p>

            <p  style="font-weight: 400">{{ $user[0]->phone_no }}<br>{{ $user[0]->email }}</p>

        </ul>

    </div>

    <div class="meinhuas-content estimate">

      <h1>Invoice</h1>

      <p>{{$user[0]->booking_show_id}}</p>

      <p><b>MeinHaus</b></p>

      <p>251 Queen Street South<br> Mississauga, ON L5M1L2 <br>Canada</p>

      <p>1(844)777-4287<br>www.meinhaus.ca</p>

    </div>

</div>



<table class="table">

    <thead class="thead-tr">

      <tr class="thead-tr">

        <th class="thead-tr-th">Project Area</th>

        <th class="thead-tr-th">Deposit Amount</th>

        <th class="thead-tr-th">Project Cost</th>

      </tr>

    </thead>

    <tbody class="tbody-tr-td">

        <?php

        $mse_filter = DB::table('multiple_estimate_services')->where('estimate_id',$user[0]->id)->where('paying_status',1)->get();

        ?>

    @foreach($mse_filter as $m)
        <?php $service_pdf = DB::table('services')->where('id',$m->service_id)->get();?>

      <tr class="tbody-tr-td">

        <td class="tbody-tr-td"><b>{{ucwords($service_pdf[0]->name)}}</b><br>
        <div style="width: 10cm; overflow-wrap: break-word;">
            {{ ucfirst($m->description) }}
        </div>
        </td>

        <td class="tbody-tr-td">${{number_format($m->reg_amount, 2)}}</td>

        <td class="tbody-tr-td">${{number_format($m->amount, 2)}}</td>

      </tr>

     @endforeach

    </tbody>

  </table>

  <div class="div-table">

  <table class="table table-two">

    <tbody class="tbody-tr-td">

        <tr class="tbody-tr-td">

            <th>Subtotal :</th>

            <td class="tbody-tr-td">${{number_format($cal_reg_amount, 2)}}</td>

        </tr>

        <tr class="tbody-tr-td">

            <th class="hst"><b>HST 13% (830275681RRT0001)</b></th>


            <?php

                $subtotal = $cal_reg_amount*0.13;

                $stotal = $cal_reg_amount+$subtotal;

            ?>

            <td class="tbody-tr-td">${{number_format($subtotal, 2)}}</td>

        </tr>

        <tr class="tbody-tr-td">

        <th style="width:50%">Total :</th>

        <td class="tbody-tr-td">${{number_format($stotal, 2)}}</td>

        </tr>



        </tbody>



  </table>

</div>



</section>


<div class="container main-calender">

    <form role="form" action="{{url('multiple-estimate-payment-done/'.$booking_id)}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_test_51LZVObSBB4uLDn3soOtn35F6RzvKHwZL5l367GvWWD0EV2k5M0i1d1uWH8TG10X6YQNLI5liWMgqRhzI1uVa4Jby00By4FBbLw" id="payment-form">

        @csrf

  <div class="row">

    <div class="col-lg-6">

      <!--div id="calendar"></div--><div id="element" style="max-width: 310px !important;"></div><p>Please select your desired project date</p>

    </div>

    <div id="ref_div">
    <div class="col-lg-6">

      <p><strong>Pay with credit or debit card @if($user[0]->payment_status == 0) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="ml-5" type="submit" style="font-size:12px;text-decoration: none; color:white; cursor: -webkit-grab; cursor: grab;font-weight:bold;">Book Today!</button>@endif</strong></p>

      <img src="{{url('public/image/visa-option.jpg')}}" alt=""><br>

        <input type="text" id="name" name="name" placeholder="Name on card">

        <input type="number" id="card" name="card" placeholder="Card Number" class="card-number">

        <input type="number" id="cvv" name="cvv" placeholder="CVV" class="card-cvc" style="width: 150px;"><br>

        <input type="number" id="mm" name="mm" placeholder="MM" class="card-expiry-month">

        <input type="number" id="yy" name="yy" placeholder="YYYY" class="card-expiry-year">

        <input type="text" value="${{number_format($user[0]->reg_amount_tax, 2)}}" readonly style="width: 150px;"><br>

        <input type="checkbox" id="save-card" name="save-card" value="Boat">

        <input type="hidden" name="reg_amount" value="<?php echo $user[0]->reg_amount_tax;?>">

        <label for="vehicle3"> Save this credit card and allow MeinHaus to</label>

    </div>
    </div>

  </div>

  </form>

</div>




<!-- Modal -->

<!-- Modal end -->



</body>

<script>
function generatePDF() {
    document.getElementById('invoice').hidden = false;
	const element = document.getElementById('invoice');
    const opt = {
        filename: '{{ $user[0]->title }}.pdf'
    };
	html2pdf().set(opt).from(element).save();
	window.setTimeout(function(){document.getElementById('invoice').hidden = true;},0.2)
}
</script>

<script>

                // initialize Calendar component

                var calendar = new ej.calendars.Calendar();



                // Render initialized button.

                calendar.appendTo('#element')

            </script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>





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

                exp_year: $('.card-expiry-year').val()



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

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"> </script>







</html>
