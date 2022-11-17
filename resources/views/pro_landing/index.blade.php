<!DOCTYPE html>
<html lang="en">
<head>
  <title>MeinHaus - Pro Landing</title>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  
  <style>
     body{
            width: 100%;
            height: 100%;
        }
  .hero-banner{
     background-image: linear-gradient(rgba(0, 0, 0, 0.48), rgba(0, 0, 0, 0.48)),url('{{url('public/pro_landing_assets/img/pexels-luis-yanez-206172.jpg')}}');
    background-position: center center;
    background-repeat: no-repeat;
    width: 100%;
            height:min-content;
            height: 100%;
    background-size: cover;
   
    }
   
  /*.logo1{
    position: relative;
    top: 0%;
    bottom: 2rem;
  }*/
  
    
    @media (min-width:320px)
    {
        #logo_res{
            width: 250px!important;
            margin-top:25px;
        }
      
    }
    @media (min-width:1281px)
    {
        #logo_res{ 
            width: 400px!important;
            margin-top:0px;
        }
    }
   /* .hero-banner p.dreamland {
    color: #fff;
    font-size: 24px;
    margin-bottom: 6rem;
} 
@media (max-width: 375px){
.hero-banner {
    width: 151vw;
    height: 148vh;
}
}*/
@media only screen and (max-width:414px){
    .box-1 h1 strong{
        text-align: start;
    }
    .dreamland{
        text-align: start !important;
    }
}
        @media only screen and (min-width:576px)and (max-width:767px){
    .img-fluid {
        max-width: 390%;
        height: auto;
    }
    
}
@media only screen and (min-width:317px)and (max-width:575px){
   #main-row{
    display: flex;
    flex-direction: column;
   }
    
}
#box-3{
    position: relative;
    bottom: 3rem !important;
}
 
  </style>
</head>
<body class="hero-banner d-flex flex-direction-column justify-content-center pt-5 p-0">

<div class="container">
<div class="row" id="main-row">
<div class="col-lg-4 pb-5 col-md-6 col-sm-2 ">
    <a href="{{url('/')}}"><img src="{{ url('public/logo-img-removebg-preview.png') }}" id="logo_res" style="width:400px;"class="w-26 logo1 img-fluid" alt="please Wait"></a>
</div>    
<div class="w-100"></div>
<div class="col col-lg-6 col-md-6 col-sm-12 box-1">
                <!--<span>Jane Rain • Real Estate Agent</span>-->
                <h1 class=""><strong>Receive sold jobs directly from us to you! with no project fees.</strong></h1>
                <p class="dreamland">Register today free and receive alerts for eligible projects!</p>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 mx-auto ">
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="margin-top:-20%;">
                        <strong>Whoops!</strong> There were some problems with your input.
                    </div>
                @endif
                @if(session()->has('success'))
                <div class="alert alert-success" style="margin-top:-15%;">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{url('pro-landing-post')}}" method="POST" class="my-2">
                    @csrf
                    <h3 class="mb-4">Registration Form</h3>

                    <div class="form-group">
                   
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" id="name"   value="{{old('name')}}">
                        @error('name')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" placeholder="Enter City" id="city" value="{{old('city')}}">
                        @error('city')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Enter email" id="email" value="{{old('email')}}">

                    @error('email')
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
                        <select class="js-example-basic-multiple" style="width:100%" id="sel1" name="trade[]" multiple>
                            <option  disabled>List your Trades</option>
                            @foreach($services as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                          </select>
                          @error('trade')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="authorize"> I authorize Meinhaus.ca to contact me for opportunities
                      </label>
                      @error('authorize')
                        <span style="color:red;">*{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Register Now !</button>

                </form>
            </div>

        </div>
    </div>


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
    $('.js-example-basic-multiple').select2({ placeholder: "Select Trades",
    allowClear: true});
});  
</script>
</html>
