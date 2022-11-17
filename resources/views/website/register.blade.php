@extends('website.layout.layout')

@section('content')
 <div class=" position-relative"
            style="background-image: url('https://meinhaus.ca/public/pro_landing_assets/img/login-bg.jpg');height: auto;">
            <div class="position-absolute logoM" style="z-index: 101;padding: 20px 40px;">
                <a class="home-link position-relative" href="https://meinhaus.ca" title="MeinHaus" rel="home">
                    <img id="logo-img" class="img-center" src="http://meinhaus.ca/public/theme/images/logo-img.png"
                        alt="logo-img" style="width: 250px;">
                </a>
            </div>
            <div class="px-2" style="padding-top: 130px;background-color: rgba(24, 35, 51, 0.53);">
                <div class="pro_user_form">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 card" style="background: #1513139e;">
                                <div class="login_form bg-transparent">
                                    <h2 class="text-center pro_login_title" style="margin-bottom: 5%;">CREATE YOUR
                                        ACCOUNT TO
                                        GET STARTED</h2>
                                   <form method="POST" action="{{route('user_register')}}">
                     @csrf 
                     @if(\Session::has('success'))
                        <div class="alert alert-success">
                           {{\Session::get('success')}}
                        </div>
                     @endif
                     {!! session()->get('error') !!}
                     @if(Session::has('message'))
                        <p    class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                     @endif  
                     @if ($errors->any())
                        <div class="alert alert-danger">
                           <ul>
                                 @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                 @endforeach
                           </ul>
                        </div>
                     @endif
                      <div class="row">
                            <div class="col-6">
                               <div class="form-group">
                                  <h5 class="pull-center form-title text-white" >FIRST NAME</h5>
                                  <input type="text" name="first_name" id="first_name"  onkeypress="return /[a-z]/i.test(event.key)"  class="form-control input-box" placeholder="First Name" required>
                               </div>
                            </div>
                            <div class="col-6 text-left">
                               <div class="form-group">
                                  <h5 class="pull-center form-title text-white" >LAST NAME</h5>
                                  <input type="text" name="last_name" id="last_name" onkeypress="return /[a-z]/i.test(event.key)"  class="form-control input-box" placeholder="Last Name" required>
                               </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-6">
                               <div class="form-group">
                                  <h5 class="pull-center form-title text-white" >EMAIL</h5>
                                  <input type="email" name="email" id="email"  class="form-control input-box" placeholder="Email" required>
                               </div>
                            </div>
                            <div class="col-6 text-left">
                               <div class="form-group">
                                  <h5 class="pull-center form-title text-white" >PHONE NUMBER</h5>
                                  <input type="text" name="phone_no" id="phone_no" onkeypress="if(event.which < 48 || event.which > 57 ) if(event.which != 8) return false;" class="form-control input-box" placeholder="Phone Number" required>
                               </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-6">
                               <div class="form-group">
                                  <h5 class="pull-center form-title text-white" >PASSWORD</h5>
                                  <input type="password" name="password" id="password" class="form-control input-box" placeholder="Password" required>
                               </div>
                            </div>
                            <div class="col-6 text-left">
                               <div class="form-group">
                                  <h5 class="pull-center form-title text-white" >CONFIRM PASSWORD</h5>
                                  <input type="password" name="confirm_password" id="confirm_password" class="form-control input-box" placeholder="Confirm Password" required>
                               </div>
                            </div>
                         </div>

                         <div class="form-group">
                                  <div class="form-check">
                                     <input class="form-check-input" name="terms" id="terms" required type="checkbox">
                                     <label class="form-check-label">By signing up with MeinHaus, you are agreeing to Meinhaus <a class="text-primary" href="{{url('terms')}}"><u> Terms and Conditions<u></a></label>
                                  </div>
                                  <label style="color: red;">
                                  <label id="terms-error" class="error" for="terms" style="display: inline-block;"></label></label>
                               </div>
                         <div>
                            <input type="submit" class="btn btn-md btn-primary btn-block" value="SIGN UP">
                         </div>
                
                   </form>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
