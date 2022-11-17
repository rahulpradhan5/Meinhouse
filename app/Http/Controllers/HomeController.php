<?php

namespace App\Http\Controllers;
use Validator, Input, Redirect, Hash; 
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UserAddress;
use App\Models\User;
use App\Models\Contact;
use App\Models\Booking;
use App\Models\User_data;
use App\Models\User_data_service;
use App\Models\User_data_image;
use App\Models\User_data_projectDetail;
use App\Models\Pro_data;
use App\Models\Pro_data_service;
use Illuminate\Support\Facades\Auth;
use App\Models\Recent_activity_user;
use Session;
use DB;
use App\Models\ProReview;
class HomeController extends Controller
{

    public function Index()
    {
        $services = Service::orderBy('name','ASC')->get();
        $testimonials = Testimonial::get();
        return view('website.index',compact('services','testimonials'));
    }

    public function About()
    {
        return view('website.about');
    }

    public function Service()
    {
        $data['services'] = Service::where('status','1')->orderBy('name','ASC')->get();
        return view('website.service',$data);
    }

    public function serviceDetail(Request $request,$url)
    {
        if(isset($url)){
            $booking = '';
            $service = Service::where('url',$url)->first();
            if(isset($service)){
                $popular_services = Service::orderBy('booking_count','DESC')->limit('5')->get();
                $addresses = array();
                if(auth::user()){
                    $addresses = UserAddress::where('user_id',auth::user()->id)->orderBy('id','DESC')->get();
                }
                if(isset($request->booking_id)){
                    $booking = Booking::where('id',$request->booking_id)->first();
                    return view('website.user_rebookings',compact('service','popular_services','addresses','booking'));
                }else{
					$services = Service::where('status',1)->orderBy('name','ASC')->get();
                    return view('website.serviceDetails',compact('service','services','popular_services','addresses'));
                }
            }else{
                return redirect('mississauga');
            }
        }else{
            return redirect('mississauga');
        }
    }
    public function contactUsPost(Request $request)
    {  
        $this->validate($request, [
            'email' => 'required',
            'phone' => 'required' ,
            'name' => 'required',
            'venue' => 'required',
            'message' => 'required'


        ]);
    
       
        //get contact  data
        $contactData = $request->all();
       
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->venue = $request->venue;
        $contact->message = $request->message;
        $contact->save();

         //recent activity setups
         $activity=New Recent_activity_user;
         $activity->name=$request->name;
 
 
         $activity->description=$request->name." have made a new request" ;
 
         $activity->save();
 //recent activity ends
 
        
        $send_email = 'aayushiquantum@gmail.com';
            $data  = array('email'=>$contact->email,'name'=>$contact->name,'message'=>$contact->message,'phone'=>$contact->phone,'venue'=>$contact->venue);
            
            $send_email = 'aayushiquantum@gmail.com';
            $subject = "Contact Form Queries";
            //$htmlContent = file_get_contents(resource_path('views/website/email/reset_mail.blade.php',false, $context));
            $message ="<html>
            <head>
            	<title></title>
            </head>
            <body>
            	<p><b>Name - </b>".$data['name']."</p><br>
            	<p><b>Email - </b>".$data['email']."</p><br>
            	<p><b>Phone - </b>".$data['phone']."</p><br>
            	<p><b>Venue - </b>".$data['venue']."</p><br>
            	<p><b>Message - </b>".$data['message']."</p>
            </body>
            </html>";
            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

            // Additional headers 
            $headers .= 'From: '.$send_email.'<'.$send_email.'>' . "\r\n"; 

            mail('aayushiquantum@gmail.com',"Contact Form Query",$message,$headers);

        return redirect('contact-us')->with('message','Details submitted successfully.We will contact you soon.');
       
    }
    public function Blog()
    {
        return view('website.blog');
    }
    public function blogdetail($url){
        $blog = Blog::where('url',$url)->first();
        if(isset($blog)){
            $count = $blog->views;
            $blog->views = $count + 1;
            $blog->save();
           return view('website.blogdetail',compact('blog')); 
        }else{
            
            return redirect('blog-post');
        }
        
    }
    public function Contact()
    {
        return view('website.contact');
    }

    
    public function proLogin()
    {
        return view('website.pro-login');
    }
    
    public function proRegister()
    {
        return view('website.pro-register');
    }

    public function Terms()
    {
        return view('website.terms');
    }

    public function privacyPolicy()
    {
        return view('website.privacy-policy');
    }
    
    // pro landing
    public function proLanding()
    {
        $services = Service::where('status',1)->get();
        return view('pro_landing.index',compact('services'));
    }

    public function proLandingPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:100',
            'city'=>'required|max:100',
            'email'=>'required|unique:App\Models\Pro_data,email',
            'phone'=>'required|max:11|min:10',
            'trade'=>'required',
            'authorize'=>'accepted'
            ]);
        if($validator->fails()){return redirect()->back()->withErrors($validator)->withInput();}

        else
        {
            $email=$request->email;
            $name=$request->name;
            $phone=$request->phone;
            $trade=$request->trade;
            $city=$request->city;
        

             $pro_data=New Pro_data;
             $pro_data->email = $email;
             $pro_data->name=$name;
             $pro_data->phone=$phone;
             $pro_data->city=$city;
             $pro_data->authorize="checked";
             $pro_data->save();
             $serviceids=$request->trade;
             $pro_data->services()->attach($serviceids);

             $activity=New Recent_activity_user;
             $activity->name=$name;


             $activity->description='pro '.$name." signed up" ;

             $activity->save();

               //$insert = DB::table('pro_data')->insert(array(
            //    'name'=>$request->name,
            //    'city'=>$request->city,
            //    'email'=>$request->email,
            //    'phone'=>$request->phone,
            //    'trade'=>$request->trade,
            //    'authorize'=>"checked",
            //));
           
                return redirect()->back()->with('success','Form Submitted Successfully!');
            
        }
    }
    // user landing

    public function userLanding()
    {
        $services = Service::where('status',1)->get();
        return view('user_landing.index',compact('services')); 
    }

      public function userLandingPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
          
              'name'=>'required|max:100',
            'lastname'=>'required|max:100',
            'email'=>'required|max:100',
            'phone'=>'required|max:11|min:10',
           
            //'street'=>'required|max:100',
            //'city'=>'required|max:100',
            //'province'=>'required|max:100',
            //'postal_code'=>'required|max:10',
            //'address'=>'required|max:200',
            // 'authorize'=>'accepted'
            ]);
        if($validator->fails()){return redirect()->back()->withErrors($validator)->withInput();}

        else
        {
           /* $email=$request->email;
            $name=$request->name;
            $phone=$request->phone;
             $service=$request->service;  
             //dd($service);  
             for ($i=0; $i <count($service) ; $i++) { 
                DB::table('user_data')->insert(array(
                    'name'=>$name,
                    'email'=>$email,
                    'contact'=>$phone,
                    'service'=>$service[$i],
                    //'street'=>$request->street,
                    //'city'=>$request->city,
                    //'province'=>$request->province,
                    //'postal_code'=>$request->postal_code,
                    //'address'=>$request->address,
                ));
             }*/

             $email=$request->email;
            $name=$request->name.' '.$request->lastname;
            $phone=$request->phone;
            $service=$request->service;
            

             
             //dd($services);  

            $user_data=New User_data;
             $user_data->email = $email;
             $user_data->name=$name;
             $user_data->contact =$phone;
   
             $user_data->save();
             $id=$user_data->id;
             
              //$serviceids=$request->service;
             //$user_data->services()->attach($serviceids);
                 session()->put('user-data-id',$user_data->id);
          
         
             

             $activity=New Recent_activity_user;
             $activity->name=$name;


             $activity->description='User '.$name." signed up" ;

             $activity->save();



            
             return redirect()->route('user_landing_details');

        }
    }

    
    public function userLanding_Second_Step()
    {
        //dd(session()->get('user-data-id'));
        if(session()->get('user-data-id') == NULL){
          return redirect()->route('user_landing');
        }
        
        return view('user_landing.Second_step');

    }
    public function userLanding_Second_Step_Post(Request $req)
    {

        $validator = $req->validate([
            'name'=>'required|max:100',
            'desc'=>'required',
            'address'=>'required|max:100',
            'city'=>'required',
            'time'=>'required',
           
            //'street'=>'required|max:100',
            //'city'=>'required|max:100',
            //'province'=>'required|max:100',
            //'postal_code'=>'required|max:10',
            //'address'=>'required|max:200',
            //'authorize'=>'accepted'
            ]);

       //dd($req->all());
       $images=$req->images;
     
       $data=new User_data_projectDetail;
       $data->Name=$req->name;
       $data->description=$req->desc;
       $data->user_data_id=session()->get('user-data-id');
       $data->Address=$req->address;
       $data->city=$req->city;
       $data->Time=$req->time;
       $data->save();
       foreach($images as $key=> $file)
       {
           $name = time().$key.'.'.$file->extension();
           //$dest_path='public/Place_upload';
           $file->move(public_path('User_data_uploads'), $name);
           $ImageName[] = $name;
       }

       for ($i=0; $i <count($ImageName) ; $i++) { 
                $image=New User_data_image;
                $image->image=$ImageName[$i];
                $image->user_data_id=session()->get('user-data-id');
                $image->save();

       }

      $id=session()->get('user-data-id');
        $userData =  User_data::with(['services'])->where('id',$id)->first();
        $phone=$userData->contact;
        $email=$userData->email;
        $name=$userData->name;
      
   //email to admin 
             
             //$send_email = 'aayushiquantum@gmail.com';
            //$data  = array('email'=>$contact->email,'name'=>$contact->name,'message'=>$contact->message,'phone'=>$contact->phone,'venue'=>$contact->venue);
            
            $send_email = 'shubhu.quantumit@gmail.com';
            $subject = "A new user signed up ";
             $headers = "From: MeinHaus Online General Contractor <noreply@meinhaus.ca>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            //$htmlContent = file_get_contents(resource_path('views/website/email/reset_mail.blade.php',false, $context));
           
            
              $message = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>User sign up</title>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' integrity='sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
        </head>
        <body >
          <div >
    <div class='adM'>
    </div>
    <table border='0' cellpadding='0' cellspacing='0' align='center'>

        <tbody>
            <tr>
                <td>

                </td>
            </tr>
            <tr>

                <td width='600' align='center' style='background:#ffffff' bgcolor='#ffffff'>
                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                        <tbody>
                            <tr>
                                <td valign='top' style='padding:20px 5% 29px 5%;color:#fff;box-sizing:content-box;border-bottom: 1px solid grey;'>
                                    <a href='https://meinhaus.ca' style='color:#fff' rel='noreferrer'><img src='https://meinhausca.com/public/theme/images/logo-img.png' style='width:150px;vertical-align:middle' alt=' MeinhHaus Logo' class='CToWUd' data-bit='iit'></a>
                                </td>
                            </tr>
                            
                            <tr>
                                <td align='left'
                                    style='font-family:arial,sans-serif;font-size:18px;color:#212121;line-height:30px;font-weight:bold;padding:25px 5% 15px 5%'>
                                    New User signed <span class='il'>up</span>!
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='100%'>
                        <tbody>
                            <tr>

                                <td style='padding-bottom:50px;border-bottom:1px solid #659fc9;justify-content: center;display: flex;'>
                                    <table cellpadding='0' cellspacing='0' width='100%'
                                        style='border: 2px solid #8080807d;margin-inline: 50px;width: 415px;text-align: center;text-align: left;border-radius: 20px;padding: 10px;'>
                                        <tbody>
                                         <tr>
                                <td style='padding:10px;width:25%'><b>Name : </b></td>
                                <td style='padding:10px'>".$name."</td>
                            </tr>

                            <tr>
                                <td style='padding:10px;width:25%'><b>Mobile : </b></td>
                                <td style='padding:10px'> ".$phone."</td>
                            </tr>

                            <tr>
                                <td style='padding:10px;width:25%'><b>Email : </b></td>
                                <td style='padding:10px'>".$email."</td>
                            </tr>

                                            <tr >
                                                <td style='display:flex;justify-content:center;padding:10px;' ><a href='http://beautyliciousnj.com/meinhause/view/user/ProjectDetails/$id' style='padding:10px;background-color:orange;color:white;border:none;border-radius:10px;margin:auto;text-decoration:none;' >Details </a></td>
                                             
                                            </tr>
                                            <tr>

                                            </tr>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>

                                </td>


                            </tr>
                            <tr>

                                <td colspan='3' align='left'
                                    style='font-family:arial,sans-serif;font-size:13px;line-height:22px!important;color:#212121;padding:15px 5% 0 5%'>

                                    <table cellpadding='0' cellspacing='0' border='0'>

                                        <tbody>
                                            <tr>

                                                <td align='left' style='line-height:18px'>

                                                    Regards,<br>

                                                    ----- <br>

                                                    </strong><br>

                                                    <span style='font-size:11px'>

                                                        Email : info@meinhaus.ca<br>


                                                        Mobile : 1(844) 777-HAUS (4287)</a>
                                                    </span>

                                                    <br><br>

                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>

                                </td>

                            </tr>

                        </tbody>
                    </table>

                    <table cellpadding='0' cellspacing='0' border='0' align='center' width='100%'>

                        <tbody>
                            <tr>

                                <td width='580' valign='top'
                                    style='font-family:arial,sans-serif;border-top:1px solid #d2d1d1;padding:10px 0;text-align:center;font-size:12px;color:#a9a9a9;direction:ltr'>

                                    © <a href='https://meinhaus.ca' style='color:#a9a9a9;text-decoration:none' rel='noreferrer' ><span class='il'>MeinHaus</span>.ca</a>
                        - All rights reserved.
                                </td>

                            </tr>

                        </tbody>
                    </table>


                </td>

            </tr>
        </tbody>
    </table>
    <div class='yj6qo'></div>
    <div class='adL'>
    </div>
</div>
        </body>
        </html>";

            // Set content-type header for sending HTML email 
         
            mail('shubhu.quantumit@gmail.com',$subject,$message,$headers);
            mail('info@meinhaus.ca',$subject,$message,$headers );
            //email ends

        return redirect()->route('user_landing_Thirdstep');

    }
   
    public function user_landing_Thirdstep(Request $req)
    {
        return redirect()->route('user_landing_AccountSetup');

        

    }
    public function AccountSetup()
    {   
        if(session()->get('user-data-id') == NULL){
          return redirect()->route('user_landing');
        }
        
        else{
            $data=User_data::find(session()->get('user-data-id'));
                
                //where('id',)->first();
            //dd($data);
            return view('user_landing.AccountSetup',compact('data'));   
        }
        
}


 public function ViewProjectDetails($id)
    {   
        
        
        
         
                
        $userData =  User_data::with(['services'])->where('id',$id)->first();
 
        $ProjectDetails=User_data_projectDetail::where('user_data_id',$id)->first();

        $Images=User_data_image::where('user_data_id',$id)->pluck('image');
        
            //dd($data);
            return view('user_landing.Projectdetails',compact('userData','ProjectDetails','Images'));   
        
        
}

    
    public function convertEstimate($id)
    {
        $userData =  User_data::with(['services'])->where('id',$id)->first();
 
        $ProjectDetails=User_data_projectDetail::where('user_data_id',$id)->first();

        $Images=User_data_image::where('user_data_id',$id)->pluck('image');
        
        return view('user_landing.convertEstimate',compact('userData','ProjectDetails','Images'));   
    }
    
    public function convertEstimatePost(Request $request)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000, 9999)
            . $characters[rand(0, strlen($characters) - 2)]
            . mt_rand(10, 99);

        $string = str_shuffle($pin);
        $booking = 'OD-'.'U'.$string;
        DB::table('user_data_estimate')->insert([
            'booking_id' => $booking, 
            'title' => $request->title, 
            'user_data_id' => $request->user_data_id, 
            'user_data_project_id' => $request->user_data_project_id, 
            'amount' => $request->amount, 
            'reg_amount' => $request->reg_amount, 
        ]);
        
        $e_id = DB::getPdo()->lastInsertId();
        $email = $request->email;
        
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
                    <h1 style='text-align: center;'>$request->title</h1>
                    <hr>
                    <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
                    </p>
                    <br>
                    <h1 style='text-align: center;'>
                        <a href='http://beautyliciousnj.com/meinhause/userEstimateInvoice/$e_id'><button
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
                        <h1 style='text-align: center;'>$request->title</h1>
                        <hr>
                        <p style='text-align: center; font-size: 17px;'>We are pleased to present your MeinHaus project estimate.
                        </p>
                        <br>
                        <h1 style='text-align: center;'>
                            <a href='http://beautyliciousnj.com/meinhause/userEstimateInvoice/$e_id'><button
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
            DB::table('user_data')->where('id',$request->user_data_id)->update(['est_status'=>'1']);
            return redirect(url("view/user/ProjectDetails/$request->user_data_id"))->with('success','Estimate Converted Successfully!');
        }
        else
        {
            echo "Mail Not Sent";
        }
        
    }
    
    
    public function userEstimateInvoice($id)
    {
        return view('user_landing.estimate_invoice',compact('id'));
    }
    
    public function proProfile($id)
    {
        $reviews = ProReview::where('pro_id',$id)->orderBy('id','DESC')->get();
        $review_count = ProReview::where('pro_id',$id)->orderBy('id','DESC')->count();
        $review_avg = ProReview::where('pro_id',$id)->orderBy('id','DESC')->avg('stars');
        return view('professional.proProfile',compact('id','reviews','review_count','review_avg'));
    }
    
    
    

}
