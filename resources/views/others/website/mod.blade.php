@extends('website.layouts.master')
@section('after-style')
<style type="text/css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Google Fonts-->
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

* {
	margin: 0px;
	padding: 0px;
}
 .modal-backdrop {
  position: relative!important;
}
.modal-title {
	margin-bottom: 0;
	line-height: 1.5;
	color: #fff;
	font-weight: bold;
	/* text-align: center; */
	padding-left: 26%;
	padding-top: 1px;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-family: 'Poppins', sans-serif !important;
}
.side-close {
	float: right;
	position: relative;
	right: -45%;
	font-size: 27px;
	margin-top: -16%;
}
.center-img {
	float: none;
	margin: 0px auto;
	border: 3px solid #fff;
	height: 80px;
	width: 80px;
	/* opacity: 1.4; */
	/* background-color: #565353; */
	border-radius: 50px;
}
.title-text {
	text-align: center;
	font-size: 19px;
	color: #fff;
	padding: 5px 0px;
	font-weight: 700;
	margin: 0;
	cursor: pointer;
	font-family: 'Poppins', sans-serif !important;
}
#user {
	float: left;
	/* text-align: center; */
	/* margin:0px auto; */
	margin-left: 28%;
	font-size: 43px;
	margin-top: 19%;
	color: #fff;
}
.center-star {
	text-align: center;
	color: #fde25c;
	min-height: 0px;
}
.modal-body {
	position: relative;
	-webkit-box-flex: 1;
	-ms-flex: 1 1 auto;
	flex: 1 1 auto;
	/* padding: 1rem; */
	background-color: rgba(25,60,157,0.9);
}
.form-control {
	display: block;
	width: 100%;
 padding: .375rem .75rem;
	font-size: 1rem;
	font-family: 'Poppins', sans-serif !important;
	line-height: 1.5;
	color: #495057;
	background-color: #fff;
	background-clip: padding-box;
	border: 1px solid #ced4da;
 border-radius: .25rem;
	transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
textarea {
	border: 1px solid #d8d7d7 !important;
	/* padding-top: 4%; */
	overflow: auto;
	margin-top: 3%;
	resize: vertical;
	height: 115px;/* padding: 9px 4px; */
}
.modal-header {
	border-bottom: none !important;
	/* float: none; */
	-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	/* margin: 0px auto; */
	background-color: #1e9bd0;
}
.modal-footer {
	border-top: none !important;
	float: none;
	width: 100%;
	margin: 0px auto;
	background-color: #1e9bd0;
}
.modal-footer>:not(:last-child) {
	margin-right: 4.25rem;
}
.btn-secondary {
	color: #1e9bd0;
	width: 39%;
	padding: 5px 28px;
	border-radius: 20px;
	border: 2px solid #40bcf1;
	background-color: #fff !important;
	font-family: 'Poppins', sans-serif !important;
	color: #1edb0;
}
.btn-secondary:hover {
	color: #000;
	transition: 1s all;
	background-color: #fff !important;
	border-color: #1e9bd0 !important;
}
.modal-header .close {
	/* padding: 0rem !important; */
    /* margin: 0rem 0rem 0rem !important; */
	color: #fff;
	height: 40px;
	margin-top: -1%;
	margin-right: 1%;
	width: 40px;
	padding: 0px;
	background-color: #cccccc6b;
	opacity: 1!important;
	border-radius: 20px;
}
/**************************Responsive Modal********************************/
 @media only screen and (max-width:768px) and (min-width:421px) {
.modal-header {
	border-bottom: none !important;
	/* float: none; */
	-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	/* margin: 0px auto; */
	background-color: #1e9bd0;
}
.modal-title {
	margin-bottom: 0;
	line-height: 1.5;
	color: #fff;
	width: 100%;
	float: none;
	margin: 0px auto;
	font-weight: bold;
	text-align: center !important;
	font-size: 15px;
	padding: 0;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-family: 'Poppins', sans-serif !important;
}
.modal-header .close {
	/* padding: 0rem !important; */
    /* margin: 0rem 0rem 0rem !important; */
	color: #fff;
	height: 35px;
	margin-top: -7%;
	margin-right: -6%;
	width: 35px;
	padding: 0px 6px;
	background-color: #cccccc6b;
	opacity: 1!important;
	border-radius: 20px;
}
}
 @media only screen and (max-width:420px) and (min-width:220px) {
.modal-header {
	border-bottom: none !important;
	/* float: none; */
	-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	/* margin: 0px auto; */
	background-color: #1e9bd0;
}
.modal-title {
	margin-bottom: 0;
	line-height: 1.5;
	color: #fff;
	width: 100%;
	float: none;
	margin: 0px auto;
	font-weight: bold;
	text-align: center !important;
	font-size: 15px;
	padding: 0;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-family: 'Poppins', sans-serif !important;
}
.modal-header .close {
	/* padding: 0rem !important; */
    /* margin: 0rem 0rem 0rem !important; */
	color: #fff;
	height: 35px;
	margin-top: -7%;
	margin-right: -6%;
	width: 35px;
	padding: 0px 6px;
	background-color: #cccccc6b;
	opacity: 1!important;
	border-radius: 20px;
}
.modal-body {
	position: relative;
	-webkit-box-flex: 1;
	-ms-flex: 1 1 auto;
	flex: 1 1 auto;
	/* padding: 1rem; */
	padding: 12px 13px;
	background-color: rgba(25,60,157,0.9);
}
.btn-secondary {
	color: #fff;
	width: 45%;
	padding: 5px 28px;
	border-radius: 20px;
	border: 2px solid #40bcf1;
	font-family: 'Poppins', sans-serif !important;
	background-color: #1e9bd0 !important;
}
.modal-footer {
	border-top: none !important;
	float: none;
	margin: 0px auto;
	width: 100%;
	background-color: #1e9bd0;
}
.modal-footer>:not(:last-child) {
	margin-right: 6%;
}
.modal-footer>:not(:first-child) {
	margin-left: -4%;
	margin-right: 4%;
}
div.stars {
  width: 270px;
  margin-left: 161px;
  display: inline-block;
  color: black! important;
}

input.star {
  display: none;
}
label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  transition: all .2s;
  color: #C7C7C7;
}

input.star:checked~label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked~label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked~label.star:before {
  color: #F62;
}

label.star:hover {
  transform: rotate(-15deg) scale(1.3);
}

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
.user-rating {
     font-size: 30px;
    padding-top: 0px;
    float: left;
    padding-bottom: 12px;
    margin-left: 36%;
    display: inline-block;
}
.user-rating input {
    opacity: 0;
    position: relative;
    left: -15px;
    z-index: 2;
    cursor: pointer;
}
.user-rating span.star:before {
    color: #777777;
    content:"ï€†";
    /*padding-right: 5px;*/
}
.user-rating span.star {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    position: relative;
    z-index: 1;
}
.user-rating span {
    margin-left: -15px;
}
.user-rating span.star:before {
    color: #777777;
    content:"\f006";
    /*padding-right: 5px;*/
}
.user-rating input:hover + span.star:before, .user-rating input:hover + span.star ~ span.star:before, .user-rating input:checked + span.star:before, .user-rating input:checked + span.star ~ span.star:before {
    color: #ffd100;
    content:"\f005";
}

.selected-rating{
    color: #ffd100;
    font-weight: bold;
    font-size: 3em;
}


</style>
@endsection

@section('content')
<div class="site-main">
    <div class="container-fluid" style="padding-top: 100px;">

         <div class="row">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Click Me!</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review Proffesional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="center-img"> <i class="fa fa-user" aria-hidden="true" id="user"></i> </div>
        <h3 class="title-text">Gaurav Kumar Pro</h3>
        <div class="center-star"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </div>
        <form>
          <div class="form-group">
            <textarea class="form-control" id="message-text" placeholder="Write Something"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Not Now</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script> 

<!-- Optional JavaScript --> 
<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@endsection