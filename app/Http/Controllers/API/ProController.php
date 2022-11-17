<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Booking;
use App\Models\User;
use DB;
use Carbon\Carbon;
use DateTime;
use App\Models\ProLead;
use App\Models\UserDevice;
use App\Models\ProService;
use App\Models\Service;
use App\Models\ProAvailability;
use App\Models\ProDetail;      
use App\Http\Helper\Helper;
use App\Models\ProReview;
use PDF;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Billable;
use Auth;

class ProController extends Controller
{   

    /**
     * Display a listing of the leads of a pro.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLeads(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'pro_id' => 'required|numeric'
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
                
                 $user_status = User::where('id',$request->pro_id)->first();
                
                if(isset($user_status)){
                    
                    if($user_status->status != 1){
                        
                        return \Response::json(['response_code' => 402,'response_message' => 'You are Blocked By Admin.'], 200);
                    }
                }
                
                /*
                    0 = morning
                    1 = midnoon
                    2= afternoon
                    3 = evening
                */

                $user = User::where('id',$request->pro_id)->where('role_id',3)->first();
                $data = array();
                $timeval = '';
                if(isset($user)){

                    $leads = ProLead::with('bookingsDetail')->where('pro_id',$request->pro_id)->where('status','0')->orderBy('id','DESC')->get();
                    
                    foreach ($leads as $key => $value) {
                        
                        if($value['bookingsDetail']['time'] == 0){

                            $timeval = 'Morning(8-11 AM)';
                        }

                        if($value['bookingsDetail']['time'] == 1){

                            $timeval = 'Midnoon(11-2 PM)';
                        }

                        if($value['bookingsDetail']['time'] == 2){

                            $timeval = 'Afternoon(2-5 PM)';
                        }

                        if($value['bookingsDetail']['time'] == 3){

                            $timeval = 'Evening(5-8 PM)';
                        }

                        $values['booking_id'] = $value->booking_id;
                        $values['user_name'] = $value['bookingsDetail']['userDetails']['name'];
                        $values['service_name'] = $value['bookingsDetail']['serviceDetails']['name'];
                        $values['address_name'] = $value['bookingsDetail']['name'];
                        $values['address'] = $value['bookingsDetail']['address'];
                        $values['date'] = date('D,d M Y',strtotime($value['bookingsDetail']['date']));
                        $values['time'] = $timeval;
                        $values['timing_constraints'] = $value['bookingsDetail']['timing_constraints'];
                        $values['description'] = $value['bookingsDetail']['description'];
                        $data[] = $values;

                    }

                    return \Response::json(['response_code' => 200,'response_message' => 'Leads list fetched successfully.','result' => $data], 200);


                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'Not A Pro'], 200);

                }


            }catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

    /**
     * Accept the lead.
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptLeads(Request $request,Helper $helper)
    {
        $validator = Validator::make($request->all(),[
            'pro_id' => 'required|numeric',
            'booking_id' => 'required|numeric'
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

                    if($booking->pro_status == 1){

                        return \Response::json(['response_code' => 200,'response_message' => 'Lead already accepted.'], 200);

                    }

                    if($booking->pro_status == 2){

                        return \Response::json(['response_code' => 200,'response_message' => 'Lead already rejected.You can not accept it now.'], 200);

                    }

                    $date = date('d-m-Y',strtotime($booking->date));
                    $pro_booking = Booking::where('pro_id',$request->pro_id)->whereIn('pro_status',[1,6])->where('date',$date)->where('time',$booking->time)->first();
                    if($pro_booking){

                        return \Response::json(['response_code' => 400,'response_message' => 'Can Not Accept This Lead As You Have Already A Booking on this date and time.'], 200);

                    }

                     $pro_lead = ProLead::where('booking_id',$request->booking_id)->where('pro_id',$request->pro_id)->update(['status' => 1]);
                    $lead = ProLead::where('booking_id',$request->booking_id)->where('pro_id','!=',$request->pro_id)->where('status',0)->update(['status' => 4]);

                    $booking->pro_status = 1;
                    $booking->booking_status = 1;
                    $booking->pro_id = $request->pro_id;

                    if($booking->save()){

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
                        $booking = Booking::where('id',$booking->id)->first();
                        $subject = "Request for service ".$booking['serviceDetails']['name']." is confirmed.";
                        $message = "Your request for Service ".$booking['serviceDetails']['name'].
                        " is confirmed by our professional ".$booking['proDetails']['name']." on date ".date('D,d M Y',strtotime($booking->date))." and time ".$timeval;
                        $deviceTokens = UserDevice::where('user_id',$booking->user_id)->where('notification_status',1)->pluck('device_token');
                        $notification_id = $helper->activity_save($booking->user_id,$subject,$message,$booking->booking_status,$booking->id);
                        $data['notification_id'] = $notification_id;
                        $data['type'] = $booking->booking_status;
                        $data['booking_id'] = $booking->id;
                        $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
                        return \Response::json(['response_code' => 200,'response_message' => 'Lead accepted successfully.'], 200);

                    }else{

                         return \Response::json(['response_code' => 400,'response_message' => 'Unable to accept lead.'], 200);

                    }
                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'Booking not available.'], 200);

                }

            }catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

    /**
     * Reject a lead.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectLeads(Request $request,Helper $helper)
    {
        $validator = Validator::make($request->all(),[
            'pro_id' => 'required|numeric',
            'booking_id' => 'required|numeric'
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

                $pro_lead = ProLead::where('booking_id',$request->booking_id)->where('pro_id',$request->pro_id)->update(['status' => 2]);
                $pending_lead = ProLead::where('booking_id',$request->booking_id)->where('pro_id','!=',$request->pro_id)->where('status',0)->count();
                if($pending_lead == 0){

                    $booking = Booking::where('id',$request->booking_id)->first();
                        if(isset($booking)){

                         if($booking->pro_status == 1){

                            return \Response::json(['response_code' => 200,'response_message' => 'Lead already accepted.You can not reject it now.'], 200);

                        }

                        if($booking->pro_status == 2){

                            return \Response::json(['response_code' => 200,'response_message' => 'Lead already rejected.'], 200);

                        }

                        $booking->pro_status = 2;
                        $booking->booking_status = 2;
                        
                        if($booking->save()){
                            $booking = Booking::where('id',$booking->id)->first();
                            $subject = "Request for service ".$booking['serviceDetails']['name']." is rejected.";
                            $message = "Your request for Service ".$booking['serviceDetails']['name'].
                            " is rejected by our all professionals.";
                            $deviceTokens = UserDevice::where('user_id',$booking->user_id)->where('notification_status',1)->pluck('device_token');
                            $notification_id = $helper->activity_save($booking->user_id,$subject,$message,$booking->booking_status,$booking->id);
                            $data['notification_id'] = $notification_id;
                            $data['type'] = $booking->booking_status;
                            $data['booking_id'] = $booking->id;
                            $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);

                            return \Response::json(['response_code' => 200,'response_message' => 'Lead rejected successfully.'], 200);

                        }else{

                             return \Response::json(['response_code' => 400,'response_message' => 'Unable to reject lead.'], 200);

                        }
                    }
                }
                

                return \Response::json(['response_code' => 200,'response_message' => 'Lead rejected successfully.'], 200);

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
    public function proBookingsList(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'pro_id'=>'required|numeric|exists:users,id',
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
                0=pending,1=accepted,2=rejected,3=user_cancelled,5=completed 
            */
            
            $user_status = User::where('id',$request->pro_id)->first();
                
                if(isset($user_status)){
                    
                    if($user_status->status != 1){
                        
                        return \Response::json(['response_code' => 402,'response_message' => 'You are Blocked By Admin.'], 200);
                    }
                }

            $user = User::where('id',$request->pro_id)->where('role_id','3')->first();
            if(empty($user)){

                return \Response::json(['response_code' => 400,'response_message' => 'You are not a pro.'], 200);  

            }


            $bookings = ProLead::with('bookingsDetail')->where('pro_id',$request->pro_id)->where('status','!=',4)->orderBy('updated_at','DESC')->get();
            $timeval = '';
            if(count($bookings)>0){

                foreach ($bookings as $key => $value) {

                        if($value['bookingsDetail']['time'] == 0){

                            $timeval = 'Morning(8-11 AM)';
                        }

                        if($value['bookingsDetail']['time'] == 1){

                            $timeval = 'Midnoon(11-2 PM)';
                        }

                        if($value['bookingsDetail']['time'] == 2){

                            $timeval = 'Afternoon(2-5 PM)';
                        }

                        if($value['bookingsDetail']['time'] == 3){

                            $timeval = 'Evening(5-8 PM)';
                        }

                    $data['booking_id'] = strval($value['bookingsDetail']['id']);
                    $data['address_name'] = $value['bookingsDetail']['name'] != '' ? $value['bookingsDetail']['name']:'NA';
                    $data['address'] = $value['bookingsDetail']['area'] != '' ? $value['bookingsDetail']['area']:'NA';
                    $data['locality'] = $value['bookingsDetail']['locality'] != '' ? $value['bookingsDetail']['locality']:'NA';
                    $data['city'] = $value['bookingsDetail']['city'] != '' ? $value['bookingsDetail']['city']:'NA';
                    $data['state'] = $value['bookingsDetail']['state'] != '' ? $value['bookingsDetail']['state']:'NA';
                    $data['pin_code'] = $value['bookingsDetail']['pin_code'] != '' ? $value['bookingsDetail']['pin_code']:'NA';
                    $data['user_name'] = $value['bookingsDetail']['userDetails']['name'];
                    $data['user_phoneno'] = $value['bookingsDetail']['phone_no'];
                    $data['description'] = $value['bookingsDetail']['description'];
                    $data['timing_constraints'] = $value['bookingsDetail']['timing_constraints'];
                    $data['service_type'] = $value['bookingsDetail']['serviceDetails']['service_type'];
                    $data['service_name'] = $value['bookingsDetail']['serviceDetails']['name'];
                    $data['service_time'] = $value['bookingsDetail']['serviceDetails']['time'];
                    $data['service_price'] = $value['bookingsDetail']['serviceDetails']['price'];
                    $data['service_add_price'] = $value['bookingsDetail']['serviceDetails']['add_price'];
                    $data['date'] = date('D,d M Y',strtotime($value['bookingsDetail']['date']));
                    $data['time'] = $timeval;
                    $data['custom_booking'] = $value['bookingsDetail']['custom_booking'];
                    /*0=none,1=accepted,2=rejected,,3=user_cancelled,4=already_accepted,5=completed,6=service_start    */
                    $data['status'] = $value['status'];
                    $data['amount'] = $value['bookingsDetail']['amount'];
                    $booking_data[] = $data;

                }

                return \Response::json(['response_code' => 200,'response_message' => 'Bookings List Fetched Successfully.','result'=>$booking_data], 200);
            }else{

                return \Response::json(['response_code' => 400,'response_message' => 'No Bookings Yet.'], 200); 
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
    public function updateProfilePro(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'pro_id'=>'required|numeric|exists:users,id',
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


            $user = User::where('id',$request->pro_id)->where('role_id','3')->first();
            if(empty($user)){

                return \Response::json(['response_code' => 400,'response_message' => 'You are not a pro.'], 200);  

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

                $data['profile_image'] = $user['user_image'] ?  url('pros_images/'.$user['user_image']) : url('image/t1.png');

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function startService(Request $request,Helper $helper)
    {
        $validator = Validator::make($request->all(),[
            'booking_id'=>'required|numeric|exists:bookings,id'
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
            $bookings = Booking::where('id',$request->booking_id)->where('booking_status',1)->first();
            if($bookings == ''){

                return \Response::json(['response_code' => 400,'response_message' => 'Unable to start a service as service is not confirmed yet or it is cancelled or started.','is_start'=>'0'], 200);
            }

            $start_services = Booking::where('pro_id',$bookings->pro_id)->where('id','!=',$request->booking_id)->where('booking_status',6)->first();

            if(isset($start_services)){

                return \Response::json(['response_code' => 400,'response_message' => 'You can not start another service.','is_start'=>'0'], 200);

            }

            $digits = 4;
            $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT); // Generating OTP
            $bookings->otp = $otp;
            if($bookings->save()){
                    $bookings = Booking::where('id',$bookings->id)->first();

                    $subject = "OTP for starting the service .".$bookings['serviceDetails']['name']." is ".$otp;;
                    $message = "OTP for starting the service .".$bookings['serviceDetails']['name']." is ".$otp;
                    $deviceTokens = UserDevice::where('user_id',$bookings->user_id)->where('notification_status',1)->pluck('device_token');
                    $notification_id = $helper->activity_save($bookings->user_id,$subject,$message,$bookings->booking_status,$bookings->id,$otp);
                    $data['notification_id'] = $notification_id;
                    $data['type'] = $bookings->booking_status;
                    $data['booking_id'] = $bookings->id;
                    $data['otp'] = $otp;
                    $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);


                    $data['user_id'] = $bookings['user_id'];
                    $data['email']=$bookings['userDetails']['email'];
                    $data['otp']=$otp;
                    $email = "aayushiquantum@gmail.com";
                    $to = "somebody@example.com";
                    $subject = "OTP for start a service";
                    $message = "<p>Hello User!</p><br />
                                Your Otp For Starting The Service Is . 
                                ".$otp;
                    $headers = "From:".$email;

                    mail($data['email'],"Verification OTP",$message,$headers);

                return \Response::json(['response_code' => 200,'response_message' => 'Otp Sent Successfully.','is_start'=>'0','otp'=>$otp], 200);

            }else{

                return \Response::json(['response_code' => 400,'response_message' => 'Unable to send OTP.','is_start'=>'0'], 200);

            }

        }
    }


    /**
     * Verify OTP : Start A Service
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyStartSvcOtp(Request $request,Helper $helper)
    {
        $validator = Validator::make($request->all(),[

            'otp' => 'required|numeric',
            'booking_id' => 'required'

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
            try
            {
                $chck_expire_otp = Booking::where('id',$request->booking_id)->where('booking_status',1)->first();
                if($chck_expire_otp == ''){

                return \Response::json(['response_code' => 400,'response_message' => 'Unable to verify OTP.','is_start'=>'0'], 200);
            	}
                $to = date("i");
                $from = date("i",strtotime($chck_expire_otp->updated_at));
                // Check if OTP time is greater than 3 minutes return in response expire OTP 
                if($from>=($to-3))
                {
                    $user_otp = Booking::where('id',$request->booking_id)->where('otp',$request->otp)->first();

                    if(isset($user_otp))
                    {   
                        $user_otp->otp=1;
                        $user_otp->booking_status = 6;		
            			$user_otp->pro_status = 6;
                        $user_otp->starting_time = Carbon::now();
                        $user_otp->save();

                        $lead = ProLead::where('booking_id',$user_otp->id)->where('pro_id',$user_otp->pro_id)->first();
                        $lead->status = 6;
                        $lead->save();
                        $booking = Booking::where('id',$user_otp->id)->first();
                        $subject = $user_otp['serviceDetails']['name'] . " service started .";
                        $message = "Your booking service .".$user_otp['serviceDetails']['name']." is started at ".date('D,d M Y H:i:s',strtotime($user_otp->starting_time));
                        $deviceTokens = UserDevice::where('user_id',$user_otp->user_id)->where('notification_status',1)->pluck('device_token');
                        $notification_id = $helper->activity_save($user_otp->user_id,$subject,$message,$booking->booking_status,$booking->id);
                        $data['notification_id'] = $notification_id;
                        $data['type'] = $booking->booking_status;
                        $data['booking_id'] = $booking->id;
                        $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);

                        return \Response::json(['response_code' => 200,'response_message' => 'OTP verified successfully.','is_start'=>'1'], 200);
                    }
                    else
                    {
                        return \Response::json(['response_code' => 400,'response_message' => 'Invalid OTP.','is_start'=>'0'], 200);
                        
                    }
                }
                else
                {
                        return \Response::json(['response_code' => 400,'response_message' => 'OTP Expired.','is_start'=>'0'], 200);
                }

            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }



     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function endService(Request $request,Helper $helper)
    {
        $validator = Validator::make($request->all(),[
            'booking_id'=>'required|numeric|exists:bookings,id'
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
            $bookings = Booking::where('id',$request->booking_id)->where('booking_status',6)->first();
            if($bookings == ''){

                return \Response::json(['response_code' => 400,'response_message' => 'You have to start the service first to end a service.'], 200);
            	}
        	if($bookings->starting_time == ''){

     			return \Response::json(['response_code' => 400,'response_message' => 'You have to start the service first to end a service.'], 200);

        	}
        	if($bookings['serviceDetails']['service_type'] == 1){

        		if($request->total_area == ''){

        			return \Response::json(['response_code' => 401,'response_message' => 'Please enter the total area .'], 200);
        		}
        	}

            $digits = 4;
            $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT); // Generating OTP
            $bookings->end_otp = $otp;
            $bookings->total_sqfs = $request->total_area ? $request->total_area : '';
            if($bookings->save()){
                    $bookings = Booking::where('id',$bookings->id)->first();
                    if($bookings['serviceDetails']['service_type'] == 1){
                    	$subject = "OTP for ending the service .".$bookings['serviceDetails']['name']." is ".$otp;
                    	$message = "Total sqfs is ".$request->total_area." and OTP for ending the service .".$bookings['serviceDetails']['name']." is ".$otp;
                    }else{
                    	$subject = "OTP for ending the service .".$bookings['serviceDetails']['name']." is ".$otp;
                    	$message = "OTP for ending the service .".$bookings['serviceDetails']['name']." is ".$otp;
                    }
            		
                    $deviceTokens = UserDevice::where('user_id',$bookings->user_id)->where('notification_status',1)->pluck('device_token');
                    $notification_id = $helper->activity_save($bookings->user_id,$subject,$message,$bookings->booking_status,$bookings->id,$otp);
                    $data['notification_id'] = $notification_id;
                    $data['type'] = $bookings->booking_status;
                    $data['booking_id'] = $bookings->id;
                    $data['otp'] = $otp;
                    $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);


                    $data['user_id'] = $bookings['user_id'];
                    $data['email']=$bookings['userDetails']['email'];
                    $data['otp']=$otp;
                    $email = "aayushiquantum@gmail.com";
                    $to = "somebody@example.com";
                    $subject = "OTP for ending a service";
                    $message = "<p>Hello User!</p><br />
                                Your Otp For Ending The Service Is . 
                                ".$otp;
                    $headers = "From:".$email;

                    mail($data['email'],"Verification OTP",$message,$headers);

                return \Response::json(['response_code' => 200,'response_message' => 'Otp Sent Successfully.','otp'=>$otp], 200);

            }else{

                return \Response::json(['response_code' => 400,'response_message' => 'Unable to send OTP.'], 200);

            }

        }
   }



/**
 * Verify OTP : End Service
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function verifyEndSvcOtp(Request $request,Helper $helper)
{
    $validator = Validator::make($request->all(),[

        'otp' => 'required|numeric',
        'booking_id' => 'required'

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
        try
        {
            $chck_expire_otp = Booking::where('id',$request->booking_id)->where('booking_status',6)->first();
            if($chck_expire_otp == ''){

     			return \Response::json(['response_code' => 400,'response_message' => 'Unable to verify OTP'], 200);

            }
            if($chck_expire_otp->starting_time == ''){

     			return \Response::json(['response_code' => 400,'response_message' => 'You have to start the service first to end a service.'], 200);

        	}
            $to = date("i");
            $from = date("i",strtotime($chck_expire_otp->updated_at));
            // Check if OTP time is greater than 3 minutes return in response expire OTP 
            if($from>=($to-3))
            {
                $user_otp = Booking::with('userDetails','serviceDetails')->where('id',$request->booking_id)->where('end_otp',$request->otp)->first();

                if(isset($user_otp))
                { 

                    $now = Carbon::parse(Carbon::now());
                    $start_date = Carbon::parse($user_otp->starting_time);
                    $total_time = $now->diffInSeconds($start_date);
                    $hour = gmdate("H", $total_time);
                    $minutes = gmdate("i", $total_time);
                    $seconds = gmdate("s", $total_time);
                    $time = $user_otp['serviceDetails']['time'];
                    $price = $user_otp['serviceDetails']['price'];
                    $add_price = $user_otp['serviceDetails']['add_price'];
                    $total_area = $user_otp->total_sqfs;

                    if($user_otp['serviceDetails']['service_type'] == 1){

                    	if($total_area >= $time){

                    		$left_area = $total_area-$time;
                    		$add_area_price = $left_area*$add_price;
                    		$total_amount = $price + $add_area_price;
                    	}else{

                    		$total_amount = $price;
                    	}

                    }else{

	                    if($hour >= $time){

	                    	$left_time = $hour-$time;
	                    	$hour_price = $price;
	                    	$addi_price = $left_time*$add_price;
	                    	if($minutes >= 1){

	                    		$min_price = $add_price;
	                    	}else{

	                    		$min_price = 0;
	                    	}

	                    	$total_amount = $hour_price+$addi_price+$min_price;

	                    }else{

	                    	$total_amount = $price;
		                }

	            	}

                    $pdfname = 'invoice'.$user_otp->id.'.pdf';
                    $user_otp->end_otp=1;
                    $user_otp->end_time = Carbon::now();
                    $user_otp->total_service_time = $total_time ? $total_time : '';	
                    $user_otp->booking_status = 5;		
                    $user_otp->pro_status = 5;	
	                if($user_otp->custom_booking == 0){
                    $user_otp->amount = $total_amount; 
                    }
	                $user_otp->pdf = $pdfname;
                    $user_otp->save();
                    
                    PDF::loadView('pdf',$user_otp)->save(public_path().'/invoices/'.$pdfname);

                    $lead = ProLead::where('booking_id',$user_otp->id)->where('pro_id',$user_otp->pro_id)->first();
                    $lead->status = 5;
                    $lead->save();

                    $booking = Booking::where('id',$user_otp->id)->first();
                    $subject = $user_otp['serviceDetails']['name'] . " service ended .";
                    $message = "Your booking service .".$user_otp['serviceDetails']['name']." is ended at ".date('D,d M Y H:i:s',strtotime($user_otp->starting_time));
                    $deviceTokens = UserDevice::where('user_id',$user_otp->user_id)->where('notification_status',1)->pluck('device_token');
                    $notification_id = $helper->activity_save($user_otp->user_id,$subject,$message,$booking->booking_status,$booking->id);
                    $data['notification_id'] = $notification_id;
                    $data['type'] = $booking->booking_status;
                    $data['booking_id'] = $booking->id;
                    $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);

                    $data['booking_id'] = $user_otp->id;
                    $data['time'] = gmdate("H:i", $total_time);
                    $data['area'] = $total_area ? $total_area : '';	
                    $data['service_type'] = $user_otp['serviceDetails']['service_type'];
                    $data['amount'] = $total_amount;



             return \Response::json(['response_code' => 200,'response_message' => 'OTP verified successfully.','result'=>$data], 200);
                }
                else
                {
                    return \Response::json(['response_code' => 400,'response_message' => 'Invalid OTP.'], 200);
                    
                }
            }
            else
            {
                    return \Response::json(['response_code' => 400,'response_message' => 'OTP Expired.'], 200);
            }

        }catch(Exception $e){

            return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
        }
    }
}


    public function updateServices(Request $request){

         $validator = Validator::make($request->all(),[

            'services' => 'required',
            'pro_id'   => 'required|exists:users,id',
            'service_duration' =>'required'

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

                if(isset($request->services)){

                   // $pro_service = ProService::where('pro_id',$request->pro_id)->delete();
                     
                    //$services_av = Service::pluck('id')->toArray();
                    $services_arr = explode(",", $request->services);
                    foreach ($services_arr as $key => $value) {
                       // $val_chk = in_array($value,$services_av);
                            $pro_services = new ProService();
                            $pro_services->pro_id = $request->pro_id;
                            $pro_services->service_id = $value;
                             $dat = Carbon::now()->toDateString();
                                $pro_services->start_date = date('Y-m-d', strtotime($dat));
                                $pro_services->end_date = date('Y-m-d', strtotime("+".$request->service_duration." months", strtotime($dat)));
                                $pro_services->save();
                            $pro_services->save();
                        
                    }

                    return \Response::json(['response_code' => 200,'response_message' => 'Services updated successfully.'], 200);


                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'Unable to update services.'], 200);

                }
                
            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }
        }

    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProServiceList(Request $request)
    {

       $validator = Validator::make($request->all(),[
            'pro_id' => 'required|numeric'
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

            $user = User::where('id',$request->pro_id)->where('role_id',3)->first();

            if(isset($user)){
                
                $current_date = Carbon::now()->toDateString();
                $services = Service::orderBy('name','ASC')->get();
                $pro_services = ProService::where('pro_id',$request->pro_id)->whereDate('end_date','>=',$current_date)->pluck('service_id')->toArray();

                if(count($services)>0){

                    foreach ($services as $key => $value) {
                        
                        $values['service_id'] = $value->id;
                        $values['service_name'] = $value->name;
                        $values['image'] = url('services/'.$value->service_image);
                        $values['service_desc_image'] = url('services/'.$value->service_desc_image);
                        $values['hour'] = $value->time;
                        $values['hour_price'] = $value->price;
                        $values['additional_price'] = $value->add_price;
                        $values['description'] = $value->description;
                        $values['is_selected'] = in_array($value->id,$pro_services) ? '1' : '0';
                        $data[] = $values;
                    }
                        

                        return \Response::json(['response_code' => 200,'response_message' => 'Services list fetched successfully.','result' => $data], 200);



                }else{

                     return \Response::json(['response_code' => 400,'response_message' => 'No services available.'], 200);

                }
            }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'Not A pro.'], 200);

            }
            
        }
    }


    public function updateProAvailability(Request $request){


       $validator = Validator::make($request->all(),[
            'pro_id' => 'required|numeric',
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required'
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

                $pro_av_days = ProAvailability::where('pro_id',$request->pro_id)->delete();
                
                    /*Availability for monday*/
                    $monday_arr = explode(",",$request->monday);
                    $monday_av  = in_array("1", $monday_arr);
                    $pro_availablity_mon = new ProAvailability();
                    $pro_availablity_mon->pro_id = $request->pro_id;
                    $pro_availablity_mon->day_id = 1;
                    $pro_availablity_mon->day_availability = $monday_av == '1' ? '1':'0';
                    $pro_availablity_mon->morning = $monday_arr[0];
                    $pro_availablity_mon->midnoon = $monday_arr[1];
                    $pro_availablity_mon->afternoon = $monday_arr[2];
                    $pro_availablity_mon->evening = $monday_arr[3];
                    $pro_availablity_mon->save();

                     /*Availability for Tuesday*/
                    $tuesday_arr = explode(",",$request->tuesday);
                    $tuesday_av  = in_array("1", $tuesday_arr);
                   
                    $pro_availablity_tues = new ProAvailability();
                    $pro_availablity_tues->pro_id = $request->pro_id;
                    $pro_availablity_tues->day_id = 2;
                    $pro_availablity_tues->day_availability = $tuesday_av == '1' ? '1':'0';
                    $pro_availablity_tues->morning = $tuesday_arr[0];
                    $pro_availablity_tues->midnoon = $tuesday_arr[1];
                    $pro_availablity_tues->afternoon = $tuesday_arr[2];
                    $pro_availablity_tues->evening = $tuesday_arr[3];
                    $pro_availablity_tues->save();


                     /*Availability for Wednesday*/
                    $wednesday_arr = explode(",",$request->wednesday);
                    $wednesday_av  = in_array("1", $wednesday_arr);
                   
                    $pro_availablity_wed = new ProAvailability();
                    $pro_availablity_wed->pro_id = $request->pro_id;
                    $pro_availablity_wed->day_id = 3;
                    $pro_availablity_wed->day_availability = $wednesday_av == '1' ? '1':'0';
                    $pro_availablity_wed->morning = $wednesday_arr[0];
                    $pro_availablity_wed->midnoon = $wednesday_arr[1];
                    $pro_availablity_wed->afternoon = $wednesday_arr[2];
                    $pro_availablity_wed->evening = $wednesday_arr[3];
                    $pro_availablity_wed->save();


                     /*Availability for Thursday*/
                    $thursday_arr = explode(",",$request->thursday);
                    $thursday_av  = in_array("1", $thursday_arr);
                   
                    $pro_availablity_thur = new ProAvailability();
                    $pro_availablity_thur->pro_id = $request->pro_id;
                    $pro_availablity_thur->day_id = 4;
                    $pro_availablity_thur->day_availability = $thursday_av == '1' ? '1':'0';
                    $pro_availablity_thur->morning = $thursday_arr[0];
                    $pro_availablity_thur->midnoon = $thursday_arr[1];
                    $pro_availablity_thur->afternoon = $thursday_arr[2];
                    $pro_availablity_thur->evening = $thursday_arr[3];
                    $pro_availablity_thur->save();


                     /*Availability for Friday*/
                    $friday_arr = explode(",",$request->friday);
                    $friday_av  = in_array("1", $friday_arr);
                   
                    $pro_availablity_fri = new ProAvailability();
                    $pro_availablity_fri->pro_id = $request->pro_id;
                    $pro_availablity_fri->day_id = 5;
                    $pro_availablity_fri->day_availability = $friday_av == '1' ? '1':'0';
                    $pro_availablity_fri->morning = $friday_arr[0];
                    $pro_availablity_fri->midnoon = $friday_arr[1];
                    $pro_availablity_fri->afternoon = $friday_arr[2];
                    $pro_availablity_fri->evening = $friday_arr[3];
                    $pro_availablity_fri->save();

                     /*Availability for Saturday*/
                    $saturday_arr = explode(",",$request->saturday);
                    $saturday_av  = in_array("1", $saturday_arr);
                   
                    $pro_availablity_sat = new ProAvailability();
                    $pro_availablity_sat->pro_id = $request->pro_id;
                    $pro_availablity_sat->day_id = 6;
                    $pro_availablity_sat->day_availability = $saturday_av == '1' ? '1':'0';
                    $pro_availablity_sat->morning = $saturday_arr[0];
                    $pro_availablity_sat->midnoon = $saturday_arr[1];
                    $pro_availablity_sat->afternoon = $saturday_arr[2];
                    $pro_availablity_sat->evening = $saturday_arr[3];
                    $pro_availablity_sat->save();

                     /*Availability for Sunday*/
                    $sunday_arr = explode(",",$request->sunday);
                    $sunday_av  = in_array("1", $sunday_arr);
                   
                    $pro_availablity_sun = new ProAvailability();
                    $pro_availablity_sun->pro_id = $request->pro_id;
                    $pro_availablity_sun->day_id = 7;
                    $pro_availablity_sun->day_availability = $sunday_av == '1' ? '1':'0';
                    $pro_availablity_sun->morning = $sunday_arr[0];
                    $pro_availablity_sun->midnoon = $sunday_arr[1];
                    $pro_availablity_sun->afternoon = $sunday_arr[2];
                    $pro_availablity_sun->evening = $sunday_arr[3];
                    $pro_availablity_sun->save();

                    return \Response::json(['response_code' => 200,'response_message' => 'Pro User Availability updated successfully.'], 200);

            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }
        }

    }

    public function updateCompanyDetails(Request $request){

         $validator = Validator::make($request->all(),[
            'pro_id' => 'required',
            'business_address' => 'required',
            'phone_no' => 'required|numeric',
            'service_desc'=>'required' 
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

                $user = User::where('id',$request->pro_id)->where('role_id',3)->first();
                if(isset($user)){

                    if($user->is_listed == 1){

                        $pro_detail = ProDetail::where('pro_id',$request->pro_id)->first();
                        $pro_detail->business_address = $request->business_address;
                        $pro_detail->phone_no = $request->phone_no;
                        $pro_detail->save();

                        $user->description = $request->service_desc;
                        $user->save();

                        return \Response::json(['response_code' => 200,'response_message' => 'Company Details Updated Successfully.','is_listed' => 1], 200);
                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Business is not listed.','is_listed' => 0], 200);
                    }

                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.','is_listed' => 0], 200);

                }
                
            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }


    public function updateBankingDetails(Request $request){

         $validator = Validator::make($request->all(),[
            'pro_id' => 'required',
            'routing_no' => 'required|numeric',
            'account_no' => 'required|alpha_num',
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

                $user = User::where('id',$request->pro_id)->where('role_id',3)->first();
                if(isset($user)){

                    if($user->is_listed == 1){

                        $pro_detail = ProDetail::where('pro_id',$request->pro_id)->first();
                        $pro_detail->account_no = $request->account_no;
                        $pro_detail->routing_no = $request->routing_no;
                        $pro_detail->save();

                        return \Response::json(['response_code' => 200,'response_message' => 'Banking Info Updated Successfully.','is_listed' => 1], 200);
                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Business is not listed.','is_listed' => 0], 200);
                    }

                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.','is_listed' => 0], 200);

                }
                
            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }


    public function updateDocuments(Request $request){

         $validator = Validator::make($request->all(),[
            'pro_id' => 'required',
            'license_no' => 'required|alpha_num',
            'license_doc' => 'required',
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

                $user = User::where('id',$request->pro_id)->where('role_id',3)->first();
                if(isset($user)){

                    if($user->is_listed == 1){

                        $pro_detail = ProDetail::where('pro_id',$request->pro_id)->first();
                        $pro_detail->license_no = $request->license_no;

                        if($files = $request->file('license_doc')){
                            // upload path
                            $destinationPath = public_path('/prosdoc/'); 
                            // Upload Orginal Image 
                            $input['name']=time().'.'.$files->getClientOriginalExtension();
                            $files->move($destinationPath,$input['name']);
                            // Save In Database 
                            $pro_detail->license_doc=$input['name'];   
                        }
                        $pro_detail->save();

                        $data['license_no'] = $pro_detail->license_no;
                        $data['license_doc'] = $pro_detail->license_doc;
                        $data['license_url'] = url('prosdoc/'.$pro_detail->license_doc); 

                        return \Response::json(['response_code' => 200,'response_message' => 'Documents Updated Successfully.','result'=>$data,'is_listed' => 1], 200);
                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Business is not listed.','is_listed' => 0], 200);
                    }

                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.','is_listed' => 0], 200);

                }
                
            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

    public function updateInsurance(Request $request){

         $validator = Validator::make($request->all(),[
            'pro_id' => 'required',
            'insurance' => 'required',
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

                $user = User::where('id',$request->pro_id)->where('role_id',3)->first();
                if(isset($user)){

                    if($user->is_listed == 1){

                        $pro_detail = ProDetail::where('pro_id',$request->pro_id)->first();

                        if($files = $request->file('insurance')){
                            // upload path
                            $destinationPath = public_path('/prosdoc/'); 
                            // Upload Orginal Image 
                            $input['name']=time().'.'.$files->getClientOriginalExtension();
                            $files->move($destinationPath,$input['name']);
                            // Save In Database 
                            $pro_detail->insurance=$input['name'];   
                        }
                        $pro_detail->save();

                        $data['insurance'] = $pro_detail->insurance;
                        $data['insurance_url'] = url('prosdoc/'.$pro_detail->insurance); 

                        return \Response::json(['response_code' => 200,'response_message' => 'Documents Updated Successfully.','result'=>$data,'is_listed' => 1], 200);
                    }else{

                        return \Response::json(['response_code' => 400,'response_message' => 'Business is not listed.','is_listed' => 0], 200);
                    }

                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.','is_listed' => 0], 200);

                }
                
            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
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
    public function getListingDetails(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'pro_id' => 'required',
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
                
                
                $user_status = User::where('id',$request->pro_id)->first();
                
                if(isset($user_status)){
                    
                    if($user_status->status != 1){
                        
                        return \Response::json(['response_code' => 402,'response_message' => 'You are Blocked By Admin.'], 200);
                    }
                }

                $user = User::where('id',$request->pro_id)->where('role_id',3)->where('is_listed',1)->first();

                if(isset($user)){

                    $monday_av = ProAvailability::where('day_id',1)->where('pro_id',$user['id'])->first();
                    $pro_availablity['monday'] = $monday_av->morning.','.$monday_av->midnoon.','.$monday_av->afternoon.','.$monday_av->evening;

                    $tuesday_av = ProAvailability::where('day_id',2)->where('pro_id',$user['id'])->first();
                    $pro_availablity['tuesday'] = $tuesday_av->morning.','.$tuesday_av->midnoon.','.$tuesday_av->afternoon.','.$tuesday_av->evening;

                    $wednesday_av = ProAvailability::where('day_id',3)->where('pro_id',$user['id'])->first();
                    $pro_availablity['wednesday'] = $wednesday_av->morning.','.$wednesday_av->midnoon.','.$wednesday_av->afternoon.','.$wednesday_av->evening;

                    $thursday_av = ProAvailability::where('day_id',4)->where('pro_id',$user['id'])->first();
                    $pro_availablity['thursday'] = $thursday_av->morning.','.$thursday_av->midnoon.','.$thursday_av->afternoon.','.$thursday_av->evening;

                    $friday_av = ProAvailability::where('day_id',5)->where('pro_id',$user['id'])->first();
                    $pro_availablity['friday'] = $friday_av->morning.','.$friday_av->midnoon.','.$friday_av->afternoon.','.$friday_av->evening;

                    $saturday_av = ProAvailability::where('day_id',6)->where('pro_id',$user['id'])->first();
                    $pro_availablity['saturday'] = $saturday_av->morning.','.$saturday_av->midnoon.','.$saturday_av->afternoon.','.$saturday_av->evening;

                    $sunday_av = ProAvailability::where('day_id',7)->where('pro_id',$user['id'])->first();
                    $pro_availablity['sunday'] = $sunday_av->morning.','.$sunday_av->midnoon.','.$sunday_av->afternoon.','.$sunday_av->evening;
                    
                    $pro_services = ProService::where('pro_id',$user['id'])->count();

                    $pro_details = ProDetail::where('pro_id',$user['id'])->first();
                    $company['company_name'] = $pro_details->company_name;
                    $company['business_address'] = $pro_details->business_address;
                    $company['phone_no'] = $pro_details->phone_no;
                    $company['com_ind'] = $pro_details->com_ind;
                    $company['ein_no'] = $pro_details->ein_no;
                    $company['first_name'] = $pro_details->acc_first_name;
                    $company['last_name'] = $pro_details->acc_last_name;
                    $company['ssn_no'] = $pro_details->ssn_no;
                    $company['routing_no'] = $pro_details->routing_no;
                    $company['account_no'] = $pro_details->account_no;
                    $company['license_no'] = $pro_details->license_no;
                    $company['license_doc'] = $pro_details->license_doc;
                    $company['license_url'] = url('prosdoc/'.$pro_details->license_doc);
                    $company['insurance'] = $pro_details->insurance ? url('prosdoc/'.$pro_details->insurance) : '';
                    $company['dob'] = $pro_details->dob;

                    $data['is_verified'] = $user['state'];
                    $data['is_payment'] = $user['is_payment'];
                    $data['ser_count'] = $pro_services;
                    $data['availability_pro'] = $pro_availablity ? $pro_availablity :  (object)[];
                    $data['company_details'] = $company ? $company :  (object)[];
                    $data['user_id'] = $user['id'];
                    $data['name']=$user['name'];
                    $data['email']=$user['email'];
                    $data['phone']=$user['phone'];
                    $data['profile_image']=$user['user_image'] ?  url('pros_images/'.$user['user_image']) : url('/pros_images/user-dump.png');

                    return \Response::json(['response_code' => 200,'response_message' => 'Listing Details Fetched Successfully','user_data' => $data], 200);

                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'User is not listed.','is_listed' => 0], 200);
                }

            }catch(Exception $e){

                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }


    /**
     *User cancellation of booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelProBooking(Request $request,Helper $helper)
    {
        $validator = Validator::make($request->all(),[
            'booking_id' => 'required|numeric|exists:bookings,id',
            'cancel_reason' => 'required'
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

        		if($booking->pro_status == 5){

                   return \Response::json(['response_code' => 400,'response_message' => 'Booking is completed.You can not cancel it now.'], 200);

        		}

                if($booking->pro_status == 6){

                   return \Response::json(['response_code' => 400,'response_message' => 'Booking can not be cancelled as service is already started'], 200);

                }

                if($booking->pro_status == 1){

	        		$booking->booking_status = 2;
	        		$booking->pro_status = 2;
	        		$booking->cancel_reason = $request->cancel_reason;

	        		if($booking->save()){

	                    $pro_booking = ProLead::where('booking_id',$booking->id)->where('pro_id',$booking->pro_id)->first();
	                    if(isset($pro_booking)){
	                    $booking = Booking::where('id',$booking->id)->first();
	                           
	                           $pro_booking->status = 2;
	                           $pro_booking->save();

	                            $subject = $booking['serviceDetails']['name'] . " is cancelled by ".$booking['proDetails']['name'];
	                            $message = "Your booking service scheduled on .".date('D,d M Y',strtotime($booking->date))." is being cancelled by ".$booking['proDetails']['name'];
	                            $deviceTokens = UserDevice::where('user_id',$booking->user_id)->where('notification_status',1)->pluck('device_token');
	                            $notification_id = $helper->activity_save($booking->user_id,$subject,$message,$booking->booking_status,$booking->id);
	                            $data['notification_id'] = $notification_id;
	                            $data['type'] = $booking->booking_status;
	                            $data['booking_id'] = $booking->id;
	                            $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
	                    }

	                    return \Response::json(['response_code' => 200,'response_message' => 'Booking cancelled successfully.'], 200);

	        		}else{

	                    return \Response::json(['response_code' => 400,'response_message' => 'Unable to cancel the booking.'], 200);

	        		}

        	}else{

        		 return \Response::json(['response_code' => 400,'response_message' => 'Unable to cancel the booking.'], 200);
        	}

        	}catch(Exception $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
        }
    }


    public function getProReviews(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'pro_id' => 'required|exists:users,id'
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
            $reviews = ProReview::where('pro_id',$request->pro_id)->orderBy('id','DESC')->get();

            if(count($reviews)>0){

                foreach ($reviews as $key => $value) {

                    $values['user_name'] = $value['userDetails']['name'];
                    $values['user_profile'] = $value['userDetails']['user_image'] ? url('/pros_images/'.$value['userDetails']['user_image']): asset('/pros_images/user-dump.png');
                    $values['stars'] = $value->stars;
                    $values['reviews'] = $value->reviews;
                    $data[] = $values;
                }

                return \Response::json(['response_code' => 200,'response_message' => 'Reviews fetched successfully.','result'=>$data], 200);
            }else{

                return \Response::json(['response_code' => 400,'response_message' => 'No reviews yet.'], 200);
            }
        }
    }
    
    
    public function subs(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'ser_count' => 'required',
            'card_number' => 'required',
            'card_type' => 'required',
            'cvv' => 'required',
            'exp_month' => 'required',
            'exp_year' =>'required',
            'postal_code' => 'required'
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
            
        try {
         $user = Auth::user();
         if(empty($user)){
             return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.'], 200);
         }
         if($user->stripe_id == ''){
            $user_id = $user->createAsStripeCustomer();
        }
         $services = $request->ser_count ; 
         if($services == 1){
            
            $price_id = 'price_1JXgaQJ5SREt5Pwvz0pW9Bqh';
            
        }elseif($services == 2){
            
            $price_id = 'price_1JXhCAJ5SREt5PwvjdBJ474w';
            
        }elseif($services == 3){
            
            $price_id = 'price_1JXhGYJ5SREt5PwvNl1rkEvJ';
            
        }elseif($services == 4){
            
            $price_id = 'price_1JXivlJ5SREt5PwvlRUWa8yK';
            
        }elseif($services == 5){
            
            $price_id = 'price_1JXiw0J5SREt5PwvTcc8to51';
            
        }elseif($services == 6){
            
            $price_id = 'price_1JXiwSJ5SREt5Pwvhtr0dn5I';
            
        }elseif($services == 7){
            
            $price_id = 'price_1JXiwmJ5SREt5Pwvpk717opu';
            
        }elseif($services == 8){
            
            $price_id = 'price_1JXix2J5SREt5PwvlKh4PHxf';
            
        }elseif($services == 9){
            
            $price_id = 'price_1JXixZJ5SREt5PwvPhbtIKwD';
            
        }elseif($services == 10){
            
            $price_id = 'price_1JXixpJ5SREt5PwvjYwIvNsl';
            
        }elseif($services == 11){
            
            $price_id = 'price_1JXiyCJ5SREt5Pwv2AVsOBZb';
            
        }elseif($services == 12){
            
            $price_id = 'price_1JXiyTJ5SREt5PwvM6EIc6Hf';
            
        }elseif($services == 13){
            
            $price_id = 'price_1JXiygJ5SREt5PwvklqmqCXX';
            
        }elseif($services == 14){
            
            $price_id = 'price_1JXj0uJ5SREt5PwvRRGM4Ydx';
            
        }elseif($services == 15){
            
            $price_id = 'price_1JXj1EJ5SREt5PwvN0ghH3dx';
            
        }elseif($services == 16){
            
            $price_id = 'price_1JXj1XJ5SREt5PwvWhgUUbco';
            
        }elseif($services == 17){
            
            $price_id = 'price_1JXj1rJ5SREt5Pwvyw1y1JlS';
            
        }elseif($services == 18){
            
            $price_id = 'price_1JXj26J5SREt5Pwv9V4Z190H';
            
        }elseif($services == 19){
            
            $price_id = 'price_1JXj2OJ5SREt5PwvVCbSbr6h';
            
        }elseif($services == 20){
            
            $price_id = 'price_1JXj2mJ5SREt5PwvamEXTW5V';
            
        }elseif($services == 21){
            
            $price_id = 'price_1JXj2yJ5SREt5Pwvwkcnngqr';
            
        }elseif($services == 22){
            
            $price_id = 'price_1JXj3CJ5SREt5PwvWuyxzBYV';
            
        }elseif($services == 23){
            
            $price_id = 'price_1JXj3PJ5SREt5Pwv1XdIhW2f';
            
        }elseif($services == 24){
            
            $price_id = 'price_1JXj3iJ5SREt5PwvRRasje6M';
            
        }elseif($services == 25){
            
            $price_id = 'price_1JXj45J5SREt5Pwvh6x0CWLv';
            
        }else{
            
            $price_id = 'price_1JXj4vJ5SREt5PwvEqfeTGBB';
        } 
        
        
        $stripe = new \Stripe\StripeClient(
          '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'
        );
        
        $pay_id = $stripe->paymentMethods->create([
                      'type' => 'card',
                      'card' => [
                        'number' => $request->card_number,
                        'exp_month' => $request->exp_month,
                        'exp_year' => $request->exp_year,
                        'cvc' => $request->cvv,
                      ],
                    ]);
        
       // print_r($pay_id->id);exit;
        if(isset($pay_id->id)){
            $user->addPaymentMethod($pay_id->id);
            $test = $user->newSubscription('main',$price_id)->create($pay_id->id);
            $user->is_payment = 1;
            $user->save();
            
            $email = "info@meinhaus.ca";
            $to = $user->email;
            $subject = "Payment Successful.";
            //$htmlContent = file_get_contents(resource_path('views/website/email/reset_mail.blade.php',false, $context));
            $message ="<html>
            <center><a href=”” style=”cursor:none;”><img src='https://meinhaus.ca/image/pay.png' height='800px;' width='700px;'></a></center></html>";
            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
            
            // Additional headers 
            $headers .= 'From: '.$email.'<'.$email.'>' . "\r\n"; 
            $headers .= 'Cc: info@meinhaus.ca' . "\r\n"; 
            
            mail($to ,"Payment Successful.",$message,$headers);
        
            return \Response::json(['response_code' => 200,'response_message' => 'Payment Successful.'], 200);
        }else{
            return \Response::json(['response_code' => 400,'response_message' => 'Invalid Payment Method.'], 200);
        }
        
        }catch(\Stripe\Exception\CardException $e) {
          // Since it's a decline, \Stripe\Exception\CardException will be caught
          return \Response::json(['response_code' => $e->getHttpStatus() , 'response_message' => $e->getError()->message, 'error_type' => $e->getError()->type], 200);
        
        } 
            
        }
        
    }

}