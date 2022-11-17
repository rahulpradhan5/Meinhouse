@extends('website.layout.layout')
@section('content')

<div class="site-main" style="padding-top:50px;">
   <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">
      <div class="container">
         <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 card">
               <div class="login_form">
                  <h2 class="text-center pro_login_title" >Reset your password?</h2>
                  
                  <form method="POST" action="{{route('password-reset-post')}}" name="reset-pass" id="reset-pass">
                     @csrf
                     <fieldset>
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
                        <div class="form-group">
                           <h5 class="pull-center form-title" style="font-size: 17px;margin-bottom: 11px;">New Password</h5>
                           <input type="password" name="password" id="password" class="form-control input-box" placeholder="New Password" value="{{Cache::get('email')}}">
                        </div>
                        <div class="form-group">
                           <h5 class="pull-center form-title" style="font-size: 17px;margin-bottom: 11px;">Confirm Password</h5>
                           <input type="password" name="confirm_password" id="confirm_password" class="form-control input-box" placeholder="Confirm Password" value="{{Cache::get('email')}}">
                        </div>
                        <input type="hidden" name="token" id="token" value="{{$token}}">
                        <div>
                           <input type="submit" class="btn btn-md btn-primary btn-block login" value="SUBMIT" style="font-size: 16px;">
                        </div>
                     </fieldset>
                  </form>
                  
                 <!--  <div style="margin-top: 5%">
                     <a href="{{url('userlogin')}}"><button class="btn btn-md btn-block" style="background-color: #fda12b;height: 45px!important;">CANCEL</button></a>
                  </div> -->
               </div>
            </div>
            <div class="col-md-3"></div>
         </div>
      </div>
   </div>
</div>

@endsection