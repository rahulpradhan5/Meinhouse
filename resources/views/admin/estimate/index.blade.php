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

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Estimate Management</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Estimate</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

	 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <a href="{{url('add-estimate')}}"><h3 class="card-title"><button type="button" class="btn btn-block bg-gradient-primary">Create Estimate</button></h3></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Pro Assigned</th>
                    <th>Service Name</th>
                    <th>Email</th>
                    <th>Booking Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				  @foreach($estimate as $key => $userDetails)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$userDetails->booking_show_id}}</td>
                    <td>{{$userDetails->name}}</td>
					<td><?php $user_name = DB::table('users')->where('id',$userDetails->pro_id)->where('role_id','3')->get(); echo $user_name[0]->name; ?></td>
					<td><?php $service = DB::table('services')->where('id',$userDetails->service_id)->get(); echo $service[0]->name; ?></td>

					<td>{{$userDetails->email}}</td>
					<td>
                        @if($userDetails->payment_status == 0)
                       <div class="btn-highlight1">
                       <button type="button" class="badge badge-warning fnt">Pending</button>
                       </div>
                        @endif
                        @if($userDetails->payment_status == 1)
                        <div class="btn-highlight1">
                           <button type="button" class="badge badge-info fnt">Confirmed	</button>
                        </div>
                        @endif
                       
                      </td>



                    <td>
                        <a href="javascript:void()" class="btn btn-info"><i class="fa fa-eye"></i></a>
					</td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Pro Assigned</th>
                    <th>Service Name</th>
                    <th>Email</th>
                    <th>Booking Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>


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

