@extends('professional.layout.layout')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Update Business Services</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
          <form class="form-horizontal" name="updateServices" id="updateServices" action="{{url('pro/pro-business-post')}}" method="POST">
            @csrf
            <div class="card-body row">
               @foreach($services as $key => $service)
               @if($loop->iteration<($loop->last)/2)
               <div class="col-md-6 custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_{{$key}}" name = "services[]" value="{{$service->id}}" {{in_array($service->id,$proservices) ? 'checked':''}}  >
                  <label for="ser_{{$key}}" class="custom-control-label">{{$service->name}}</label>
               </div>
               @else
               <div class="col-md-6 custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="ser_{{$key}}" name = "services[]" value="{{$service->id}}" {{in_array($service->id,$proservices) ? 'checked':''}}  >
                  <label for="ser_{{$key}}" class="custom-control-label">{{$service->name}}</label>
               </div>
               @endif
               @endforeach
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
</div>


  
@endsection