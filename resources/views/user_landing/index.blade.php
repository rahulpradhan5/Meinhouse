<!DOCTYPE html>

<html lang="en">

<head>

  <title>MeinHaus - User Landing</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

   <link  rel="shortcut icon" type="image/png" href="https://meinhausca.com/public/theme/images/favi.png" sizes="32x32">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="{{ url('public/pro_landing_assets/css/style.css') }}">

  <link rel="stylesheet" href="{{ url('public/pro_landing_assets/css/responsive.css') }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .hero-banner {

            background-image: linear-gradient(rgba(0, 0, 0, 0.48), rgba(0, 0, 0, 0.48)), url('https://meinhaus.ca/public/pro_landing_assets/img/pexels-binyamin-mellish-186077.jpg');


            background-position: center center;

            background-repeat: no-repeat;

            background-size: cover;

        }

        .box-2 {
            position: relative;
            top: -2rem;
        }

        @media only screen and (max-width:414px) {

            .hero-banner span,
            .hero-banner h1 strong {
                text-align: start;
                display: block;
            }

            .hero-banner p.dreamland {
                font-size: 15px;
                text-align: start;
            }

            .hero-banner ul li {
                font-size: 15px !important;
            }
        }

        @media only screen and (min-width:576px)and (max-width:767px) {
            .img-fluid {
                max-width: 390%;
                height: auto;
            }

        }

        @media (min-width:320px) {
            #logo_res {
                width: 250px !important;
                margin-top: 25px;
            }

            .hero-banner {
                height: 100vh;
            }
        }

        @media (min-width:1281px) {
            #logo_res {
                width: 400px !important;
                margin-top: 0px;
            }

        }

        @media only screen and (device-width: 768px) {
            .hero-banner p.dreamland {
                font-size: 16px;
                text-align: start;
            }


            .hero-banner ul li {
                font-size: 16px !important;
            }
        }

        @media only screen and (device-width: 820px) {
            .hero-banner p.dreamland {
                font-size: 16px;
                text-align: start;
            }

            .hero-banner ul li {
                font-size: 16px !important;
            }


        }

        .OnlineGeneral {
            font-size: 34px;
            margin-left: auto;
            color: orange;
        }
    </style>

</head>

<body>

 <section class="hero-banner  p-4" style="height: auto;">

        <div class="container pb-5" id="fstrow">

            <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                <div class="justify-content-center d-flex">
                   
  <a href="{{url('/')}}"><img src="https://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 20rem;" alt=""
                        class="img-fluid my-1"></a>
                </div>
                <div
                    class="OnlineGeneral mt-lg-4 text-center col-lg-6 col-md-6 col-12 align-items-center justify-content-lg-start justify-content-md-start justify-content-center d-flex">
                    <span class="text-center mt-lg-4" style="color: orange;font-weight:550;">Online General
                        Contractor </span>
                </div>
            </div>
            <div class="row mt-5">

                <div class="col-lg-6 col-md-6">


                    <!---span>Jane Rain • Real Estate Agent</span--->


                    <h1 id="quote"><strong>Get an instant quote, completely online.</strong></h1>
                    <ul class="ml-2 text-white " style=" list-style-type: none;">
                        <li class="text-white" style="font-size:24px;font-weight:bold;">-Accurate</li>
                        <li class="text-white" style="font-size:24px;font-weight:bold;">-Detailed</li>
                        <li class="text-white" style="font-size:24px;font-weight:bold;">-Select your own date</li>
                        <li class="text-white" style="font-size:24px;font-weight:bold;">-Buyable immediately</li>
                    </ul>


                    <p class="dreamland pb-3" style="width: max-content;font-weight: bold;">Complete virtual project
                        management,<br> simple & fast ordering process</p>

                </div>
              

           

            <div class="col-lg-6 col-md-6  pb-5 col-sm-8 mx-auto my-2 box-2">

                @if (count($errors) > 0)

                    <div class="alert alert-danger" style="margin-top:-15%;">

                        <strong>Whoops!</strong> There were some problems with your input.

                    </div>

                @endif

                @if(session()->has('success'))

                <div class="alert alert-success" style="margin-top:-15%;">

                        {{ session()->get('success') }}

                    </div>

                @endif

                <form action="{{url('user-landing-post')}}"style="background: rgb(211 211 211 / 22%); border-radius: 20px;box-shadow: 0px 0px 2px 1px #b5b3b3;" method="POST"> 

                    @csrf

                    <!--<p>Let me craft a personalized estimate of your home’s value</p>-->



                    <div class="form-group">

                        <input type="text" class="form-control" name="name" placeholder="Enter First name" onkeypress="return /[a-z]/i.test(event.key)"  id="name" value="{{old('name')}}">
                        @error('name')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror

                    </div>
                                 <div class="form-group">

<!---select class="js-example-basic-multiple"  style="width:100%" name="service[]" multiple="multiple" >

    <option  disabled>Select Service</option>

    @foreach($services as $s)

        <option value="{{ $s->id }}">{{ $s->name }}</option>

    @endforeach

</!---select!--->
<input type="text" class="form-control" name="lastname" placeholder="Enter last name" onkeypress="return /[a-z]/i.test(event.key)" id="name" value="{{old('name')}}">

@error('lastname')
<span style="color:red;">*{{$message}}</span>
@enderror

</div>



                    <div class="form-group">

                        <input type="tel" name="phone" value="{{old('phone')}}" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" class="form-control" placeholder="Enter Phone Number" id="phone">
                                    

                        @error('phone')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
                    </div>



                    <div class="form-group">

                        <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email" value="{{old('email')}}">
                        @error('email')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
                    </div>

 <!--<div class="form-group form-check">-->
 <!--                     <label class="form-check-label text-white">-->
 <!--                       <input class="form-check-input" class="text-white" type="checkbox" name="authorize"> I authorize Meinhaus.ca to contact me for Project Information-->
 <!--                     </label>-->
 <!--                     @error('authorize')-->
 <!--                       <span style="color:red;">*{{$message}}</span>-->
 <!--                       @enderror-->
 <!--                   </div>-->

                 
                   



                    <!----div class="form-group">

                        <input type="text" class="form-control" name="street" placeholder="Enter Street Name" id="name" value="{{old('street')}}">

                    </div>



                    <div class="form-group">

                        <input type="text" class="form-control" name="city" placeholder="Enter City/Municipality" id="name" value="{{old('city')}}">

                    </div>



                    <div class="form-group">

                        <input type="text" class="form-control" name="province" placeholder="Enter Province" id="name" value="{{old('province')}}">

                    </div>



                    <div class="form-group">

                        <input type="text" class="form-control" name="postal_code" placeholder="Enter Postal Code" id="name" value="{{old('postal_code')}}">

                    </div>



                    <div class="form-group">

                        <textarea class="form-control" name="address" placeholder="Enter Address" id="email">{{old('address')}}</textarea>

                    </div!----->


                   
                   <div class="row mb-4">
    <div class="col d-flex justify-content-start">
      <!-- Checkbox -->
      
    
     <button type="submit" class="btn btn-primary">Next</button>
      
  
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="{{route('login')}}">   <span class="text-white">Already have an account?</span> </a>
    </div>
  </div>

                   



                  </form>

            </div>



        </div>

    </div>

</section>

<section class="best-price">

    <div class="container text-center">

        <div class="row">

            <div class="col-lg-12">

                <h2>Safe & securely connect with local trades for all home renovations</h2>

                <p>Gain access to our network of vetted and proven trade professionals, with complete virtual project management!</p>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">

               <img src="{{ url('public/pro_landing_assets/img/4.jpeg') }}" alt="">

               <h3>Instant project quote!</h3>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">

                <img src="{{ url('public/pro_landing_assets/img/3.jpeg') }}" alt="">

                <h3>Select a date that works for you</h3>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">

                <img src="{{ url('public/pro_landing_assets/img/2.jpeg') }}" alt="">

                <h3>We send our experts to complete your job</h3>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">

                <img src="{{ url('public/pro_landing_assets/img/1.jpeg') }}" alt="">

                <h3>Access to 24/7 virtual & staff support, for the complete project!</h3>

            </div>

        </div>

    </div>

</section>

<section id="testim" class="testim">

    <!--         <div class="testim-cover"> -->

        <h2>Definitely the new way of handling home renos! Best quotes, fastest service & no more dealing with contractors myself! </h2>

                <div class="wrap">



                    <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>

                    <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>

                    <ul id="testim-dots" class="dots">

                        <li class="dot active"></li><!--

                        --><li class="dot"></li><!--

                        --><li class="dot"></li><!--

                        --><li class="dot"></li><!--

                        --><li class="dot"></li>

                    </ul>

                    <div id="testim-content" class="cont">



                        <div class="active">

                            <div class="img"><img src="{{ url('public/pro_landing_assets/img/quote.png') }}" alt="quote"></div>

                            <p> Our experience with MeinHaus was great! Our home was finished before their committed date. We were informed with the progress every step of the way. Our questions were always answered promptly. Our sales consultant, was so patient , knowledgeable and thorough she made the whole home building process a pleasant experience.!</p>
                            <h2>Isaac Preston</h2>

                        </div>



                        <div>

                            <div class="img"><img src="{{ url('public/pro_landing_assets/img/quote.png') }}" alt="quote"></div>

                            <p> I have nothing but good things to say about MeinHaus. From beginning to end, their customer service was excellent and made the whole process less stressful. The quality of their homes are so much better than other local builders, you can tell this company takes pride in their work.</p>
                            <h2>Brady Newton</h2>

                        </div>



                        <div>

                            <div class="img"><img src="{{ url('public/pro_landing_assets/img/quote.png') }}" alt="quote"></div>

                             <p> We built and moved into our brand new home with MeinHaus. The particular model we built was absolutely perfect for our family and we could not be happier with our choice and the various selections. Sales Professional and Construction Manager were wonderful through out the entire process. They went above and beyond our every need.</p>
                            <h2>Paul Mainse</h2>

                        </div>



                        <div>

                            <div class="img"><img src="{{ url('public/pro_landing_assets/img/quote.png') }}" alt="quote"></div>

                                    <p> We love the beautiful home built by MeinHaus. Everyone we have worked with has been helpful and caring. They start the project as in time and completed our home on time. I would highly recommend them. I would do it again in a heartbeat.</p>
                            <h2>Declan Graham</h2>

                        </div>



                        <div>

                            <div class="img"><img src="{{ url('public/pro_landing_assets/img/quote.png') }}" alt="quote"></div>

                                       <p> My both daughters got their full basement finished by MeinHaus and I am very happy that MeinHaus upgraded my master bathroom with the same professionalism to make me very happy and satisfied. The project managers was wonderful human beings and they deserve a special mention.</p>
                            <h2>Finn Smith</h2>

                        </div>



                    </div>



                </div>

    <!--         </div> -->

        </section>

        <!-----section class="explore">

            <div class="container text-center">

                <div class="row">

                    <div class="col-lg-12">

                        <h2>Explore My Recently SOLD Listings</h2>

                        <p>Serving Dreamland Home Sellers for 15 Years.</p>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">

                       <img src="{{ url('public/pro_landing_assets/img/explore.jpg') }}" alt="">

                       <h3>Tons of natural light</h3>

                       <span>3 bed/ 2 bath - $425,000</span>

                       <p>

                        Elegant, modern home near Central Park! It's everything you’ve dreamed your new home could be.

                       </p>

                       <a href="javascript:void(0)">Learn More</a>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">

                        <img src="{{ url('public/pro_landing_assets/img/explore.jpg') }}" alt="">

                        <h3>Tons of natural light</h3>

                        <span>3 bed/ 2 bath - $425,000</span>

                        <p>

                         Elegant, modern home near Central Park! It's everything you’ve dreamed your new home could be.

                        </p>

                        <a href="javascript:void(0)">Learn More</a>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">

                        <img src="{{ url('public/pro_landing_assets/img/explore.jpg') }}" alt="">

                        <h3>Tons of natural light</h3>

                        <span>3 bed/ 2 bath - $425,000</span>

                        <p>

                         Elegant, modern home near Central Park! It's everything you’ve dreamed your new home could be.

                        </p>

                        <a href="javascript:void(0)">Learn More</a>

                    </div>

                </div>

            </div>

        </section!---->
        
        @include('user_landing.footer2')

</body>

<script>

    // vars

'use strict'

var	testim = document.getElementById("testim"),

		testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),

    testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),

    testimLeftArrow = document.getElementById("left-arrow"),

    testimRightArrow = document.getElementById("right-arrow"),

    testimSpeed = 4500,

    currentSlide = 0,

    currentActive = 0,

    testimTimer,

		touchStartPos,

		touchEndPos,

		touchPosDiff,

		ignoreTouch = 30;

;



window.onload = function() {



    // Testim Script

    function playSlide(slide) {

        for (var k = 0; k < testimDots.length; k++) {

            testimContent[k].classList.remove("active");

            testimContent[k].classList.remove("inactive");

            testimDots[k].classList.remove("active");

        }



        if (slide < 0) {

            slide = currentSlide = testimContent.length-1;

        }



        if (slide > testimContent.length - 1) {

            slide = currentSlide = 0;

        }



        if (currentActive != currentSlide) {

            testimContent[currentActive].classList.add("inactive");

        }

        testimContent[slide].classList.add("active");

        testimDots[slide].classList.add("active");



        currentActive = currentSlide;



        clearTimeout(testimTimer);

        testimTimer = setTimeout(function() {

            playSlide(currentSlide += 1);

        }, testimSpeed)

    }



    testimLeftArrow.addEventListener("click", function() {

        playSlide(currentSlide -= 1);

    })



    testimRightArrow.addEventListener("click", function() {

        playSlide(currentSlide += 1);

    })



    for (var l = 0; l < testimDots.length; l++) {

        testimDots[l].addEventListener("click", function() {

            playSlide(currentSlide = testimDots.indexOf(this));

        })

    }



    playSlide(currentSlide);



    // keyboard shortcuts

    document.addEventListener("keyup", function(e) {

        switch (e.keyCode) {

            case 37:

                testimLeftArrow.click();

                break;



            case 39:

                testimRightArrow.click();

                break;



            case 39:

                testimRightArrow.click();

                break;



            default:

                break;

        }

    })



		testim.addEventListener("touchstart", function(e) {

				touchStartPos = e.changedTouches[0].clientX;

		})



		testim.addEventListener("touchend", function(e) {

				touchEndPos = e.changedTouches[0].clientX;



				touchPosDiff = touchStartPos - touchEndPos;



				console.log(touchPosDiff);

				console.log(touchStartPos);

				console.log(touchEndPos);



			z

				if (touchPosDiff > 0 + ignoreTouch) {

						testimLeftArrow.click();

				} else if (touchPosDiff < 0 - ignoreTouch) {

						testimRightArrow.click();

				} else {

					return;

				}



		})

}

</script>

<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2({ placeholder: "Select services",
    allowClear: true});
});  
</script>

</html>

