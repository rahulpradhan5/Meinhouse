@extends('website.layout.layout')
@section('content')

<div class="site-main" style="margin-top: 50px;">
   <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">
      <div class="container">
         <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 card">
               <div class="login_form">
                  <h2 class="text-center pro_login_title" >Forgot your password?</h2>
                  
                  <form method="POST" action="{{route('forget-sendmail-proff')}}" name="login" id="login">
                     @csrf
                     <fieldset>
                      <p>Please enter in the email address that you use to sign in to MeinHaus and we'll send you instructions on how to reset your password.</p>
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
                           <h5 class="pull-center form-title" style="font-size: 17px;margin-bottom: 11px;">EMAIL</h5>
                           <input type="text" name="email" id="email" class="form-control input-box" placeholder="Email" value="{{Cache::get('email')}}">
                        </div>
                        <div>
                           <input type="submit" class="btn btn-md btn-primary btn-block login" value="SUBMIT" style="font-size: 16px;">
                        </div>
                     </fieldset>
                  </form>
                  
                  <div style="margin-top: 5%">
                     <a href="{{url()->previous()}}"><button class="btn btn-md btn-block" style="background-color: #fda12b;height: 45px!important;">CANCEL</button></a>
                  </div>
               </div>
            </div>
            <div class="col-md-3"></div>
         </div>
      </div>
   </div>
</div>

@endsection