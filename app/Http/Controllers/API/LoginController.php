<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\User;
use App\Models\UserDevice;
use Hash;
use DB;
use App\Models\UserOtp;
use App\Models\ProDetail;
use App\Models\ProService;
use App\Models\Service;
use App\Models\ProAvailability;
use Mail;
use App\Models\UserAddress;
use App\Models\Booking;
use Lcobucci\JWT\Parser;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required|min:8|max:16',
            'user_type'=>'required|numeric',
            'device_token'=>'required',
            'device_type'=>'required'
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

                $password = strip_tags(trim($request->password));
                $device_token = strip_tags(trim($request->device_token));
                $device_type = strip_tags(trim($request->device_type));

                $user = User::where('email',$request->email)->where('role_id',$request->user_type)->first();

                if(isset($user))
                {
                    $user_email = $user['email'];
                    $user_id = $user['id'];
                    // check the user credential
                    $check_credentials = Auth::attempt(['email' => $user_email, 'password' => $password]);
                    if($check_credentials)
                    {   
                        if($user['status'] == 0){

                            Auth::logout();
                            return \Response::json(['response_code' => 400,'response_message' => 'You are blocked by admin'], 200);

                        }
                        $userDevice = new UserDevice();
                        $userDevice->user_id = $user['id'];
                        $userDevice->device_token = $request->device_token;
                        $userDevice->device_type = $request->device_type;
                        $userDevice->save();
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
                        $address = UserAddress::where('user_id',$user['id'])->where('primary',1)->first();
                        // $token = $user->createToken('MeinHaus')->accessToken;
                        // $token = $user->createToken('API Token')->plainTextToken;
                        
                        $length = 50;

                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                        $charactersLength = strlen($characters);

                        $token = '';

                        for ($i = 0; $i < $length; $i++) {

                        $token .= $characters[rand(0, $charactersLength - 1)];

                        }

                        $token;

                        $pro_availablity = array();
                        $company = array();
                        if($user['role_id'] == 3 && $user['is_listed'] == 1){

                            if(ProAvailability::where('day_id',1)->where('pro_id',$user['id'])->exists())
                            {
                                $monday_av = ProAvailability::where('day_id',1)->where('pro_id',$user['id'])->first();
                                $pro_availablity['monday'] = $monday_av->morning.','.$monday_av->midnoon.','.$monday_av->afternoon.','.$monday_av->evening;
                            }
                            
                            if(ProAvailability::where('day_id',2)->where('pro_id',$user['id'])->exists())
                            {
                                $tuesday_av = ProAvailability::where('day_id',2)->where('pro_id',$user['id'])->first();
                                $pro_availablity['tuesday'] = $tuesday_av->morning.','.$tuesday_av->midnoon.','.$tuesday_av->afternoon.','.$tuesday_av->evening;
                            }
                            
                            if(ProAvailability::where('day_id',3)->where('pro_id',$user['id'])->exists())
                            {
                                $wednesday_av = ProAvailability::where('day_id',3)->where('pro_id',$user['id'])->first();
                                $pro_availablity['wednesday'] = $wednesday_av->morning.','.$wednesday_av->midnoon.','.$wednesday_av->afternoon.','.$wednesday_av->evening;
                            }
                            
                            if(ProAvailability::where('day_id',4)->where('pro_id',$user['id'])->exists())
                            {
                                $thursday_av = ProAvailability::where('day_id',4)->where('pro_id',$user['id'])->first();
                                $pro_availablity['thursday'] = $thursday_av->morning.','.$thursday_av->midnoon.','.$thursday_av->afternoon.','.$thursday_av->evening;
                            }
                            
                            if(ProAvailability::where('day_id',5)->where('pro_id',$user['id'])->exists())
                            {
                                $friday_av = ProAvailability::where('day_id',5)->where('pro_id',$user['id'])->first();
                                $pro_availablity['friday'] = $friday_av->morning.','.$friday_av->midnoon.','.$friday_av->afternoon.','.$friday_av->evening;
                            }
                            
                            if(ProAvailability::where('day_id',6)->where('pro_id',$user['id'])->exists()){
                                $saturday_av = ProAvailability::where('day_id',6)->where('pro_id',$user['id'])->first();
                                $pro_availablity['saturday'] = $saturday_av->morning.','.$saturday_av->midnoon.','.$saturday_av->afternoon.','.$saturday_av->evening;
                            }
                            
                            if(ProAvailability::where('day_id',7)->where('pro_id',$user['id'])->exists())
                            {
                                $sunday_av = ProAvailability::where('day_id',7)->where('pro_id',$user['id'])->first();
                                $pro_availablity['sunday'] = $sunday_av->morning.','.$sunday_av->midnoon.','.$sunday_av->afternoon.','.$sunday_av->evening;
                            }
                            

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
                                $company['license_doc'] = url('prosdoc/'.$pro_details->license_doc);
                                $company['dob'] = $pro_details->dob;
        
                        }

                        $data['user_id'] = $user['id'];
                        $data['name']=$user['name'];
                        $data['email']=$user['email'];
                        $data['phone']=$user['phone'];
                        $data['profile_image']=$user['user_image'] ?  url('pros_images/'.$user['user_image']) : url('/pros_images/user-dump.png');
                        $data['address_id']=isset($address['id']) ? $address['id'] : '';
                        $data['address_name']=isset($address['name']) ? $address['name'] : '';
                        $data['address_type']=isset($address['address_type']) ? $address['address_type'] : '';
                        $data['address']=isset($address['area']) ? $address['area'] : '';
                        $data['locality']=isset($address['locality']) ? $address['locality'] : '';
                        $data['city']=isset($address['city']) ? $address['city'] : '';
                        $data['state']=isset($address['state']) ? $address['state'] : '';
                        $data['pin_code']=isset($address['pin_code']) ? $address['pin_code'] : '';
                        $data['is_listed']=$user['is_listed'];
                        $data['is_verified']=$user['state'];
                        $data['customer_id']=$user['customer_id'];
                        $data['accessToken'] = $token;
                        $data['is_payment'] = $payments ? $payments : (object)[];
                        $data['availability_pro'] = $pro_availablity ? $pro_availablity :  (object)[];
                        $data['company_details'] = $company ? $company :  (object)[];

                         
                        
                        return \Response::json(['response_code' => 200,'response_message' => 'User Login Successfully.','user_data' => $data], 200);
                    }
                    else
                    {
                        return \Response::json(['response_code' => 400,'response_message' => 'Please enter valid credentials'], 200);
                    }
                }
                else
                {
                    return \Response::json([ 'response_code' => 400,'response_message' => 'Invalid Email ID'], 200);
                }

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:60|min:3',
            'email' => 'required|min:3|max:255|unique:users,email',
            'phone' => 'required|numeric',
            'user_type'=>'required|numeric',
            'password' => 'required|min:8|max:16',
            'confirm_password' => 'required|min:6|max:16|same:password'
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

                $name = strip_tags(trim($request->name));
                $email = strip_tags(trim($request->email));
                $phone = strip_tags(trim($request->phone));
                $password = strip_tags(trim($request->password));
                $user_type = strip_tags(trim($request->user_type));
               

                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->phone = $phone;
                $user->role_id = $user_type;
                $user->password = Hash::make($password);

                if($user->save())
                {  

                 return \Response::json(['response_code' => 200,'response_message' => 'User Sign Up Successfully.'], 200);
                }
                else
                {
                    return \Response::json(['response_code' => 400,'response_message' => 'Unable To Sign Up The User'], 200);
                }

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }

   /**
     * Logout the User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $validated_data = [
                'user_id' => 'required',
                'device_type' => 'required',
                'device_token' => 'required'
            ];

            $validator = Validator::make(
                $request->all(),
                $validated_data
            );

            if ($validator->fails()) {
                return response()->json(
                    [
                        'response_code' => 400,
                        'response_message' => $validator->errors()->first()
                    ],
                    200
                );
            }
            
            
            $users_device = UserDevice::where('user_id',$request->user_id)->where('device_token',$request->device_token)->where('device_type',$request->device_type)->get();
            
            if(count($users_device)>0){
                foreach($users_device as $data){
                    
                    $data->delete();
                }
                
                $value = $request->bearerToken();
                $id= (new Parser())->parse($value)->getHeader('jti');
                $token = $request->user()->tokens->find($id);
                $token->delete();

                return response()->json(
                    [
                        'response_code' => 200,
                        'response_message' => 'Successfully logged out.'
                    ],
                    200
                ); 
            }else{

                $value = $request->bearerToken();
                $id= (new Parser())->parse($value)->getHeader('jti');
                $token = $request->user()->tokens->find($id);
                $token->delete();

                return response()->json(
                [
                    'response_code' => 200,
                    'response_message' => 'Successfully logged out.'
                ],
                200
                );
            }
           
            
            // Device type and ID will be deleted
            

           
        
        } catch(Exception $e) 
        {
            return response()->json(
                [
                    'response_code' => 400,
                    'response_message' => $e->getMessage()
                ],
                200
            );
        }
    }
    
    
    /**
     * Send OTP : Forget Password.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendOtp(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'email' => 'required|min:3|max:255',
            'user_type'=>'required'
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

                $email = $request->email;
                $user_type = $request->user_type;
                $user = User::where('email',$email)->where('role_id',$user_type)->first();
                if(isset($user)){
                    $digits = 6;
                    // generating New OTP
                    $user_check = UserOtp::where('email',$email)->get();
                    if(count($user_check)>0){
                        foreach ($user_check as $key => $value) {
                            $value->delete();
                        }
                        
                    }
                    $user_otp = new UserOtp();
                    $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT); // Generating OTP
                    $user_otp->otp = $otp;
                    $user_otp->email = $email;
                    $user_otp->user_id = $user->id;
                    $user_otp->save();  

                    $data['user_id'] = $user['id'];
                    $data['email']=$user['email'];
                    $data['otp']=$otp;
                    $email = "aayushiquantum@gmail.com";
                    $to = "somebody@example.com";
                    $subject = "My subject";
                    $message = "<p>Hello User!</p><br />
                                Your Otp For Reset Password is . 
                                ".$otp;
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From:".$email;

                    mail($data['email'],"Verification OTP",$message,$headers);

                    //mail($email,$data['email'], "OTP MESSAGE",$otp);

                     // $data  = array('otp'=>$otp);
                     //  Mail::send('email.otp_email', $data, function($message) use($email) 
                     // {

                     //    $message->from('aayushiquantum@gmail.com', 'Verification OTP');
                     //    $message->to($email)->subject('Verification');

                     // });

                    return \Response::json(['response_code' => 200,'response_message' => 'OTP send Successfully.','result' => $data], 200);


                }else{

                    return \Response::json([ 'response_code' => 400,'response_message' => 'Invalid Email ID'], 200);
                }
                

            }catch(Exception $e){

                 return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }	                
    }
}


    /**
     * Verify OTP : Forget Password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function VerifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'otp' => 'required|numeric',
            'email' => 'required',
            'user_id' => 'required'

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
                $chck_expire_otp = UserOtp::where('email',$request->email)->first();
                $to = date("i");
                $from = date("i",strtotime($chck_expire_otp->updated_at));
                // Check if OTP time is greater than 3 minutes return in response expire OTP 
                if($from>=($to-3))
                {
                    $user_otp = UserOtp::where('email',$request->email)->where('otp',$request->otp)->first();

                    if(isset($user_otp))
                    {   
                        $user_otp->otp=0;
                        $user_otp->save();
                        $data['user_id'] = $user_otp['user_id'];
                        $data['email']=$user_otp['email'];

                        return \Response::json(['response_code' => 200,'response_message' => 'OTP verified successfully.','result' => $data], 200);
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

    /**
    // Reset Password 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric',
            'email' => 'required',
            'new_password' => 'required|min:8|same:confirm_password|max:16',
            'confirm_password' => 'required|min:8||max:16',
            ]);
        if ($validator->fails()) 
        {
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
                // Validate User with Phone number and User Name
                $user = User::where(['email'=>$request->email,'id'=>$request->user_id])->first();
                if($user)
                {
                    // Update Password 
                    $update_password = User::where('id', $user->id)->update(['password' => hash::make($request->new_password)]);
                    if($update_password)
                    {
                          return \Response::json(['response_code' => 200,'response_message' => 'Password changed successfully.'], 200);
                      }
                    else
                    {   
                        return \Response::json(['response_code' => 400,'response_message' => 'Password not changed.'], 200);
                    }
                }
                else
                {   
                    return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.'], 200);
                }
            }catch(Exception $e){

                return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proSignup(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'pro_id' => 'required|numeric',
            'company_name' => 'required',
            'business_address' => 'required',
            'phone_no' => 'required|numeric',
            'services' => 'required',
            'service_desc'=>'required',
            'service_duration'=>'required',
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required',
            // 'transaction_id'=>'required',
            // 'customer_id' => 'required',
            // 'amount' => 'required',
            'city'=>'required',
            'province'=>'required',
            'postal_code'=>'required',
            'experience'=>'required|numeric|min:1',
            'own_vehicle'=>'required',
            'distance'=>'required|numeric',
            ]);
        if ($validator->fails()) 
        {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first(),
                ],
                200
            );
        } 
        else 
        {
            try
            {    
                 
                $user = User::where('id',$request->pro_id)->where('role_id',3)->first();
                if(isset($user)){
              
                    $pro_av_details = ProDetail::where('pro_id',$request->pro_id)->delete();
                    $pro_detail = new ProDetail();
                    $pro_detail->pro_id = $request->pro_id;
                    $pro_detail->company_name = $request->company_name;
                    $pro_detail->business_address = $request->business_address;
                    $pro_detail->phone_no = $request->phone_no;
                    $pro_detail->commission_perc = '20';
                    // $pro_detail->transaction_id = $request->transaction_id;
                    // $pro_detail->amount = $request->amount;
                    $pro_detail->city = $request->city;
                    $pro_detail->province = $request->province;
                    $pro_detail->postal_code = $request->postal_code;
                    $pro_detail->experience = $request->experience;
                    $pro_detail->vehicle_owner = $request->own_vehicle;
                    $pro_detail->distance = $request->distance;
                    
                    if($pro_detail->save()){


                        //$pro_service = ProService::where('pro_id',$request->pro_id)->delete();
                     
                       // $services_av = Service::pluck('id')->toArray();
                        $services_arr = explode(",", $request->services);
                        foreach ($services_arr as $key => $value) {
                            //$val_chk = in_array($value,$services_av);
                                $pro_services = new ProService();
                                $pro_services->pro_id = $request->pro_id;
                                $pro_services->service_id = $value;
                                $pro_services->start_date = date('Y-m-d',strtotime(Carbon::now()));
                                $dat = Carbon::now()->toDateString();
                                $pro_services->end_date = date('Y-m-d', strtotime("+".$request->service_duration." months", strtotime($dat)));
                                $pro_services->save();
                            
                        }

                        /*Availability for monday*/
                        $monday_arr = explode(",",$request->monday);
                        $monday_av  = in_array("1", $monday_arr);
                        $pro_av_days = ProAvailability::where('pro_id',$request->pro_id)->delete();
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

                        $user->description = $request->service_desc;
                        $user->is_listed = 1;
                        //$user->customer_id = $request->customer_id;
                    	$user->save();
                    	
                    	$email = "info@meinhaus.ca";
                        $to = $user->email;
                        $subject = "Thanks For Registering With Us.";
                        //$htmlContent = file_get_contents(resource_path('views/website/email/reset_mail.blade.php',false, $context));
                        $message ="<html>
                        <center><a href=”” style=”cursor:none;”><img src='https://meinhaus.ca/image/reg.png' height='800px;' width='700px;'></a></center></html>";
                        // Set content-type header for sending HTML email 
                        $headers = "MIME-Version: 1.0" . "\r\n"; 
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                
                        // Additional headers 
                        $headers .= 'From: '.$email.'<'.$email.'>' . "\r\n"; 
                        $headers .= 'Cc: info@meinhaus.ca' . "\r\n"; 
                
                        mail($to ,"Thanks For Registering With Us.",$message,$headers);

                    }

                    return \Response::json(['response_code' => 200,'response_message' => 'Pro user details submitted successfully.','is_listed' => 1], 200);


                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.','is_listed' => 0], 200);
                }
               
            }catch(Exception $e){

                return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }
        }
    }
    
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proAfterSignup(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'pro_id' => 'required|numeric',
            'company_individual' => 'required|alpha',
            'ein_no' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'ssn_no' => 'required',
            'routing_no' => 'required|numeric',
            'license_no' => 'required|alpha_num',
            'account_no' => 'required|alpha_num',
            'license_doc'=>'required',
            'insurance'=>'nullable',
            'criminal_offence'=>'required'
            ]);
        if ($validator->fails()) 
        {
            return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first(),
                ],
                200
            );
        } 
        else 
        {
            try
            {    
                 
                $user = User::where('id',$request->pro_id)->where('role_id',3)->first();
                if(isset($user)){
              
                    //$pro_av_details = ProDetail::where('pro_id',$request->pro_id)->delete();
                    $pro_detail = ProDetail::where('pro_id',$request->pro_id)->first();
                    $pro_detail->pro_id = $request->pro_id;
                    $pro_detail->com_ind = $request->company_individual;
                    $pro_detail->ein_no = $request->ein_no;
                    $pro_detail->acc_first_name = $request->first_name;
                    $pro_detail->acc_last_name = $request->last_name;
                    $pro_detail->dob = $request->dob;
                    $pro_detail->ssn_no = $request->ssn_no;
                    $pro_detail->account_no = $request->account_no;
                    $pro_detail->routing_no = $request->routing_no;
                    $pro_detail->license_no = $request->license_no;
                    $pro_detail->criminal_offence=$request->criminal_offence;
                    
                    if($files = $request->file('insurance')){
                        // upload path
                        $destinationPath = public_path('/prosdoc/'); 
                        // Upload Orginal Image 
                        $input['name']=time().'33.'.$files->getClientOriginalExtension();
                        $files->move($destinationPath,$input['name']);
                        // Save In Database 
                        $pro_detail->insurance=$input['name'];
                    }
                    

                    if($files = $request->file('license_doc')){
                        // upload path
                        $destinationPath = public_path('/prosdoc/'); 
                        // Upload Orginal Image 
                        $input['name']=time().'32.'.$files->getClientOriginalExtension();
                        $files->move($destinationPath,$input['name']);
                        // Save In Database 
                        $pro_detail->license_doc=$input['name'];   
                    }
                    if($pro_detail->save()){

                    return \Response::json(['response_code' => 200,'response_message' => 'Pro user details submitted successfully.','is_listed' => 1], 200);

                    }
                    
                }else{

                    return \Response::json(['response_code' => 400,'response_message' => 'User does not exist.','is_listed' => 0], 200);
                }
               
            }catch(Exception $e){

                return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}