<!DOCTYPE html>

<html lang="en">

<head>

  <title>User Project Details</title>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
      .OnlineGeneral {
        font-size: 37px;
        margin-left: auto;
        color: #f7aa1b;
        padding-bottom: 5px;
    }

    @media(min-width:990px) {
        .container {
            width: 800px;
        }
    }
</style>
</head>


    <body>
        <div class="modal" tabindex="-1" role="dialog" id="imagepreview">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Image preview</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="ekko-lightbox-container">
                        <div class="ekko-lightbox-item fade"></div>
                        <div class="ekko-lightbox-item fade in show">
                            <img class="img-fluid" id="imgViewer" style="width: 150%; height:70%">
                        </div>
                        <div class="ekko-lightbox-nav-overlay">
                            <a href="#">
                                <span></span></a><a href="#"><span></span></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer hide" style="display: none;">&nbsp;</div>
            </div>
        </div>
    </div>
<section class="">
        <div class="d-lg-flex d-md-flex d-sm-flex align-items-center py-3 px-5" style="box-shadow:0px 3px 3px -2px silver">
            <div class="justify-content-center d-flex">
                <img src="http://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 20rem;" alt=""
                    class="img-fluid my-1">
            </div>

            <div class="OnlineGeneral mt-lg-5 mt-md-5 text-center">
                <span class="text-center mb-4">Online General
                    Contractor </span>
            </div>
        </div>

        <div class="my-5 container-lg container-fluid mx-auto">
            <div class="p-3 container"
                style="background: #eeeeee85;border-radius: 20px;box-shadow: 0px 0px 2px 1px silver;height: fit-content;">
                @if(session()->has('success'))
                    <div class="alert alert-success py-4 my-5">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="" style="font-weight: 500;font-size: 25px;">Project Details:</div>

                <div class="">
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">User Name:</div>
                        <div style="margin-left:auto;font-weight: 500;">{{ $userData->name }}</div>
                    </div>
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">Phone:</div>
                        <div style="margin-left:auto;font-weight: 500;">{{ $userData->contact }}</div>
                    </div>
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">Email:</div>
                        <div style="margin-left:auto;font-weight: 500;word-break: break-all;">{{ $userData->email }}</div>
                    </div>
                    
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">Date of submission:</div>
                        <div style="margin-left:auto;font-weight: 500; text-align: justify;">{{Carbon\Carbon::parse($userData->created_at)->format('d M Y')}}</div>
                    </div>
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">Project Name:</div>
                        <div style="margin-left:auto;font-weight: 500; text-align: justify;">{{$ProjectDetails->Name}}</div>
                    </div>
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">Project Description:</div>
                        <div style="margin-left:auto;font-weight: 500; text-align: justify;">{{$ProjectDetails->description}}</div>
                    </div>
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">City:</div>
                        <div style="margin-left:auto;font-weight: 500; text-align: justify;">{{$ProjectDetails->city}}</div>
                    </div>
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">Address:</div>
                        <div style="margin-left:auto;font-weight: 500; text-align: justify;">{{$ProjectDetails->Address}}</div>
                    </div>
                    <div class="d-flex my-4">
                        <div style="padding-right:50px;font-weight: 500;color:black">Project Time Limit:</div>
                        <div style="margin-left:auto;font-weight: 500; text-align: justify;">{{$ProjectDetails->Time}}</div>
                    </div>
                </div>

                <div class="">
                    <div class="" style="padding-right:50px;font-weight: 500;color:black">Images</div>
                    <div class="row mt-2">
                       
                        
                         @foreach($Images as $key=>$value)
                 <div class="col-lg-4 col-md-4 col-12">
                            <a href="#" data-bs-toggle="modal" onclick="preview(this); return false;"
                                data-id='{{url("public/User_data_uploads/$value")}}'
                                data-bs-target="#imagepreview" data-gallery="gallery">
                                <img src="{{asset('public/User_data_uploads')}}/{{$value}}"
                                    class="img-fluid my-3 p-2"
                                    style="border-radius:15px;height: 200px;width: 100%;box-shadow: 1px 1px 2px 1px silver;" />
                            </a>
                        </div>
                   
                    @endforeach
                    </div>
                </div>
                @if($userData->est_status==0)
                <div class="text-center mt-5 mb-3">
                    <a href="{{ url("admin/convertEstimate/$userData->id") }}" class="btn btn-info text-white">Convert Into Estimate</a>
                </div>
                @else
                <div class="text-center mt-5 mb-3">
                    <button disabled class="btn btn-secondary text-white">Estimate Converted!</button>
                </div>
                @endif
            </div>

        </div>
        
    </section>
     <div class="mt-5" style='background-color: #182434;'>
        <div class='row pt-4 gx-0' style='align-content: center;display: flex;padding: 10px 50px;padding-bottom: 50px;'>
            <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-5" style="margin-right: auto;">
                <h2 class="text mb-3" style="color: #fff; font-family:sans-serif;text-align: center;font-size: 25px;">
                    Contact Us
                </h2>
                <div style="justify-content: center;display: flex;">
                    <div>
                        <p style="margin: 0px;color: #fff;font-family:sans-serif"><strong>Phone :</strong>
                            1(844) 777-HAUS (4287)</p>
                        <p style="margin: 0px;color: #fff;font-family:sans-serif"><strong>Email :</strong>
                            info@meinhaus.ca</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-5" style="margin-inline: auto;">
                <div style='text-align: center;'>
                    <h2 class="text mb-3" style="color: #fff;font-family:sans-serif;font-size: 25px;">Follow Us On:</h2>
                    <a href="https://www.facebook.com/meinhausservices" style="color: #a8a7a7;" target="_blank"><i
                            class="fa-lg fa fa-facebook"></i></a>
                    <a href="https://www.linkedin.com/company/mein-haus-services"
                        style="color: #a8a7a7;margin-left:10px;" target="_blank"><i
                            class="fa-lg fa fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/meinhausapp/?utm_medium=copy_link"
                        style="color: #a8a7a7;margin-left:10px;" target="_blank"><i
                            class="fa-lg fa fa-instagram"></i></a>
                    <a href="https://www.pinterest.com/meinhausservices/" style="color: #a8a7a7;margin-left:10px;"
                        target="_blank"><i class="fa-lg fa fa-pinterest"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-12" style='text-align: center;margin-left: auto;'>
                <h2 class="text mb-3" style="color: #fff;font-family:sans-serif;font-size: 25px;margin-bottom: 5px;">
                    Download the app</h2>
                <a href="https://apps.apple.com/ca/app/mein-haus-professional/id1556987330">
                    <img src="http://meinhaus.ca/public/image/app.png" width="115px" height="45px">
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US"
                    style="margin-left:10px">
                    <img src="http://meinhaus.ca/public/image/googleplay.png" width="115px" height="45px"></i>
                </a>
            </div>
        </div>
        <hr style="padding: 0;margin:0;color: white;height: 2px;">
        <div class="" style="color: #a8a7a7;justify-content:center;display:flex;padding: 20px 0px;">
            <div style="text-align: center;">
                <div>Developed By <span style="color: white;">QuantumIT</span></div>
                <div style="margin-top: 5px;">Copyright © 2020 <span style="color: white;">MeinHaus.</span> All
                    rights reserved. </div>
            </div>
        </div>
    </div>
    </body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
  
  
    function preview(e){
        //console.log(1);
    var id = e.getAttribute('data-id');
    var image_id= e.getAttribute('data-image');
     console.log(id);
    document.getElementById('imgViewer').src=id;
    //document.getElementById('delete').href=`https://meinhaus.ca/pro/images/delete/${image_id}`;
   
    //document.getElementById('viewImg').style.display='block';


}
</script>