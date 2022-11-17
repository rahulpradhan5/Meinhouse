@extends('website.layouts.master')
@section('content')

<div class="site-main" style="margin-top: 153px;">
   <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">
      <div class="container">
         <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 card">
               <div class="login_form">
                  <h2 class="text-center pro_login_title" >Login</h2>
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

                  <form method="POST" action="{{route('login-post')}}" name="login" id="login">
                     @csrf
                     <fieldset>
                        <div class="form-group">
                           <h5 class="pull-center form-title" style="font-size: 17px;margin-bottom: 11px;">EMAIL</h5>
                           <input type="text" name="email" id="email" class="form-control input-box" placeholder="Email" value="{{Cookie::get('email')}}">
                        </div>
                        <div class="form-group">
                           <h5 class="pull-center form-title" style="font-size: 17px;margin-bottom: 11px;">PASSWORD</h5>
                           <input type="password" name="password" id="password" class="form-control input-box" placeholder="Password" value="{{Cookie::get('password')}}">
                        </div>
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
                              <a href="{{url('forgot-password')}}">Forget password?</a>
                           </div>
                        </div>
                        <div>
                           <input type="submit" class="btn btn-md btn-primary btn-block login" value="LOGIN" style="font-size: 16px;">
                        </div>
                     </fieldset>
                  </form>
                  
                  <div style="margin-top: 5%">
                     <a href="{{url('user/register')}}"><button class="btn btn-md btn-block" style="background-color: #fda12b;height: 45px!important;">NEW TO MEINHAUS ? </button></a>
                  </div>
               </div>
            </div>
            <div class="col-md-3"></div>
         </div>
      </div>
   </div>
</div>

@endsection