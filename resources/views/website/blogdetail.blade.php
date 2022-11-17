@extends('website.layout.layout')

@section('content')
<title>{{$blog->meta_title}}</title>
<meta name="keywords" content="{{$blog->meta_keywords}}">
<meta name="description" content="{{$blog->meta_description}}">

<style>
    
    body .site-main {
    padding-top: 0px!important;
    }
    
    .ttm-box-post-date{
        background-color: #fda12b;
    }
</style>


 <!-- page-title -->

        <div class="ttm-page-title-row text-center">

            <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

            <div class="container">

                <div class="row">

                    <div class="col-md-12"> 

                        <div class="title-box ttm-textcolor-white">

                            <div class="page-title-heading">

                                <h1 class="title">Blog Details</h1>

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





 <!--site-main start-->
    <div class="site-main single">

        <!-- sidebar -->
        <div class="sidebar ttm-sidebar-right ttm-bgcolor-white break-991-colum clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 content-area">
                        <div class="ttm-entry-meta-wrapper">
                            <div class="ttm-entry-meta">
                                <span class="ttm-meta-line byline text-center">
                                    <h3 style="margin-bottom: 30px!important;text-transform: uppercase;">{{$blog->title}}</h3>
                                
                            </div>
                        </div>
                        <!-- post -->
                        <article class="post ttm-blog-classic">
                            <!-- post-featured-wrapper -->
                            <div class="post-featured-wrapper">
                                <div class="post-featured">
                                    <img class="img-fluid" src="{{url('/blogs/'.$blog->blog_image) }}" alt="{{$blog->title}}" style="height: 300px;width: 1139px;">
                                </div>

                                <div class="ttm-box-post-date">
                                    <span class="ttm-entry-date">
                                        <time class="entry-date" datetime="2019-01-16T07:07:55+00:00">{{date('d',strtotime($blog->date))}}<span class="entry-month entry-year">{{date('M',strtotime($blog->date))}}</span></time>
                                    </span>
                                </div>
                            </div>
                            <!-- post-featured-wrapper end -->
                            <!-- ttm-blog-classic-box-content -->
                            <div class="ttm-blog-classic-box-content">
                                <div class="entry-content">
                                    <div class="ttm-entry-meta-wrapper">
                                        <div class="ttm-entry-meta">
                                            <span class="ttm-meta-line byline">
                                                </span>
                                                <span class="ttm-meta-line comments-link">
                                                <a href=""><i class="fa fa-eye"></i>&nbsp; {{$blog->views}} views</a>
                                            </span>
                                            
                                        </div>
                                    </div>
                                    <div class="ttm-box-desc-text">
                                        <p>{!! $blog->description !!}</p>
                                        
                                    </div>
                                </div>
                            </div> <!-- ttm-blog-classic-box-content end -->
                        </article><!-- post end -->
                    </div>
                    
                </div><!-- row end -->
            </div>
        </div>
        <!-- sidebar end -->

    </div><!--site-main end-->





@endsection