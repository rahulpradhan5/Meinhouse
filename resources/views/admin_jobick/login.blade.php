<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:title" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:image" content="https://jobick.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title> Admin Login</title>
	
	<!-- FAVICONS ICON -->
   <link rel="shortcut icon" type="image/png" href="{{url('assets/jobick/images/logo.png')}}" />
	<link href="{{url('assets/jobick/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link rel="stylesheet" href="{{url('assets/jobick/vendor/toastr/css/toastr.min.css')}}">
	<link href="{{url('assets/jobick/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link href="{{url('assets/jobick/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	
	<!-- Style css -->
    <link href="{{url('assets/jobick/css/style.css')}}" rel="stylesheet">
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="{{url('admin/login')}}"><img class="img-fluid w-25"src="{{url('assets/jobick/images/logo.png')}}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="{{url('admin/login/post')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password"  placeholder="Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{url('assets/jobick/vendor/global/global.min.js')}}"></script>
    <script src="{{url('assets/jobick/js/custom.min.js')}}"></script>
    <script src="{{url('assets/jobick/js/dlabnav-init.js')}}"></script>

    <script src="{{url('assets/jobick/vendor/toastr/js/toastr.min.js')}}"></script>
    <script src="{{url('assets/jobick/js/plugins-init/toastr-init.js')}}"></script>	
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