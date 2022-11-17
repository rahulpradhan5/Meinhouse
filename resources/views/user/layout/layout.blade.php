
<!DOCTYPE html>

<html lang="en">

<head>

<meta name="base_url" content="http://meinhaus.ca/public">
<meta name="csrf-token" content="eFp0xidxpiCY0pPhFmIpu0VGB9rQQXXs4vTDCyhy">

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Online General Contractor | Mein Haus</title>
<meta name="keywords" content="on demand home services, on demand home services in Toronto, online home services, home services in Toronto,Canada, online home service provider, on demand home services in Canada, on demand home services in Mississaunga">
<meta name="description" content="Mein Haus is fastest growing on demand home service provider and offers various types of Repair, Maintenance and Renovation services at your doorstep. Booking Home Cleaning Services in Toronto with Mein Haus is quick, easy, and safe">

<meta name="author" content="" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<title>Mein Haus</title>

<!-- favicon icon -->

<link rel="shortcut icon" href="https://meinhaus.ca/public/theme/images/favi.png" sizes="32x32"/>

<!-- bootstrap -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/bootstrap.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

<!-- animate -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/animate.css"/>

<!-- owl-carousel -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/owl.carousel.css">

<!-- fontawesome -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/font-awesome.css"/>

<!-- themify -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/themify-icons.css"/>
<!-- flaticon -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/flaticon.css"/>

<!-- REVOLUTION LAYERS STYLES -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/layers.css">



<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/settings.css">

<!-- prettyphoto -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/prettyPhoto.css">

<!-- shortcodes -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/shortcodes.css"/>

<!-- main -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/main.css"/>

<!--Color Switcher Mockup-->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/color-switcher.css" >

<!-- responsive -->

<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/responsive.css"/>
<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/custom.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://meinhaus.ca/public/theme/css/simplepicker.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/adminlte/dist/css/stylemain.css">

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

{!! htmlScriptTagJsApi() !!}
</head>

<body>

        @include('website.partials.header')

        @yield('content')

        @include('website.partials.footer')


</body>
<script type="text/javascript">
  $('#cancelBookingBtn').click(function() {
    $('#cancelModal').modal('show');
  });
</script>
</html>
