<?php
$professional=$pro['details'][0];
$colors=['#2769ee','#ee27c0','#2db532','#2769ee','#ee27c0','#f7a823']

?>

<style>

	.jobs{
		border:none !important;
	}
</style>
@extends('professional.layout.layout')
@section('head_title','HOME PANEL')
    @section('content')

				<div class="row">
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-12">
								
								<div class="card">
									<div class="card-body">
										<div class="row ">
											<div class="col-xl-8 col-xxl-7 col-sm-7">
												<div class="update-profile d-flex">
													<img src="{{ url('public/upload/pro_profile/'.$professional->user_image) }}" alt="">
													<div class="ms-4">
														<h3 class="fs-24 font-w600 mb-0"><span class="text-warning">Welcome,</span> <span class="text-capitalize">{{$professional->name}}</span></h3>
														<br>
														<!--<span class="text-primary d-block mb-4">{{$professional->email}}</span>-->
													
														<h4><span><?php $pro_com = DB::table('pro_details')->where('pro_id',session('id'))->first(); echo $pro_com->company_name;?></span>
														</h4>

@foreach($services_arr as $s)
<h4>{{$s}}</h4>

@endforeach
											
													</div>
													
												</div>
											</div>
											<div class="col-xl-4 col-xxl-5 col-sm-5 sm-mt-auto mt-3">
												<a href="{{route('edit-profile')}}" class="btn btn-primary btn-rounded">Update Profile</a><br><br>
												@if($doc_flag == false)
												<button class="btn btn-flat btn-rounded" style="border:none;shadow:none"><i class="fas fa-flag text-danger"></i><br>
													<a href="" class="">Docs Needed<sup class="text-danger">*</sup></a></button>
												@endif
												
											</div>
										</div>
										<div class="row mt-4 align-items-center">
											<h4 class="fs-20 mb-3 text-center" style="color:#0abde3">Add <a href="{{route('proff-business')}}">Services</a> to get more Jobs!</h4>
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header pb-0 border-0 flex-wrap">
										<h4 class="fs-20 mb-3">Project On-The-Go</h4>
									</div>
									<div class="card-body">
										<div class="owl-carousel owl-carousel owl-loaded front-view-slider ">
											@forelse($on_the_go->slice(0, 5) as $key=>$value)
                                                  
											<a href="{{route('ongoing_jobs')}}" />
											<div class="items">
												<div class="jobs">
													<div class="text-center">
														<span>
															<svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															  <g  transform="translate(-457 -443)">
																<rect  width="71" height="71" rx="12" transform="translate(457 443)" fill=""/>
																<g  transform="translate(457 443)">
																  <rect  data-name="placeholder" width="71" height="71" rx="12" fill="{{$colors[5-$key]}}"/>
																  <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																  <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
																</g>
															  </g>
															</svg>
														</span>
														<h4 class="mb-0">{{ucwords($value->name)}}</h4>
														<span class="text-primary mb-3 d-block">{{ucwords($value->estimate_booking_id)}}</span>
													</div>
													<div>
														<?php $mest_services  = DB::table('multiple_estimate_services')->where('id',$value->mest_service_id)->first();?>
  
													<span class="d-block mb-1"><i class="fas fa-tools me-2 me-2"></i><?php $service = DB::table('services')->where('id',$mest_services->service_id)->get(); echo $service[0]->name; ?></span>
														<span><i class="fas fa-comments-dollar me-2"></i>${{ucwords($value->pro_amount)}}</span>
													</div>
												</div>
											</div>
											</a>
											@empty
											<b>No projects started yet</b>
											@endforelse									
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header pb-0 border-0 flex-wrap">
										<h4 class="fs-20 mb-3">Customer Support</h4>
									</div>
									<div class="card-body">
										<div class="owl-carousel owl-carousel owl-loaded front-view-slider ">
											<div class="items">
												<div class="jobs">
													<div class="text-center">
														<span>
															<svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															  <g  transform="translate(-457 -443)">
																<rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
																<g  transform="translate(457 443)">
																  <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#2769ee"/>
																  <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																  <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
																</g>
															  </g>
															</svg>
														</span>
														<h4 class="mb-0">UI Designer</h4>
														<span class="text-primary mb-3 d-block">Bubbles Studios</span>
													</div>
													<div>
													<span class="d-block mb-1"><i class="fas fa-map-marker-alt me-2"></i>Manchester, England</span>
														<span><i class="fas fa-comments-dollar me-2"></i>$ 2,000 - $ 2,500</span>
													</div>
												</div>
											</div>
											
											<div class="items">
												<div class="jobs">
													<div class="text-center">
														<span>
															<svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															  <g  transform="translate(-457 -443)">
																<rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
																<g  transform="translate(457 443)">
																  <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#2db532"/>
																  <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																  <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
																</g>
															  </g>
															</svg>
														</span>
														<h4 class="mb-0">Frontend</h4>
														<span class="text-primary mb-3 d-block">Green Comp.</span>
													</div>
													<div>
													<span class="d-block mb-1"><i class="fas fa-map-marker-alt me-2"></i>Manchester, England</span>
														<span><i class="fas fa-comments-dollar me-2"></i>$ 2,000 - $ 2,500</span>
													</div>
												</div>
											</div>
											<div class="items">
												<div class="jobs">
													<div class="text-center">
														<span>
															<svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															  <g  transform="translate(-457 -443)">
																<rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
																<g  transform="translate(457 443)">
																  <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#2769ee"/>
																  <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																  <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
																</g>
															  </g>
															</svg>
														</span>
														<h4 class="mb-0">UI Designer</h4>
														<span class="text-primary mb-3 d-block">Bubbles Studios</span>
													</div>
													<div>
													<span class="d-block mb-1"><i class="fas fa-map-marker-alt me-2"></i>Manchester, England</span>
														<span><i class="fas fa-comments-dollar me-2"></i>$ 2,000 - $ 2,500</span>
													</div>
												</div>
											</div>
											<div class="items">
												<div class="jobs">
													<div class="text-center">
														<span>
															<svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															  <g  transform="translate(-457 -443)">
																<rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
																<g  transform="translate(457 443)">
																  <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#ee27c0"/>
																  <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																  <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
																</g>
															  </g>
															</svg>
														</span>
														<h4 class="mb-0">Researcher</h4>
														<span class="text-primary mb-3 d-block">Kleon Studios</span>
													</div>
													<div>
													<span class="d-block mb-1"><i class="fas fa-map-marker-alt me-2"></i>Manchester, England</span>
														<span><i class="fas fa-comments-dollar me-2"></i>$ 2,000 - $ 2,500</span>
													</div>
												</div>
											</div>
											<div class="items">
												<div class="jobs">
													<div class="text-center">
														<span>
															<svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															  <g  transform="translate(-457 -443)">
																<rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
																<g  transform="translate(457 443)">
																  <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#2db532"/>
																  <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																  <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
																</g>
															  </g>
															</svg>
														</span>
														<h4 class="mb-0">Frontend</h4>
														<span class="text-primary mb-3 d-block">Green Comp.</span>
													</div>
													<div>
													<span class="d-block mb-1"><i class="fas fa-map-marker-alt me-2"></i>Manchester, England</span>
														<span><i class="fas fa-comments-dollar me-2"></i>$ 2,000 - $ 2,500</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="row separate-row">
											<div class="col-sm-6">
												<div class="job-icon pb-4 d-flex justify-content-between">
													<div>
														<div class="d-flex align-items-center mb-1">
															<h2 class="mb-0">{{$pro['jobs_recived']}}</h2>
														</div>
														<span class="fs-14 d-block mb-2">Jobs Done</span>
													</div>
													<div id="NewCustomers"></div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
													<div>
														<div class="d-flex align-items-center mb-1">
															<h2 class="mb-0">{{$pro['jobs_done']}}</h2>
														</div>
														<span class="fs-14 d-block mb-2">Jobs Booked</span>
													</div>
													<div id="NewCustomers1"></div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="job-icon pt-4 pb-sm-0 pb-4 pe-3 d-flex justify-content-between">
													<div>
														<div class="d-flex align-items-center mb-1">
															<h2 class="mb-0">${{$pro['earning']}}</h2>

														</div>
														<span class="fs-14 d-block mb-2">Total Earning</span>
													</div>
													<div id="NewCustomers2"></div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="job-icon pt-4  d-flex justify-content-between">
													<div>
														<div class="d-flex align-items-center mb-1">
															<h2 class="mb-0">{{$pro['bidding']}}</h2>
														</div>
														<span class="fs-14 d-block mb-2">Average Rating</span>
													</div>
													<div id="NewCustomers3"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header pb-0 border-0 flex-wrap">
										<h4 class="fs-20 mb-3">Opportunities</h4>
									</div>
									<div class="card-body">
										<div class="owl-carousel owl-carousel owl-loaded front-view-slider ">
											@forelse($opportunity->slice(0, 5) as $key=>$value)
											
											    <a href="{{route('multiple-pro-estimate')}}">
										   <div class="items">
											   <div class="jobs">
												   <div class="text-center">
													   <span>
														   <svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															 <g  transform="translate(-457 -443)">
															   <rect  width="71" height="71" rx="12" transform="translate(457 443)" fill=""/>
															   <g  transform="translate(457 443)">
																 <rect  data-name="placeholder" width="71" height="71" rx="12" fill="{{$colors[$key]}}"/>
																 <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																 <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
															   </g>
															 </g>
														   </svg>
													   </span>
													   <h4 class="mb-0">{{ucwords($value->name)}}</h4>
													   <span class="text-primary mb-3 d-block">{{ucwords($value->estimate_booking_id)}}</span>
												   </div>
												   <div>
													   <?php $mest_services  = DB::table('multiple_estimate_services')->where('id',$value->mest_service_id)->first();?>
 
												   <span class="d-block mb-1"><i class="fas fa-tools  me-2"></i><?php $service = DB::table('services')->where('id',$mest_services->service_id)->get(); echo $service[0]->name; ?></span>
													   <span><i class="fas fa-comments-dollar me-2"></i>${{ucwords($value->pro_amount)}}</span>
												   </div>
											   </div>
										   </div>
										   </a>  
										  
										   	@empty
										   	<b>No Projects assigned for now</b>
											@endforelse
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header pb-0 border-0 flex-wrap">
										<h4 class="fs-20 mb-3">Upload Photos</h4>
									</div>
									<div class="card-body">
										<div class="owl-carousel owl-carousel owl-loaded front-view-slider ">
										
										@forelse($site_photos as $key=>$value)
											<div class="items">
												<div class="jobs">
													<div class="text-center">
														<span>
															<svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
															  <g  transform="translate(-457 -443)">
																<rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
																<g  transform="translate(457 443)">
																  <rect  data-name="placeholder" width="71" height="71" rx="12" fill="{{$colors[$key]}}"/>
																  <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
																  <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
																</g>
															  </g>
															</svg>
														</span>
														<?php							$mest=DB::table('multiple_estimate')->where('booking_show_id',$value->estimate_booking_id)->first();
														?>
														<h4 class="mb-0">{{$mest->title}}</h4>
														<span class="text-primary mb-3 d-block">{{$value->estimate_booking_id}}</span>
													</div>
													<div>
														<?php
							$mest_services  = DB::table('multiple_estimate_services')->where('id',$value->mest_service_id)->first();
							//$pro_images = DB::table('pro_site_image')->where('booking_id',$value->estimate_booking_id)->where('service_id',$mest_services->service_id)->pluck('image');
															?>
													<span class="d-block mb-1"><i class="fas fa-tools me-2"></i><?php $service = DB::table('services')->where('id',$mest_services->service_id)->get(); echo $service[0]->name; ?></span>
														<span><i class="fas fa-image me-2"></i>Upload {{$value->site_img_no}}  site photos</span>
													</div>
												</div>
											</div>
											@empty
											<p>No site photo to upload</p>
											@endforelse
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>
        @endsection
        <script>


            var pieChart1 = function(){
                     var options = {
                        series: [parseInt('{{$bids}}'), parseInt('{{$leads}}'), parseInt('{{$estimates}}')],
                      chart: {
                      type: 'donut',
                      height:250
                    },
                    dataLabels:{
                        enabled: false
                    },
                    stroke: {
                      width: 0,
                    },
                    colors:['#1D92DF', '#4754CB', '#D55BC1'],
                    legend: {
                          position: 'bottom',
                          show:false
                        },
                        labels: ["Bids", "Leads", "Estimates"],
                    responsive: [{
                      breakpoint: 1400,
                      options: {
                       chart: {
                          height:200
                        },
                      }
                    }]
                    };

                    var chart = new ApexCharts(document.querySelector("#pieChart1"), options);
                    chart.render();

                }
				var activityChart = function(){
		var activity = document.getElementById("activity");
			if (activity !== null) {
				var activityData = [{
						first: [ 30, 35, 30, 50, 30, 50, 40, 45],
						second: [ 20, 25, 20, 15, 25, 22, 24, 20],
						third: [ 20, 21, 22, 21, 22, 15, 17, 20]
					},
					{
						first: [ 35, 35, 40, 30, 38, 40, 50, 38],
						second: [ 30, 20, 35, 20, 25, 30, 25, 20],
						third: [ 35, 40, 40, 30, 38, 50, 42, 32]
					},
					{
						first: [ 35, 40, 40, 30, 38, 32, 42, 32],
						second: [ 20, 25, 35, 25, 22, 21, 21, 38],
						third: [ 30, 35, 40, 30, 38, 50, 42, 32]
					},
					{
						first: [ 35, 40, 30, 38, 32, 42, 30, 35],
						second: [ 25, 30, 35, 25, 20, 22, 25, 38],
						third: [ 35, 35, 40, 30, 38, 40, 30, 38]
					}
				];
				activity.height = 300;
				
				var config = {
					type: "line",
					data: {
						labels: [
							"Mar",
							"Apr",
							"May",
							"June",
							"Jul",
							"Aug",
							"Sep",
							"Oct",
						],
						datasets: [{
								label: "Active",
								backgroundColor: "rgba(82, 177, 65, 0)",
								borderColor: "#3FC55E",
								data: activityData[0].first,
								borderWidth: 6
							},
							{
								label: "Inactive",
								backgroundColor: 'rgba(255, 142, 38, 0)',
								borderColor: "#4955FA",
								data: activityData[0].second,
								borderWidth: 6,
								
							},
							{
								label: "Inactive",
								backgroundColor: 'rgba(255, 142, 38, 0)',
								borderColor: "#F04949",
								data: activityData[0].third,
								borderWidth: 6,
								
							} 
						]
					},
					options: {
						responsive: true,
						maintainAspectRatio: false,
						elements: {
								point:{
									radius: 0
								}
						},
						legend:false,
						
						scales: {
							yAxes: [{
								gridLines: {
									color: "rgba(89, 59, 219,0.1)",
									drawBorder: true
								},
								ticks: {
									fontSize: 14,
									fontColor: "#6E6E6E",
									fontFamily: "Poppins"
								},
							}],
							xAxes: [{
								//FontSize: 40,
								gridLines: {
									display: false,
									zeroLineColor: "transparent"
								},
								ticks: {
									fontSize: 14,
									stepSize: 5,
									fontColor: "#6E6E6E",
									fontFamily: "Poppins"
								}
							}]
						},
						tooltips: {
							enabled: false,
							mode: "index",
							intersect: false,
							titleFontColor: "#888",
							bodyFontColor: "#555",
							titleFontSize: 12,
							bodyFontSize: 15,
							backgroundColor: "rgba(256,256,256,0.95)",
							displayColors: true,
							xPadding: 10,
							yPadding: 7,
							borderColor: "rgba(220, 220, 220, 0.9)",
							borderWidth: 2,
							caretSize: 6,
							caretPadding: 10
						}
					}
				};

				var ctx = document.getElementById("activity").getContext("2d");
				var myLine = new Chart(ctx, config);

				var items = document.querySelectorAll("#user-activity .nav-tabs .nav-item");
				items.forEach(function(item, index) {
					item.addEventListener("click", function() {
						config.data.datasets[0].data = activityData[index].first;
						config.data.datasets[1].data = activityData[index].second;
						config.data.datasets[2].data = activityData[index].third;
						myLine.update();
					});
				});
			}
	
		
	}
            </script>
