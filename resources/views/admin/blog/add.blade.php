@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Blog</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Blog</li>
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
                <h3 class="card-title">Add Blog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('add-blog')}}" method="POST" role="form" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">URL</label>
                    <input type="text" name="url" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Tag Title</label>
                    <input type="text" name="meta_tag" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Description</label>
                    <input type="text" name="meta_description" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Blog Image</label>
                    <input type="file" name="image" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" id="" rows="5" class="form-control"></textarea>
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


