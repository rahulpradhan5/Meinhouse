<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            box-sizing: border-box;
        }
        input::placeholder{
            font-size: 16px;
            padding-left: 10px;
        }
        td{
            padding: 10px 0;
        }
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="margin: 0px; box-sizing: border-box;">
<?php $user_info = DB::table('estimates')->where('id',$bookingId)->get(); 
 	  $name = $user_info[0]->name;
 	  $address = $user_info[0]->address;
 	  $email = $user_info[0]->email;
 	  $phone_no = $user_info[0]->phone_no;
 	  $service_id = $user_info[0]->service_id;
 	  $booking_show_id = $user_info[0]->booking_show_id;
 	  $created_at = $user_info[0]->created_at;
 	  $amount = $user_info[0]->amount;
 	  $reg_amount = $user_info[0]->reg_amount;
 	  $pdf = $user_info[0]->pdf_file;
 	  $created_at = $user_info[0]->created_at;
 	  $desc = $user_info[0]->description;
 	  
?>

    <div id="hide">
    <h1 style="text-align: center;">Meinhause</h1>
    <br>
    
    <p style="text-align: center;">Invoice <?php echo $booking_show_id = $user_info[0]->booking_show_id; ?></p>
    <br>
    <p style="text-align: center; font-size: 28px; font-weight: bold;">$<?php echo $reg_amount = $user_info[0]->reg_amount; ?></p>
    <p style="text-align: center;">Due on <?php echo $created_at = $user_info[0]->created_at; ?></p>
    <br>
    <div style="display: flex; justify-content: center; position: relative; width: 100%; height: 400px; overflow-x: hidden;">
     <div id="first" style="width: 60%; border: 1px solid rgba(138, 125, 125, 0.623); border-radius: 1rem; padding-bottom: 30px; position: absolute;">
        <div style="background-color: #F0F4FA; height: 50px; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
            <p style="text-align: center; font-size: 20px; font-weight: 700; padding-top: 10px;">How would you like to pay?</p>
        </div>
        <div >
            <a href="{{url('online-pay/'.$bookingId)}}"><button id="credi" style="width: 45%; border: none; height: 50px; border-radius: 2rem;background-color: #136ACD;color: white; margin-left: 28%; margin-top: 30px; font-size: 20px;">Credit or debit card</button></a><br>
            <button id="bank" style="color: #136ACD !important; width: 45%; border: none; height: 50px; border-radius: 2rem; border: 1.5px solid #136ACD; background-color: #fcfcfc;color: white; margin-left: 28%; margin-top: 30px;font-size: 20px; ">Bank Payment (EFT)</button>
            <br><br>
            <p style="text-align: center;">Supported Cards</p>
            <div style="display: flex; justify-content: center; margin-top: 15px;">
                <i style="margin: 0 3px; font-size: 20px;" class="fab fa-cc-visa"></i>
                <i style="margin: 0 3px; font-size: 20px;" class="fab fa-cc-mastercard"></i>
                <i style="margin: 0 3px; font-size: 20px;" class="fab fa-cc-amex"></i>
                <i style="margin: 0 3px; font-size: 20px;" class="fab fa-cc-discover"></i>
    
            </div>

        </div>
    </div> 
    <div id="second" style="width: 60%; border: 1px solid rgba(138, 125, 125, 0.623); border-radius: 1rem; padding-bottom: 30px; position: absolute; right: 100%;">
        <div style="background-color: #F0F4FA; height: 80px; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
            <p style="text-align: center; font-size: 20px; font-weight: 700; padding-top: 10px;">Pay with credit or debit card</p>
            <p id="back" style="text-align: center;color: rgb(29, 132, 250); font-size: 17px; font-weight: 500; padding-top: 10px;"> <i class="fa fa-chevron-left"></i> Pay a different way</p>
            
        </div>
        <div >
            <div style="display: flex; justify-content: center; margin-top: 15px;">
                <i style="margin: 0 3px; font-size: 30px;" class="fab fa-cc-visa"></i>
                <i style="margin: 0 3px; font-size: 30px;" class="fab fa-cc-mastercard"></i>
                <i style="margin: 0 3px; font-size: 30px;" class="fab fa-cc-amex"></i>
                <i style="margin: 0 3px; font-size: 30px;" class="fab fa-cc-discover"></i>
    
            </div>
            <br>
            <div style="width: 60%; margin: 0 auto;">
                <form action="">
                    <input style="width: 48%; height: 35px; font-size: 18px; border:1px solid grey; border-radius: 3px; outline: none;" type="text" name="card-number" id="" placeholder="Card Number">
                    <input style="width: 24%; height: 35px; font-size: 18px; border:1px solid grey; border-radius: 3px; outline: none;" type="text" name="" id="" placeholder="MM/YY">
                    <input style="width: 24%; height: 35px; font-size: 18px; border:1px solid grey; border-radius: 3px; outline: none;" type="text" name="" id="" placeholder="CVV"> <br> <br>
                    <input style="width: 48%; height: 35px; font-size: 18px; border:1px solid grey; border-radius: 3px; outline: none;" type="text" name="card-number" id="" placeholder="Name on Card">
                    <input style="width: 24%; height: 35px; font-size: 18px; border:1px solid grey; border-radius: 3px; outline: none;" type="text" name="" id="" placeholder="ZIP/Postal">
                    <input style="width: 24%; height: 35px; font-size: 18px; border:1px solid grey; border-radius: 3px; outline: none;" type="text" name="" id="" value="$96000">
                    <br>
                    <span style="display: flex; margin-top: 20px;" >
                    <input style="margin-top: 6px;" type="checkbox" name="" id=""> <span style="padding-left: 10px;">Save this credit card and allow Meinhaus to automatically charge it for future invoices</span> </span>
                    <button style="width: 90%; border: none; height: 40px; border-radius: 2rem;background-color: #136ACD;color: white; margin-left: 5%; margin-top: 30px; font-size: 18px;"><i style="margin-right: 5px; font-size: 16px;" class="fa fa-lock"></i>Pay</button><br>
                </form>
            </div>
           
            

        </div>
    </div>
</div>
<br>
<br>
<div style="display: flex; justify-content: center;">
    <div style="width: 60%; ">
        <button id="print" style="color: #136ACD !important; width: 15%; border: none; height: 40px; border-radius: 2rem; border: 1.5px solid #136ACD; background-color: #fcfcfc;color: white;  margin-top: 30px;font-size: 16px; ">Print</button>
        <button style="color: #136ACD !important; width: 22%; border: none; height: 40px; border-radius: 2rem; border: 1.5px solid #136ACD; background-color: #fcfcfc;color: white;  margin-top: 30px;font-size: 16px; margin-left: 10px; ">Download Pdf</button>
    </div>
</div>
<br>
</div>
<div id="invoice" style="width: 60%; border: 1px solid rgba(138, 125, 125, 0.623); border-radius: 0.5rem; margin-left:20%; padding-bottom: 20%; margin-top: 20px !important;">
    <div style="text-align: right; padding-right: 60px;">
        <h3 style="font-size: 35px; margin-top: 40px; ">INVOICE</h3>
        <b>Meinhause</b>
        <p>251 Queen Street S. Unit 3</p>
        <p>Mississauga, ON L5M</p>
        <p>Canada</p>
        <p style="margin-top: 20px;">647 930 9066</p>
        <p>meinhause.ca</p>
    </div>
    <br>
    <hr>
    <br>
    <div style="display: flex;">
        <div style="width: 50%; padding-left: 40px;">
            <h4 style="color: grey;">BILL TO</h4>
            <b><?php echo $name; ?></b>
            <p><?php echo $address; ?></p>
            <br>
            <p><?php echo $phone_no; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div style="width: 50%; padding-left: 80px; ">
            <p style="margin-top: 10px;"><b>Invoice Number: </b> <?php echo $booking_show_id; ?></p>
            <p><b>Invoice Date: </b> <?php echo $created_at; ?></p>
            <!--<p><b>Payment Due: </b> November 11, 2021</p>-->
            <br>
            
        </div>
    </div>
    <div style="width: 100%; border-bottom: 1px solid rgba(143, 134, 134, 0.76) ;">
        <table style="width: 100%;">
            <tr style=" background-color: rgb(29, 23, 23); color: white; height: 40px;">
                <th style="width: 46%;text-align: left;padding-left: 30px;">Service</th>
                <th style="width: 18%;">Description</th>
                <th style="width: 18%;">Price</th>
                <th style="width:18% ;">Amount</th>
            </tr>
            <tr>
                <td style="width: 46%; padding-left: 20px;"><?php 
                     	$service_info = DB::table('services')->where('id',$service_id)->get();
						echo $service_info[0]->name;
					?></td>
                <td style="text-align:center"><?php echo $desc = $user_info[0]->description; ?></td>
                <td>$<?php echo $amount; ?></td>
                    <td>$<?php echo $amount; ?></td>
            </tr>
            </table>
    </div>
    <br>
    <div style="width: 60%; display: flex; margin-left: 40%;">
        <div style="width: 60%; text-align: right;">
<b >Subtotal:</b>
<p style="margin-top:10px">Registration Amount:</p>
<br>
<hr>
<br>
<b>Total:</b>
<br>
<br>
<hr>
<br>
<b>Amount Due (CAD) :</b>
        </div>
        <div style="text-align: center; width: 50%;">
            <p style="margin-bottom:10px">$<?php echo $amount; ?></p>
            <p>$<?php echo $reg_amount; ?></p>
            <br>
            <hr>
            <br>
            <p>$<?php echo $total = $reg_amount + $amount; ?></p>
            <br>
            <hr>
            <br>
            <b>$<?php echo $total = $reg_amount + $amount; ?></b>

        </div>
        
    </div>
    

</div>
<div id="foot" style="margin-top: 40px; margin-bottom: 30px; text-align: center;">
    <h4 style="font-size: 24px;">Powered By Meinhause</h4>
    <p>© 2010-2021 Wave Financial Inc. </p>
    <a style="margin-left: 10px;" href="">Terms of Service</a>
    <a style="margin-left: 10px;" href="">Privacy Policy</a>
    <a style="margin-left: 10px;" href="">Security</a>
</div>


<script>
const one = document.getElementById('first');
const two = document.getElementById('second');
const credit = document.getElementById('credit');
const bank = document.getElementById('bank');
const back = document.getElementById('back');
const print = document.getElementById('print');
const invoice = document.getElementById('invoice');
const hide = document.getElementById('hide');
const foot = document.getElementById('foot');

credit.addEventListener('click',()=>{
    one.style.right="100%";
    two.style.left="20%";
})
back.addEventListener('click',()=>{
    one.style.right="20%";
    two.style.left="100%";
})
print.addEventListener('click',()=>{
    hide.style.display="none";
    foot.style.display="none";
    invoice.style.width="100%";
    invoice.style.margin="0";
    window.print()
    hide.style.display="block";
    hide.style.margin="0px";
    foot.style.display="block";
    invoice.style.width="60%";
    invoice.style.margin="10px";
    invoice.style.margin="0 20%";


})



</script>
    
</body>
</html>