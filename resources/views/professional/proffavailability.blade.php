@extends('professional.layout.layout')
@section('head_title','AVAILABILITY')
@section('content')

<style type="text/css">

    #ck-button {

        margin-right: 1rem;

        padding:15px;

        background-color: #fff0;

        border-radius: 4px;

        border: 1px solid #D0D0D0;

        float: left;

    }



    #ck-button:hover {

      padding:15px;  

      background: #317718cc;



    }



    #ck-button label {

        float: left;

        width: fit-content;

        margin-bottom: -0.5rem;

    }



    #ck-button label input {

        position: absolute;

        top: -20px;

        font-size:24px;

        display: none;

    }



    #ck-button input:checked+span {

        background-color: #317718cc;

        padding:15px;

        width:100%;

        color: #fff;

    }

    button.btn.btn-default {

    background: white!important;

    color: black!important;

}

.hidden{

	display: none;

}

    

</style>

<?php

   error_reporting(0);

?>

<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-body">

            <fieldset>

            <form class="form-horizontal" method="POST" action="{{url('pro/pro-availability-post')}}" name="update_time" id="update_time">

                @csrf

                  <div class="form-card">

                    <h2 class="fs-title-1">Update Working Hours</h2>

                    <label class="side-label">Select Your Day Availabliity</label>

                    <div class="row">

                      <div class="col-md-6">

                        <input type="radio" id="customRadio1" name="all_day" checked="" class="new-radio">

                        Enter Hours </div>

                      <div class="col-md-6">

                        <input type="radio" id="all_day" name="all_day" class="new-radio">

                        Open all days </div>

                    </div>



                   <div class="col-md-12 mt-4">

                      <h5>Monday</h5>

                      <span id="err_monday" class="text-danger text-left"></span>

                      <div class="row">

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>

                          <input type="checkbox" id="monday" <?php if($monday->morning == 1){echo 'checked';} ?> value="mon_1" name="monday[]" class="hidden availability"  />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>

                          <input type="checkbox" value="mon_2" name="monday[]" class="hidden availability"  <?php if($monday->midnoon == 1){echo 'checked';} ?>   />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>

                          <input type="checkbox" value="mon_3" name="monday[]" class="hidden availability" <?php if($monday->afternoon == 1){echo 'checked';} ?>   />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>

                          <input type="checkbox" value="mon_4" name="monday[]" class="hidden availability" <?php if($monday->evening == 1){echo 'checked';} ?>   />

                          </span> </div>

                      </div>

                    </div>

                    <div class="col-md-12 mt-4">

                      <h5>Tuesday</h5>

                       <span id="err_tuesday" class="text-danger text-left"></span>

                      <div class="row">

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>

                          <input type="checkbox" value="mon_1" name="tuesday[]" class="hidden availability"  <?php if($tuesday->morning == 1){echo 'checked';} ?>   />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>

                          <input type="checkbox" value="mon_2" name="tuesday[]" class="hidden availability" <?php if($tuesday->midnoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>

                          <input type="checkbox" value="mon_3" name="tuesday[]" class="hidden availability" <?php if($tuesday->afternoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>

                          <input type="checkbox" value="mon_4" name="tuesday[]" class="hidden availability" <?php if($tuesday->evening == 1){echo 'checked';} ?> />

                          </span> </div>

                      </div>

                    </div>

                    <div class="col-md-12 mt-4">

                      <h5>Wednesday</h5>

                       <span id="err_wednesday" class="text-danger text-left"></span>

                      <div class="row">

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>

                          <input type="checkbox" value="mon_1" name="wednesday[]" class="hidden availability" <?php if($wednesday->morning == 1){echo 'checked';} ?>  />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>

                          <input type="checkbox" value="mon_2" name="wednesday[]" class="hidden availability" <?php if($wednesday->midnoon == 1){echo 'checked';} ?>  />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>

                          <input type="checkbox" value="mon_3" name="wednesday[]" class="hidden availability" <?php if($wednesday->afternoon == 1){echo 'checked';} ?>  />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>

                          <input type="checkbox" value="mon_4" name="wednesday[]" class="hidden availability" <?php if($wednesday->evening == 1){echo 'checked';} ?>  />

                          </span> </div>

                      </div>

                    </div>

                    <div class="col-md-12 mt-4">

                      <h5>Thursday</h5>

                       <span id="err_thrusday" class="text-danger text-left"></span>

                      <div class="row">

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>

                          <input type="checkbox" value="mon_1" name="thursday[]" class="hidden availability"  <?php if($thursday->morning == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>

                          <input type="checkbox" value="mon_2" name="thursday[]" class="hidden availability" <?php if($thursday->midnoon == 1){echo 'checked';} ?>  />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>

                          <input type="checkbox" value="mon_3" name="thursday[]" class="hidden availability" <?php if($thursday->afternoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>

                          <input type="checkbox" value="mon_4" name="thursday[]" class="hidden availability" <?php if($thursday->evening == 1){echo 'checked';} ?> />

                          </span> </div>

                      </div>

                    </div>

                    <div class="col-md-12 mt-4">

                      <h5>Friday</h5>

                       <span id="err_friday" class="text-danger text-left"></span>

                      <div class="row">

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>

                          <input type="checkbox" value="mon_1" name="friday[]" class="hidden availability" <?php if($friday->morning == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>

                          <input type="checkbox" value="mon_2" name="friday[]" class="hidden availability" <?php if($friday->midnoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>

                          <input type="checkbox" value="mon_3" name="friday[]" class="hidden availability" <?php if($friday->afternoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>

                          <input type="checkbox" value="mon_4" name="friday[]" class="hidden availability" <?php if($friday->evening == 1){echo 'checked';} ?> />

                          </span> </div>

                      </div>

                    </div>

                    <div class="col-md-12 mt-4">

                      <h5>Saturday</h5>

                       <span id="err_saturday" class="text-danger text-left"></span>

                      <div class="row">

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>

                          <input type="checkbox" value="mon_1" name="saturday[]" class="hidden availability" <?php if($saturday->morning == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>

                          <input type="checkbox" value="mon_2" name="saturday[]" class="hidden availability" <?php if($saturday->midnoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>

                          <input type="checkbox" value="mon_3" name="saturday[]" class="hidden availability" <?php if($saturday->afternoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>

                          <input type="checkbox" value="mon_4" name="saturday[]" class="hidden availability" <?php if($saturday->evening == 1){echo 'checked';} ?> />

                          </span> </div>

                      </div>

                    </div>

                    <div class="col-md-12 mt-4">

                      <h5>Sunday</h5>

                       <span id="err_sunday" class="text-danger text-left"></span>

                      <div class="row">

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>

                          <input type="checkbox" value="mon_1" name="sunday[]" class="hidden availability" <?php if($sunday->morning == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>

                          <input type="checkbox" value="mon_2" name="sunday[]" class="hidden availability" <?php if($sunday->midnoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>

                          <input type="checkbox" value="mon_3" name="sunday[]" class="hidden availability" <?php if($sunday->afternoon == 1){echo 'checked';} ?> />

                          </span> </div>

                        <div class="col-md-2"> <span class="button-checkbox input-group-btn">

                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>

                          <input type="checkbox" value="mon_4" name="sunday[]" class="hidden availability" <?php if($sunday->evening == 1){echo 'checked';} ?> />

                          </span> </div>

                      </div>

                    </div>

                  </div>

                  <input type="submit"  class="action-button btn btn-success mt-5" value="Submit" />

</form>

                </fieldset>

            </div>

        </div>

    </div>

</div>

@endsection

@section('script')

<script type="text/javascript">

  jQuery('#all_day').click(function(){  

     

    jQuery('.availability').attr('checked', true); 

    $("button").removeClass("btn-default");

    $("button").addClass("btn-primary active");

     

});



  jQuery('#customRadio1').click(function(){      

    jQuery('.availability').prop('checked', false); 

    $("button").removeClass("btn-primary active");

    $("button").addClass("btn-default");

});

</script> 

<script>

  var today = new Date();

  var tomorrow = new Date();

  tomorrow.setDate(today.getDate()+1);

   flatpickr("#date", {

    clickOpens:true,

    dateFormat:"d-m-Y",

    maxDate: tomorrow,

   });

  </script> 



<!------btn chckbox--> 

<script type="text/javascript">

  $(function () {

  $('.button-checkbox').each(function () {



    // Settings

    var $widget = $(this),

        $button = $widget.find('button'),

        $checkbox = $widget.find('input:checkbox'),

        color = $button.data('color'),

        settings = {

          on: {

            icon: ''//'glyphicon glyphicon-check'

          },

          off: {

            icon: ''//'glyphicon glyphicon-unchecked'

          }

        };



    // Event Handlers

    $button.on('click', function () {

      $checkbox.prop('checked', !$checkbox.is(':checked'));

      $checkbox.triggerHandler('change');

      updateDisplay();

    });

    $checkbox.on('change', function () {

      updateDisplay();

    });



    // Actions

    function updateDisplay() {

      var isChecked = $checkbox.is(':checked');



      // Set the button's state

      $button.data('state', (isChecked) ? "on" : "off");



      // Set the button's icon

      $button.find('.state-icon')

        .removeClass()

        .addClass('state-icon ' + settings[$button.data('state')].icon);



      // Update the button's color

      if (isChecked) {

        $button

          .removeClass('btn-default')

          .addClass('btn-' + color + ' active');

      }

      else {

        $button

          .removeClass('btn-' + color + ' active')

          .addClass('btn-default');

      }

    }



    // Initialization

    function init() {



      updateDisplay();



      // Inject the icon if applicable

      if ($button.find('.state-icon').length == 0) {

        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');

      }

    }

    init();

  });

});

  </script>

@endsection