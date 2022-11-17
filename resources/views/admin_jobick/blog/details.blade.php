@extends('admin_jobick.layout.layout')
@section('content')
            <div class="row">
              <div class="col-12">
                <div class="card card-info">
              <!-- form start -->
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ url('admin/blog') }}" class="btn btn-primary float-right btn-sm">&laquo; Back</a>
                    </div>
                  <div class="form-group row">
                      <label for="inputEmail3" class="col-4 col-form-label">Image</label>
                      <label for="inputEmail3" class="col-2 col-form-label"><B>:</B></label>
                      <div class="col-sm-6">
                        <img src="{{ url('public/upload/blogs/'.$blog->blog_image) }}" height="50" width="50">
                      </div>
                    </div>

                  <div class="form-group row">
                      <label for="inputEmail3" class="col-4 col-form-label">Title</label>
                      <label for="inputEmail3" class="col-2 col-form-label"><B>:</B></label>
                      <div class="col-sm-6">
                        <span class="">{{ $blog->title }}</span>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-4 col-form-label">Description</label>
                      <label for="inputEmail3" class="col-2 col-form-label"><B>:</B></label>
                      <div class="col-sm-6">
                        <span class="">
                            {!! $blog->description !!}
                        </span>
                      </div>
                  </div>







                </div>
            </div>
            <!-- /.card -->
              </div>
              <!-- /.col -->

              <!-- /.col -->
            </div>
            <!-- /.row -->
	  @endsection
