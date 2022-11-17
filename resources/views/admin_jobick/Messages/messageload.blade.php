<!-- <------- Chat section --------->
@foreach($data as $dt)
@if($dt->send == 'user')
<!-- ------- User message --------->
<div class="usermessage">
    <!-- <------- user image --------->
    <img src="https://writestylesonline.com/wp-content/uploads/2018/11/Three-Statistics-That-Will-Make-You-Rethink-Your-Professional-Profile-Picture.jpg" alt="">
    <!-- <------- user message --------->
    <div class="message">
        <div class="date user">
            <p><?php echo date('d/m/Y', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php echo date('H:i', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php if (date('H', strtotime($dt->created_at)) <= 12) {
                                                                                                                                                                                    echo 'am';
                                                                                                                                                                                } else if (date('H', strtotime($dt->created_at) == 16)) {
                                                                                                                                                                                    echo 'pm';
                                                                                                                                                                                } ?></p>
        </div>
        <p><?php echo $dt->msg; ?></p>
    </div>
</div>
@elseif($dt->send ==  'pro')
<!-- <------- Pro Message --------->
<div class="usermessage promessage">
    <!-- <------- pro message --------->
    <div class="message">
        <div class="date pro">
            <p><?php echo date('d/m/Y', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php echo date('H:i', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php if (date('H', strtotime($dt->created_at)) <= 12) {
                                                                                                                                                                                    echo 'am';
                                                                                                                                                                                } else if (date('H', strtotime($dt->created_at) == 16)) {
                                                                                                                                                                                    echo 'pm';
                                                                                                                                                                                } ?></p>
        </div>
        <p><?php echo $dt->msg; ?></p>
    </div>
    <!-- <------- pro image --------->
    <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="">
</div>
@endif

@if($dt->send == 'admin')
<!-- <------- Pro Message --------->
<div class="usermessage promessage">
    <!-- <------- pro message --------->
    <div class="message">
        <div class="date pro">
            <p><?php echo date('d/m/Y', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php echo date('H:i', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php if (date('H', strtotime($dt->created_at)) <= 12) {
                                                                                                                                                                                    echo 'am';
                                                                                                                                                                                } else if (date('H', strtotime($dt->created_at) == 16)) {
                                                                                                                                                                                    echo 'pm';
                                                                                                                                                                                } ?></p>
        </div>
        <p><?php echo $dt->msg; ?></p>
    </div>
    <!-- <------- pro image --------->
    <img src="https://www.seekpng.com/png/detail/413-4139803_unknown-profile-profile-picture-unknown.png" alt="">
</div>

@else
<!-- ------- User message --------->
<div class="usermessage">
    <!-- <------- user image --------->
    <img src="https://writestylesonline.com/wp-content/uploads/2018/11/Three-Statistics-That-Will-Make-You-Rethink-Your-Professional-Profile-Picture.jpg" alt="">
    <!-- <------- user message --------->
    <div class="message">
        <div class="date user">
            <p><?php echo date('d/m/Y', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php echo date('H:i', strtotime(str_replace('-', '/', $dt->created_at))); ?> <?php if (date('H', strtotime($dt->created_at)) <= 12) {
                                                                                                                                                                                    echo 'am';
                                                                                                                                                                                } else if (date('H', strtotime($dt->created_at) == 16)) {
                                                                                                                                                                                    echo 'pm';
                                                                                                                                                                                } ?></p>
        </div>
        <p><?php echo $dt->msg; ?></p>
    </div>
</div>

@endif


@endforeach