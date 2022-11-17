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
            <h3>Booking Transactions</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Booking Transactions</li>
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
					<th>User Name</th>
                    <th>Booking ID</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
				  @foreach($bookings as $key => $userDetails)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td><?php $users = DB::table('users')->where('id',$userDetails->user_id)->get(); echo $users[0]->name; ?></td>
                    <td><?php $users = DB::table('bookings')->where('id',$userDetails->booking_id)->get(); echo $users[0]->booking_show_id; ?></td>
					<td>{{$userDetails->transaction_id}}</td>
					<td>{{$userDetails->amount}}</td>
					
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
					<th>User Name</th>
                    <th>Booking ID</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
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