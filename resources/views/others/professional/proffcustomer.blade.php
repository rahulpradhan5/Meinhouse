@extends('professional.layout.layout')
@section('content')
<div class="content-wrapper">

<section class="content">
    <br>
      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Customer Reviews</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
                         <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Average Rating</span>
                      <span class="info-box-number text-center text-muted mb-0"> </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Total Number of Reviews</span>
                      <span class="info-box-number text-center text-muted mb-0">0</span>
                    </div>
                  </div>
                </div>
 <!--                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Total Number of Rating</span>
                      <span class="info-box-number text-center text-muted mb-0">20 <span>
                    </span></span></div>
                  </div>
                </div> -->
              </div>
              <div class="row">
                <div class="col-12">
                  <h5>Customer Review and Rating Details</h5>
                                        	<h6>No data found</h6>
                      	


                   
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
	
  </div>

@endsection