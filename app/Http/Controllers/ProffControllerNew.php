<?php







    namespace App\Http\Controllers;



    use App\Models\Professional;



    use Illuminate\Http\Request;



    use Illuminate\Support\Facades\Auth;



    use App\Models\User;



    use App\Models\ProAvailability;

    use App\Models\ProDetail;

    use App\Models\ProService;

    use App\Models\ProReview;

    use App\Models\ProLead;

    use App\Models\Service;

    use App\Models\Booking;

    use Session;

    use Carbon\Carbon;

    use DB;

     use PDF;

    use Validator, Input, Redirect, Hash; 



class ProffControllerNew extends Controller



{

// Dashboard Login Register

    public function index()

    {

        $data['leads'] = ProLead::with('bookingsDetail')->where('pro_id',auth::user()->id)->where('status','0')->orderBy('id','DESC')->get();   

		return view('professional_new.dashboard',$data);

    }

    public function proff_login_post(Request $request)

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

            Session::put('id',Auth::user()->id);

            if(Auth::user()->status == 0){

                

                Session::flush();

                Auth::logout();

                return redirect('pro-login')->with('error','You are blocked by admin.');

            }

            if(Auth::user()->role_id == 3){

                if($request->has('remember'))

                {

                    $hour = time() + 3600 * 24 * 30;

                    Cookie::queue('email',$request->email, $hour);

                    Cookie::queue('password',$request->password, $hour);

                    Cookie::queue('remember',1, $hour);

                }

                if(Auth::user()->is_listed == 1 && Auth::user()->state == 1){

                 return redirect()->route('pro/dashboard');

                }elseif(Auth::user()->is_listed == 1 && Auth::user()->state == 0){

                    return redirect()->route('pro-approval');

                }else{

                    return redirect()->route('pro-onboarding');

                }

             }else{

                Session::flush();

                Auth::logout();

                return redirect('pro-login')->with('error','You are not authorised to access this page.');

             }

        }else{

            return redirect('pro-login')->with('error','You have entered invalid credentials');

        }

    }

    public function registerPostproff(Request $request)

    {

        $validator = Validator::make($request->all(),[

            'first_name' => 'required|max:60|min:3',

            'last_name' => 'required|max:60|min:3',

            'email' => 'required|min:3|max:255|unique:users,email',

            'phone_no' => 'required|numeric',

            'password' => 'required|min:8|max:16',

            'confirm_password' => 'required|min:8|max:16|same:password'

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

                $user->role_id = 3;

                $user->password = Hash::make($password);

                if($user->save())

                {  

                    $credentials = $request->only('email','password');

                    $useLoginId=User::where(['email'=>$request->email])->get();

                    session()->put('id',$useLoginId[0]->id);

                    Auth::attempt($credentials);

                    return redirect('pro-onboarding')->with('message','Sign Up Successfully.');

                }

                else

                {

                    return redirect('pro-register')->with('message','Unable To Sign Up.');

                }

                  return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

        }



    }

// End

// Accept Reject

    public function pro_reject($id)

    {

        $professional_id = session('id');

        $prolead = DB::table('pro_leads')->where('booking_id',$id)->where('pro_id',$professional_id)->update(

        array('status'=>'2'));

        $booking_info = DB::table('bookings')->where('id',$id)->get();

        echo $booking_info[0]->booking_show_id;

        $booking_status = $booking_info[0]->pro_status;

        if($booking_info[0]->pro_status=='1'){

            Session::flash('error','Lead already accepted.You can not reject it now.');

            return redirect(url('pro/dashboard'));

        }

        if($booking_info[0]->pro_status=='2'){

            Session::flash('error','Lead already rejected.');

            return redirect(url('pro/dashboard'));

        }

        $bookupdate = DB::table('bookings')->where('id',$id)->update(

        array('pro_status'=>'2','booking_status'=>'2'));

        if($bookupdate){

            Session::flash('error','Lead rejected successfully.');

            return redirect(url('prof/dashboard'));

        }

    }

    public function pro_accept($id)

    {

        $professional_id = session('id');

        $booking_info = DB::table('bookings')->where('id',$id)->get();

        $date = $booking_info[0]->date;

        $time = $booking_info[0]->time;

        $pro_booking = DB::table('bookings')->where('pro_id',$professional_id)->whereIn('pro_status',[1,6])->where('date',$date)->where('time',$time)->first();

        if($pro_booking){

        Session::flash('error','Can Not Accept This Lead As You Have Already A Booking on this date and time.');

        // 		echo "<pre>";

        //         print_r($pro_booking);

        //         echo "</pre>";

        return redirect(url('pro/dashboard'));

        }

        $pro_lead = ProLead::where('booking_id',$id)->where('pro_id',auth::user()->id)->update(['status' => 1]);

        $lead = ProLead::where('booking_id',$id)->where('pro_id','!=',auth::user()->id)->where('status',0)->update(['status' => 4]);

        $bookupdate = DB::table('bookings')->where('id',$id)->update(

        array(

            'pro_status'=>'1',

            'booking_status'=>'1',

            'pro_id'=>$professional_id

        ));

        if($bookupdate){

            Session::flash('success','Booking Accepted Successfully.');

            return redirect(url('pro/dashboard'));

        }

    }

// UpdateDocuments

    public function proff_documents(Request $request)

    {

        if($request->isMethod('POST'))

        {

            $data = Professional::find($request->id);

            $data->license_no = $request->license_no;

            if($request->license_doc)

            {

                $doc = time() .".". $request->license_doc->extension();

                $request->license_doc->move(public_path('upload/pro_doc'),$doc);

                $data->license_doc = $doc;

            }

            $data->save();

            return redirect()->back()->with('success','Successfully Updated!');

        }

        $professional_id = session('id');

        $data['details'] = Professional::where('pro_id',$professional_id)->first();

        return view('professional_new.proffdocument',$data);

    }

// Banking

    public function proff_banking(Request $request)

    {

        if($request->isMethod("POST"))

        {

            $data = Professional::find($request->id);

            $data->routing_no = $request->routing_no;

            $data->account_no = $request->account_no;

            $data->city = $request->city;

            $data->province = $request->province;

            $data->postal_code = $request->postal_code;

            $data->experience = $request->experience;

            $data->distance = $request->distance;

            if($request->insurance)

            {

                $insurance = time() .".". $request->insurance->extension();

                $request->insurance->move(public_path('upload/pro_doc'),$insurance);

                $data->insurance = $insurance;

            }

            $data->save();

            return redirect()->back()->with('success','Successfully Updated!');

        }

        $professional_id = session('id');

        $data['details'] = Professional::where('pro_id',$professional_id)->first();

        return view('professional_new.proffbanking',$data);

    }

// Availibility

	public function proff_availability()

    {

		$professional_id = session('id');

		$monday = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_id',1)->first();

        $tuesday = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_id',2)->first();

        $wednesday = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_id',3)->first();

        $thursday = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_id',4)->first();

        $friday = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_id',5)->first();

        $saturday = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_id',6)->first();

        $sunday = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_id',7)->first();

        $all = DB::table('pro_availability')->where('pro_id',$professional_id)->where('day_availability',1)->count();

        return view('professional_new.proffavailability',compact('monday','tuesday','wednesday','thursday','friday','saturday','sunday','all'));

	}

	public function pro_availability_post(Request $request)

    {

		    $professional_id = session('id');

            $pro_av_days = ProAvailability::where('pro_id',$professional_id)->delete();

            $pro_availablity_mon = new ProAvailability();

            $pro_availablity_mon->day_id = 1;

            $pro_availablity_mon->pro_id = $professional_id;

            if(isset($request->monday)){

            /*Availability for monday*/

            if(count($request->monday)>0){

                $pro_availablity_mon->day_availability = 1;

                foreach ($request->monday as $key => $value) {

                    $avail = explode('_', $value);

                    //print_r($avail[1]);

                    if($avail[1] == 1){

                        $pro_availablity_mon->morning = 1;

                    }

                    if($avail[1] == 2){

                        $pro_availablity_mon->midnoon = 1;

                    }

                    if($avail[1] == 3){

                        $pro_availablity_mon->afternoon = 1;

                    }

                    if($avail[1] == 4){

                        $pro_availablity_mon->evening = 1;

                    }

                }

            }else{

                $pro_availablity_mon->day_availability = 0;

                $pro_availablity_mon->morning = 0;

                $pro_availablity_mon->midnoon = 0;

                $pro_availablity_mon->afternoon = 0;

                $pro_availablity_mon->evening = 0;

            }

            }

            $pro_availablity_mon->save();

            $pro_availablity_tues = new ProAvailability();

            $pro_availablity_tues->day_id = 2;

            $pro_availablity_tues->pro_id = $professional_id;

            /*Availability for tuesday*/

            if(isset($request->tuesday)){

            if(count($request->tuesday)>0){

                $pro_availablity_tues->day_availability = 1;

                foreach ($request->tuesday as $key => $value) {

                    $avail = explode('_', $value);

                    if($avail[1] == 1){

                        $pro_availablity_tues->morning = 1;

                    }

                    if($avail[1] == 2){

                        $pro_availablity_tues->midnoon = 1;

                    }

                    if($avail[1] == 3){

                        $pro_availablity_tues->afternoon = 1;

                    }

                    if($avail[1] == 4){

                        $pro_availablity_tues->evening = 1;

                    }

                }

            }else{

                $pro_availablity_tues->day_availability = 0;

                $pro_availablity_tues->morning = 0;

                $pro_availablity_tues->midnoon = 0;

                $pro_availablity_tues->afternoon = 0;

                $pro_availablity_tues->evening = 0;

            }

            }

            $pro_availablity_tues->save();

            $pro_availablity_wednes = new ProAvailability();

            $pro_availablity_wednes->day_id = 3;

            $pro_availablity_wednes->pro_id = $professional_id;

            /*Availability for wednesday*/

            if(isset($request->wednesday)){

                if(count($request->wednesday)>0){

                    $pro_availablity_wednes->day_availability = 1;

                    foreach ($request->wednesday as $key => $value) {

                        $avail = explode('_', $value);

                        if($avail[1] == 1){

                            $pro_availablity_wednes->morning = 1;

                        }

                        if($avail[1] == 2){

                            $pro_availablity_wednes->midnoon = 1;

                        }

                        if($avail[1] == 3){

                            $pro_availablity_wednes->afternoon = 1;

                        }

                        if($avail[1] == 4){

                            $pro_availablity_wednes->evening = 1;

                        }

                    }

                }else{

                    $pro_availablity_wednes->day_availability = 0;

                    $pro_availablity_wednes->morning = 0;

                    $pro_availablity_wednes->midnoon = 0;

                    $pro_availablity_wednes->afternoon = 0;

                    $pro_availablity_wednes->evening = 0;

                }

            }

            $pro_availablity_wednes->save();                                                                         

            $pro_availablity_thurs = new ProAvailability();

            $pro_availablity_thurs->day_id = 4;

            $pro_availablity_thurs->pro_id = $professional_id;

            /*Availability for thursday*/

            if(isset($request->thursday)){

                if(count($request->thursday)>0){

                    $pro_availablity_thurs->day_availability = 1;

                    foreach ($request->thursday as $key => $value) {

                        $avail = explode('_', $value);

                        if($avail[1] == 1){

                            $pro_availablity_thurs->morning = 1;

                        }

                        if($avail[1] == 2){

                            $pro_availablity_thurs->midnoon = 1;

                        }

                        if($avail[1] == 3){

                            $pro_availablity_thurs->afternoon = 1;

                        }

                        if($avail[1] == 4){

                            $pro_availablity_thurs->evening = 1;

                        }

                    }

                }else{

                    $pro_availablity_thurs->day_availability = 0;

                    $pro_availablity_thurs->morning = 0;

                    $pro_availablity_thurs->midnoon = 0;

                    $pro_availablity_thurs->afternoon = 0;

                    $pro_availablity_thurs->evening = 0;

                }

            }

            $pro_availablity_thurs->save();

            $pro_availablity_fri = new ProAvailability();

            $pro_availablity_fri->day_id = 5;

            $pro_availablity_fri->pro_id = $professional_id;

            if(isset($request->friday)){

            if(count($request->friday)>0){

                $pro_availablity_fri->day_availability = 1;

                foreach ($request->friday as $key => $value) {

                    $avail = explode('_', $value);

                    if($avail[1] == 1){

                        $pro_availablity_fri->morning = 1;

                    }

                    if($avail[1] == 2){

                        $pro_availablity_fri->midnoon = 1;

                    }

                    if($avail[1] == 3){

                        $pro_availablity_fri->afternoon = 1;

                    }

                    if($avail[1] == 4){

                        $pro_availablity_fri->evening = 1;

                    }

                }

            }else{

                $pro_availablity_fri->day_availability = 0;

                $pro_availablity_fri->morning = 0;

                $pro_availablity_fri->midnoon = 0;

                $pro_availablity_fri->afternoon = 0;

                $pro_availablity_fri->evening = 0;

            }

            }

            $pro_availablity_fri->save();

            $pro_availablity_satur = new ProAvailability();

            $pro_availablity_satur->day_id = 6;

            $pro_availablity_satur->pro_id = $professional_id;

            /*Availability for saturday*/

            if(isset($request->saturday)){

            if(count($request->saturday)>0){

                $pro_availablity_satur->day_availability = 1;

                foreach ($request->saturday as $key => $value) {

                    $avail = explode('_', $value);

                    //print_r($avail[1]);

                    if($avail[1] == 1){

                        $pro_availablity_satur->morning = 1;

                    }

                    if($avail[1] == 2){

                        $pro_availablity_satur->midnoon = 1;

                    }

                    if($avail[1] == 3){

                        $pro_availablity_satur->afternoon = 1;

                    }

                    if($avail[1] == 4){

                        $pro_availablity_satur->evening = 1;

                    }

                }

            }else{

                $pro_availablity_satur->day_availability = 0;

                $pro_availablity_satur->morning = 0;

                $pro_availablity_satur->midnoon = 0;

                $pro_availablity_satur->afternoon = 0;

                $pro_availablity_satur->evening = 0;

            }

            }

            $pro_availablity_satur->save();

            $pro_availablity_sun = new ProAvailability();

            $pro_availablity_sun->day_id = 7;

            $pro_availablity_sun->pro_id = $professional_id;

            /*Availability for sunday*/

            if(isset($request->sunday)){

            if(count($request->sunday)>0){

                $pro_availablity_sun->day_availability = 1;

                foreach ($request->sunday as $key => $value) {

                    $avail = explode('_', $value);

                    if($avail[1] == 1){

                        $pro_availablity_sun->morning = 1;

                    }

                    if($avail[1] == 2){

                        $pro_availablity_sun->midnoon = 1;

                    }

                    if($avail[1] == 3){

                        $pro_availablity_sun->afternoon = 1;

                    }

                    if($avail[1] == 4){

                        $pro_availablity_sun->evening = 1;

                    }

                }

            }else{

                $pro_availablity_sun->day_availability = 0;

                $pro_availablity_sun->morning = 0;

                $pro_availablity_sun->midnoon = 0;

                $pro_availablity_sun->afternoon = 0;

                $pro_availablity_sun->evening = 0;

            }

            }

            if($pro_availablity_sun->save()){

                return redirect('pro/proff-availability')->with('success','Availability Successfully Updated');

            }else{

                return redirect('pro/proff-availability')->with('error','Unable To Update Availability');

			}



    }

// Business

    public function proff_business()



    {



        $professional_id = session('id');

        $services =  Service::orderBy('name','ASC')->get();

        $proservices = ProService::where('pro_id',Auth::user()->id)->pluck('service_id')->toArray();

        return view('professional_new.proffbusiness',compact('services','proservices'));



    }



    public function updateServicesPost(Request $request)

    {

        $validator = Validator::make($request->all(),[



            'services' => 'required',



            ]);

        if($validator->fails()){



        return redirect()->back()

                            ->withErrors($validator)

                            ->withInput();

        }

        else

        {

            try{



                if(isset($request->services)){



                    $pro_service = ProService::where('pro_id',Auth::user()->id)->pluck('service_id')->toArray();

                    $services = $request->services;

                    $result=array_diff($services,$pro_service);

                    $id = ProDetail::where('pro_id',Auth::user()->id)->first();

                    $pro_detail_id = $id->pro_id;

                    $service_count = count($result);

                    //payment code
                   /* Session::put('services', $result);


                    $monthly_amount = 0;
                    $yearly_amount = 0;
                    $monthly_amount = $service_count * 19.99;
                    $yearly_amount = $service_count * 143;



                $prodetails = ProDetail::where('pro_id',Auth::user()->id)->first();
                $pro_detail_id = $prodetails->pro_id;


                $total_monthly = 0 + $monthly_amount;
                $total_yearly = 0 + $yearly_amount;

                //dd($monthly_amount);
                //print_r($intent);exit;
                \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

                $amount = $total_monthly;
                $amount *= 100;
                $amount = (int) $amount;
                $customer = \Stripe\Customer::create([
                    'name' => Auth::user()->name,
                    'description' => 'Payment for registration',
                    'email'=>Auth::user()->email,
                    'address' => [
                        'line1' => $prodetails->business_address,
                        'postal_code' => $prodetails->postal_code,
                        'city' => $prodetails->city,
                        'state' => $prodetails->province,
                        'country' => 'CA',
                      ]
                ]);
                //dd($customer);
                $payment_intent = \Stripe\PaymentIntent::create([
                    'description' => 'Professional Monthly subscription',
                    'amount' => $amount,
                    'currency' => 'inr',
                    'payment_method_types' => ['card'],
                     //'payment_method'=>'card',
                    'customer'=>$customer->id
                ]);
                //dd($payment_intent);
                $intent = $payment_intent->client_secret;


                return view('professional.payment_update',compact('intent','payment_intent','pro_detail_id','monthly_amount','yearly_amount','total_monthly','total_yearly'));
*/
                        

                   
                    

                    $services_av = Service::pluck('id')->toArray();   

                    // $services_arr = explode(",", $request->services);

                    foreach ($request->services as $key => $value) {

                        $val_chk = in_array($value,$services_av);

                        if(isset($val_chk) && $val_chk == " "){

                            $pro_service_count = ProService::where([['pro_id',Auth::user()->id],['service_id',$value]])->count();

                            if($pro_service_count==0){

                            $pro_services = new ProService();

                            $pro_services->pro_id = Auth::user()->id;

                            $pro_services->service_id = $value;

                            $pro_services->save();

                            }

                        }

                    }      



                    return redirect()->back()->withSuccess('Services updated successfully.');



                }else{



                    return redirect()->back()->withError('Unable to update services.');

                    



                }

            

            }catch(Exception $e){



                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);



            }

        }

    }

// Review
public function afterPayment(request $req)
{
    $services=NULL;
     if(session()->get('services')){
        $services=session()->get('services');
    }
    //dd($services);
        if ($services) {
            foreach ($services as $key => $value) {


                $pro_services = new ProService();
                $pro_services->pro_id = Auth::user()->id;
                $pro_services->service_id=$value;
                $pro_services->start_date=Carbon::now()->format('Y-m-d');

                $pro_services->end_date= Carbon::now()->addMonth(1)->format('Y-m-d');

                $pro_services->save();

        }
        }
    $req->session()->forget('services');


    //$professional_id = session('id');
    //$services =  Service::orderBy('name','ASC')->get();
    //$proservices = ProService::where('pro_id',Auth::user()->id)->pluck('service_id')->toArray();
    return redirect()->route('proff-business');
}

    public function review()

    {

        $reviews = ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->get();

        $review_count = ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->count();

        $review_avg = ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->avg('stars');

        return view('professional_new.proffcustomer',compact('reviews','review_count','review_avg'));

    }

// edit profile

    public function edit_profile(Request $request)

    {

        $professional_id = session('id');

        if($request->isMethod("POST"))

        {

            $data = User::find($professional_id);

            $data->name = $request->name;

            $data->email = $request->email;

            $data->phone = $request->phone_no;

            if($request->profile_image)

            {

                $profile_image = time() .".". $request->profile_image->extension();

                $request->profile_image->move(public_path('upload/pro_profile'),$profile_image);

                $data->user_image = $profile_image;

            }

            $data->save();

            return redirect()->back()->with('success','Successfully Updated!');

        }

        $data['details'] = User::where('id',$professional_id)->first();

        return view('professional_new.editprofile',$data);

    }

// Change Password

    public function proff_change_password()

    {

        $professional_id = session('id');

        return view('professional_new.changepassword');

    }



    public function proff_change_password_post(Request $request)

    {   

        $validator = Validator::make($request->all(),[



            'current_password'          => 'required|min:8|max:16',

            'new_password'              => 'required|min:8|max:16',

            'confirm_password' => 'required|min:8|max:16',



            ]);



        if($validator->fails()){



            return redirect()->back()

                            ->withErrors($validator)

                            ->withInput();

        }

        else

        {

            try{ 

                if($request->new_password == $request->confirm_password){   

                    if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {

                        // The passwords matches

                        return redirect()->back()->withError("Your current password does not matches with the password you provided. Please try again.");

                    }

                    if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){

                        //Current password and new password are same

                        return redirect()->back()->withError("New Password cannot be same as your current password. Please choose a different password.");

                    }

                    //Change Password

                    $user = Auth::user();

                    $user->password = Hash::make($request->get('new_password'));

                    if($user->save())

                    {



                        return redirect()->back()->withSuccess('Password Changed Successfully');

                    }

                }

                else{

                    return redirect()->back()->with('error','Password and Confirm Password Do not Match !');

                }

            }

            catch(Exception $e){ 

                return redirect()->back()->withInput()->withErrors($e->getMessage());

            }

        }

    }

    

	public function terms_condition()

    {

		$professional_id = session('id');

		return view('professional_new.terms');

	}

	public function about()

    {

	    $professional_id = session('id');

		return view('professional_new.about');

	}



    public function proff_bookings()

    {

		$professional_id = session('id');

		$data['bookings']  = ProLead::with('bookingsDetail')->where('pro_id',Auth::user()->id)->whereIn('status',[1,6])->orderBy('updated_at','DESC')->get();

		return view('professional_new.booking',$data);

	}



    public function bookingDetail($id)

    {

        $booking = Booking::where('id',$id)->first();

        return view('professional_new.bookingdetails',compact('booking'));

    }



    public function proCancelBookings(Request $request)

    {   

        



       $validator = Validator::make($request->all(),[

            'booking_id' => 'required|numeric|exists:bookings,id',

            'cancel_reason' => 'required'

            ]);

        if ($validator->fails()) {

            return redirect()->back()

                        ->withErrors($validator)

                        ->withInput();

        } 

        else 

        {

            try{



                $booking = Booking::where('id',$request->booking_id)->first();



                if($booking->pro_status == 5){



                    return redirect()->back()->withErrors('Booking is completed.You can not cancel it now.');



                }



                if($booking->pro_status == 6){



                    return redirect()->back()->withErrors('Booking is completed.You can not cancel it now.');



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



                            //     $subject = $booking['serviceDetails']['name'] . " is cancelled by ".$booking['proDetails']['name'];

                            //     $message = "Your booking service scheduled on .".date('D,d M Y',strtotime($booking->date))." is being cancelled by ".$booking['proDetails']['name'];

                            //     $deviceTokens = UserDevice::where('user_id',$booking->user_id)->where('notification_status',1)->pluck('device_token');

                            //     $notification_id = $helper->activity_save($booking->user_id,$subject,$message,$booking->booking_status,$booking->id);

                            //     $data['notification_id'] = $notification_id;

                            //     $data['type'] = $booking->booking_status;

                            //     $data['booking_id'] = $booking->id;

                            //     $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);

                        }



                            return redirect()->back()->withSuccess('Booking cancelled successfully.');



                    }else{



                        return redirect()->back()->withSuccess('Unable to cancel the booking.');



                    }



            }else{



                return redirect()->back()->withSuccess('Unable to cancel the booking.');

            }



            }catch(Excption $e){



                return \Response::json(['response_message' => 'Error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);



            }

        }

    }



	public function past_bookings()

    {

		$professional_id = session('id');

        $data['bookings'] = ProLead::with('bookingsDetail')->where('pro_id',Auth::user()->id)->whereIn('status',[2,3,5])->orderBy('updated_at','DESC')->get();

		return view('professional_new.pastbooking',$data);

	}



    public function startServices(Request $request)

    {   



        $bookings = Booking::where('id',$request['bookingId'])->where('booking_status',1)->first();

        if(empty($bookings)){

            return \Response::json(['response_code' => 400,'response_message' => 'Unable to end service.']);

        }

        $start_services = Booking::where('pro_id',$bookings->pro_id)->where('id','!=',$request['bookingId'])->where('booking_status',6)->first();



            if(isset($start_services)){



                return \Response::json(['response_code' => 400,'response_message' => 'You can not start another service.']);



            }



            $digits = 4;

            $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT); // Generating OTP

            $bookings->otp = $otp;

            if($bookings->save()){



                $bookings = Booking::where('id',$bookings->id)->first();



                $subject = "OTP for starting the service .".$bookings['serviceDetails']['name']." is ".$otp;;

                $message = "OTP for starting the service .".$bookings['serviceDetails']['name']." is ".$otp;

                // $deviceTokens = UserDevice::where('user_id',$bookings->user_id)->where('notification_status',1)->pluck('device_token');

                // $notification_id = $helper->activity_save($bookings->user_id,$subject,$message,$bookings->booking_status,$bookings->id);

                // $data['notification_id'] = $notification_id;

                $data['type'] = $bookings->booking_status;

                $data['booking_id'] = $bookings->id;

                // $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);



            

                $data['user_id'] = $bookings['user_id'];

                $data['email']=$bookings['userDetails']['email'];

                $data['otp']=$otp;

                $email = "aayushiquantum@gmail.com";

                $headers  = 'MIME-Version: 1.0' . "\r\n";

                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                

                // Create email headers

                $headers .= 'From: '.$email."\r\n".

                    'Reply-To: '.$email."\r\n" .

                    'X-Mailer: PHP/' . phpversion();

    

                $to = "somebody@example.com";

                $subject = "OTP for start a service";

                // Compose a simple HTML email message

                $message = '<html><body>';

                $message .= '<h2 style="align:center">Your Otp for starting the service!</h2>'.$otp;

                $message .= '</body></html>';





                mail($data['email'],"Verification OTP",$message,$headers);



                return \Response::json(['response_code' => 200,'response_message' => 'Otp Sent Successfully.']);

            }

    }

      public function verifyStartOtp(Request $request)

    {

         $validator = Validator::make($request->all(),[



            'otp' => 'required',

            'booking_id' => 'required'



            ]);

        if ($validator->fails()) {

            return redirect()->back()

                            ->withErrors($validator)

                            ->withInput();

        } 

        else 

        {

            try

            {

                

                $otp = implode("",$request->otp);

                $chck_expire_otp = Booking::where('id',$request->booking_id)->where('booking_status',1)->first();

                if($chck_expire_otp == ''){

                

                    return redirect()->back()->withError('Unable to verify OTP.');

               

            	}

                $to = date("i");

                $from = date("i",strtotime($chck_expire_otp->updated_at));

                // Check if OTP time is greater than 3 minutes return in response expire OTP 

                if($from>=($to-30))

                {

                    $user_otp = Booking::where('id',$request->booking_id)->where('otp',$otp)->first();



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

                        // $deviceTokens = UserDevice::where('user_id',$user_otp->user_id)->where('notification_status',1)->pluck('device_token');

                        // $notification_id = $helper->activity_save($user_otp->user_id,$subject,$message,$booking->booking_status,$booking->id);

                        // $data['notification_id'] = $notification_id;

                        $data['type'] = $booking->booking_status;

                        $data['booking_id'] = $booking->id;

                        // $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);

                        

                        return redirect()->back()->withSuccess('OTP verified successfully.');

                    }

                    else

                    {

                        return redirect()->back()->withError('Invalid OTP');

                        

                    }

                }

                else

                {

                        return redirect()->back()->withError('OTP Expired.');

                }



            }catch(Exception $e){



                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }

        }

    }

    public function endServices(Request $request)

    {

        $validator = Validator::make($request->all(),[

            'bookingId'=>'required|numeric|exists:bookings,id'

            ]);

        if ($validator->fails()) {

            return redirect()->back()

                            ->withErrors($validator)

                            ->withInput();

        }

        else 

        {  

            $bookings = Booking::where('id',$request['bookingId'])->where('booking_status',6)->first();

            if($bookings == ''){



                return \Response::json(['response_code' => 400,'response_message' => 'You have to start the service first to end a service.'], 200);

                }

            if($bookings->starting_time == ''){



                return \Response::json(['response_code' => 400,'response_message' => 'You have to start the service first to end a service.'], 200);



            }

            $digits = 4;

            $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT); // Generating OTP

            $bookings->end_otp = $otp;

            if($bookings->save()){

                    $bookings = Booking::where('id',$bookings->id)->first();

                    $subject = "OTP for ending the service .".$bookings['serviceDetails']['name']." is ".$otp;

                    $message = "OTP for ending the service .".$bookings['serviceDetails']['name']." is ".$otp;

                    // $deviceTokens = UserDevice::where('user_id',$bookings->user_id)->where('notification_status',1)->pluck('device_token');

                    // $notification_id = $helper->activity_save($bookings->user_id,$subject,$message,$bookings->booking_status,$bookings->id,$otp);

                    // $data['notification_id'] = $notification_id;

                    $data['type'] = $bookings->booking_status;

                    $data['booking_id'] = $bookings->id;

                    // $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);





                    $data['user_id'] = $bookings['user_id'];

                    $data['email']=$bookings['userDetails']['email'];

                    $data['otp']=$otp;

                    $email = "aayushiquantum@gmail.com";

                    $headers  = 'MIME-Version: 1.0' . "\r\n";

                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    

                    // Create email headers

                    $headers .= 'From: '.$email."\r\n".

                        'Reply-To: '.$email."\r\n" .

                        'X-Mailer: PHP/' . phpversion();

        

                    $to = "somebody@example.com";

                    $subject = "OTP for end a service";

                    // Compose a simple HTML email message

                    $message = '<html><body>';

                    $message .= '<h2 style="align:center">Your Otp for ending the service!</h2>'.$otp;

                    $message .= '</body></html>';



                    mail($data['email'],"Verification OTP",$message,$headers);



                return \Response::json(['response_code' => 200,'response_message' => 'Otp Sent Successfully.','otp'=>$otp], 200);



            }else{



                return \Response::json(['response_code' => 400,'response_message' => 'Unable to send OTP.'], 200);



            }



        }

    }

    public function verifyEndOtp(Request $request)

    {   



        $validator = Validator::make($request->all(),[



            'otp' => 'required',

            'booking_id' => 'required'



            ]);

        if ($validator->fails()) {

            return redirect()->back()

                            ->withErrors($validator)

                            ->withInput();

        } 

        else 

        {

            try

            {   

                $otp = implode("",$request->otp);

                $chck_expire_otp = Booking::where('id',$request->booking_id)->where('booking_status',6)->first();

                if($chck_expire_otp == ''){



                    return redirect()->back()->withError('Unable to verify OTP.');



                }

                if($chck_expire_otp->starting_time == ''){



                    return redirect()->back()->withError('You have to start the service first to end a service.');



                }



                $to = date("i");

                $from = date("i",strtotime($chck_expire_otp->updated_at));

                // Check if OTP time is greater than 3 minutes return in response expire OTP 

                if($from>=($to-30))

                {

                    $user_otp = Booking::with('userDetails','serviceDetails')->where('id',$request->booking_id)->where('end_otp',$otp)->first();

                                

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

                        $message = "Your booking service ".$user_otp['serviceDetails']['name']." is ended at ".date('D,d M Y H:i:s',strtotime($user_otp->starting_time));

                        // $deviceTokens = UserDevice::where('user_id',$user_otp->user_id)->where('notification_status',1)->pluck('device_token');

                        // $notification_id = $helper->activity_save($user_otp->user_id,$subject,$message,$booking->booking_status,$booking->id);

                        // $data['notification_id'] = $notification_id;

                        $data['type'] = $booking->booking_status;

                        $data['booking_id'] = $booking->id;

                        // $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);

                        

                        

                        



                        return redirect()->back()->withSuccess('OTP verified successfully.');



                    }

                    else

                    {   

                        return redirect()->back()->withSuccess('Invalid OTP.');

        

                    }

                }

                else

                {       

                        return redirect()->back()->withSuccess('OTP Expired.');

                }



            }catch(Exception $e){



                return \Response::json(['message' => 'error message', 'status' => 0, 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }

        }

    }

// 



    public function proestimate(){

        $data = DB::table('estimate_professionals')->join('estimates', 'estimate_professionals.estimate_booking_id', "=", 'estimates.booking_show_id')->join('services', 'estimates.service_id', "=", 'services.id')->where('estimate_professionals.pro_id', auth::user()->id)->orderBy('estimate_professionals.id', 'DESC')->get(array(

            'estimate_professionals.id as id',

            'estimate_booking_id',

            'pro_amount',

            'notes',

            'assign_date',

            'estimates.name as name',

            'estimates.time',

            'services.name as service',

            'assign_status',

            'attachment'

        ));

        

        return view('professional_new.proestimate', compact('data'));

    }



    public function offerDeatils($id, $post_id){

        $update = DB::table('estimate_professionals')->where('id', $post_id)->update(array('assign_status'=>$id));

        if($update){

            return redirect()->back()->with('success', 'Offer responsed successfully.');

        }else{

            return redirect()->back()->with('error', 'Something gone wrong.');

        }

    }



    public function proBidding()

    {

        // $data = EstimateBid::where('proff_id',auth::user()->id)->orderBy('id', 'DESC')->with('image')->get();

        $data = DB::table('estimates_bidding')->join('estimates', 'estimates_bidding.booking_id', "=", 'estimates.booking_show_id')->join('services', 'estimates.service_id', "=", 'services.id')->where('estimates_bidding.proff_id', auth::user()->id)->orderBy('estimates_bidding.id', 'DESC')->get(array(

            'estimates_bidding.id as id',

            'booking_id',

            'bidding_amount',

            'pro_amount',

            'notes',

            'start_date',

            'estimates_bidding.locality as eb_locality',

            'estimates_bidding.attachment as atc',

            'estimates.name as name',

            'estimates.time',

            'services.name as service',

            'assign_status',

            'accept_status'

            

        ));

        return view('professional_new.bidding',compact('data'));

    }

    

    public function proBiddingUpdate(Request $request)

    {

        $validator = Validator::make($request->all(),[

            'bidding_amount'=>'required',

            'comment'=>'required|max:300'

            ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator)->withInput();

        }

        $data = EstimateBid::find($request->bid_id);

        $data->accept_status = "1";

        $data->bidding_amount = $request->bidding_amount;

        $data->comment = $request->comment;

        $data->save();

        return redirect()->back()->with("success","Successfully Added!");

    }



}



