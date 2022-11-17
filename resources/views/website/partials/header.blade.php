<?php
$flag=1;
?>
@if(\Route::current()->getName() == 'pro-login'||\Route::current()->getName() == 'pro-register'||\Route::current()->getName() == 'register'||\Route::current()->getName() == 'login')
  <!-- ttm-topbar-wrapper -->
<!---header id="masthead" class="header ttm-header-style-classic mb-0">

      

        <div class="ttm-topbar-wrapper ttm-bgcolor-darkgrey ttm-textcolor-white clearfix">

            <div class="container">

                <div class="ttm-topbar-content">

                    <ul class="top-contact ttm-highlight-left text-left">

                        <li><i class="fa fa-phone"></i><span class="tel-no">1(844) 777-HAUS (4287)</span></li>

                    </ul>

                    <div class="topbar-right text-right">

                        <ul class="top-contact">

                            <li><i class="fa fa-envelope-o"></i><a href="mailto:info@meinhaus.ca">info@meinhaus.ca</a>
                            </li>

                        </ul>

                        <div class="ttm-social-links-wrapper list-inline">

                            <ul class="social-icons">

                                <li><a href="https://www.facebook.com/meinhausservices" target="_blank"><i
                                            class="fa fa-facebook"></i></a>

                                </li>

                                <li><a href="https://www.linkedin.com/company/mein-haus-services" target="_blank"><i
                                            class="fa fa-linkedin"></i></a>

                                </li>

                                <li><a href="https://www.instagram.com/meinhausservices/" target="_blank"><i
                                            class="fa fa-instagram"></i></a>

                                </li>

                                <li><a href="https://www.pinterest.com/meinhausservices/" target="_blank"><i
                                            class="fa fa-pinterest"></i></a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div><!-- ttm-topbar-wrapper end -->


    </header>
    @else
    <header id="masthead" class="header ttm-header-style-classic">

    <!-- ttm-topbar-wrapper -->

    <div class="ttm-topbar-wrapper ttm-bgcolor-darkgrey ttm-textcolor-white clearfix">

        <div class="container">

            <div class="ttm-topbar-content">

                <ul class="top-contact ttm-highlight-left text-left">

                    <li><i class="fa fa-phone"></i><span class="tel-no">1(844) 777-HAUS (4287)</span></li>

                </ul>

                <div class="topbar-right text-right">

                    <ul class="top-contact">

                        <li><i class="fa fa-envelope-o"></i><a href="mailto:info@meinhaus.ca">info@meinhaus.ca</a></li>

                    </ul>

                    <div class="ttm-social-links-wrapper list-inline">

                        <ul class="social-icons">

                            <li><a href="https://www.facebook.com/meinhausservices" target="_blank"><i class="fa fa-facebook"></i></a>

                            </li>

                            <li><a href="https://www.linkedin.com/company/mein-haus-services" target="_blank"><i class="fa fa-linkedin"></i></a>

                            </li>

                            <li><a href="https://www.instagram.com/meinhausservices/" target="_blank"><i class="fa fa-instagram"></i></a>

                            </li>

                            <li><a href="https://www.pinterest.com/meinhausservices/" target="_blank"><i class="fa fa-pinterest"></i></a>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div><!-- ttm-topbar-wrapper end -->

    <!-- ttm-header-wrap -->

    <div class="ttm-header-wrap">

        <!-- ttm-stickable-header-w -->

        <div id="ttm-stickable-header-w" class="ttm-stickable-header-w clearfix">

            <div id="site-header-menu" class="site-header-menu">

                <div class="site-header-menu-inner ttm-stickable-header">

                    <div class="container">

                        <!-- site-branding -->

                        <div class="site-branding">

                            <a class="home-link" href="{{ url('/') }}" title="MeinHaus" rel="home">

                                <img id="logo-img" class="img-center" src="http://meinhaus.ca/public/theme/images/logo-img.png" alt="logo-img">

                            </a>

                        </div><!-- site-branding end -->

                        <!--site-navigation -->
                        <div id="site-navigation" class="site-navigation">

                            @if(Auth::check() && Auth::user()->role_id == 2)
                            <div class="header-btn">

                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" href="{{route('user-logout')}}">LOGOUT</a>

                                </div>

                            @endif
                            @if(Auth::check() && Auth::user()->role_id == 3)
                            <div class="header-btn">

                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" href="{{route('pro-logout')}}">LOGOUT</a>

                            </div>

                            @endif

                            @if(Auth::check() && Auth::user()->role_id == 1)
                            <div class="header-btn">

                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" href="{{route('logout')}}">LOGOUT</a>

                            </div>
                            @endif

                            @if(!(Auth::check()))
                            <div class="header-btn">

                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" href="{{url('pro-login')}}">PRO LOGIN</a>

                                </div>

                                <div class="header-btn">

                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" href="{{url('login')}}">LOGIN</a>

                                </div>
                            @endif
                        <!-- <div id="site-navigation" class="site-navigation">






                                                                <div class="header-btn">

                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" href="{{ url('pro-login') }}">PRO LOGIN</a>

                                </div>

                                <div class="header-btn">

                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black" href="{{ url('login') }}">LOGIN</a>

                                </div>
 -->

                            <div class="ttm-menu-toggle">

                                <input type="checkbox" id="menu-toggle-form" />

                                <label for="menu-toggle-form" class="ttm-menu-toggle-block">

                                    <span class="toggle-block toggle-blocks-1"></span>

                                    <span class="toggle-block toggle-blocks-2"></span>

                                    <span class="toggle-block toggle-blocks-3"></span>

                                </label>

                            </div>
                            <nav id="menu" class="menu">

                                        <ul class="dropdown">

                                           <li class="active"><a href="{{url('/')}}">Home</a></li>

                                            <li><a href="{{url('about-us')}}">About Us</a></li>

                                            <li><a href="{{url('our-services')}}">Our Services</a></li>

                                          <li><a href="{{url('blog-post')}}">Blog</a></li>


                                            <li><a href="{{url('contact-us')}}">Contact Us</a></li>

                                            <!--<li><a href="{{url('help')}}">Help</a></li>-->
                                            @if(Auth::check() && Auth::user()->role_id == 2)
                                            <li><a>{{Auth::user()->name}}</a>
                                                <ul>
                                                    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                                                    <li><a href="{{route('editprofile')}}">Edit Profile</a></li>
                                                    <li><a href="{{url('user-offers')}}">Offers</a></li>
                                                </ul>
                                            </li>
                                            @endif
                                            @if(Auth::check() && Auth::user()->role_id == 3 && Auth::user()->is_listed == 1)
                                            <li><a href="{{url('pro/dashboard')}}">Dashboard</a>
                                                <!-- <ul>
                                                    <li><a href="{{url('user/profile')}}">Edit Profile</a></li>
                                                </ul> -->
                                            </li>
                                            @endif
                                            @if(Auth::check() && Auth::user()->role_id == 1)
                                            <li><a href="{{url('admin/dashboard')}}">Dashboard</a>
                                                <!-- <ul>
                                                    <li><a href="{{url('user/profile')}}">Edit Profile</a></li>
                                                </ul> -->
                                            </li>
                                            @endif

                                        </ul>

                                    </nav>


                        </div><!-- site-navigation end-->

                    </div>

                </div>

            </div>

        </div><!-- ttm-stickable-header-w end-->

    </div><!--ttm-header-wrap end -->

</header><!--header end -->
@endif
