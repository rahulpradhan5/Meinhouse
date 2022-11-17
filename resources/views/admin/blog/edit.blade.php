@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Blog</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Testimonial</li>
            </ol> --}}
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

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('edit-blog',$blog->id)}}" method="POST" role="form" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" value="{{ $blog->title }}" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">URL</label>
                      <input type="text" name="url" value="{{ $blog->url }}" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Tag Title</label>
                      <input type="text" name="meta_tag" value="{{ $blog->meta_title }}" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Keywords</label>
                      <input type="text" name="meta_keywords" value="{{ $blog->meta_keywords }}" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Description</label>
                      <input type="text" name="meta_description" value="{{ $blog->meta_description }}" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Blog Image</label>
                      <input type="file" name="image" class="form-control">
                    </div>
                    <img src="{{ url('public/upload/blogs/'.$blog->blog_image) }}" height="50" width="50" class="mb-3">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $blog->description }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url('blog') }}" class="btn btn-danger">Cancel</a>
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
    </section>
    <!-- /.content -->
  </div>
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
