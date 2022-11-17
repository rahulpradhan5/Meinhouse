<?php
$str=$data->name;
$name=(explode(" ",$str));
$first=$name[0];
$last=$name[1];

?>
<!DOCTYPE html>

<html lang="en">

<head>

  <title>MeinHaus - Account Setup</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

    body {
        background-image:linear-gradient(rgba(0, 0, 0, 0.48), rgba(0, 0, 0, 0.48)),url('{{url('public/pro_landing_assets/img/pexels-binyamin-mellish-186077.jpg')}}');
   
        height: 100vh;
        background-attachment: fixed;
        background-size: cover;
    }
.OnlineGeneral {
        font-size: 34px;
        margin-left: auto;
        color: orange;
        margin-top: 38px;
    }
     label {
        color: white;
        font-weight: 500;
    }

    input {
        height: 45px;
    }

    *
{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  
}
  .btn-primary {
        transition: 0.7s;
        height: 45px;
        box-shadow: 1px 1px 2px 1px #7d7d7d
    }

    .btn-primary:hover {
        background-color: orange !important;
        border: orange !important;
    }
     .terms:hover {
        color: #0d6efd !important;
        
    }
    .OnlineGeneral {
        font-size: 37px;
        margin-left: auto;
        color: #ffc107;
        margin-top: 38px;
    }

</style>

<body>
<body>
    <section style="min-height: 100vh; background-attachment: fixed;">
        <div class="container-lg container-fluid py-3">
            <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                <div class="justify-content-center d-flex">
                    <a href="{{url('/')}}"><img src="https://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 20rem;" alt=""
                        class="img-fluid my-1"></a>
                </div>

                <div class="OnlineGeneral text-center" style="margin-left:auto;">
                    <span class="text-center"style="font-weight:550">Online General
                        Contractor </span>
                </div>
            </div>


            <div class="p-lg-5 p-md-4 p-3 my-5"
                style="background: rgb(211 211 211 / 22%); border-radius: 20px;box-shadow: 0px 0px 2px 1px #b5b3b3;">
                <div class="text-white text-center" style="font-size:2.5rem;font-weight:700">SETUP YOUR  ACCOUNT PASSWORD
                    </div>
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
                    <div class="row mt-5">
                        <div class="">
                            <!---label>FIRST NAME:</label--->
                            <input type="hidden" class="form-control" placeholder="First Name"  name="first_name" value="{{$first}}" required  readonly />
                        </div>
                        <div class="">
                            <!---label>LAST NAME:</label--->
                            <input type="hidden" class="form-control" placeholder="Last Name" name="last_name" value="{{$last}}"  required  readonly />
                        </div>
                        <div class="">
                            <!---label>EMAIL:</label---->
                            <input type="hidden" class="form-control" placeholder="Email" name="email" value={{$data->email}} required readonly />
                        </div>
                        <div class="">
                            <!---label>PHONE NUMBER:</label---->
                            <input type="hidden" class="form-control" placeholder="Phone Number"name="phone_no"  value={{$data->contact}} required  readonly />
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-3">
                            <label>PASSWORD:</label>
                            <input type="password" class="form-control" placeholder="Password"  name="password" required />
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-3">
                            <label>CONFIRM PASSWORD:</label>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required />
                        </div>
                    </div>
                    <div>
                        <button type="submit"  style="float:right"class="btn btn-primary w-25  rounded-2 mb-5 mt-1 p-2">SIGN UP</button>
                      
                    <div class="d-flex align-items-center text-white">
                        <input type="checkbox" class="form-check" style="width: 15px;" required />&nbsp;
                        <span>By signing
                            up with
                            MeinHaus, you are agreeing to MeinHaus&nbsp; </span>
                        <a href="http://meinhausca.com/public/termsandconditions" class="terms" style="font-weight: 500; color:#fff; text-decoration:none; ">Terms
                            and
                            Conditions</a>
                    </div>
                    </div>
                   
                </form>
            </div>
        </div>
        </div>
    </section>
</body>
 
</body>

</html>