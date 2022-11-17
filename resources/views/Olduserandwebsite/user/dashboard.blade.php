@extends('user.layout.layout')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Tomorrow&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">


        <div class="ttm-page-title-row text-center">

            <div class="ttm-page-title-row-bg-layer ttm-bg-layer"></div>

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <div class="title-box ttm-textcolor-white">

                            <div class="page-title-heading">

                                <h1 class="title">Dashboard</h1>

                            </div><!-- /.page-title-captions -->

                        </div>

                    </div><!-- /.col-md-12 -->

                </div><!-- /.row -->

            </div><!-- /.container -->

        </div><!-- page-title end-->

   <div class="site-main">
   <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h4 class="service-title">Bookings</h4>
          </div>
        <!--   <div class="col-md-4" >
              <button class="text-right" style="float: right;background-color: #1e9bd0;">View All Jobs</button>
          </div> -->

        </div>
      </div>
      <section class="pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding:0;">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab"  href="http://meinhausca.com/public/user/dashboard"

                                style="background-color:#1e9bd0;font-family: 'Poppins', sans-serif;">Upcoming</a>
                            <a class="nav-item nav-link " id="nav-profile-tab"  href="{{ url('past') }}"
                                style="background-color:#ccc;font-family: 'Poppins', sans-serif;">Past</a>


                        </div>
                    </nav>
                </div>
                <div class="col-md-12 tab-content py-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        style="border: 1px solid #ccc7c7;
                            border-radius: 10px;
                            padding: 12px 9px;
                            padding-bottom: 2%;background-color: #ffffff38;">
                                                                          <a href="#">
                        <div class="border-bottom-inner-side mt-2">
                                                        <h2 class="head">$ 200</h2>
                                                        <span class="side-info" style="margin-bottom: 55px;margin-top: -37px;font-weight:700;">OD-36L3907</span>
                            <p class="info">Service:</p><span class="side-info">Flooring &amp; Tile Services</span>
                            <span class="side-info1">Thu,02 Dec 2021</span>
                            <span class="side-info2">Midnoon(11:00 AM - 02:00 PM)</span>
                            <div class="py-0" style="clear:both;">
                                                                <p class="head" style="color:black;">Amount : $ 123409.56</p>
                                                                                              <button class="my-button text-white">Pending</button>
                                                                                                                                                     </div>
                        </div>
                        </a>
                                            </div>

                  </div>
              </div>
          </div>
        </section>
   </div>

</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
@endsection
