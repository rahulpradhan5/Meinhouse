@extends('admin.layout.layout')
@section('content')
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
            <h3>Booking Management</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Booking</li>
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
                <h3 class="card-title"></h3>
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
				  @foreach($bookings as $key => $userDetails)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$userDetails->booking_show_id}}</td>
                    <td>{{$userDetails->name}}</td>
					<?php if($userDetails->pro_id==''){ ?>
						 <td>N/A</td>
					<?php }else{ ?>
					<td><?php $users = DB::table('users')->where('id',$userDetails->pro_id)->get(); echo $users[0]->name; ?></td>
                    <?php } ?>
					<td><?php $service = DB::table('services')->where('id',$userDetails->service_id)->get(); echo $service[0]->name; ?></td>

					<td><?php $users = DB::table('users')->where('id',$userDetails->user_id)->get(); echo $users[0]->email; ?></td>
					<td>
                        @if($userDetails->booking_status == 0)
                       <div class="btn-highlight1">
                       <button type="button" class="badge badge-warning fnt">Pending</button>
                       </div>
                        @endif
                        @if($userDetails->booking_status == 1)
                        <div class="btn-highlight1">
                           <button type="button" class="badge badge-info fnt">Confirmed	</button>
                        </div>
                        @endif
                        @if($userDetails->booking_status == 2)
                        <div class="btn-highlight2">
                           <button type="button" class="badge badge-primary fnt">Pro Cancelled</button>

                        </div>
                        @endif
                        @if($userDetails->booking_status == 3)
                        <div class="btn-highlight3">

						<button style="background:#d81b60;" type="button" class="badge badge-danger fnt"> User Cancelled </button>

                         </div>
                        @endif
                        @if($userDetails->booking_status == 4)
                        <div class="btn-highlight3">
                         <button  style="background:#d81b60;" type="button" class="badge badge-danger fnt">Time Exceeds </button>

                         </div>
                        @endif
                        @if($userDetails->booking_status == 5)
                         <div class="btn-highlight5">
                           <button type="button" class="badge badge-success fnt">Completed</button>

                        </div>
                        @endif
                        @if($userDetails->booking_status == 6)
                         <div class="btn-highlight6">

				        <button type="button" class="badge badge-danger fnt">Service Start</button>

                        </div>
                        @endif
                        @if($userDetails->booking_status == 7)
                         <div class="btn-highlight7">

				         <button style="background:#f012be;" type="button" class="badge badge-danger fnt"> Payment Done</button>

                        </div>
                        @endif
                        @if($userDetails->booking_status == 8)
                          <div class="btn-highlight4">

						 <button type="button" class="badge badge-primary fnt">Admin Cancelled</button>

                        </div>
                        @endif
                      </td>



                    <td>
                        <a href="{{url("view-booking/$userDetails->id")}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
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
  @endsection
