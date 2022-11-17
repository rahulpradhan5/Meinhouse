<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Meinhaus" />
	<meta property="og:title" content="Meinhaus" />
	<meta property="og:description" content="Meinhaus" />
	<meta property="og:image" content="{{url('assets/jobick/images/logo.png')}}" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Meinhaus</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{url('assets/jobick/images/logo.png')}}" />
	<link href="{{url('assets/jobick/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link rel="stylesheet" href="{{url('assets/jobick/vendor/toastr/css/toastr.min.css')}}">
	<link href="{{url('assets/jobick/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link href="{{url('assets/jobick/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	<!-- Style css -->
	<link href="{{url('assets/jobick/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{url('assets/jobick/css/style.css')}}" rel="stylesheet">
    
    {!! htmlScriptTagJsApi() !!}
</head>
<style>
	.toast-success {
  background-color: #51a351;
}
.btn-highlight{
  text-align:center;
  background-color: #ffc107;
  padding: 3px 7px;
  color: #fff;
  border-radius: 6px;
  width: 100%;
}
.btn-highlight1{
background-color: #07baff;
text-align:center;padding: 3px 7px;
color: #fff;
border-radius: 6px;
width: 100%;
}
.btn-highlight2{
background-color: #0c4fca;
text-align:center;padding: 3px 7px;
color: #fff;
border-radius: 6px;
width: 100%;
}
.btn-highlight3{
background-color: #961622;
text-align:center;padding: 3px 7px;
color: #fff;
border-radius: 6px;
width: 100%;
}
.btn-highlight4{
background-color: #0f899c;
text-align:center;padding: 3px 7px;
color: #fff;
border-radius: 6px;
width: 100%;
}
.btn-highlight5{
background-color: #0f8e36;
text-align:center;padding: 3px 7px;
color: #fff;
border-radius: 6px;
width: 100%;
}
.btn-highlight6{
background-color: #ff5707;
text-align:center;padding: 3px 7px;
color: #fff;
border-radius: 6px;
width: 100%;
}
.btn-highlight7{
  background-color: #de3bac;
  text-align: center;
  padding: 3px 5px;
  color: #fff;
  border-radius: 6px;
  width: 100%;
}

@media only screen and (max-width: 47.9375rem){
	[data-sidebar-style="overlay"] .nav-header .logo-abbr {
	display: block;
}
}
@media only screen and (max-width: 35.9375rem){
	.nav-header .logo-abbr {
	width: 4.188rem;
	height: 4.188rem;
	}

}
</style>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('professional.partials.header')
        
        <!--**********************************
            Nav header end
        ***********************************-->
	
		<!--**********************************
            Content body start
        ***********************************-->

	<div class="content-body">
		<div class="container-fluid">

        @yield('content')

        </div>
	</div>
        <!--**********************************
            Content body end
        ***********************************-->
		
		
		
        <!--**********************************
            Footer start
        ***********************************-->
      
        @include('professional.partials.footer')

        <!--**********************************
            Footer end
        ***********************************-->

        @yield('script')

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
	<script>
		jQuery(document).ready(function(){
				 var theme = localStorage.getItem("theme") || "light";
			setTimeout(function(){
				dlabSettingsOptions.version = theme;
				new dlabSettings(dlabSettingsOptions);
			},0)
		});

		function darkmode(){
			var darkbutton = document.getElementById("darkbutton");
			var lightbutton = document.getElementById("lightbutton");
				
				lightbutton.style.display = "flex";
				darkbutton.style.display = "none";

				localStorage.setItem("theme", "dark");
			setTimeout(function(){
				dlabSettingsOptions.version = 'dark';
				new dlabSettings(dlabSettingsOptions);
			},0)
		
		}
	
		function lightmode(){
			var darkbutton = document.getElementById("darkbutton");
			var lightbutton = document.getElementById("lightbutton");

				lightbutton.style.display = "none";
				darkbutton.style.display = "flex"; 

				localStorage.setItem("theme", "light");
			setTimeout(function(){
				dlabSettingsOptions.version = 'light';
				new dlabSettings(dlabSettingsOptions);
			},0)
		
		}
		
	</script>
    <script>
		jQuery(document).ready(function(){


		var theme = localStorage.getItem("theme") || "light";

		var darkbutton = document.getElementById("darkbutton");
		var lightbutton = document.getElementById("lightbutton");

			if(theme == "light"){
				lightbutton.style.display = "none";
			}else {
				darkbutton.style.display = "none";
			}

		});
	</script>
    
	<script>
		function JobickCarousel()
			{
				/*  testimonial one function by = owl.carousel.js */
				jQuery('.front-view-slider').owlCarousel({
					loop:false,
					margin:30,
					nav:true,
					autoplaySpeed: 3000,
					navSpeed: 3000,
					autoWidth:true,
					paginationSpeed: 3000,
					slideSpeed: 3000,
					smartSpeed: 3000,
					autoplay: false,
					animateOut: 'fadeOut',
					dots:true,
					navText: ['', ''],
					responsive:{
						0:{
							items:1
						},
						
						480:{
							items:1
						},			
						
						767:{
							items:3
						},
						1750:{
							items:3
						}
					}
				})
			}

			jQuery(window).on('load',function(){
				setTimeout(function(){
					JobickCarousel();
				}, 1000); 
			});
	</script>
	<script>
		@if(Session::has('error'))
			toastr.error("{{Session::get('error')}}");
		@endif
		@if(Session::has('success'))
			toastr.success("{{Session::get('success')}}");
		@endif
	</script>
</body>
</html>