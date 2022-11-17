@extends('website.layouts.master')

@section('after-style')

<style type="text/css">
.modal-backdrop {
  position: relative!important;
}

.modal-content {
  width: 584px;
  margin-left: -14%;
  margin-top: 70px;
  background-color: white;
  color: white;
  height: 523px;
  margin-top: -2px;
  background: white !important;
}

.section1 img {
  width: 109px;
  margin-left: 37%;
  border-radius: 230%;
  border: 2px solid white;
  margin-top: -9px;
  margin-top: -15px;
}

.section1 h1 {
  margin-left: 24%;
  font-family: Nunito;
  font-weight: 800;
  color: white;
  font-size: 23px;
  color: #1e9bd0;
}

.section1 h3 {
  margin-left: 34%;
  font-family: Nunito;
  font-weight: 800;
  margin-top: 20px;
  color: black !important;
}

.section1 textarea {
  width: 500px;
  margin-left: 44px;
}

.section1 button {
  margin-left: 98px;
  margin-top: 10px;
  margin-bottom: 20px;
  border-radius: 30px;
  font-size: 18px;
  padding: 6px 30px;
  background-color: #C7C7C7;
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
</style>



@endsection

@section('content')

<section>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">Launch Primary Modal</button>

  <div class="modal" id="modal-primary" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">

        <div class="modal-dialog">

          <div class="modal-content bg-primary">


            
              <div class="section1">
         <div class="container conntain1">
            <div class="row">
               <h1> Review professional</h1>
               <img src="{{asset('pros_images/user-dump.png')}}" style="    margin-left: 222px;
    margin-top: -37px;
    width: 112px;
    border: 2px solid white;
    border-radius: 139px"> 
               <h3>  Rahul sharma</h3>
               <!---star--->
               <div class="stars">
                  <form action="">
                     <input class="star star-5" id="star-5" type="radio" name="star"/>
                     <label class="star star-5" for="star-5"></label>
                     <input class="star star-4" id="star-4" type="radio" name="star"/>
                     <label class="star star-4" for="star-4"></label>
                     <input class="star star-3" id="star-3" type="radio" name="star"/>
                     <label class="star star-3" for="star-3"></label>
                     <input class="star star-2" id="star-2" type="radio" name="star"/>
                     <label class="star star-2" for="star-2"></label>
                     <input class="star star-1" id="star-1" type="radio" name="star"/>
                     <label class="star star-1" for="star-1"></label>
                  </form>
               </div>
               <!---end--->
               <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="Write something" maxlength="6000" rows="7"></textarea>
               <div class="container">
                  <button type="button" class="btn" data-dismiss="modal" style="background-color: #1e9bd0;">Not now</button>
                  <button type="button" class="btn btn-primary" style="background-color: #1e9bd0;">Submit</button>
               </div>
            </div>
         </div>
      </div>
              
          </div>

          <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

      </div>

      <!-- /.modal -->

</section>



 <!-- page-title -->



<!-- Button trigger modal -->

<!-- <section>

<div class="container">

  <h2>Large Modal</h2>



  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button>



  <div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Modal Header</h4>

        </div>

        <div class="modal-body">

          <p>This is a large modal.</p>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

      </div>

    </div>

  </div>

</div>

</section> -->





@endsection

@section('script')

  

@endsection