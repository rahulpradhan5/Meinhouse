@extends('admin.layout.layout')
@section('content')


<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Testimonial Show</h3>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sales</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

       <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="_card _card-default">

          <!-- /.card-header -->
          <div class="_card-body">
            <div class="row">
              <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <a href="{{ url('testimonials') }}" class="btn btn-primary float-right btn-sm">&laquo; Back</a>
                    </div>
              <!-- form start -->
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Testimonial Image</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <img src="{{ url('public/upload/testimonials/'.$testimonial->testimonial_image) }}" height="50" width="50">
                    </div>
                  </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $testimonial->name }}</span>
                    </div>
                  </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Desciption</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">
                          {{ $testimonial->description }}
                      </span>
                    </div>
                  </div>







                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-info">Submit</button> -->
                  <!-- <a href=""><button type="button" class="btn btn-default ">Back</button></a> -->
                </div>
            </div>
            <!-- /.card -->
              </div>
              <!-- /.col -->

              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
        </div>
      </section>

	  </div>

	  @endsection
