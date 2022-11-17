@extends('admin.layout.layout')
@section('content')


<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Service Management</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Service</li>
            </ol>
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
                <div class="card card-info">
              <!-- form start -->
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $service->name }}</span>
                    </div>
                  </div>
                 <!--  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ratings</label>
                    <div class="col-sm-10">
                      <span class="form-control">4</span>
                    </div>
                  </div> -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Icon</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                    <img src="{{ url('assets/services/'.$service->service_image) }}" height="50" width="100">
                    </div>
                  </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Image</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class=""><img src="{{ url('assets/services/'.$service->service_desc_image) }}" height="50" width="100"></span>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Description</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="" style="word-break: break-all;">{{ $service->description }}</span>
                    </div>
                  </div>

                   <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Time(in Hour)</label>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $service->time }}</span>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Price(in $)</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $service->price }}</span>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Additional Price(in $)</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $service->add_price }}</span>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Created at</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $service->created_at }}</span>
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
