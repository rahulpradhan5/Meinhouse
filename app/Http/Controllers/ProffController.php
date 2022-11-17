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
    use App\Models\Professional_image;
    use App\Models\MultipleEstimateBid;
    use Session;
    use Carbon\Carbon;
    use Cookie;
    use DB;
    use Laravel\Cashier\Cashier;
    use Laravel\Cashier\Billable;
    use Illuminate\Support\Str;
    // use PDF;
    use Validator, Input, Redirect, Hash; 
class ProffController extends Controller
{
// Testing Payment GAteway
    public function stripe()
    {
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
        		
		$amount = 100;
		$amount *= 100;
        $amount = (int) $amount;
        $customer = \Stripe\Customer::create([
            'name' => 'test',
            'description' => 'test customer description',
            'address' => [
                'line1' => '510 Townsend St',
                'postal_code' => '98140',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'US',
              ]
        ]);
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'usd',
			'description' => 'Payment From Test',
			'payment_method_types' => ['card'],
            'customer'=>$customer->id
		]);
		$intent = $payment_intent->client_secret;

		return view('website.stripe',compact('intent','payment_intent'));

    }
    public function stripepost(Request $request)
    {
        
        echo $request->id;
        
    }
//Test End
    
    
    public function payment()
    {
        if(Auth::user()->state == 0 && Auth::user()->is_payment == 1){
            return redirect()->route('pro-approval');
        }

        $services = ProService::where('pro_id',Auth::user()->id)->count();
       // print_r($services);exit;
        if($services > 1){

            $services = $services - 1;
            $monthly_amount = $services * 34.99;
            $yearly_amount = $services * 143;
        }else{

            $monthly_amount = 0;
            $yearly_amount = 0;
        }
        $id = ProDetail::where('pro_id',Auth::user()->id)->first();
        $pro_detail_id = $id->pro_id;


            $total_monthly = 79.99 + $monthly_amount;
            $total_yearly = 250.00 + $yearly_amount;


        //print_r($intent);exit;
        return view('website.payments',compact('pro_detail_id','monthly_amount','yearly_amount','total_monthly','total_yearly'));
    }
    
    public function paymentpost()
    {

        if(Auth::user()->state == 0 && Auth::user()->is_listed == 1){
            $user = User::where('id',auth::user()->id)->where('role_id',3)->first();

            $user->is_payment = 1;
            $user->save();
            return redirect()->route('pro-approval');
        }


    }

    public function proCompanyProfile(){

        //$services = Service::all();
         $services= Service::where('status','1')->orderBy('name')->get();
        //  return view('website.boarding',compact('services'));
         return view('website.company_profile_new',compact('services'));
         
     }
     public function proCompanyProfilePost(Request $request){

        $validator = Validator::make($request->all(),[
            'company_name' => 'required',
            'business_address' => 'required',
            'city'=>'required',
            'province'=>'required',
            'postal_code'=>'required',
            'phone_no' => 'required',
            'services' => 'required',
            'abt_services' => 'required',
            'experience' => 'required',
            'distance'=>'required',
            'vehicle_owner'=>'required',

            ]);


        if ($validator->fails())
        {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        else
        {
            try
            {
                // /print_r('expression');exit; $data = %$reqiuest->all();i%// /print_r('expression');exit;
                $user = User::where('id',auth::user()->id)->where('role_id',3)->first();
                if(isset($user)){


                    $pro_av_details = ProDetail::where('pro_id',auth::user()->id)->delete();
                    $pro_detail = new ProDetail();
                    $pro_detail->pro_id = auth::user()->id;
                    $pro_detail->company_name = $request->company_name;
                    $pro_detail->business_address = $request->business_address;
                    $pro_detail->phone_no = $request->phone_no;
                    $pro_detail->commission_perc = '20';
                    // $pro_detail->com_ind = $request->company_individual;
                    // $pro_detail->ein_no = $request->ein_no;
                    // $pro_detail->acc_first_name = $request->first_name;
                    // $pro_detail->acc_last_name = $request->last_name;
                    // $pro_detail->dob = $request->dob;
                    // $pro_detail->ssn_no = $request->ssn_no;
                    // $pro_detail->account_no = $request->account_no;
                    // $pro_detail->routing_no = $request->routing_no;
                    // $pro_detail->license_no = $request->license_no;
                    // $pro_detail->name = $request->name;
                    // $pro_detail->address = $request->address;
                    $pro_detail->city = $request->city;
                    $pro_detail->province = $request->province;
                    $pro_detail->postal_code = $request->postal_code;
                    $pro_detail->experience = $request->experience;
                    $pro_detail->vehicle_owner = $request->vehicle_owner;
                    $pro_detail->distance = $request->distance;
                    $pro_detail->criminal_offence="0";

                    if($files = $request->file('insurance')){
                        // upload path
                        $destinationPath = public_path('/prosdoc/');
                        // Upload Orginal Image
                        $input['name']=time().'.'.$files->getClientOriginalExtension();
                        $files->move($destinationPath,$input['name']);
                        // Save In Database
                        $pro_detail->insurance=$input['name'];
                    }

                    if($files = $request->file('license_doc')){
                        // upload path
                        $destinationPath = public_path('/prosdoc/');
                        // Upload Orginal Image
                        $input['name']=time().'.'.$files->getClientOriginalExtension();
                        $files->move($destinationPath,$input['name']);
                        // Save In Database
                        $pro_detail->license_doc=$input['name'];

                    }
                    if($pro_detail->save()){


                        $pro_service = ProService::where('pro_id',auth::user()->id)->delete();

                        $services_av = Service::pluck('id')->toArray();
                        foreach ($request->services as $key => $value) {
                            $val_chk = in_array($value,$services_av);
                            if(isset($val_chk) && $val_chk == " "){
                                $pro_services = new ProService();
                                $pro_services->pro_id = auth::user()->id;
                                $pro_services->service_id = $value;
                                $pro_services->save();
                            }
                        }

                        $pro_av_days = ProAvailability::where('pro_id',auth::user()->id)->delete();
                        $pro_availablity_mon = new ProAvailability();
                        $pro_availablity_mon->day_id = 1;
                        $pro_availablity_mon->pro_id = auth::user()->id;

                        /*Availability for monday*/
                        if(isset($request->monday)){
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

                        }
                        }else{

                            $pro_availablity_mon->day_availability = 0;
                            $pro_availablity_mon->morning = 0;
                            $pro_availablity_mon->midnoon = 0;
                            $pro_availablity_mon->afternoon = 0;
                            $pro_availablity_mon->evening = 0;
                        }

                        $pro_availablity_mon->save();


                        $pro_availablity_tues = new ProAvailability();
                        $pro_availablity_tues->day_id = 2;
                        $pro_availablity_tues->pro_id = auth::user()->id;

                        /*Availability for tuesday*/
                        if(isset($request->tuesday)){
                        if(count($request->tuesday)>0){

                            $pro_availablity_tues->day_availability = 1;
                            foreach ($request->tuesday as $key => $value) {

                                $avail = explode('_', $value);
                                //print_r($avail[1]);

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

                        }
                        }else{

                            $pro_availablity_tues->day_availability = 0;
                            $pro_availablity_tues->morning = 0;
                            $pro_availablity_tues->midnoon = 0;
                            $pro_availablity_tues->afternoon = 0;
                            $pro_availablity_tues->evening = 0;
                        }

                        $pro_availablity_tues->save();


                        $pro_availablity_wednes = new ProAvailability();
                        $pro_availablity_wednes->day_id = 3;
                        $pro_availablity_wednes->pro_id = auth::user()->id;

                        /*Availability for wednesday*/
                        if(isset($request->wednesday)){
                        if(count($request->wednesday)>0){

                            $pro_availablity_wednes->day_availability = 1;
                            foreach ($request->wednesday as $key => $value) {

                                $avail = explode('_', $value);
                                //print_r($avail[1]);

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

                        }
                        }else{

                            $pro_availablity_wednes->day_availability = 0;
                            $pro_availablity_wednes->morning = 0;
                            $pro_availablity_wednes->midnoon = 0;
                            $pro_availablity_wednes->afternoon = 0;
                            $pro_availablity_wednes->evening = 0;
                        }

                        $pro_availablity_wednes->save();

                        $pro_availablity_thurs = new ProAvailability();
                        $pro_availablity_thurs->day_id = 4;
                        $pro_availablity_thurs->pro_id = auth::user()->id;

                        /*Availability for thursday*/
                        if(isset($request->thursday)){
                        if(count($request->thursday)>0){

                            $pro_availablity_thurs->day_availability = 1;
                            foreach ($request->thursday as $key => $value) {

                                $avail = explode('_', $value);
                                //print_r($avail[1]);

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

                        }
                        }else{

                            $pro_availablity_thurs->day_availability = 0;
                            $pro_availablity_thurs->morning = 0;
                            $pro_availablity_thurs->midnoon = 0;
                            $pro_availablity_thurs->afternoon = 0;
                            $pro_availablity_thurs->evening = 0;
                        }

                        $pro_availablity_thurs->save();

                        $pro_availablity_fri = new ProAvailability();
                        $pro_availablity_fri->day_id = 5;
                        $pro_availablity_fri->pro_id = auth::user()->id;

                        /*Availability for friday*/
                        if(isset($request->friday)){
                        if(count($request->friday)>0){

                            $pro_availablity_fri->day_availability = 1;
                            foreach ($request->friday as $key => $value) {

                                $avail = explode('_', $value);
                                //print_r($avail[1]);

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

                        }
                        }else{

                            $pro_availablity_fri->day_availability = 0;
                            $pro_availablity_fri->morning = 0;
                            $pro_availablity_fri->midnoon = 0;
                            $pro_availablity_fri->afternoon = 0;
                            $pro_availablity_fri->evening = 0;
                        }

                        $pro_availablity_fri->save();

                        $pro_availablity_satur = new ProAvailability();
                        $pro_availablity_satur->day_id = 6;
                        $pro_availablity_satur->pro_id = auth::user()->id;

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

                        }
                        }else{

                            $pro_availablity_satur->day_availability = 0;
                            $pro_availablity_satur->morning = 0;
                            $pro_availablity_satur->midnoon = 0;
                            $pro_availablity_satur->afternoon = 0;
                            $pro_availablity_satur->evening = 0;
                        }

                        $pro_availablity_satur->save();

                        $pro_availablity_sun = new ProAvailability();
                        $pro_availablity_sun->day_id = 7;
                        $pro_availablity_sun->pro_id = auth::user()->id;

                        /*Availability for sunday*/
                        if(isset($request->sunday)){
                        if(count($request->sunday)>0){

                            $pro_availablity_sun->day_availability = 1;
                            foreach ($request->sunday as $key => $value) {

                                $avail = explode('_', $value);
                                //print_r($avail[1]);

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

                        }
                        }else{

                            $pro_availablity_sun->day_availability = 0;
                            $pro_availablity_sun->morning = 0;
                            $pro_availablity_sun->midnoon = 0;
                            $pro_availablity_sun->afternoon = 0;
                            $pro_availablity_sun->evening = 0;
                        }

                        $pro_availablity_sun->save();
                        // $user->description = $request->service_desc;
                        $user->is_listed = 1;
                        $user->save();

                    }

                    $review = new ProReview();
                    $review->user_id = 5;
                    $review->pro_id = auth::user()->id;
                    $review->stars = 4.5;
                    $review->save();

                    $pro_detail_id = $pro_detail->id;
                    $services = count($request->services);
                    if($services > 1){

                        $services = $services - 1;
                        $monthly_amount = $services * 34.99;
                        $yearly_amount = $services * 143;
                    }else{

                        $monthly_amount = 0;
                        $yearly_amount = 0;
                    }

                    $total_monthly = 79.99 + $monthly_amount;
                    $total_yearly = 250.00 + $yearly_amount;

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

                    return view('website.payments',compact('pro_detail_id','monthly_amount','yearly_amount','total_monthly','total_yearly'));


                }else{

                    return redirect()->back()->withError('User does not exist.');
                }

            }catch(Exception $e){

                return \Response::json(['response_message' => 'error message', 'result' => $e->getMessdob()], HttpResponse::HTTP_CONFLICT);

            }
        }
        return redirect()->route('pro-payment');
        // return view('website.payment',compact('services'));
        // return view('website.company_prof',compact('services'));
    }
    
    public function approval()
    {

        if(Auth::user()->state == 0 && Auth::user()->is_payment == 1){
            return view('website.approval');
        }elseif(Auth::user()->state == 0 && Auth::user()->is_payment == 0){

            return redirect()->route('pro-payment');
        }else{

            return redirect('pro/dashboard');
        }

    }
    
    public function createSubs(Request $request)
    {
        //

        $user = Auth::user();
        $services = ProService::where('pro_id',Auth::user()->id)->count();

        if($services == 1){

            $price_id = 'price_1JXgaQJ5SREt5Pwvz0pW9Bqh';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 2){

            $price_id = 'price_1JXhCAJ5SREt5PwvjdBJ474w';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 3){

            $price_id = 'price_1JXhGYJ5SREt5PwvNl1rkEvJ';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 4){

            $price_id = 'price_1JXivlJ5SREt5PwvlRUWa8yK';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 5){

            $price_id = 'price_1JXiw0J5SREt5PwvTcc8to51';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 6){

            $price_id = 'price_1JXiwSJ5SREt5Pwvhtr0dn5I';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 7){

            $price_id = 'price_1JXiwmJ5SREt5Pwvpk717opu';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 8){

            $price_id = 'price_1JXix2J5SREt5PwvlKh4PHxf';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 9){

            $price_id = 'price_1JXixZJ5SREt5PwvPhbtIKwD';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 10){

            $price_id = 'price_1JXixpJ5SREt5PwvjYwIvNsl';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 11){

            $price_id = 'price_1JXiyCJ5SREt5Pwv2AVsOBZb';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 12){

            $price_id = 'price_1JXiyTJ5SREt5PwvM6EIc6Hf';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 13){

            $price_id = 'price_1JXiygJ5SREt5PwvklqmqCXX';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 14){

            $price_id = 'price_1JXj0uJ5SREt5PwvRRGM4Ydx';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 15){

            $price_id = 'price_1JXj1EJ5SREt5PwvN0ghH3dx';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 16){

            $price_id = 'price_1JXj1XJ5SREt5PwvWhgUUbco';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 17){

            $price_id = 'price_1JXj1rJ5SREt5Pwvyw1y1JlS';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 18){

            $price_id = 'price_1JXj26J5SREt5Pwv9V4Z190H';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 19){

            $price_id = 'price_1JXj2OJ5SREt5PwvVCbSbr6h';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 20){

            $price_id = 'price_1JXj2mJ5SREt5PwvamEXTW5V';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 21){

            $price_id = 'price_1JXj2yJ5SREt5Pwvwkcnngqr';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 22){

            $price_id = 'price_1JXj3CJ5SREt5PwvWuyxzBYV';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 23){

            $price_id = 'price_1JXj3PJ5SREt5Pwv1XdIhW2f';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 24){

            $price_id = 'price_1JXj3iJ5SREt5PwvRRasje6M';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }elseif($services == 25){

            $price_id = 'price_1JXj45J5SREt5Pwvh6x0CWLv';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';

        }else{

            $price_id = 'price_1JXj4vJ5SREt5PwvEqfeTGBB';
            // $price_id = 'price_1LdFboSBB4uLDn3seI17zS8c';
        }

        $payment = $request->paymentMethod;
        $user->addPaymentMethod($payment);
        $test = $user->newSubscription('main',$price_id)->create($payment);
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
        print_r($test);
        // exit;
    }
    
    public function updateMake(Request $request)
    {

        $user_id = Auth::user()->email;
        $custId = Auth::user()->customer_id;
        $amount = $request->amount;
        $id = $request->id;
        // kvstore API url
        $url = 'https://meinhaus.ca/public/api/main.php';
        // Collection object
        $data = [
          'email' => $user_id,
          'custId'=> $custId
        ];
        // Initializes a new cURL session
        $curl = curl_init($url);
        // Set the CURLOPT_RETURNTRANSFER option to true

        // Set the CURLOPT_POST option to true for POST request
        curl_setopt($curl, CURLOPT_POST, true);
        // Set the request data as JSON using json_encode function
        curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($data) );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );


        // Execute cURL request with all previous settings
        $response = curl_exec($curl);
        $decode = json_decode($response);
        $clientToken = $decode->clientToken;
        $clientId = $decode->clientId;
        //  return view('professional.payment_updateui',compact('clientToken','clientId','amount','id'));
         return view('professional.payment_updateui',compact('clientToken','clientId','amount','id'));
    }
    
    public function updateBusinesPost(Request $request)
    {
        //print_r($request->services);exit;
        $services_ss = ProService::where('pro_id',Auth::user()->id)->delete();
        $services = Session::get('services');
        $services_av = Service::pluck('id')->toArray();
       // $services_arr = explode(",", $services);
        foreach ($services as $key => $value) {
            $val_chk = in_array($value,$services_av);
            if(isset($val_chk) && $val_chk == " "){
                $pro_services = new ProService();
                $pro_services->pro_id = Auth::user()->id;
                $pro_services->service_id = $value;
                $pro_services->save();
            }
        }

        return \Response::json(['result'=>true]);
    }


    public function updateServices(Request $request)
    {
        $services =  Service::orderBy('name','ASC')->get();
        $proservices = ProService::where('pro_id',Auth::user()->id)->pluck('service_id')->toArray();
        return view('professional.proffbusiness',compact('services','proservices'));
    }
    
// Dashboard Login Register
    public function index()
    {
     
        $jobs_complete=Booking::where('booking_status',7)
        ->pluck('pro_id','amount');
          $count=0;
          $earning=0;
          foreach ($jobs_complete as $key => $value) {
              if ($value == auth::user()->id) {
                  $count++;
                  $earning+=$key;
  
              }
          }
  //$earning=number_format($earning,".");
  $earning=number_format($earning, 2, ".", ",");
  //dd($earning);
  //dd($d);
  $pro=[
    'jobs_recived'=>Booking::where('pro_id',auth::user()->id)->count(),
    'jobs_done'=>$count,
     'earning'=>$earning,
     'bidding'=>DB::table('multiple_estimates_bidding')->where('proff_id',auth::user()->id)->count(),
     'details'=>User::where('id',auth::user()->id)->get(),
];

$leads=ProLead::where('pro_id',auth::user()->id)->where('status','0')->count();


$bids=DB::table('multiple_estimates_bidding')->where('proff_id',auth::user()->id)->count();
$estimates= DB::table('multiple_estimate_professionals')

->join('multiple_estimate', 'multiple_estimate_professionals.estimate_booking_id', "=", 'multiple_estimate.booking_show_id')

->where('multiple_estimate_professionals.pro_id', auth::user()->id)->count();
$docs=ProDetail::where('pro_id',auth::user()->id)->pluck('license_no');
$doc_flag=false;  
//dd($docs); 
if (count($docs)>0) {
    $doc_flag=true;
}
//dd($doc_flag);

$proservices = ProService::where('pro_id',Auth::user()->id)->pluck('service_id')->toArray();
$cnt=0;
$services_arr=[];
for ($i=0; $i <count($proservices); $i++)  { 
if ($cnt==1) {
    break;
}
else{
    $item=Service::where('id',$proservices[$i])->first();
    array_push($services_arr,$item->name);
    $cnt++;
}


}
$on_the_go = DB::table('multiple_estimate_professionals')
        
->join('multiple_estimate', 'multiple_estimate_professionals.estimate_booking_id', "=", 'multiple_estimate.booking_show_id')

->where('multiple_estimate_professionals.pro_id', auth::user()->id)

->where('multiple_estimate_professionals.assign_status', 1)
->orderBy('multiple_estimate_professionals.id', 'DESC')->get(array(
    
    'multiple_estimate_professionals.id as id',
    'estimate_booking_id',
    'pro_amount',
    'notes',
    'assign_date',
    'multiple_estimate.title as name',
    'multiple_estimate.name as username',
    'multiple_estimate.time',
    'assign_status',
    'attachment',
    'mest_service_id',
    'multiple_estimate_professionals.address as address'
    
));

$opportunity = DB::table('multiple_estimate_professionals')
        
->join('multiple_estimate', 'multiple_estimate_professionals.estimate_booking_id', "=", 'multiple_estimate.booking_show_id')

->where('multiple_estimate_professionals.pro_id', auth::user()->id)
->where('multiple_estimate_professionals.assign_status', 0)
->orderBy('multiple_estimate_professionals.id', 'DESC')->get(array(
    
    'multiple_estimate_professionals.id as id',
    'estimate_booking_id',
    'pro_amount',
    'notes',
    'assign_date',
    'multiple_estimate.title as name',
    'multiple_estimate.name as username',
    'multiple_estimate.time',
    'assign_status',
    'attachment',
    'mest_service_id',
    'multiple_estimate_professionals.address as address'
    
));

$site_photos=DB::table('multiple_estimate_professionals')->where('pro_id',auth::user()->id)->whereNotNull('site_img_no')->whereNull('site_photo_status')->orderBy('id','DESC')->take(5)->get();
                
//dd($site_photos);

return view('professional.dashboard',compact('pro','leads','bids','estimates','doc_flag','services_arr','on_the_go','opportunity','site_photos'));
    }
    public function leads()
    {
        DB::table('pro_leads')->where('pro_id',Auth::user()->id)->update(['lead_req_notif'=>1]);
        $data['leads'] = ProLead::with('bookingsDetail')->where('pro_id',auth::user()->id)->where('status','0')->orderBy('id','DESC')->get();   
        return view('professional.leads',$data);
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
                return redirect('pro/dashboard');
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
            'confirm_password' => 'required|min:8|max:16|same:password',
            'terms'=>'accepted',
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
            return redirect('pro/dashboard');
        }
        if($booking_info[0]->pro_status=='2'){
            Session::flash('error','Lead already rejected.');
            return redirect('pro/dashboard');
        }
        $bookupdate = DB::table('bookings')->where('id',$id)->update(
        array('pro_status'=>'2','booking_status'=>'2'));
        if($bookupdate){
            Session::flash('error','Lead rejected successfully.');
            return redirect('pro/dashboard');
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
        return redirect('pro/dashboard');
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
            return redirect('pro/dashboard');
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
        return view('professional.proffdocument',$data);
    }
    // Banking
    public function proff_banking(Request $request)
    {
        
        
        
        if($request->isMethod("POST"))
        {
              $validator = $request->validate([
            'distance' => 'numeric|max:10000',
            
            ]);
            
            
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
        return view('professional.proffbanking',$data);
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
        return view('professional.proffavailability',compact('monday','tuesday','wednesday','thursday','friday','saturday','sunday','all'));
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
        return view('professional.proffbusiness',compact('services','proservices'));

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

                    $monthly_amount = $service_count * 19.99;
                    $yearly_amount = $service_count * 143;

                        $total_monthly = 0 + $monthly_amount;
                        $total_yearly = 0 + $yearly_amount;

                     Session::put('services', $services);
                    return view('professional.payment_update',compact('pro_detail_id','monthly_amount','yearly_amount','total_monthly','total_yearly'));

                    // $services_av = Service::pluck('id')->toArray();
                    // // $services_arr = explode(",", $request->services);
                    // foreach ($request->services as $key => $value) {
                    //     $val_chk = in_array($value,$services_av);
                    //     if(isset($val_chk) && $val_chk == " "){
                    //         $pro_service_count = ProService::where([['pro_id',Auth::user()->id],['service_id',$value]])->count();
                    //         if($pro_service_count==0){
                    //         $pro_services = new ProService();
                    //         $pro_services->pro_id = Auth::user()->id;
                    //         $pro_services->service_id = $value;
                    //         $pro_services->save();
                    //         }
                    //     }
                    // }

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
    public function review()
    {
        $reviews = ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->get();
        $review_count = ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->count();
        $review_avg = ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->avg('stars');
        return view('professional.proffcustomer',compact('reviews','review_count','review_avg'));
    }
    // edit profile
    public function edit_profile(Request $request)
    {
        
     
            
        $professional_id = session('id');
        if($request->isMethod("POST"))
        {
               
       $validator = Validator::make($request->all(),[

            'phone_no'=>'required|max:15|min:10',
             'email'=>'required',
             'name'=>'required',
            ]);
            
            if ($validator->fails()) {

            return redirect()->back()

                            ->withErrors($validator)

                            ->withInput();

        }
            
            
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
        return view('professional.editprofile',$data);
    }
    // Change Password
    public function proff_change_password()
    {
        $professional_id = session('id');
        return view('professional.changepassword');
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
        return view('professional.terms');
    }
    public function about()
    {
        $professional_id = session('id');
        return view('professional.about');
    }

    public function proff_bookings()
    {
        $professional_id = session('id');
        $data['bookings']  = ProLead::with('bookingsDetail')->where('pro_id',Auth::user()->id)->whereIn('status',[1,6])->orderBy('updated_at','DESC')->get();
        return view('professional.booking',$data);
    }

    public function bookingDetail($id)
    {
        $booking = Booking::where('id',$id)->first();
        return view('professional.bookingdetails',compact('booking'));
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
        
         $data = DB::table('multiple_estimate_professionals')
        
        ->join('multiple_estimate', 'multiple_estimate_professionals.estimate_booking_id', "=", 'multiple_estimate.booking_show_id')
        
        ->where('multiple_estimate_professionals.pro_id', auth::user()->id)

        ->where('multiple_estimate_professionals.assign_status', 1)
        ->where('multiple_estimate_professionals.mark_complete', 1)
        ->where('multiple_estimate_professionals.admin_mark_complete', 1)

        ->orderBy('multiple_estimate_professionals.id', 'DESC')->get(array(
            
            'multiple_estimate_professionals.id as id',
            'estimate_booking_id',
            'pro_amount',
            'notes',
            'assign_date',
            'multiple_estimate.title as name',
            
            'multiple_estimate.name as username',
            'multiple_estimate.time',
            'assign_status',
            'attachment',
            'mest_service_id',
            'multiple_estimate_professionals.mark_complete as mark_complete',
            'multiple_estimate_professionals.site_img_no as site_image_no',
            'multiple_estimate_professionals.address as address'
            
        ));

       
       //dd($data);
    //return view('professional.ongoing_jobs',compact('data'));
        //$professional_id = session('id');
        //$data['bookings'] = ProLead::with('bookingsDetail')->where('pro_id',Auth::user()->id)->whereIn('status',[2,3,5])->orderBy('updated_at','DESC')->get();
        
        
        return view('professional.pastbooking',compact('data'));
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
                        
                        // PDF::loadView('pdf',$user_otp)->save(public_path().'/invoices/'.$pdfname);

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

    // public function proestimate(){
    //     $data = DB::table('estimate_professionals')->join('estimates', 'estimate_professionals.estimate_booking_id', "=", 'estimates.booking_show_id')->join('services', 'estimates.service_id', "=", 'services.id')->where('estimate_professionals.pro_id', auth::user()->id)->orderBy('estimate_professionals.id', 'DESC')->get(array(
    //         'estimate_professionals.id as id',
    //         'estimate_booking_id',
    //         'pro_amount',
    //         'notes',
    //         'assign_date',
    //         'estimates.name as name',
    //         'estimates.time',
    //         'services.name as service',
    //         'assign_status',
    //         'attachment'
    //     ));
        
    //     return view('professional.proestimate', compact('data'));
    // }

    // public function offerDeatils($id, $post_id){
    //     $update = DB::table('estimate_professionals')->where('id', $post_id)->update(array('assign_status'=>$id));
    //     if($update){
    //         return redirect()->back()->with('success', 'Offer responsed successfully.');
    //     }else{
    //         return redirect()->back()->with('error', 'Something gone wrong.');
    //     }
    // }
    
    public function proMultipleEstimate()
    {
        DB::table('multiple_estimate_professionals')->where('pro_id',Auth::user()->id)->update(['direct_req_notif_status'=>1]);
        $data = DB::table('multiple_estimate_professionals')
        
        ->join('multiple_estimate', 'multiple_estimate_professionals.estimate_booking_id', "=", 'multiple_estimate.booking_show_id')
        
        ->where('multiple_estimate_professionals.pro_id', auth::user()->id)
        
         ->where('multiple_estimate_professionals.assign_status', 0)
          
        ->where('multiple_estimate_professionals.mark_complete', 0)
        
        ->orderBy('multiple_estimate_professionals.id', 'DESC')->get(array(
            
            'multiple_estimate_professionals.id as id',
            'estimate_booking_id',
            'pro_amount',
            'notes',
            'assign_date',
            'multiple_estimate.title as name',
            'multiple_estimate.time',
            'assign_status',
            'attachment',
            'mest_service_id',
            'multiple_estimate_professionals.address as address',
            'multiple_estimate_professionals.mark_complete as Complete_status'
            
        ));
        //dd($data);
        return view('professional.proestimate', compact('data'));
    }
    
    public function updateAssignStatus($id, $post_id){
        $update = DB::table('multiple_estimate_professionals')->where('id', $post_id)->update(array('assign_status'=>$id));
        if($update){
            return redirect()->back()->with('success', 'Offer responsed successfully.');
        }else{
            return redirect()->back()->with('error', 'Something gone wrong.');
        }
    }

    // public function proBidding()
    // {
    //     // $data = EstimateBid::where('proff_id',auth::user()->id)->orderBy('id', 'DESC')->with('image')->get();
    //     $data = DB::table('estimates_bidding')->join('estimates', 'estimates_bidding.booking_id', "=", 'estimates.booking_show_id')->join('services', 'estimates.service_id', "=", 'services.id')->where('estimates_bidding.proff_id', auth::user()->id)->orderBy('estimates_bidding.id', 'DESC')->get(array(
    //         'estimates_bidding.id as id',
    //         'booking_id',
    //         'bidding_amount',
    //         'pro_amount',
    //         'notes',
    //         'start_date',
    //         'estimates_bidding.locality as eb_locality',
    //         'estimates_bidding.attachment as atc',
    //         'estimates.name as name',
    //         'estimates.time',
    //         'services.name as service',
    //         'assign_status',
    //         'accept_status'
            
    //     ));
    //     return view('professional.bidding',compact('data'));
    // }

    // public function proBiddingUpdate(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'bidding_amount'=>'required',
    //         'comment'=>'required|max:300'
    //         ]);
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $data = EstimateBid::find($request->bid_id);
    //     $data->accept_status = "1";
    //     $data->bidding_amount = $request->bidding_amount;
    //     $data->comment = $request->comment;
    //     $data->save();
    //     return redirect()->back()->with("success","Successfully Added!");
    // }
    
    public function proMestBidding()
    {
        DB::table('multiple_estimates_bidding')->where('proff_id',Auth::user()->id)->update(['bid_req_notif_status'=>1]);
        $data = DB::table('multiple_estimates_bidding')
        
        ->join('multiple_estimate', 'multiple_estimates_bidding.booking_id', "=", 'multiple_estimate.booking_show_id')
        
        ->where('multiple_estimates_bidding.proff_id', auth::user()->id)
        
        ->orderBy('multiple_estimates_bidding.id', 'DESC')->get(array(
            
            'multiple_estimates_bidding.id as id',
            'booking_id',
            'pro_amount',
            'bidding_amount',
            'notes',
            'start_date',
            'multiple_estimate.name as name',
            'multiple_estimates_bidding.locality as eb_locality',
            'multiple_estimate.time',
            'assign_status',
            'attachment',
            'mest_service_id'
            
        ));
        return view('professional.bidding',compact('data'));
    }
    
    public function proMestBiddingUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bidding_amount'=>'required',
            'comment'=>'required|max:300'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        if($request->bidding_amount!=0)
        {
            if($request->bidding_amount<=$request->check_bid_amount&&$request->bidding_amount>0)
            {
                $data = MultipleEstimateBid::find($request->bid_id);
                $data->accept_status = "1";
                $data->bidding_amount = $request->bidding_amount;
                $data->comment = $request->comment;
                $data->save();
                return redirect()->back()->with("success","Successfully Added!");
            }
            else
            {
                return redirect()->back()->with("error","You cannot fill more than the proposed amount!");
            }
        }
        else
        {
            return redirect()->back()->with("error","You cannot fill 0 as an amount!");
        }
    }



        

    public function logout()
    {

        Auth::logout();

        Session::flush();

        return redirect(url('pro-login'));

    }
    
    
    	//forgot password code
	 public function forgotPassword()
    {
        return view('website.forget_password_proff');
    }
    
 public function forgotSendMail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email',$email)->where('role_id',3)->first();   

        if(isset($user)){

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
            $data['url'] =url('proff/password-reset/'.$token);
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
    return redirect()->back()->withError('internal error occured');  
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
        if (!$tokenData) return redirect('pro-login')->withError('Invalid Token.');

        $user = User::where('email',$tokenData->email)->first();

        if (!$user) return redirect()->back()->withErrors('Email not found');

        return view('website.reset_password_proff',compact('token'));
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

        return redirect('pro-login')->withSuccess('Password Reset Successfully.Login To Continue.');
    }
	
	

public function siteImage()
    {
        $data = DB::table('pro_site_image')->where('pro_id',auth::user()->id)->pluck('image','id');
        return view('professional.site_image',compact('data'));
    }

    public function proSiteImagePost(Request $request)
    {
        $images=$request->images;
        $check = DB::table('multiple_estimate_professionals')->where('id',$request->id)->first();

         if ($check->site_img_no ==NULL) {
            return redirect()->back()->with('error',"No images required as of now !");
        
        }  

        if($check->site_img_no==count($images))
        {
            foreach($images as $key=> $file)
            {
                $name = time().$key.'.'.$file->extension();
                $file->move(public_path('pro_site_images'), $name);
                $ImageName[] = $name;
            }
            for ($i=0; $i < count($ImageName) ; $i++) {

                DB::table('pro_site_image')->insert(array(
                    'booking_id'=>$request->booking_id,
                    'service_id'=>$request->service_id,
                    'pro_id'=>auth::user()->id,
                    'image'=>$ImageName[$i]
                ));

            }
            DB::table('multiple_estimate_professionals')->where('id',$request->id)->update(['site_notification_status' => 1,'site_photo_status' => 1]);
            return redirect()->back()->with('success','Successfully Added!');
        }
        else
        {
            return redirect()->back()->with('error',"$check->site_img_no Images Required!");
        }
    }


 public function Images(Request $request){

$data=Professional_image::where('pro_id',auth::user()->id)->pluck('image','id');
      return view('professional.photos',compact('data'));
    }

 public function ImagesPost(Request $req){
    $images=$req->images;
foreach($images as $key=> $file)
       {
           $name = time().$key.'.'.$file->extension();
           //$dest_path='public/Place_upload';
           $file->move(public_path('Proff_uploads'), $name);
           $ImageName[] = $name;
       }
        for ($i=0; $i <count($ImageName) ; $i++) { 
                $image=New Professional_image;
                $image->image=$ImageName[$i];
                $image->pro_id=auth::user()->id;
                $image->save();

       }
     return redirect()->back()->with('success','Successfully Added!');
    }
	
	public function ImagesDelete($id){
	    
           $image=Professional_image::find($id);
            if($image!=NULL){

    $dest= public_path()."/Proff_uploads"."/".basename($image->image);
   
      unlink($dest);
      $image->delete();
       return redirect()->back()->with('success','Successfully Deleted !');
            }
            else{
      return redirect()->back()->with('error','Image not Found');          
            }
      
  }

public function DirectAssign(Type $var = null)
{
    return view('professional.direct_assigns');
}       


public function ongoing_jobs(Type $var = null)


{
    //DB::table('multiple_estimate_professionals')->where('pro_id',Auth::user()->id)->update(['direct_req_notif_status'=>1]);
        
        $data = DB::table('multiple_estimate_professionals')
        
        ->join('multiple_estimate', 'multiple_estimate_professionals.estimate_booking_id', "=", 'multiple_estimate.booking_show_id')
        
        ->where('multiple_estimate_professionals.pro_id', auth::user()->id)

        ->where('multiple_estimate_professionals.assign_status', 1)
        ->where('multiple_estimate_professionals.mark_complete', 0)
        ->where('multiple_estimate_professionals.admin_mark_complete', 0)
        
        ->orderBy('multiple_estimate_professionals.id', 'DESC')->get(array(
            
            'multiple_estimate_professionals.id as id',
            'estimate_booking_id',
            'pro_amount',
            'notes',
            'assign_date',
            'multiple_estimate.title as name',
            
            'multiple_estimate.name as username',
            'multiple_estimate.user_data_id as customer_id',
            'multiple_estimate.time',
            'assign_status',
            'attachment',
            'mest_service_id',
            'multiple_estimate_professionals.mark_complete as mark_complete',
            'multiple_estimate_professionals.site_img_no as site_image_no',
            'multiple_estimate_professionals.address as address'
            
        ));

       
       //dd($data);
    return view('professional.ongoing_jobs',compact('data'));
}    public function markComplete($id)
{
    $check = DB::table('multiple_estimate_professionals')->where('id',$id)->first();
    if($check->site_photo_status==NULL){
         return redirect()->back()->with('error','Please upload site photos before completion!');
    }
    
    if($check->mark_complete=='0')
    {
        DB::table('multiple_estimate_professionals')->where('id',$id)->update(['mark_complete'=>'1']);
        
        $booking_id=$check->estimate_booking_id;
        $pro=Auth::user()->name;
        
        DB::table('admin_notifications')->insert(
     array(
         
            
            'booking_id'=>$booking_id,
            'pro'=>$pro,
            'mest_pro_id'=>$id
     )
);
    }
    
    
    // else
    // {
    //     DB::table('multiple_estimate_professionals')->where('id',$id)->update(['img_app_status'=>'0']);
    // }
    return redirect()->back()->with('success','Successfully Updated!');
}

         

    public function sendNotes(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "notes" => 'required|max:1000'
        ]);
        if($validator->fails()){return redirect()->back()->with('error',"There were some problems with your input.");}
        else
        {
            DB::table("project_notes")->insert([
                'pro_id' => session('id'),
                'service_id' => $request->service_id,
                'booking_id' => $request->booking_id,
                'notes' => $request->notes,
            ]);
            return redirect()->back()->with('success','Successfully Inserted!');
        }
    }
    
    public function msgCustomer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "msg" => 'required|max:1000'
        ]);
        if($validator->fails()){return redirect()->back()->with('error',"There were some problems with your input.");}
        else
        {
            DB::table("customer_msg")->insert([
                'customer_id' => $request->customer_id,
                'pro_id' => session('id'),
                'service_id' => $request->service_id,
                'booking_id' => $request->booking_id,
                'msg' => $request->msg,
            ]);
            return redirect()->back()->with('success','Successfully Sent!');
        }
    }
    
    public function AdminMessages()
    {
       
        $data=DB::table('pro_msg')->where('pro_id',session('id'))->orderBy('id','DESC')->get();
        foreach($data as $msgs){
            if($msgs->is_seen==0){
                $msgs->is_new=1;
            }
        }
        
          DB::table('pro_msg')->where('pro_id',session('id'))->update(array('is_seen'=>'1'));
        return view('professional.Messages.Index',compact('data'));  
    }
     public function AdminMessageDelete($id)
    {
        
        
        
        $data=DB::table('pro_msg')->where('id',$id);
           $data->delete();
                  return back()->with('success','Message Deleted Successfully!');
    }
     public function  pro_profile()
     
             {
        $professional_id = session('id');
         
           
            
        
        $data['details'] = User::where('id',$professional_id)->first();
        $data['pro_details']=ProDetail::where('pro_id',$professional_id)->first(); 
        $data['skills']=ProService::where('pro_id',$professional_id)->limit(10)->pluck('service_id'); 
        $data['reviews']= ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->count();
          $data['review_avg'] = ProReview::where('pro_id',auth::user()->id)->orderBy('id','DESC')->avg('stars');
        return view('professional.Profile',$data);
                 
    }
    
   
    
}
	



