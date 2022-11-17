@extends('website.layouts.master')
@section('after-style')
	<style type="text/css">
		.ttm-page-title-row.prologin_image.text-center{
			background-image: url('{{asset("theme/images/login-head.jpg")}}');
			height: auto;
		}
		div.ttm-page-title-row > .ttm-bg-layer {
		    background-color: rgba(24, 35, 51, 0.53);
		}
		.login_form.pro{
			background: #1513139e;
		}
		.input-container {
		  display: -ms-flexbox; /* IE10 */
		  display: flex;
		  width: 100%;
		  margin-bottom: 2%;
		  
		}
		.icon {
		  padding: 14px;
		  background: dodgerblue;
		  color: white;
		  min-width: 50px;
		  text-align: center;
		}

		.input-field {
		  width: 100%;
		  padding: 10px;
		  outline: none;
		}

		.input-field:focus {
		  border: 2px solid dodgerblue;
		}

		h2.text-center.pro_login_title {
		    margin-bottom: 38px;
		}

		.form-check {
		    text-align: initial;
		    color: white;
		}

		.forgot-pass{

			color: #fff;
			font-size: 18px;
		}
		
		.login_form {
            height: 88%!important;
        }
	</style>
@endsection

@section('content')

<div class="ttm-page-title-row prologin_image text-center">

        <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

        <div class="container">

            <div class="row">

                <div class="col-md-3"></div>
            <div class="col-md-6 ">
               <div class="login_form pro">
                  <h2 class="text-center pro_login_title" >Login to your Pro Account!</h2>
                   @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                  @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif
                  <form method="POST" action="{{route('pro-login-post')}}" name="login" id="login">
                     @csrf
                     <fieldset>
                     	<div style="margin-bottom: 20px;">
                     		<div class="input-container">
						    <i class="fa fa-envelope icon"></i>
						    <input class="input-field" type="text" placeholder="Email" name="email" id="email" value="{{Cookie::get('email')}}">
						    
					 	 </div>
					 	 <label id="email-error" class="error" for="email" style="display: none;color: red;"></label>
                     	</div>
                     	
					 	<div style="margin-bottom: 20px;">
						  <div class="input-container">
						    <i class="fa fa-key icon"></i>
						    <input class="input-field" type="password" placeholder="Password" name="password" id="password" value="{{Cookie::get('password')}}">
						  </div>
						   <label id="password-error" class="error" for="password" style="display: none;color: red;"></label>
						</div>
                        <!-- <div class="form-group">
                           <h5 class="pull-center form-title" style="font-size: 17px;margin-bottom: 11px;">EMAIL</h5>
                           <input type="text" name="email" id="email" class="form-control input-box" placeholder="Email" value="{{Cache::get('email')}}">
                        </div>
                        <div class="form-group">
                           <h5 class="pull-center form-title" style="font-size: 17px;margin-bottom: 11px;">PASSWORD</h5>
                           <input type="password" name="password" id="password" class="form-control input-box" placeholder="Password" value="{{old('password')}}">
                        </div> -->
                        <div class="row">
                           <div class="col-6">
                              <div class="form-group">
                                 <div class="form-check">
                                    <input class="form-check-input" name="remember" id="remember" type="checkbox">
                                    <label class="form-check-label">Remember me</label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-6 text-right">
                              <a href="">Forget password?</a>
                           </div>
                        </div>
                        <div>
                           <input type="submit" class="btn btn-md btn-primary btn-block login" value="LOGIN" style="font-size: 16px;">
                        </div>
                     </fieldset>
                    <div style="margin-top: 5%">
                     	<a href="{{url('forgot-password')}}" class="forgot-pass">I Forgot My Password </a>
                	</div>
                  </form>
                  
                  
               </div>
               <div style="margin-top: 5%">
                     <a href="{{url('pro-register')}}"><button class="btn btn-md btn-block" style="background-color: #fda12b;height: 55px!important;">NEW TO MEINHAUS ? </button></a>
                </div>
            </div>
            <div class="col-md-3"></div>
         </div>

            </div><!-- /.row -->  

        </div><!-- /.container -->                      

</div><!-- page-title end-->












@endsection