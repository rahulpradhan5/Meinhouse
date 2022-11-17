@extends('admin_jobick.layout.layout')
@section('content')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item "><a href="{{url('admin/testimonials')}}">Testimonials</a></li>
        <li class="breadcrumb-item active"><a href="">Add Testimonials</a></li>
    </ol>
</div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Testimonial</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('admin/add-testimonial-post')}}" method="POST" role="form" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="mb-2 form-group">
                    <label for="exampleInputEmail1"><h5> Testimonial Image </h5></label>
                    <input type="file" name="image" class="form-control"  accept="image/png, image/gif, image/jpeg" >
                  </div>

                  <div class="mb-2 form-group">
                    <label for="exampleInputEmail1"><h5> Name </h5></label>
                    <input type="text" name="name" class="form-control">
                  </div>

                  <div class="mb-2 form-group">
                    <label for="exampleInputEmail1"><h5> Description </h5></label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="{{ url('testimonials') }}" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary ml-2">Submit</button>
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

  @endsection
