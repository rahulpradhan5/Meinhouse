<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Service;
use App\Models\ProAvailability;
use App\Models\CustomBooking;
use App\Models\Custom_orders;
use App\Models\ProReview;
use App\Models\ProLead;
use App\Models\Promocode;
use App\Models\ProService;
use App\Models\UserTransaction;
use Carbon\Carbon;
use Session;
use DB;
use Validator, Input, Redirect, Hash;
use Illuminate\Support\Str;
use \PDF;
use Mail;
use Stripe;
   

class UserController extends Controller
{

    public function Dashboard()
    {
        $id=Auth::user()->id;
       
        if(auth::user()){

            $data['bookings'] = Booking::where('user_id',auth::user()->id)->whereIn('booking_status',[0,1,5,6])->orderBy('id','DESC')->get();
            
        }
   
        return view('user.dashboard',$data);
    }

    public function Past()
    {
        $bookings = array();
        if(auth::user()){

            $past_bookings = Booking::where('user_id',auth::user()->id)->whereNotIn('booking_status',[0,1,5,6])->orderBy('id','DESC')->get();
        }
        return view('user.past',compact('past_bookings'));
    }
    public function Register()
    {
        return view('website.register');
    }
    public function books()
    {
        return view('user.booking2');
    }
    public function editprofile()
    {
        $id=Auth::user()->id;
        $data['user']=User::where(['id'=>Auth::user()->id])->get()->first();
        $data['addresses'] = DB::table('users')
            ->join('user_addresses', 'users.id', '=', 'user_addresses.user_id')
            ->select('user_addresses.*')
            ->where('users.id',$id)
            ->get();
        return view('user.edit_profile',$data);
    }
    public function addaddress(Request $request)
    {
        $id=Auth::user()->id;
        $validator = $request->validate([
            'address_type' => 'required',
            'address_name' => 'required|max:60|min:3',
            'address' => 'required|max:60|min:3',
            'locality' => 'required|max:60|min:3',
            'city' => 'required|max:60|min:3',
            'pin_code' => 'required|max:60|min:3',
            'state' => 'required',
            
            ]);

       
                $type =  $request->address_type;
                $name = $request->address_name;
                $address =  $request->address;
                $locality = $request->locality;
                $city =  $request->city;
               
                $pincode = $request->pin_code;
                $state = $request->state;
        

                $user = new UserAddress();
                $user->user_id=$id;
                $user->address_type=$type;
                $user->name = $name;
                $user->area = $address;
                $user->locality = $locality;
                $user->city = $city;
                $user->state = $state;
                $user->primary = $request->is_primary ? $request->is_primary : '0';
                $user->pin_code = $pincode;

                if($user->save())
                {

                    return redirect('editprofile')->with('amessage','Profile Successfully Updated');
                }
                else
                {
                    return redirect('editprofile')->with('amessage','Error In Updating');

                }

        
    
    }
    public function editAddress(Request $request){

        $address = UserAddress::where('id',$request->id)->first();
        return \Response::json(['response_code' => 200,'response_message' => 'Address Fetched Successfully.','data'=>$address], 200);
    }
    public function showBooking(Request $request)
    {
      $booking_id = $request->booking_id;
      $booking = Booking::with('serviceDetails','userDetails')->where('booking_show_id',$booking_id)->first();
      if(isset($booking)){
          return redirect('booking-details/'.$booking->id);
      }else{
          return redirect()->back()->with('alert','Invalid Booking');
      }

    }
    public function postEditAddress(Request $request){
        
        //print_r($request->all());exit;
         $address = UserAddress::where('id',$request->edit_id)->first();
            
            if($request->edit_is_primary == 1){

                $addresses = UserAddress::where('user_id',Auth::user()->id)->get();

                if(count($addresses)>0){

                    foreach ($addresses as $key => $value) {
                        
                        $value->primary = 0;
                        $value->save();
                    }
                }
            }

            $address->user_id = auth::user()->id;
            $address->address_type = $request->edit_address_type;
            $address->name = $request->edit_address_name;
            $address->area = $request->edit_address;
            $address->locality = $request->edit_locality;
            $address->city = $request->edit_city;
            $address->state = $request->edit_state;
            $address->pin_code = $request->edit_pin_code;
            $address->primary = $request->edit_is_primary ? $request->edit_is_primary : '0';

            if($address->save()){
                return redirect('editprofile')->with('amessage','Profile Successfully Updated');
                
            }
    }
    public function updateprofile(Request $request)
    {
        $id=Auth::user()->id;
       
        $validator =  $request->validate([
            'name' => 'required|max:60|min:3|regex:/^[a-zA-Z ]*$/',
            'phone_no'=> 'required|min:3|max:15|unique:users,phone,'.$id
            
            ]);

     

           
            $user = User::find(Auth::user()->id);
   
               if ($files = $request->file('profile_image')) {
                   // Define upload path
                  $destinationPath = public_path('/uploads/users'); // upload path
                   // Upload Orginal Image 
                   $image=time().'.'.$files->getClientOriginalExtension();
                  $files->move($destinationPath,$image);
                   // Save In Database 
                  $user->user_image=$image;       
               }
                $name =  $request->name;
                $phone = $request->phone_no;
                
                $user->name = $name;
                
                $user->phone = $phone;
                if($user->save())
                {

                    return redirect('editprofile')->with('message','Profile Successfully Updated');
                }
                else
                {
                    return redirect('editprofile')->with('message','Error In Updating');

                }

        
    

    }
    public function bookingDetail($id)
    {   

        $booking = Booking::where('id',$id)->where('user_id',auth::user()->id)->first();
        if(isset($booking)){
        $review_avg = ProReview::where('pro_id',$booking->pro_id)->orderBy('id','DESC')->avg('stars');
        $count = Booking::where('pro_id',$booking->pro_id)->where('booking_status',7)->count();
        }
        if(isset($booking)){

            return view('user.booking2',compact('booking','review_avg','count'));  
        }else{
            return redirect()->back()->with('error','Invalid Booking');
        }
       
        
    }
    
    
    public function makePayment(Request $request)
    {
        $user_id = Auth::user()->email;
        $custId = Auth::user()->customer_id;
        $amount = $request->amount;
        $service_time = $request->service_time;
        $id = $request->booking_id;
        return view('user.payment',compact('amount','id','service_time'));

    }

    public function makePaymentPost(Request $request)
    {
        
        if($request->service_amount > 10)
        {
            Stripe\Stripe::setApiKey('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');
            try{
                Stripe\PaymentIntent::create ([
                    "amount" => 100*$request->service_amount,
                    "currency" => "CAD",
                    // "source" => $request->stripeToken,
                    'payment_method_types' => ['card'],
                    "description" => $request->holder_name.' '.'has made payment for service'
                ]);
            }
            catch(\Stripe\Exception\CardException $e){
                //return redirect()->route('transactionSuccessfull', compact('BookingId'));
                return view('transactionError',compact('e'));
            }catch (\Stripe\Exception\RateLimitException $e) {
              return view('transactionError',compact('e'));
            } catch (\Stripe\Exception\InvalidRequestException $e) {
              return view('transactionError',compact('e'));
            } catch (\Stripe\Exception\AuthenticationException $e) {
              return view('transactionError',compact('e'));
            } catch (\Stripe\Exception\ApiConnectionException $e) {
              return view('transactionError',compact('e'));
            } catch (\Stripe\Exception\ApiErrorException $e) {
              return view('transactionError',compact('e'));
            } catch (Exception $e) {
              return view('transactionError',compact('e'));
            }
    
            $user_id = Auth::user()->id;
            $booking = Booking::where('id',$request->booking_id)->where('user_id',$user_id)->where('booking_status',5)->first();
            if(isset($booking)){
    
                $transaction = new UserTransaction();
                $transaction->user_id = $user_id;
                $transaction->booking_id = $request->booking_id;
                $transaction->transaction_id = 'MH-'.uniqid();
                $transaction->amount = $request->service_amount;
                $transaction->save();
    
                $booking->booking_status = 7;
                $booking->save();
    
                $user = User::where('id',$user_id)->first();
                $user->customer_id = $request->customer_id;
                $user->save();
    
                return view('user.transactionSuccess');
                // return redirect(url("payment-success/$request->booking_id"));
                // return \Response::json(['response_code' => 200,'response_message' => 'Transaction completed','is_payment' => '1'], 200);
    
            }else{
    
                return \Response::json(['response_code' => 400,'response_message' => 'Unable to do payment.','is_payment' => '0'], 200);
            }
        }
        else
        {
            return redirect(url("booking-details/$request->booking_id"));
        }

    }
    
    public function offers(){
        $promocodes = $date = Carbon::now()->toDateString();
        $promocodes = Promocode::whereDate('start_date','<=',$date)->whereDate('end_date','>=',$date)->orderBy('id','DESC')->get(); 
        return view('user.offers',compact('promocodes'));
    }    
    public function updatepassword(Request $request)
    {
        $id=Auth::user()->id;
        $validator = $request->validate([
            'current_password' => 'required|max:60|min:3',
            'new_password' => 'required|max:60|min:3',
            'new_password_confirmation' => 'required|max:60|min:3',
            ]);

      
        
        
        $current_password=$request->current_password;
        $user = User::find($id);
        if (Hash::check($current_password, $user->password)) {
            
            $password = $request->new_password;
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($password);
            if($user->save())
            {

                return redirect('editprofile')->with('pmessage','Profile Successfully Updated');
            }
            else
            {
                return redirect('editprofile')->with('error','Error In Updating');

            }
            // Success
        }
        else
        {
            return redirect('editprofile')->with('error','Old Password Mismatched');

        }
        // if(Auth::attempt($credentials)){
            
        // }

                

        
    
    }
    public function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:60|min:3|alpha',
            'last_name' => 'required|max:60|min:3|alpha',
            'email' => 'required|min:3|max:255|unique:users,email',
            'phone_no' => 'required|min:10|max:15',
            'password' => 'required|min:6|max:16',
            'confirm_password' => 'required|min:6|max:16|same:password'
            ]);

        if($validator->fails()){

            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        else
        {


                $name = strip_tags(trim($request->first_name.' '.$request->last_name));
                $email = $request->email;
                $phone = $request->phone_no;
                $password = $request->password;
                $user_type = $request->user_type;

                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->phone = $phone;
                $user->role_id = 2;
                $user->password = Hash::make($password);

                if($user->save())
                {

                    return redirect('login')->with('success','Sign Up Successfully. Login To Continue.');
                }
                else
                {
                    return redirect('register')->with('message','Unable To Sign Up.');

                }




                  return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        }
    }

    public function Login()
    {
        return view('website.login');
    }

    public function login_post(Request $request)
	{
	    $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:60|min:3',
            'password' => 'required|min:8|max:16'
        ]);

        if($validator->fails()){

            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $remember_me = $request->has('remember') ? true : false; 
        
	     $credentials = $request->only('email','password');
        if(Auth::attempt($credentials,$remember_me)){
            if(Auth::user()->status == 0){
                
                Session::flush();
                Auth::logout();
                return redirect('login')->with('message','You are blocked by admin.');
            }
            if(Auth::user()->role_id == 2){
                $useLoginId=User::where(['email'=>$request->email])->get();
                session()->put('user-login-id',$useLoginId[0]->id);
                return redirect(url('dashboard'));
            }else{
                Session::flush();
                Auth::logout();
                return redirect('login')->with('message','You are not authorised to access this page.');
            }
            }else{
                Session::flush();
                Auth::logout();
                $request->session()->flash('message', 'Invalid Username and Password.');
                //return redirect(url('admin-login'));
                return redirect(url('login'));
                }

    }


    public function booking(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_id'=>'required|numeric|exists:services,id',
            'date'=>'required|date',
            'time'=>'required|max:3',
            'phone_no'=>'required',
            'timing_constraints'=>'required|max:255',
            'description'=>'required|max:1000'
            ]);
          if($validator->fails()){

            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }else{

            try{

            $data = $request->all();
            if(!(auth::check())){
                Session::put('booking_data', $data);
                return redirect('login');
            }

              if(isset($request->address_id)){

                $address = UserAddress::where('id',$request->address_id)->first();
                $area = $address->area;
                $address_type = $address->address_type;
                $name = $address->name;
                $locality = $address->locality;
                $city = $address->city;
                $pin_code = $address->pin_code;
                $state = $address->state;

              }else{

                $area = $request->address;
                $address_type = $request->address_type;
                $name = $request->name;
                $locality = $request->locality;
                $city = $request->city;
                $pin_code = $request->pin_code;
                $state = $request->state;         

                $address = new UserAddress();
                $address->user_id = auth::user()->id;
                $address->area = $area;
                $address->address_type = $address_type;
                $address->name = $name;
                $address->locality = $locality;
                $address->city = $city;
                $address->pin_code = $pin_code;
                $address->state = $state; 
                $address->primary = 0;  
                $address->save();        

              }
                $user_address = $area.','.$locality.','.$city.','.$state.','.$pin_code;

                if(auth::user()->role_id != 2){

                     return redirect()->back()->withError('Unauthorized Access.');

                }
                $booking = new Booking();
                $booking->user_id = Auth::user()->id;
                $booking->service_id = $request->service_id;
                $booking->home_type = $address_type;
                $booking->address = $user_address;
                $booking->name = $name;
                $booking->area = $area;
                $booking->locality = $locality;
                $booking->city = $city;
                $booking->state = $state;
                $booking->pin_code = $pin_code;
                $booking->date = date('d-m-Y',strtotime($request->date));
                $booking->time = $request->time;
                $booking->phone_no = $request->phone_no;
                $booking->timing_constraints = $request->timing_constraints;
                $booking->description = $request->description;
                $booking->pro_id = $request->pro_id;
                $booking->promocode_id = $request->code ? $request->code : '';
                $booking->es_sqfs = $request->est_area ? $request->est_area : '';
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

                    $pro_service = ProService::where('service_id',$request->service_id)->pluck('pro_id');
                    $pro_available = array();

                    if(count($pro_service)>0){

                        $day_id = date("N",strtotime($request->date));

                        $time = $request->time;

                        foreach ($pro_service as $key => $value) {
                        
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
                        
                        if(count($pro_available)<= 0){
                            return redirect()->back()->withError('No Professionals available.');
                        }
 
                    }else{

                        return redirect()->back()->withError('No Professionals available.');
                    }

                if($booking->save()){

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

                    // $message = "Your request for Service ".$booking['serviceDetails']['name']." Booked Successfully for date and time ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
                    // $deviceTokens = UserDevice::where('user_id',Auth::user()->id)->where('notification_status',1)->pluck('device_token');
                    // $notification_id = $helper->activity_save(Auth::user()->id,'Service Booked Successfully',$message,$booking->booking_status,$booking->id);
                    // $data['notification_id'] = $notification_id;
                    // $data['type'] = $booking->booking_status;
                    // $data['booking_id'] = $booking->id;
                    // $helper->globalPushNotificationMultiple($deviceTokens,'Service Booked Successfully',$message,$data);

                    if(count($pro_available) > 0){

                        foreach ($pro_available as $key => $value1) {
                            //print_r($value1);exit;
                            $leads = new ProLead();
                            $leads->booking_id = $booking->id;
                            $leads->pro_id = $value1['pro_id'];
                            $leads->save();

                    //         $subject = "Booking Request For Service ".$booking['serviceDetails']['name'];
                    //         $message = $booking->name ." generate a request for service ".$booking['serviceDetails']['name']." on ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
                    //         $deviceTokens = UserDevice::where('user_id',$value1['pro_id'])->where('notification_status',1)->pluck('device_token');
                    //         $notification_id = $helper->activity_save($value1['pro_id'],$subject,$message,$booking->booking_status,$booking->id);
                    //         $data['notification_id'] = $notification_id;
		                  //  $data['type'] = $booking->booking_status;
		                  //  $data['booking_id'] = $booking->id;
                            // $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
                        }
                    }

                  return redirect()->back()->with('booking','Service Booked Successfully');

                }
                    

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
        // if($validator->fails()){

        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // else
        // {
        //     $booking = new Booking();
        //     $booking->user_id = Auth::user()->id;
        //     $booking->service_id = $request->service_id;
        //     $booking->home_type = $request->address_type;
        //     $booking->address = $request->address;
        //     $booking->name = $request->name;
        //     // $booking->area = $area;
        //     // $booking->locality = $locality;
        //     $booking->city = $request->city;
        //     $booking->state = $request->state;
        //     $booking->pin_code = $request->pin_code;
        //     $booking->date = date('d-m-Y',strtotime($request->date));
        //     $booking->time = $request->time;
        //     $booking->phone_no = $request->phone_no;
        //     $booking->timing_constraints = $request->timing_constraints;
        //     $booking->description = $request->description;
        //     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //     $pin = mt_rand(1000, 9999)
        //         . $characters[rand(0, strlen($characters) - 2)]
        //         . mt_rand(10, 99);
        //     $string = str_shuffle($pin);
        //     $booking->booking_show_id = 'OD-'.$string;
        //     if($booking->save()){
        //         return redirect()->back()->with('booking','Service Booked Successfully');
        //     }
        // }
    }

    public function deleteaddress($id){
        DB::table('user_addresses')->where('id',$id)->delete();
        return redirect('editprofile')->with('amessage','Profile Successfully Updated');
    }
    public function addprimaryaddress($id){
        $address = UserAddress::where('id',$id)->first();
        $addresses = UserAddress::where('user_id',Auth::user()->id)->get();

            if(count($addresses)>0){

                foreach ($addresses as $key => $value) {
                    
                    $value->primary = 0;
                    $value->save();
                }
            }
        
            $address->primary = 1;

            if($address->save()){
                return redirect('editprofile')->with('amessage','Profile Successfully Updated');
                
            }
    }
    public function custom_booking()
    {
        $booking = '';
        $services = Service::where('status',1)->orderBy('name','ASC')->get();
        $popular_services = Service::orderBy('booking_count','DESC')->limit('5')->get();
        $addresses = array();
        if(auth::user()){
            $addresses = UserAddress::where('user_id',auth::user()->id)->orderBy('id','DESC')->get();
        }
        return view('website.custom_bookings',compact('services','popular_services','addresses'));
    }
    public function customBookingPost(Request $request)
    {

        /* Booking time
            0 = morning
            1 = midnoon
            2= afternoon
            3 = evening
        */
        /*  Address type
            0=home,1=office,2=other
        */
        
        $validator = Validator::make($request->all(),[
            'service_id'=>'required',
            'address_type'=>"required",
            'name'=>'required',
            'address'=>'required',
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
         if($validator->fails()){
            
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }else{
            
            try{
                
              $datas_cus = $request->all();
                if(!(auth::check())){
                    Session::put('cus_booking_data', $datas_cus);
                    return redirect('userlogin');
                }
            
              if(isset($request->address_id)){

                $address = UserAddress::where('id',$request->address_id)->first();
                $area = $address->area;
                $address_type = $address->address_type;
                $name = $address->name;
                $locality = $address->locality;
                $city = $address->city;
                $pin_code = $address->pin_code;
                $state = $address->state;

              }else{

                $area = $request->address;
                $address_type = $request->address_type;
                $name = $request->name;
                $locality = $request->locality;
                $city = $request->city;
                $pin_code = $request->pin_code;
                $state = $request->state;         

                $address = new UserAddress();
                $address->user_id = auth::user()->id;
                $address->area = $area;
                $address->address_type = $address_type;
                $address->name = $name;
                $address->locality = $locality;
                $address->city = $city;
                $address->pin_code = $pin_code;
                $address->state = $state; 
                $address->primary = 0;  
                $address->save();        

              }
                $user_address = $area.','.$locality.','.$city.','.$state.','.$pin_code;

                if(auth::user()->role_id != 2){

                     return redirect()->back()->withError('Unauthorized Access.');

                }
                
                $service_id = implode(",",$request->service_id);
                
                $booking = new CustomBooking();
                $booking->user_id = Auth::user()->id;
                $booking->service_id = $service_id;
                $booking->home_type = $address_type;
                $booking->address = $user_address;
                $booking->name = $name;
                $booking->area = $area;
                $booking->locality = $locality;
                $booking->city = $city;
                $booking->state = $state;
                $booking->pincode = $pin_code;
                $booking->date = date('d-m-Y',strtotime($request->date));
                $booking->time = $request->time;
                $booking->phone_no = $request->phone_no;
                $booking->description = $request->description;
                $booking->email = $request->email_id;
                $booking->amount = $request->price;
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

                if($booking->save()){
                    if($request->hasFile('images'))
                    {
                        $names = [];
                        foreach($request->file('images') as $image)
                        {
                            $destinationPath = public_path().'/custom_bookings'; //url('public/custom_bookings')
                            $filename = $image->getClientOriginalName();
                            $image->move($destinationPath, $filename);
                            array_push($names, $filename);          
                    
                        }
                        
                        foreach($names as $key => $name){
                            $custom = new Custom_orders;
                            $custom->image_name = $name;
                            $custom->user_id = Auth::user()->id;
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

                    $ser_arr = array();
                   $servicess = explode(',',$booking->service_id);
                   $ser_name = Service::whereIn('id',$servicess)->pluck('name')->toArray();
                   $service_name = implode(",",$ser_name);
                   
                    $path =url('public/custom_bookings/');
                    // $mailto = "info@meinhaus.ca";
                    // $from_mail = "info@meinhaus.ca";
                    $to = $request->email_id;
                     $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                  
                    $subject = "Custom Booking";
                    $uid = $booking->id;
                    $datas = DB::table('custom_orders')->where('booking_id', $uid)->get();
                   
                    $message = "<p>Thank you for selecting this service</p>";
                    $message .= "<p>$service_name</p>";
                   
                   
                    
             
        
                    if(mail($to,$subject,$message,$headers))
            	    { 
                        return redirect()->back()->withsuccess('Custom Booking Booked Successfully  ');
            	    }else{
            	        
            	        return redirect()->back()->withsuccess('Custom Booking Booked Successfully');
            	    }


                  

                
            	    
                }
                    

            }catch(Exception $e){

                  return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);
            }
        }
    }
    public function userCancelBooking(Request $request)
    {
        $id=$request->booking_id;
         $validator = Validator::make($request->all(),[
            'booking_id' => 'required|numeric|exists:bookings,id',
            'cancel_reason_u' => 'required',
            ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
    else
    {    
       
        try{

        		$booking = Booking::where('id',$id)->first();

        		if($booking->booking_status == 5){
        		    
        		    return redirect()->back()->withError('Booking is completed.You can not cancel it now.');

        		}

                if($booking->booking_status == 6){
                    
                    return redirect()->back()->withError('Booking can not be cancelled as service is already started.');


                }


        		$booking->booking_status = 3;
        		$booking->pro_status = 3;
        		$booking->cancel_reason_u = $request->cancel_reason_u;


        		if($booking->save()){

                    $pro_booking = ProLead::where('booking_id',$booking->id)->whereIn('status',array(0,1))->get();
                    if(count($pro_booking)>0){
                    $booking = Booking::where('id',$booking->id)->first();
                        foreach ($pro_booking as $key => $value) {
                           
                           $value->status = 3;
                           $value->save();

                        }
                    }
                    
                    return redirect()->back()->withSuccess('Booking cancelled successfully.');

        		}else{
                    
                    return redirect()->back()->withError('Unable to cancel the booking.');

        		}

        	}catch(Excption $e){

                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        	}
    } 
    }
    public function logout()
	{
	Auth::logout();
	Session::flush();
	return redirect(url('login'));
	}
	//forgot password code
	 public function forgotPassword()
    {
        return view('website.forget_password');
    }
 public function forgotSendMail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email',$email)->where('role_id',2)->first();   

        if($user){

            $token = Str::random(60);
            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            //Get the token just created above
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();

            $data['user_id'] = $user['id'];
            $data['email']=$user['email'];
            $data['url'] =url('/password-reset/'.$token);
            $url=$data['url'];
         $to = $data['email'];
        $subject = 'Password Reset Link';
        

        $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Password Reset Link</title>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
        </head>
        <body style='background-color: #F0F3F7;'>
            <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
            <div style='width: 100%; background-color: white; padding-bottom: 20px;' class='container'>
                <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt='' width='217px' height='70px'></h1>
                
                <hr>
                <h3 style='text-align: center; font-size: 17px;'>You can use this link to reset Your password.</p>
                <br>
                <h5 style='text-align: center;'>
                $url
                   </h5>
                <br>
               
                <div style='text-align: center;'>
                    
                    <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                    <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


                </div>
            </div>
            </div>
        </body>
        </html>";

            // Additional headers 
          
            
          $mail= mail($to,$subject,$message,$headers);
          
  
            if($mail)
{
            return redirect()->back()->withSuccess('Email send Successfully.');
}
else{
    return redirect()->back()->withError('Internal error');  
}

        }else{

            return redirect()->back()->withError('Email ID does not exist.');
        }
    }

public function resetPassword($token){

        // Validate the token
        $tokenData = DB::table('password_resets')
        ->where('token', $token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return redirect('login')->withError('Invalid Token.');

        $user = User::where('email',$tokenData->email)->first();

        if (!$user) return redirect()->back()->withErrors('Email not found');

        return view('website.reset_password',compact('token'));
    }


    public function resetPasswordSave(Request $request){

        // Validate the token
        $tokenData = DB::table('password_resets')
        ->where('token', $request->token)->first();

        $user = User::where('email',$tokenData->email)->first();

        //Hash and update the new password
        $user->password = Hash::make($request->password);
        $user->save(); 

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        return redirect('login')->withSuccess('Password Reset Successfully.Login To Continue.');
    }
    
    
   
     public function  ViewInvoice ($id)
    {
     $invoice=Booking::with('userDetails','serviceDetails')->where('pdf',$id)->first();
    
    
     return view('user.invoice',compact('invoice'));
     
     
    }
	  public function Invoice ($id)
    {
     $invoice=Booking::with('userDetails','serviceDetails')->where('pdf',$id)->first();
     
     $data=[
         'invoice'=>$invoice,
         ];
    
     $pdf= PDF::loadView('pdf',$data);
      return $pdf->download('invoice.pdf');
     
     
    }
	
}
