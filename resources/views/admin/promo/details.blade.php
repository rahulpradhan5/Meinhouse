@extends('admin.layout.layout')
@section('content')


<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Promocode Show</h3>
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
                <div class="card card-info">
              <!-- form start -->
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $promo->name }}</span>
                    </div>
                  </div>
                 <!--  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ratings</label>
                    <div class="col-sm-10">
                      <span class="form-control">4</span>
                    </div>
                  </div> -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Code</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                        <span class="">{{ $promo->code }}</span>
                      </div>
                  </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Price(in $)</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                        <span class="">{{ $promo->price }}</span>
                      </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Promocode Image</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                        <img src="{{ url('assets/services/'.$promo->promo_image) }}" height="50" width="100">
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Description</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="" >{{ $promo->description }}</span>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Starting Date</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="" style="word-break: break-all;">{{ $promo->start_date }}</span>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Ending Date</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="" style="word-break: break-all;">{{ $promo->end_date }}</span>
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
