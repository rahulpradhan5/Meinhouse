<!-- footer start-->
@php
use App\Models\Service;
$popular_services = Service::orderBy('booking_count','DESC')->limit('12')->get();
$flag=1;
@endphp
<footer class="footer widget-footer clearfix">

    <div class="first-footer">

        <div class="container">

            <div class="row">

            </div>

        </div>

    </div>
    
    @if($flag== 1)
    
    <div class="second-footer ttm-textcolor-white">

        <div class="container">

            <div class="row">

                
                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area mx-auto">

                    <div class="widget widget_text clearfix">

                        <h3 class="text" style="float: left;">Contact Us</h3>
                        <!--<hr style="width:81%;background:rgba(255,255,255,.06);">-->

                        <div class="textwidget widget-text" style="clear: both;">


                            <p style="margin: 0px;color: #fff;"><strong>Phone :</strong>1(844) 777-HAUS (4287)</p>
                            <p style="margin: 0px;color: #fff;"><strong>Email :</strong> info@meinhaus.ca</p>
                            <!--<p style="margin: 0px;color: #fff;"><strong>Address :</strong> 251 Queen Street South,-->
                            <!--    Mississauga, ON, Canada</p>-->

                        </div>
                        <br>

                        

                        
                        
                    </div>

                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area mx-auto">

                    <div class="widget widget_text clearfix">

                        

                        <div class="widget widget_text clearfix" style="margin: 0px 0 5px;">

                            <span class="" style="color: white;font-size: 1.5em;">Follow Us On:</span>

                            <div class="textwidget widget-text">

                                <div class="ttm-pricelistbox-wrapper ">

                                    <div class="ttm-timelist-block-wrapper">

                                        <div class="social-icons">

                                            <ul class="list-inline">

                                                <li><a href="https://www.facebook.com/meinhausservices"
                                                        target="_blank"><i class="fa fa-facebook"></i></a>

                                                </li>

                                                <li><a href="https://www.linkedin.com/company/mein-haus-services"
                                                        target="_blank"><i class="fa fa-linkedin"></i></a>

                                                </li>

                                                <li><a href="https://www.instagram.com/meinhausapp/?utm_medium=copy_link"
                                                        target="_blank"><i class="fa fa-instagram"></i></a>

                                                </li>

                                                <li><a href="https://www.pinterest.com/meinhausservices/"
                                                        target="_blank"><i class="fa fa-pinterest"></i></a>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        
                    </div>

                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">

                    <div class="widget widget_text clearfix">

                        

                        <div class="widget widget_text clearfix" style="margin: 0px 0 5px;">

                            <span class="" style="color: white;font-size: 1.5em;">Download the app</span>

                            <div class="textwidget widget-text">

                                <div class="ttm-pricelistbox-wrapper ">

                                    <div class="ttm-timelist-block-wrapper">

                                        <div class="social-icons">

                                            <ul class="list-inline">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <li><a
                                                        href="https://apps.apple.com/ca/app/mein-haus-professional/id1556987330"><img
                                                            src="http://meinhaus.ca/public/image/app.png"
                                                            width="121px" height="52px"></a></li>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <li><a
                                                        href="https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US"><img
                                                            src="http://meinhaus.ca/public/image/googleplay.png"
                                                            width="121px" height="52px"></i></a></li>
                                                    </div>
                                                </div>

                                                

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        
                    </div>

                </div>


            </div>


        </div>






    </div>
    
    @else
    
    <div class="second-footer ttm-textcolor-white">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">

                    <div class="widget clearfix">

                        <!-- <div class="footer-logo">

                            <img id="http://meinhausca.com/test/public/theme/images/footer-logo-img" class="img-center" src="http://meinhausca.com/test/public/theme/images/footer-logo.png" alt="">

                        </div> -->

                        <h3 class="text" style="float: left;">MeinHaus</h3>
                        <hr style="width:81%;background:rgba(255,255,255,.06);">

                        <p style="text-align: justify; clear: both; color: #fff;">Mein Haus is a fastest-growing
                            on-demand home service provider and finishes each project on schedule and with the highest
                            level of quality. With a focus on personalized service, competitive rates, and customer
                            satisfaction, we???re always striving to meet and exceed expectations.</p>

                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 widget-area">

                    <div class="widget widget_nav_menu clearfix">

                        <h3 class="text-center">Our Popular Services</h3>
                        <hr style="width:81%;background:rgba(255,255,255,.06);">

                        <ul class="footer_services">
                            @foreach ($popular_services as $value)
                                <li><a href="{{url('service-detail/' . $value->url)}}"> <i class="fa fa-hand-o-right"
                                            style="font-size:19px"></i> {{ $value->name ? $value->name : 'NA' }}</a>
                                </li>
                                {{-- <li><a href="{{ url('mississauga/' . $value->url) }}"> <i class="fa fa-hand-o-right"
                                            style="font-size:19px"></i> {{ $value->name ? $value->name : 'NA' }}</a>
                                </li> --}}
                            @endforeach

                            <li><a href="{{ url('terms') }}"> <i class="fa fa-hand-o-right"
                                        style="font-size:19px"></i> Terms And Conditions</a></li>



                        </ul>

                    </div>

                </div>

                <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">

                    <div class="widget flicker_widget clearfix">

                       <h3 class="widget-title">Flickr</h3>

                       <div class="ttm-flicker-widget-wrapper">

                            <a href="#"><img src="images/flicker/01.jpg" alt="A photo on Flickr" title="themetech-one"></a>

                            <a href="#"><img src="images/flicker/02.jpg" alt="A photo on Flickr" title="themetech-two"></a>

                            <a href="#"><img src="images/flicker/03.jpg" alt="A photo on Flickr" title="themetech-three"></a>

                            <a href="#"><img src="images/flicker/04.jpg" alt="A photo on Flickr" title="themetech-four"></a>

                            <a href="#"><img src="images/flicker/05.jpg" alt="A photo on Flickr" title="themetech-five"></a>

                            <a href="#"><img src="images/flicker/06.jpg" alt="A photo on Flickr" title="themetech-six"></a>

                            <a href="#"><img src="images/flicker/07.jpg" alt="A photo on Flickr" title="themetech-seven"></a>

                            <a href="#"><img src="images/flicker/08.jpg" alt="A photo on Flickr" title="themeteh-eight"></a>

                            <a href="#"><img src="images/flicker/09.jpg" alt="A photo on Flickr" title="themetech-nine"></a>

                        </div>

                    </div>

                </div> -->

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">

                    <div class="widget widget_text clearfix">

                        <h3 class="text" style="float: left;">Contact Us</h3>
                        <hr style="width:81%;background:rgba(255,255,255,.06);">

                        <div class="textwidget widget-text" style="clear: both;">


                            <p style="margin: 0px;color: #fff;"><strong>Phone :</strong>1(844) 777-HAUS (4287)</p>
                            <p style="margin: 0px;color: #fff;"><strong>Email :</strong> info@meinhaus.ca</p>
                            <p style="margin: 0px;color: #fff;"><strong>Address :</strong> 251 Queen Street South,
                                Mississauga, ON, Canada</p>

                        </div>
                        <br>

                        <div class="widget widget_text clearfix" style="margin: 0px 0 5px;">

                            <span class="" style="color: white;font-size: 1.5em;">Follow Us On:</span>

                            <div class="textwidget widget-text">

                                <div class="ttm-pricelistbox-wrapper ">

                                    <div class="ttm-timelist-block-wrapper">

                                        <div class="social-icons">

                                            <ul class="list-inline">

                                                <li><a href="https://www.facebook.com/meinhausservices"
                                                        target="_blank"><i class="fa fa-facebook"></i></a>

                                                </li>

                                                <li><a href="https://www.linkedin.com/company/mein-haus-services"
                                                        target="_blank"><i class="fa fa-linkedin"></i></a>

                                                </li>

                                                <li><a href="https://www.instagram.com/meinhausapp/?utm_medium=copy_link"
                                                        target="_blank"><i class="fa fa-instagram"></i></a>

                                                </li>

                                                <li><a href="https://www.pinterest.com/meinhausservices/"
                                                        target="_blank"><i class="fa fa-pinterest"></i></a>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="widget widget_text clearfix" style="margin: 0px 0 5px;">

                            <span class="" style="color: white;font-size: 1.5em;">Download the app</span>

                            <div class="textwidget widget-text">

                                <div class="ttm-pricelistbox-wrapper ">

                                    <div class="ttm-timelist-block-wrapper">

                                        <div class="social-icons">

                                            <ul class="list-inline">

                                                <li><a
                                                        href="https://apps.apple.com/ca/app/mein-haus-professional/id1556987330"><img
                                                            src="http://meinhaus.ca/public/image/app.png"
                                                            width="121px" height="52px"></a></li>

                                                <li><a
                                                        href="https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US"><img
                                                            src="http://meinhaus.ca/public/image/googleplay.png"
                                                            width="121px" height="52px"></i></a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <span>Developed By <a href="https://quantumitinnovation.com" target="_blank">QuantumIT</a>
                        </span>
                    </div>

                </div>


            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">

                <div class="widget clearfix">

                    <!-- <div class="footer-logo">

                            <img id="http://meinhausca.com/test/public/theme/images/footer-logo-img" class="img-center" src="http://meinhausca.com/test/public/theme/images/footer-logo.png" alt="">

                        </div> -->

                    <h3 class="text">Quick Links</h3>
                    <hr style="width:81%;background:rgba(255,255,255,.06);">
                    <li><a href="{{ url('terms') }}"> <i class="fa fa-hand-o-right"
                                style="font-size:19px"></i> Terms And Conditions</a></li>

                    <li><a href="{{ url('privacy-policy') }}"> <i class="fa fa-hand-o-right"
                                style="font-size:19px"></i> Privacy Policy</a></li>
                </div>

            </div>


        </div>






    </div>
    @endif

    



    <div class="bottom-footer-text ttm-textcolor-white">

        <div class="container">

            <div class="row copyright">

                <div class="col-md-12 ttm-footer2-left" style="text-align:center;">
                    <span>
                        </span>

                    <span>Developed By <a href="https://quantumitinnovation.com" target="_blank" style="text-decoration:none;">QuantumIT</a> <br>Copyright ?? 2020&nbsp;<a href="#" style="text-decoration:none;">MeinHaus</a>. All rights reserved.</span>

                </div>

            </div>

        </div>

    </div>

</footer>

<!--footer end
<!--back-to-top start-->

<a id="totop" href="#top">

    <i class="fa fa-angle-up"></i>

</a>

<!--back-to-top end-->

</div><!-- page end -->

<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


<script src="https://meinhaus.ca/public/theme/js/tether.min.js"></script>

<script src="https://meinhaus.ca/public/theme/js/bootstrap.min.js"></script>

<script src="https://meinhaus.ca/public/theme/js/color-switcher.js"></script>

<!--     <script src="http://meinhausca.com/test/public/theme/js/jquery.easing.js"></script>
-->
<!--     <script src="http://meinhausca.com/test/public/theme/js/jquery-waypoints.js"></script>    -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

<script src="https://meinhaus.ca/public/theme/js/owl.carousel.js"></script>

<script src="https://meinhaus.ca/public/theme/js/jquery.prettyPhoto.js"></script>

<script src="https://meinhaus.ca/public/theme/js/numinate.min.js"></script>

<script src="https://meinhaus.ca/public/theme/js/main.js"></script>

<!-- Revolution Slider -->

<script src="https://meinhaus.ca/public/theme/js/jquery.themepunch.tools.min.js"></script>

<script src="https://meinhaus.ca/public/theme/js/jquery.themepunch.revolution.min.js"></script>

<script src="https://meinhaus.ca/public/theme/js/slider.js"></script>

<script src="https://meinhaus.ca/public/theme/js/validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://meinhaus.ca/public/theme/js/simplepicker.js"></script>
<!--trial-->
<script
src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js">
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js'></script>
<script id="rendered-js"> </script>
<script
src="https://static.codepen.io/assets/editor/iframe/iframeRefreshCSS-d00a5a605474f5a5a14d7b43b6ba5eb7b3449f04226e06eb1b022c613eabc427.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
