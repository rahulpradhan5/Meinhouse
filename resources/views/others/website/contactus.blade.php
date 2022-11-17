@extends('website.layouts.master')

@section('content')

<div class="ttm-row map-section ttm-bgcolor-white" style="margin-top: 167px;">
    
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2890.262500051609!2d-79.71352838486642!3d43.580248379123915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b41bbfb1d3f19%3A0x6681bc4768b416f5!2s251%20Queen%20St%20S%2C%20Mississauga%2C%20ON%20L5M%201L7%2C%20Canada!5e0!3m2!1sen!2sin!4v1590747543112!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

            <!--<div class="map-wrapper">

                <div id="map_canvas"></div>

            </div>-->

        </div>



        <section class="ttm-row pb-160 res-991-pb-100 clearfix">

            <div class="container">

                <div class="row">

                    <div class="col-md-7 pr-60 res-767-pr-15">

                        <!-- section title -->

                        <div class="section-title with-desc clearfix">

                            <div class="title-header">

                                

                                <h2 class="title">Get In Touch</h2>

                                <h5>Tell us what's on your mind and we'll get right back to you !</h5>

                            </div>

                            <!-- <div class="title-desc"></div> -->

                        </div><!-- section title end -->
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
                        <form id="ttm-contactform" class="ttm-contactform wrap-form clearfix" method="post" action="{{route('contactus-post')}}">
                            @csrf
                            <div class="row">

                                <div class="col-lg-6">

                                    <label>

                                        <span class="text-input"><i class="fa fa-user"></i><input name="name" type="text" value="" placeholder="Your Name" required="required" id="name"></span>

                                    </label>

                                </div>

                                <div class="col-lg-6">

                                    <label>

                                        <span class="text-input"><i class="fa fa-mobile-phone"></i><input name="phone" type="text" value="" placeholder="Cell Phone" required="required" id="phone"></span>

                                    </label>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <label>

                                        <span class="text-input"><i class="fa fa-envelope"></i><input name="email" type="email" value="" placeholder="Email" required="required" id="email"></span>

                                    </label>

                                </div>

                                <div class="col-lg-6">

                                    <label>

                                        <span class="text-input"><i class="fa fa-map-marker"></i><input name="venue" type="text" value="" placeholder="Venue" required="required" id="venue"></span>

                                    </label>

                                </div>

                            </div>

                            <label>

                                <span class="text-input"><i class="fa fa-commenting-o"></i><textarea name="message" cols="40" placeholder="Message" required="required" id="message"></textarea></span>

                            </label>

                            <input name="submit" type="submit" id="submit" class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" value="Submit">

                        </form>

                    </div>

                    <div class="col-md-5">

                        <div class="ttm-rounded-shadow-box pt-40 pr-50 pb-55 pl-50 box-shadow2 res-767-mt-40 clearfix">

                            <h4>Contact Us</h4>

                            <ul class="ttm_contact_widget_wrapper">

                                <li><i class="fa fa-map-marker"></i>251 Queen Street South,Mississauga, ON, Canada</li>

                                <li><i class="fa fa-mobile"></i>647 930 9066</li>

                                <li><i class="fa fa-envelope"></i><a href="mailto:E.sommerfeld@outlook.com">E.sommerfeld@outlook.com</a></li>

                                <!-- <li><i class="fa fa-globe"></i><a href="http://www.example.com">http://www.example.com</a></li> -->

                            </ul>

                            <div class="social-icons circle social-hover">

                                <ul class="list-inline">

                                    <li><a href="https://www.facebook.com/meinhausservices"  style="background:#1e9bd0;" target="_blank"><i class="fa fa-facebook"></i></a>

                                    </li>

                                    <li><a href="https://www.linkedin.com/company/mein-haus-services" style="background:#1e9bd0;" target="_blank"><i class="fa fa-linkedin"></i></a>

                                    </li>

                                    <li><a href="https://www.instagram.com/meinhausservices/" style="background:#1e9bd0;" target="_blank"><i class="fa fa-instagram"></i></a>

                                    </li>

                                    <li><a href="https://www.pinterest.com/meinhausservices/" style="background:#1e9bd0;" target="_blank"><i class="fa fa-pinterest"></i></a>

                                    </li>

                            </div>

                        </div>

                    </div>

                </div><!-- row end -->

            </div>

        </section>
<!--<script src="https://maps.google.com/maps/api/js??key=AIzaSyA6w_8YwbYzGAXbv1T_ljGH-BVGrE1dUKA&sensor=false"></script>

<script>

    function initialize() {

        var latlng = new google.maps.LatLng(43.580230, -79.711440);

        var myOptions = {

            zoom: 8,

            center: latlng,

            mapTypeId: google.maps.MapTypeId.ROADMAP

        };

        var map = new google.maps.Map(document.getElementById("map_canvas"),

                myOptions);

    }

    google.maps.event.addDomListener(window, "load", initialize);

</script>-->
@endsection