@extends('professional.layout.layout')
@section('content')

<style type="text/css">
   #ck-button {
   margin-top: -10px;
   margin-bottom: 29px;
   margin-left: 43px;
   background-color:#EFEFEF;
   border-radius:4px;
   border:1px solid #D0D0D0;
   float:left;
   }
   #ck-button:hover {
   background:red;
   }
   #ck-button label {
   float:left;
   width: 8em;
   margin-bottom: -0.5rem;
   }
   #ck-button label span {
   text-align:center;
   padding:11px 8px;
   display:block;
   }
   #ck-button label input {
   position:absolute;
   top:-20px;
   display: none;
   }
   #ck-button input:checked + span {
   background-color:#f30606cc;
   color:#fff;
   }
   .timehead{
    font-weight: 900;
    font-size: 19px;
   }
</style>

<div class="content-wrapper">

    <input type="hidden" name="_token" value="VhgBkZreKlkjzGC6riQe5O8njh4MalfEJTaGpO4S"><section class="content">
   <div class="container-fluid">
                  <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Update Availability</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form class="form-horizontal" method="POST" action="{{url('pro-availability-post')}}" name="update_time" id="update_time">
		 @csrf              
			  <div class="card card-solid">
                  <div class="card-body pb-0">
                     <div class="row d-flex align-items-stretch">
                        <div>
                           <!--main-->
                           <h4>Update Working Hours</h4>
                           <br>
                           <h5>Select your day availability</h5>
                           <p>
                           <div class="form-group">
                             <!-- <div class="custom-control custom-radio">
                                 <input class="custom-control-input" type="radio" id="customRadio1" name="all_day" value="hour">
                                 <label for="customRadio1" class="custom-control-label">Enter Hours</label>
                              </div>
                              <div class="custom-control custom-radio">
                                 <input class="custom-control-input" type="radio" id="all_day" name="all_day" value="all">
                                 <label for="all_day" class="custom-control-label">Open all days</label>
                              </div> -->
                           </div>
                           </p>
                           <p class="timehead">Monday
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability"  name="monday[]" value="mon_1" <?php if($monday->morning == 1){echo 'checked';} ?>><span> 08:00 - 11:00AM </span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_2" <?php if($monday->midnoon == 1){echo 'checked';} ?> name="monday[]"><span>11:00-02:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_3" <?php if($monday->afternoon == 1){echo 'checked';} ?> name="monday[]"><span>02:00-05:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_4" <?php if($monday->evening == 1){echo 'checked';} ?> name="monday[]"><span>05:00-08:00PM</span>
                              </label>
                           </div>
                           </p>
                           <p class="timehead">Tuesday
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_1" <?php if($tuesday->morning == 1){echo 'checked';} ?> name="tuesday[]"><span>08:00-11:00AM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_2" <?php if($tuesday->midnoon == 1){echo 'checked';} ?> name="tuesday[]"><span>11:00-02:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_3" <?php if($tuesday->afternoon == 1){echo 'checked';} ?> name="tuesday[]"><span>02:00-05:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_4" <?php if($tuesday->evening == 1){echo 'checked';} ?> name="tuesday[]"><span>05:00-08:00PM</span>
                              </label>
                           </div>
                           <br>
                           </p>
                           <p class="timehead">Wednesday
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_1" <?php if($wednesday->morning == 1){echo 'checked';} ?> name="wednesday[]"><span>08:00-11:00AM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_2" <?php if($wednesday->midnoon == 1){echo 'checked';} ?> name="wednesday[]"><span>11:00-02:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_3" <?php if($wednesday->afternoon == 1){echo 'checked';} ?> name="wednesday[]"><span>02:00-05:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_4" <?php if($wednesday->evening == 1){echo 'checked';} ?> name="wednesday[]"><span>05:00-08:00PM</span>
                              </label>
                           </div>
                           <br></p>
                           <p class="timehead">Thursday
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_1" <?php if($thursday->morning == 1){echo 'checked';} ?> name="thursday[]"><span>08:00-11:00AM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_2" <?php if($thursday->midnoon == 1){echo 'checked';} ?> name="thursday[]"><span>11:00-02:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_3" <?php if($thursday->afternoon == 1){echo 'checked';} ?> name="thursday[]"><span>02:00-05:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_4" <?php if($thursday->evening == 1){echo 'checked';} ?> name="thursday[]"><span>05:00-08:00PM</span>
                              </label>
                           </div>
                           <br></p>
                           <p class="timehead">Friday
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_1" <?php if($friday->morning == 1){echo 'checked';} ?> name="friday[]"><span>08:00-11:00AM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_2" <?php if($friday->midnoon == 1){echo 'checked';} ?> name="friday[]"><span>11:00-02:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_3" <?php if($friday->afternoon == 1){echo 'checked';} ?> name="friday[]"><span>02:00-05:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_4" <?php if($friday->evening == 1){echo 'checked';} ?> name="friday[]"><span>05:00-08:00PM</span>
                              </label>
                           </div>
                           <br></p>
                           <p class="timehead">Saturday
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_1" <?php if($saturday->morning == 1){echo 'checked';} ?> name="saturday[]"><span>08:00-11:00AM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_2" <?php if($saturday->midnoon == 1){echo 'checked';} ?> name="saturday[]"><span>11:00-02:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_3" <?php if($saturday->afternoon == 1){echo 'checked';} ?> name="saturday[]"><span>02:00-05:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_4" <?php if($saturday->evening == 1){echo 'checked';} ?> name="saturday[]"><span>05:00-08:00PM</span>
                              </label>
                           </div>
                           <br>
                           </p>
                           <p class="timehead">Sunday
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_1" <?php if($sunday->morning == 1){echo 'checked';} ?> name="sunday[]"><span>08:00-11:00AM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_2" <?php if($sunday->midnoon == 1){echo 'checked';} ?> name="sunday[]"><span>11:00-02:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_3" <?php if($sunday->afternoon == 1){echo 'checked';} ?> name="sunday[]"><span>02:00-05:00PM</span>
                              </label>
                           </div>
                           <div id="ck-button">
                              <label>
                              <input type="checkbox" class="availability" value="mon_4" <?php if($sunday->evening == 1){echo 'checked';} ?> name="sunday[]"><span>05:00-08:00PM</span>
                              </label>
                           </div>
                           <br>
                           </p>
                           <br>
                        </div>
                        
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                        <div class="card-footer">
                          <button type="submit" class="btn btn-info" style="float:right;">Update</button>
                       </div>
                    </div>
                 </div>
               </div>

            </div>
            
         </form>
      </div>
   </div>
</section>

  </div>
  @endsection