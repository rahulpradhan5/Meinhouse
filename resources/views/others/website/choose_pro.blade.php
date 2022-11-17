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
                                    <img class="service-img" src="{{url('services/'.$book_service->service_image)}}">
                                </div>
                                <div>
                                    <h3 class="widget-title ser-title">{{$book_service->name ? $book_service->name : 'NA'}}</h3>      
                                </div>
                            </div>
                            
                            <div class="service-det">
                                <span class="service-time">For the first {{$book_service->time ? $book_service->time : 'NA'}} hour</span>
                                <span class="service-price text-right">$ {{$book_service->price ? $book_service->price : 'NA'}}</span>
                            </div>
                            <div class="service-det">
                                <span class="service-time">For each additional hour</span>
                                <span class="service-price text-right">$ {{$book_service->add_price ? $book_service->add_price : 'NA'}}</span>
                            </div>
                            <div class="service-content">
                                <p class="text-justify">{{$book_service->description ? $book_service->description : 'NA'}}</p>
                            </div>
                        </aside>


                        <aside class="widget widget-nav-menu">
                            <ul class="widget-menu">
                                @foreach($popular_services as $value)
                                    <li><a href="{{url('job/'.$value->id)}}" class="hover-color">{{$value->name ? $value->name : 'NA'}}</a></li>
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

                        @foreach($professionals as $key => $professional)
                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-left-image row">
                            <div class="col-lg-3 col-md-12 ttm-featured-img-left">
                                <div class="featured-thumbnail"> 
                                    <img class="img-fluid" src="{{$professional['pro_image']}}" alt="image"> 
                                </div> 
                            </div>
                            <div class="col-lg-9 col-md-12 featured-content featured-content-post">
                                <span class="category">
                                    @foreach($professional['services'] as $service)
                                    <a href="" class="hover-color">{{$service['serviceDetails']['name']}}</a>
                                    @endforeach
                                </span>
                                <div class="post-title featured-title">
                                    <h5><a href="single-blog.html">{{$professional['pro_name']}}</a></h5>
                                </div>
                                <div class="featured-desc ttm-box-desc">
                                    <p>{{$professional['service_desc']}}</p>
                                </div>
                                <div class="post-meta switch-field">
                                    <span class="ttm-meta-line">{{$professional['avg_ratings']}}</span>
                                        <input type="radio" id="radio-one" name="switch-one" value="{{$professional['pro_id']}}" checked="{{$key == 0 ? 'checked' : ''}}">
                                        <label for="radio-one">Select</label>
                                </div>
                            </div>
                        </div><!-- featured-imagebox-post end-->
                       @endforeach
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!-- sidebar end -->


    </div><!--site-main end-->

@endsection