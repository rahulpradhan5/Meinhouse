@extends('website.layout.layout')
@section('content')
<link rel="stylesheet" href="{{url('public/style.css')}}" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        #myModalcustom .modal-dialog {
            margin: 12.75rem auto;
        }

        .home_slider_image {
            height: 600px;
            background-image: url("http://meinhaus.ca/test/public/slider_image/slider-mainbg-002.jpg");
        }

        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);


        /* max-width: 50em;
        margin: 5em auto;
        width: 100%;
        } */

        .select-box {
            cursor: pointer;
            position: relative;
        }
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

            .testimonia-img {
                text-align: center;
                height: 200px;
                width: 200px;
                border-radius: 100px;


            }

            .top-row {
                display: flex;
                flex-direction: column;
                justify-content: center;
                text-align: center;
                align-items: center;
            }

            #first-top-header {
                background-color: red !important;
                /* background: #eb01a5;
                background-image: url("IMAGE_URL"); */

                /* background: url('') no-repeat center; */
            }

            .first_section {

                background-color: red !important;


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


        <!-- header start-->
        <!--<section id="banner" class="px-4">-->
        <!--    <div class="justify-content-center d-flex py-4">-->
        <!--        <div class="">-->
        <!--            <img src="http://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 18rem;" alt=""-->
        <!--                class="img-fluid my-2">-->
        <!--            <div class="text-white text-center my-2" style="font-size: 24px;font-weight: bolder;">Online General-->
        <!--                Contractor </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="row text-white mt-5">-->
        <!--        <div class="col-lg-6 col-md-6 col-12 justify-content-center align-items-center d-flex">-->
        <!--            <div class="">-->
        <!--                <div class="areyou" style="font-size: 23px; font-weight:bolder">Are you a</div>-->
        <!--                <div class="my-4 tagQ" style="font-size: 44px; font-weight:bolder">Trade Pro ?</div>-->
        <!--                <div class="paragraph" style="font-size: 20px; font-weight:500">Sold jobs sent directly to your</br>-->
        <!--                    phone! No more Marketing &</br> Selling.</div>-->
                        <!--<div class="my-5 arrowPosition">-->
                        <!--    <div>-->
                        <!--        <a href="{{url('pro-landing')}}" style="color:white">-->
                        <!--            <div class="arrow"  style="background-color: black;">-->
                        <!--                <div class="m-0 w-100 text-center tagLinetext"><b>Fill your Schedule!</b></div>-->
                        <!--            </div>-->
                        <!--            <div class="arrowTop"></div>-->
                        <!--        </a>-->
                        <!--    </div>-->
                        <!--</div>-->
        <!--                <div class="my-5">-->
        <!--                <div class="btn btn-primary px-5 py-2 rounded-pill align-items-center d-flex" style="width: fit-content;">Get Started&nbsp;<img style="height: 20px ;" src="https://img.icons8.com/material-outlined/24/FFFFFF/move-right.png"/></div>-->
                        
        <!--            </div>-->
        <!--            </div>-->
    
        <!--        </div>-->
        <!--        <div class="col-lg-6 col-md-6 col-12 justify-content-center align-items-center d-flex">-->
        <!--            <div class="">-->
        <!--                <div class="areyou" style="font-size: 23px; font-weight:bolder">Are you a</div>-->
        <!--                <div class="my-4 tagQ" style="font-size: 44px; font-weight:bolder">Homeowner ?</div>-->
        <!--                <div class="paragraph" style="font-size: 20px; font-weight:500">Custom project quotations for any</br>-->
        <!--                    job. Buy & Book Immediately!</br> Done on your schedule.</div>-->
                        <!--<div class="my-5 arrowPosition">-->
                        <!--    <div>-->
                        <!--        <a href="{{url('user-landing')}}" style="color:white">-->
                        <!--            <div class="arrow"  style="background-color: black;">-->
                        <!--                <div class="m-0 w-100 text-center tagLinetext"><b>Start your Project!</b></div>-->
                        <!--            </div>-->
                        <!--            <div class="arrowTop"></div>-->
                        <!--        </a>-->
                        <!--    </div>-->
                        <!--</div>-->
        <!--                <div class="my-5">-->
        <!--                <div class="btn btn-primary px-5 py-2 rounded-pill align-items-center d-flex" style="width: fit-content;">Get Started&nbsp;<img style="height: 20px ;" src="https://img.icons8.com/material-outlined/24/FFFFFF/move-right.png"/></div>-->
                     
        <!--            </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="justify-content-center align-items-center d-lg-flex d-md-flex d-sm-flex pb-4 w-100">-->
        <!--        <div class="d-lg-block d-md-block d-sm-block d-flex justify-content-center">-->
        <!--            <a href="{{url('pro-login')}}">-->
        <!--            <div class="btn btn-warning rounded-0 mx-3 shadow-lg text-warning"-->
        <!--                style="font-weight:bolder;width:fit-content;border: 2px solid #F7A71E;font-size: 16px;">Pro Log In-->
        <!--            </div>-->
        <!--            </a>-->
    
        <!--            <div class="btn btn-info rounded-0 mx-3 shadow-lg text-info px-4 hiddenbtn"-->
        <!--                style="font-weight:bolder;width:fit-content;border: 2px solid rgb(0, 208, 255);display: none;">Log-->
        <!--                In</div>-->
        <!--        </div>-->
        <!--        <div class="mx-3 text-white text-center py-lg-0 py-md-0 py-sm-0 py-3" style="font-size: 16px;"><b>Already-->
        <!--                have an account?</b></div>-->
                    
        <!--                <a href="{{url('login')}}">-->
        <!--        <div class="btn btn-info rounded-0 shadow-lg text-info px-4 loginBtn"-->
        <!--            style="font-weight:bolder;width:fit-content;font-size: 16px;border: 2px solid rgb(0, 208, 255);margin-left: 15px;">-->
        <!--            &nbsp;Log In&nbsp;</div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--</section>-->
        <section id="banner" class="px-4">
        <div class="justify-content-center d-flex py-4">
            <div class="">
                <img src="http://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 18rem;" alt=""
                    class="img-fluid my-2">
                <div class="text-white text-center my-2" style="font-size: 24px;font-weight: bolder;">Online General
                    Contractor </div>
            </div>
        </div>
        <div class="row text-white mt-5">
            <div class="col-lg-6 col-md-6 col-12 justify-content-center align-items-center d-flex">
                <div class="">
                    <div class="areyou" style="font-size: 23px; font-weight:bolder">Are you a</div>
                    <div class="my-4 tagQ" style="font-size: 44px; font-weight:bolder">Trade Pro ?</div>
                    <div class="paragraph" style="font-size: 20px; font-weight:500">Sold jobs sent directly to your</br>
                        phone! No more Marketing &</br> Selling.</div>
                    <div class="my-5">
                        <a href="{{url('pro-landing')}}" style="color:white;text-decoration:none">
                        <div class="btn btn-primary px-5 py-2 rounded-pill align-items-center d-flex" style="width: fit-content;">Get Started&nbsp;<img
                                src="https://img.icons8.com/material-rounded/24/ffffff/long-arrow-right.png" /></div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 col-12 justify-content-center align-items-center d-flex">
                <div class="">
                    <div class="areyou" style="font-size: 23px; font-weight:bolder">Are you a</div>
                    <div class="my-4 tagQ" style="font-size: 44px; font-weight:bolder">Homeowner ?</div>
                    <div class="paragraph" style="font-size: 20px; font-weight:500">Custom project quotations for any</br>
                        job. Buy & Book Immediately!</br> Done on your schedule.</div>
                    <div class="my-5">
                        <a href="{{url('user-landing')}}" style="color:white;text-decoration:none">
                        <div class="btn btn-primary px-5 py-2 rounded-pill align-items-center d-flex" style="width: fit-content;">Get Started&nbsp;<img
                                src="https://img.icons8.com/material-rounded/24/ffffff/long-arrow-right.png" /></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="lowerpart justify-content-center align-items-center d-lg-flex d-md-flex d-sm-flex pb-4 w-100">
            <div class="d-lg-block d-md-block d-sm-block d-flex justify-content-center">
                <a href="{{url('pro-login')}}">
                <div class="btn btn-warning rounded-0 mx-3 shadow-lg text-warning"
                    style="font-weight:bolder;width:fit-content;border: 2px solid #F7A71E;font-size: 16px;">Pro Log In
                </div>
                </a>

                <div class="btn btn-info rounded-0 mx-3 shadow-lg text-info px-4 hiddenbtn"
                    style="font-weight:bolder;width:fit-content;border: 2px solid rgb(0, 208, 255);display: none;">Log
                    In</div>
            </div>
            <div class="mx-3 text-white text-center py-lg-0 py-md-0 py-sm-0 py-3" style="font-size: 16px;"><b>Already
                    have an account?</b></div>

            <a href="{{url('login')}}">
            <div class="btn btn-info rounded-0 shadow-lg text-info px-4 loginBtn"
                style="font-weight:bolder;width:fit-content;font-size: 16px;border: 2px solid rgb(0, 208, 255);margin-left: 15px;">
                &nbsp;Log In&nbsp;</div>
            </a>
        </div>
    </section>


        <!--site-main start-->
        
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
                    <form action="{{url('search-booking')}}" method="post" id="custom_bookings"
                        name="custom_bookings" class="comment-form" enctype="multipart/form-data">
                       @csrf
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

@if (session('alert'))
'<script type="text/javascript">alert("Invalid Booking ID");</script>'
@endif

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
