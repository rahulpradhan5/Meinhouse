@extends('admin_jobick.layout.layout')
@section('content')
    <!-- Main content -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('admin/edit-testimonial-post')}}" method="POST" role="form" id="quickForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$testimonial->id}}">
                <div class="card-body">
                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Testimonial Image</label>
                    <input type="file" name="image" class="form-control">
                  </div>
                  <img src="{{ url('public/testimonial/'.$testimonial->testimonial_image) }}" height="100" width="auto" class="mb-3">

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" value="{{ $testimonial->name }}" class="form-control">
                  </div>

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $testimonial->description }}</textarea>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url('admin/testimonials') }}" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-primary ml-2">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
         
        </div>
        <!-- /.row -->
      

  @endsection
