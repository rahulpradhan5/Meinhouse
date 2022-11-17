@extends('website.layouts.master')

@section('content')


 <!-- page-title -->

        <div class="ttm-page-title-row text-center">

            <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

            <div class="container">

                <div class="row">

                    <div class="col-md-12"> 

                        <div class="title-box ttm-textcolor-white">

                            <div class="page-title-heading">

                                <h1 class="title">Help Center</h1>

                            </div><!-- /.page-title-captions -->

                            <div class="breadcrumb-wrapper">

                                <span>

                                    <a title="Homepage" href="https://quantumits.online/erikhall/public/"><i class="fa fa-home"></i></a>

                                </span>

                                <span class="ttm-bread-sep">&nbsp; HOME &nbsp;</span>

                                <span class="text-primary">&nbsp; >> &nbsp;</span>

                                <span><span>Help</span></span>

                            </div>  

                        </div>

                    </div><!-- /.col-md-12 -->  

                </div><!-- /.row -->  

            </div><!-- /.container -->                      

        </div><!-- page-title end-->
<section class="py-0" style="padding-bottom: 5% !important;">
  <div class="container">
    <div class="row">
       @foreach($helpcenters as $helpcenter)
      <div class="col-md-12 col-12 col-lg-12 col-sm-12 mt-5">
        <div class="border-box">
          <div  class="row">  
           
          <div class="col-md-2">
        <img class="mx-auto img-fluid" src="{{ url('/helpcenters/'.$helpcenter->helpcenter_image) }}" alt="image" style="width:100%">
          </div><!--col-md-2-->
            <div class="col-md-10">
          <h5 class="info-general">{{$helpcenter->title}}</h5>
          <p class="para-general">{{$helpcenter->description}}</p>
        <img class="write-pic" src="{{asset('image/writer.png')}}" alt="image"> 
        <h6 class="name-letter">Written by <span class="side-color"> &nbsp {{$helpcenter->publisher}}</span></h6>
        </div><!--10--> 
        
        </div><!--row-->
      </div><!--border-box-->
      </div><!--cols-->
      @endforeach
    </div><!--row-->
  </div><!--cont-->
</section>



<!--
<div class="site-main">-->


   <!--search comment
  <div class="container search_box_help">

    <div class="row">

      <div class="col-md-12">

        <form class="example" action="/action_page.php">

          <input type="text" placeholder="Search for the articles..." name="search">

          <button type="submit"><i class="fa fa-search"></i></button>

        </form>

      </div>

    </div>

  </div>-->

 <!--
  <div class="container">
   
    <div class="row">
   
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            @foreach($helpcenters as $helpcenter)
           
            <div class="featured-imagebox featured-imagebox-post ttm-box-view-left-image row">
              
                <div class="col-lg-2 col-md-12 text-center">

                  <img class="mx-auto img-fluid" src="{{ url('/helpcenters/'.$helpcenter->helpcenter_image) }}" alt="image" style="width:100%">    

                </div>

                <div class="col-lg-9 col-md-12 featured-content featured-content-post">

                    <div class="post-title featured-title">

                        <h5><a>{{$helpcenter->title}}</a></h5>

                    </div>

                    <div class="featured-desc ttm-box-desc">

                        <p>{{$helpcenter->description}}</p>

                    </div>

                    <div class="row help_writer">

                        <div class="col-md-1" style="padding-left:0px;padding-right:0px;">

                          <img class="mx-auto img-fluid" src="{{asset('image/writer.png')}}" alt="image">  

                        </div>

                        <div class="col-md-11 text-left">-->

                          <!--<span style="display:block;">17 articles in this collection</span>-->
<!--
                          <span><i>Written by </i><span class="writer_name">{{$helpcenter->publisher}}</span></span>

                        </div>

                    </div>

                </div>
 
            </div>

        </div>
  @endforeach
      </div>

    </div>

  </div>-->

@endsection