@extends('admin_jobick.layout.layout')
@section('content')



<div class="row">
    <div class="col-12">
        <div class="card ">
            <div class="card-header">
                <a href="{{ url('admin/testimonials') }}" class="btn btn-primary float-right btn-sm">&laquo; Back</a>
            </div>
            <!-- form start -->
            <div class="card-body">
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Testimonial Image</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                        <img src="{{ url('public/testimonial/'.$testimonial->testimonial_image) }}" height="100"
                            width="auto">
                    </div>
                </div>

                <div class="form-group row mb-2 my-4">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                        <span class="">{{ $testimonial->name }}</span>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Desciption</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                        <span class="">
                            {{ $testimonial->description }}
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