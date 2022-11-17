<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice bill</title>
 <?php

                            $regtotal = $invoice->amount * 0.13;

                            $rtotal = $invoice->amount + $regtotal;

                            ?>
<style>
.top {
	float: right;
	margin: 0;
	font-size: 18px;
	font-weight: bold;
	padding-right: 24px;
	font-family: 'Poppins', sans-serif;
}
.side {
	clear: both;
	padding-top: 6px;
	text-align: right;
	font-size: 12px;
	letter-spacing: 1px;
	font-family: 'Poppins', sans-serif;
}
.top-1 {
	float: left;
	margin: 0;
	font-size: 18px;
	font-weight: bold;
	padding-right: 24px;
	font-family: 'Poppins', sans-serif;
}
.side-1 {
	clear: both;
	padding-top: 6px;
	text-align: left;
	font-size: 12px;
	letter-spacing: 1px;
	font-family: 'Poppins', sans-serif;
}
.side-2 {
	clear: both;
	padding-top: 6px;
	text-align: right;
	font-size: 12px;
	letter-spacing: 1px;
	font-family: 'Poppins', sans-serif;
}
table {
	width: 100%;
	border-collapse: collapse;
	margin: 2px auto;
}
.bottom-text {
	float: left;
	text-transform: uppercase;
	font-size: 15px;
	color: #000;
	font-weight: bold;
	cursor: pointer;
	letter-spacing: 1px;
	font-family: 'Poppins', sans-serif;
}
.bottom-para {
	/* float: left; */
	font-size: 12px;
	color: #000;
 font-weight:;
	clear: both;
	cursor: pointer;
	line-height: 28px;
	font-family: 'Poppins', sans-serif;
}
/* Zebra striping */
tr:nth-of-type(odd) {
	background: #fff;
}
th {
	background: #6a9eff;
	color: white;
	/* width: 100%; */
	font-weight: bold;
}
td, th {
	padding: 10px;
	letter-spacing: 1px;
	border: 1px solid #ccc;
	text-align: left;
	font-family: 'Poppins', sans-serif;
	padding: 22px 38px;
	font-size: 13px;
}
.side-heading-four {
	float: right;
	text-transform: uppercase;
	font-size: 12px;
	color: #000;
	margin-right: 1%;
	text-align: center;
	font-weight: bold;
	cursor: pointer;
	overflow-y: hidden;
	overflow-x: hidden !important;
	padding: 14px -1px !important;
	letter-spacing: 1px;
	padding-top: 6px;
	clear: both;
	font-family: 'Poppins', sans-serif;
}
.side-heading-span {
	float: right;
	text-transform: uppercase;
	font-size: 12px;
	color: #000;
	clear: both;
	padding-right: 3%;
	cursor: pointer;
	padding-top: 1px;
	letter-spacing: 1px;
	font-family: 'Poppins', sans-serif;
}
.side-right-bottom {
	text-align: right;
	padding-top: 7px;
	padding-right: 5%;
}
.top-heading-one {
	font-family: 'Poppins', sans-serif;
	font-size: 18px;
	margin: 0;
}
.side-heading-bold {
	font-family: 'Poppins', sans-serif;
	font-size: 14px;
}
.td-left {
	width: 40%;
	border-bottom: 1px solid #d2d2d2;
	border-top: none;
	border-left: none;
	border-right: none;
}
.td-top {
	border-bottom: 1px solid #d2d2d2;
	border-top: none;
	border-left: none;
	border-right: none;
}
.side-heading-three {
	/* margin: 4px 0px; */
	color: #656464;
}
</style>
</head>

<body>
<div class="information">
    <button style="border-radius:10px;padding:10px;margin:10px;background-color:#e74c3c;margin-bottom:-10px !important float:left;"><a style="color:white;" href="{{url('invoices/'.$invoice->pdf)}}"><i class="fas fa-download"></i>
                Download as PDF</a></button>
  <table width="100%">
      
    <tr>
      <td align="right" class="td-top"><h3 class="top">Invoice</h3>
        <pre class="side">
                   MEINHAUS APP COMPANY
                   251 QUEEN STREET S. UNIT 3,
                   MISSISSAUGA ON
                   L5M 1L2
                   1(844) 777-HAUS (4287)
                   WWW.MEINHAUS.CA

                </pre></td>
    </tr>
  </table>
</div>
<div class="information">
  <table width="100%">
    <tr>
      <td align="left" class="td-left"><h3 class="top-1">Bill To</h3>
        <pre class="side-1">
{{$invoice['userDetails']['name']}}
<p style="word-break: break-all;">{{$invoice->address}}</p>
{{$invoice->city}}

{{$invoice['userDetails']['phone']}}
{{$invoice['userDetails']['email']}}
                </pre></td>
<td align="right" class="td-top"><pre class="side-2">
BOOKING-ID      :  {{$invoice->booking_show_id}}
BOOKING-DATE    :  {{date('d-m-Y',strtotime($invoice->date))}}
PAYMENT-DUE     :  {{date('d-m-Y',strtotime($invoice->date))}}
AMOUNT-DUE (CAD):  $ {{number_format($rtotal,2)}}
</pre></td>
    </tr>
  </table>
  <div class="information">
    <table>
      <thead>
        <tr>
          <th>Items</th>
          @if($invoice->custom_booking == 0)
          <th>Total Hrs / Sqfs</th>
          <th>Price</th>
          @endif
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-column="First Name"><span class="bottom-text">{{$invoice['serviceDetails']['name']}}</span>
          <p class="bottom-para">{{$invoice['serviceDetails']['description']}}</p></td>
          @if($invoice->custom_booking == 0)
          <td data-column="Last Name">
              @if($invoice['serviceDetails']['service_type'] == 0)
              {{gmdate("H:i", $invoice->total_service_time)}} hrs
              @else
              {{$invoice->total_sqfs ? $invoice->total_sqfs : '1'}} sqfts
              @endif
              </td>
          <td data-column="Job Title">$ {{$invoice['serviceDetails']['price']}} / {{$invoice['serviceDetails']['time']}} 
          @if($invoice['serviceDetails']['service_type'] == 0)
          hr
          @else
          
          sqfts
          @endif
          </td>
          @endif
          <td data-column="Twitter">$ {{$invoice->amount}}</td>
        </tr>
      </tbody>
    </table>
   <div class="side-right-bottom"> <span class="side-heading-three">Subtotal</span><span class="side-heading-three">:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;$ {{$invoice->amount}}</span><br>
    
      <span class="side-heading-three">HST 13%</span><span class="side-heading-three">:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;$ {{number_format($regtotal, 2)}}</span><br>
      <span class="side-heading-three">Total</span><span class="side-heading-three">:&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;$ {{number_format($rtotal, 2)}}</span><br>
      <span class="side-heading-three">Total-Due</span><span class="side-heading-three">:&nbsp; &nbsp; &nbsp;&nbsp;$ {{number_format($rtotal, 2)}}</span> </div>
  </div>
  <div class="side-left">
    <h4 class="top-heading-one">Notes And Terms</h4>
    <span class="side-heading-bold">Balance will be processed on credentials previously provided. Client to authorize once project has been completed and satisfied.</span> </div>
</div>
</body>
</html>
