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

    <section class="content"><br>
   <div class="container-fluid">
                  <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Update Business Services</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form class="form-horizontal" name="updateServices" id="updateServices" action="https://meinhaus.ca/pro/business/post" method="POST">
            <input type="hidden" name="_token" value="VhgBkZreKlkjzGC6riQe5O8njh4MalfEJTaGpO4S">            <div class="card-body">
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_0" name = "services[]" value="7" checked  >
                  <label for="ser_0" class="custom-control-label">Appliance Install</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_1" name = "services[]" value="1" checked  >
                  <label for="ser_1" class="custom-control-label">Appliance Repair</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_2" name = "services[]" value="29" checked  >
                  <label for="ser_2" class="custom-control-label">Architecture</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_3" name = "services[]" value="30"   >
                  <label for="ser_3" class="custom-control-label">Basement Renovation</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_4" name = "services[]" value="32"   >
                  <label for="ser_4" class="custom-control-label">Bathroom Renovation</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_5" name = "services[]" value="2"   >
                  <label for="ser_5" class="custom-control-label">Carpet &amp; Upholstery Cleaning</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_6" name = "services[]" value="3"   >
                  <label for="ser_6" class="custom-control-label">Decks and Fences</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_7" name = "services[]" value="37"   >
                  <label for="ser_7" class="custom-control-label">Demolition</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_8" name = "services[]" value="11"   >
                  <label for="ser_8" class="custom-control-label">Eavestrough Repair</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_9" name = "services[]" value="12"   >
                  <label for="ser_9" class="custom-control-label">Electrical Companies</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_10" name = "services[]" value="14"   >
                  <label for="ser_10" class="custom-control-label">Flooring &amp; Tile Services</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_11" name = "services[]" value="15"   >
                  <label for="ser_11" class="custom-control-label">Furniture Assembly</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_12" name = "services[]" value="16"   >
                  <label for="ser_12" class="custom-control-label">Garage Door Repair</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_13" name = "services[]" value="17"   >
                  <label for="ser_13" class="custom-control-label">Gas Services</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_14" name = "services[]" value="31"   >
                  <label for="ser_14" class="custom-control-label">Kitchens</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_15" name = "services[]" value="33"   >
                  <label for="ser_15" class="custom-control-label">Landscaping</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_16" name = "services[]" value="24"   >
                  <label for="ser_16" class="custom-control-label">Locksmith</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_17" name = "services[]" value="26"   >
                  <label for="ser_17" class="custom-control-label">Mold Remediation</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_18" name = "services[]" value="27"   >
                  <label for="ser_18" class="custom-control-label">Moving &amp; Delivery</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_19" name = "services[]" value="28"   >
                  <label for="ser_19" class="custom-control-label">Painting Companies</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_20" name = "services[]" value="25"   >
                  <label for="ser_20" class="custom-control-label">Pest Control</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_21" name = "services[]" value="34"   >
                  <label for="ser_21" class="custom-control-label">Plumbing</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_22" name = "services[]" value="20"   >
                  <label for="ser_22" class="custom-control-label">Powerwash, Stain &amp; Seal</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_23" name = "services[]" value="18"   >
                  <label for="ser_23" class="custom-control-label">Roofing, Siding, and Trim</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_24" name = "services[]" value="13"   >
                  <label for="ser_24" class="custom-control-label">Seasonal Snow Clearing</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_25" name = "services[]" value="19"   >
                  <label for="ser_25" class="custom-control-label">Smart Home Install</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_26" name = "services[]" value="21"   >
                  <label for="ser_26" class="custom-control-label">Stone, Masonry, &amp; Asphalt</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_27" name = "services[]" value="22"   >
                  <label for="ser_27" class="custom-control-label">Tile &amp; Grout Cleaning</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_28" name = "services[]" value="5"   >
                  <label for="ser_28" class="custom-control-label">Tree Services</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_29" name = "services[]" value="23"   >
                  <label for="ser_29" class="custom-control-label">Water and Fire Damage</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_30" name = "services[]" value="36"   >
                  <label for="ser_30" class="custom-control-label">Waterproofing &amp; Excavation</label>
               </div>
                              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_31" name = "services[]" value="4"   >
                  <label for="ser_31" class="custom-control-label">Window &amp; Gutter Cleaning</label>
               </div>
                              <br>
               <label style="color: rgb(255, 0, 0);"><label id="services[]-error" class="error" for="services[]" style="display: none;"></label></label>
               <div class="row">
                  <div class="col-12">
                      <div class="card-footer">
                        <button type="submit" class="btn btn-info" style="float:right;">Update</button>
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