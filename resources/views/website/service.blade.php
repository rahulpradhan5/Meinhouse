@extends('website.layout.layout')

@section('content')
    <!-- page-title -->

    <div class="ttm-page-title-row text-center">

        <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="title-box ttm-textcolor-white">

                        <div class="page-title-heading">

                            <h1 class="title">Book A Job</h1>

                        </div><!-- /.page-title-captions -->

                        <div class="breadcrumb-wrapper">

                            <span>

                                <a title="Homepage" href="{{url('/')}}"><i class="fa fa-home"></i></a>

                            </span>

                            <span class="ttm-bread-sep">&nbsp; HOME &nbsp;</span>

                            <span class="text-primary">&nbsp; >> &nbsp;</span>

                            <span><span>Book a job</span></span>

                        </div>

                    </div>

                </div><!-- /.col-md-12 -->

            </div><!-- /.row -->

        </div><!-- /.container -->

    </div><!-- page-title end-->



    <!--site-main start-->

    <div class="site-main">



        <section class="ttm-row row-top-section clearfix">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <div class="section-title clearfix">

                            <div class="title-header">

                                <h2 class="title">SERVICES</h2>

                                <h5>We provide</h5>

                                <div class="container">

                                    <div class="row text-center">

                                        @foreach ($services as $service)
                                            <div class='service hidden-xs'>
                                                <a href="{{ url('service-detail/' . $service->url) }}"><img
                                                        class="mx-auto img-fluid" alt="{{ $service->name }}"
                                                        src="{{ url('assets/services/' . $service->service_image) }}" />
                                                    <span>{{ $service->name }}</span>
                                                </a>
                                            </div>
                                        @endforeach


                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>







    </div>
    <!--site-main end-->
@endsection
