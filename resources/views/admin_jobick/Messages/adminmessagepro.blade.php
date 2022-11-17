@foreach($data as $dt)
<?php
$arr[] = $dt; 
$booking_id = $dt->booking_id;
$admin_id = $dt->admin_id;
$pro_id = $dt->pro_id;
?>
@if(session()->has('admin-login-id'))
@if($dt->send == 'pro')
<!-- ------- User message --------->
<div class="usermessage">
    <!-- <------- user image --------->
    <img src="https://writestylesonline.com/wp-content/uploads/2018/11/Three-Statistics-That-Will-Make-You-Rethink-Your-Professional-Profile-Picture.jpg" alt="">
    <!-- <------- user message --------->
    <div class="message">
        <div class="date user">
            <p><?php echo date('d/m/Y', strtotime(str_replace('-', '/', $dt->dt))); ?> <?php echo date('H:i', strtotime(str_replace('-', '/', $dt->dt))); ?> <?php if (date('H', strtotime($dt->dt)) <= 12) {
                                                                                                                                                                    echo 'am';
                                                                                                                                                                } else if (date('H', strtotime($dt->dt) == 16)) {
                                                                                                                                                                    echo 'pm';
                                                                                                                                                                } ?></p>
        </div>
        <p><?php echo $dt->msg; ?></p>
    </div>
</div>
@elseif($dt->send == 'admin')
<!-- <------- Pro Message --------->
<div class="usermessage promessage">
    <!-- <------- pro message --------->
    <div class="message">
        <div class="date pro">
            <p><?php echo date('d/m/Y', strtotime(str_replace('-', '/', $dt->dt))); ?> <?php echo date('H:i', strtotime(str_replace('-', '/', $dt->dt))); ?> <?php if (date('H', strtotime($dt->dt)) <= 12) {
                                                                                                                                                                    echo 'am';
                                                                                                                                                                } else if (date('H', strtotime($dt->dt) == 16)) {
                                                                                                                                                                    echo 'pm';
                                                                                                                                                                } ?></p>
        </div>
        <p><?php echo $dt->msg; ?></p>
    </div>
    <!-- <------- pro image --------->
    <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="">
</div>
@endif
@endif
@endforeach
<input type="hidden" id="lastid" value="<?php end($arr);         // move the internal pointer to the end of the arr
$key = array_key_last($arr);  // fetches the key of the element pointed to by the internal pointer

echo $arr[$key]->msg_id;?>">
<script>
   function last(){
    lastid = '<?php echo $arr[$key]->msg_id; ?>';
   }
   function scroll() {
        $(".chat").scrollTop(999999999999+'px');
        console.log(document.getElementById("chat").scrollHeight);
    }
</script>