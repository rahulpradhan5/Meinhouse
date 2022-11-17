@extends('admin_jobick.layout.layout')
@section('content')
<div class="row page-titles">
    <ol class="breadcrumb">
    <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{url('admin/blog')}}">Blogs</a></li>
        <li class="breadcrumb-item active"><a href="">Add Blogs</a></li>
    </ol>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Blog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('admin/add-blog')}}" method="POST" role="form" id="quickForm" novalidate enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5">Title</label>
                    <input type="text" name="title" class="form-control" required>
                  </div>

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5">URL</label>
                    <input type="text" name="url" class="form-control" required>
                  </div>

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5">Meta Tag Title</label>
                    <input type="text" name="meta_tag" class="form-control" required>
                  </div>

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" required>
                  </div>

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5">Meta Description</label>
                    <input type="text" name="meta_description" class="form-control" required>
                  </div>

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5">Blog Image</label>
                    <input type="file" name="image" class="form-control" required>
                  </div>

                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5">Description</label>
                    <textarea name="description" id="ckeditor" rows="5" class="form-control" required></textarea>
                  </div>
                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="h5"> Publishing Date</label>
                    <input type="date" name="date" class="form-control" required>
                  </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url('admin/blog') }}" class="btn btn-danger">Cancel</a>
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
  @endsection
  @section('script')
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
      CKEDITOR.replace('description', {
      height: 200,
      removeButtons: '',
      coreStyles_bold: {
          element: 'b',
          overrides: 'strong'
      },
      coreStyles_italic: {
          element: 'i',
          overrides: 'em'
      }
      });
  </script>
  @endsection


