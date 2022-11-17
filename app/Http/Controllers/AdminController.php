<?php

namespace App\Http\Controllers;

use App\Exports\ProfessionalExpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MultipleEstimate;
use App\Models\MultipleEstimateServices;
use App\Models\Estimate;
use Session;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Stripe;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

	public function user_status(Request $request)
    {

		 $id = $request->id;

		$result = DB::table('users')->where('id',$id)->get();
		$status = $result[0]->status;
		if($status=='1'){
			DB::table('users')->where('id',$id)->update(
		array('status'=>'0'));
		return $status;
		exit();
		}else{
			DB::table('users')->where('id',$id)->update(
		array('status'=>'1'));
		return $status;
		exit();
		}

    }




	public function user_state(Request $request)
    {

		 $id = $request->id;

		$result = DB::table('users')->where('id',$id)->get();
		$state = $result[0]->state;
		if($state=='1'){
			DB::table('users')->where('id',$id)->update(
		array('state'=>'0'));
		return $state;
		exit();
		}else{
			DB::table('users')->where('id',$id)->update(
		array('state'=>'1'));
		return $state;
		exit();
		}

    }

	public function service_status(Request $request)
    {

		 $id = $request->id;

		$result = DB::table('services')->where('id',$id)->get();
		$status = $result[0]->status;
		if($status=='1'){
			DB::table('services')->where('id',$id)->update(
		array('status'=>'0'));
		return $status;
		exit();
		}else{
			DB::table('services')->where('id',$id)->update(
		array('status'=>'1'));
		return $status;
		exit();
		}

    }

	public function view_service($id)
    {
        $data['service'] = DB::table('services')->where('id',$id)->first();
		return view('admin.service.details',$data);
	}

    // --------------------------View Professional------------------------
    public function view_professional($id)
    {
        $data['pro'] = DB::table('users')->where('id',$id)->first();
        return view('admin.professional.details',$data);
    }
    // ------------------------------End of Professional------------------------

    // --------------------------View Sales------------------------
    public function view_sale($id)
    {
        $data['sale'] = DB::table('custom_bookings')->where('id',$id)->first();
        return view('admin.sales.details',$data);
    }
    // ------------------------------End of sale------------------------

    // --------------------------View Booking------------------------
    public function view_booking($id)
    {
        $data['booking'] = DB::table('bookings')->where('id',$id)->first();
        return view('admin.bookings.details',$data);
    }
    // ------------------------------End of booking------------------------

    // --------------------------View promocode------------------------
    public function view_promo($id)
    {
        $data['promo'] = DB::table('promocodes')->where('id',$id)->first();
        return view('admin.promo.details',$data);
    }
    // ------------------------------End of promocode------------------------

    // ------------------------------Start Testimonial------------------------

    public function testimonial()
    {
        $data['testimonial'] = DB::table('testimonials')->orderby('id','desc')->get();
		return view('admin.testimonial.index',$data);
    }

    public function addTestimonial(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->validate([
                'image' => 'required',
                'name' => 'required',
                'description' => 'required'
            ]);

            $image = time() .".". $request->image->extension();
            $request->image->move(public_path('upload/testimonials'),$image);

            $data = array(
                'testimonial_image' => $image,
                'name' => $request->name,
                'description' => $request->description
            );
            DB::table('testimonials')->insert($data);
            return redirect()->route('testimonial')->with('success','Successfully Inserted!');
        }
        return view('admin.testimonial.add');
    }

    public function view_testimonial($id)
    {
        $data['testimonial'] = DB::table('testimonials')->where('id',$id)->first();
        return view('admin.testimonial.details',$data);
    }

    public function editTestimonial(Request $request,$id)
    {
        if($request->isMethod("POST"))
        {
            if($request->image)
            {
                $image = time() .".". $request->image->extension();
                $request->image->move(public_path('upload/testimonials'),$image);
                $data = array(
                    'testimonial_image' => $image,
                    'name' => $request->name,
                    'description' => $request->description
                );
            }
            else
            {
                $data = array(
                    'name' => $request->name,
                    'description' => $request->description
                );
            }

            DB::table('testimonials')->where('id',$id)->update($data);
            return redirect()->route('testimonial')->with('update','Successfully Updated!');
        }
        $data['testimonial'] = DB::table('testimonials')->where('id',$id)->first();
        return view('admin.testimonial.edit',$data);
    }

    public function deleteTestimonial($id)
    {
        DB::table('testimonials')->where('id',$id)->delete();
        return redirect()->route('testimonial')->with('delete','Successfully Deleted!');
    }

    // ------------------------------End of Testimonial------------------------

    // ------------------------------Start Blog------------------------

    public function blog()
    {
        $data['blog'] = DB::table('blogs')->orderby('id','desc')->get();
		return view('admin.blog.index',$data);
    }

    public function view_blog($id)
    {
        $data['blog'] = DB::table('blogs')->where('id',$id)->first();
        return view('admin.blog.details',$data);
    }

    public function addBlog(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->validate([
                'title' => 'required',
                'url' => 'required',
                'meta_tag' => 'required',
                'meta_keywords' => 'required',
                'meta_description' => 'required',
                'image' => 'required',
                'description' => 'required',
            ]);

            $image = time() .".". $request->image->extension();
            $request->image->move(public_path('upload/blogs'),$image);

            $data = array(
                'title' => $request->title,
                'url' => $request->url,
                'meta_title' => $request->meta_tag,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'blog_image' => $image,
                'description' => $request->description
            );
            DB::table('blogs')->insert($data);
            return redirect()->route('blog')->with('success','Successfully Inserted!');
        }
        return view('admin.blog.add');
    }

    public function editBlog(Request $request,$id)
    {
        if($request->isMethod("POST"))
        {
            if($request->image)
            {
                $image = time() .".". $request->image->extension();
                $request->image->move(public_path('upload/blogs'),$image);
                $data = array(
                    'title' => $request->title,
                    'url' => $request->url,
                    'meta_title' => $request->meta_tag,
                    'meta_keywords' => $request->meta_keywords,
                    'meta_description' => $request->meta_description,
                    'blog_image' => $image,
                    'description' => $request->description
                );
            }
            else
            {
                $data = array(
                    'title' => $request->title,
                    'url' => $request->url,
                    'meta_title' => $request->meta_tag,
                    'meta_keywords' => $request->meta_keywords,
                    'meta_description' => $request->meta_description,
                    'description' => $request->description
                );
            }

            DB::table('blogs')->where('id',$id)->update($data);
            return redirect()->route('blog')->with('update','Successfully Updated!');
        }
        $data['blog'] = DB::table('blogs')->where('id',$id)->first();
        return view('admin.blog.edit',$data);
    }

    public function deleteBlog($id)
    {
        DB::table('blogs')->where('id',$id)->delete();
        return redirect()->route('blog')->with('delete','Successfully Deleted!');
    }

    // ------------------------------End of Blog------------------------

    // ------------------------------Starting Of Contact------------------------

    public function contact()
    {
        $data['contact'] = DB::table('contacts')->orderby('id','desc')->get();
		return view('admin.contact.index',$data);
    }

    public function view_contact($id)
    {
        $data['contact'] = DB::table('contacts')->where('id',$id)->first();
        return view('admin.contact.details',$data);
    }

    public function deleteContact($id)
    {
        DB::table('contacts')->where('id',$id)->delete();
        return redirect()->route('contact')->with('delete','Successfully Deleted!');
    }

    // ------------------------------End of Contact------------------------






public function login_post(Request $request)
{

    $credentials = $request->only('email','password');
    if(Auth::attempt($credentials)){
    if(Auth::user()->role_id == 1){
    $useLoginId=User::where(['email'=>$request->email])->get();

    session()->put('admin-login-id',$useLoginId[0]->id);
    return redirect(url('admin/dashboard'));

    }else{
    Session::flush();
    Auth::logout();
    \Session::put('err_msg','Invalid Username and Password.');
    //return redirect(url('admin-login'));

    return redirect()->route('admin-login');
    }
    }else{
    \Session::put('err_msg','Invalid Username and Password.');
    return redirect(url('admin-login'));
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



	  public function admin_dashboard()
    {

	
         //$pending_bookings = DB::table('bookings')->where('booking_status',0)->count();
      //$accepted_bookings = DB::table('bookings')->where('booking_status',1)->count();
      //$rejected_bookings = DB::table('bookings')->where('booking_status',2)->count();
     // $payment_pending = DB::table('bookings')->where('booking_status',5)->count();
     // $payment_done = DB::table('bookings')->where('booking_status',7)->count();
     // $servce_start = DB::table('bookings')->where('booking_status',6)->count();
     // $cancelled_bookings = DB::table('bookings')->where('booking_status',3)->count();
      //$services = DB::table('services')->count();

      //$bookings= $pending_bookings+$accepted_bookings+$payment_pending+$payment_done+ $servce_start;
      //$revenue=Booking::Where('booking_status', 7)
      //->pluck('amount','id');
      //   $amount=0;
      //    foreach ($revenue as $key => $value) {
//
      //      $amount+=$value;
      //    }
      //  $amount=number_format($amount);
//
      //  $revenue_month=Booking::Where('booking_status', 7)
      //  ->whereMonth('date', date('m'))->get();
      //  //dd( $revenue_month);
//
      //  $jobs_done=Booking::Where('booking_status', 7)
      //  ->orWhere('booking_status',5)
       // ->count();

       //dd($jobs_done);

      $user = DB::table('users')->where('role_id','2')->count('id');
      $professional = DB::table('users')->where('role_id','3')
      ->where('is_payment',1)
      ->where('state',1)
      ->count();
      $estimate_count=MultipleEstimate::count();

      $unlisted_pro=DB::table('users')->where('role_id','3')
      ->where('is_payment',0)
      ->where('state',0)
      ->count();
      $estimates=MultipleEstimateServices::orderBy('id', 'desc')->take(5)->get();
      //dd($estimates);
      $latest_pro=User::where('role_id',3)->orderBy('id', 'desc')->take(10)->get();
      //dd($latest_pro);
      $total= $professional+$user+$unlisted_pro;
      $percentage=[
        'user'=>($user / $total) * 100,
        'professional'=>($professional/ $total) * 100,
        'unlisted_pro'=>($unlisted_pro / $total) * 100,
      ];




         return view('admin.dashboard',compact('user','professional','estimate_count','unlisted_pro','estimates','latest_pro','percentage'));
    
      // return view('admin.dashboard',compact('user','professional','pending_bookings','accepted_bookings','rejected_bookings','payment_pending','payment_done','cancelled_bookings','services'));
    }

	public function user_index()
    {
		$data['user'] = DB::table('users')->where('role_id','2')->orderby('id','desc')->get();
        return view('admin.user.index',$data);
    }

	public function professional()
    {
		$data['user'] = DB::table('users')->where('role_id','3')->orderby('id','desc')->get();
		return view('admin.professional.index',$data);
    }

    public function getProfessional()
    {
        return Excel::download(new ProfessionalExpo,'ProfessionalList.xlsx');
    }

	public function estimate()
    {
		$data['estimate'] = DB::table('estimates')->orderby('id','desc')->get();

       return view('admin.estimate.index',$data);
    }

	public function add_estimate()
    {
	  $data['services'] = DB::table('services')->orderby('id','desc')->get();
	  $data['pro'] = DB::table('users')->where('role_id','3')->orderby('id','desc')->get();
	  return view('admin.estimate.add',$data);
    }

	public function booking_invoice($BookingId)
    {

		$data['bookingId'] =  $BookingId;
		return view('email_template',$data);
	}

	public function online_pay($id)
    {
		$data['estimaateId'] = $id;
		return view('advancepayment',$data);
	}


	public function payment_done($BookingId,Request $request)
    {
		$result = DB::table('estimates')->where('booking_show_id',$BookingId)->get();

	$estmate_email = $result[0]->email;

  Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $result[0]->reg_amount,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => $result[0]->name.' '.'has made payment for estimate purpose'
        ]);

		/*echo 'done';
  exit();*/



	DB::table('estimates')->where('booking_show_id',$BookingId)->update(
		array('payment_status'=>'1'));

		return view('thanku');

	}



	public function post_add_estimate(Request $request)
    {

		$validator = Validator::make($request->all(),[
            'service_id'=>'required|numeric|exists:services,id',
            'date'=>'required|date',
            'time'=>'required|max:3',
            'phone_no'=>'required',
            'description'=>'required|max:1000',
            'amount' => 'required'
            ]);
         if($validator->fails()){

            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
		$user_address = $request->address.','.$request->locality.','.$request->city.','.$request->state.','.$request->pin_code;


		$booking = new Estimate();
        $booking->user_id = '1';
        $booking->service_id = $request->service_id;
        $booking->pdf_file = 'none';
        $booking->home_type = 0;
        $booking->name = $request->user_id;
        $booking->email = $request->email;
        $booking->address = $user_address;
        $booking->area = $request->address;
        $booking->locality = $request->locality;
        $booking->city = $request->city;
        $booking->state = $request->state;
        $booking->pincode = $request->pin_code;
        $booking->date = date('d-m-Y',strtotime($request->date));
        $booking->time = $request->time;
        $booking->phone_no = $request->phone_no;
        $booking->description = $request->description;
        $booking->timing_constraints = 'NA';
        $booking->pro_id = $request->pro_id;
        $booking->booking_status = 0;
        $booking->payment_status = 0;
        $booking->reg_amount = $request->reg_amount;
        $booking->pro_id = $request->pro_id;
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

        $amount = $request->amount;
        $gst_amount = $amount * 13 / 100;
        $total_amount = $amount + $gst_amount;
        //$booking->amount = $total_amount;
        $booking->amount = $amount;
        if($booking->save()){
			$mailto = $request->email;
            $from_mail = "aayushiquantum@gmail.com";
            $subject = "Booking Request For Service";
            $uid = $booking->id;

           /* $message ="<div style='text-align:center'>";
            $message .= "<h1>Meinhause</h1>";
            $message .= "<h3>Admin generate a request for your custom service Decks and Fences on Tue,16 Nov 2021 Morning(8-11 AM)</h3>";
            $message .= "<a href='http://meinhausca.com/public/onlinebook/invoice/$booking->id'><button style='background:blue;color:white;padding:10px 10px;border-radius:10px;border:1px solid blue;'><b>Review the estimate</b></button></a>";
            $message .= "</div>";*/

			/*--------Inner trade --------*/

			$message ="<div style=display: flex; justify-content: center; background-color: #F0F3F7;'>";
            $message .= "<div style='width: 60%; background-color: white; padding-bottom: 20px;' class='container'>";
            $message .= "<h1 style='text-align: center;'>Meinhaus</h1>";
            $message .= "<hr>";
            $message .= "<p style='text-align: center; font-size: 22px;'>Invoice for <b>$$request->reg_amount</b></p>";
            $message .= "<div style='display: flex; justify-content: center; margin-top: 10px;'>";
            //$message .= "<a href='{{ url('booking-invoice/'.$booking->id) }}'><button style='margin-left: 277px;width: 35%; border: none; height: 50px; border-radius: 2rem;background-color: blue;color: white; '>Review & Pay</button></a>";
            $message .= "<a href='http://meinhausca.com/meinhause/booking-invoice/$booking->id'><button style='margin-left: 277px;width: 35%; border: none; height: 50px; border-radius: 2rem;background-color: blue;color: white; '>Review & Pay</button></a>";
            $message .= "</div>";
            $message .= "<div style='display: flex; justify-content: center; margin-top: 15px;'>";
            $message .= "<i style='margin: 0 10px; font-size: 20px;' class='fab fa-cc-visa'></i>";
            $message .= "<i style='margin: 0 10px; font-size: 20px;' class='fab fa-cc-mastercard'></i>";
            $message .= "<i style='margin: 0 10px; font-size: 20px;' class='fab fa-cc-amex'></i>";
            $message .= "</div>";
            $message .= "<br>";
            $message .= "<div style='padding: 6px;'>Plz Pay</div>";
            $message .= "<br>";
            $message .= "<div style='text-align: center;'>";
            $message .= "<p style='margin-bottom: -1px;'>Invoice 27</p>";
            /*$message .= "<a href=''>View Invoice</a>";*/
            $message .= "</div>";
            $message .= "<br>";
            $message .= "<div style='text-align: center;'>";
            $message .= "<p style='margin-bottom: -12px !important; font-size: 18px; font-weight: bold;'>Meinhaus</p>";
            $message .= "<p style='margin-bottom: -1px;'>Phone: 6479309066</p>";
            $message .= "<a style='text-decoration: none;' href=''>info@meinhaus.ca</a>";
            $message .= "</div>";
            $message .= "</div>";
            $message .= "</div>";



			/*--------Inner trade --------*/


            //$message .="<a href='{{ route('estimate.edit',".$booking->booking_show_id.") }}'>Please click to accept the order</a>";
            //$message .="<a href='http://meinhausca.com/public/onlinebook/$booking->id/edit'>Please click to book your service</a>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From:".$from_mail;

            if(mail($mailto,$subject,$message,$headers))
    	    {
                return redirect()->route('estimate')->withsuccess('New Estimate Created Successfully');
    	    }
		}
	}



	public function service_index()
    {
	  $data['services'] = DB::table('services')->orderby('id','desc')->get();

       return view('admin.service.index',$data);
    }

	public function bookings_index()
    {
	  $data['bookings'] = DB::table('bookings')->orderby('id','desc')->get();

       return view('admin.bookings.index',$data);
    }

	public function sales_index()
    {
	  $data['bookings'] = DB::table('custom_bookings')->orderby('id','desc')->get();

       return view('admin.sales.index',$data);
    }


	public function transaction_index()
    {
	  $data['bookings'] = DB::table('user_transactions')->orderby('id','desc')->get();

       return view('admin.transaction.index',$data);
    }

	public function promo_index()
    {
	  $data['bookings'] = DB::table('promocodes')->orderby('id','desc')->get();

       return view('admin.promo.index',$data);
    }




	public function logout()
	{
    	Auth::logout();
    	Session::flush();
    	return redirect(url('admin/login'));
	}

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
