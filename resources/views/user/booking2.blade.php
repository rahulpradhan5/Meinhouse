@extends('user.layout.layout') @section('content')
    <!--header end -->

    <!-- page-title -->

    <div class="ttm-page-title-row text-center">
        <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box ttm-textcolor-white">
                        <div class="page-title-heading">
                            <h1 class="title">Dashboard</h1>
                        </div>

                        <!-- /.page-title-captions -->
                    </div>
                </div>

                <!-- /.col-md-12 -->
            </div>

            <!-- /.row -->
        </div>

        <!-- /.container -->
    </div>

    <!-- page-title end-->

    <div class="site-main">
        <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="service-title">Service Details</h4>
                    </div>

                    <!--   <div class="col-md-4" >

                       <button class="text-right" style="float: right;background-color: #1e9bd0;">View All Jobs</button>

                       </div> -->
                </div>
            </div>

            <section class="py-0">
                <div class="container">
                    <div class="row">
                        <div class="main-section mt-2">
                            <div class="col-md-12">
                                <div class="large-box">
                                  

                                    <h2 class="head">
                                        Service Details
                                    </h2>
                                </div>

                                <!--large-box-->
                            </div>
                            @php

                                if ($booking->time == 0) {
                                    $timeval = 'Morning(8-11 AM)';
                                }

                                if ($booking->time == 1) {
                                    $timeval = 'Midnoon(11-2 PM)';
                                }

                                if ($booking->time == 2) {
                                    $timeval = 'Afternoon(2-5 PM)';
                                }

                                if ($booking->time == 3) {
                                    $timeval = 'Evening(5-8 PM)';
                                }

                            @endphp
                        </div>
                        <div class="col-md-12" style="border-bottom: 1px solid #1ec1e6">
                            @if (session('error'))
                                <div class="alert alert-danger">

                                    {{ session('error') }}

                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="border-bottom-left mt-2">
                                        <a href="#" class="info" style="padding-top: 3%">Name</a><span
                                            class="side-info">{{ $booking->name }}</span>
                                        <span class="side-info1"
                                            style="
                                                            font-weight: 700 !important;
                                                        ">{{ $booking->booking_show_id }}</span>

                                        <span class="side-info1">{{ $booking->area }}</span>

                                        <span class="side-info-top">{{ $booking->locality }}</span>

                                        <span class="side-info1-center"
                                            style="
                                                            clear: both;
                                                            float: left;
                                                        ">{{ $booking->city }}</span>

                                        <span class="side-info1-bottom"
                                            style="
                                                            clear: both;
                                                            float: left;
                                                        ">{{ $booking->pin_code }}
                                            - {{ $booking->state }}</span>
                                    </div>
                                </div>

                                <!--div-->

                                <div class="col-md-6">
                                    <div class="border-bottom-inner mt-2">
                                        <a class="info-anchr">DAY OR TIME</a><span class="side-info"
                                            style="float: right">{{ date('D,d M Y', strtotime($booking->date)) }}</span>

                                        <i class="fa fa-clock-o" id="clock"></i><span
                                            class="side-info-inner">{{ $timeval }}</span>

                                        <a class="info-anchr">SERVICE</a><span
                                            class="side-info-install">{{ $booking['serviceDetails']['name'] }}</span>

                                        <a class="info-anchr">SERVICE PROVIDER</a>
                                        <span class="side-info-install" style="left: 26rem">
                                            @if ($booking->proDetails)
                                                {{ $booking->proDetails->name }}
                                            @else
                                                NA
                                            @endif
                                        </span>
                                        <a class="info-anchr">SERVICE PROVIDER
                                            RATING</a>
                                        <span class="side-info-install" style="left: 26rem">
                                            @if (isset($review_avg))
                                                @for ($i = 0; $i < round($review_avg); $i++)
                                                    <i class="fa fa-star" style="color: gold!important;"></i>
                                                @endfor
                                            @else
                                                <i class="fa fa-star" style="color: gold!important;"></i>
                                                <i class="fa fa-star" style="color: gold!important;"></i>
                                                <i class="fa fa-star" style="color: gold!important;"></i>
                                                <i class="fa fa-star" style="color: gold!important;"></i>
                                                <i class="fa fa-star-half" style="color: gold!important;"></i>
                                            @endif
                                        </span>
                                        @if ($count > 0)
                                            <a class="info-anchr">Jobs Done</a>
                                            <span class="side-info-install" style="left: 26rem;">{{ $count }}</span>
                                        @endif
                                        <!-- <i
                                                                class="fa fa-star"
                                                                style="
                                                                color: gold !important;
                                                            "
                                                            ></i>
                                                            <i
                                                                class="fa fa-star"
                                                                style="
                                                                color: gold !important;
                                                            "
                                                            ></i>
                                                            <i
                                                                class="fa fa-star"
                                                                style="
                                                                color: gold !important;
                                                            "
                                                            ></i>
                                                            <i
                                                                class="fa fa-star"
                                                                style="
                                                                color: gold !important;
                                                            "
                                                            ></i>
                                                            <i
                                                                class="fa fa-star-half"
                                                                style="
                                                                color: gold !important;
                                                            "
                                                            ></i> -->

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <a href="#" class="info-mid">Service Charge</a>
                        </div>

                        <div class="col-md-12" style="border-bottom: 1px solid #1ec1e6">
                            @if ($booking->booking_status == 5 || $booking->booking_status == 7)
                                @if ($booking->custom_booking == 1)
                                    <div class="border-bottom-down-2 mt-2">

                                        <span class="side-info1-left">Total Amount<a class="info-panel-one">$
                                                {{ $booking->amount }}</a></span>

                                    </div>
                                @else
                                    @if ($booking['serviceDetails']['service_type'] == 0)
                                        <div class="border-bottom-down-2 mt-2">

                                            <span class="side-info1-inner">Total Service Time<a
                                                    class="info-panel">{{ gmdate('H:i', $booking->total_service_time) }}</a></span>

                                            <span class="side-info1-left">Total Amount<a class="info-panel-one">$
                                                    {{ $booking->amount }}</a></span>

                                        </div>
                                    @else
                                        <div class="border-bottom-down-2 mt-2">

                                            <span class="side-info1-inner">Total Sqfts<a
                                                    class="info-panel">{{ $booking->total_sqfs }}</a></span>

                                            <span class="side-info1-left">Total Amount<a class="info-panel-one">$
                                                    {{ $booking->amount }}</a></span>

                                        </div>
                                    @endif
                                @endif
                            @else
                                @if ($booking->custom_booking == 1)
                                    <div class="border-bottom-down-2 mt-2">

                                        <span class="side-info1-left">Total Amount<a class="info-panel-one">$
                                                {{ $booking->amount }}</a></span>

                                    </div>
                                @else
                                    @if ($booking['serviceDetails']['service_type'] == 0)
                                        <div class="border-bottom-down-2 mt-2">

                                            <span class="side-info1-inner">For the first
                                                {{ $booking['serviceDetails']['time'] }} hour<a class="info-panel">$
                                                    {{ $booking['serviceDetails']['price'] }}</a></span>

                                            <span class="side-info1-left">for Each Additional Hour<a
                                                    class="info-panel-one">$
                                                    {{ $booking['serviceDetails']['add_price'] }}</a></span>

                                        </div>
                                    @else
                                        <div class="border-bottom-down-2 mt-2">

                                            <span class="side-info1-inner">Estimated area(sqft)
                                                {{ $booking['serviceDetails']['time'] }} sqft<a class="info-panel">$
                                                    {{ $booking['serviceDetails']['price'] }}</a></span>

                                            <span class="side-info1-left">for Each Additional sqft<a
                                                    class="info-panel-one">$
                                                    {{ $booking['serviceDetails']['add_price'] }}</a></span>

                                        </div>
                                    @endif
                                @endif
                            @endif

                            <div class="col-md-12 pb-2 pt-2" style="clear: both">
                                <a class="info-down-side">Status</a>

                                <div class="py-0">
                                    @if ($booking->booking_status == 0)
                                        <h3 class="my-button-1" style="margin-top:3%;cursor: default;">Pending</h3>
                                    @endif

                                    @if ($booking->booking_status == 1)
                                        <button class="my-button-1"
                                            style="margin-top:3%;cursor: default;">Confirmed</button>
                                    @endif

                                    @if ($booking->booking_status == 5)
                                        <button class="my-button-1" style="margin-top:3%;cursor: default;">Payment
                                            Pending</button>
                                    @endif

                                    @if ($booking->booking_status == 6)
                                        <button class="my-button-1" style="margin-top:3%;cursor: default;">Service
                                            Start</button>
                                    @endif

                                    @if ($booking->booking_status == 2)
                                        <button class="my-button-1"
                                            style="margin-top:3%;cursor: default;">Rejected</button>
                                    @endif

                                    @if ($booking->booking_status == 3)
                                        <button class="my-button-1"
                                            style="margin-top:3%;cursor: default;">Cancelled</button>
                                    @endif

                                    @if ($booking->booking_status == 4)
                                        <button class="my-button-1" style="margin-top:3%;cursor: default;">Time
                                            Exceeds</button>
                                    @endif

                                    @if ($booking->booking_status == 7)
                                        <button class="my-button-1" style="margin-top:3%;cursor: default;">Payment
                                            Completed</button>
                                    @endif

                                    @if ($booking->booking_status == 8)
                                        <button class="my-button-1" style="margin-top:3%;cursor: default;">Admin
                                            Cancel</button>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 pb-2 pt-2" style="clear: both">
                                {{-- <a
                                                href="{{url('dashboard')}}"
                                                ><button
                                                    class="my-button"
                                                    style="
                                                        float: left;
                                                        position: relative;
                                                        margin-top: 3%;
                                                        letter-spacing: 1px;
                                                        left: 39rem;
                                                        background-color: #054816 !important;
                                                    "
                                                >
                                                    Go Back
                                                </button></a
                                            >
                                            <a id="cancelBookingBtn"
                                                ><button
                                                    class="my-button"
                                                    style="
                                                        margin-top: 3%;
                                                        background-color: #1e9bd0 !important;
                                                    "
                                                >
                                                    Cancel Booking
                                                </button></a
                                            > --}}

                                <!--  -->
                                @if ($booking->booking_status == 0 || $booking->booking_status == 1)
                                    <a href="{{ URL::previous() }}"><button class="my-button"
                                            style="float: left;position: relative;margin-top: 3%;letter-spacing:1px;left: 39rem;background-color: #054816!important;">Go
                                            Back</button></a>
                                    <a id="cancelBookingBtn"><button class="my-button"
                                            style="margin-top:3%;background-color: #1e9bd0!important;">Cancel
                                            Booking</button></a>
                                @endif

                                <!--@if ($booking->booking_status == 7)-->
                                    <!--<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-primary" style="margin-top:15px;">Review Professional</button>-->
                                <!--    <button type="button" class="btn btn-primary" data-toggle="modal"-->
                                <!--        data-target="#exampleModal" data-whatever="">Review Professional</button>-->
                                <!--@endif-->

                                @if ($booking->booking_status == 5)
                                    <form action="{{ url('payment-make') }}" method="POST" name="pay">
                                        @csrf
                                        <input type="hidden" name="amount" id="amount"
                                            value="{{ $booking->amount }}">
                                        <input type="hidden" name="booking_id" id="booking_id"
                                            value="{{ $booking->id }}">
                                        <input type="hidden" name="service_time" id="service_time"
                                            value="{{ gmdate('H:i', $booking->total_service_time) }}">
                                        <button type="submit" class="btn btn-primary float-right"
                                            style="margin-top: 26px;">Pay Now</button>
                                    </form>

                                    <!--@if (isset($booking->pdf))-->
                                    <!--    <a href="{{ url('invoices/' . $booking->pdf) }}" target="_blank"><button-->
                                    <!--            class="my-button-1" style="margin-top: 26px;">Generate-->
                                    <!--            Invoice</button></a>-->
                                    <!--@endif-->
                                @endif
                                    @if(isset($booking->pdf))
                    <a href="{{url('view-invoice/'.$booking->pdf)}}"><button class="my-button-1" style="margin-top: 26px;">Generate Invoice</button></a>
                    @endif


                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Review Proffesional
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="center-img">
                        <i class="fa fa-user" aria-hidden="true" id="user"></i>
                    </div>
                    <h3 class="title-text"></h3>
                    <form method="post" id="user-rating-form" name="user-rating-form" action="#"
                        novalidate="novalidate">
                        <input type="hidden" name="_token" value="8rUrCIqBdnTg8QpNOIrmvcVOinqEFRCfQTb3bonh" />
                        <input type="hidden" name="pro_id" value="" />
                        <input type="hidden" id="selected-rating" name="stars" value="" />
                        <div class="center-star">
                            <span class="user-rating">
                                <input type="radio" name="rating" value="5" /><span class="star"></span>

                                <input type="radio" name="rating" value="4" /><span class="star"></span>

                                <input type="radio" name="rating" value="3" /><span class="star"></span>

                                <input type="radio" name="rating" value="2" /><span class="star"></span>

                                <input type="radio" name="rating" value="1" /><span class="star"></span>
                            </span>
                            <!--<i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>-->
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="reviews" name="reviews" placeholder="Write Something"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Not Now
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--cancel booking reason modal-->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">
                        Reason For Cancellation
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ url('cancel-booking') }}" method="POST" name="cancel-booking" id="cancel-booking">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Please provide valid Reason for
                                cancellation of the booking</label>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Reason:</label>
                            <textarea class="form-control" id="cancel_reason_u" name="cancel_reason_u"></textarea>
                            <input type="hidden" name="booking_id" id="booking_id" value="{{ $booking->id }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="Submit" class="btn btn-primary">
                            Send message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--modal end-->
    </div>

    <!-- footer start-->
@endsection
