



@extends('professional.layout.layout')

@section('head_title','PROFILE')

@section('content')





<style type="text/css">



    .label-danger {



        background-color: #d9534f;



    }





.upload-area p {

    margin-bottom: 30px;

    margin-top: 30px;

    font-size: 20px;

    font-weight: 600;

    color: #2580e8;

}

.upload-area i {

    color: #1e80e8;

    font-size: 50px;

}

.upload-area button {

    padding: 8px 16px;

    min-width: 150px;

    font-size: 16px;

    font-weight: 600;

    color: #fff;

    background-color: #1e80e8;

    border: 2px solid #1e80e8;

    border-radius: 50px;

    transition: 0.3s;

}

.file-upload-contain .file-drop-zone {

    border: 2px dashed #1e80e8;

    transition: 0.3s;

    margin: 0;

    padding: 0;

    border-radius: 20px;

    background-color: #f1f8fe;

    min-height: auto;

}

.file-preview .clickable {

    cursor: pointer;

}

    .card-primary:not(.card-outline) .card-header {



        background-color: #17a2b8;



    }



    .photos{

      width:30%;

      margin:0.5%;

    }



    .label {



        display: inline;



        padding: .2em .6em .3em;



        font-size: 75%;



        font-weight: 700;



        line-height: 1;



        color: #fff;



        text-align: center;



        white-space: nowrap;



        vertical-align: baseline;



        border-radius: .25em;



    }

.profile-back img {



    height: 32rem;

  

}







    .label-success {



        background-color: #5cb85c;



    }







    .pt-0 {



     



       margin-top: 16px !important;



    }



    .card {



      margin-bottom: 1.875rem;



      background-color: #fff;



      transition: all .5s ease-in-out;



      position: relative;



      border: 0rem solid transparent;



      border-radius: 1.25rem;



      box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgba(82, 63x, 105, 0.05);



      height: auto;



      }

.upload label {

    height: 4.313rem;

    width: 4.313rem;

    border-radius: 4.313rem;

    background: rgba(255, 255, 255, 0.2);

    display: block;

    text-align: center;

    line-height: 4.313rem;

    font-size: 2rem;

    color: #fff;

}

</style>



      

				<div class="row">

					<div class="col-xl-12">

						<div class="profile-back">

							<img src="https://meinhaus.ca/public/pro_landing_assets/img/pexels-binyamin-mellish-186077.jpg" alt="">

							<div class="social-btn">

								<a href="{{url('pro/proff-customer-reviews')}}" class="btn btn-light social"> {{$reviews}} Reviews</a>

								<a href="{{url('pro/proff-customer-reviews')}}" class="btn btn-light social">{{round($review_avg,1)}}<i class="fa fa-star"></i></a>

								<!-- <a href="{{url('pro/edit-profile')}}" class="btn btn-primary">Update profile</a> -->

							</div>

						</div>

						<!---div class="profile-pic d-flex">

						    

						    

						   

						

							<div class="profile-info2 text-tr">

								<h2 class="mb-0 text-capitalize">{{$details->name}}</h2>

								<h4>{{$pro_details->company_name}}</h4>

								<span class="d-block"><i class="fas fa-envelope me-2"></i>{{$details->email}}</span>

							</div>

						</div--->

					</div>

				

					</div>

					

					<br>

					<br>

				

		<div class="card mt-3">

		    <div class="card-header border-0">

										<h4 class="fs-40 font-w600 text-capitalize" style="font-size:30px;">{{$details->name}}</h4>

									</div>

		    	<div class="mx-2">

                        <div>

                            <div class="row m-5">



                                    <div class="col-lg-4 col-md-6 col-sm-12">



                                        <div>



                                            <div class="" style="width:50%; height:50%;">

                                                 @if($details->user_image!=NULL)

                          <img alt="profile pic" class="rounded" src="{{url('public/upload/pro_profile/'.$details->user_image) }}"

                       >

                          @else

                          <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="">

                          @endif

                                            </div>

                                            

                                        </div>



                                        <div>

                                            <p class="h4"><b>Profile picture</b></p>

                                            <p><em>Use a selfie or a business logo</em></p>

                                        </div>



                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">



                                        <div class="row">

                                            <div class="col">



                                                <form action="{{route('pro_profile_update')}}" method="post">

									        @csrf

									 <div class="form-group row mb-2 mt-2">

                                            <label for="text" class="col-sm-12 col-form-label" style="font-size:15px;"><b>Legal Name:</b></label>

                                            <div class="col-sm-12">

                                               <input type="text" class="form-control" id="name" name="pro_name" value="{{$details->name}}">

                                            </div>

                                         </div>

                                         <div class="form-group row mb-2 mt-2">

                                            <label for="text" class="col-sm-12 col-form-label" style="font-size:15px;"><b>Nickname(optional):</b></label>

                                            <div class="col-sm-12">

                                               <input type="text" class="form-control" placeholder="enter nickname" id="nickname" name="nickname" value="{{$pro_details->nickname}}">

                                            </div>

                                         </div>

                                         <div class="form-group row mb-2 mt-2">

                                            <label for="text" class="col-sm-12 col-form-label"  style="font-size:15px;"><b>Business or Home Address:</b></label>

                                            <div class="col-sm-12">

                                               <input type="text" class="form-control" id="name" name="business_address" value="{{$pro_details->business_address}}">

                                            </div>

                                         </div>

                                         <div class="form-group row mb-2 mt-2 ">

                                            <label for="text" class="col-sm-12 col-form-label"  style="font-size:15px;"> <b>Business Name:</b></label>

                                            <div class="col-sm-12">

                                               <input type="text" class="form-control" id="name" name="company_name" value="{{$pro_details->company_name}}">

                                            </div>

                                            </div>

										

									</div>

									

                                            <!-- <div class="col">

                                               <p class="mb-4"></p>

                                               <p class="mb-4"></p>

                                               <p class="mb-4"></p>

                                               <p class="mb-4"></p>



                                            </div> -->

  

                                            

                                        </div>



                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">



                                        <div>

                                            <p class="h3"style="font-weight:700;">Registered Services:</p>

                                            <p>

                                                </p><ul>

                                                    

                                                      @forelse($skills->splice(0,10) as $key=>$ser)

	                                              

	                                              <?php $name=DB::table('services')->where('id',$ser)->pluck('name') ?>

	                                              <li style="font-size:13px;font-weight:500" class="py-2">{{$key+1}}. {{$name[0]}}</li>									    

										    

										    

										       @empty

										       <b> No services to show</b>

										    @endforelse

                                                   

                                                  

                                                    

                                                </ul>



                                            <p></p>

                                            <a href="{{url('pro/proff-business')}}" class="h4 text-blue" style="margin-inline:20%;">Add more Services</a>

                                        </div>

                                        

                                    </div>



                            </div>



                            <div class="row">



                                <div class="col-lg-4 col-md-6 col-sm-12">



                                    <div>

                                          <label for="profile-image" class="mx-4"width="300px;" ><img id="preview" class=" w-full h-full object-cover mx-3 rounded"style=" display:none;cursor:pointer;height:200px;width:300px;" ></label>

                                        <div style="border: 2px dashed #1e80e8; border-radius: 20px;

    background-color: #f1f8fe; margin:6px; padding:6px;" class="mx-5" id="img-select-box" >



                                            <div >

                                              

                                   <div class="file-upload-contain file-drop-zone clickable" tabindex="-1"><div class="file-drop-zone-title"><div class="upload-area"><center ><label for="profile-image" style="cursor:pointer"><i class="far fa-images mt-2"></i></center><p class="text-center " id="img-label">Browse .jpg,.png, .gif</p> <div>  </div></div></div>

 

    </div><input type="file" style="display:none;" id="profile-image" accept="image/png, image/gif, image/jpeg"/>

                                            </div>

                                            

                                        </div>

                                        <div style="text-align: center;" class="p-5">

                                            <p><b><em>Share some of your best work. For new accounts,

                                                 special consideration is given to pro's with quality photos.</em></b></p>

                                        </div>

                                    </div>



                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">



                                 <div class="">

								

									<div class="card-body">

									     <div class="form-group row mb-2 mt-2">

									    

                                            <label for="text" class="col-sm-12 col-form-label" style="font-size:15px;"><b>How many years of experience you have?</b></label>

                                            <div class="col-sm-12">

                                               <input type="text" class="form-control" id="name" name="experience" value="{{$pro_details->experience}}">

                                            </div>

                                         </div>

                                         <div class="form-group row mb-2 mt-2">

                                            <label for="text" class="col-sm-12 col-form-label"  style="font-size:15px;"><b>Slogan or catch-phrase for your business:</b></label>

                                            <div class="col-sm-12">

                                               <textarea  class="form-control"  id="name"  name="slogan" style="height: 65px;">{{$pro_details->slogan}}</textarea>

                                            </div>

                                         </div>

                                         <div class="form-group row mb-2 mt-2">

                                            <label for="text" class="col-sm-12 col-form-label"  style="font-size:15px;"><b>Tell us anything else about your work:</b></label>

                                            <div class="col-sm-12">

                                               <textarea  class="form-control" id="name" name="work_desc" style="height: 72px;" >{{$pro_details->work_desc}}</textarea>

                                            </div>

                                         </div>

                                       

									    </div>

									 

									</div>



                                </div>

                        



                                <div class="col-lg-4 col-md-6 col-sm-12 mt-4">



                                    <p class="h5 text-red">

                                        Required for active profile

                                    </p>



                                    <div>

                                        <a class="btn bg-blue text-white" href="{{url('pro/proff-documents')}}">Documents &amp; banking</a>

                                    </div>



                                </div>



                            </div>



                        </div>

                    </div>

                        <div class="card-footer d-flex justify-content-end">

                                      	<button  type="submit" class="btn btn-xs btn-primary float-end">

                                      	    Update

                                      	</button>

                                      

									</div>

									        </form>

		</div>

     @section('script')

     <script>

         

let imglabel=document.getElementById('img-label');

let img=document.getElementById('profile-image');

let box=document.getElementById('img-select-box');

img.addEventListener('change', function(event){

   console.log(box);

    if (event.target.files.length>0) {

    let src =URL.createObjectURL(event.target.files[0]);

    let preview=document.getElementById('preview');

    preview.src=src;

    preview.style.display="block"

    box.style.display="none";

imglabel.style.display="none";

    }

})

     </script>

     @endsection

    @endsection

    

