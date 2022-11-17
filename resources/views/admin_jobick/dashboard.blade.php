<?php
$arr=['#2769ee','#eeac27','#9933cb','#22bc32','#378a82','#175baa','#b848ef','#22bc32','#7e1d74','#eeac27',];
?>
@extends('admin_jobick.layout.layout')
    @section('head_title','HOME PANEL')
    @section('content')

				<div class="row">
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-12">
								
								
								<div class="card">
                                <div class="card-header border-0">
                                    <h4 class="fs-20 mb-3">Customer Support</h4>

                                </div>
                                <div class="card-body loadmore-content  recent-activity-wrapper" id="RecentActivityContent">
                                     @if(count($activities))

                                     @foreach($activities as $key=>$item)
                                     <div class="d-flex recent-activity">
                                        <span class="me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                              <circle cx="8.5" cy="8.5" r="8.5" fill="#f93a0b"></circle>
                                            </svg>
                                        </span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
                                                  <g transform="translate(-457 -443)">
                                                    <rect width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"></rect>
                                                    <g transform="translate(457 443)">
                                                        <rect  data-name="placeholder" width="71" height="71" rx="12" fill="{{$arr[$key]}}"/>
                                                      <circle data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"></circle>
                                                      <circle data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"></circle>
                                                    </g>
                                                  </g>
                                            </svg>
                                        </span>
                                        <div class="ms-3">
                                            <h5 class="mb-1">{{$item->description}}</h5>
                                            <span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                        </div>

                                </div>
                                     @endforeach


                                     @endif


                                </div>
                            </div>
							</div >
							<div class="col-xl-12">
								<!--<div class="card "  id="user-activity">-->
								<!--	<div class="card-header border-0 pb-0 flex-wrap">-->
								<!--		<h4 class="fs-20 mb-1"> Stats</h4>-->
								<!--		<div class="card-action coin-tabs mt-3 mt-sm-0">-->

								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="card-body">-->
								<!--		<div class="pb-4 d-flex flex-wrap">-->
								<!--			<span class="d-flex align-items-center">-->
								<!--				<svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">-->
								<!--				  <rect  width="13" height="13" rx="6.5" fill="#35c556"/>-->
								<!--				</svg>-->
								<!--			       Contact-->
								<!--			</span>-->
								<!--			<span class="application d-flex align-items-center">-->
								<!--				<svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">-->
								<!--				  <rect  width="13" height="13" rx="6.5" fill="#3f4cfe"/>-->
								<!--				</svg>-->

								<!--				Users-->
								<!--			</span>-->
								<!--			<span class="application d-flex align-items-center">-->
								<!--				<svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">-->
								<!--				  <rect  width="13" height="13" rx="6.5" fill="#f34040"/>-->
								<!--				</svg>-->

								<!--			Professionals-->
								<!--			</span>-->
								<!--		</div>-->
								<!--		<div class="tab-content">-->
								<!--			<div class="tab-pane fade show active" id="Daily">-->
								<!--				<canvas id="activity" height="115"></canvas>-->
								<!--			</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--</div>-->
								
								<div class="card">
                                <div class="card-header border-0">
                                    <h4 class="fs-20 mb-3">Projects To Be Assigned</h4>

                                </div>
                                <div class="card-body loadmore-content  recent-activity-wrapper" id="RecentActivityContent">
                                    <?php $services = DB::table('multiple_estimate_professionals')->where('status',1)->where('assign_status',1)->orderby('id','desc')->limit(5)->get();?>
                                     @foreach($services as $key=>$item5)
                                     <?php $est_detail = DB::table('multiple_estimate_services')->where('id',$item5->mest_service_id)->first();?>
                                     <?php $ser_name = DB::table('services')->where('id',$est_detail->service_id)->first();?>
                                     <?php $est1 = DB::table('multiple_estimate')->where('booking_show_id',$item5->estimate_booking_id)->first();
                                              $udid=DB::table('user_data_images')->where('user_data_id',$est1->user_data_id)->first();
                                     ?>
                                     <div class="d-flex recent-activity">
                                      
                                         <span class="me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                              <circle cx="8.5" cy="8.5" r="8.5" fill="#f93a0b"></circle>
                                            </svg>
                                        </span>
                                     
                                        <img src="{{asset('public/User_data_uploads')}}/{{$udid->image}}" class="img-thumbnail" style="width:70px;height:70px;" alt="Cinque Terre">
                                      
                                        <?php $est_id = DB::table('multiple_estimate')->where('booking_show_id',$item5->estimate_booking_id)->first();?>
                                        <a href="{{ url("admin/services-view/$est_id->id") }}">
                                            <div class="ms-3">
                                            <h5 class="mb-1">{{$ser_name->name}}</h5>
                                            <span>{{Carbon\Carbon::parse($item5->created_at)->format('d M Y')}}</span>
                                        </div>
                                        </a>

                                </div>
                                     @endforeach




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
															<h2 class="mb-0">{{$estimate_count}}</h2>
															 <span class="text-success ms-3"> </span> 
														</div>
														<span class="fs-14 d-block mb-2">Jobs Done</span>
													</div>
													<div id="NewCustomers"></div>
												</div>
											</div>

                                            <div class="col-sm-6">
                                                <div class="job-icon pb-4 d-flex justify-content-between">
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <h2 class="mb-0" style="white-space: nowrap;">$<?php $sum_earning = DB::table('estimate_booking_transaction')->sum('amount');?> {{number_format($sum_earning,2)}}</h2>
                                                             <span class="text-success ms-3"> </span> 
                                                        </div>
                                                        <span class="fs-14 d-block mb-2">Month-to-Date($)</span>
                                                    </div>
                                                    <div id="NewCustomers4"><svg id="SvgjsSvg1246" width="45" height="50" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1248" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1247"><clipPath id="gridRectMaskhj41oti3"><rect id="SvgjsRect1251" width="90" height="56" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskhj41oti3"><rect id="SvgjsRect1252" width="84" height="54" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1258" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1259" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1267" class="apexcharts-grid"><g id="SvgjsG1268" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1270" x1="0" y1="0" x2="80" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1271" x1="0" y1="10" x2="80" y2="10" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1272" x1="0" y1="20" x2="80" y2="20" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1273" x1="0" y1="30" x2="80" y2="30" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1274" x1="0" y1="40" x2="80" y2="40" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1275" x1="0" y1="50" x2="80" y2="50" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1269" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1277" x1="0" y1="50" x2="80" y2="50" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1276" x1="0" y1="1" x2="0" y2="50" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1253" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG1254" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1257" d="M 0 47.5C 5.6 47.5 10.4 35 16 35C 21.6 35 26.4 47.5 32 47.5C 37.6 47.5 42.4 22.5 48 22.5C 53.6 22.5 58.4 35 64 35C 69.6 35 74.4 10 80 10" fill="none" fill-opacity="1" stroke="rgba(51,133,214,1)" stroke-opacity="1" stroke-linecap="butt" stroke-width="6" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskhj41oti3)" pathTo="M 0 47.5C 5.6 47.5 10.4 35 16 35C 21.6 35 26.4 47.5 32 47.5C 37.6 47.5 42.4 22.5 48 22.5C 53.6 22.5 58.4 35 64 35C 69.6 35 74.4 10 80 10" pathFrom="M -1 60L -1 60L 16 60L 32 60L 48 60L 64 60L 80 60"></path><g id="SvgjsG1255" class="apexcharts-series-markers-wrap" data:realIndex="0"></g></g><g id="SvgjsG1256" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1278" x1="0" y1="0" x2="80" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1279" x1="0" y1="0" x2="80" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1280" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1281" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1282" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1266" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1249" class="apexcharts-annotations"></g></svg></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <h2 class="mb-0">{{$pro_data_count}}</h2>
                                                        </div>
                                                        <span class="fs-14 d-block mb-2">Professional Data
</span>
                                                    </div>
                                                    <div id="NewCustomers5"><svg id="SvgjsSvg1117" width="100" height="50" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1119" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1118"><clipPath id="gridRectMaskow9toboeg"><rect id="SvgjsRect1122" width="110" height="56" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskow9toboeg"><rect id="SvgjsRect1123" width="104" height="54" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1129" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1130" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1138" class="apexcharts-grid"><g id="SvgjsG1139" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1141" x1="0" y1="0" x2="100" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1142" x1="0" y1="10" x2="100" y2="10" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1143" x1="0" y1="20" x2="100" y2="20" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1144" x1="0" y1="30" x2="100" y2="30" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1145" x1="0" y1="40" x2="100" y2="40" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1146" x1="0" y1="50" x2="100" y2="50" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1140" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1148" x1="0" y1="50" x2="100" y2="50" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1147" x1="0" y1="1" x2="0" y2="50" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1124" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG1125" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1128" d="M0 47.5C7 47.5 13 35 20 35C27 35 33 47.5 40 47.5C47 47.5 53 22.5 60 22.5C67 22.5 73 35 80 35C87 35 93 10 100 10C100 10 100 10 100 10 " fill="none" fill-opacity="1" stroke="rgba(183,35,173,1)" stroke-opacity="1" stroke-linecap="butt" stroke-width="6" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskow9toboeg)" pathTo="M 0 47.5C 7 47.5 13 35 20 35C 27 35 33 47.5 40 47.5C 47 47.5 53 22.5 60 22.5C 67 22.5 73 35 80 35C 87 35 93 10 100 10" pathFrom="M -1 60L -1 60L 20 60L 40 60L 60 60L 80 60L 100 60"></path><g id="SvgjsG1126" class="apexcharts-series-markers-wrap" data:realIndex="0"></g></g><g id="SvgjsG1127" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1149" x1="0" y1="0" x2="100" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1150" x1="0" y1="0" x2="100" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1151" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1152" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1153" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1137" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1120" class="apexcharts-annotations"></g></svg></div>
                                                </div>
                                            </div>
											<div class="col-sm-6">
												<div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
													<div>
														<div class="d-flex align-items-center mb-1">
															<h2 class="mb-0"><?php $count_pros = DB::table('users')->where('role_id','3')->where('state',1)->where('is_listed',1)->where('is_payment',1)->orderby('id','desc')->count(); echo $count_pros;?></h2>
														</div>
														<span class="fs-14 d-block mb-2">Registered Pros</span>
													</div>
													<div id="NewCustomers1"></div>
												</div>
											</div>

                                                
                                            </div>




									</div>
								</div>
							</div>
							<div class="card">
							    <?php $userData =  DB::table('user_data')->where('est_status','0')->orderby('id','desc')->get();?>
							    
							    
                                <div class="card-header border-0">
                                    <h4 class="fs-20 mb-3">Booking Requests</h4>

                                </div>
                                <div class="card-body loadmore-content  recent-activity-wrapper" id="RecentActivityContent">
<?php
$iterator=0;
?>
                                     @foreach($userData as $key=>$item4)
                                     @if ($iterator == 5)
        @break
    @endif
                                     <?php
                                     $project=DB::table('user_data_projectDetails')->where('user_data_id',$item4->id)->first();
                                     ?>
                                     <?php $image=DB::table('user_data_images')->where('user_data_id',$item4->id)->first() ?>
                                    @if($project)
                                        <div class="d-flex recent-activity">
                                        <span class="me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                              <circle cx="8.5" cy="8.5" r="8.5" fill="#f93a0b"></circle>
                                            </svg>
                                        </span>
                                     
                                        <img src="{{asset('public/User_data_uploads')}}/{{$image->image}}" class="img-thumbnail" style="width:70px;height:70px;" alt="Cinque Terre">
                                      
                                       
                                        <a href="{{ url("admin/view-booking/single/$project->user_data_id") }}">
                                            <div class="ms-3">
                                                <h5 class="mb-1">
                                                    <?php echo $project->Name;?>
                                                </h5>
                                                <!--<span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>-->
                                                <span>{{Carbon\Carbon::parse($project->created_at)->format('d M Y')}}</span>
                                            </div>
                                        </a>

                                </div>                                    
                                    <?php $iterator++;?>
                                    @endif
                                
                                     @endforeach




                                </div>
                            </div>
							<div class="card">
                                <div class="card-header border-0">
                                    <h4 class="fs-20 mb-3">Photos For Approval</h4>

                                </div>
                                <div class="card-body loadmore-content  recent-activity-wrapper" id="RecentActivityContent">
                                    <?php $photos_app = DB::table('multiple_estimate_professionals')->where('status',1)->where('assign_status',1)->orderby('id','desc')->limit(5)->get();?>

                                     @foreach($photos_app as $key2=>$item2)
                                     <?php $est_detail2 = DB::table('multiple_estimate_services')->where('id',$item2->mest_service_id)->first();?>
                                     <?php
                                     $project_name=DB::table('multiple_estimate')->where( 'booking_show_id',$item2->estimate_booking_id)->first();
                                     ?>
                                     <?php $ser_name2 = DB::table('services')->where('id',$est_detail2->service_id)->first();?>
                                    <?php $image=DB::table('pro_site_image')->where('booking_id',$item2->estimate_booking_id)->where('service_id',$ser_name2->id)->first();?>
                                     <div class="d-flex recent-activity">
                                      <span class="me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                              <circle cx="8.5" cy="8.5" r="8.5" fill="#f93a0b"></circle>
                                            </svg>
                                        </span>
                                     @if($image)
                                        <img src="{{asset('public/pro_site_images/')}}/{{$image->image}}" class="img-thumbnail" style="width:70px;height:70px;" alt="">
                                        @else
                                          <span>
                                       <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
                                                  <g transform="translate(-457 -443)">
                                                    <rect width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"></rect>
                                                    <g transform="translate(457 443)">
                                                        <rect  data-name="placeholder" width="71" height="71" rx="12" fill="{{$arr[$key]}}"/>
                                                      <circle data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"></circle>
                                                      <circle data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"></circle>
                                                    </g>
                                                  </g>
                                            </svg>  
                                            </span>
                                        @endif
                                        <a href="{{url("admin/service-details/$item2->id")}}">
                                            <div class="ms-3">
                                                <h5 class="mb-1">{{$project_name->title}}<span>, {{ $ser_name2->name }}</span></h5>
                                                <span>@if($item2->site_img_no!=NULL) Number of Photos <span class="text-info"><b>{{ $item2->site_img_no }}</b></span>@else <span class="text-danger">NA</span> @endif</span>
                                            </div>
                                        </a>

                                </div>
                                     @endforeach




                                </div>
                            </div>
							
							
						</div>
					</div>

				</div>
        @endsection
<script>
 var activities=@json($activityArr);
 var data=[];
   for (const key in activities) {
     data.push(activities[key]);
   }
   //console.log(data);
   var users=@json($usersArr);
var data2=[];

for (const key in users) {
     data2.push(users[key]);
   }

   var pros=@json($proArr);
var data3=[];

for (const key in pros) {
     data3.push(pros[key]);
   }
var pieChart1 = function(){
		 var options = {
          series: [parseInt('{{$user}}'), parseInt('{{$professional}}'), parseInt('{{$unlisted_pro}}')],
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
            labels: ["users", "professionals", "unlisted professionals"],
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
						first: data,
						second: data2,
						third: data3
					},

				];
				activity.height = 300;

				var config = {
					type: "line",
					data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
