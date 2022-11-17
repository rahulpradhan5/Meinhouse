@extends('website.layout.layout')
@section('content')
    <style type="text/css">
        .home_slider_image {
            height: 600px;
            background-image: url("http://meinhausca.com/public/slider_image/slider-mainbg-002.jpg");
        }

        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);


        max-width: 50em;
        margin: 5em auto;
        width: 100%;
        }

        .select-box {
            cursor: pointer;
            position: relative;

            .select,
            .label {
                color: #414141;
                display: block;
                font: 400 17px/2em 'Source Sans Pro', sans-serif;
            }

            .select {
                width: 94.5%;
                position: absolute;
                top: 0;
                padding: 5px 0;
                height: 40px;
                opacity: 0;
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                background: none transparent;
                border: 0 none;
            }

            .select-box1 {
                background: #ececec;

            }

            .label {
                position: relative;
                padding: 5px 10px;
                cursor: pointer;
            }

            .open .label::after {
                content: "▲";
            }

            .label::after {
                content: "▼";
                font-size: 12px;
                position: absolute;
                right: 0;
                top: 0;
                padding: 5px 15px;
                border-left: 5px solid #fff;
            }

            .title_left>form>h1 {
                color: white;
                text-align: center;
                padding-top: 100px;
                margin-top: 100px;
            }

            .ttm-processbox-wrapper .ttm-processbox img {

                background: white !important;
                padding: 19%;
            }

            @media only screen and (max-width: 900px) {
                .pstyle {
                    text-align: justify !important;
                    margin-right: 0px !important;
                }

                .hstyle {
                    text-align: center !important;
                }

                .calling_sec_img {
                    margin-left: 32px !important;
                }
            }

            .modal-backdrop {
                position: fixed;
                display: none;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 1 !important;
                background-color: red;
            }

    </style>
    <!--page start-->

    <div class="page">

        <!-- preloader start -->

        <div id="preloader">

            <div id="status">&nbsp;</div>

        </div>

        <!-- preloader end -->

        <!-- header start-->


        <div class="container-fluid" style="padding-top: 100px;">
            <div class="row home_slider_image">
                <div class="col-md-12 title_left" style="text-align: center;
                                    margin-top: 150px;color:white">

                    <form action="#">
                        <h1 style="text-align: center;
                                    color:white">WORLDS PREMIER ONLINE<br>GENERAL CONTRACTOR</h1>
                        <!--<h4 style="color:white;font-family:cinzel;"><center>Access to all local professionals.Hassle free</center></h4>-->
                        <div class="select-box">
                            <label for="select-box1" class="label select-box1">
                                <span class="label-desc">What can we help with you?</span>
                            </label><br>
                            <select id="select-box1" class="select" onChange="window.location.href=this.value"
                                style="width:33%">
                                @foreach ($services as $service)
                                    {{-- <option value="{{ url('mississauga/' . $service->url) }}">{{ $service->name }}</option> --}}
                                    <option value="">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h3 style="text-align: center;color:white;margin-top:10px;">OR</h3>
                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black"
                            href="http://meinhausca.com/public/custom-booking"
                            style="background-color: #1e9bd0;color:white;">Submit A Custom Request</a>
                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black"
                            data-toggle="modal" data-target="#myModalcustom"
                            style="background-color: #fda12b;color:white;cursor:pointer">Search Booking ID</a>
                    </form>

                </div>

            </div>
        </div>


        <!--site-main start-->
        <div class="site-main">

            <!--row-top-section-->
            <section class="ttm-row row-top-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title clearfix">
                                <div class="title-header">
                                    <h2 class="title">STOP CALLING AROUND</h2>
                                    <h5>MeinHaus is the easiest way to book quick, small jobs around the house.</h5>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="hstyle">Instant Booking</h3>
                                                <p class="pstyle" style="margin-right: 101px;">We're always
                                                    available via our large network of professionals; simply specify an
                                                    ideal time for you and we'll match you with a nearby pro. All rates are
                                                    pre-set, so you know you're always paying an industry average rate,
                                                    without having to research, price compare, and go back and forth
                                                    haggling with each company.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <img class="calling_sec_img"
                                                    src="http://meinhausca.com/public/image/instant.jpg">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="calling_sec_img"
                                                    src="http://meinhausca.com/public/image/pros.jpg">
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="hstyle">Only Amazing Pros</h3>
                                                <p class="pstyle" style="margin-right: 101px;">Each company goes
                                                    through a thorough vetting process, and are held to a high standard as
                                                    rated by other users. After the job, you'll be billed via credit card
                                                    and prompted to rate your pro. We're so confident we'll deliver an
                                                    exceptional experience, that if anything didn't go perfectly, simply let
                                                    us know and we'll do everything we can to make it right.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ttm-row row-top-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title clearfix">
                                <div class="title-header">
                                    <h2 class="title">SERVICES</h2>
                                    <h5>We provide</h5>
                                    <div class="container">
                                        <div class="row text-center">
                                            @foreach ($services as $service)
                                                <div class='service hidden-xs'>
                                                    <a href="{{ url('service-detail/' . $service->url) }}"><img
                                                            class="mx-auto img-fluid" alt="{{ $service->name }}"
                                                            src="{{ url('public/services/' . $service->service_image) }}" />
                                                        <span>{{ $service->name }}</span>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <!--processbox-section-->
            <section class="ttm-row processbox-section break-991-colum clearfix">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <!-- section title -->
                            <div class="section-title with-desc title-style-center_text clearfix">
                                <div class="title-header">

                                    <h2 class="title">HOW IT WORKS</h2>
                                    <h5>Follow 4 Easy Steps</h5>
                                </div>
                                <!-- <div class="title-desc">?<div> -->
                            </div><!-- section title end -->
                        </div>
                        <div class="col-md-2"></div>
                    </div><!-- row end-->
                    <div class="row">
                        <!-- row -->
                        <div class="col-lg-12">
                            <div class="ttm-processbox-wrapper" id="stepper_box">
                                <div class="ttm-processbox">
                                    <div class="ttm-box-image">
                                        <img class="img-fluid"
                                            src="http://meinhausca.com/public/theme/images/forms.svg" alt="step-one"
                                            title="step-one">

                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h5>FILL IN BASIC<br>JOB DETAILS</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="ttm-processbox">
                                    <div class="ttm-box-image">
                                        <img class="img-fluid" src="http://meinhausca.com/public/theme/images/pros.svg"
                                            alt="step-two" title="step-two">

                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h5>WE'LL DISPATCH<br>NEARBY PROS</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="ttm-processbox">
                                    <div class="ttm-box-image">
                                        <img class="img-fluid"
                                            src="http://meinhausca.com/public/theme/images/truck.svg" alt="step-three"
                                            title="step-three">
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h5>TRACK YOUR<br>PRO ON ROUTE</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="ttm-processbox">
                                    <div class="ttm-box-image">
                                        <img class="img-fluid" src="http://meinhausca.com/public/theme/images/pay.svg"
                                            alt="step-four" title="step-four">
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h5>PAY<br>SEAMLESSLY</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- row end -->
                </div>
            </section>
            <!--processbox-section end-->
            <!------pracr-tesatimonial--->
            <section class="py-0 pb-5">
                <div class="container">
                    <div class="row blog">
                        <div class="col-md-12 text-center">

                            <h2 class="title">Testimonials</h2>
                            <h5 class="title-para">We guarantee you'll be happy with every job. If not, we'll do
                                whatever it takes to make it right.</h5>



                            <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true }'
                                style="margin-bottom: 84px!important;">


                                @foreach ($testimonials as $testimonial)
                                    <div class="col-md-3">
                                        <div class="item-box-blog">
                                            <div class="item-box-blog-image">
                                                <!--Date-->

                                                <!--Image-->
                                                <figure> <img class="testimonial-img"
                                                        src="{{ url('public/testimonial/' . $testimonial->testimonial_image) }}"
                                                        alt="image"> </figure>
                                            </div>
                                            <div class="item-box-blog-body">
                                                <!--Heading-->
                                                <div class="item-box-blog-heading">
                                                    <a tabindex="0">
                                                        <h5>{{ $testimonial->name }}</h5>
                                                    </a>
                                                </div>
                                                <!--Data-->

                                                <!--Text-->
                                                <div class="item-box-blog-text">
                                                    <p> {{ $testimonial->description }}</p>
                                                </div>

                                                <!--Read More Button-->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <!--.row-->


                        </div>
                    </div>

                </div>
            </section>
            <!--pract-end--testimonial-->

            <br>



        </div>
        <!--site-main end-->
        <!-- <div class="modal" id="myModal" tabindex="-1" role="dialog" style="z-index:9999999">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Welcome!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <p>“Please have a look though our list over services. All list pricing is premade with hourly options available.
                                        This is the easiest and most convenient way of tackling smaller, quick projects.<br>
                                        If you’re interested in improving your home, and would like customized pricing please submit a custom
                                        request with basic information, along with some photos of the areas in question and well have your
                                        quotation generated right away! For jobs over $1000, we would recommend this process.”</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> -->

        <div class="modal" id="myModalcustom" tabindex="-1" role="dialog" style="z-index:9999999">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Search Booking ID</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="http://meinhausca.com/public/search-booking" method="post" id="custom_bookings"
                        name="custom_bookings" class="comment-form" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="eFp0xidxpiCY0pPhFmIpu0VGB9rQQXXs4vTDCyhy">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <input class="form-control" id="booking_id" name="booking_id" type="text"
                                        placeholder="Enter the booking id" autocomplete="off" value="">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-primary" >Ok</button>-->
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script type="text/javascript">
            $("select").on("click", function() {

                $(this).parent(".select-box").toggleClass("open");

            });

            $(document).mouseup(function(e) {
                var container = $(".select-box");

                if (container.has(e.target).length === 0) {
                    container.removeClass("open");
                }
            });


            $("select").on("change", function() {

                var selection = $(this).find("option:selected").text(),
                    labelFor = $(this).attr("id"),
                    label = $("[for='" + labelFor + "']");

                label.find(".label-desc").html(selection);

            });
        </script>
        <script>
            $(document).ready(function() {
                $("#myModal").modal('show');
            });
        </script>
    @endsection
