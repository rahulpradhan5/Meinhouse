<div class="nav-header">
	<a href="{{url('admin/dashboard')}}" class="brand-logo">
		<img  class="logo-abbr" src="{{url('assets/jobick/images/logo.png')}}" width="auto" height="55.771" style="max-width:6rem" viewBox="0 0 62.074 65.771" alt="">
		<img  class="brand-title" src="{{url('assets/jobick/images/logo-img.png')}}" width="auto" height="50.771" style="margin-left:0px" viewBox="0 0 134.01 48.365"  alt="">
	</a>
	<div class="nav-control">
		<div class="hamburger">
			<span class="line"></span><span class="line"></span><span class="line"></span>
		</div>
	</div>
</div>
	
<!--**********************************
	Chat box start
***********************************-->


<!--**********************************
	Chat box End
***********************************-->

<!--**********************************
	Header start
***********************************-->

<div class="header">
	<div class="header-content">
		<nav class="navbar navbar-expand">
			<div class="collapse navbar-collapse justify-content-between">
				
				<div class="header-left">

					<div class="dashboard_bar text-warning" style="font-size:18px;">

						PRO DASHBOARD

					</div>

					<div class="nav-item d-flex align-items-center">

						<!--<div class="input-group search-area">-->

						<!--	<input type="text" class="form-control" placeholder="">-->

						<!--	<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>-->

						<!--</div>-->

						<!--<div class="plus-icon">-->

						<!--	<a href="javascript:void(0);"><i class="fas fa-plus"></i></a>-->

						<!--</div>-->

					</div>

				</div>
				<ul class="navbar-nav header-right ms-auto" >
					
					
					
					<li class="nav-item dropdown notification_dropdown ms-auto" id="darkbutton" >
						<h3 class="text-warning" style="font-size:18px;">@yield('head_title')</h3>
					</li>
					 <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell-link " href="javascript:void(0);">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="22.871" viewBox="0 0 24 22.871">
								  <g data-name="Layer 2" transform="translate(-2 -2)">
									<path id="Path_9" data-name="Path 9" d="M23.268,2H4.73A2.733,2.733,0,0,0,2,4.73V17.471A2.733,2.733,0,0,0,4.73,20.2a.911.911,0,0,1,.91.91v1.94a1.82,1.82,0,0,0,2.83,1.514l6.317-4.212a.9.9,0,0,1,.5-.153h4.436a2.742,2.742,0,0,0,2.633-2L25.9,5.462A2.735,2.735,0,0,0,23.268,2Zm.879,2.978-3.539,12.74a.915.915,0,0,1-.88.663H15.292a2.718,2.718,0,0,0-1.514.459L7.46,23.051v-1.94a2.733,2.733,0,0,0-2.73-2.73.911.911,0,0,1-.91-.91V4.73a.911.911,0,0,1,.91-.91H23.268a.914.914,0,0,1,.879,1.158Z" transform="translate(0 0)"></path>
									<path id="Path_10" data-name="Path 10" d="M7.91,10.82h4.55a.91.91,0,1,0,0-1.82H7.91a.91.91,0,1,0,0,1.82Z" transform="translate(-0.45 -0.63)"></path>
									<path id="Path_11" data-name="Path 11" d="M16.1,13H7.91a.91.91,0,1,0,0,1.82H16.1a.91.91,0,1,0,0-1.82Z" transform="translate(-0.45 -0.99)"></path>
								  </g>
								</svg>
									<span class="badge light text-white bg-primary rounded-circle">0</span>
                                </a>
							</li>
					<li class='nav-item dropdown notification_dropdown'>

                        <a class='nav-link' href='javascript:void(0);' role='button' data-bs-toggle='dropdown'>

                          <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'>

                              <g  data-name='Layer 2' transform='translate(-2 -2)'>

                                <path id='Path_20' data-name='Path 20' d='M22.571,15.8V13.066a8.5,8.5,0,0,0-7.714-8.455V2.857a.857.857,0,0,0-1.714,0V4.611a8.5,8.5,0,0,0-7.714,8.455V15.8A4.293,4.293,0,0,0,2,20a2.574,2.574,0,0,0,2.571,2.571H9.8a4.286,4.286,0,0,0,8.4,0h5.23A2.574,2.574,0,0,0,26,20,4.293,4.293,0,0,0,22.571,15.8ZM7.143,13.066a6.789,6.789,0,0,1,6.78-6.78h.154a6.789,6.789,0,0,1,6.78,6.78v2.649H7.143ZM14,24.286a2.567,2.567,0,0,1-2.413-1.714h4.827A2.567,2.567,0,0,1,14,24.286Zm9.429-3.429H4.571A.858.858,0,0,1,3.714,20a2.574,2.574,0,0,1,2.571-2.571H21.714A2.574,2.574,0,0,1,24.286,20a.858.858,0,0,1-.857.857Z'/>

                              </g>

                            </svg>

                            <span class='badge light text-white bg-primary rounded-circle'>

                                <?php $count_notification = DB::table('multiple_estimate_professionals')->where('pro_id',Auth::user()->id)->where('status',1)->where('assign_status',1)->where('site_notification_status','0')->count();?> {{ $count_notification }}

                            </span>

                        </a>



                        <?php $notification = DB::table('multiple_estimate_professionals')->where('pro_id',Auth::user()->id)->where('status',1)->where('assign_status',1)->where('site_notification_status','0')->where('site_photo_status',NULL)->orderby('id','desc')->get();?>



                        <div class='dropdown-menu dropdown-menu-end'>

                            <div id='DZ_W_Notification1' class='widget-media dlab-scroll p-3' style='height:380px;'>

                                <ul class='timeline'>

                                    @forelse ($notification as $nt)

                                    <?php $est_detail = DB::table('multiple_estimate_services')->where('id',$nt->mest_service_id)->first();?>

                                    <?php $ser_name = DB::table('services')->where('id',$est_detail->service_id)->first();?>

                                    <li>

                                        <div class='timeline-panel'>

                                            <div class='media me-2'>

                                                <i class="fas fa-bell"></i>

                                            </div>

                                            <div class='media-body'>

                                                <?php $msg = "Please upload the site photos for the $ser_name->name of $nt->estimate_booking_id";?>

                                                {{-- <h6 class='mb-1'>{{ substr($msg,0,27) }}...</h6> --}}
                                                <?php
                                                $project=DB::table('multiple_estimate')->where('booking_show_id',$nt->estimate_booking_id)->first();
                                                ?>

                                                <h6 class='mb-1'>Please upload {{ $nt->site_img_no }} site @if($nt->site_img_no=='1') Photo @else Photos @endif for the {{ $ser_name->name }} of <span class="text-danger">{{ $project->title }}</span></h6>

                                                <small class='d-block'>{{ Carbon\Carbon::parse($nt->created_at)->format('d M Y H:i:s') }}</small>

                                            </div>

                                        </div>

                                    </li>
                                    
                                   

                                    @empty

                                    <center>No data available here!</center>

                                    @endforelse

                                </ul>

                            </div>

                            <!--<a class='all-notification' href='javascript:void(0);'>See all notifications <i class='ti-arrow-end'></i></a>-->

                        </div>

                    </li>
					
					
					

				</ul>
			</div>
		</nav>
	</div>
</div>
<!--**********************************
	Header end ti-comment-alt
***********************************-->

<!--**********************************
	Sidebar start
***********************************-->
<div class="dlabnav">
	<div class="dlabnav-scroll">
		<ul class="metismenu" id="menu">
			<li><a class="" href="{{url('pro/dashboard')}}">
					<i class="flaticon-025-dashboard"></i>
					<span class="nav-text">Dashboard</span>
				</a>
			</li>

			<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
					<i class="fas fa-user"></i>
					<span class="nav-text">Profile</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="{{route('pro_profile')}}">Info</a></li>

                    <li><a href="{{url('pro/proff-documents')}}">Documents</a></li>

                    <li><a href="{{url('pro/proff-availability')}}">Availability</a></li>

                    <li><a href="{{route('proff-images')}}">Photo</a></li>

				</ul>
			</li>
			<?php $direct_req_notif = DB::table('multiple_estimate_professionals')->where('pro_id',Auth::user()->id)->where('direct_req_notif_status',NULL)->count();?>

            <?php $bid_req_notif = DB::table('multiple_estimates_bidding')->where('proff_id',Auth::user()->id)->where('bid_req_notif_status',NULL)->count();?>

            <?php $lead_req_notif = DB::table('pro_leads')->where('pro_id',Auth::user()->id)->where('lead_req_notif',NULL)->count();?>
			

			<li><a  href="{{route('ongoing_jobs')}}" >
					<i class="flaticon-043-menu"></i>
					<span class="nav-text">Current Projects</span>
				</a>
				<!---ul aria-expanded="false">
					<li><a href="{{route('ongoing_jobs')}}">Ongoing Jobs</a></li>
					<li><a href="#">Customer Support</a></li>
					<li><a href="{{url('pro/site-images')}}">Project Photos</a></li>
				</!---ul--->
			</li>
			
		
			
			<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
					<i class="fas fa-user"></i>
                    <span class="nav-text">Opportunities <sup class="badge badge-danger badge-sm" style="font-weight: 400">{{ $direct_req_notif + $bid_req_notif + $lead_req_notif }}</sup></span>
				</a>
				<ul aria-expanded="false">
					<li><a href="{{url('pro/estimate')}}">Assigned To You</a></li>
					<li><a href="{{url('pro/bidding')}}">Price Requested</a></li>
					<!---li><a href="{{url('pro/estimate')}}">Direct Request</a></!---li>
                    <li><a href="{{url('pro/bidding')}}">Bids</a></li>
                    <li><a href="{{url('pro/leads')}}">Leads</a></li>
                    <li><a href="{{url('pro/bookings')}}">Hourly</a></li--->
				</ul>
			</li>

			<li><a class="" href="{{route('past-bookings')}}">
					<i class="flaticon-093-waving"></i>
					<span class="nav-text">History</span>
				</a>
				
			</li>
			
		   <li><a class="" href="{{url('pro/proff-customer-reviews')}}">
					<i class="flaticon-045-heart"></i>
					<span class="nav-text">Reviews</span>
				</a>
		   </li>
		   
		   <li>
                <a href="{{route('AdminMessages')}}" class="" >
    
    				<i class="fa fa-comments"></i>
                    <?php
                    
                    $msgs=DB::table('pro_msg')->where('pro_id',session('id'))->where('is_seen',0)->count();
                    ?>
    				<span class="nav-text">Messages <sup class="badge badge-danger badge-sm" style="font-weight: 400">{{ $msgs }}</sup> </span>
    
    			</a>
    
    		</li>
		   
		   <li><a class="" href="#">
					<i class="flaticon-086-star"></i>
					<span class="nav-text">Subscription Information</span>
				</a>
		   </li>
		   
		   <li><a class="" href="{{url('pro/terms-condition')}}">
					<i class="flaticon-086-star"></i>
					<span class="nav-text">Terms and Conditions</span>
				</a>
		   </li>
			<li><a href="{{url('pro/change-password')}}" class="" >
					<i class="flaticon-013-checkmark"></i>
					<span class="nav-text">Change Password</span>
				</a>
			</li>
			<li><a class="" href="{{url('pro-logout')}}">
					<i class="fa fa-sign-out-alt"></i>
					<span class="nav-text">Log Out</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<!--**********************************
	Sidebar end
***********************************-->
