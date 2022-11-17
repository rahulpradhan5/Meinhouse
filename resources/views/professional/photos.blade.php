@extends('professional.layout.layout')
@section('head_title','PHOTOS')
@section('content')
 <div  class="modal"  tabindex="-1" role="dialog" id="imagepreview">
    <div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Image preview</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="ekko-lightbox-container" >
        <div class="ekko-lightbox-item fade"></div><div class="ekko-lightbox-item fade in show">
            <img  class="img-fluid" id="imgViewer" style="width: 150%; height:70%">
        </div><div class="ekko-lightbox-nav-overlay">
            <a href="#">
                <span></span></a><a href="#"><span></span></a></div></div></div>
                <div class="modal-footer">
        
         <button type="submit" class="btn btn-danger" style="float:right;" > <a  id="delete"class="text-white" href="#">
             
            <i class="fa fa-trash"></i> Delete</a></button>
      </div>
            </div>
        </div>
    </div>
    
   <div class="row">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Photos</h3>
            <button  class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"  style="float:right;"> <i class="fa fa-plus"></i> Add new</button>
         </div>
          @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
         <!-- /.card-header -->
         <!-- form start -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('proff-images-post') }}" id="update-profile" name="update-profile" enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" class="form control" multiple required accept="image/png, image/gif, image/jpeg"/>
            
            
      </div>
      <div class="modal-footer">
        
         <button type="submit" class="btn btn-info" style="float:right;">Add new</button>
      </div>
      </form>
    </div>
  </div>
</div>
 
         
            <div class="card-body row">

         <div class="">
                   
                    <div class="row mt-3">
                      
                                          
                       
                                               @if(count($data))
                                                @foreach($data as $key=>$value)
                        
                       
                                                <div class="col-lg-4 col-md-4 col-12 mb-2 p-2">
                                                    <a href="#" data-bs-toggle="modal" onclick="preview(this); return false;" data-image='{{$key}}' data-id='{{ url("public/Proff_uploads/$value")}}' data-bs-target="#imagepreview"  data-gallery="gallery">
                            <img src="{{asset('public/Proff_uploads')}}/{{$value}}" class="img-fluid" style="height: 200px;width:100%">
                            </a>
                        </div>
                        @endforeach
                                               @else
                                               <p style="font-weight:700px; font-size:18px;">No image to display</p>
                                               @endif
                       
                                               
                    </div>
                </div>
            <div class="col-md-10">

            	
	            <div class="row">
	               <div class="col-12">
	                  <div class="card-footer">
	                    
	                  </div>
	               </div>
	            </div>
 
            </div>
         </div>
        
         <!-- </form>-->
      </div>
   </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
  
  
    function preview(e){
        //console.log(1);
    var id = e.getAttribute('data-id');
    var image_id= e.getAttribute('data-image');
      //console.log(image_id);
    document.getElementById('imgViewer').src=id;
    document.getElementById('delete').href=`https://meinhaus.ca/pro/images/delete/${image_id}`;
   
    //document.getElementById('viewImg').style.display='block';


}
</script>
@endsection
