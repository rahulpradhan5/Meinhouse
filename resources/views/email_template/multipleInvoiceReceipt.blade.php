<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    body
    {
      font-family: 'Open Sans', sans-serif;
      width: 21cm;
      height: auto;
      margin: 0 auto;
    }

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
    .meinhaus-header .meinhuas-content {width: 44%;float: left;padding-left: 40px;}
    .meinhaus-header .meinhuas-content.estimate{padding-left: 0;padding-right: 40px;}
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
    thead tr{background:#541a1a;}
    thead tr th{text-align: left;color: #fff;padding: 10px 15px;}
    tbody tr td{padding: 10px 15px;}
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
    padding-left: 15px;
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

</style>
<body>

    <?
        // $user = DB::table('estimates')->join('estimate_booking_transaction', 'estimates.booking_show_id', "=", 'estimate_booking_transaction.booking_id')->where('estimates.booking_show_id', $BookingId)->get(array(
        //     'name',
        //     'booking_show_id',
        //     'transaction_id',
        //     'phone_no',
        //     'email',
        //     'estimate_booking_transaction.amount',
        //     'address',
        //     'city',
        //     'service_id',
        //     'reg_amount',
        //     'estimates.amount',
        //     'description',
        //     'payment_status'
        // ));

        $user = DB::table('multiple_estimate')->where('booking_show_id',$BookingId)->get();
        $user_invoice = DB::table('multiple_estimate_services')->where('estimate_id',$user[0]->id)->where('paying_status',1)->get();
        $transaction = DB::table('estimate_booking_transaction')->where('booking_id',$BookingId)->first();


    ?>

    <div style="margin-left:76%;">
    <button style="border-radius:10px;padding:10px;background-color:#e74c3c;margin-bottom:-10px !important;"><a onclick="generatePDF()" href="javascript:;"><i class="fas fa-download"></i> Download as PDF</a></button>
</div>

<section class="main-section" id="invoice">
<div class="meinhaus-header">
    <div class="meinhuas-content">
        <img src="{{url('public/image/logo-img.png')}}" alt="logo" srcset="">
        <ul>
        <p style="font-size:15px;">BILL TO</p>

        <p>{{ ucwords($user[0]->name) }}</p>

        <p style="font-weight: 400">{{ ucfirst($user[0]->locality) }} <br>{{ ucfirst($user[0]->city) }}, {{ ucfirst($user[0]->pincode) }} <br>{{ ucfirst($user[0]->state) }}</p>

        <p  style="font-weight: 400">{{ $user[0]->phone_no }}<br>{{ $user[0]->email }}</p>

        </ul>
    </div>
    <div class="meinhuas-content estimate">
      <h1>Receipt</h1>
      <p><b>MeinHaus</b></p>
      <p>251 Queen Street South<br> Mississauga, ON L5M1L2 <br>Canada</p>
      <p>1(844)777-4287<br>www.meinhaus.ca</p>
    </div>
</div>

<table class="table">
    <thead>
      <tr style="white-space:nowrap">
        <th>Items</th>
        <th>Quantity</th>
        <th>Deposit Amount</th>
        <th>Project Cost</th>
      </tr>
    </thead>
    <tbody>
        @foreach($user_invoice as $ms)
        <?php $service = DB::table('services')->where('id',$ms->service_id)->get();?>
      <tr>
        <td><b>{{ucwords($service[0]->name)}}</b> <br>
        <div style="width: 10cm; overflow-wrap: break-word;">
            {{ ucfirst($ms->description) }}
        </div>
        <td>1</td>
        <td>${{number_format($ms->reg_amount, 2)}}</td>
        <td>${{number_format($ms->reg_amount, 2)}}</td>
      </tr>

      @endforeach

    </tbody>
  </table>

  <?php
        $cal_amount = DB::table('multiple_estimate_services')->where('estimate_id',$user[0]->id)->where('paying_status',1)->sum('amount');
        $cal_reg_amount = DB::table('multiple_estimate_services')->where('estimate_id',$user[0]->id)->where('paying_status',1)->sum('reg_amount');
    ?>
  <div class="div-table">
  <table class="table table-two">
    <tbody>
        <tr>
            <th>Subtotal :</th>
            <td>${{number_format($cal_reg_amount, 2)}}</td>
        </tr>
        <tr>
            <th class="hst"><b>HST 13% (830275681RRT0001)</b></th>
            <td>${{number_format($cal_reg_amount*0.13, 2)}}</td>
        </tr>
        <tr>
        <th style="width:50%">Total :</th>
        <td>${{number_format($cal_reg_amount+$cal_reg_amount*0.13, 2)}}</td>
        </tr>
        <tr>
        <th class="hst">Amount Due Upon Completion :</th>
        <td>${{number_format($cal_amount-$cal_reg_amount+$cal_reg_amount*0.13, 2)}}</td>
        </tr>
        <p class="description-box">

            @if($user[0]->payment_status == 0)
                <button><a href="javascript:void(0)">Unpaid</a></button>
            @elseif($user[0]->payment_status == 1)
                <img src="{{url('public/image/paid-5025785_1280.webp')}}" width="165px" height="150px">
            @endif
        </p>

        </tbody>

  </table>
</div>

</section>
</body>

<script>
function generatePDF() {
    // document.getElementById('invoice').hidden = false;
	const element = document.getElementById('invoice');
    const opt = {
        filename: 'receipt.pdf'
    };
	html2pdf().set(opt).from(element).save();
// 	window.setTimeout(function(){document.getElementById('invoice').hidden = true;},0.2)
}
</script>
</html>
