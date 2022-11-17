<!DOCTYPE html>

<html lang="en">

<head>

<meta name="base_url" content="{{url('/')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

@yield('meta')

<meta name="author" content="" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<title>Mein Haus</title>

<!-- favicon icon -->

<link rel="shortcut icon" href="{{asset('theme/images/favi.png')}}" sizes="32x32"/>

<!-- bootstrap -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/bootstrap.min.css')}}"/>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

<!-- animate -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/animate.css')}}"/>

<!-- owl-carousel -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/owl.carousel.css')}}">

<!-- fontawesome -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/font-awesome.css')}}"/>

<!-- themify -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/themify-icons.css')}}"/>
<!-- flaticon -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/flaticon.css')}}"/>

<!-- REVOLUTION LAYERS STYLES -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/layers.css')}}">



<link rel="stylesheet" type="text/css" href="{{asset('theme/css/settings.css')}}">

<!-- prettyphoto -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/prettyPhoto.css')}}">

<!-- shortcodes -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/shortcodes.css')}}"/>

<!-- main -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/main.css')}}"/>

<!--Color Switcher Mockup-->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/color-switcher.css')}}" >

<!-- responsive -->

<link rel="stylesheet" type="text/css" href="{{asset('theme/css/responsive.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('theme/css/custom.css')}}"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{asset('theme/css/simplepicker.css')}}">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<link rel="stylesheet" type="text/css" href="{{asset('adminlte/dist/css/stylemain.css')}}">

<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css'>
<style>
    header#masthead {
    position: fixed;
    z-index: 999;
    width: 100%;
    top:0;
}
.ttm-page-title-row.text-center {
    margin-top: 112px;
}
.ttm-row.map-section.ttm-bgcolor-white {
    margin-top: 105px;
}
</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168384510-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-168384510-1');
</script>
@yield('after-style')

</head>

<body>

    <!--page start-->

    <div class="page">

    	<!-- preloader start -->

        <div id="preloader">

          <div id="status">&nbsp;</div>

        </div>

        <!-- preloader end -->

        @include('website.partials.header')

        @yield('content')

        @include('website.partials.footer')

    <!--back-to-top start-->

    <a id="totop" href="#top">

        <i class="fa fa-angle-up"></i>

    </a>

    <!--back-to-top end-->

    </div><!-- page end -->

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="{{asset('theme/js/tether.min.js')}}"></script>

    <script src="{{asset('theme/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('theme/js/color-switcher.js')}}"></script> 

<!--     <script src="{{asset('theme/js/jquery.easing.js')}}"></script>    
 -->
<!--     <script src="{{asset('theme/js/jquery-waypoints.js')}}"></script>    --> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

    <script src="{{asset('theme/js/owl.carousel.js')}}"></script>

    <script src="{{asset('theme/js/jquery.prettyPhoto.js')}}"></script>

    <script src="{{asset('theme/js/numinate.min.js')}}"></script>

    <script src="{{asset('theme/js/main.js')}}"></script>

    <!-- Revolution Slider -->

    <script src="{{asset('theme/js/jquery.themepunch.tools.min.js')}}"></script>

    <script src="{{asset('theme/js/jquery.themepunch.revolution.min.js')}}"></script>

    <script src="{{asset('theme/js/slider.js')}}"></script>

    <script src="{{asset('theme/js/validation.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{asset('theme/js/simplepicker.js')}}"></script>
    <!--trial-->
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js'></script>
    <script id="rendered-js"> </script>
    <script src="https://static.codepen.io/assets/editor/iframe/iframeRefreshCSS-d00a5a605474f5a5a14d7b43b6ba5eb7b3449f04226e06eb1b022c613eabc427.js"></script>
    
@yield('script')

</body>

</html>

