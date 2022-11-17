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
            <h3>Testimonials Management</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Testimonials</li>
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
                <a href="{{ url('add-testimonial') }}" class="btn btn-primary float-right btn-sm"><i class="fas fa-plus"></i> Add New</a>
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
				  @foreach($testimonial as $t)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td><img src="{{ url('public/upload/testimonials/'.$t->testimonial_image) }}" height="50" width="50"></td>
                    <td>{{ $t->name }}</td>
					<td>
                        <a href="{{url("view-testimonial/$t->id")}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <a href="{{url("edit-testimonial/$t->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-testimonial/$t->id")}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					</td>
                  </tr>
                  @endforeach
                  </tbody>
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
