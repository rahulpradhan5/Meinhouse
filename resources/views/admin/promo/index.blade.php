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
            <h3>Promocode Management</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Promocode Management</li>
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
					<th>Name</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				  @foreach($bookings as $key => $userDetails)
                  <tr>
                    <td>{{$key + 1}}</td>
					<td>{{$userDetails->name}}</td>
					<td>{{$userDetails->code}}</td>
					<td>{{$userDetails->price}}</td>
					<td>{{$userDetails->start_date}}</td>
					<td>{{$userDetails->end_date}}</td>
					<td>
                        <a href="{{url("view-promo/$userDetails->id")}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="{{url("update-user/$userDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-user/$userDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
					</td>

                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
					<th>Name</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
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
