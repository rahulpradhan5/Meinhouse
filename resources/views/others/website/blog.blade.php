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

                                <h1 class="title">Blog</h1>

                            </div><!-- /.page-title-captions -->

                            <div class="breadcrumb-wrapper">

                                <span>

                                    <a title="Homepage" href="{{url('/')}}"><i class="fa fa-home"></i></a>

                                </span>

                                <span class="ttm-bread-sep">&nbsp; HOME &nbsp;</span>

                                <span class="text-primary">&nbsp; >> &nbsp;</span>

                                <span><span>Blog</span></span>

                            </div>  

                        </div>

                    </div><!-- /.col-md-12 -->  

                </div><!-- /.row -->  

            </div><!-- /.container -->                      

        </div><!-- page-title end-->





 <div class="site-main">



        <div class="ttm-row pb-110 ttm-bgcolor-grey clearfix">

            <div class="container">

                <div class="row">


                    @foreach($blogs as $blog)
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                        <!-- featured-imagebox-post -->

                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-left-image row">

                            <div class="col-lg-5 col-md-12 ttm-featured-img-left">

                                <div class="featured-thumbnail"> 
                                    
                                    <img class="img-fluid" src="{{url('/blogs/'.$blog->blog_image) }}" alt="{{$blog->title}}" style="margin-top: 21px;"> 

                                </div> 

                            </div>

                            <div class="col-lg-7 col-md-12 featured-content featured-content-post">

                                

                                <div class="post-title featured-title">

                                    <h5>{{substr($blog->title,'0','45')}}
                                    @if(strlen($blog->title)>45)
                                    ...
                                    @endif
                                    </h5>

                                </div>

                                <div class="featured-desc ttm-box-desc">

                                    <p>{!!substr($blog->short_description,'0','100')!!}...</p>

                                </div>

                                <div class="post-meta">

                                    <span class="ttm-meta-line"><i class="fa fa-calendar"></i><a>{{$blog->date}}</a></span>
                                    <span class ="featured-desc"><a href="{{url('blog/'.$blog->url)}}">Read More ....</a></span>
                                </div>

                            </div>

                        </div><!-- featured-imagebox-post end-->

                    </div>
                   @endforeach             
                </div>

            </div>

        </div>

        

    </div><!--site-main end-->





@endsection