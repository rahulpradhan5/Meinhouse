<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\UserOtp;
use App\Models\User;
use App\Models\ProReview;
use App\Models\ProService;
use App\Models\Notification;
use Validator;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Promocode;
use App\Models\UserAddress;
use App\Models\ProAvailability;
use App\Models\ProLead;
use App\Http\Helper\Helper;
use App\Models\UserDevice;
use App\Models\UserTransaction;
use App\Models\Custom_orders;
use DB;
use App\Models\CustomBooking;

use Mail;



class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getServiceList()
    {
        $services = Service::where('status',1)->orderBy('name','ASC')->get();

        if(count($services)>0){

        	foreach ($services as $key => $value) {
        		
        		$values['service_id'] = $value->id;
                $values['service_name'] = $value->name;
                $values['image'] = url('public/services/'.$value->service_image);
                $values['service_desc_image'] = url('public/services/'.$value->service_desc_image);
                $values['service_type'] = $value->service_type;
                $values['hour'] = $value->time;
                $values['hour_price'] = $value->price;
                $values['additional_price'] = $value->add_price;
                $values['description'] = $value->description;
                $data[] = $values;
        	}
                

                return \Response::json(['response_code' => 200,'response_message' => 'Services list fetched successfully.','result' => $data], 200);



        }else{

             return \Response::json(['response_code' => 400,'response_message' => 'No services available.'], 200);

        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popularServiceLists()
    {
        $services = Service::where('status',1)->orderBy('booking_count','DESC')->limit('10')->get();

        if(count($services)>0){

            foreach ($services as $key => $value) {
                
                $values['service_id'] = $value->id;
                $values['service_name'] = $value->name;
                $values['image'] = url('public/services/'.$value->service_image);
                $values['service_desc_image'] = url('public/services/'.$value->service_desc_image);
                $values['service_type'] = $value->service_type;
                $values['hour'] = $value->time;
                $values['hour_price'] = $value->price;
                $values['additional_price'] = $value->add_price;
                $values['description'] = $value->description;
                $data[] = $values;
            }
                

            return \Response::json(['response_code' => 200,'response_message' => 'Popular Services list fetched successfully.','result' => $data], 200);



        }else{

             return \Response::json(['response_code' => 400,'response_message' => 'No services available.'], 200);

        }
    }



    /**
     * Get Professionals list after the booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProListCopy(Request $request)
    {
           try{

            $pros = User::where('role_id',3)->limit('5')->get();
            
            if(count($pros)>0){
                
                foreach ($pros as $key => $value) {
                    $services_arr = array();
                    $service = array();
                    $reviews = array();
                    $pro_reviews = ProReview::where('pro_id',$value->id)->orderBy('stars','ASC')->get();
                    $pro_services = ProService::with('serviceDetails')->where('pro_id',$value->id)->get();

                    if(count($pro_services)>0){

                        foreach ($pro_services as $key1 => $value1) {

                             $service['name'] = $value1['serviceDetails']['name'];
                             $services_arr[] = $service; 
                        }  
                           
                         $services = implode(",", array_flatten($services_arr));
                             
                    }else{

                        $service = "NA";
                    }
                    
                    $count = count($pro_reviews);
                    if($count>0){

                        $sum = $pro_reviews->sum('stars');
                        $avg_rating = $sum/$count;
                        $rating = number_format((float)$avg_rating, 1, '.', '');

                        foreach ($pro_reviews as $key2 => $value2) {
                            
                            $review['rating'] = $value2->stars;
                            $review['review'] = $value2->reviews;
                            $review['user_name'] = $value2['userDetails']['name'];
                            $review['user_image'] = $value2['userDetails']['user_image'] ? url('pros_images/'.$value2['userDetails']['user_image']) : url('image/t3.png');
                            $reviews[] = $review;

                        }
    
                    }else{

                        $rating = "No Reviews Yet.";
                    }
                
                    $values['pro_id'] = $value->id;
                    $values['pro_name'] = $value->name;
                    $values['service_desc'] = $value->description;
                    $values['pro_image'] = $value->user_image ?  url('pros_images/'.$value->user_image) : url('image/t1.png');
                    $values['services'] = $services;
                    $values['avg_ratings'] = $rating;
                    $values['review_count'] = $count;
                    $values['reviews'] = $reviews;
                    $data[] = $values;
                }

                 return \Response::json(['response_code' => 200,'response_message' => 'Professionals List Fetched Successfully.','result'=>$data], 200);
                

                
            }else{

                 return \Response::json(['response_code' => 400,'response_message' => 'No Professionals available.'], 200);
            }
        
            

        }catch(Exception $e){

            return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getNotifications(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
        	try{
        		
        		$notifications = Notification::where('user_id',$request->user_id)->orderBy('id','DESC')->get();

        		if(count($notifications)>0){

        			foreach ($notifications as $key => $value) {

                        $values['notification_id'] = $value->id;
                        $values['type'] = $value->type;
        				$values['subject'] = $value->subject;
        				$values['message'] = $value->message;
        				$values['booking_id'] = $value->booking_id ? $value->booking_id : '';
        				$values['time'] = $value->created_at->diffForHumans();
        				$values['otp'] = $value->otp ? $value->otp : '';
        				$data[] = $values;
        			}

                 return \Response::json(['response_code' => 200,'response_message' => 'Notifications Fetched Successfully.','result'=>$data], 200);


        		}else{

                 	return \Response::json(['response_code' => 400,'response_message' => 'No notifications available.'], 200);

        		}

        	}catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookingsPost(Request $request,Helper $helper)
    {	
    	 /* Booking time
            0 = morning
            1 = midnoon
            2= afternoon
            3 = evening
        */
		/*	Address type
         	0=home,1=office,2=other
        */
        //print_r($request->all());exit;
        $validator = Validator::make($request->all(),[
            'user_id'=>'required|exists:users,id',
            'service_id'=>'required|exists:services,id',
            'address_type'=>"required",
            'name'=>'required',
            'address'=>'required',
            'locality'=>'required',
            'city'=>'required',
            'state'=>'required',
            'pin_code'=>'required',
            'date'=>'required|date', 
            'time'=>'required|max:3',
            'phone_no'=>'required',
            'timing_constraints'=>'required|max:255',
            'description'=>'required|max:1000',
            'booking_id'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
        	try{
        	    
        	  //  print_r($request->all());exit;

        		$user = User::where('id',$request->user_id)->where('role_id','2')->first();
        		if(empty($user)){

                 	return \Response::json(['response_code' => 400,'response_message' => 'Invalid User ID.'], 200);	

        		}

                $service_type = Service::where('id',$request->service_id)->first();
                // print_r($service_type);exit;
                if($service_type->service_type == 1){

                    if ($request->estm_area == '') {
                                                
                        return \Response::json(['response_code' => 400,'response_message' => 'Please enter estimated area.'], 200);
                    }
                }

                if($request->time > "3"){

                    return \Response::json(['response_code' => 400,'response_message' => 'Invalid Time.'], 200);  
                }

        		$address = $request->address.','.$request->locality.','.$request->city.','.$request->state.','.$request->pin_code;

                if($request->booking_id == 0){


            		$booking = new Booking();
            		$booking->user_id = $request->user_id;
            		$booking->service_id = $request->service_id;
            		$booking->home_type = $request->address_type;
            		$booking->address = $address;
            		$booking->name = $request->name;
            		$booking->area = $request->address;
            		$booking->locality = $request->locality;
            		$booking->city = $request->city;
            		$booking->state = $request->state;
            		$booking->pin_code = $request->pin_code;
            		$booking->date = date('d-m-Y',strtotime($request->date));
            		$booking->time = $request->time;
            		$booking->phone_no = $request->phone_no;
            		$booking->timing_constraints = $request->timing_constraints;
            		$booking->description = $request->description;
            		$booking->pro_id = 0;
            		$booking->promocode_id = $request->promocode_id ? $request->promocode_id : '0';
                    if(isset($request->estm_area)){
                        $booking->es_sqfs = $request->estm_area;
                    }
                    //Generating Random Booking ID
                    // Available alpha caracters
                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                    // generate a pin based on 2 * 7 digits + a random character
                    $pin = mt_rand(1000, 9999)
                        . $characters[rand(0, strlen($characters) - 2)]
                        . mt_rand(10, 99);

                    // shuffle the result
                    $string = str_shuffle($pin);

                    $booking->booking_show_id = 'OD-'.$string;

                    $cur_tm = Carbon::now()->toDateString();
                    //Finding pros according to service and day availability 
					$pro_service = ProService::where('service_id',$request->service_id)->whereDate('end_date','>=',$cur_tm)->pluck('pro_id');
					$pro_available = array();
					if(count($pro_service)>0){


						$day_id = date("N",strtotime($request->date));

                    	$time = $request->time;

                    	foreach ($pro_service as $key => $value) {
                            
                            $user = User::where('id',$value)->first();
                            if(isset($user)){

                            if($user->state == 1 && $user->status == 1){
                                
                                  //Day Availability
                                $pro_day_av = ProAvailability::where('pro_id',$value)->where('day_id',$day_id)->first();
                                if(isset($pro_day_av)){
                                if($pro_day_av->day_availability == 1){

                                    //Time Availability Check
                                    /*0 = morning(8-11),1 = midnoon(11-2),2= afternoon(2-5),3 = evening(5-8)*/
                                    if($time == 0){

                                        $pro_time_av = $pro_day_av->morning;
                                    }

                                    if($time == 1){

                                        $pro_time_av = $pro_day_av->midnoon;

                                    }

                                    if($time == 2){

                                        $pro_time_av = $pro_day_av->afternoon;
                                    }

                                    if($time == 3){

                                        $pro_time_av = $pro_day_av->evening;
                                    }

                                    if($time>3){

                                        return \Response::json(['response_code' => 400,'response_message' => 'Invalid Time.'], 200);

                                    }

                                    
                                    if($pro_time_av == 1){

                                        $date = date('d-m-Y',strtotime($request->date));

                                        $pro_booking = Booking::where('pro_id',$value)->where('pro_status',1)
                                        ->where('date',$date)->where('time',$time)->first();
                                    
                                        if($pro_booking == ''){

                                            $pro['pro_id'] = $value;
                                            $pro_available[] = $pro;
                                            
                                        }
                                    }   
                                }
                            }
                            }
                    	}

	                      
	                    }
	                    
	                    if(count($pro_available)<= 0){

	                    	return \Response::json(['response_code' => 400,'response_message' => 'No Professionals available .'], 200);
	                   	}
 
					}else{

                        return \Response::json(['response_code' => 400,'response_message' => 'No Professionals available .'], 200);
					}

            		if($booking->save()){

                            $service_type->booking_count = $service_type->booking_count + 1;
                            $service_type->save();
                            $booking = Booking::where('id',$booking->id)->first();

            				if($booking->time == 0){

                                $timeval = 'Morning(8-11 AM)';
                            }

                            if($booking->time == 1){

                                $timeval = 'Midnoon(11-2 PM)';
                            }

                            if($booking->time == 2){

                                $timeval = 'Afternoon(2-5 PM)';
                            }

                            if($booking->time == 3){

                                $timeval = 'Evening(5-8 PM)';
                            }

                            $message = "Your request for Service ".$booking['serviceDetails']['name']." Booked Successfully for date and time ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
            				$deviceTokens = UserDevice::where('user_id',$request->user_id)->where('notification_status',1)->pluck('device_token');
                        	$notification_id = $helper->activity_save($request->user_id,'Service Booked Successfully',$message,$booking->booking_status,$booking->id);
                            $data['notification_id'] = $notification_id;
                            $data['type'] = $booking->booking_status;
                            $data['booking_id'] = $booking->id;

                        	$helper->globalPushNotificationMultiple($deviceTokens,'Service Booked Successfully',$message,$data);

                            if(count($pro_available) > 0){

	                    		foreach ($pro_available as $key => $value1) {
	                    			//print_r($value1);exit;
	                    			$leads = new ProLead();
	                    			$leads->booking_id = $booking->id;
	                    			$leads->pro_id = $value1['pro_id'];
	                    			$leads->save();
	                    			$subject = "Booking Request For Service ".$booking['serviceDetails']['name'];
	                    			$message = $booking->name ." generate a request for service ".$booking['serviceDetails']['name']." on ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
	                    			$deviceTokens = UserDevice::where('user_id',$value1['pro_id'])->where('notification_status',1)->pluck('device_token');
		                        	$notification_id = $helper->activity_save($value1['pro_id'],$subject,$message,$booking->booking_status,$booking->id);
                                    $data['notification_id'] = $notification_id;
                                    $data['type'] = $booking->booking_status;
                                    $data['booking_id'] = $booking->id;
		                        	$helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
	                    		}
	                   		}	


    		        		$data['booking_id'] = $booking->id;
                            $data['booking_show_id'] = $booking->booking_show_id;
    		        		$data['address_type'] = $booking->home_type;
    		        		$data['name'] = $booking->name;
    		        		$data['address'] = $booking->area;
    		        		$data['locality'] = $booking->locality;
    		        		$data['city'] = $booking->city;
    		        		$data['state'] = $booking->state;
    		        		$data['pin_code'] = $booking->pin_code;
    		        		$data['service_name'] = $booking['serviceDetails']['name'];
    		        		$data['date'] = date('D,d M Y',strtotime($booking->date));
    		        		$data['time'] = $timeval;
    		        		$data['promocode'] = $booking['promocodeDetails']['code'] ?  $booking['promocodeDetails']['code'] : 'NA';
    		        		$data['promocode_discount'] = $booking['promocodeDetails']['price'] ? $booking['promocodeDetails']['price'] : 'NA';
            			
    		            	

                     	return \Response::json(['response_code' => 200,'response_message' => 'Service Booked Successfully.','result'=>$data], 200);

            		}else{

                     	return \Response::json(['response_code' => 400,'response_message' => 'Unable To Book Service.'], 200);	

            		}


                }else{

                    $booking = Booking::where('id',$request->booking_id)->first();
                    if($booking == ''){

                        return \Response::json(['response_code' => 400,'response_message' => 'Booking does not exist.'], 200);
                    }
                    $booking->user_id = $request->user_id;
                    $booking->service_id = $request->service_id;
                    $booking->home_type = $request->address_type;
                    $booking->address = $address;
                    $booking->name = $request->name;
                    $booking->area = $request->address;
                    $booking->locality = $request->locality;
                    $booking->city = $request->city;
                    $booking->state = $request->state;
                    $booking->pin_code = $request->pin_code;
                    $booking->date = date('d-m-Y',strtotime($request->date));
                    $booking->time = $request->time;
                    $booking->phone_no = $request->phone_no;
                    $booking->timing_constraints = $request->timing_constraints;
                    $booking->description = $request->description;
                    $booking->pro_id = $request->pro_id;
                    $booking->promocode_id = $request->promocode_id ? $request->promocode_id : '0';
                    $booking->booking_status = 0 ;
                    $booking->pro_status = 0;

                    //Finding pros according to service and day availability 
					$pro_service = ProService::where('service_id',$request->service_id)->pluck('pro_id');
					$pro_available = array();
					if(count($pro_service)>0){

						$day_id = date("N",strtotime($request->date));

                    	$time = $request->time;

                    	foreach ($pro_service as $key => $value) {
                        
	                        //Day Availability
	                        $pro_day_av = ProAvailability::where('pro_id',$value)->where('day_id',$day_id)->first();
	                        
	                        if($pro_day_av->day_availability == 1){

	                            //Time Availability Check
	                            /*0 = morning(8-11),1 = midnoon(11-2),2= afternoon(2-5),3 = evening(5-8)*/
	                            if($time == 0){

	                                $pro_time_av = $pro_day_av->morning;
	                            }

	                            if($time == 1){

	                                $pro_time_av = $pro_day_av->midnoon;

	                            }

	                            if($time == 2){

	                                $pro_time_av = $pro_day_av->afternoon;
	                            }

	                            if($time == 3){

	                                $pro_time_av = $pro_day_av->evening;
	                            }

	                            if($time>3){

	                                return \Response::json(['response_code' => 400,'response_message' => 'Invalid Time.'], 200);

	                            }

	                            
	                            if($pro_time_av == 1){

	                                $date = date('d-m-Y',strtotime($request->date));

	                                $pro_booking = Booking::where('pro_id',$value)->where('pro_status',1)
	                                ->where('date',$date)->where('time',$time)->first();
	                            
	                                if($pro_booking == ''){

	                                    $pro['pro_id'] = $value;
	                                    $pro_available[] = $pro;
	                                    
	                                }
	                            }   
	                        }
	                    }
	                    
	                    if(count($pro_available)<= 0){

	                    	return \Response::json(['response_code' => 400,'response_message' => 'No Professionals available .'], 200);
	                   	}
 
					}else{

                        return \Response::json(['response_code' => 400,'response_message' => 'No Professionals available .'], 200);
					}

                    if($booking->save()){

                    $service_type = Service::where('id',$request->service_id)->first();
                    $service_type->booking_count = $service_type->booking_count + 1;
                    $service_type->save();

                    $booking = Booking::where('id',$booking->id)->first();

                        if($booking->time == 0){

                            $timeval = 'Morning(8-11 AM)';
                        }

                        if($booking->time == 1){

                            $timeval = 'Midnoon(11-2 PM)';
                        }

                        if($booking->time == 2){

                            $timeval = 'Afternoon(2-5 PM)';
                        }

                        if($booking->time == 3){

                            $timeval = 'Evening(5-8 PM)';
                        }

                        $message = "Your request for Service ".$booking['serviceDetails']['name']." Booked Successfully for date and time ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
                        $deviceTokens = UserDevice::where('user_id',$request->user_id)->where('notification_status',1)->pluck('device_token');
                        $notification_id = $helper->activity_save($request->user_id,'Service Booked Successfully',$message,$booking->booking_status,$booking->id);
                        $data['notification_id'] = $notification_id;
                        $data['type'] = $booking->booking_status;
                        $data['booking_id'] = $booking->id;

                        $helper->globalPushNotificationMultiple($deviceTokens,'Service Booked Successfully',$message,$data);


                    	   if(count($pro_available) > 0){

	                    		foreach ($pro_available as $key => $value1) {
	                    			//print_r($value1);exit;
	                    			$leads = new ProLead();
	                    			$leads->booking_id = $booking->id;
	                    			$leads->pro_id = $value1['pro_id'];
	                    			$leads->save();
                                    $subject = "Booking Request For Service ".$booking['serviceDetails']['name'];
                                    $message = $booking->name ." generate a request for service ".$booking['serviceDetails']['name']." on ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
                                    $deviceTokens = UserDevice::where('user_id',$value1['pro_id'])->where('notification_status',1)->pluck('device_token');
                                    $notification_id = $helper->activity_save($value1['pro_id'],$subject,$message,$booking->booking_status,$booking->id);
                                    $data['notification_id'] = $notification_id;
                                    $data['type'] = $booking->booking_status;
                                    $data['booking_id'] = $booking->id;
                                    $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
	                    		}
	                   		}


                            $data['booking_id'] = $booking->id;
                            $data['booking_show_id'] = $booking->booking_show_id;
                            $data['address_type'] = $booking->home_type;
                            $data['name'] = $booking->name;
                            $data['address'] = $booking->area;
                            $data['locality'] = $booking->locality;
                            $data['city'] = $booking->city;
                            $data['state'] = $booking->state;
                            $data['pin_code'] = $booking->pin_code;
                            $data['pro_name'] = $booking['proDetails']['name'] ? $booking['proDetails']['name'] : '';
                            $data['service_name'] = $booking['serviceDetails']['name'];
                            $data['date'] = date('D,d M Y',strtotime($booking->date));
                            $data['time'] = $timeval;
                            $data['promocode'] = $booking['promocodeDetails']['code'] ?  $booking['promocodeDetails']['code'] : 'NA';
                            $data['promocode_discount'] = $booking['promocodeDetails']['price'] ? $booking['promocodeDetails']['price'] : 'NA';
                        
                        return \Response::json(['response_code' => 200,'response_message' => 'Booking Updated Successfully.','result'=>$data], 200);

                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Unable To Update Booking.'], 200);  

                    }

                }

        		
        	}catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookingsList(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id'=>'required|numeric|exists:users,id',
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {	

        	/* 	
        		Booking Status
        		0=pending,1=confirmed,2=pro_cancelled,3=user_cancelled,5=completed 
        	*/
        	
        	$user_status = User::where('id',$request->user_id)->first();
                
                if(isset($user_status)){
                    
                    if($user_status->status != 1){
                        
                        return \Response::json(['response_code' => 402,'response_message' => 'You are Blocked By Admin.'], 200);
                    }
                }

        	$user = User::where('id',$request->user_id)->where('role_id','2')->first();
    		if(empty($user)){

             	return \Response::json(['response_code' => 400,'response_message' => 'You are not a user.'], 200);	

    		}


        	$bookings = Booking::where('user_id',$request->user_id)->orderBy('updated_at','DESC')->get();
        	if(count($bookings)>0){

        		foreach ($bookings as $key => $value) {

	        			if($value->time == 0){

                            $timeval = 'Morning(08:00 AM - 11:00 AM)';
                            $end_time = '11:00:00';
                        }

                        if($value->time == 1){

                            $timeval = 'Midnoon(11:00 AM - 02:00 PM)';
                            $end_time = '14:00:00';
                        }

                        if($value->time == 2){

                            $timeval = 'Afternoon(02:00 PM - 05:00 PM)';
                            $end_time = '17:00:00';
                        }

                        if($value->time == 3){

                            $timeval = 'Evening(05:00 PM - 08:00 PM)';
                            $end_time = '20:00:00'; 
                        }

                    if($value->booking_status == 2){

                        $time = $value->time;
                        $book_date = $value->date.' '.$end_time;
                        $book_parse_date = Carbon::parse($book_date);
                        $current_time = Carbon::parse(Carbon::now());

                        $date1 = strtotime($current_time);
                        $date2 = strtotime($book_parse_date);
                        
                        if($date1 > $date2){
                            
                            $value->booking_status = "4";   
                            $value->save();
                        }

                    }

	        		$data['booking_id'] = strval($value->id);
                    $data['booking_show_id'] = $value->booking_show_id ? $value->booking_show_id : '';
                    $data['phone_number'] = $value->phone_no ? $value->phone_no : '';
                    $data['timing_constraints'] = $value->timing_constraints ? $value->timing_constraints : '';
                    $data['description'] = $value->description ? $value->description : '';
	        		$data['name'] = $value->name != '' ? $value->name:'';
	        		$data['address'] = $value->area != '' ? $value->area:'';
                    $data['address_type'] = $value->home_type != '' ? $value->home_type:'';
	        		$data['locality'] = $value->locality != '' ? $value->locality:'';
	        		$data['city'] = $value->city != '' ? $value->city:'';
	        		$data['state'] = $value->state != '' ? $value->state:'';
	        		$data['pin_code'] = $value->pin_code != '' ? $value->pin_code:'';
                    $data['pro_id'] = $value->pro_id ? $value->pro_id : '';
	        		$data['pro_name'] = $value['proDetails']['name'] ? $value['proDetails']['name'] : '';
                    $data['service_type'] = $value['serviceDetails']['service_type'];
                    $data['service_id'] = $value['serviceDetails']['id'] ? $value['serviceDetails']['id'] : '';
	        		$data['service_name'] = $value['serviceDetails']['name'] ? $value['serviceDetails']['name'] : '';
	        		$data['service_time'] = $value['serviceDetails']['time'] ? $value['serviceDetails']['time'] : '';
	        		$data['service_price'] = $value['serviceDetails']['price'] ? $value['serviceDetails']['price'] : '';
	        		$data['service_add_price'] = $value['serviceDetails']['add_price'] ? $value['serviceDetails']['add_price'] : '';
                    $data['promocode'] = $value['promocodeDetails']['code'] ? $value['promocodeDetails']['code'] : '';
                    $data['promocode_id'] = $value['promocodeDetails']['id'] ? $value['promocodeDetails']['id'] : 0;
                    $data['promocode_discount'] = $value['promocodeDetails']['price'] ? $value['promocodeDetails']['price'] : '';
                    $data['booking_date'] = $value->date;
                    $data['booking_time'] = $value->time;
	        		$data['date'] = date('D,d M Y',strtotime($value->date));
	        		$data['time'] = $timeval;
	        		$data['status'] = $value->booking_status;
	        		$data['custom_booking'] = $value->custom_booking;
	        		$data['amount'] = $value->amount;
	        		$booking_data[] = $data;

	        	}

           	 	return \Response::json(['response_code' => 200,'response_message' => 'Bookings List Fetched Successfully.','result'=>$booking_data], 200);
        	}else{

           	 	return \Response::json(['response_code' => 400,'response_message' => 'No Bookings Yet.'], 200);	
			}
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPromocodes()
    {	
    	$date = Carbon::now()->toDateString();
        $promocodes = Promocode::where('status',1)->whereDate('start_date','<=',$date)->whereDate('end_date','>=',$date)->orderBy('id','DESC')->get();

        if(count($promocodes)>0){

        	foreach ($promocodes as $key => $value) {

				$values['promocode_id'] = $value->id;	
				$values['name'] = $value->name;
                $values['description'] = $value->description ? $value->description : '';
				$values['code'] = $value->code;
				$values['discount'] = $value->price;
				$values['start_date'] = date('d-m-Y',strtotime($value->start_date));
				$values['end_date'] = date('d-m-Y',strtotime($value->end_date));
                $values['promo_image'] = $value->promo_image ? url('/promo_image/'.$value->promo_image ) : url('/promo_image/default.png') ;
				$data[] = $values;
			}
           	 	return \Response::json(['response_code' => 200,'response_message' => 'Promocode List Fetched Successfully.','result'=>$data], 200);


        }else{

           	return \Response::json(['response_code' => 400,'response_message' => 'No Promocodes Available.'], 200);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applyPromocode(Request $request)
    {
       
    	$validator = Validator::make($request->all(),[
            'user_id'=>'required|numeric|exists:users,id',
            'code'	 =>'required|alpha_num',
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {	

        	try{

        		$promocode = Promocode::where('code',$request->code)->first();

        		if(isset($promocode)){

        			$data['promocode_id'] = $promocode->id;
        			$data['code'] = $promocode->code;
        			$data['discount'] = $promocode->price;

           	 		return \Response::json(['response_code' => 200,'response_message' => 'Promocode Applied Successfully.','result'=>$data], 200);

        		}else{

           	 		return \Response::json(['response_code' => 400,'response_message' => 'Promocode Not Available.'], 200);

        		}

        	}catch(Excecption $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
        }
        
    }


    /**
     * Fetch the address.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAddress(Request $request)
    {	

    	$validator = Validator::make($request->all(),[
            'user_id'=>'required|numeric|exists:users,id',
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {	

        	try{

        		$addresses = UserAddress::where('user_id',$request->user_id)->orderBy('id','DESC')->get();

        		if(count($addresses)>0){

        			foreach ($addresses as $key => $value) {

						$values['address_id'] = $value->id;
						$values['address_type'] = $value->address_type;
						$values['name'] = $value->name != '' ? $value->name:'NA';
		        		$values['address'] = $value->area != '' ? $value->area:'NA';
		        		$values['locality'] = $value->locality != '' ? $value->locality:'NA';
		        		$values['city'] = $value->city != '' ? $value->city:'NA';
		        		$values['state'] = $value->state != '' ? $value->state:'NA';
		        		$values['pin_code'] = $value->pin_code != '' ? $value->pin_code:'NA';
		        		$values['is_primary'] = $value->primary;
						$data[] = $values;
					}
           	 		
           	 		return \Response::json(['response_code' => 200,'response_message' => 'Address List Fetched Successfully.','result'=>$data], 200);


        		}else{

           			return \Response::json(['response_code' => 400,'response_message' => 'No Address Available.'], 200);

        		}

        	}catch(Exception $e){

               return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
        }
        
        
    }

    /**
     * Add the address.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addAddress(Request $request)
    {	

    	$validator = Validator::make($request->all(),[
            'user_id'=>'required|numeric|exists:users,id',
            'name'=>'required',
            'address'=>'required',
            'locality'=>'required',
            'city'=>'required',
            'state'=>'required',
            'pin_code'=>'required',
            'is_primary'=>'required',
            'address_type'=>'required',
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {	

        	try{

        		if($request->is_primary == 1){

        			$addresses = UserAddress::where('user_id',$request->user_id)->get();

        			if(count($addresses)>0){

        				foreach ($addresses as $key => $value) {
        					
        					$value->primary = 0;
        					$value->save();
        				}
        			}
        		}

        		if($request->address_id != 0){

        			$address = UserAddress::where('id',$request->address_id)->where('user_id',$request->user_id)->first();
	        		$address->user_id = $request->user_id;
	        		$address->address_type = $request->address_type;
	        		$address->name = $request->name;
	        		$address->area = $request->address;
	        		$address->locality = $request->locality;
	        		$address->city = $request->city;
	        		$address->state = $request->state;
	        		$address->pin_code = $request->pin_code;
	        		$address->primary = $request->is_primary;

        			
        		}else{

        			$address = new UserAddress();
	        		$address->user_id = $request->user_id;
	        		$address->address_type = $request->address_type;
	        		$address->name = $request->name;
	        		$address->area = $request->address;
	        		$address->locality = $request->locality;
	        		$address->city = $request->city;
	        		$address->state = $request->state;
	        		$address->pin_code = $request->pin_code;
	        		$address->primary = $request->is_primary;

        		}


        		if($address->save()){

           	 		return \Response::json(['response_code' => 200,'response_message' => 'Address Added Successfully.'], 200);


        		}else{

           			return \Response::json(['response_code' => 400,'response_message' => 'Unable To Add Address.'], 200);

        		}

        	}catch(Exception $e){

               return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
        }
        
        
    }

    /**
     * Get Professionals list after the booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProList(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_id' => 'required|numeric|exists:services,id',
            'date'=>'required|date',
            'time'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
            try{

            	if(isset($request->pro_id)){

            		$pro_service = ProService::where('service_id',$request->service_id)->where('pro_id','!=',$request->pro_id)->pluck('pro_id');

            	}else{

                	$pro_service = ProService::where('service_id',$request->service_id)->pluck('pro_id');
                	
            	}

                $pro_available = array();
                if(count($pro_service)>0){

                    $day_id = date("N",strtotime($request->date));

                    $time = $request->time;
                    
                    foreach ($pro_service as $key => $value) {
                        
                        //Day Availability
                        $pro_day_av = ProAvailability::where('pro_id',$value)->where('day_id',$day_id)->first();
                        
                        if($pro_day_av->day_availability == 1){

                            //Time Availability Check
                            /*0 = morning(8-11),1 = midnoon(11-2),2= afternoon(2-5),3 = evening(5-8)*/
                            if($time == 0){

                                $pro_time_av = $pro_day_av->morning;
                            }

                            if($time == 1){

                                $pro_time_av = $pro_day_av->midnoon;

                            }

                            if($time == 2){

                                $pro_time_av = $pro_day_av->afternoon;
                            }

                            if($time == 3){

                                $pro_time_av = $pro_day_av->evening;
                            }

                            if($time>3){

                                return \Response::json(['response_code' => 400,'response_message' => 'Invalid Time.'], 200);

                            }

                            
                            if($pro_time_av == 1){

                                $date = date('d-m-Y',strtotime($request->date));

                                $pro_booking = Booking::where('pro_id',$value)->where('pro_status',1)
                                ->where('date',$date)->where('time',$time)->first();
                            
                                if($pro_booking == ''){

                                    $pro['pro_id'] = $value;
                                    $pro_available[] = $pro;
                                }
                            }
                            
                            
                        }
                    }
                    
                    if(count($pro_available)>0){

                        foreach ($pro_available as $key => $value) {
                            
                            $services_arr = array();
                            $service = array();
                            $reviews = array();
                            $pro_reviews = ProReview::where('pro_id',$value)->orderBy('stars','ASC')->get();
                            $pro_services = ProService::with('serviceDetails')->where('pro_id',$value)->get();

                            //Fetching All The services
                            if(count($pro_services)>0){

                                foreach ($pro_services as $key1 => $value1) {

                                     $service['name'] = $value1['serviceDetails']['name'];
                                     $services_arr[] = $service; 
                                }  
                                   
                                $services = implode(",", array_flatten($services_arr));
                                     
                            }else{

                                $service = "NA";
                            }


                            $count = count($pro_reviews);
                            if($count>0){

                                $sum = $pro_reviews->sum('stars');
                                $avg_rating = $sum/$count;
                                $rating = number_format((float)$avg_rating, 1, '.', '');

                                foreach ($pro_reviews as $key2 => $value2) {
                                    
                                    $review['rating'] = $value2->stars;
                                    $review['review'] = $value2->reviews;
                                    $review['user_name'] = $value2['userDetails']['name'];
                                    $review['user_image'] = $value2['userDetails']['user_image'] ? url('pros_images/'.$value2['userDetails']['user_image']) : url('image/t3.png');
                                    $reviews[] = $review;

                                }
            
                            }else{

                                $rating = "No Reviews Yet.";
                            }

                            $pro_detail = User::where('id',$value)->first();
                            $values['pro_id'] = $value['pro_id'];
                            $values['pro_name'] = $pro_detail->name;
                            $values['service_desc'] = $pro_detail->description;
                            $values['pro_image'] =  $pro_detail->user_image ? url('pros_images/'.$pro_detail->user_image) : url('image/t1.png');
                            $values['services'] = $services;
                            $values['avg_ratings'] = $rating;
                            $values['review_count'] = $count;
                            $values['reviews'] = $reviews;
                            $data[] = $values;

                        }

                        return \Response::json(['response_code' => 200,'response_message' => 'Professionals List Fetched Successfully.','result'=>$data], 200);


                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'No Professionals available .'], 200);
                    }
                    
                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'No Professionals available for this service.'], 200);

                }


            }catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }
        }
    }


     /**
     *User cancellation of booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelBooking(Request $request,Helper $helper)
    {
        $validator = Validator::make($request->all(),[
            'booking_id' => 'required|numeric|exists:bookings,id',
            'cancel_reason' => 'nullable'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
        	try{

        		$booking = Booking::where('id',$request->booking_id)->first();

        		if($booking->booking_status == 5){

                   return \Response::json(['response_code' => 200,'response_message' => 'Booking is completed.You can not cancel it now.'], 200);

        		}

                if($booking->booking_status == 6){

                   return \Response::json(['response_code' => 200,'response_message' => 'Booking can not be cancelled as service is already started'], 200);

                }

                if($booking->booking_status == 1){

                    $subject = $booking['serviceDetails']['name'] . " is cancelled successfully.";
                    $message = "Your booking service scheduled on .".date('D,d M Y',strtotime($booking->date))." is being cancelled and your account has been debited with $25. ";
                    $deviceTokens = UserDevice::where('user_id',$booking->user_id)->where('notification_status',1)->pluck('device_token');
                    $notification_id = $helper->activity_save($booking->user_id,$subject,$message,$booking->booking_status,$booking->id);
                    $data['notification_id'] = $notification_id;
                    $data['type'] = 3;
                    $data['booking_id'] = $booking->id;
                    $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
                }
        		$booking->booking_status = 3;
        		$booking->pro_status = 3;
                $booking->cancel_reason = $request->cancel_reason;


        		if($booking->save()){

                    $pro_booking = ProLead::where('booking_id',$booking->id)->whereIn('status',array(0,1))->get();
                    if(count($pro_booking)>0){
                    $booking = Booking::where('id',$booking->id)->first();
                        foreach ($pro_booking as $key => $value) {
                           
                           $value->status = 3;
                           $value->save();

                            $subject = $booking['serviceDetails']['name'] . " is cancelled by ".$booking['userDetails']['name'];
                            $message = "Your booking service scheduled on .".date('D,d M Y',strtotime($booking->date))." is being cancelled by ".$booking['userDetails']['name'];
                            $deviceTokens = UserDevice::where('user_id',$value->pro_id)->where('notification_status',1)->pluck('device_token');
                            $notification_id = $helper->activity_save($value->pro_id,$subject,$message,$booking->booking_status,$booking->id);
                            $data['notification_id'] = $notification_id;
                            $data['type'] = $booking->booking_status;
                            $data['booking_id'] = $booking->id;
                            $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
                        }
                    }

                    return \Response::json(['response_code' => 200,'response_message' => 'Booking cancelled successfully.'], 200);

        		}else{

                    return \Response::json(['response_code' => 400,'response_message' => 'Unable to cancel the booking.'], 200);

        		}

        	}catch(Excption $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id'=>'required|numeric|exists:users,id',
            'name'=>'required|max:60|min:3',
            'phone_no'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {   
            try{


            $user = User::where('id',$request->user_id)->where('role_id','2')->first();
            if(empty($user)){

                return \Response::json(['response_code' => 400,'response_message' => 'You are not a user.'], 200);  

            }


            $user->name = $request->name;
            $user->phone = $request->phone_no;


            if ($files = $request->file('profile_image')) {
                // Define upload path
               $destinationPath = public_path('/pros_images/'); // upload path
                // Upload Orginal Image 
                $input['name']=time().'.'.$files->getClientOriginalExtension();
               $files->move($destinationPath,$input['name']);
                // Save In Database 
               $user->user_image=$input['name'];       
            }


            if($user->save()){

                $data['profile_image'] = $user['user_image'] ?  url('pros_images/'.$user['user_image']) : url('/pros_images/user-dump.png');
                
                return \Response::json(['response_code' => 200,'response_message' => 'Profile Updated Successfully.','result'=>$data], 200);

            }else{

                return \Response::json(['response_code' => 400,'response_message' => 'Unable to update profile.'], 200);

            }
                  

            }catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }


       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeNotificationStatus(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric',
            'status' =>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
        	try{
        		
        		$user = User::where('id',$request->user_id)->first();

        		if(isset($user)){

        			$user->notification_status = $request->status;
        			$user->save();

                    $notifications = UserDevice::where('user_id',$request->user_id)->update(['notification_status'=>$request->status]);

                 return \Response::json(['response_code' => 200,'response_message' => 'Notifications Status Changed Successfully.','notification_status'=>$user->notification_status], 200);		


        		}else{

                 	return \Response::json(['response_code' => 400,'response_message' => 'Not a user.'], 200);

        		}

        	}catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserDetails(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id'=>'required|numeric|exists:users,id'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {   
            try{


            $user = User::where('id',$request->user_id)->where('role_id','2')->first();
            if(empty($user)){

                return \Response::json(['response_code' => 400,'response_message' => 'You are not a user.'], 200);  

            }
            $address = UserAddress::where('user_id',$user['id'])->where('primary',1)->first();
            $payments = array();
            $payment = Booking::where('user_id',$user['id'])->where('booking_status',5)->first();
            if(isset($payment)){
                    $payments['payment'] = '1';
                    $payments['booking_id'] = $payment->id;
                    $payments['booking_status'] = $payment->booking_status;
            }else{
                    $payments['payment'] = '0';
                    $payments['booking_id'] = '';
                    $payments['booking_status'] = '';
            }
            $data['user_id'] = $user['id'];
            $data['name']=$user['name'];
            $data['email']=$user['email'];
            $data['phone']=$user['phone'];
            $data['profile_image']=$user['user_image'] ?  url('pros_images/'.$user['user_image']) : url('/pros_images/user-dump.png');
            $data['address_id']=$address['id'] ? $address['id'] : '';
            $data['address_name']=$address['name'] ? $address['name'] : '';
            $data['address_type']=isset($address['address_type']) ? $address['address_type'] : '';
            $data['address']=$address['area'] ? $address['area'] : '';
            $data['locality']=$address['locality'] ? $address['locality'] : '';
            $data['city']=$address['city'] ? $address['city'] : '';
            $data['state']=$address['state'] ? $address['state'] : '';
            $data['pin_code']=$address['pin_code'] ? $address['pin_code'] : '';
            $data['customer_id']=$user['customer_id'];
            $data['is_payment'] = $payments ? $payments : (object)[];

            return \Response::json(['response_code' => 200,'response_message' => 'User Details Fetched  Successfully.','user_data' => $data], 200);

            }catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

    /**
     * Save reviews of a user for a pro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postProReviews(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric|exists:users,id',
            'pro_id' =>'required|numeric|exists:users,id',
            'stars' =>'required',
            'reviews'=>'required'
            ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
            try{
                
                    $reviews = new ProReview();
                    $reviews->user_id = $request->user_id;
                    $reviews->pro_id = $request->pro_id;
                    $reviews->reviews = $request->reviews;
                    $reviews->stars = $request->stars;

                    $reviews->save();

                 return \Response::json(['response_code' => 200,'response_message' => 'Thanks for giving your reviews.'], 200);        


            }catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

     /**
     * Save transaction details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postTransaction(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric|exists:users,id',
            'booking_id' =>'required|numeric|exists:bookings,id',
            'transaction_id' =>'required',
            'customer_id'=>'required',
            'amount'=>'required'

            ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
            try{
                    $booking = Booking::where('id',$request->booking_id)->where('user_id',$request->user_id)->where('booking_status',5)->first();
                    if(isset($booking)){

                        $transaction = new UserTransaction();
                        $transaction->user_id = $request->user_id;
                        $transaction->booking_id = $request->booking_id;
                        $transaction->transaction_id = $request->transaction_id;
                        $transaction->amount = $request->amount;
                        $transaction->save();

                        $booking->booking_status = 7;
                        $booking->save();

                        $user = User::where('id',$request->user_id)->first();
                        $user->customer_id = $request->customer_id;
                        $user->save();

                        return \Response::json(['response_code' => 200,'response_message' => 'Transaction completed','is_payment' => '1'], 200);  

                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Unable to do payment.','is_payment' => '0'], 200);  
                    }

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }


       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteNotification(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'notification_id' => 'required|numeric',
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
            try{
                
                $notification = Notification::where('id',$request->notification_id)->first();

                if(isset($notification)){

                    $notification->delete();

                 return \Response::json(['response_code' => 200,'response_message' => 'Notification Deleted  Successfully.'], 200);        


                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'Notification does not exist.'], 200);

                }

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }


    /**
     * Save transaction details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingDetails(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric|exists:users,id',
            'booking_id' =>'required|numeric|exists:bookings,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
            try{
                    $booking = Booking::where('id',$request->booking_id)->first();
                    if(isset($booking)){
                        
                        if(isset($booking->pro_id)){
                            
                            $count = Booking::where('pro_id',$booking->pro_id)->where('booking_status',7)->count();
                            $review_avg = ProReview::where('pro_id',$booking->pro_id)->orderBy('id','DESC')->avg('stars');
                        }else{
                            $count = '0';
                            $review_avg = '4.5';
                        }
                        
                        

                        if($booking->time == 0){

                            $timeval = 'Morning(8-11 AM)';
                        }

                        if($booking->time == 1){

                            $timeval = 'Midnoon(11-2 PM)';
                        }

                        if($booking->time == 2){

                            $timeval = 'Afternoon(2-5 PM)';
                        }

                        if($booking->time == 3){

                            $timeval = 'Evening(5-8 PM)';
                        }

                            $data['booking_id'] = strval($booking->id);
                            $data['booking_show_id'] = $booking->booking_show_id ? $booking->booking_show_id : '';
                            $data['phone_number'] = $booking->phone_no ? $booking->phone_no : '';
                            $data['timing_constraints'] = $booking->timing_constraints ? $booking->timing_constraints : '';
                            $data['description'] = $booking->description ? $booking->description : '';
                            $data['name'] = $booking->name != '' ? $booking->name:'';
                            $data['address'] = $booking->area != '' ? $booking->area:'';
                            $data['address_type'] = $booking->home_type != '' ? $booking->home_type:'';
                            $data['locality'] = $booking->locality != '' ? $booking->locality:'';
                            $data['city'] = $booking->city != '' ? $booking->city:'';
                            $data['state'] = $booking->state != '' ? $booking->state:'';
                            $data['pin_code'] = $booking->pin_code != '' ? $booking->pin_code:'';
                            $data['pro_id'] = $booking->pro_id ? $booking->pro_id : '';
                            $data['pro_name'] = $booking['proDetails']['name'] ? $booking['proDetails']['name'] : '';
                            $data['jobs_done'] = $count ? $count : '';
                            $data['pro_review'] = $review_avg ? $review_avg : '4.5';
                            $data['pro_image'] = $booking['proDetails']['user_image'] ? url('pros_images/'.$booking['proDetails']['user_image']) : url('pros_images/user_dump.png');
                            $data['pro_contact_no'] = $booking['proDetails']['phone'] ? $booking['proDetails']['phone'] : '';
                            $data['service_id'] = $booking['serviceDetails']['service_type'];
                            $data['service_id'] = $booking['serviceDetails']['id'] ? $booking['serviceDetails']['id'] : '';
                            $data['service_type'] = $booking['serviceDetails']['name'] ? $booking['serviceDetails']['service_type'] : '';
                            $data['service_name'] = $booking['serviceDetails']['name'] ? $booking['serviceDetails']['name'] : '';
                            $data['service_time'] = $booking['serviceDetails']['time'] ? $booking['serviceDetails']['time'] : '';
                            $data['service_price'] = $booking['serviceDetails']['price'] ? $booking['serviceDetails']['price'] : '';
                            $data['service_add_price'] = $booking['serviceDetails']['add_price'] ? $booking['serviceDetails']['add_price'] : '';
                            $data['promocode'] = $booking['promocodeDetails']['code'] ? $booking['promocodeDetails']['code'] : '';
                            $data['promocode_id'] = $booking['promocodeDetails']['id'] ? $booking['promocodeDetails']['id'] : 0;
                            $data['promocode_discount'] = $booking['promocodeDetails']['price'] ? $booking['promocodeDetails']['price'] : '';
                            $data['booking_date'] = $booking->date;
                            $data['booking_time'] = $booking->time;
                            $data['date'] = date('D,d M Y',strtotime($booking->date));
                            $data['time'] = $timeval;
                            $data['status'] = $booking->booking_status;
                            $data['total_service_time'] = $booking->total_service_time ? gmdate("H:i",  $booking->total_service_time) : '';
                            $data['estm_area'] = $booking->es_sqfs ? $booking->es_sqfs : '';
                            $data['total_area'] = $booking->total_sqfs ? $booking->total_sqfs : '';
                            $data['amount'] = $booking->amount;
                            $data['otp'] = $booking->otp;
                            $data['pdf'] = $booking->pdf ? url('public/invoices/'.$booking->pdf) : '';
                            $booking_data[] = $data;

                        return \Response::json(['response_code' => 200,'response_message' => 'Booking details fetched successfully.','result' => $booking_data], 200);  

                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Booking doesnt exist'], 200);  
                    }

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }
    
    // By Shashank
    public function mail_send(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'images'=>'required',
            'images.*'=> 'image|mimes:jpeg,png,jpg|max:2048'    
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {   
            //print_r($request->all());exit;
            if ($files = $request->file('images')) 
            {
                foreach($request->file('images') as $image)
                {
                    $destinationPath = public_path('/images/');
                    $input['name']=time().'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath,$input['name']);
                
                $custom = new Custom_orders;
                $custom->image_name = $input['name'];
                $custom->user_id = $request->user_id;
                $custom->save();
                }
            }else{
                echo "image error";
                die();
            }
            
            try
            {
                $path =asset('image/');
                $mailto = "aayushiquantum@gmail.com";
                $from_mail = "test@mail.com";
                $subject = "My subject";
                $uid = $request->user_id;
                $data = DB::table('custom_orders')->where('user_id', $uid)->get();
               
                $message = "<p>This is final testing</p><br />Your attachment is .";               
                $message .= "<table><tr>";
                foreach($data as $d)
                {
                    $message .="<th><img src='".$path."/".$d->image_name."' style='height:100px; weight:100px;'></th>";
                   
                }
                $message .="</tr></table>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From:".$from_mail;
    
                if(mail($mailto,$subject,$message,$headers))
        	    { 
                    return \Response::json(['response_code' => 200,'response_message' => 'Booked Successfully.'], 200);
        	    }
        	    else
        	    {
        	        return \Response::json(['response_code' => 400,'response_message' => 'Not Working'], 400);
        	    }
            }
            catch(Exception $e)
            {
                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }
    // By shashank ends here

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function custombookingsPost(Request $request,Helper $helper)
    {	
    	 /* Booking time
            0 = morning
            1 = midnoon
            2= afternoon
            3 = evening
        */
		/*	Address type
         	0=home,1=office,2=other
        */
      // print_r($request->all());exit;
        $validator = Validator::make($request->all(),[
            'user_id'=>'required|exists:users,id',
            'service_id'=>'required',
            'address_type'=>"required",
            'name'=>'required',
            'address'=>'required',
            'locality'=>'required',
            'city'=>'required',
            'state'=>'required',
            'pin_code'=>'required',
            'date'=>'required|date', 
            'time'=>'required|max:3',
            'phone_no'=>'required',
            'email_id'=>'required|email',
            'description'=>'required|max:1000',
            'price'=>'required',
            'images'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
        	try{
        	    
        	 // print_r($request->all());exit;

        		$user = User::where('id',$request->user_id)->where('role_id','2')->first();
        		if(empty($user)){

                 	return \Response::json(['response_code' => 400,'response_message' => 'Invalid User ID.'], 200);	

        		}

                $service_type = Service::where('id',$request->service_id)->first();
                // print_r($service_type);exit;
                if($service_type->service_type == 1){

                    if ($request->estm_area == '') {
                                                
                        return \Response::json(['response_code' => 400,'response_message' => 'Please enter estimated area.'], 200);
                    }
                }

                if($request->time > "3"){

                    return \Response::json(['response_code' => 400,'response_message' => 'Invalid Time.'], 200);  
                }

        		$address = $request->address.','.$request->locality.','.$request->city.','.$request->state.','.$request->pin_code;

                


            		$booking = new CustomBooking();
            		$booking->user_id = $request->user_id;
            		$booking->service_id = $request->service_id;
            		$booking->home_type = $request->address_type;
            		$booking->address = $address;
            		$booking->name = $request->name;
            		$booking->area = $request->address;
            		$booking->locality = $request->locality;
            		$booking->city = $request->city;
            		$booking->state = $request->state;
            		$booking->pincode = $request->pin_code;
            		$booking->date = date('d-m-Y',strtotime($request->date));
            		$booking->time = $request->time;
            		$booking->phone_no = $request->phone_no;
            		$booking->timing_constraints = $request->timing_constraints;
            		$booking->description = $request->description;
            		$booking->pro_id = 0;
            		$booking->amount = $request->price;
            		$booking->email = $request->email_id;
                    if(isset($request->estm_area)){
                        $booking->es_sqfs = $request->estm_area;
                    }
                    //Generating Random Booking ID
                    // Available alpha caracters
                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                    // generate a pin based on 2 * 7 digits + a random character
                    $pin = mt_rand(1000, 9999)
                        . $characters[rand(0, strlen($characters) - 2)]
                        . mt_rand(10, 99);

                    // shuffle the result
                    $string = str_shuffle($pin);

                    $booking->booking_show_id = 'OD-'.$string;

                    $cur_tm = Carbon::now()->toDateString();					

            		if($booking->save()){
            		    
            		    if($request->hasFile('images'))
                            {
                                $names = [];
                                foreach($request->file('images') as $image)
                                {
                                    $destinationPath = 'custom_bookings/';
                                    $filename = $image->getClientOriginalName();
                                    $image->move($destinationPath, $filename);
                                    array_push($names, $filename);          
                            
                                }
                                
                                foreach($names as $key => $name){
                                    $custom = new Custom_orders;
                                    $custom->image_name = $name;
                                    $custom->user_id = $request->user_id;
                                    $custom->booking_id = $booking->id;
                                    $custom->save();
                                }
                                
                            }
                                 
                            $booking = CustomBooking::where('id',$booking->id)->first();

            				if($booking->time == 0){

                                $timeval = 'Morning(8-11 AM)';
                            }

                            if($booking->time == 1){

                                $timeval = 'Midnoon(11-2 PM)';
                            }

                            if($booking->time == 2){

                                $timeval = 'Afternoon(2-5 PM)';
                            }

                            if($booking->time == 3){

                                $timeval = 'Evening(5-8 PM)';
                            }

    		        		$data['booking_id'] = $booking->id;
                            $data['booking_show_id'] = $booking->booking_show_id;
    		        		$data['address_type'] = $booking->home_type;
    		        		$data['name'] = $booking->name;
    		        		$data['address'] = $booking->area;
    		        		$data['locality'] = $booking->locality;
    		        		$data['city'] = $booking->city;
    		        		$data['state'] = $booking->state;
    		        		$data['pin_code'] = $booking->pin_code;
    		        		$data['service_name'] = $booking['serviceDetails']['name'];
    		        		$data['date'] = date('D,d M Y',strtotime($booking->date));
    		        		$data['time'] = $timeval;
            			    $data['price'] = $booking->amount;

                              $ser_arr = array();
                               $servicess = explode(',',$booking->service_id);
                               $ser_name = Service::whereIn('id',$servicess)->pluck('name')->toArray();
                               $service_name = implode(",",$ser_name);
                        
    		            	$path =asset('custom_bookings/');
                            $mailto = "aayushiquantum@gmail.com";
                            $from_mail = "aayushiquantum@gmail.com";
                            $subject = "Custom Booking";
                            $uid = $booking->id;
                            $datas = DB::table('custom_orders')->where('booking_id', $uid)->get();
                           
                            $message = "<p>A custom booking booked</p><br />Here are the details - ";
                            $message .= "<table><tr> Service Name : ";
                            $message .= $service_name;
                            $message .="</tr>";
                             $message .= "<table><tr> Budget : ";
                            $message .= $booking->amount;
                            $message .="</tr>";
                            $message .= "<tr>";
                            foreach($datas as $d)
                            {
                                $message .="<th><img src='".$path."/".$d->image_name."' style='height:100px; weight:100px;'></th>";
                               
                            }
                            $message .="</tr></table>";
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From:".$from_mail;
                
                            if(mail($mailto,$subject,$message,$headers))
                    	    { 
                                return \Response::json(['response_code' => 200,'response_message' => 'Service Booked Successfully.','result'=>$data], 200);
                    	    }

                     	

            		}else{

                     	return \Response::json(['response_code' => 400,'response_message' => 'Unable To Book Service.'], 200);	

            		}
        		
        	}catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function custombookingsList(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id'=>'required|numeric|exists:users,id',
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {	

        	/* 	
        		Booking Status
        		0=pending,1=confirmed,2=pro_cancelled,3=user_cancelled,5=completed 
        	*/
        	
        	$user_status = User::where('id',$request->user_id)->first();
                
                if(isset($user_status)){
                    
                    if($user_status->status != 1){
                        
                        return \Response::json(['response_code' => 402,'response_message' => 'You are Blocked By Admin.'], 200);
                    }
                }

        	$user = User::where('id',$request->user_id)->where('role_id','2')->first();
    		if(empty($user)){

             	return \Response::json(['response_code' => 400,'response_message' => 'You are not a user.'], 200);	

    		}


        	$bookings = CustomBooking::where('user_id',$request->user_id)->orderBy('updated_at','DESC')->get();
        	if(count($bookings)>0){

        		foreach ($bookings as $key => $value) {
                       
	        			if($value->time == 0){

                            $timeval = 'Morning(08:00 AM - 11:00 AM)';
                            $end_time = '11:00:00';
                        }

                        if($value->time == 1){

                            $timeval = 'Midnoon(11:00 AM - 02:00 PM)';
                            $end_time = '14:00:00';
                        }

                        if($value->time == 2){

                            $timeval = 'Afternoon(02:00 PM - 05:00 PM)';
                            $end_time = '17:00:00';
                        }

                        if($value->time == 3){

                            $timeval = 'Evening(05:00 PM - 08:00 PM)';
                            $end_time = '20:00:00'; 
                        }
                        
                    $images = Custom_orders::where('booking_id',$value->id)->get();
                    $image_arr = array();
                    if(count($images)>0){
                        
                        foreach($images as $image){
                            
                            $image_arr[] = url('custom_bookings/'.$image->image_name);
                        }
                    }

	        		$data['booking_id'] = strval($value->id);
                    $data['booking_show_id'] = $value->booking_show_id ? $value->booking_show_id : '';
                    $data['phone_number'] = $value->phone_no ? $value->phone_no : '';
                    $data['timing_constraints'] = $value->timing_constraints ? $value->timing_constraints : '';
                    $data['description'] = $value->description ? $value->description : '';
	        		$data['name'] = $value->name != '' ? $value->name:'';
	        		$data['address'] = $value->area != '' ? $value->area:'';
                    $data['address_type'] = $value->home_type != '' ? $value->home_type:'';
	        		$data['locality'] = $value->locality != '' ? $value->locality:'';
	        		$data['city'] = $value->city != '' ? $value->city:'';
	        		$data['state'] = $value->state != '' ? $value->state:'';
	        		$data['pin_code'] = $value->pin_code != '' ? $value->pin_code:'';
                    $data['service_type'] = $value['serviceDetails']['service_type'];
                    $data['service_id'] = $value['serviceDetails']['id'] ? $value['serviceDetails']['id'] : '';
	        		$data['service_name'] = $value['serviceDetails']['name'] ? $value['serviceDetails']['name'] : '';
	        		$data['service_time'] = $value['serviceDetails']['time'] ? $value['serviceDetails']['time'] : '';
	        		$data['service_price'] = $value['serviceDetails']['price'] ? $value['serviceDetails']['price'] : '';
	        		$data['service_add_price'] = $value['serviceDetails']['add_price'] ? $value['serviceDetails']['add_price'] : '';
                    $data['booking_date'] = $value->date;
                    $data['booking_time'] = $value->time;
	        		$data['date'] = date('D,d M Y',strtotime($value->date));
	        		$data['time'] = $timeval;
	        		$data['price'] = $value->amount;
	        		$data['images'] = $image_arr;
	        		$booking_data[] = $data;

	        	}

           	 	return \Response::json(['response_code' => 200,'response_message' => 'Bookings List Fetched Successfully.','result'=>$booking_data], 200);
        	}else{

           	 	return \Response::json(['response_code' => 400,'response_message' => 'No Bookings Yet.'], 200);	
			}
        }
    }
    
    /**
     * Save transaction details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchBookingDetails(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric|exists:users,id',
            'booking_id' =>'required|exists:bookings,booking_show_id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        } 
        else 
        {
            try{
                    $booking = Booking::where('booking_show_id',$request->booking_id)->first();
                    if(isset($booking)){
                        
                        if(isset($booking->pro_id)){
                            
                            $count = Booking::where('pro_id',$booking->pro_id)->where('booking_status',7)->count();
                            $review_avg = ProReview::where('pro_id',$booking->pro_id)->orderBy('id','DESC')->avg('stars');
                        }else{
                            $count = '0';
                            $review_avg = '4.5';
                        }
                        
                        

                        if($booking->time == 0){

                            $timeval = 'Morning(8-11 AM)';
                        }

                        if($booking->time == 1){

                            $timeval = 'Midnoon(11-2 PM)';
                        }

                        if($booking->time == 2){

                            $timeval = 'Afternoon(2-5 PM)';
                        }

                        if($booking->time == 3){

                            $timeval = 'Evening(5-8 PM)';
                        }

                            $data['booking_id'] = strval($booking->id);
                            $data['booking_show_id'] = $booking->booking_show_id ? $booking->booking_show_id : '';
                            $data['phone_number'] = $booking->phone_no ? $booking->phone_no : '';
                            $data['timing_constraints'] = $booking->timing_constraints ? $booking->timing_constraints : '';
                            $data['description'] = $booking->description ? $booking->description : '';
                            $data['name'] = $booking->name != '' ? $booking->name:'';
                            $data['address'] = $booking->area != '' ? $booking->area:'';
                            $data['address_type'] = $booking->home_type != '' ? $booking->home_type:'';
                            $data['locality'] = $booking->locality != '' ? $booking->locality:'';
                            $data['city'] = $booking->city != '' ? $booking->city:'';
                            $data['state'] = $booking->state != '' ? $booking->state:'';
                            $data['pin_code'] = $booking->pin_code != '' ? $booking->pin_code:'';
                            $data['pro_id'] = $booking->pro_id ? $booking->pro_id : '';
                            $data['pro_name'] = $booking['proDetails']['name'] ? $booking['proDetails']['name'] : '';
                            $data['jobs_done'] = $count ? $count : '';
                            $data['pro_review'] = $review_avg ? $review_avg : '4.5';
                            $data['pro_image'] = $booking['proDetails']['user_image'] ? url('pros_images/'.$booking['proDetails']['user_image']) : url('pros_images/user_dump.png');
                            $data['pro_contact_no'] = $booking['proDetails']['phone'] ? $booking['proDetails']['phone'] : '';
                            $data['service_id'] = $booking['serviceDetails']['service_type'];
                            $data['service_id'] = $booking['serviceDetails']['id'] ? $booking['serviceDetails']['id'] : '';
                            $data['service_type'] = $booking['serviceDetails']['name'] ? $booking['serviceDetails']['service_type'] : '';
                            $data['service_name'] = $booking['serviceDetails']['name'] ? $booking['serviceDetails']['name'] : '';
                            $data['service_time'] = $booking['serviceDetails']['time'] ? $booking['serviceDetails']['time'] : '';
                            $data['service_price'] = $booking['serviceDetails']['price'] ? $booking['serviceDetails']['price'] : '';
                            $data['service_add_price'] = $booking['serviceDetails']['add_price'] ? $booking['serviceDetails']['add_price'] : '';
                            $data['promocode'] = $booking['promocodeDetails']['code'] ? $booking['promocodeDetails']['code'] : '';
                            $data['promocode_id'] = $booking['promocodeDetails']['id'] ? $booking['promocodeDetails']['id'] : 0;
                            $data['promocode_discount'] = $booking['promocodeDetails']['price'] ? $booking['promocodeDetails']['price'] : '';
                            $data['booking_date'] = $booking->date;
                            $data['booking_time'] = $booking->time;
                            $data['date'] = date('D,d M Y',strtotime($booking->date));
                            $data['time'] = $timeval;
                            $data['status'] = $booking->booking_status;
                            $data['total_service_time'] = $booking->total_service_time ? gmdate("H:i",  $booking->total_service_time) : '';
                            $data['estm_area'] = $booking->es_sqfs ? $booking->es_sqfs : '';
                            $data['total_area'] = $booking->total_sqfs ? $booking->total_sqfs : '';
                            $data['amount'] = $booking->amount;
                            $data['otp'] = $booking->otp;
                            $data['pdf'] = $booking->pdf ? url('public/invoices/'.$booking->pdf) : '';
                            $booking_data[] = $data;

                        return \Response::json(['response_code' => 200,'response_message' => 'Booking details fetched successfully.','result' => $booking_data], 200);  

                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Booking doesnt exist'], 200);  
                    }

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }
}