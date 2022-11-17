<!DOCTYPE html>



<html lang="en">



<head>



    <meta name="base_url" content="https://meinhaus.ca/public">

    <meta name="csrf-token" content="eFp0xidxpiCY0pPhFmIpu0VGB9rQQXXs4vTDCyhy">



    <meta charset="utf-8">



    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <title>Online General Contractor | Mein Haus</title>

    <meta name="keywords" content="on demand home services, on demand home services in Toronto, online home services, home services in Toronto,Canada, online home service provider, on demand home services in Canada, on demand home services in Mississaunga">

    <meta name="description" content="Mein Haus is fastest growing on demand home service provider and offers various types of Repair, Maintenance and Renovation services at your doorstep. Booking Home Cleaning Services in Toronto with Mein Haus is quick, easy, and safe">



    <meta name="author" content="" />



    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>Mein Haus</title>



    <!-- favicon icon -->



    <link rel="shortcut icon" href="https://meinhaus.ca/public/theme/images/favi.png" sizes="32x32" />



    <!-- bootstrap -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/bootstrap.min.css" />



    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />



    <!-- animate -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/animate.css" />



    <!-- owl-carousel -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/owl.carousel.css">



    <!-- fontawesome -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/font-awesome.css" />



    <!-- themify -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/themify-icons.css" />

    <!-- flaticon -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/flaticon.css" />



    <!-- REVOLUTION LAYERS STYLES -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/layers.css">







    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/settings.css">



    <!-- prettyphoto -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/prettyPhoto.css">



    <!-- shortcodes -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/shortcodes.css" />



    <!-- main -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/main.css" />



    <!--Color Switcher Mockup-->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/color-switcher.css">



    <!-- responsive -->



    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/responsive.css" />

    <link rel="stylesheet" type="text/css" href="https://meinhaus.ca/public/theme/css/custom.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://meinhaus.ca/public/theme/css/simplepicker.css">

    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

    <!---link rel="stylesheet" type="text/css" href="https://meinhaus.ca/test/public/"-->





    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">



    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css'>


    {!! htmlScriptTagJsApi() !!}


    <style>
        header#masthead {

            position: fixed;

            z-index: 999;

            width: 100%;

            top: 0;

        }

        .ttm-page-title-row.text-center {

            margin-top: 112px;

        }

        .ttm-row.map-section.ttm-bgcolor-white {

            margin-top: 105px;

        }

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        /*********************************tab-reflect--css****************************/
        nav>div a.nav-item.nav-link.active:after {
            content: "";
            position: relative;
            bottom: -60px;
            left: -10%;
            border: 15px solid transparent;
            border-top-color: none !important;
        }

        .border-div {
            float: left;
            width: 100%;
            border-radius: 4px;
            background-color: #fff;

        }

        .top-book {
            float: left;
            margin: 0;
            padding: 13px 3px;
            font-size: 26px;
            letter-spacing: 1px;
            font-family: 'Simonetta';
            font-weight: bold;
        }

        .box-one-top {
            float: left;
            min-height: 0px;
            width: 100%;
            border-radius: 5px;

        }

        .box-one-top-right {
            float: left;
            min-height: 0px;
            width: 100%;
            border-radius: 5px;

        }

        .top-book-right {
            float: left;
            margin: 0;
            position: relative;
            left: 27rem;
            top: 12px;
            font-size: 26px;
            letter-spacing: 1px;
            font-family: 'Simonetta';
            font-weight: bold;
        }

        .right-date {
            float: right;
            padding: 10px 18px;
            color: #000;
            font-size: 14px;
        }

        .box-main {
            float: left;
            width: 100%;
            border: 1px solid #eaeaea;
            background-color: #ffffff47;
            min-height: 0px;
        }

        .box-one {
            float: left;
            min-height: 0px;
            width: 100%;
        }

        .box-one h3 {
            float: left;
            font-size: 15px;
            color: #000;
            margin: 0;
            padding: 8px 6px;
            font-weight: 500;
            font-family: 'Ubuntu';

        }

        .box-one h5 {
            float: right;
            font-size: 15px;
            color: #000;
            padding: 8px 6px;
            margin: 0;
            font-weight: 500;
            font-family: 'Ubuntu';

        }

        .description-content {
            float: left;
            width: 100%;
            padding-bottom: 1%;
            min-height: 0px;
        }

        .desc {
            float: left;
            color: #000;
            font-size: 20px;
            padding: 48px 10px;
            font-family: 'Ubuntu';
        }

        .para {
            float: left;
            color: #000;
            font-size: 14px;
            text-align: justify;
            line-height: 20px;
            margin: 0;
            padding: 12px 10px;
            font-family: 'Ubuntu';

        }

        .payment {
            float: left;
            color: #000;
            font-size: 20px;
            margin: 0;
            padding: 13px 10px;
            font-family: 'Ubuntu';
        }

        .highlight {
            float: left;
            clear: both;
            background-color: #149ae8;
            color: #fff;
            font-size: 14px;
            margin: 3px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 6px 17px;
            margin-left: 2%;
            border-radius: 3px;
            font-family: 'Ubuntu';
        }

        .highlight1 {
            float: left;
            background-color: #da4e54;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            margin: 3px;
            text-transform: uppercase;
            padding: 6px 17px;
            margin-left: 2%;
            border-radius: 3px;
            font-family: 'Ubuntu';
        }

        .description-content1 {
            float: left;
            width: 100%;
            border: 1px solid #c5c5c5;
            min-height: 0px;
            margin-top: 2%;
        }

        .payment1 {
            float: left;
            color: #000;
            font-size: 20px;
            padding: 16px 10px;
            margin: 0;
            padding-bottom: 3%;
            font-family: 'Ubuntu';
        }

        .side-btn {
            background-color: #1f9ae2cc;
            color: #fff;
            position: relative;
            left: 36rem;
            padding: 0px 0px;
            border-radius: 4px;
            letter-spacing: 1px;
            font-size: 15px;
            top: 3%;
            border: none;
            padding: 10px 11px;
            font-family: 'Ubuntu';
        }

        .side-btn:hover {
            background-color: #fff;
            border: 1px solid #000;
            transition: 0.3s;
            color: #000;
            overflow: hidden;
        }

        .myButt {
            outline: none;
            border: none;
            padding: 10px;
            margin-left: 2%;
            margin-top: 2%;
            display: block;
            /* margin: 50px auto; */
            cursor: pointer;
            font-size: 16px;
            float: left;
            background-color: transparent;
            position: relative;
            border: 2px solid #fff;
            transition: all 0.5s ease;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;

        }

        .one {
            border-color: #c14646;
            overflow: hidden;
            color: #e82a2a;
            font-family: 'Ubuntu';
        }

        .one .insider {
            background-color: #fff;
            width: 100%;
            height: 20px;
            position: absolute;
            left: -135px;
            transform: rotateZ(45deg);
            -webkit-transform: rotateZ(45deg);
            -moz-transform: rotateZ(45deg);
            -o-transform: rotateZ(45deg);
            -ms-transform: rotateZ(45deg);
        }

        .one:hover {
            background-color: #1f9ae2cc;
            border-color: #fff;
            color: #fff;
        }

        .one:hover .insider {
            transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            left: 135px;
        }

        /**********************media query***********************************/
        @media only screen and (max-width: 420px) and (min-width: 220px) {
            .border-div {
                float: left;
                width: 100%;
                min-height: 0px;
                border-radius: 4px;
                background-color: #fff;
            }

            .top-book {
                float: left;
                margin: 0;
                padding: 13px 3px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .box-one-top {
                float: left;
                min-height: 0px;
                width: 100%;
                border-radius: 5px;

            }

            .box-one-top-right {
                float: left;
                min-height: 0px;
                width: 100%;
                border-radius: 5px;
            }

            .top-book-right {
                float: left;
                margin: 0;
                position: relative;
                left: 9px;
                top: 12px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .right-date {
                float: right;
                padding: 10px 18px;
                color: #000;
                font-size: 14px;
            }

            .box-main {
                float: left;
                width: 100%;
                border: 1px solid #eaeaea;
                background-color: #ffffff47;
                min-height: 0px;
                margin-top: 2%;
            }

            .desc {
                float: left;
                color: #000;
                font-size: 20px;
                padding: 4px 10px;
                font-family: 'Ubuntu';
            }

            .para {
                float: left;
                color: #000;
                font-size: 14px;
                text-align: justify;
                line-height: 20px;
                margin: 0;
                padding: 2px 10px;
                font-family: 'Ubuntu';

            }

        }

        @media only screen and (max-width: 1250px) and (min-width: 960px) {
            .border-div {
                float: left;
                width: 100%;
                min-height: 0px;
                border-radius: 4px;
                background-color: #fff;
            }

            .top-book {
                float: left;
                margin: 0;
                padding: 13px 3px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .box-one-top {
                float: left;
                min-height: 0px;
                width: 100%;
                border-radius: 5px;

            }

            .box-one-top-right {
                float: left;
                min-height: 0px;
                width: 100%;
                border-radius: 5px;
            }

            .top-book-right {
                float: left;
                margin: 0;
                position: relative;
                left: 9px;
                top: 12px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .right-date {
                float: right;
                padding: 10px 18px;
                color: #000;
                font-size: 14px;
            }

            .box-main {
                float: left;
                width: 100%;
                border: 1px solid #eaeaea;
                background-color: #ffffff47;
                min-height: 0px;
                margin-top: 2%;
            }

            .desc {
                float: left;
                color: #000;
                font-size: 20px;
                padding: 4px 10px;
                font-family: 'Ubuntu';
            }

            .para {
                float: left;
                color: #000;
                font-size: 14px;
                text-align: justify;
                line-height: 20px;
                margin: 0;
                padding: 2px 10px;
                font-family: 'Ubuntu';

            }

        }

        @media only screen and (max-width: 768px) and (min-width: 421px) {
            .border-div {
                float: left;
                width: 100%;
                min-height: 0px;
                border-radius: 4px;
                background-color: #fff;
            }

            .top-book {
                float: left;
                margin: 0;
                padding: 13px 3px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .box-one-top {
                float: left;
                min-height: 0px;
                width: 100%;
                border-radius: 5px;

            }

            .box-one-top-right {
                float: left;
                min-height: 0px;
                width: 100%;
                padding-top: 2%;
                border-radius: 5px;
            }

            .top-book-right {
                float: left;
                margin: 0;
                position: relative;
                left: 9px;
                top: 12px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .right-date {
                float: right;
                padding: 10px 18px;
                color: #000;
                font-size: 14px;
            }

            .box-main {
                float: left;
                width: 100%;
                border: 1px solid #eaeaea;
                background-color: #ffffff47;
                min-height: 0px;
                margin-top: 2%;
            }

            .desc {
                float: left;
                color: #000;
                font-size: 20px;
                padding: 4px 10px;
                font-family: 'Ubuntu';
            }

            .para {
                float: left;
                color: #000;
                font-size: 14px;
                text-align: justify;
                line-height: 20px;
                margin: 0;
                padding: 2px 10px;
                font-family: 'Ubuntu';

            }

        }

        @media only screen and (max-width: 420px) and (min-width: 220px) {
            .border-div {
                float: left;
                width: 100%;
                min-height: 0px;
                border-radius: 4px;
                background-color: #fff;
            }

            .top-book {
                float: left;
                margin: 0;
                padding: 13px 3px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .description-content {
                float: left;
                width: 100%;
                padding-bottom: 0%;
                min-height: 0px;
            }

            .box-one-top {
                float: left;
                min-height: 0px;
                width: 100%;
                border-radius: 5px;

            }

            .box-one-top-right {
                float: left;
                min-height: 0px;
                width: 100%;
                border-radius: 5px;
            }

            .top-book-right {
                float: left;
                margin: 0;
                position: relative;
                left: 9px;
                top: 12px;
                font-size: 26px;
                letter-spacing: 1px;
                font-family: 'Ubuntu';
            }

            .right-date {
                float: right;
                padding: 10px 18px;
                color: #000;
                font-size: 14px;
            }

            .box-main {
                float: left;
                width: 100%;
                border: 1px solid #eaeaea;
                background-color: #ffffff47;
                min-height: 0px;
                margin-top: 2%;
            }

            .desc {
                float: left;
                color: #000;
                font-size: 20px;
                padding: 4px 10px;
                font-family: 'Ubuntu';
            }

            .para {
                float: left;
                color: #000;
                font-size: 14px;
                text-align: justify;
                line-height: 20px;
                margin: 0;
                padding: 2px 10px;
                font-family: 'Ubuntu';

            }

        }

        /******************************css-help-page***********************/
        .border-box {
            float: left;
            min-height: 0px;
            border: 1px solid #fff;
            width: 100%;
            background-color: #fff;
            margin-top: 28px;
            border-radius: 10px;
            padding-bottom: 14px;
            -webkit-box-shadow: 0 0 25px 0 rgba(41, 61, 88, .06);
            -moz-box-shadow: 0 0 25px 0 rgba(41, 61, 88, .06);
            box-shadow: 0 0 25px 0 rgba(41, 61, 88, .06);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            transform: translateY(0);
            -webkit-transition: 0.5s;
            -o-transition: 0.5s;
            -moz-transition: 0.5s;
            transition: 0.5s;
        }

        .border-box:hover {
            -webkit-transform: translateY(-10px);
            -moz-transform: translateY(-10px);
            -ms-transform: translateY(-10px);
            -o-transform: translateY(-10px);
            transform: translateY(-10px);
            box-shadow: 0 0 20px rgba(0, 0, 0, .14);

        }

        .info-general {
            float: left;
            color: #1e9bd0;
            padding-top: 26px;
            font-size: 17px;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            margin: 0px;
            text-align: justify;
        }

        .para-general {
            float: left;
            clear: both;
            color: #828282;
            padding: 11px 10px !important;
            font-size: 16px;
            text-align: justify;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        .write-pic {
            clear: both;
            float: left;

        }

        .name-letter {
            float: left;
            font-size: 15px;
            margin: 0;
            padding-top: 19px;
            padding-left: 12px;
            color: #6f6c6c;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        .side-color {
            float: right;
            font-size: 15px;
            color: rgb(39, 114, 167);
            padding: 1px 5px;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        /******************************testimonial************************/
        .title {
            color: #1e9bd0;
            text-align: center;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            font-weight: 600;
            font-size: 36px;
            line-height: 46px;
            margin-bottom: 17px;
            margin-top: 23px;
        }

        .title-para {
            color: #a2a5a7;
            text-align: center;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            /* font-weight: 600; */
            letter-spacing: 1px;
            font-size: 15px;
            line-height: 46px;

        }

        .testimonial-img {
            text-align: center;
            height: 200px;
            width: 200px;
            border-radius: 100px;


        }

        .cta-100 {
            margin-top: 100px;
            padding-left: 8%;
            padding-top: 7%;
        }

        .col-md-4 {
            padding-bottom: 20px;
        }

        .white {
            color: #fff !important;
        }

        .mt {
            float: left;
            margin-top: -20px;
            padding-top: 20px;
        }

        .bg-blue-ui {
            background-color: #708198 !important;
        }

        figure img {
            width: 300px;
        }


        #blogCarousel {
            padding-bottom: 100px;
        }

        .blog .carousel-indicators {
            float: left;
            height: 8%;

        }


        /* The colour of the indicators */

        .blog .carousel-indicators li {
            background: #708198;
            border-radius: 50%;
            width: 8px;
            height: 8px;
        }




        #left-arrow {
            float: left;
            font-size: 20px;
            color: #1e9bd0;
        }

        #right-arrow {
            float: right;
            font-size: 20px;
            color: #1e9bd0;
            padding: 0px 12px;
        }

        .item-carousel-blog-block {
            outline: medium none;
            padding: 15px;
        }

        .item-box-blog {
            text-align: center;
            z-index: 4;
            padding: 20px;
            background-color: #deeeff;
            border-radius: 10px;
        }

        .item-box-blog-image {
            position: relative;
            background-color: #1e9bd030;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            box-shadow: 5px 7px 5px 3px #fdfdfd;
        }

        .item-box-blog-image figure img {
            width: 200px;
            height: 200px;
            border-radius: 100px;
        }

        .item-box-blog-date {
            position: absolute;
            z-index: 5;
            padding: 4px 20px;
            top: -20px;
            right: 8px;
            background-color: #41cb52;
        }

        .item-box-blog-date span {
            color: #fff;
            display: block;
            text-align: center;
            line-height: 1.2;
        }

        .item-box-blog-date span.mon {
            font-size: 18px;
        }

        .item-box-blog-date span.day {
            font-size: 16px;
        }

        .item-box-blog-body {
            padding: 10px;
        }

        .item-heading-blog a h5 {
            margin: 0;
            line-height: 1;
            text-decoration: none;
            transition: color 0.3s;
        }

        .item-box-blog-heading a {
            text-decoration: none;
        }

        .item-box-blog-data p {
            font-size: 13px;
        }

        .item-box-blog-data p i {
            font-size: 12px;
        }

        .item-box-blog-text {
            max-height: 100px;
            overflow: hidden;
        }

        .mt-10 {
            float: left;
            margin-top: -10px;
            padding-top: 10px;
        }

        .btn.bg-blue-ui.white.read {
            cursor: pointer;
            padding: 4px 20px;
            float: left;
            margin-top: 10px;
        }

        .btn.bg-blue-ui.white.read:hover {
            box-shadow: 0px 5px 15px inset #4d5f77;
        }

        /***********************offers-page-css***********************/
        #left-offer-a {
            float: left;
            color: #000;
            padding-top: 14px;
            font-size: 33px;
            padding-left: 3%;
        }

        .offer-detail {
            letter-spacing: 1px;
            float: left;
            color: #000;
            text-transform: uppercase;
            padding-left: 10px;
            padding-top: 20px;
            font-size: 17px;
        }

        .bg-offer-1 {
            background-color: #fff;
            overflow: hidden;
            transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
            margin-top: 0px;
            margin-bottom: 0px;
            background-position: center center;
            background-repeat: no-repeat;
            height: 330px;
            width: 100%;
            background-size: cover;
            margin-bottom: 2%;
            clear: both;
        }

        .box-offer-left {
            float: left;
            min-height: 0px;
            width: 100%;
        }

        .offer-text {
            float: left;
            font-size: 34px;
            text-transform: uppercase;
            color: #868383;
            padding-left: 28px;
            padding-top: 54px;
        }

        .offer-text-1 {
            float: left;
            clear: both;
            font-size: 27px;
            text-transform: uppercase;
            color: #868383;
            padding-left: 28px;
            padding-top: 10px;
        }

        .offer-text-2 {
            float: left;
            clear: both;
            font-size: 27px;
            text-transform: uppercase;
            color: #868383;
            padding-left: 28px;
            padding-top: 10px;
        }

        .offer-text-p {
            padding: 10px 15px;
            float: left;
            font-size: 17px;
            color: #868383;

        }

        .offer-text-3 {
            float: left;
            clear: both;
            font-size: 27px;
            text-transform: uppercase;
            color: #868383;
            padding-left: 28px;
            padding-top: 10px;
        }

        .box-offer-right {
            float: left;
            min-height: 0px;
            width: 100%;
        }

        .right-offer-t {
            float: right;
            padding: 8px 38px;
            font-size: 18px;
            background-color: #fff;
            color: #635f5f;
            margin-top: 33%;
            border-radius: 7px;
            margin-right: 7%;
            margin-bottom: 15px;
        }

        .right-offer-c {
            float: right;
            padding: 13px 31px;
            font-size: 16px;
            color: #635f5f;
            clear: both;
            margin-right: 17%;
            border-radius: 7px;
            background-color: #fff;
        }

        .side-offer-img {
            float: left;
            width: 80px;
            height: 80px;
            margin-left: 10px;
            margin-top: -3%;
            -ms-transform: rotate(20deg);
            /* IE 9 */
            transform: rotate(20deg);


        }

        .side-offer {
            float: left;
            width: 80px;
            height: 80px;



        }

        .side-offer-gif {
            float: right;
            width: 132px;
            height: 107px;
            /* margin-left: 12px; */
            /* margin-top: 10px; */
            margin-right: -17px;
            -ms-transform: rotate(20deg);
            transform: rotate(-14deg);
        }


        /***********************media query*********************/
        @media only screen and (max-width: 1250px) and (min-width: 960px) {
            .bg-offer-1 {
                background-color: #fff;
                overflow: hidden;
                transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
                margin-top: 0px;
                margin-bottom: 0px;
                background-position: center center;
                background-repeat: no-repeat;
                height: auto;
                width: 100%;
                clear: both;
            }

        }

        @media only screen and (max-width: 959px) and (min-width: 769px) {
            .bg-offer-1 {
                background-color: #fff;
                overflow: hidden;
                transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
                margin-top: 0px;
                margin-bottom: 0px;
                background-position: center center;
                background-repeat: no-repeat;
                height: auto;
                width: 100%;
                clear: both;
            }

        }

        @media only screen and (max-width: 768px) and (min-width: 421px) {
            .bg-offer-1 {
                background-color: #fff;
                overflow: hidden;
                transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
                margin-top: 0px;
                margin-bottom: 0px;
                background-position: center center;
                background-repeat: no-repeat;
                height: auto;
                width: 100%;
                clear: both;
            }

        }

        @media only screen and (max-width: 420px) and (min-width: 220px) {
            .bg-offer-1 {
                background-color: #fff;
                overflow: hidden;
                transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
                margin-top: 0px;
                margin-bottom: 0px;
                background-position: center center;
                background-repeat: no-repeat;
                height: auto;
                width: 100%;
                clear: both;
            }

        }

        /***********************tab****************************/

        /******************************user- css***********************/
        .right-box-user {
            float: left;
            height: 272px;
            /* padding: 97px 0px; */
            width: 88%;
            margin-left: 13px;
            margin-top: 0%;
            border-radius: 11px;
            background-color: #e4e4e4;
            border: 1px solid #e6e3e3;
        }

        .col-md-2 {
            padding: 0;
            padding-bottom: 0px;
        }

        .p-3 {
            padding: 0px !important;
        }

        .tab-content {
            padding: 0px !important;
        }

        .circle-user {
            height: 100px;
            width: 100px;
            background-color: #f1f1f1;
            border-radius: 54px;
            position: absolute;
            margin-top: 44%;
            margin-left: 57%;
            border: 7px solid #fff;
        }

        .tab-content {
            float: left;
            background: #ffff;
            width: 93%;
            line-height: 25px;
            border: 1px solid #ddd;
            /* border-top: 5px solid #e74c3c; */
            /* background-color: #f5f5f5; */
            border-bottom: 1px solid #e2e2e2;
            /* padding: 30px 25px; */
            margin-top: 2%;

            border-radius: 14px;
        }

        .head-user {
            float: left;
            font-size: 20px;
            padding-left: 9%;
            padding-top: 21px;
            /* padding: 8px 53px; */
            color: #1e9bd0;
        }

        .clear-user {
            float: left;
            min-height: 0px;
            width: 100%;
            margin: 0;
            /* border-radius: 33px !important; */
            margin-bottom: 16px;
            padding-bottom: -2px;
            /* border-bottom: 1px solid; */
        }

        .first-user {
            float: left;
            color: #716b6b;
            margin: 0;
            letter-spacing: 1px;
            clear: both;
            font-size: 16px;
            padding: 8px 0px;
            width: 49%;
            border-bottom: 1px solid #e4e4e4;
        }

        .bottom-user {
            float: left;
            color: #5f5d5d;
            padding: 14px 78px;
            clear: both;
            /* margin-bottom: 16px; */
            margin: 0;
        }

        .side-span {
            float: right;
            color: #ec7724;
            font-size: 14px;
            font-weight: 600;
            padding-right: 27px;
            padding-top: 15px;
        }

        .side-span-1 {
            float: right;
            color: #f37f1b;
            font-size: 14px;
            font-weight: 600;
            padding: 4px 20px;
            border-radius: 4px;
            margin-top: 11px;
            margin-right: 6px;
            /* background-color: #007bff; */
        }

        .btn-primary-new {
            float: right;
            color: #fff !important;
            /* margin: 9px 91px; */
            margin-top: 12px;
            margin-right: 4px;
            /* margin-left: 40%; */
            clear: both;
            padding: 11px 14px;
            background-color: #1e9bd0 !important;
            border-color: #007bff;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
            padding: 8px !important;
        }

        #side-b {
            color: #1e9bd0;
            text-align: center;
            font-size: 26px;
            padding: 31px 0px;

        }

        .border-user {
            float: right;
            border: 1px solid #c1bebc4a;
            width: 39%;
            margin-top: -17px;

        }

        /*****************media query*********************/

        @media only screen and (max-width: 768px) and (min-width: 421px) {
            .tab-card-header>.nav-tabs {
                border: none;
                margin: 0px;
                float: left;
                margin-left: 33%;
            }

            .tab-content {
                float: left;
                background: #ffff;
                width: 97%;
                line-height: 25px;
                border: 1px solid #ddd;
                /* border-top: 5px solid #e74c3c; */
                /* background-color: #f5f5f5; */
                border-bottom: 1px solid #e2e2e2;
                /* padding: 30px 25px; */
                margin-top: 2%;
                margin-left: 0px;
                border-radius: 14px;
            }

            .right-box-user {
                float: left;
                height: 274px;
                /* padding: 97px 0px; */
                width: 100%;
                margin-left: 13px;
                margin-top: 0%;
                border-radius: 8px;
                background-color: #e4e4e4;
                border: 1px solid #e6e3e3;
            }

            .circle-user {
                height: 70px;
                width: 70px;
                background-color: #f1f1f1;
                border-radius: 54px;
                position: absolute;
                margin-top: 7em;
                margin-left: 78%;
                border: 7px solid #fff;
            }

            #side-b {
                color: #1e9bd0;
                text-align: center;
                font-size: 26px;
                padding: 19px 0px;
            }

            .first-user {
                float: left;
                color: #716b6b;
                margin: 0;
                letter-spacing: 1px;
                clear: both;
                font-size: 14px;
                padding: 8px 0px;
                width: 62%;
                border-bottom: 1px solid #e4e4e4;
            }

            .bottom-user {
                float: left;
                color: #5f5d5d;
                padding: 14px 52px;
                clear: both;
                /* margin-bottom: 16px; */
                font-size: 16px;
                margin: 0;
            }

            .side-span {
                float: right;
                color: #ec7724;
                font-size: 14px;
                font-weight: 600;
                padding-right: 27px;
                padding-top: 14px;
            }

            .btn-primary-new {
                float: right;
                color: #fff !important;
                /* margin: 9px 91px; */
                margin-top: 12px;
                margin-right: 9px;
                /* margin-left: 40%; */
                clear: both;
                padding: 7px 21px;
                background-color: #1e9bd0 !important;
                border-color: #007bff;
            }

            .tab-card {
                border: 1px solid #eeeeee52;
                background-color: #f1f1f126;
                padding-bottom: 2%;
            }

            .border-user {
                display: none !important;

            }

        }


        @media only screen and (max-width: 420px) and (min-width: 220px) {
            .tab-card-header>.nav-tabs {
                border: none;
                margin: 0px;
                float: left;
                margin-left: 17%;
            }

            .tab-content {
                float: left;
                background: #ffff;
                width: 97%;
                line-height: 25px;
                border: 1px solid #ddd;
                /* border-top: 5px solid #e74c3c; */
                /* background-color: #f5f5f5; */
                border-bottom: 1px solid #e2e2e2;
                /* padding: 30px 25px; */
                margin-top: 2%;
                margin-left: 0px;
                border-radius: 14px;
            }

            .right-box-user {
                float: left;
                height: 274px;
                /* padding: 97px 0px; */
                width: 100%;
                margin-left: 13px;
                margin-top: 0%;
                border-radius: 8px;
                background-color: #e4e4e4;
                border: 1px solid #e6e3e3;
            }

            .circle-user {
                height: 70px;
                width: 70px;
                background-color: #f1f1f1;
                border-radius: 54px;
                position: absolute;
                margin-top: 6em;
                margin-left: 57%;
                border: 7px solid #fff;
            }

            #side-b {
                color: #1e9bd0;
                text-align: center;
                font-size: 26px;
                padding: 19px 0px;
            }

            .first-user {
                float: left;
                color: #716b6b;
                margin: 0;
                letter-spacing: 1px;
                clear: both;
                font-size: 10px;
                padding: 8px 12px;
                width: 72%;
                border-bottom: 1px solid #e4e4e4;
            }

            .bottom-user {
                float: left;
                color: #5f5d5d;
                padding: 14px 15px;
                clear: both;
                /* margin-bottom: 16px; */
                font-size: 11px;
                margin: 0;
            }

            .side-span {
                float: right;
                color: #ec7724;
                font-size: 14px;
                font-weight: 600;
                padding-right: 27px;
                padding-top: 14px;
            }

            .btn-primary-new {
                float: right;
                color: #fff !important;
                /* margin: 9px 91px; */
                margin-top: 12px;
                margin-right: 9px;
                /* margin-left: 40%; */
                clear: both;
                padding: 7px 21px;
                background-color: #1e9bd0 !important;
                border-color: #007bff;
            }

            .tab-card {
                border: 1px solid #eeeeee52;
                background-color: #f1f1f126;
                padding-bottom: 2%;
            }

            .border-user {
                display: none !important;

            }

        }


        .boxe {
            position: relative;
            width: 184px;
            height: 56px;

            background: rgba(0, 0, 0);
            border-radius: 8px;
            padding-right: 12px;
            display: flex;
            justify-content: end;
            align-items: center;
            z-index: 1;
        }


        .boxeside {

            position: relative;
            width: 77.78px;
            height: 77.78px;
            left: 135px;
            bottom: 64px;
            border-radius: 4px;
            transform: rotate(45deg);
            background: linear-gradient(45deg, transparent 50%, black 50%);
        }


        #fontweight {
            font-weight: 700;
            width: 355px;
            height: 151px;
            left: 80px;
            top: 202px;
            font-size: 24px;
            font-weight: 700;
            color: white;

            font-family: 'Poppins';
            font-style: normal;
        }

        .font-heading {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 36px;
            width: 416px;
            height: 108px;
        }

        .first_section {
            background-image: linear-gradient(to right, #F7A71E 6.78%, rgba(39, 126, 225, 0.5) 94.1%),
            url('{{ url('public/Rectangle 33.png') }}');
            text-align: center;
            color: #fff;


        }
    </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168384510-1"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());



        gtag('config', 'UA-168384510-1');
    </script>

</head>



<body>


    @if(\Route::current()->getName() == 'index')
    @else
    @include('website.partials.header')
    @endif


    @yield('content')





    @include('website.partials.footer')

    @yield('script')



</body>



<script>
    $(document).ready(function() {

        $('#service_id').select2();

    });
</script>

</html>