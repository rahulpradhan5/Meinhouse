@extends('admin_jobick.layout.layout')
@section('content')

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('admin/contact') }}" class="btn btn-primary float-right btn-sm">&laquo; Back</a>
                    </div>
              <!-- form start -->
                <div class="card-body">

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $contact->name }}</span>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Cell Phone</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $contact->phone }}</span>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $contact->email }}</span>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Venue</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $contact->venue }}</span>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Message</label>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><B>:</B></label>
                    <div class="col-sm-6">
                      <span class="">{{ $contact->message }}</span>
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
