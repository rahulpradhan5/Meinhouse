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

    #images::-webkit-scrollbar {

        width: 4px;

        height: 4px;

    }



    #images::-webkit-scrollbar-track {

        background: rgb(131, 131, 131);

        border-radius: 15px;

    }



    #images::-webkit-scrollbar-thumb {

        background: white;

        border-radius: 10px;

    }



    #images img {

        width: 110px;

        padding-inline: 5px;

        height: 100px;

    }



    figcaption {

        display: none;

    }

    *

{

    margin: 0;

    padding: 0;

    font-family: 'Poppins', sans-serif;

    

}

#quote{

    text-align: left;

    font-size: 44px;

    line-height:1.1px;

    padding-top: 3%;

    color: #fff;

}



@media only screen and (max-width:414px){

    #quote {

        font-size: 25px;

        text-align: start;

    }

 

     ul li{

        font-size: 15px !important;

    }

}

@media only screen and (device-width: 768px) {

    #quote{

        font-size: 30px;

        text-align: start;

    }

    ul li{

        font-size: 16px !important;

    }

}

  @media only screen and (device-width: 820px) {

    #quote{

        font-size: 30px;

        text-align: start;

    }

    ul li{

        font-size: 16px !important;

    }

}

</style>



<body>

    <section style="min-height: 100vh; background-attachment: fixed;">

        <div class="container-lg container-fluid py-3">

            <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">

                <div class="justify-content-center d-flex">

                    <img src="https://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 20rem;" alt=""

                        class="img-fluid my-1">

                </div>



                <div class="OnlineGeneral text-center col-lg-6 col-md-6 col-12  d-flex ml-2" style="margin-left:auto;">

                    <span class="text-center" style="font-weight:600">Online General

                        Contractor </span>

                </div>

            </div>





            <div class="row mt-4">

                <div class="col-lg-6 col-md-6 col-12">

                    <div class="text-white" >

                     

                            <h1 class="my-4"  ><strong id="quote" >We just need to know a couple of

                                details & we'll get you started right away!</strong></h1>

                      <div class="py-lg-5 py-4" style="font-size: 29px;font-weight:600; padding-inline: 5px;">

                           <div> You'll receive an accurate and customizable quote to your email</div>

                         

                                

                        </div>

                        </div>

                    </div>

             

                <div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4">

                    <div class="px-3 py-4"

                        style="background: rgb(211 211 211 / 22%); border-radius: 20px;box-shadow: 0px 0px 2px 1px #b5b3b3;">

                        <form method="post" action="{{route('user_landing_Second_Step_Post')}}" enctype="multipart/form-data">

                          

                            @csrf



                            @if (count($errors) > 0)



                            <div class="alert alert-danger" style="margin-top:-15%;">

        

                                <strong>Whoops!</strong> There were some problems with your input.

        

                            </div>

        

                        @endif

                            <input type="text" name="name" class="form-control mb-3"

                                placeholder="Give your project a Name (i.e Bathroom reno)"  required/>

                                @error('name')

                                <span style="color:red;">*{{$message}}</span>

                                @enderror

                            <textarea type="text" rows="3"  name="desc"class="form-control mb-3"

                                placeholder="Describe your project" required></textarea>

                                @error('desc')

                                <span style="color:red;">*{{$message}}</span>

                                @enderror

                            <select type="text" class="form-control mb-3" name="time" style="cursor: pointer;"required>

                                <option disabled selected hidden>When would you like to have this done ?</option>

                                <option value="ASAP">ASAP !</option>

                                <option value="Less than 1 week">Less than 1 week</option>

                                <option value="Less than 1 Month">Less than 1 Month</option>

                            </select>

                            @error('time')

                            <span style="color:red;">*{{$message}}</span>

                            @enderror

                            <div class="text-white mt-4">

                                <div class="text-white">Where is the project ?</div>

                                <div class="d-flex">

                                    <div class="text-white">Please provide exact project address details.</div>

                                    <input type="checkbox" class="form-check text-white"

                                        style="margin-left:auto;width: 15px; color:white; " />&nbsp; <span class="text-white">Condo Building ?</span>

                                </div>

                                <div class="row mt-2">

                                    <div class="col-lg-6 col-sm-6 col-12">

                                        <input type="text" class="form-control mb-3" name="address" placeholder="Street Address"required />

                                        @error('address')

                                        <span style="color:red;">*{{$message}}</span>

                                        @enderror

                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">

                                        <input type="text" class="form-control mb-3"  name="city"placeholder="City / Municipality" required/>

                                        @error('city')

                                        <span style="color:red;">*{{$message}}</span>

                                        @enderror

                                    </div>

                                </div>

                                <div class="text-white">

                                    <div class="text-white">Upload clear photos of project Area !</div>

                                    <div class="mt-2 d-flex">

                                        <div class="" style="position: relative;cursor: pointer; min-width: 110px;">

                                            <input type="file" name="images[]"  id="file-input" onchange="preview()"

                                                style="height: 100px;max-width:112px;opacity:0;position:absolute;z-index:1"

                                                multiple accept="image/png, image/gif, image/jpeg" required  />

                                                @error('image')

                                                <span style="color:red;">*{{$message}}</span>

                                                @enderror

                                            <label

                                                class="bg-white fa fa-plus text-dark align-items-center d-flex justify-content-center"

                                                style="max-width:112px"></label>

                                        </div>

                                        <div id="images" class="d-flex" style="overflow-x: scroll;margin-left: 5px;">

                                        </div>

                                    </div>

                                    <p id="numF" class="text-warning" style="font-weight: 500;">*You can select multiple

                                        images</p>

                                </div>



                                <button type="submit" class="mt-4 btn btn-primary">Submit</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @include('user_landing.footer')

    </section>

    <script>

        let fileInput = document.getElementById("file-input");

        let imageContainer = document.getElementById("images");

        let num = document.getElementById("numF");

        function preview() {

            imageContainer.innerHTML = "";

            num.textContent = `uploaded item: ${fileInput.files.length}`;

            for (i of fileInput.files) {

                let reader = new FileReader();

                let figure = document.createElement("figure");

                let figCap = document.createElement("figcaption");

                // figCap.innerText = i.name;

                figure.appendChild(figCap);

                reader.onload = () => {

                    let img = document.createElement("img");

                    img.setAttribute("src", reader.result);

                    figure.insertBefore(img, figCap);

                }

                imageContainer.appendChild(figure);

                reader.readAsDataURL(i);



            }

        }

        // const image_input = document.querySelector("#image_input");

        // var uploaded_image = "";



        // image_input.addEventListener("change", function () {

        //     //   console.log(image_input.value);

        //     const reader = new FileReader();

        //     reader.addEventListener("load", () => {

        //         uploaded_image = reader.result;

        //         document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;

        //         document.querySelector("#display_image1").style.backgroundImage = `url(${uploaded_image})`;

        //         document.querySelector("#display_image2").style.backgroundImage = `url(${uploaded_image})`;



        //     })

        //     reader.readAsDataURL(this.files[0])

        // });

    </script>

    

    

</body>



</html>