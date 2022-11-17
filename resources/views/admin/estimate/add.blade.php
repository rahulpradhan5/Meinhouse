<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Meinhause</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('assets/adminlte/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



<link rel="stylesheet" href="{{url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{ url('assets/adminlte/plugins/toastr/toastr.min.css') }}">

<link rel="stylesheet" href="{{ url('assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">



<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>


    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
    
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{url('assets/adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Meinhaus</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="#" class="d-block">Welcome Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

		<!--	<li class="nav-item">
			  <a href="{{url('admin-dashboard')}}" class="nav-link">
			   <p>Dashboard</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{url('user')}}" class="nav-link">
			   <p>User</p>
			  </a>
			</li>


			<li class="nav-item">
			  <a href="{{url('professional')}}" class="nav-link">
			   <p>Professional</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{url('service')}}" class="nav-link">
			   <p>Service</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{url('bookings')}}" class="nav-link">
			   <p>Bookings</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{url('sales')}}" class="nav-link">
			   <p>Sales</p>
			  </a>
			</li> -->
			
			<li class="nav-item">
			  <a href="{{url('estimate')}}" class="nav-link">
			   <p>Estimate</p>
			  </a>
			</li>

			<!--<li class="nav-item">
			  <a href="{{url('transaction')}}" class="nav-link">
			   <p>Booking Transaction</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{url('promo')}}" class="nav-link">
			   <p>Promo Code</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{url('testimonials')}}" class="nav-link">
			   <p>Testimonials</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{ url('contact') }}" class="nav-link">
			   <p>Contact Us</p>
			  </a>
			</li>

			<li class="nav-item">
			  <a href="{{ url('blog') }}" class="nav-link">
			   <p>Blogs</p>
			  </a>
			</li> 


			<li class="nav-item">
			  <a href="{{url('estimate')}}" class="nav-link">
			   <p>Create Job</p>
			  </a>
			</li> 

			<li class="nav-item">
			  <a href="{{url('logout')}}" class="nav-link">
			   <p>Log Out</p>
			  </a>
			</li>-->



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<?php error_reporting(0); ?>
<style>
.fnt{
width:120px;
color:white;
border:1px solid white;
padding-top:10px;
padding-bottom:10px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Estimate</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Estimate</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Estimate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('post-add-estimate')}}" method="post" role="form" id="quickForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" name="user_id" class="form-control" placeholder="User Name" required>
                  </div>
				 @csrf 
				  <div class="form-group">
                    <label for="exampleInputEmail1">User Email</label>
                    <input type="text" name="email" class="form-control"  placeholder="User Email" required>
                  </div>
				  
				<div class="form-group">
                  <label>Select Service</label>
                  <select name="service_id" class="form-control select2bs4" style="width: 100%;" required>
                    <option value="">Select Service Name</option>
					@foreach($services as $service)
					<option value="{{$service->id}}">{{$service->name}}</option>
					@endforeach
                  </select>
                </div>
				   

				   <div class="form-group">
                    <label for="exampleInputEmail1">Select Date</label>
                    <input type="date" name="date" class="form-control"  placeholder="Enter Address" required>
                  </div>
				 
				<div class="form-group">
                  <label>Select Time</label>
                  <select name="time" class="form-control select2bs4" style="width: 100%;" required>
                    <option value="">Select Time</option>
                        <option value="0">Morning(08:00 AM - 11:00 AM)</option>
                        <option value="1">Midnoon(11:00 AM - 02:00 PM)</option>
                        <option value="2">Afternoon(02:00 PM - 05:00 PM)</option>
                        <option value="3">Evening(05:00 PM - 08:00 PM)</option>

                  </select>
                </div>
				  
				  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Custom Amount</label>
                    <input type="text" name="amount" class="form-control" id="exampleInputtext1" placeholder="Enter Custom Amount" required>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputtext1">Registration Amount</label>
                    <input type="text" name="reg_amount" class="form-control" id="exampleInputtext1" placeholder="Enter Registration Amount" required>
                  </div>
				  
				<div class="form-group">
                  <label>Select Professional</label>
                  <select class="form-control select2bs4" name="pro_id" style="width: 100%;" required >
			     <option value="">Select Professional Name</option>

                    @foreach($pro as $user)
                           <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                           @endforeach
                  </select>
                </div>
                 
				  <div class="form-group">
                    <label for="exampleInputtext1">Address</label>
                    <input type="text" name="address" class="form-control" id="exampleInputtext1" placeholder="Enter Address" required>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputtext1">City/Municipality</label>
                    <input type="text" name="city" class="form-control" id="exampleInputtext1" placeholder="Enter City/Municipality" required>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputtext1">Province</label>
                    <input type="text" name="state" class="form-control" id="exampleInputtext1" placeholder="Enter Province" required>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputtext1">Postal Code</label>
                    <input type="text" name="pin_code" class="form-control" id="exampleInputtext1" placeholder="Enter Postal Code" required>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputtext1">Contact Number</label>
                    <input type="text" name="phone_no" class="form-control" id="exampleInputtext1" placeholder="Enter Contact Number" required>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputtext1">Description</label>
                    <input type="text" name="description" class="form-control" id="exampleInputtext1" placeholder="Enter Description" required>
                  </div>
				 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
   <footer class="main-footer">
    <strong>Copyright &copy; 2021 </strong>
    All rights reserved.

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->

<script src="{{url('assets/adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('assets/adminlte/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('assets/adminlte/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('assets/adminlte/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/adminlte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('assets/adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/adminlte/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('assets/adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/adminlte/dist/js/demo.js')}}"></script>


<script src="{{url('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ url('assets/adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Bootstrap 4 -->
<!-- DataTables -->
<script src="{{url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
    $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    @if(session()->has('success'))
    Toast.fire({
        icon: 'success',
        title: '{{ session()->get('success') }}'
      })
    @endif
    @if(session()->has('delete'))
      Toast.fire({
        icon: 'error',
        title: '{{ session()->get('delete') }}'
      })
    @endif
    @if(session()->has('update'))
      Toast.fire({
        icon: 'info',
        title: '{{ session()->get('update') }}'
      })
    @endif
  });

</script>

</body>
</html>
