@extends('website.layouts.master')

@section('after-style')

<style type="text/css">

body {

    background-color: #f7f8f9;

}

.card {

    background-color: #ffffff;

    border: 1px solid rgba(0, 34, 51, 0.1);

    box-shadow: 2px 4px 10px 0 rgba(0, 34, 51, 0.05), 2px 4px 10px 0 rgba(0, 34, 51, 0.05);

    border-radius: 0.15rem;

}



/* Tabs Card */



.tab-card {

  border: 1px solid #eeeeee52;

  background-color: #f1f1f126;

  padding-bottom: 3%;

}



.tab-card-header {

  background:none;

}

/* Default mode */

.tab-card-header > .nav-tabs {

  border: none;

  margin: 0px;

}

.tab-card-header > .nav-tabs > li {

  margin-right: 13px;

  background-color: #1e9bd0;

  /* color: #fff; */

}

.tab-card-header > .nav-tabs > li > a {

    border: 0;

    /* border-bottom: 2px solid transparent; */

    margin-right: 0;

    color: #ffff;

    text-transform: uppercase;

    font-size: 19px;

    font-weight: bold;

    margin-left: 1px;

    padding: 2px 15px;

}


.tab-card-header > .nav-tabs > li > a.show {

    border-bottom:2px solid #007bff;

    color: #007bff;

}

.tab-card-header > .nav-tabs > li > a:hover {

    color: #007bff;

}



.tab-card-header > .tab-content {

  padding-bottom: 0;

}



.card-header {

    float: left;

    width: 100%;

    padding-left: 32em !important;

    /* padding: 10px 21px; */

    /* padding: .75rem 30.25rem !important; */

    margin-bottom: 0;

    /* text-align: center; */

    background-color: rgba(0,0,0,.03);

    border-bottom: 1px solid rgba(179, 179, 179, 0.125);

}

.choose{float: left;font-size: 20px;font-weight: bold;margin: 0;background-color: #e3e4e440;border-radius: 4px;padding: 11px 8px;color: #565252;margin-top: 13px;}

</style>

@endsection

@section('content')

<div class="container-fluid" style="text-align: center;margin-top:185px">

  <h3>OFFERS</h3>

<section class="py-0 mt-5">

  @forelse($promocodes as $promocode)

<div class="row">

<div class="col-md-12 col-12 col-lg-12 col-sm-12">	



<div class="bg-offer-1" style="

background-image: url('{{asset('/promo_image/'.$promocode->promo_image)}}');">

	<div class="row">

	<div class="col-md-6 col-12">

		<div class="box-offer-left">

	<h5 class="offer-text">{{$promocode->name}}</h5>

	<h5 class="offer-text-1">FLAT</h5>

	<h5 class="offer-text-2">{{$promocode->price}}</h5><p class="offer-text-p"> {{$promocode->description}}</p>

	<h5 class="offer-text-3">OFF</h5>

</div><!--box-oofer-left-->

</div><!--6-->

<div class="col-md-6">

	<div class="box-offer-right">

		 <img class="side-offer-gif" src="{{asset('image/offer.gif')}}">

	<h5 class="right-offer-t">{{$promocode->code}}</h5>

	<h5 class="right-offer-c">Use This Coupon Code</h5>

</div><!--box-offer-right-->

</div><!--6-->

</div><!--row-->

</div><!--bg-offer-->



</div><!--cols-->

</div><!--row-->
@empty
<div class="border-bottom-inner-side mt-2 text-center" style="border: none!important;padding-bottom: 0%!important;padding: 0px!important;    margin-bottom: 27px;">
  <!-- <h2 style="font-size: 27px;">No Bookings Yet</h2> -->
  <img src="{{asset('image/no-data3.png')}}" height="132px">
</div>
@endforelse

</section>

</div>





<!-------professional-tab----------->

<!-- <div class="container">

  <div class="row">

  	<div class="col-md-12 col-12 col-sm-12 col-lg-12">

  		<h5 class="choose">Choose Your package</h5>

  	</div>

    <div class="col-12 col-md-12 text-center">

      <div class="card mt-3 tab-card">

        <div class="card-header tab-card-header">

        		<div class="border-user" style="float: left;

    border: 1px solid #c1bebc4a;

    height: 2px;

    width: 41%;

    margin-top: 14px;"></div>

          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">



            <li class="nav-item">

                <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Monthly</a>

            </li>

            <li class="nav-item">

                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Yearly</a>

            </li>

          

          </ul>

          <div class="border-user"></div>

        </div>



        <div class="tab-content" id="myTabContent">

          <div class="col-md-12 col-12 col-lg-12 tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">

          	<div class="row">

            <div class="col-md-2 col-2">

            	<div class="right-box-user"></div>

            	<div class="circle-user"><i class="fa fa-money" aria-hidden="true" id="side-b"></i></div>

            </div>

            <div class="col-md-10 col-10">

            	    <div class="clear-user">

       <h5 class="head-user">Monthly Package</h5>

       <h4 class="first-user">Membership monthly charges</h4><span class="side-span">$23.4</span>

        <h4 class="first-user">Membership monthly charges</h4><span class="side-span">$23.4</span>

   <h6 class="bottom-user">Total Amount payable</h6><span class="side-span-1">$74.97</span>

            <a href="#" class="btn btn-primary-new">Pay Now</a>

        </div>

        </div>  

        </div>        

          </div>

 <div class="col-md-12 col-12 col-lg-12 tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">

          	<div class="row">

            <div class="col-md-2 col-2">

            	<div class="right-box-user"></div>

            	<div class="circle-user"><i class="fa fa-money" aria-hidden="true" id="side-b"></i></div>

            </div>

            <div class="col-md-10 col-10">

            	    <div class="clear-user">

       <h5 class="head-user">Yearly Package</h5>

       <h4 class="first-user">Membership monthly charges</h4><span class="side-span">$23.4</span>

        <h4 class="first-user">Membership monthly charges</h4><span class="side-span">$23.4</span>

   <h6 class="bottom-user">Total Amount payable</h6><span class="side-span-1">$74.97</span>

            <a href="#" class="btn btn-primary-new">Pay Now</a>

        </div>

        </div>  

        </div>        

          </div>

        </div>

      </div>

    </div>

  </div>

</div> -->

@endsection