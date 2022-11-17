@extends('professional.layout.layout')
@section('head_title','CHANGE PASSWORD')
@section('content')

   <div class="row">

                  <div class="card card-info">

         <div class="card-header">

            <h3 class="card-title">Change Password</h3>

         </div>

         <!-- /.card-header -->

         <!-- form start -->

          <form method="POST" action="{{url('pro/proff-change-password-post')}}" id="change-password" name="change-password" enctype="multipart/form-data">

            @csrf         <div class="card-body row">

        

            <div class="col-md-12">

                

            	 <div class="form-group row mb-2">

	               <label for="text" class="col-sm-2 col-form-label">Current Password</label>

	               <div class="col-sm-10">

	                  <input type="password" class="form-control" id="current_password" name="current_password">

	               </div>

	            </div>

	            <div class="form-group row mb-2">

	               <label for="inputEmail3" class="col-sm-2 col-form-label">New Password</label>

	               <div class="col-sm-10">

	                  <input type="password" class="form-control" id="new_password" name="new_password" >

	               </div>

	            </div>

	            <div class="form-group row mb-2">

	               <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>

	               <div class="col-sm-10">

	                  <input type="password" class="form-control" id ="confirm_password" name="confirm_password">

	               </div>

	            </div>

	            <div class="row">

	               <div class="col-12">

	                  <div class="card-footer">

	                     <button type="submit" class="btn btn-info" style="float:right;">Change Password</button>

	                  </div>

	               </div>

	            </div>

	        	

            </div>

         </div>

        </form>

         <!-- </form>-->

      </div>

   </div>

  @endsection