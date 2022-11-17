@extends('admin_jobick.layout.layout')
@section('head_title','MESSAGES')

@section('content')
<?php error_reporting(0); ?>
<style type="text/css">
    .btn-highlight {
        text-align: center;
        background-color: #ffc107;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight1 {
        background-color: #07baff;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight2 {
        background-color: #0c4fca;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight3 {
        background-color: #961622;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight4 {
        background-color: #0f899c;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight5 {
        background-color: #0f8e36;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight6 {
        background-color: #ff5707;
        text-align: center;
        padding: 3px 7px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .btn-highlight7 {
        background-color: #de3bac;
        text-align: center;
        padding: 3px 5px;
        color: #fff;
        border-radius: 6px;
        width: 100%;
    }

    .new-message-popup {
        height: 100vh;
        width: 100%;
        justify-content: center;
        align-items: center;
        display: none;
        flex-direction: column;
        position: fixed;
        top: -30px;
        left: 50px;
    }

    .main-div {
        background-color: #fff;
        width: 50%;
        border: 2px solid var(--primary);
        border-radius: 5px;
        padding: 0;
        box-shadow: 0px 1px 10px 2px rgba(136, 136, 136, 0.25);
        justify-content: center;
        align-items: center;
        margin-top: 100px;
    }

    .cancel-button {
        height: 50px;
        color: red;
        justify-content: space-between;
        display: flex;
        align-items: center;
        text-align: end;
        margin-right: 5px;
    }

    .project-title {
        padding: 10px;
        margin-top: 30px;
        margin-bottom: 10px;
        text-align: start;
        justify-content: start;
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .cancel-button i {
        top: 0;
        cursor: pointer;

    }

    .chat {
        max-height: 50vh;
        justify-content: center;
        align-items: center;
        overflow-y: scroll;
        padding: 20px;
        margin-top: 10px;
        scroll-behavior: smooth;
    }

    .chat::-webkit-scrollbar {
        scrollbar-width: 5px;
    }


    .usermessage {
        display: flex;
        justify-content: start;
        align-items: center;
        text-align: center;
        margin-top: 20px;
    }

    .usermessage img {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        border: 1px solid var(--primary);
    }

    .usermessage .message {
        max-width: 75%;
        height: auto;
        background-color: #fff;
        border-radius: 5px;
        text-align: start;
        padding: 5px;
        margin-left: 10px;
        background-color: #F3F0F0;
        padding-bottom: 0;
    }

    .promessage {
        justify-content: end;

    }

    .promessage .message {
        margin-right: 10px;
        background-color: #edab3b;
        color: #fff;
        text-align: end;
        padding-bottom: 0;
    }

    .date {
        text-align: start;
        align-items: baseline;
        justify-content: start;
        font-size: 10px;
        font-size: x-small;
        width: 100%;
    }

    .date p {
        text-align: start;
        align-items: baseline;
        justify-content: baseline;
    }
    

    
    .date .user{
        
    }
    .loading {
        height: 110px;
        width: 140px;
        margin-left: 40%;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .image-div {
        width: 100%;
        max-height: 60px;
        padding: 20px;
        padding-left: 40px;
        padding-top: 10px;
    }

    .image-div img {
        height: 50px;
        width: 45px;
        border: 1px solid #edab3b;
        border-radius: 5px;
    }

    .chat-box {
        height: 40px;
        width: 100%;
        background-color: #fff;
        display: flex;
        justify-content: start;
        align-items: center;
        gap: 20px;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 25px;
        padding-bottom: 25px;
    }

    .chat-input {
        border: 1px solid #edab3b;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 40px;
        width: 70% !important;
        height: 30px !important;
    }

    .chatbox-btn {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 20px;
        padding-right: 20px;
        align-items: center;
        justify-content: center;
        display: flex;
        text-align: center;
        color: #fff;
        border-radius: 5px;
        border: 1px solid #edab3b;
        background-color: #edab3b;
        margin-left: -30px;
    }

    .upload-imgae {
        font-size: 18px;
        cursor: pointer;
    }

    .file-choose {
        display: none;
    }

    .message img {
        height: 80px;
        width: 150px;
        border-radius: 5px;
        object-fit: cover;
    }
    .date .pro{
        text-align: end;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Projects Management</h4>
                <!--<a href="{{ url('admin/create-multiple-estimate') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create-->
                <!--    New</a>-->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Project title</th>
                                <th>Message Type</th>
                                <th>Service</th>
                                <th>Pro Name</th>
                                <th>User Name</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key=>$msg)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <?php
                                $title = DB::table('multiple_estimate')->where('booking_show_id', $msg->booking_id)->first();
                                ?>
                                <td>{{ $title->title}}
                                    @if($msg->is_new ==1)
                                    <sup class=" badge-xs badge badge-success">New</span>
                                        @endif
                                </td>
                                <td>
                                    <?php 
                                    if($msg->send == 'user'){
                                        echo "user to pro";
                                    }else if($msg->send == 'pro'){
                                        echo "pro to user";
                                    }
                                    else if($msg->send == 'admin' && $msg->pro_id != ""){
                                        echo "Admin to pro";
                                    }
                                    else if($msg->send == 'admin' && $msg->customer_id != ""){
                                        echo "Admin to user";
                                    }
                                    ?>
                                </td>
                                <?php
                                $service = DB::table('services')->where('id', $msg->service_id)->first();
                                ?>
                                <td>{{$service->name}}</td>


                                <?php
                                $pro = DB::table('users')->where('id', $msg->pro_id)->first();
                                ?>

                                <td>{{$pro->name}}</td>

                                <?php
                                $user = DB::table('user_data')->where('id', $msg->customer_id)->get();
                                ?>

                                <td>
                                    {{$user[0]->name}}

                                </td>
                             

                                <td>

                                    <a href="{{ url('admin/messages/delete') }}/{{ $msg->id }}" id="delete{{ $userDetails->id }}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>
                                    <a id="delete{{ $userDetails->id }}" class="btn btn-danger shadow btn-xs sharp sweet-confirm " onclick="loadData(serviceId = '<?php echo $msg->service_id; ?>',bookingId = '<?php echo $msg->booking_id; ?>',projectTitle = '{{ $title->title}}')"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No data found !!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------=========-----------------------------------------------
--------------------Char Modal--------------------------------------------
-------------------------------------------------------------------------------------------------- -->
<div class="new-message-popup">
    <div class="main-div">
        <!-- <------- Canecl Btn --------->
        <div class="cancel-button">
            <div class="project-title">
                <h3 id="project-tit">Project Name</h3>
                <p id="project-id">Booking Id:OT-455644</p>
            </div>
            <i class="bi bi-x" onclick="chatClose()"></i>

        </div>
        <!-- <------- Chat section --------->
        <div class="chat" id="chat">

            <!-- ------- User message --------->
            <div class="usermessage">
                <!-- <------- user image --------->
                <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="">
                <!-- <------- user message --------->
                <div class="message">
                    <div class="date user">
                        <p>02/02/2022 06:25 am</p>
                    </div>
                    <p>Hii I am rahul vugwscswg fdwgdyuswg ffyugyuwgsd fyyugyudgiuswd yfgyudgywidw yfydfiywdiw yfdyuwgd7 gdywydgwys7 ydyfwydfyiwgd</p>
                </div>
            </div>
            <!-- <------- Pro Message --------->
            <div class="usermessage promessage">
                <!-- <------- pro message --------->
                <div class="message">
                    <div class="date pro">
                        <p>02/02/2022 06:25 am</p>
                    </div>
                    <p><img src="https://writestylesonline.com/wp-content/uploads/2018/11/Three-Statistics-That-Will-Make-You-Rethink-Your-Professional-Profile-Picture.jpg"></p>
                </div>
                <!-- <------- pro image --------->
                <img src="https://writestylesonline.com/wp-content/uploads/2018/11/Three-Statistics-That-Will-Make-You-Rethink-Your-Professional-Profile-Picture.jpg" alt="">
            </div>
            <!-- ------- User message --------->
            <div class="usermessage">
                <!-- <------- user image --------->
                <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="">
                <!-- <------- user message --------->
                <div class="message">
                    <div class="date user">
                        <p>02/02/2022 06:25 am</p>
                    </div>
                    <p><img src="https://writestylesonline.com/wp-content/uploads/2018/11/Three-Statistics-That-Will-Make-You-Rethink-Your-Professional-Profile-Picture.jpg"></p>
                </div>
            </div>
            <!-- <------- Pro Message --------->
            <div class="usermessage promessage">
                <!-- <------- pro message --------->
                <div class="message">
                    <div class="date pro">
                        <p>02/02/2022 06:25 am</p>
                    </div>
                    <p>Hii I am rahul vugwscswg fdwgdyuswg ffyugyuwgsd fyyugyudgiuswd yfgyudgywidw yfydfiywdiw yfdyuwgd7 gdywydgwys7 ydyfwydfyiwgd</p>
                </div>
                <!-- <------- pro image --------->
                <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="">
            </div>
        </div>
        <div class="image-div" id="image-div">
            <i class="bi bi-x" id="close-image-div" onclick="closeImage()" style="cursor:pointer;"></i>
            <img id="preivew_img" src="" alt="" class="preivew_img">
        </div>
        <div class="chat-box">
            <label for="message-box" class="message-box-lavel">Message</label>
            <input type="text" class="chat-input" id="chat_input">
            <button class="chatbox-btn" id="sendbtn" onclick="sendMsg(bookingId = '{{$m_est[0]->booking_show_id}}',adminId='{{session()->get('admin-login-id')}}',proid='',message='')">Send</button>
            <i class="bi bi-images upload-imgae" onclick="imageUpload()"></i>
            <form id="image_form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                <input type="hidden" name="pro_id" id="pro_id">
                <input type="file" name="image" class="file-choose" onchange="showImage()" id="choosedfiles">
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function sweetfunc(id) {
        var active = "delete";
        let result = active.concat(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    console.log(result)
                    document.getElementById(result).click();
                }
            });
    }

    function chatOpen() {
        $("#image-div").hide();
        $(".new-message-popup").css("display", "flex");
    }

    $.ajaxSetup({
        headers: {
            'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function chatClose() {
        document.getElementById('preivew_img').src = '';
        $("#image-div").hide();
        document.getElementById('chat_input').value = '';
        document.getElementById('choosedfiles').value = '';
        $(".new-message-popup").css("display", "none");
    }
    var serviceId;
    var bookingId;
    var projectTitle;
    var adminId;
    var lastid = $("#lastid").val();

    function loadData(serviceId, bookingId, projectTitle, adminId, proid) {
        console.log("adminid=" + adminId);
        console.log("pro_id =" + proid);
        console.log("booking_id = " + bookingId);
        $.ajax({
            url: '{{route(customer_messages)}}',
            data: {
                service_id: serviceId,
                booking_id: bookingId,
                adminId: adminId,
                proid: proid
            },
            type: "get",
            beforeSend: function() {
                $("#project-tit").html(projectTitle);
                $("#project-id").html('Booking Id:' + bookingId);
                $(".chat").html('<img class="loading" src="{{ url("public/image/load.gif") }}">')
                chatOpen();
            },
            success: function(data) {
                console.log(data);
                $(".chat").html(data);
                $("#pro_id").val(proid);
                scroll();

            }
        })
    }

    function loadDatasecond(bookingId, adminId, proid, lastid) {
        last();
        console.log("adminid=" + adminId);
        console.log("pro_id =" + proid);
        console.log("booking_id = " + bookingId);
        console.log("last_id = " + $("#lastid").val())
        $.ajax({
            url: '{{route(customer_messages)}}',
            data: {
                booking_id: bookingId,
                adminId: adminId,
                proid: proid,
                lastid: lastid,
            },
            type: "get",
            success: function(data) {
                console.log(data);
                if (data == $(".chat").html()) {
                    console.log("same");
                } else {
                    console.log("notsame");
                }
                $(".chat").html($(".chat").html() + data);
                $("#pro_id").val(proid);
                scroll();
            }
        })
    }

    function imageUpload() {
        $(".file-choose").click();
    }

    function showImage() {
        var file = document.getElementById("choosedfiles").files[0];
        var fr = new FileReader();
        if (file) {
            document.getElementById("preivew_img").src = URL.createObjectURL(file);
            $("#image-div").show();
        }
    }

    function closeImage() {
        document.getElementById('preivew_img').src = '';
        document.getElementById('choosedfiles').value = '';
        $("#image-div").hide();
    }
    var send = '<?php if (session()->has('admin-login-id')) {
                    echo "admin";
                } ?>';

    function sendMsg(bookingId, adminId, proid, message) {
        console.log('ser=' + serviceId);
        console.log('boo=' + bookingId);
        console.log('admin=' + adminId);
        console.log('pro=' + proid);
        console.log('message=' + message);
        console.log('send=' + send);
        var input;
        if (proid == "") {
            proid = $("#pro_id").val();
        }
        if (message == "") {
            input = $("#chat_input").val();
        } else {
            input = message + '</br>' + $("#chat_input").val();
        }
        if (input != "") {
            console.log(input);
        } else {
            console.log(input);
        }
        var project = $("#project-tit").html();
        $.ajax({
            url: "{{route('sendmessage')}}",
            data: {
                booking_id: bookingId,
                adminId: adminId,
                proid: proid,
                msg: input,
                send: send
            },
            cache: false,
            type: "get",
            success: function(data) {
                console.log(data);
                if (data == 'success') {
                    document.getElementById("chat_input").value = '';
                    last();
                    loadDatasecond(bookingId = bookingId, adminId = adminId, proid = proid,lastid)
                    scroll();
                }
            }
        })

    }


    $("#sendbtn").on('click', function(e) {
        e.preventDefault();
        if ($("#choosedfiles").val() != "") {
            $("#image_form").submit();
        }
        var message = $("#chat_input").val();
    });
    $("#image_form").on("submit", function(e) {
        e.preventDefault();
        var formdata = new FormData();
        formdata.append('image', document.getElementById("choosedfiles").files[0]);
        formdata.append("booking_id", '{{$m_est[0]->booking_show_id}}');
        formdata.append("pro_id", $("#pro_id").val());
        formdata.append("admin_id", "{{session()->get('admin-login-id')}}");
        formdata.append("send", `${send}`);
        $.ajax({
            url: "{{route('ImgUlopad')}}",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $("#token").val()
            },
            data: formdata,
            dataType: "JSON",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#sendbtn").html("sending...");
                $("#sendbtn").prop('disabled', true);
            },
            success: function(response) {
                console.log(response);
                $("#sendbtn").prop('disabled', false);
                $("#sendbtn").html("send");
                closeImage();
                var filepath = response[0];
                sendMsg(bookingId = "{{$m_est[0]->booking_show_id}}", adminId = "{{session()->get('admin-login-id')}}", proid = $("#pro_id").val(), message = filepath, send = send);

            },
            error: function(response) {
                console.log(response);
            }
        })
    })
</script>
@endsection