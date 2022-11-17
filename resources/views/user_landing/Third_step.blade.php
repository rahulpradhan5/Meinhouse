<!DOCTYPE html>

<html lang="en">

<head>

  <title>MeinHaus - User Landing</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="style.css">
 <link  rel="shortcut icon" type="image/png" href="https://meinhausca.com/public/theme/images/favi.png" sizes="32x32">
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
        height: 100px;
        width: 100%;
    }
    *
{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    
}
#text{
        font-size: 24px !important;font-weight: 700; margin-left: auto;
        color:#fff;
    }
@media only screen and (max-width:414px){
    #text{
        font-size: 14px !important;
     
    }
}
@media only screen and (device-width: 768px) {
    #text{
        font-size: 16px !important;
     
    }
}
  @media only screen and (device-width: 820px) {
    #text{
        font-size: 16px !important;
     
    }
  
    }
   
</style>



    <body>
         <section style="min-height: 100vh; background-attachment: fixed;">
        <div class="container-lg container-fluid py-3">
            <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                <div class="justify-content-center d-flex">
                    <img src="http://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 20rem;" alt=""
                        class="img-fluid my-1">
                </div>

                <div class="OnlineGeneral text-center" style="margin-left:auto;">
                    <span style="font-weight:550">Online General
                        Contractor </span>
                </div>
            </div>

            <div class="text-white" style="text-align: justify;">
                <div class="my-4" style="font-size: 24px;font-weight: 500;">
                    You will be receiving an E-mail (and text Message !) from us shortly ! Please click link,
                    read the details of your estimate carefully .
                </div>
                <div class="my-4" style="font-size: 24px;font-weight: 500;">
                    You can book your project by following the link inside the email, and following the next few simple
                    steps. We can get almost any project done, right away !
                </div>


            </div> 
            <div class="row mt-5" style="font-weight: 500;">
                <div class="col-lg-8 col-md-7 col-12 mt-lg-0 mt-md-0 mt-4">
                    <div class="" style="color: orange;font-size:26px;font-weight: 700;">Online General Contractor</div>
                    <div class="text-white" style="text-align: justify; font-size: 24px;">
                        Our estimates include labor, and supplying the construction material. We ask client to have
                        their homes ready for work, and have the finishing readily available.
                    </div>
                    <div class="mt-3" style="color: orange;text-align: justify;font-size: 24px;"><a href="">CLICK HERE</a> for our guide on the best way to get home improvement goods in your area !</div>
                </div>
                <div class="col-lg-4 col-md-5 col-12 mt-lg-0 mt-md-0 mt-4 justify-content-center d-flex align-items-center">
                    <div class="px-3 py-3 text-white text-center"
                        style="background: rgb(211 211 211 / 22%); border-radius: 20px;box-shadow: 0px 0px 2px 1px #b5b3b3; width: fit-content;height: fit-content;">
                        <div class="" style="font-size: 22px;">Complete your Account Now !</div>
                        <div class="mt-4" style="font-size: 16px;">This will help us serve you quicker and better</div>
                        <div class="text-center"><div class="btn btn-primary mt-4"><a class="text-white" style="text-decoration:none" href="{{route('user_landing_AccountSetup')}}">Account Setup</a></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    @include('user_landing.footer')
    </body>

</html>