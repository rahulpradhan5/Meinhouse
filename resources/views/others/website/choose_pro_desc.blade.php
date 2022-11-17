@extends('website.layouts.master')
@section('content')


    <!--site-main start-->
    <div class="site-main" style="padding-top: 0px;">

        <!-- sidebar -->
        <div class="sidebar ttm-sidebar-left ttm-bgcolor-grey break-991-colum clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-4 widget-area sidebar-left ttm-col-bgcolor-yes ttm-bg ttm-left-span">
                        <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                         <aside class="widget contact-widget service-desc">
                            <div class="service-header text-center">
                                <div>
                                    <img class="service-img" src="{{url('services/'.$service->service_image)}}">
                                </div>
                                <div>
                                    <h3 class="widget-title ser-title">{{$service->name ? $service->name : 'NA'}}</h3>      
                                </div>
                            </div>
                            
                            <div class="service-det">
                                <span class="service-time">For the first {{$service->time ? $service->time : 'NA'}} hour</span>
                                <span class="service-price text-right">$ {{$service->price ? $service->price : 'NA'}}</span>
                            </div>
                            <div class="service-det">
                                <span class="service-time">For each additional hour</span>
                                <span class="service-price text-right">$ {{$service->add_price ? $service->add_price : 'NA'}}</span>
                            </div>
                            <div class="service-content">
                                <p class="text-justify">{{$service->description ? $service->description : 'NA'}}</p>
                            </div>
                        </aside>


                        <aside class="widget widget-nav-menu">
                            <ul class="widget-menu">
                                @foreach($popular_services as $value)
                                    <li><a href="">{{$value->name ? $value->name : 'NA'}}</a></li>
                                @endforeach
                                <!-- <li><a href="home-maintainance.html"> Home Maintainance </a></li>
                                <li><a href="painting-services.html"> Painting Services </a></li>
                                <li><a href="renovation-and-painting.html"> Renovation and Painting </a></li>
                                <li><a href="air-conditioner.html"> Air Conditioner </a></li>
                                <li><a href="wiring-and-installation.html"> Wiring and installation </a></li>
                                <li class="active"><a href="plumber-services.html"> Plumber Services </a></li> -->
                            </ul>
                        </aside>
                       
                    </div>
                    <div class="col-lg-7 content-area">
                    	<h4 class="service-title">Choose Professional</h4>
                    	<hr style="margin-top: 0rem;margin-bottom: 5%" />
                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-left-image row">
                            <div class="col-lg-3 col-md-12 ttm-featured-img-left">
                                <div class="featured-thumbnail"> 
                                    <img class="img-fluid" src="images/portfolio/post-one-450x600.jpg" alt="image"> 
                                </div> 
                            </div>
                            <div class="col-lg-9 col-md-12 featured-content featured-content-post">
                                <span class="category">
                                    <a href="portfolio-category.html">Electrical</a>
                                    <a href="portfolio-category.html">Industrial</a>
                                </span>
                                <div class="post-title featured-title">
                                    <h5><a href="single-blog.html">Equipping Researchers in the Developing.</a></h5>
                                </div>
                                <div class="featured-desc ttm-box-desc">
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alter...</p>
                                </div>
                                <div class="post-meta">
                                    <span class="ttm-meta-line"><i class="fa fa-calendar"></i><a href="single-blog.html">January 16, 2019</a></span>
                                </div>
                            </div>
                            <div class="ttm-blog-classic-box-comment">
                                            <div id="comments" class="comments-area">
                                                <h2 class="comments-title">3 Replies to “Don’t worry about creativity and inspriation.”</h2>
                                                <ol class="comment-list">
                                                    <li>
                                                        <div class="comment-body">
                                                            <div class="comment-author vcard">
                                                                <img src="images/blog/blog-comment-01.jpg" class="avatar" alt="comment-img">
                                                            </div>
                                                            <div class="comment-box">
                                                                <div class="comment-meta commentmetadata">
                                                                    <cite class="ttm-comment-owner">Alex</cite>
                                                                    <a href="#">February 14, 2019 at 8:41 am</a>
                                                                </div>
                                                                <div class="author-content-wrap">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium eius, sunt porro corporis maiores ea, voluptatibus omnis maxime</p>
                                                                </div>
                                                                <div class="reply">
                                                                    <a rel="nofollow" class="comment-reply-link" href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="comment">
                                                        <div class="comment-body">
                                                            <div class="comment-author vcard">
                                                                <img src="images/blog/blog-comment-01.jpg" class="avatar" alt="comment-img">
                                                            </div>
                                                            <div class="comment-box">
                                                                <div class="comment-meta">
                                                                    <cite class="ttm-comment-owner">Alex</cite>
                                                                    <a href="#">February 14, 2019 at 8:43 am</a>
                                                                </div>
                                                                <div class="author-content-wrap">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium eius, sunt porro corporis maiores ea, voluptatibus omnis maxime</p>
                                                                </div>
                                                                <div class="reply">
                                                                    <a rel="nofollow" class="comment-reply-link" href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- ttm-blog-classic-box-content end -->
                        </div><!-- featured-imagebox-post end-->

 
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!-- sidebar end -->


    </div><!--site-main end-->

@endsection