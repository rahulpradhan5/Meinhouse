<?php

namespace App\Http\Controllers;

use App\Exports\ProfessionalExpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use App\Models\Estimate;
use App\Models\Booking;
use App\Models\Blog;
use App\Models\MultipleEstimate;
use App\Models\ProLead;
use App\Models\MultipleEstimateServices;
use App\Models\ProAvailability;
use App\Models\ProService;
use App\Models\ProDetail;
use App\Models\ProReview;
use App\Models\UserTransaction;
use App\Models\Promocode;
use App\Models\MultipleEstimateBid;
use App\Models\User_data;
use App\Models\User_data_service;
use App\Models\User_data_image;
use App\Models\User_data_projectDetail;
use App\Models\Pro_data;
use App\Models\Pro_data_service;
use App\Models\Recent_activity_user;
use App\Models\CustomBooking;
use App\Http\Helper\Helper;
use App\Models\UserDevice;
use App\Models\PhotoRequirement;

use Hash;
use Session;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Stripe;
use Carbon\Carbon;

class AdminControllerNew extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// Login And Dashboard
    public function login()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $uri_path = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $first = $uri_segments[1];
            $second = $uri_segments[2];
            $third = $uri_segments[3] ?? null;
            $fourth = $uri_segments[4] ?? null;
            $final = "http://beautyliciousnj.com/meinhause/$first/$second/$third/$fourth";
        }
        
        if(isset($_SERVER['HTTP_REFERER']))
        {
            if($_SERVER['HTTP_REFERER']===$final)
            {
                session()->put('urlref',$_SERVER['HTTP_REFERER']);
            }
            else
            {
                session()->put('urlref',"NotFound");
            }
        }
        else
        {
            session()->put('urlref',"NotFound");
        }
        return view('admin_jobick.login');
    }

    public function login_post(Request $request)
    {

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
          if(Auth::user()->role_id == 1){
            $useLoginId=User::where(['email'=>$request->email])->get();

            session()->put('admin-login-id',$useLoginId[0]->id);
            
            if(session()->get('urlref')!= "NotFound")
            {
                return redirect(url(session()->get('urlref')));
            }
            else
            {
                return redirect(url('admin/dashboard'));
            }
            

          }else{
            Session::flush();
            Auth::logout();
            //return redirect(url('admin-login'));

             return back()->with('error','Invalid Username and Password.');
          }
        }else{
          return back()->with('error','Invalid Username and Password.');
        }
    }
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

      $activities=DB::table('admin_recent_activity')->orderby('id','desc')->take(5)->get();

      $events = DB::table('admin_recent_activity')->select('id', 'created_at')->get()->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
    });
    $year = date("Y");

    //dd((int)$year);
    $activities_month=$events[$year]->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::parse($date->created_at)->format('m'); // grouping by months
    });
    $activitycount = [];
    $activityArr = [];
    foreach ($activities_month as $key => $value) {
        $activitycount [(int)$key] = count($value);
    }
    for($i = 1; $i <= 12; $i++){
    if(!empty( $activitycount[$i])){
        $activityArr [$i] = $activitycount[$i];
    }else{
        $activityArr[$i] = 0;
    }


}
//user_landing
      $User_landing = DB::table('user_data_services')->select('id', 'created_at')->get()->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
    });
    $year = date("Y");

    //dd((int)$year);
    $users_month=$User_landing[$year]->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::parse($date->created_at)->format('m'); // grouping by months
    });
    $userscount = [];
    $usersArr = [];
    foreach ($users_month as $key => $value) {
        $userscount[(int)$key] = count($value);
    }
    for($i = 1; $i <= 12; $i++){
    if(!empty(  $userscount[$i])){
        $usersArr [$i] = $userscount[$i];
    }else{
        $usersArr[$i] = 0;
    }


}

//pro_landing
$pro_landing = DB::table('pro_data_services')->select('id', 'created_at')->get()->groupBy(function($date) {
    return Carbon::parse($date->created_at)->format('Y'); // grouping by years
    //return Carbon::parse($date->created_at)->format('m'); // grouping by months
});
$year = date("Y");

//dd((int)$year);
$pro_month=$pro_landing[$year]->groupBy(function($date) {
    //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
    return Carbon::parse($date->created_at)->format('m'); // grouping by months
});
$procount = [];
$proArr = [];
foreach ($pro_month as $key => $value) {
    $procount[(int)$key] = count($value);
}
for($i = 1; $i <= 12; $i++){
if(!empty(  $procount[$i])){
    $proArr [$i] = $procount[$i];
}else{
    $proArr[$i] = 0;
}


}

$pro_data_count=Pro_data::count();
         return view('admin_jobick.dashboard',compact('user','professional','estimate_count','unlisted_pro','estimates','latest_pro','percentage','activities','activityArr','usersArr','proArr','pro_data_count'));

    }
// User Operations Start
    public function user_index()
    {
        $data['user'] = DB::table('users')->where('role_id','2')->orderby('id','desc')->get();
        return view('admin_jobick.user.index',$data);
    }
    public function user_delete($id)
    {

      DB::table('users')->where('id',$id)->delete();
      return back()->with('success','User Deleted Successfully!');

    }
    public function user_view($id)
    {
       $data['users'] = User::where('id',$id)->first();
       $data['bookings'] = Booking::where('user_id',$id)->whereIn('booking_status',[0,1])->orderBy('id','DESC')->get();

        return view('admin_jobick.user.view_user',$data);
    }
    public function user_status(Request $request)
    {
      $id = $request->id;
      $result = DB::table('users')->where('id',$id)->get();
      $status = $result[0]->status;
      if($status=='1'){
        DB::table('users')->where('id',$id)->update(array('status'=>'0'));
        return $status;
        exit();
      }else{
        DB::table('users')->where('id',$id)->update(array('status'=>'1'));
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
// User Operations End
// Professional Start
    public function professional()
    {
      $data['user'] = DB::table('users')->where('role_id','3')->where('state',1)->where('is_listed',1)->where('is_payment',1)->orderby('id','desc')->get();
      return view('admin_jobick.professional.index',$data);
    }
    public function professional_view($id)
    {
        $users = User::where('id',$id)->first();
        $prodetails = ProDetail::where('pro_id',$id)->first();
        $proservices = ProService::where('pro_id',$id)->get();
        $bookings = Booking::where('pro_id',$id)->orderBy('id','DESC')->get();
        $reviews = ProReview::where('pro_id',$id)->orderBy('id','DESC')->get();
        $review_avg = ProReview::where('pro_id',$id)->orderBy('id','DESC')->avg('stars');
        $proavailability = ProAvailability::where('pro_id',$id)->get();
        $monday = ProAvailability::where('pro_id',$id)->where('day_id',1)->first();
        $tuesday = ProAvailability::where('pro_id',$id)->where('day_id',2)->first();
        $wednesday = ProAvailability::where('pro_id',$id)->where('day_id',3)->first();
        $thursday = ProAvailability::where('pro_id',$id)->where('day_id',4)->first();
        $friday = ProAvailability::where('pro_id',$id)->where('day_id',5)->first();
        $saturday = ProAvailability::where('pro_id',$id)->where('day_id',6)->first();
        $sunday = ProAvailability::where('pro_id',$id)->where('day_id',7)->first();
        $all = ProAvailability::where('pro_id',$id)->where('day_availability',1)->count();


        return view('admin_jobick.professional.details',compact('users','bookings','prodetails','proservices','proavailability','monday','tuesday','wednesday','thursday','friday','saturday','sunday','all','reviews','review_avg'));
    }
    public function professional_delete($id)
    {
        $user = user::where('id',$id)->delete();
        return back()->with('success','Professional Deleted Successfully!');
    }
    public function professional_edit($id)
    {
      $prodetails = ProDetail::where('pro_id',$id)->first();

      if(!$prodetails){
        return redirect('admin/professional')->with('error','Business Not Listed');
      }
        $users = User::where('id',$id)->first();
        $prodetails = ProDetail::where('pro_id',$id)->first();
        return view('admin_jobick.professional.edit',compact('users','prodetails'));

    }

    public function professional_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
        'company_name'=>'max:50|min:0',
        'business_address'=>'max:50|min:0',
        'phone_no'=>'max:15|min:0',
        'name'=>'max:50|min:0',
        'address'=>'max:50|min:0',
        'city'=>'max:50|min:0',
        'province'=>'max:50|min:0',
        'postal_code'=>'max:50|min:0',
        'experience'=>'max:50|min:0',
        'distance'=>'max:50|min:0',
        'ein_no'=>'max:50|min:0',
        'acc_first_name'=>'max:50|min:0',
        'acc_last_name'=>'max:50|min:0',
        'ssn_no'=>'max:50|min:0',
        'dob'=>'max:50|min:0',
        'routing_no'=>'max:50|min:0',
        'account_no'=>'max:50|min:0',
        'license_no'=>'max:50|min:0',
        'routing_no'=>'max:50|min:0',

        ]);

      if($validator->fails()){
      return redirect()->back()
      ->withErrors($validator)
      ->withInput();
      }
      $userprofile = ProDetail::where('id',$request->editId)->first();
      if($request->file('file')){
        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('/upload/pro_doc'), $imageName);
      }else{
        $imageName=$request->input('OldImg');
      }

      if($request->file('passport_loc')){
        $PassPortimage = time().'.'.$request->passport_loc->extension();
        $request->passport_loc->move(public_path('/upload/pro_doc'),$PassPortimage);
        $userprofile->insurance=$PassPortimage;

      }else{

        $userprofile->insurance=$request->OLDpassport_loc;
      }



        $userprofile->company_name=$request->company_name;
        $userprofile->business_address=$request->business_address;
        $userprofile->phone_no=$request->phone_no;
        $userprofile->commission_perc=$request->commission_perc;
        $userprofile->com_ind=$request->com_ind;
        $userprofile->ein_no=$request->ein_no;
        $userprofile->acc_first_name=$request->acc_first_name;
        $userprofile->acc_last_name=$request->acc_last_name;
        $userprofile->ssn_no=$request->ssn_no;
        $userprofile->dob=$request->dob;
        $userprofile->routing_no=$request->routing_no;
        $userprofile->account_no=$request->account_no;
        $userprofile->license_no=$request->license_no;
        $userprofile->license_doc=$imageName;
        $userprofile->transaction_id=$request->transaction_id;
        $userprofile->amount=$request->amount;
        $userprofile->name=$request->name;
        $userprofile->address=$request->address;
        $userprofile->city=$request->city;
        $userprofile->province=$request->province;
        $userprofile->postal_code=$request->postal_code;
        $userprofile->experience=$request->experience;
        $userprofile->vehicle_owner=$request->vehicle_owner;

        $userprofile->distance=$request->distance;
        $userprofile->criminal_offence=$request->criminal_offence;



      if($userprofile->update()){
      //return redirect()->to('job_view/'.$id);
      //	return redirect('/admin/professional/edit/'.$request->pro_id)->with('success','Data updated successfully.');
          return redirect('admin/professional')->with('success','Professional updated successfully.');

      }else{
        return back()->with('error','An Error Occured!');
      }

		}

// Professional end
// Service Start
    public function service_index()
    {
      $data['services'] = DB::table('services')->orderby('id','desc')->get();
      return view('admin_jobick.service.index',$data);
    }
    public function service_view($id)
    {
      $data['service'] = DB::table('services')->where('id',$id)->first();
      return view('admin_jobick.service.details',$data);
    }
    public function service_edit($id)
    {
      $data['service'] = DB::table('services')->where('id',$id)->first();
      return view('admin_jobick.service.edit',$data);
    }
    public function service_update(Request $request)
    {
        $id=$request->id;
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'add_price' => 'required',
            'description' => 'required',
        ]);

        $service = Service::where('id',$id)->first();

        $service->name = $request->name;

        $service->price = $request->price;
        $service->add_price = $request->add_price;
        $service->description = $request->description;

        if($request->service_type == 'red'){
        	$service->service_type = 0;
        	$service->time = $request->time;
        }else{
        	$service->service_type = 1;
        	$service->time = $request->area;
        }

        if($files = $request->file('service_icon')){
            // upload path
            $destinationPath = public_path('../assets/services/');
            // Upload Orginal Image
            $input['name']=time().'.'.$files->getClientOriginalExtension();
            $files->move($destinationPath,$input['name']);
            // Save In Database
            $service->service_image=$input['name'];
        }
        if($files1 = $request->file('service_image')){
            // upload path
            $destinationPath = public_path('../assets/services/');
            // Upload Orginal Image
            $input['name1']=time().'1.'.$files1->getClientOriginalExtension();
            $files1->move($destinationPath,$input['name1']);
            // Save In Database
            $service->service_desc_image=$input['name1'];
        }


        $service->save();

        return redirect('admin/service')->with('success','Service updated successfully.');
    }
    public function service_status(Request $request)
    {
        // $service = Service::find($request->id);
        // $service->status = $request->status;
        // $service->save();
        $id = $request->id;
        $result = DB::table('services')->where('id',$id)->first();
        $status = $result->status;
        if($status=='1'){
          DB::table('services')->where('id',$id)->update(array('status'=>'0'));
          return $status;
          exit();
        }else{
          DB::table('services')->where('id',$id)->update(array('status'=>'1'));
          return $status;
          exit();
        }
        return response()->json(['success'=>'Status change successfully.']);
    }
    public function service_delete($id)
    {
        $service = Service::where('id',$id)->delete();
        //print_r($service);exit;
        return redirect()->back()->with('success', 'Service Deleted Successfully');

    }
    public function service_add()
    {
      return view('admin_jobick.service.add');
    }
    public function service_add_post(Request $request)
    {
    	//print_r($request->all());exit;
        $this->validate($request, [
            'name' => 'required',
            'service_icon' => 'required',
            'service_image' => 'required',
            'price' => 'required',
            'add_price' => 'required',
            'description' => 'required',

        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->url = $request->url;
        $service->price = $request->price;
        $service->add_price = $request->add_price;
        $service->description = $request->description;

        if($request->service_type == "red"){
        	$service->service_type = 0;
        	$service->time = $request->time;
        }elseif($request->service_type == "pink"){
        	$service->service_type = 2;
        	$service->time = '2';
        }else{
        	$service->service_type = 1;
        	$service->time = $request->area;
        }
        if ($files = $request->file('service_icon')) {
            // Define upload path
           $destinationPath = public_path('../assets/services/'); // upload path
            // Upload Orginal Image
            $input['name']=time().'.'.$files->getClientOriginalExtension();
           $files->move($destinationPath,$input['name']);
            // Save In Database
           $service->service_image=$input['name'];
        }

        if ($files = $request->file('service_image')) {
            // Define upload path
           $destinationPath = public_path('../assets/services/'); // upload path
            // Upload Orginal Image
           $input['name']=time().'.'.$files->getClientOriginalExtension();
           $files->move($destinationPath, $input['name']);
            // Save In Database
           $service->service_desc_image=$input['name'];
        }

            $service->save();
            return redirect('admin/service')->with('success','Service added successfully.');

    }

// Booking Start
   public function bookings_index()
    {
      $data['bookings'] = Booking::orderBy('id','DESC')->get();
      return view('admin_jobick.bookings.index',$data);
    }
    public function bookings_view($id)
    {
      $data['bookings'] = Booking::where('id',$id)->first();
      return view('admin_jobick.bookings.details',$data);
    }
    
     public function CutomBookings_index()
    {
      $data['bookings'] = CustomBooking::orderBy('id','DESC')->get();
      return view('admin_jobick.custom_bookings.index',$data);
    }

 public function CustomBookings_view($id)
    {
        $data['bookings'] = CustomBooking::where('id',$id)->first();
        return view('admin_jobick.custom_bookings.details',$data);
    }
    public function bookings_cancel($id)
    {
        //
        $bookings = Booking::find($id);
        $bookings->booking_status = 8;
        $bookings->save();

        return response()->json(['success'=>'Booking cancelled successfully.']);
    }
//Booking end
// Transaction
  public function transaction_index()
  {
    $data['trans'] = UserTransaction::orderby('id','desc')->get();
    return view('admin_jobick.transaction.index',$data);
  }
// Transaction End
// Promo
    public function promo_index()
    {
      $data['promocodes'] = Promocode::orderBy('id','DESC')->get();
      return view('admin_jobick.promo.index',$data);
    }
    public function promo_delete($id)
    {
        $promocode = Promocode::where('id',$id)->delete();
        return redirect()->back()->with('success','Promocode deleted !');
    }
    public function promo_add()
    {
      return view('admin_jobick.promo.add');
    }
    public function promo_add_post(Request $request)
    {
        //
         $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'description' => 'required',
            'promo_image' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        $promocode = new Promocode();
        $promocode->name = $request->name;
        $promocode->code = $request->code;
        $promocode->price = $request->price;
        $promocode->description = $request->description;
          if ($files = $request->file('promo_image')) {
            // Define upload path
           $destinationPath = public_path('promo_image'); // upload path
            // Upload Orginal Image
           $input['name']=time().'.'.$files->getClientOriginalExtension();
           $files->move($destinationPath, $input['name']);
            // Save In Database
           $promocode->promo_image=$input['name'];
        }

        $promocode->start_date = date('Y-m-d',strtotime($request->start_date));
        $promocode->end_date = date('Y-m-d',strtotime($request->end_date));



            $promocode->save();
            return redirect('admin/promo')->with('success','Promocode added successfully.');
    }
    public function promo_view($id)
    {
        //
         $data['promocode'] = Promocode::where('id',$id)->first();
        return view('admin_jobick.promo.details',$data);
    }
    public function promo_edit($id)
    {
        //
         $data['promocode'] = Promocode::where('id',$id)->first();
        return view('admin_jobick.promo.edit',$data);
    }
    public function promo_edit_post(Request $request)
    {
        //
        $id=$request->id;
         $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

        ]);


        $promocode = Promocode::where('id',$id)->first();

        $promocode->name = $request->name;
        $promocode->code = $request->code;
        $promocode->price = $request->price;
        $promocode->description = $request->description;
          if($files = $request->file('promo_image')) {
            // Define upload path
           $destinationPath = public_path('promo_image/'); // upload path
            // Upload Orginal Image
           $input['name']=time().'.'.$files->getClientOriginalExtension();
           $files->move($destinationPath, $input['name']);
            // Save In Database
           $promocode->promo_image=$input['name'];
        }


        $promocode->start_date = date('Y-m-d',strtotime($request->start_date));
        $promocode->end_date = date('Y-m-d',strtotime($request->end_date));
              $promocode->save();
                  return redirect('admin/promo')->with('success','Promocode updated successfully.');
    }
    public function promo_status(Request $request)
    {
          $id = $request->id;
          $result = DB::table('promocodes')->where('id',$id)->get();
          $status = $result[0]->status;
          if($status=='1'){
            DB::table('promocodes')->where('id',$id)->update(array('status'=>'0'));
            return $status;
            exit();
          }else{
            DB::table('promocodes')->where('id',$id)->update(array('status'=>'1'));
            return $status;
            exit();
          }
    }
// PromoCodes end
// testimonial
  public function testimonial()
  {
    $data['testimonials'] = DB::table('testimonials')->orderby('id','desc')->get();
    return view('admin_jobick.testimonial.index',$data);
  }
  public function testimonial_add()
  {
    return view('admin_jobick.testimonial.add');
  }
  public function testimonial_add_post(Request $request)
  {
      if($request->isMethod('POST'))
      {
          $request->validate([
              'image' => 'required',
              'name' => 'required',
              'description' => 'required'
          ]);

          $image = time() .".". $request->image->extension();
          $request->image->move(public_path('testimonial'),$image);

          $data = array(
              'testimonial_image' => $image,
              'name' => $request->name,
              'description' => $request->description
          );
          DB::table('testimonials')->insert($data);
          return redirect('admin/testimonials')->with('success','Successfully Inserted!');
      }
      return redirect()->back()->with('error','Error Occured !');
  }
  public function testimonial_view($id)
  {
      $data['testimonial'] = DB::table('testimonials')->where('id',$id)->first();
      return view('admin_jobick.testimonial.details',$data);
  }
  public function testimonial_edit($id)
  {
      $data['testimonial'] = DB::table('testimonials')->where('id',$id)->first();
      return view('admin_jobick.testimonial.edit',$data);
  }
  public function testimonial_edit_post(Request $request)
  {
    $id=$request->id;

        if($request->image)
        {
            $image = time() .".". $request->image->extension();
            $request->image->move(public_path('testimonial'),$image);
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
        return redirect('admin/testimonials')->with('success','Successfully Updated!');

  }
  public function testimonial_delete($id)
  {
      DB::table('testimonials')->where('id',$id)->delete();
      return redirect()->back()->with('success','Successfully Deleted!');
  }
// testimonial end
// Contact Us
    public function contact()
    {
      $data['contact'] = DB::table('contacts')->orderby('id','desc')->get();
      return view('admin_jobick.contact.index',$data);
    }
    public function contact_delete($id)
    {
        $promocode = DB::table('contacts')->where('id',$id)->delete();
        return redirect()->back()->with('success','Contact deleted !');
    }
    public function view_contact($id)
    {
        $data['contact'] = DB::table('contacts')->where('id',$id)->first();
        return view('admin_jobick.contact.details',$data);
    }

// Contact End
// Edit profile
    public function edit_profile()
    {
      return view('admin_jobick.editprofile');
    }
    public function edit_profile_post(Request $request)
    {
        $user = User::where('id',auth::user()->id)->where('role_id','1')->first();
        

        if(empty($user)){

            return redirect()->back()->withError('Admin Not Found.');

        }
          $validator = Validator::make($request->all(),[

        'phone_no'=>'required|max:15|min:10',
        
            ]);

        if($validator->fails()){

            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        

        $user->name = $request->name;
        $user->phone = $request->phone_no;

        if ($files = $request->file('profile_image')) {
            // Define upload path
           $destinationPath = public_path('uploads/users'); // upload path
            // Upload Orginal Image
            $input['name']=time().'.'.$files->getClientOriginalExtension();
           $files->move($destinationPath,$input['name']);
            // Save In Database
           $user->user_image=$input['name'];
        }

        if($user->save()){

            return redirect()->back()->withSuccess('Admin Updated Successfully.');
        }
    }
    public function changePassword()
    {
        return view('admin_jobick.change_password');
    }

    public function changePasswordPost(Request $request)
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
                      return redirect()->back()->with('error',"Your current password does not matches with the password you provided. Please try again.");
                  }
                  if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
                      //Current password and new password are same
                      return redirect()->back()->withwith('error',"New Password cannot be same as your current password. Please choose a different password.");
                  }
                  //Change Password
                  $user = Auth::user();
                  $user->password = Hash::make($request->get('new_password'));
                  if($user->save())
                  {

                      return redirect()->back()->with('success','Password Changed Successfully');
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
//profile end
// Blog Start
    public function blog()
    {
        $data['blog'] = DB::table('blogs')->orderby('id','desc')->get();
        return view('admin_jobick.blog.index',$data);
    }

    public function view_blog($id)
    {
        $data['blog'] = DB::table('blogs')->where('id',$id)->first();
        return view('admin_jobick.blog.details',$data);
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
                'description' => $request->description,
                'date' => $request->date
            );
            DB::table('blogs')->insert($data);
            return redirect('admin/blog')->with('success','Successfully Inserted!');
        }
        return view('admin_jobick.blog.add');
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
                    'description' => $request->description,
                    'date' => $request->date
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
                    'description' => $request->description,
                    'date' => $request->date
                );
            }

            DB::table('blogs')->where('id',$id)->update($data);
            return redirect('admin/blog')->with('success','Successfully Updated!');
        }
        $data['blog'] = DB::table('blogs')->where('id',$id)->first();
        return view('admin_jobick.blog.edit',$data);
    }

    public function deleteBlog($id)
    {
        DB::table('blogs')->where('id',$id)->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
// Blog End
    // public function estimate()
    // {
    //   $data['estimate'] = DB::table('estimates')->orderby('id','desc')->get();
    //   return view('admin_jobick.estimate.index',$data);
    // }
    public function sales_index()
    {
      $data['bookings'] = DB::table('custom_bookings')->orderby('id','desc')->get();
      return view('admin_jobick.sales.index',$data);
    }
    
    
    
    public function createCustomBooking()
    {
        $users = User::where('role_id',2)->where('status',1)->get();
        $pro = User::where('role_id',3)->where('status',1)->where('is_listed',1)->get();
        $services = Service::where('status',1)->get();
        return view('admin_jobick.custom_bookings.add',compact('users','services','pro'));
    }
    
    
    public function createCustomBookingPost(Request $request,Helper $helper)
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
        }else{

            $user_address = $request->address.','.$request->locality.','.$request->city.','.$request->state.','.$request->pin_code;
            $name = User::where('id',$request->user_id)->first();
            $booking = new Booking();
            $booking->user_id = $request->user_id;
            $booking->service_id = $request->service_id;
            $booking->home_type = 0;
            $booking->name = $name->name;
            $booking->address = $user_address;
            $booking->area = $request->address;
            $booking->locality = $request->locality;
            $booking->city = $request->city;
            $booking->state = $request->state;
            $booking->pin_code = $request->pin_code;
            $booking->date = date('d-m-Y',strtotime($request->date));
            $booking->time = $request->time;
            $booking->phone_no = $request->phone_no;
            $booking->description = $request->description;
            $booking->timing_constraints = 'NA';
            $booking->pro_id = $request->pro_id;
            $booking->custom_booking = 1;
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
            $booking->amount = $total_amount;
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
                // $notification_id = $helper->activity_save(Auth::user()->id,'Service Booked Successfully',$message,$booking->booking_status,$booking->id,'');
                // $data['notification_id'] = $notification_id;
                // $data['type'] = $booking->booking_status;
                // $data['booking_id'] = $booking->id;
                // $helper->globalPushNotificationMultiple($deviceTokens,'Service Booked Successfully',$message,$data);
                
                $leads = new ProLead();
                $leads->booking_id = $booking->id;
                $leads->pro_id = $request->pro_id;
                $leads->save();
    
                // $subject = "Booking Request For Service ".$booking['serviceDetails']['name'];
                // $message = $booking->name ." generate a request for service ".$booking['serviceDetails']['name']." on ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
                // $deviceTokens = UserDevice::where('user_id',$request->pro_id)->where('notification_status',1)->pluck('device_token');
                // $notification_id = $helper->activity_save($request->pro_id,$subject,$message,$booking->booking_status,$booking->id,'');
                // $data['notification_id'] = $notification_id;
                // $data['type'] = $booking->booking_status;
                // $data['booking_id'] = $booking->id;
                // $helper->globalPushNotificationMultiple($deviceTokens,$subject,$message,$data);
                
                $mailto = $name->email;
                $from_mail = "info@meinhaus.ca";
                $subject = "Booking Request For Service ".$booking['serviceDetails']['name'];
                $uid = $booking->id;
               
                $message ="Admin generate a request for your custom service ".$booking['serviceDetails']['name']." on ".date('D,d M Y',strtotime($booking->date))." ".$timeval;
                $message .= "<table><tr> Service Name : ";
                $message .= $booking['serviceDetails']['name'];
                $message .="</tr>";
                 $message .= "<table><tr> Booking ID : ";
                $message .= $booking->booking_show_id;
                $message .="</tr></table>";
                $message .= "<table><tr> Amount : ";
                $message .= $booking->amount;
                $message .="</tr></table>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From:".$from_mail;
    
                mail($mailto,$subject,$message,$headers);
                return redirect(url('admin/CustomBookings'))->withsuccess('New Booking Created Successfully!');
                
            }
        }   
            
    }
    
    

    // start of multiple estimate


    public function multipleEstimate()
    {
        $data['mult_est'] = DB::table('multiple_estimate')->where('delete_status','0')->where('payment_status','1')->orderby('id','desc')->get();
        return view('admin_jobick.multiple_estimate.index',$data);
    }

    public function multipleEstimateView($id)
    {
        $m_est = MultipleEstimate::leftjoin('estimate_booking_transaction', 'multiple_estimate.booking_show_id', "=", 'estimate_booking_transaction.booking_id')
                ->where('multiple_estimate.id', $id)->get();

        $ms_filter = MultipleEstimateServices::where('estimate_id',$id)->get();
        // echo $id;
        return view('admin_jobick.multiple_estimate.details', compact('m_est','ms_filter'));
    }
    
    public function admin_multiple_booking_invoice($BookingId)
    {
        // try {
        //     if(Http::get($BookingId)->successful()) {
                
        //     } else {
        //           // DO THE SAME THING AS IN CATCH()
        //     }
        // } catch (\Exception $ex) {
        //      // DO SOMETHING BECAUSE THE URL DOESN'T EXIST
        // }
        $data['bookingId'] =  $BookingId;
        return view('admin_jobick.multiple_estimate.email_template_mest',$data);
        
    }

    public function multipleEstimateEdit($id)
    {
        $data = MultipleEstimate::where('id', $id)->get();
        $ms_filter = MultipleEstimateServices::where('estimate_id',$id)->get();
        $services = Service::where('status',1)->get();
        return view('admin_jobick.multiple_estimate.edit', compact('data','ms_filter','services'));
    }
    
    public function multipleEstimateServiceEdit($id,$service_id)
    {
        $data = MultipleEstimate::where('id', $id)->get();
        $mf = MultipleEstimateServices::where('estimate_id',$id)->where('id',$service_id)->first();
        $services = Service::where('status',1)->get();
        return view('admin_jobick.multiple_estimate.service_edit', compact('data','mf','services'));
    }

    public function multipleEstimateEditPost(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
        
            'phone_no'=>'required|max:15|min:10',
          
        ]);
         if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $update = DB::table('multiple_estimate')->where('booking_show_id', $request->booking_id)->update(array(
            'name'=>$request->user_id,
            'email'=>$request->email,
            'date'=>date("d-m-Y", strtotime($request->date)),
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'pincode'=>$request->pin_code,
            'phone_no'=>$request->phone_no
        ));
        
        $email = $request->email;
        $booking = $request->booking_id;
        $e_id = $request->e_id;
        $title = $request->est_title;
        
        $count_child = count($request->child_id)-1;
        $count_service = count($request->service_id)-1;
        $count_amount = count($request->amount)-1;
        $count_reg_amount = count($request->reg_amount)-1;
        $count_description = count($request->description)-1;
        
        
        foreach($request->child_id as $c => $c_id)
        {
            $s_data = MultipleEstimateServices::find($c_id);
            
            for($s=0; $s < $count_service; $s++)
            {
                $s_data->service_id = $request->service_id[$c];
            }
            
            for($a=0; $a < $count_amount; $a++)
            {
                $s_data->amount = $request->amount[$c];
            }
            
            for($r=0; $r < $count_reg_amount; $r++)
            {
                $s_data->reg_amount = $request->reg_amount[$c];
            }
            
            for($d=0; $d < $count_description; $d++)
            {
                $s_data->description = $request->description[$c];
            }
            
            $s_data->save();
        }
        
        $to = $email;
        $subject = 'Meinhaus Booking '.$booking;

        $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        $message = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' type='text/css' href='https://meinhaus.ca/public/theme/css/font-awesome.css' />




</head>
<style>
    .fa:hover {
        transition: 0.5s;
        color: white !important;
    }
</style>

<body style='background-color: #F0F3F7;margin: 0;'>
    <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
        <div style='width: 100%; background-color: white;' class='container'>
            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt=''
                    width='217px' height='70px'></h1>
            <h1 style='text-align: center;'>$title</h1>
            <hr>
            <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
            </p>
            <br>
            <h1 style='text-align: center;'>
                <a href='http://beautyliciousnj.com/meinhause/multiple-booking-invoice/$e_id'><button
                        style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View
                        Estimate Online</button></a>
            </h1>
            <br>
            <center><img src='https://meinhaus.ca/public/image/visa-option.jpg' alt=''></center>
            <div style='text-align: center;'>
                <img src='https://www.meinhaus.ca/public/image/5a90312d7f96951c82922878.png' width='280px'
                    height='60px'>
                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


            </div>

            <div style='margin-top:20px;background-color: #182434;'>
                <div class='' style='align-content: center;display: flex;padding: 10px 50px;'>
                    <div style='margin-right: auto;'>
                        <h2 class='text' style='color: #fff; font-family:sans-serif;text-align: center;'>Contact Us
                        </h2>
                        <div style='justify-content: center;display: flex;'>
                            <div>
                                <p style='margin: 0px;color: #fff;font-family:sans-serif'><strong>Email :</strong>
                                    info@meinhaus.ca</p>
                            </div>
                        </div>
                    </div>

                    <div style='margin-inline: auto;'>
                        <div style='text-align: center;'>
                            <h2 class='text' style='color: #fff;font-family:sans-serif'>Follow Us On:</h2>
                            <a href='https://www.facebook.com/meinhausservices' style='color: #a8a7a7; text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/facebook.png'>
                            </a>
                            <a href='https://www.linkedin.com/company/mein-haus-services'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/linkedin.png'>
                            </a>
                            <a href='https://www.instagram.com/meinhausapp/?utm_medium=copy_link'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/instagram.png'>   
                                    
                            </a>
                            <a href='https://www.pinterest.com/meinhausservices/'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/pinterest.png'>
                                </a>
                        </div>
                    </div>
                    <div style='text-align: center;margin-left: auto;'>
                        <h2 class='text' style='color: #fff;font-family:sans-serif'>Download the app</h2>
                        <a href='https://apps.apple.com/ca/app/mein-haus-professional/id1556987330' style='text-decoration: none;'>
                            <img src='http://meinhaus.ca/public/image/app.png' width='121px' height='52px'>
                        </a>
                        <a href='https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US'
                            style='margin-left:10px'>
                            <img src='http://meinhaus.ca/public/image/googleplay.png' width='121px' height='52px'></i>
                        </a>
                    </div>
                </div>
                <hr style='padding: 0;margin:0'>
                <div class='' style='color: #a8a7a7;text-align: center;margin-top:5px;margin-bottom:5px;'>
                    <div style='text-align: center;'>
                        <div style='text-align: center;'>Developed By <span style='color: white;'>QuantumIT</span></div>
                        <div style='margin-top: 5px;text-align: center;'>Copyright © 2020 <span style='color: white;'>MeinHaus.</span> All
                            rights reserved. </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>";
        
        if(mail($to, $subject, $message, $headers)){
            $to2 = "info@meinhaus.ca";
            $subject2 = 'Meinhaus Booking '.$booking;
        
            $headers2 = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
            $headers2 .= "MIME-Version: 1.0\r\n";
            $headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            $message2 = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' type='text/css' href='https://meinhaus.ca/public/theme/css/font-awesome.css' />




</head>
<style>
    .fa:hover {
        transition: 0.5s;
        color: white !important;
    }
</style>

<body style='background-color: #F0F3F7;margin: 0;'>
    <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
        <div style='width: 100%; background-color: white;' class='container'>
            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt=''
                    width='217px' height='70px'></h1>
            <h1 style='text-align: center;'>$title</h1>
            <hr>
            <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
            </p>
            <br>
            <h1 style='text-align: center;'>
                <a href='http://beautyliciousnj.com/meinhause/multiple-booking-invoice/$e_id'><button
                        style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View
                        Estimate Online</button></a>
            </h1>
            <br>
            <center><img src='https://meinhaus.ca/public/image/visa-option.jpg' alt=''></center>
            <div style='text-align: center;'>
                <img src='https://www.meinhaus.ca/public/image/5a90312d7f96951c82922878.png' width='280px'
                    height='60px'>
                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


            </div>

            <div style='margin-top:20px;background-color: #182434;'>
                <div class='' style='align-content: center;display: flex;padding: 10px 50px;'>
                    <div style='margin-right: auto;'>
                        <h2 class='text' style='color: #fff; font-family:sans-serif;text-align: center;'>Contact Us
                        </h2>
                        <div style='justify-content: center;display: flex;'>
                            <div>
                                <p style='margin: 0px;color: #fff;font-family:sans-serif'><strong>Email :</strong>
                                    info@meinhaus.ca</p>
                            </div>
                        </div>
                    </div>

                    <div style='margin-inline: auto;'>
                        <div style='text-align: center;'>
                            <h2 class='text' style='color: #fff;font-family:sans-serif'>Follow Us On:</h2>
                            <a href='https://www.facebook.com/meinhausservices' style='color: #a8a7a7; text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/facebook.png'>
                            </a>
                            <a href='https://www.linkedin.com/company/mein-haus-services'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/linkedin.png'>
                            </a>
                            <a href='https://www.instagram.com/meinhausapp/?utm_medium=copy_link'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/instagram.png'>   
                                    
                            </a>
                            <a href='https://www.pinterest.com/meinhausservices/'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/pinterest.png'>
                                </a>
                        </div>
                    </div>
                    <div style='text-align: center;margin-left: auto;'>
                        <h2 class='text' style='color: #fff;font-family:sans-serif'>Download the app</h2>
                        <a href='https://apps.apple.com/ca/app/mein-haus-professional/id1556987330' style='text-decoration: none;'>
                            <img src='http://meinhaus.ca/public/image/app.png' width='121px' height='52px'>
                        </a>
                        <a href='https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US'
                            style='margin-left:10px'>
                            <img src='http://meinhaus.ca/public/image/googleplay.png' width='121px' height='52px'></i>
                        </a>
                    </div>
                </div>
                <hr style='padding: 0;margin:0'>
                <div class='' style='color: #a8a7a7;text-align: center;margin-top:5px;margin-bottom:5px;'>
                    <div style='text-align: center;'>
                        <div style='text-align: center;'>Developed By <span style='color: white;'>QuantumIT</span></div>
                        <div style='margin-top: 5px;text-align: center;'>Copyright © 2020 <span style='color: white;'>MeinHaus.</span> All
                            rights reserved. </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>";
            mail($to2, $subject2, $message2, $headers2);
        	return redirect('admin/multiple-estimate')->with('success','Successfully Updated!');
        }else{
        	echo "Mail Not Send";
        }
        
        // return redirect('admin/multiple-estimate')->with('success','Successfully Updated!');
    }
    
    public function multipleEstimateServiceEditPost(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
        
            'phone_no'=>'required|max:15|min:10',
          
        ]);
         if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $update = DB::table('multiple_estimate')->where('booking_show_id', $request->booking_id)->update(array(
            'name'=>$request->user_id,
            'email'=>$request->email,
            'date'=>date("d-m-Y", strtotime($request->date)),
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'pincode'=>$request->pin_code,
            'phone_no'=>$request->phone_no
        ));
        
        $email = $request->email;
        $booking = $request->booking_id;
        $e_id = $request->e_id;
        $title = $request->est_title;
        
        // $count_child = count($request->child_id)-1;
        // $count_service = count($request->service_id)-1;
        // $count_amount = count($request->amount)-1;
        // $count_reg_amount = count($request->reg_amount)-1;
        // $count_description = count($request->description)-1;
        
        $s_data = MultipleEstimateServices::find($request->child_id);
        $s_data->service_id = $request->service_id;
        $s_data->amount = $request->amount;
        $s_data->reg_amount = $request->reg_amount;
        $s_data->description = $request->description;
        $s_data->save();
        
        
        
        $to = $email;
        $subject = 'Meinhaus Booking '.$booking;

        $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        $message = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' type='text/css' href='https://meinhaus.ca/public/theme/css/font-awesome.css' />




</head>
<style>
    .fa:hover {
        transition: 0.5s;
        color: white !important;
    }
</style>

<body style='background-color: #F0F3F7;margin: 0;'>
    <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
        <div style='width: 100%; background-color: white;' class='container'>
            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt=''
                    width='217px' height='70px'></h1>
            <h1 style='text-align: center;'>$title</h1>
            <hr>
            <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
            </p>
            <br>
            <h1 style='text-align: center;'>
                <a href='http://beautyliciousnj.com/meinhause/multiple-booking-invoice/$e_id'><button
                        style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View
                        Estimate Online</button></a>
            </h1>
            <br>
            <center><img src='https://meinhaus.ca/public/image/visa-option.jpg' alt=''></center>
            <div style='text-align: center;'>
                <img src='https://www.meinhaus.ca/public/image/5a90312d7f96951c82922878.png' width='280px'
                    height='60px'>
                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


            </div>

            <div style='margin-top:20px;background-color: #182434;'>
                <div class='' style='align-content: center;display: flex;padding: 10px 50px;'>
                    <div style='margin-right: auto;'>
                        <h2 class='text' style='color: #fff; font-family:sans-serif;text-align: center;'>Contact Us
                        </h2>
                        <div style='justify-content: center;display: flex;'>
                            <div>
                                <p style='margin: 0px;color: #fff;font-family:sans-serif'><strong>Email :</strong>
                                    info@meinhaus.ca</p>
                            </div>
                        </div>
                    </div>

                    <div style='margin-inline: auto;'>
                        <div style='text-align: center;'>
                            <h2 class='text' style='color: #fff;font-family:sans-serif'>Follow Us On:</h2>
                            <a href='https://www.facebook.com/meinhausservices' style='color: #a8a7a7; text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/facebook.png'>
                            </a>
                            <a href='https://www.linkedin.com/company/mein-haus-services'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/linkedin.png'>
                            </a>
                            <a href='https://www.instagram.com/meinhausapp/?utm_medium=copy_link'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/instagram.png'>   
                                    
                            </a>
                            <a href='https://www.pinterest.com/meinhausservices/'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/pinterest.png'>
                                </a>
                        </div>
                    </div>
                    <div style='text-align: center;margin-left: auto;'>
                        <h2 class='text' style='color: #fff;font-family:sans-serif'>Download the app</h2>
                        <a href='https://apps.apple.com/ca/app/mein-haus-professional/id1556987330' style='text-decoration: none;'>
                            <img src='http://meinhaus.ca/public/image/app.png' width='121px' height='52px'>
                        </a>
                        <a href='https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US'
                            style='margin-left:10px'>
                            <img src='http://meinhaus.ca/public/image/googleplay.png' width='121px' height='52px'></i>
                        </a>
                    </div>
                </div>
                <hr style='padding: 0;margin:0'>
                <div class='' style='color: #a8a7a7;text-align: center;margin-top:5px;margin-bottom:5px;'>
                    <div style='text-align: center;'>
                        <div style='text-align: center;'>Developed By <span style='color: white;'>QuantumIT</span></div>
                        <div style='margin-top: 5px;text-align: center;'>Copyright © 2020 <span style='color: white;'>MeinHaus.</span> All
                            rights reserved. </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>";
        
        if(mail($to, $subject, $message, $headers)){
            $to2 = "info@meinhaus.ca";
            $subject2 = 'Meinhaus Booking '.$booking;
        
            $headers2 = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
            $headers2 .= "MIME-Version: 1.0\r\n";
            $headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            $message2 = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' type='text/css' href='https://meinhaus.ca/public/theme/css/font-awesome.css' />




</head>
<style>
    .fa:hover {
        transition: 0.5s;
        color: white !important;
    }
</style>

<body style='background-color: #F0F3F7;margin: 0;'>
    <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
        <div style='width: 100%; background-color: white;' class='container'>
            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt=''
                    width='217px' height='70px'></h1>
            <h1 style='text-align: center;'>$title</h1>
            <hr>
            <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
            </p>
            <br>
            <h1 style='text-align: center;'>
                <a href='http://beautyliciousnj.com/meinhause/multiple-booking-invoice/$e_id'><button
                        style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View
                        Estimate Online</button></a>
            </h1>
            <br>
            <center><img src='https://meinhaus.ca/public/image/visa-option.jpg' alt=''></center>
            <div style='text-align: center;'>
                <img src='https://www.meinhaus.ca/public/image/5a90312d7f96951c82922878.png' width='280px'
                    height='60px'>
                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


            </div>

            <div style='margin-top:20px;background-color: #182434;'>
                <div class='' style='align-content: center;display: flex;padding: 10px 50px;'>
                    <div style='margin-right: auto;'>
                        <h2 class='text' style='color: #fff; font-family:sans-serif;text-align: center;'>Contact Us
                        </h2>
                        <div style='justify-content: center;display: flex;'>
                            <div>
                                <p style='margin: 0px;color: #fff;font-family:sans-serif'><strong>Email :</strong>
                                    info@meinhaus.ca</p>
                            </div>
                        </div>
                    </div>

                    <div style='margin-inline: auto;'>
                        <div style='text-align: center;'>
                            <h2 class='text' style='color: #fff;font-family:sans-serif'>Follow Us On:</h2>
                            <a href='https://www.facebook.com/meinhausservices' style='color: #a8a7a7; text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/facebook.png'>
                            </a>
                            <a href='https://www.linkedin.com/company/mein-haus-services'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/linkedin.png'>
                            </a>
                            <a href='https://www.instagram.com/meinhausapp/?utm_medium=copy_link'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/instagram.png'>   
                                    
                            </a>
                            <a href='https://www.pinterest.com/meinhausservices/'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/pinterest.png'>
                                </a>
                        </div>
                    </div>
                    <div style='text-align: center;margin-left: auto;'>
                        <h2 class='text' style='color: #fff;font-family:sans-serif'>Download the app</h2>
                        <a href='https://apps.apple.com/ca/app/mein-haus-professional/id1556987330' style='text-decoration: none;'>
                            <img src='http://meinhaus.ca/public/image/app.png' width='121px' height='52px'>
                        </a>
                        <a href='https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US'
                            style='margin-left:10px'>
                            <img src='http://meinhaus.ca/public/image/googleplay.png' width='121px' height='52px'></i>
                        </a>
                    </div>
                </div>
                <hr style='padding: 0;margin:0'>
                <div class='' style='color: #a8a7a7;text-align: center;margin-top:5px;margin-bottom:5px;'>
                    <div style='text-align: center;'>
                        <div style='text-align: center;'>Developed By <span style='color: white;'>QuantumIT</span></div>
                        <div style='margin-top: 5px;text-align: center;'>Copyright © 2020 <span style='color: white;'>MeinHaus.</span> All
                            rights reserved. </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>";
            mail($to2, $subject2, $message2, $headers2);
        	return redirect("admin/services-view/$e_id")->with('success','Successfully Updated!');
        }else{
        	echo "Mail Not Send";
        }
        
        // return redirect('admin/multiple-estimate')->with('success','Successfully Updated!');
    }

    public function multipleEstimateDelete($id)
    {
         DB::table('multiple_estimate')->where('id', $id)->update(array(
            'delete_status'=>1
        ));
        return redirect()->back()->with('success','Successfully Deleted!');
    }
    
    public function convertEstimate($id)
    {
        $userData =  User_data::with(['services'])->where('id',$id)->first();
 
        $ProjectDetails=User_data_projectDetail::where('user_data_id',$id)->first();

        $Images=User_data_image::where('user_data_id',$id)->pluck('image');
        
        $users = User::where('role_id',2)->where('status',1)->get();
        $pro = User::where('role_id',3)->where('status',1)->where('is_listed',1)->get();
        $services = Service::where('status',1)->get();
        
        return view('admin_jobick.multiple_estimate.estimate_conversion',compact('userData','ProjectDetails','Images','users','services','pro'));   
    }


    public function createMultipleEstimate()
    {
        $users = User::where('role_id',2)->where('status',1)->get();
        $pro = User::where('role_id',3)->where('status',1)->where('is_listed',1)->get();
        $services = Service::where('status',1)->get();
        return view('admin_jobick.multiple_estimate.add',compact('users','services','pro'));
    }

    public function createMultipleEstimatePost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // 'service_id'=>'required',
            'phone_no'=>'required|max:15|min:10',
            // 'description'=>'required|max:1000',
            // 'amount' => 'required',
            'title' => 'required|max:240'
        ]);
         if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
		$user_address = $request->address.','.$request->locality.','.$request->city.','.$request->state.','.$request->pin_code;

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $pin = mt_rand(1000, 9999)
            . $characters[rand(0, strlen($characters) - 2)]
            . mt_rand(10, 99);

        $string = str_shuffle($pin);
        $booking = 'OD-'.$string;

        $title = $request->title;


        $count_service = count($request->service_id)-1;
        $count_amount = count($request->amount)-1;
        $count_reg_amount = count($request->reg_amount)-1;
        $count_description = count($request->description)-1;

        // echo $count_service;
        // echo $count_amount;
        // echo $count_reg_amount;
        // echo $count_description;

        // if($count_service >= 0)
        // {dd('EMPTY');}
        // else
        // {dd('NOT EMPTY');}
        // echo $count_service;
        // $myStr1 = $request->service_id[];
        // if(strlen($myStr1)!=0)
        // {
        if($count_service==$count_amount&&$count_service==$count_reg_amount&&$count_service==$count_description)
        {
            $data = new MultipleEstimate();

            $data->user_id = '1';
            $data->title = $title;
            $data->pdf_file = 'none';
            $data->home_type = '0';
            $data->name = $request->user_id;
            $data->email = $request->email;
            $data->address = $user_address;
            $data->area = $request->area;
            $data->locality = $request->locality;
            $data->city = $request->city;
            $data->state = $request->state ?? 'NA';
            $data->pincode = $request->pin_code ?? 'NA';
            $data->phone_no = $request->phone_no;
            $data->time_constraints = 'NA';
            $data->booking_status = '0';
            $data->payment_status = '0';
            $data->booking_show_id = $booking;
            $data->date=NULL;
            if($request->user_data_id)
            {
             $data->user_data_id = $request->user_data_id;  
            }

            $data->save();


            $e_id = $data->id;

            for($s=0; $s < $count_service; $s++)
            {
                $s_data = new MultipleEstimateServices();
                $s_data->estimate_id = $e_id;
                $s_data->service_id = $request->service_id[$s];

                for($a=0; $a < $count_amount; $a++)
                {
                    $s_data->amount = $request->amount[$s];
                }

                for($r=0; $r < $count_reg_amount; $r++)
                {
                    $s_data->reg_amount = $request->reg_amount[$s];
                }

                for($d=0; $d < $count_description; $d++)
                {
                    $s_data->description = $request->description[$s];
                }

                $s_data->save();
            }
        }
        else{
            return redirect()->back()->with('error','Something went wrong!');
        }

        $to = $email;
        $subject = 'Meinhaus Booking '.$booking;

        $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' type='text/css' href='https://meinhaus.ca/public/theme/css/font-awesome.css' />




</head>
<style>
    .fa:hover {
        transition: 0.5s;
        color: white !important;
    }
</style>

<body style='background-color: #F0F3F7;margin: 0;'>
    <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
        <div style='width: 100%; background-color: white;' class='container'>
            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt=''
                    width='217px' height='70px'></h1>
            <h1 style='text-align: center;'>$title</h1>
            <hr>
            <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
            </p>
            <br>
            <h1 style='text-align: center;'>
                <a href='http://beautyliciousnj.com/meinhause/multiple-booking-invoice/$e_id'><button
                        style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View
                        Estimate Online</button></a>
            </h1>
            <br>
            <center><img src='https://meinhaus.ca/public/image/visa-option.jpg' alt=''></center>
            <div style='text-align: center;'>
                <img src='https://www.meinhaus.ca/public/image/5a90312d7f96951c82922878.png' width='280px'
                    height='60px'>
                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


            </div>

            <div style='margin-top:20px;background-color: #182434;'>
                <div class='' style='align-content: center;display: flex;padding: 10px 50px;'>
                    <div style='margin-right: auto;'>
                        <h2 class='text' style='color: #fff; font-family:sans-serif;text-align: center;'>Contact Us
                        </h2>
                        <div style='justify-content: center;display: flex;'>
                            <div>
                                <p style='margin: 0px;color: #fff;font-family:sans-serif'><strong>Email :</strong>
                                    info@meinhaus.ca</p>
                            </div>
                        </div>
                    </div>

                    <div style='margin-inline: auto;'>
                        <div style='text-align: center;'>
                            <h2 class='text' style='color: #fff;font-family:sans-serif'>Follow Us On:</h2>
                            <a href='https://www.facebook.com/meinhausservices' style='color: #a8a7a7; text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/facebook.png'>
                            </a>
                            <a href='https://www.linkedin.com/company/mein-haus-services'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/linkedin.png'>
                            </a>
                            <a href='https://www.instagram.com/meinhausapp/?utm_medium=copy_link'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/instagram.png'>   
                                    
                            </a>
                            <a href='https://www.pinterest.com/meinhausservices/'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/pinterest.png'>
                                </a>
                        </div>
                    </div>
                    <div style='text-align: center;margin-left: auto;'>
                        <h2 class='text' style='color: #fff;font-family:sans-serif'>Download the app</h2>
                        <a href='https://apps.apple.com/ca/app/mein-haus-professional/id1556987330' style='text-decoration: none;'>
                            <img src='http://meinhaus.ca/public/image/app.png' width='121px' height='52px'>
                        </a>
                        <a href='https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US'
                            style='margin-left:10px'>
                            <img src='http://meinhaus.ca/public/image/googleplay.png' width='121px' height='52px'></i>
                        </a>
                    </div>
                </div>
                <hr style='padding: 0;margin:0'>
                <div class='' style='color: #a8a7a7;text-align: center;margin-top:5px;margin-bottom:5px;'>
                    <div style='text-align: center;'>
                        <div style='text-align: center;'>Developed By <span style='color: white;'>QuantumIT</span></div>
                        <div style='margin-top: 5px;text-align: center;'>Copyright © 2020 <span style='color: white;'>MeinHaus.</span> All
                            rights reserved. </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>";

        if(mail($to, $subject, $message, $headers)){
            $to2 = "info@meinhaus.ca";
            $subject2 = 'Meinhaus Booking '.$booking;

            $headers2 = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
            $headers2 .= "MIME-Version: 1.0\r\n";
            $headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $message2 = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' type='text/css' href='https://meinhaus.ca/public/theme/css/font-awesome.css' />




</head>
<style>
    .fa:hover {
        transition: 0.5s;
        color: white !important;
    }
</style>

<body style='background-color: #F0F3F7;margin: 0;'>
    <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
        <div style='width: 100%; background-color: white;' class='container'>
            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt=''
                    width='217px' height='70px'></h1>
            <h1 style='text-align: center;'>$title</h1>
            <hr>
            <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
            </p>
            <br>
            <h1 style='text-align: center;'>
                <a href='http://beautyliciousnj.com/meinhause/multiple-booking-invoice/$e_id'><button
                        style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View
                        Estimate Online</button></a>
            </h1>
            <br>
            <center><img src='https://meinhaus.ca/public/image/visa-option.jpg' alt=''></center>
            <div style='text-align: center;'>
                <img src='https://www.meinhaus.ca/public/image/5a90312d7f96951c82922878.png' width='280px'
                    height='60px'>
                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


            </div>

            <div style='margin-top:20px;background-color: #182434;'>
                <div class='' style='align-content: center;display: flex;padding: 10px 50px;'>
                    <div style='margin-right: auto;'>
                        <h2 class='text' style='color: #fff; font-family:sans-serif;text-align: center;'>Contact Us
                        </h2>
                        <div style='justify-content: center;display: flex;'>
                            <div>
                                <p style='margin: 0px;color: #fff;font-family:sans-serif'><strong>Email :</strong>
                                    info@meinhaus.ca</p>
                            </div>
                        </div>
                    </div>

                    <div style='margin-inline: auto;'>
                        <div style='text-align: center;'>
                            <h2 class='text' style='color: #fff;font-family:sans-serif'>Follow Us On:</h2>
                            <a href='https://www.facebook.com/meinhausservices' style='color: #a8a7a7; text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/facebook.png'>
                            </a>
                            <a href='https://www.linkedin.com/company/mein-haus-services'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/linkedin.png'>
                            </a>
                            <a href='https://www.instagram.com/meinhausapp/?utm_medium=copy_link'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/instagram.png'>   
                                    
                            </a>
                            <a href='https://www.pinterest.com/meinhausservices/'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/pinterest.png'>
                                </a>
                        </div>
                    </div>
                    <div style='text-align: center;margin-left: auto;'>
                        <h2 class='text' style='color: #fff;font-family:sans-serif'>Download the app</h2>
                        <a href='https://apps.apple.com/ca/app/mein-haus-professional/id1556987330' style='text-decoration: none;'>
                            <img src='http://meinhaus.ca/public/image/app.png' width='121px' height='52px'>
                        </a>
                        <a href='https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US'
                            style='margin-left:10px'>
                            <img src='http://meinhaus.ca/public/image/googleplay.png' width='121px' height='52px'></i>
                        </a>
                    </div>
                </div>
                <hr style='padding: 0;margin:0'>
                <div class='' style='color: #a8a7a7;text-align: center;margin-top:5px;margin-bottom:5px;'>
                    <div style='text-align: center;'>
                        <div style='text-align: center;'>Developed By <span style='color: white;'>QuantumIT</span></div>
                        <div style='margin-top: 5px;text-align: center;'>Copyright © 2020 <span style='color: white;'>MeinHaus.</span> All
                            rights reserved. </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>";
            mail($to2, $subject2, $message2, $headers2);
            if($request->user_data_id)
            {
                DB::table('user_data')->where('id',$request->user_data_id)->update(['est_status'=>'1']);
            }
            return redirect('admin/estimate/listing')->with('success','Successfully Inserted!');
        }else{
            echo "Mail Not Send";
        }

        // return redirect('admin/multiple-estimate')->with('success','Successfully Inserted!');


    }


    public function servicesView($id)
    {
        $m_est = MultipleEstimate::leftjoin('estimate_booking_transaction', 'multiple_estimate.booking_show_id', "=", 'estimate_booking_transaction.booking_id')
                ->where('multiple_estimate.id', $id)->get();
                //dd($id);

        $ms_filter = MultipleEstimateServices::where('estimate_id',$id)->get();
        $mst_id=$id;
        // echo $id;
        return view('admin_jobick.multiple_estimate.servicesView', compact('m_est','ms_filter','mst_id'));
    }
     public function servicesEmailView($id,$booking_id)
    {
       
        $data = MultipleEstimateServices::where('id',$id)->first();
        $bookingId = $booking_id;
      
        return view('admin_jobick.multiple_estimate.Pro_send_Email',compact('data'));
    }
    
    public function Send_Pro_Email(request $req)
    {
        //dd($req->all());


        $validator = Validator::make($req->all(),[
            'service'=>'required',
            'area'=>'required|max:200',
            'amount'=>'required',
            'sdate'=>'required',
            'desc'=>'required',
            //'notes'=>'max:200',
            //'attachment'=>'required'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)
                            ->withInput();
        }else{
            //dd($req->all());
          $estimate=MultipleEstimate::find($req->estimate_id);
          $service_detail=MultipleEstimateServices::find($req->id);
       
           $estimate->address=$req->area;
          
           
           if($req->img1)
           {
                $img1 = time().'img1'.'.'.$req->img1->extension();
                $req->img1->move(public_path('/estimate_image'),$img1);
                $estimate->img1=$img1;
           }
           
           if($req->img2)
           {
                $img2 = time().'img2'.'.'.$req->img2->extension();
                $req->img2->move(public_path('/estimate_image'),$img2);
                $estimate->img2=$img2;
           }
           
           if($req->img3)
           {
                $img3 = time().'img3'.'.'.$req->img3->extension();
                $req->img3->move(public_path('/estimate_image'),$img3);
                $estimate->img3=$img3;
           }
           
           if($req->img4)
           {
                $img4 = time().'img4'.'.'.$req->img4->extension();
                $req->img4->move(public_path('/estimate_image'),$img4);
                $estimate->img4=$img4;
           }
           
           if($req->img5)
           {
                $img5 = time().'img5'.'.'.$req->img5->extension();
                $req->img5->move(public_path('/estimate_image'),$img5);
                $estimate->img5=$img5;
           }
           
           $estimate->save();
           
           $service_detail->pro_trade_amount=$req->amount;
           $service_detail->service_id=$req->service;
           $service_detail->description=$req->desc;
           $service_detail->date=date("d-m-Y", strtotime($req->sdate));
           $service_detail->save();
           
           if ($req->action == "Update") {
            return back()->with('success','Data Updated Successfully!');
            exit();
               }
               else{

           $service=$service_detail->service_id;
           $service_det=Service::where('id',$service)->first();
           $proff_id=Pro_data_service::where('service_id',$service)->pluck('pro_data_id');
           $service_name=$service_det->name;
           $proffs=[];
           foreach ($proff_id as $key => $value) {
            $data=Pro_data::find($value);
            array_push($proffs,$data->email);
           }       
          //DB::table('multiple_estimate')->where('booking_show_id', );
          
          $subject = 'Meinhaus Project Details';

          $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

           $message=
           
           "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' type='text/css' href='https://meinhaus.ca/public/theme/css/font-awesome.css' />




</head>
<style>
    .fa:hover {
        transition: 0.5s;
        color: white !important;
    }
</style>

<body style='background-color: #F0F3F7;margin: 0;'>
    <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
        <div style='width: 100%; background-color: white;' class='container'>
            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt=''
                    width='217px' height='70px'></h1>
            <h1 style='text-align: center;'>View Project</h1>
            <hr>
            <p style='text-align: center; font-size: 17px;'>You’ve received this link because we have deemed you an eligible contractor to join our Qualified Contractor Network.
            </p>
            <br>
            <h1 style='text-align: center;'>
                <a href='http://beautyliciousnj.com/meinhause/view/estimate/$req->estimate_id/$req->id'><button
                        style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View Project</button></a>
            </h1>
            <br>
            <center><img src='https://meinhaus.ca/public/image/visa-option.jpg' alt=''></center>
            <div style='text-align: center;'>
                <img src='https://www.meinhaus.ca/public/image/5a90312d7f96951c82922878.png' width='280px'
                    height='60px'>
                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>


            </div>

            <div style='margin-top:20px;background-color: #182434;'>
                <div class='' style='align-content: center;display: flex;padding: 10px 50px;'>
                    <div style='margin-right: auto;'>
                        <h2 class='text' style='color: #fff; font-family:sans-serif;text-align: center;'>Contact Us
                        </h2>
                        <div style='justify-content: center;display: flex;'>
                            <div>
                                <p style='margin: 0px;color: #fff;font-family:sans-serif'><strong>Email :</strong>
                                    info@meinhaus.ca</p>
                            </div>
                        </div>
                    </div>

                    <div style='margin-inline: auto;'>
                        <div style='text-align: center;'>
                            <h2 class='text' style='color: #fff;font-family:sans-serif'>Follow Us On:</h2>
                            <a href='https://www.facebook.com/meinhausservices' style='color: #a8a7a7; text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/facebook.png'>
                            </a>
                            <a href='https://www.linkedin.com/company/mein-haus-services'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/linkedin.png'>
                            </a>
                            <a href='https://www.instagram.com/meinhausapp/?utm_medium=copy_link'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/instagram.png'>   
                                    
                            </a>
                            <a href='https://www.pinterest.com/meinhausservices/'
                                style='color: #a8a7a7;margin-left:10px;text-decoration: none;' target='_blank'>
                                <img src='https://www.meinhaus.ca/public/theme/images/pinterest.png'>
                                </a>
                        </div>
                    </div>
                    <div style='text-align: center;margin-left: auto;'>
                        <h2 class='text' style='color: #fff;font-family:sans-serif'>Download the app</h2>
                        <a href='https://apps.apple.com/ca/app/mein-haus-professional/id1556987330' style='text-decoration: none;'>
                            <img src='http://meinhaus.ca/public/image/app.png' width='121px' height='52px'>
                        </a>
                        <a href='https://play.google.com/store/apps/details?id=com.quantum.meinhauspro&hl=en_IE&gl=US'
                            style='margin-left:10px'>
                            <img src='http://meinhaus.ca/public/image/googleplay.png' width='121px' height='52px'></i>
                        </a>
                    </div>
                </div>
                <hr style='padding: 0;margin:0'>
                <div class='' style='color: #a8a7a7;text-align: center;margin-top:5px;margin-bottom:5px;'>
                    <div style='text-align: center;'>
                        <div style='text-align: center;'>Developed By <span style='color: white;'>QuantumIT</span></div>
                        <div style='margin-top: 5px;text-align: center;'>Copyright © 2020 <span style='color: white;'>MeinHaus.</span> All
                            rights reserved. </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>";


           foreach ($proffs as $key => $value) {
            mail($value, $subject, $message, $headers);
           }

           return back()->with('success','Email sent Successfully!');
        }
        
        }
    
    }
    
    public function ViewProEstimate($id,$service_id)
    {
        $estimate=MultipleEstimate::find($id);
        $service_detail=MultipleEstimateServices::find($service_id); 

        $service=$service_detail->service_id;
        $service_det=Service::where('id',$service)->first();
       
        $service_name=$service_det->name;
        $service_id=$service_det->id;
        //dd($estimate,$service_detail);

        return view('admin_jobick.multiple_estimate.ProEstimate',compact('estimate','service_detail','service_name','service_id'));
    }
    
    public function purchaseJobPaymentPost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51LZVObSBB4uLDn3sFj43roZDWAj371TPe0Ire3ozHXO3RufssVvutA41Y0iEi3dMPciJc3EZ9Tyky1GHpisyv77p00cm7P2mvb');
            try{
                Stripe\PaymentIntent::create ([
                    "amount" => 100*$request->pro_trade_amount,
                    "currency" => "CAD",
                    // "source" => $request->stripeToken,
                    'payment_method_types' => ['card'],
                    "description" => $request->email.' '.'has made payment for job'
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

            $user_id = $request->email;
            $s_detail = DB::table('services')->where('id',$request->service_id)->first();
            $pd_detail = DB::table('pro_data_services')->where('service_id',$s_detail->id)->first();
            $details = DB::table('pro_data')->where('email',$user_id)->first();
            $book_id = DB::table('multiple_estimate')->where('id',$request->estimate_id)->first();
            if(isset($details)){

                $transaction = new UserTransaction();
                $transaction->user_id = $details->id;
                $transaction->booking_id = $book_id->id;
                $transaction->transaction_id = 'MH-'.uniqid();
                $transaction->amount = $request->pro_trade_amount;
                $transaction->save();

                DB::table('trader_purchased_job')->insert([
                    'estimate_id' => $request->estimate_id,
                    'service_id' => $request->service_id,
                    'pur_amount' => $request->pro_trade_amount,
                ]);
                
                $es_id = DB::table('multiple_estimate')->where('id',$request->estimate_id)->first();
                $es_ser_id = DB::table('multiple_estimate_services')->where('estimate_id',$request->estimate_id)->first();
                
                $user_check = DB::table('users')->where('email',$user_id)->first();
                if($user_check == null)
                {
                    $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
                    $password = substr($random, 0, 10);
                    $user = new User();
                    $user->name = $details->name;
                    $user->email = $details->email;
                    $user->phone = $details->phone;
                    $user->role_id = 3;
                    $user->password = Hash::make($password);
                    $user->state = 1;
                    $user->status = 1;
                    $user->is_listed = 1;
                    $user->is_payment = 1;
                    $user->notification_status = 1;
                    $user->save();
                    
                    $insert = DB::table('multiple_estimate_professionals')->insert(array(
                        'pro_id'=>$user->id,
                        'mest_service_id'=>$es_ser_id->id,
                        'estimate_booking_id'=>$es_id->booking_show_id,
                        'pro_amount'=>$request->pro_trade_amount,
                        // 'notes'=>$request->notes,
                        'assign_date'=>date("d-m-Y", strtotime($es_ser_id->date)),
                        // 'attachment'=>$filename,
                        // 'address'=>$request->address,
                        // 'city'=>$request->city,
                        // 'province'=>$request->province,
                        // 'postal_code'=>$request->postal_code,
                        'status'=>1,
                        'assign_status'=>1
                    ));
                    
                    $to = $details->email;
                    $subject = 'Meinhaus Professional Account Credentials';

                    $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
                    $message=
           
                       "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Invoice</title>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
                        </head>
                        <body style='background-color: #F0F3F7;'>
                        <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
                        <div style='width: 100%; background-color: white; padding-bottom: 20px;' class='container'>
                            <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt='' width='217px' height='70px'></h1>
                            <h1 style='text-align: center;'>Account Credentials</h1>
                            <hr>
                            <p style='text-align: center; font-size: 18px;'>This is your account credentials, you can access your professional dashboard by entering these details.</p>
                            <p style='text-align: center; font-size: 15px;'><b>Email:</b> $details->email</p>
                            <p style='text-align: center; font-size: 15px;'><b>Password:</b> $password</p>
                            <br>
                            <div style='text-align: center;'>
                                <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                                <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>
                    
                    
                            </div>
                            </div>
                            </div>    
                        </body>
                        </html>
                    ";
                    mail($to, $subject, $message, $headers); 
                }
                
                else
                {
                    $insert = DB::table('multiple_estimate_professionals')->insert(array(
                        'pro_id'=>$user_check->id,
                        'mest_service_id'=>$es_ser_id->id,
                        'estimate_booking_id'=>$es_id->booking_show_id,
                        'pro_amount'=>$request->pro_trade_amount,
                        // 'notes'=>$request->notes,
                        'assign_date'=>date("d-m-Y", strtotime($es_ser_id->date)),
                        // 'attachment'=>$filename,
                        // 'address'=>$request->address,
                        // 'city'=>$request->city,
                        // 'province'=>$request->province,
                        // 'postal_code'=>$request->postal_code,
                        'status'=>1,
                        'assign_status'=>1
                    ));
                }

                return redirect(url("pro-login"))->with('job_pay_suc','Payment Successful! Check Your Email For Account Credentials!');
                // return view('admin_jobick.multiple_estimate.transactionSuccess');
                // return redirect(url("payment-success/$request->booking_id"));
                // return \Response::json(['response_code' => 200,'response_message' => 'Transaction completed','is_payment' => '1'], 200);

            }else{

                return \Response::json(['response_code' => 400,'response_message' => 'Unable to do payment.','is_payment' => '0'], 200);
            }
    }
    
    public function assignService($id,$booking_id)
    {
        $data = MultipleEstimateServices::where('id',$id)->get();
        $bookingId = $booking_id;
        return view('admin_jobick.multiple_estimate.proPrice', compact('data','bookingId'));
    }

    public function assignServicePost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'booking_id'=>'required',
            'professional'=>'required|max:200',
            'customamount'=>'required',
            'sdate'=>'required',
            'notes'=>'max:200',
            'attachment'=>'required'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)
                            ->withInput();
        }else{
            $filename = $request->file('attachment')->getClientOriginalName();
            $insert = DB::table('multiple_estimate_professionals')->insert(array(
                'pro_id'=>$request->professional,
                'mest_service_id'=>$request->mest_service_id,
                'estimate_booking_id'=>$request->booking_id,
                'pro_amount'=>$request->customamount,
                'notes'=>$request->notes,
                'assign_date'=>date("d-m-Y", strtotime($request->sdate)),
                'attachment'=>$filename,
                'address'=>$request->address,
                'city'=>$request->city,
                'province'=>$request->province,
                'postal_code'=>$request->postal_code,
                'status'=>1
            ));
            if($insert){

                $pro_email = DB::table('users')->where('id', $request->professional)->get(array('email'));
                $email = $pro_email[0]->email;

                $attach = $filename;
                $request->attachment->move(public_path('attachment'),$attach);

                // $request->file('attachment')->storeAs('public/attachment', $filename);
                // return redirect(url("https://quantumits.online/emailtemplate/proEmail2/$email"));

                $to = $email;
                $subject = "Assigned Project Successfully | MeinHaus";
                $msg = "Congratulation, You have been assigned project from MeinHaus successfully."."<br><br><br><center><img src='https://www.meinhaus.ca/public/image/logo-img.png' width='280px' height='60px'></center>";
                $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($to, $subject, $msg, $headers);

                $estimate_id = DB::table('multiple_estimate')->where('booking_show_id',$request->booking_id)->first();
                return redirect('admin/services-view/'.$estimate_id->id)->with('success','Successfully Assigned!');
            }else{
                return redirect()->back()->with('msg', 'Something Gone Wrong .');
            }
        }
    }

    public function multipleEstimateBidding($service_id,$booking_id)
    {
        $data = DB::table('multiple_estimate_services')->where('id', $service_id)->get();
        $booking_id = $booking_id;
        return view('admin_jobick.multiple_estimate.bidding', compact('data','booking_id'));
    }

    public function multipleBiddingPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'booking_id'=>'required',
            'customamount'=>'required',
            'sdate'=>'required',
            'notes'=>'max:200',
            'locality'=>'required|max:200',
            'professional'=>'required',
            // 'attachment'=>'required'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $countpro = count($request->professional);
        for($p=0; $p < $countpro; $p++)
        {
            $data = new MultipleEstimateBid();
            $data->booking_id = $request->booking_id;
            $data->mest_service_id = $request->mest_service_id;
            $data->proff_id = $request->professional[$p];
            $data->pro_amount = $request->customamount;
            $data->start_date = date("d-m-Y", strtotime($request->sdate));
            $data->notes = $request->notes;
            $data->locality = $request->locality;
            $data->save();
        }

        if($request->attachment)
        {
            $files = $request->file('attachment');
            $filesCollection = collect([]);
            foreach ($files as $file) {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('multiple_bid_attachment'), $name);
                $filesCollection->push($name);
            }
            $b_id = $request->booking_id;
            $s_id = $request->mest_service_id;
            $count = count($filesCollection);
            for($i=0; $i < $count; $i++)
            {
                DB::table('multiple_estimate_bidding_images')->insert(array(
                'estimate_booking_id'=>$b_id,
                'mest_service_id'=>$s_id,
                'image'=>$filesCollection[$i]
            ));
            }
        }

        $estimate_id = DB::table('multiple_estimate')->where('booking_show_id',$request->booking_id)->first();
        return redirect('admin/services-view/'.$estimate_id->id)->with('success','Successfully Inserted!');
    }
    
    public function view_service_details($id){
        $service_id = $id;
        return view('admin_jobick.multiple_estimate.service_details', compact('service_id'));
    }
    
    public function confirmMestStatus_sales($id){
        $update = DB::table('multiple_estimate_professionals')->where('id', $id)->update(array(
            'status'=>1
        ));
        return redirect()->back()->with('success','Successfully Confirmed!');
    }
    
    public function rejectMestStatus_sales($id){
        $get_details = DB::table('multiple_estimate_professionals')->where('id', $id)->first();
        
        DB::table('multiple_estimates_bidding')->where('mest_service_id',$get_details->mest_service_id)->update(array(
          'accept_status'=>0,
           'assign_status'=>0 
        ));
        DB::table('multiple_estimates_bidding')->where('mest_service_id',$get_details->mest_service_id)->where('proff_id',$get_details->pro_id)->update(array(
            'accept_status' =>1
        ));
        $delete = DB::table('multiple_estimate_professionals')->where('id', $id)->delete();
        return redirect()->back()->with('error','Rejected!');
    }
    
    public function acceptMestEstimateBidPost($id)
    {
        $get_pro = DB::table('multiple_estimates_bidding')->where('id',$id)->first();
        DB::table('multiple_estimates_bidding')->where('id','!=',$id)->where('mest_service_id',$get_pro->mest_service_id)->update(array(
            'accept_status'=>3, //reject others
            'assign_status'=>2 //reject others
        ));
        DB::table('multiple_estimates_bidding')->where('id',$id)->update(array(
           'accept_status'=>2,
           'assign_status'=>1 //accept
        ));
        
        // o for pending => accept_status
        // 1 for submitted => accept_status
        // 2 for accepted => accept_status 
        // 3 for rejected => accept_status
        
        // 1 for assigned => assign_status
        // 2 for rejected => assign_status
        
        DB::table('multiple_estimate_professionals')->insert(array(
            'pro_id'=>$get_pro->proff_id,
            'mest_service_id'=>$get_pro->mest_service_id,
            'estimate_booking_id'=>$get_pro->booking_id,
            'pro_amount'=>$get_pro->pro_amount,
            'notes'=>$get_pro->notes,
            'assign_date'=>date("d-m-Y", strtotime($get_pro->start_date)),
            'status'=>1,
            'assign_status'=>1
        ));
        

        return redirect()->back()->with('success','Bid Accepted!');
    }
    
    public function rejectMestEstimateBidPost($id)
    {
        $get_pro = DB::table('multiple_estimates_bidding')->where('id',$id)->first();
        DB::table('multiple_estimates_bidding')->where('id',$id)->update(array(
           'accept_status'=>3
        ));
        return redirect()->back()->with('error','Bid Rejected!');
    }
    
    public function multiple_booking_invoice($BookingId)
    {
        $data['bookingId'] =  $BookingId;
		return view('email_template.email_template_mest',$data);
    }
    
    public function payingStatus(Request $request)
    {
        $id = $request->s_id;
        $check = DB::table('multiple_estimate_services')->where('id',$id)->first();
        if($check->paying_status==1)
        {
            DB::table('multiple_estimate_services')->where('id',$id)->update(['paying_status'=>0]);
        }
        elseif($check->paying_status==0)
        {
            DB::table('multiple_estimate_services')->where('id',$id)->update(['paying_status'=>1]);
        }


        return response()->json(['success'=>"successfully removed!",'code'=>200]);
    }
    
    public function mest_pay($id)
    {
		$data['bookingId'] = $id;
		return view('email_template.pay_mest_invoice',$data);
	}
    
    
    public function mest_pay_post($BookingId,Request $request)
	{
	    $result = DB::table('multiple_estimate')->where('booking_show_id',$BookingId)->get();

    	$estmate_email = $result[0]->email;
    	$customer = $result[0]->name;

        Stripe\Stripe::setApiKey('sk_test_51LZVObSBB4uLDn3sFj43roZDWAj371TPe0Ire3ozHXO3RufssVvutA41Y0iEi3dMPciJc3EZ9Tyky1GHpisyv77p00cm7P2mvb');
        try{
            Stripe\PaymentIntent::create ([
                "amount" => 100*$request->reg_amount,
                "currency" => "CAD",
                // "source" => $request->stripeToken,
                'payment_method_types' => ['card'],
                "description" => $result[0]->name.' '.'has made payment for estimate purpose'
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

        DB::table('multiple_estimate')->where('booking_show_id',$BookingId)->update(
		array('payment_status'=>'1'));

        $restAmount = DB::table('multiple_estimate')->where('booking_show_id', $BookingId)->get(array('id','reg_amount_tax'));
        $cal_amount = DB::table('multiple_estimate_services')->where('estimate_id',$restAmount[0]->id)->sum('amount');

    	DB::table('estimate_booking_transaction')->insert(array(
    	    'booking_id'=>$BookingId,
    	    'transaction_id'=> 'MH-'.uniqid(),
    	    'amount'=>$request->reg_amount
    	));

		return redirect(url("multipleinvoicetransactionSuccessfull/$BookingId"));


	}

    public function estimate_invoice($BookingId){
        return view('email_template.multipleInvoiceReceipt', compact('BookingId'));
    }
    
    
    public function admin_multiple_multiple_invoice($id,$booking_id)
    {
        $data = DB::table('multiple_estimate')->where('id', $id)->get();
        $inv = DB::table('multiple_estimate_invoices')->where('booking_id', $booking_id)->orderBy('id','DESC')->get();
        return view('admin_jobick.multiple_estimate.invoice-view', compact('data','inv'));
    }
    
    public function admin_create_multiple_multiple_invoice($id)
    {
        $data = MultipleEstimate::where('id', $id)->get();
     
        $ms_filter = MultipleEstimateServices::where('estimate_id',$id)->get();
        $services = Service::where('status',1)->get();
        $est_id=$data[0]->booking_show_id;
      
        return view('admin_jobick.multiple_estimate.invoice', compact('data','ms_filter','services','id','est_id'));
    }
    
    
    public function admin_create_multiple_multiple_invoice_post(Request $request)
    {
        $insert = DB::table('multiple_estimate_invoices')->insert(array(
            'booking_id'=>$request->booking_id,
            'title'=>$request->est_title,
            'note'=>$request->note,
            'payment_status'=>0,
        ));
        $id = DB::getPdo()->lastInsertId();
        // dd($id);
        $email = $request->email;
        $booking = $request->booking_id;
        $e_id = $request->e_id;
        $title = $request->est_title;
        
        $count_child = count($request->child_id)-1;
        $count_service = count($request->service_id)-1;
        $count_amount = count($request->amount)-1;
        $count_reg_amount = count($request->reg_amount)-1;
        $count_invoice_amount = count($request->invoice_amount)-1;
        $count_description = count($request->description)-1;
        
        
        foreach($request->child_id as $c => $c_id)
        {
            DB::table('multiple_estimate_invoices_details')->insert([
                'invoice_id' => $id,
                'booking_id'=>$request->inv_booking_id[$c],
                'service' => $request->service_id[$c],
                'description' => $request->description[$c],
                'pre_amount' => $request->reg_amount[$c],
                'total_amount' => $request->amount[$c],
                'invoice_amount' => $request->invoice_amount[$c],
            ]);
        }
        
        $email = $request->email;
        $booking = $request->booking_id;
        $title = $request->est_title;
        
        $to = $email;
        $subject = 'Meinhaus Booking '.$booking;

        $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        $message = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Invoice</title>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
            </head>
            <body style='background-color: #F0F3F7;'>
                <div style='display: flex; justify-content: center; background-color: #F0F3F7;'>
                <div style='width: 100%; background-color: white; padding-bottom: 20px;' class='container'>
                    <h1 style='text-align: center;'><img src='https://meinhaus.ca/public/image/logo-img.png' alt='' width='217px' height='70px'></h1>
                    <h1 style='text-align: center;'>$title</h1>
                    <hr>
                    
                    <p style='text-align: center; font-size: 17px;'>Here is your meinhaus project invoice.</p>
                    <br>
                    <div style='text-align: center;'>
                        <h1 style='text-align: center;'>
                            <a href='http://beautyliciousnj.com/meinhause/multiple-estimate-invoice-view-online/$id/$booking'><button style='width: 26%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white'>View Invoice Online</button></a>
                        </h1>
                        <br>
                        <p style='margin-bottom: -1px;'>Phone: 1(844)777-4287</p>
                        <a style='text-decoration: none;' href='https://www.meinhaus.ca/'>www.meinhaus.ca</a>
            
            
                    </div>
                </div>
                </div>    
            </body>
            </html>";
        
        
        if(mail($to, $subject, $message, $headers)){
    	    return redirect(url("admin/multiple-estimate-invoice-view/$e_id/$booking"))->with('success','Sent Successfully!');
        }else{
        	echo "Mail Not Send";
        }
        
        // return redirect('admin/multiple-estimate')->with('success','Successfully Updated!');
    }
    
    public function admin_multiple_multiple_invoice_online($id,$booking_id)
    {
        $booking_id = $booking_id;
        $invoice_id = $id;
        $note_var = DB::table('multiple_estimate_invoices')->where('id',$id)->first();
        $notes = $note_var->note;
        $id = MultipleEstimate::where('booking_show_id', $booking_id)->first();
        $data = MultipleEstimate::where('id', $id->id)->get();
        $ms_filter = MultipleEstimateServices::where('estimate_id',$id->id)->get();
        $services = Service::where('status',1)->get();
        return view('admin_jobick.multiple_estimate.invoice-view-online',compact('booking_id','data','ms_filter','services','invoice_id','id','notes'));
    }
    
    
    public function admin_multiple_multiple_invoice_online_payment_post(Request $request,$id,$booking_id)
    {
        $result = DB::table('multiple_estimate')->where('booking_show_id',$booking_id)->get();
	
    	$estmate_email = $result[0]->email;
    	$customer = $result[0]->name;
    	
    
        Stripe\Stripe::setApiKey('sk_test_51LZVObSBB4uLDn3sFj43roZDWAj371TPe0Ire3ozHXO3RufssVvutA41Y0iEi3dMPciJc3EZ9Tyky1GHpisyv77p00cm7P2mvb');
        try{
            Stripe\PaymentIntent::create ([
                "amount" => 100*$request->amount,
                "currency" => "CAD",
                // "source" => $request->stripeToken,
                'payment_method_types' => ['card'],
                "description" => $result[0]->name.' '.'has made payment for invoice purpose'
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
    
        DB::table('multiple_estimate_invoices')->where('id',$id)->update(
        		array('payment_status'=>'1'));
    
        DB::table('multiple_estimate_invoices_details')->where('invoice_id',$id)->update(
        		array('payment_status'=>'1'));
    		
        // $restAmount = DB::table('estimates')->where('booking_show_id', $BookingId)->get(array('amount', 'reg_amount_tax'));
    		
    	DB::table('estimate_booking_transaction')->insert(array(
    	    'booking_id'=>$booking_id,
    	    'transaction_id'=> 'MH-'.uniqid(),
    	    'amount'=>$request->amount
    	));
    		
		return redirect()->route('invoiceTransactionSuccessfull', compact('id','booking_id'));
    }
    
    public function invoiceReceipt($id,$booking_id){
        $booking_id = $booking_id;
        $invoice_id = $id;
        $id = MultipleEstimate::where('booking_show_id', $booking_id)->first();
        $data = MultipleEstimate::where('id', $id->id)->get();
        $ms_filter = MultipleEstimateServices::where('estimate_id',$id->id)->get();
        $services = Service::where('status',1)->get();
        return view('invoiceReceipt', compact('booking_id','data','ms_filter','services','invoice_id'));
    }


    // end of multiple estimate
    
    
    
    // start of pro data

    public function proData()
    {
        $data['proData'] = Pro_data::with(['services'])->orderby('id','desc')->get();
        return view('admin_jobick.pro_landing.proData',$data);
    }
    public function ProDataDetails($id)
    {
        $data['proData'] =  Pro_data::with(['services'])->where('id',$id)->first();  
        return view('admin_jobick.pro_landing.proDataDetail',$data); 
    }

    public function ProDataDelete($id)
    {
        $data=Pro_data::find($id);
        $data->delete();
        $data->services()->detach();
        return back()->with('success','Data Deleted Successfully!');
    }

    //start of user data

    public function userData()
    {
        $data['userData'] = User_data::with(['services'])->orderby('id','desc')->get();
        return view('admin_jobick.user_landing.userData',$data);
    }

    public function userDataDetails($id)
    {
         $data['userData'] =  User_data::with(['services'])->where('id',$id)->first();
 
        $data['ProjectDetails']=User_data_projectDetail::where('user_data_id',$id)->first();

        $data['Images']=User_data_image::where('user_data_id',$id)->pluck('image');
       
        
        $users = User::where('role_id',2)->where('status',1)->get();
        $pro = User::where('role_id',3)->where('status',1)->where('is_listed',1)->get();
        $services = Service::where('status',1)->get();
        
        return view('admin_jobick.user_landing.userDataDetail',$data,compact('services'));
    }

    public function userDataDelete($id)
    {
        $data=User_data::find($id);
        $data->delete();
        $data->services()->detach();
        return back()->with('success','Data Deleted Successfully!');
    }
    
    public function jobPhoto()
    {
        return view('admin_jobick.multiple_estimate.job_photos');
    }
    
    public function siteImgNumber(Request $request)
    {
        $booking_id = $request->booking_id;
        $service_id = $request->service_id;
        $requirementDetails = array($request->site_img_details1,$request->site_img_details2,$request->site_img_details3,$request->site_img_details4,$request->site_img_details5);
        for($i = 0;$i<=$request->site_img_no -1;$i++){
            DB::insert('insert into photo_requirement(booking_id, service_id, requirement) values (?,?,?)',[$booking_id,$service_id,$requirementDetails[$i]]);
        }
        DB::table('multiple_estimate_professionals')->where('id', $request->site_id)->update(['site_img_no' => $request->site_img_no, 'site_notification_status' => '0']);

        return redirect()->back()->with('success', 'Successfully Updated!');
    }
    
    public function serviceCalls()
    {
        return view('admin_jobick.service_calls.index');
    }
    
    public function jobPhotosApproval($id)
    {
        $check = DB::table('multiple_estimate_professionals')->where('id',$id)->first();
        if($check->img_app_status=='0')
        {
            DB::table('multiple_estimate_professionals')->where('id',$id)->update(['img_app_status'=>'1']);
        }
        else
        {
            DB::table('multiple_estimate_professionals')->where('id',$id)->update(['img_app_status'=>'0']);
        }
        return redirect()->back()->with('success','Successfully Updated!');
    }
    
    //start of Booking New

    public function bookings_index_new()
    {
        $data['userData'] = User_data::with(['services'])->where('est_status','0')->orderby('id','desc')->get();
        //dd($data);
        return view('admin_jobick.bookings_new.userData',$data);
    }

    public function bookings_view_new($id)
    {
         $data['userData'] =  User_data::with(['services'])->where('id',$id)->first();
 
        $data['ProjectDetails']=User_data_projectDetail::where('user_data_id',$id)->first();

        $data['Images']=User_data_image::where('user_data_id',$id)->pluck('image');
        //dd($data);
        return view('admin_jobick.bookings_new.userDataDetail',$data);
    }

    public function bookings_cancel_new($id)
    {
        $data=User_data::find($id);
        $data->delete();
        $data->services()->detach();
        return back()->with('success','Data Deleted Successfully!');
    }
    public function estimate_index_new()
    {
        $data['mult_est'] = DB::table('multiple_estimate')->where('delete_status','0')->where('payment_status','0')->orderby('id','desc')->get();
        return view('admin_jobick.estimate_new.index',$data);
    }
    
    
    public function serviceDetails($id)
    {
        
        $bool=DB::table('admin_notifications')->where('mest_pro_id',$id)->exists();
        if($bool==true){
            DB::table('admin_notifications')->where('mest_pro_id',$id)->delete();
        }
        return view('admin_jobick.multiple_estimate.active_service',compact('id'));
    }
    
    public function photoRequirementPost(Request $request)
    {
        $count_req = count($request->requirement)-1;
        for($cr=0; $cr<$count_req;$cr++)
        // foreach($request->requirement as $key => $value)
        {
            
            $pr = new PhotoRequirement();
            $pr->booking_id = $request->booking_id;
            $pr->service_id = $request->service_id;
            $pr->requirement = $request->requirement[$cr];
            $pr->save();   
            
        }
        return redirect()->back()->with('success','Successfully Inserted!');
    }
    
    public function markComplete($id)
    {
        $check = DB::table('multiple_estimate_professionals')->where('id',$id)->first();
        if($check->mark_complete=='0')
        {
            DB::table('multiple_estimate_professionals')->where('id',$id)->update(['mark_complete'=>'1']);
        }
        // else
        // {
        //     DB::table('multiple_estimate_professionals')->where('id',$id)->update(['img_app_status'=>'0']);
        // }
        return redirect()->back()->with('success','Successfully Updated!');
    }
    
    public function adminMarkComplete($id)
    {
        $check = DB::table('multiple_estimate_professionals')->where('id',$id)->first();
        if($check->admin_mark_complete=='0')
        {
            DB::table('multiple_estimate_professionals')->where('id',$id)->update(['admin_mark_complete'=>'1']);
        }
        // else
        // {
        //     DB::table('multiple_estimate_professionals')->where('id',$id)->update(['img_app_status'=>'0']);
        // }
        return redirect()->back()->with('success','Successfully Updated!');
    }
    
    public function delRequirement($id)
    {
        DB::table('photo_requirement')->where('id',$id)->delete();
        return back()->with('success','Requirement Deleted Successfully!');
    }
    
     public function ProMessages()
    {

        // $data = DB::table('customer_msg')
        //     ->groupBy('booking_id')
        //     ->get();
        // foreach ($data as $msgs) {
        //     if ($msgs->is_seen == 0) {
        //         $msgs->is_new = 1;
        //     }
        // }
        // dd($data);
        // DB::table('customer_msg')->update(array('is_seen' => '1'));
        \DB::statement("SET SQL_MODE=''");
        $data = DB::select('select * from `customer_msg` where id in(select max(id) from customer_msg group by booking_id) order by id desc');
        foreach ($data as $msgs) {
            if ($msgs->is_seen == 0) {
                $msgs->is_new = 1;
            }
        }
        DB::table('customer_msg')->update(array('is_seen' => '1'));
        return view('admin_jobick.Messages.Index', ['data'=>$data]);
    }
     public function ProMessageDelete($id)
    {
        
        
        
        $data=DB::table('customer_msg')->where('id',$id);
           $data->delete();
                  return back()->with('success','Message Deleted Successfully!');
    }
    
    public function msgPro(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "msg" => 'required|max:1000'
        ]);
        if($validator->fails()){return redirect()->back()->with('error',"There were some problems with your input.");}
        else
        {
            DB::table("pro_msg")->insert([
                'pro_id' => $request->pro_id,
                'service_id' => $request->service_id,
                'booking_id' => $request->booking_id,
                'msg' => $request->msg,
            ]);
            return redirect()->back()->with('success','Successfully Sent!');
        }
    }
public function customerMessage(Request $req)
    {
        $serviceid = $req->service_id;
        $bookingid = $req->booking_id;
        $data = DB::select('select * from customer_msg where service_id = ? and booking_id = ?', [$serviceid, $bookingid]);
        return view('admin_jobick.Messages.Messageload', ['data' => $data]);
    }

public function adminCompletednotes(Request $req)
    {
        $note = $req->note;
        $id = $req->id;
        $booking_id = $req->bookingId;
        $service_id = $req->serviceId;
        $data = DB::insert('insert into `admin_mark_complete_note`(`admin_note`, `project_id`,`service_id`,`booking_id`) values(?,?,?,?)', [$note, $id, $service_id, $booking_id]);
        if ($data > 0) {
            return 'success';
        } else {
            return 'failed';
        }
    }
 public function History()
    {
        return view('admin_jobick.multiple_estimate.job_history');
    }
    
    
      public function userData_index()
    {
         $data['userData'] = User_data::with(['services'])->where('est_status','0')->orderby('id','desc')->get();
        return view('admin_jobick.user.User_data',$data);
    }

 public function photoRequirementGet(Request $req)
    {
        $booking_id = $req->booking_id;
        $service_id = $req->service_id;
        $input = $req->input;
        $data = DB::select('select * from photo_requirement where booking_id = ? and service_id = ?', [$booking_id, $service_id]);
        $siteimgNo = count($data);
        if ($siteimgNo < 5) {
            $insert = DB::insert('insert into `photo_requirement`(`booking_id`, `service_id`, `requirement`) values (?,?,?)', [$booking_id, $service_id, $input]);
            if ($insert > 0) {
                $data2 = DB::select('select * from photo_requirement where booking_id = ? and service_id = ?', [$booking_id, $service_id]);
                return [$data2,$service_id];
            }
            return view('admin_jobick.multiple_estimate.activeservices__requiremnet', ['data' => $data]);
        } else {
            return view('admin_jobick.multiple_estimate.activeservices__requiremnet', ['data' => $data]);
        }
    }


    public function delRequirementDetails(Request $req)
    {
        $id = $req->id;
        $data = DB::select('select * from `photo_requirement` where id = ?', [$id]);
        foreach ($data as $dt);
        $booking_id = $dt->booking_id;
        $service_id = $dt->service_id;

        $delete = DB::delete('delete from `photo_requirement` where id = ?', [$id]);
        if ($delete > 0) {
            $data2 = DB::select('select * from photo_requirement where booking_id = ? and service_id = ?', [$booking_id, $service_id]);
            return [$data2,$service_id];
        } else {
            return 'failed';
        }
    }
    
    public function updateAndReturn(Request $req){
        $main_id = $req->main_id;
        $booking_id = $req->booking_id;
        $service_id = $req->service_id;
        $data2 = DB::select('select * from photo_requirement where booking_id = ? and service_id = ?', [$booking_id, $service_id]);
        $update = DB::table('multiple_estimate_professionals')->where('id', $main_id)->update(['site_img_no' => count($data2)]);
        return view('admin_jobick.multiple_estimate.activeservices__requiremnet', ['data' => $data2]);
        
    }


}
