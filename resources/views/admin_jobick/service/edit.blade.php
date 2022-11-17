@extends('admin_jobick.layout.layout')
@section('head_title','Service >> Edit')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Service Detail</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" name="update-service" 
                    action="{{url('admin/update-service')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$service->id}}" name="id">
                    <div class="form-group mb-2 row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value="{{$service->name}}">
                        </div>
                    </div>

                    <div class="form-group mb-2 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Service Icon</label>
                        <div class="col-sm-10">
                            <input type="file" class="" id="user_image" name="service_icon">
                            <img src="{{url('assets/services/'.$service->service_image)}}" height="50" width="100">
                        </div>
                    </div>

                    <div class="form-group mb-2 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Service Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="" id="user_image" name="service_image">
                            <img src="{{url('assets/services/'.$service->service_desc_image)}}" height="50" width="100">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <div class="col-sm-2 col-form-label">
                            <label class="wrapper" for="states">Service type</label>
                        </div>
                        <div class="col-sm-10">
                            <div>
                                <select id="colorselector" name="service_type" class="form-control">
                                    <option value="red" {{$service->service_type == 0 ? 'selected' : ''}}>Time(hours)
                                    </option>
                                    <option value="yellow" {{$service->service_type == 1 ? 'selected' : ''}}>Area (sqft)
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2 row timees">
                        <div class="col-sm-2 col-form-label">
                            @if($service->service_type == 0)
                            <label class="wrapper" for="states">Enter time(in hour)</label>
                            @else
                            <label class="wrapper" for="states">Enter area(in sqft)</label>
                            @endif
                        </div>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="time" name="time" value="{{$service->time}}">
                        </div>
                    </div>

                    <div class="output">
                        <div id="red" class="colors red" style="display: none;">
                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Enter time(in hour)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="time" name="time"
                                        value="{{$service->time}}">
                                </div>
                            </div>
                        </div>
                        <div id="yellow" class="colors yellow" style="display: none;">
                            <div class="form-group mb-2 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Enter area(in sqft)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="time1" name="area"
                                        value="{{$service->time}}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-2 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Price(in $)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="price" name="price" value="{{$service->price}}">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Additional Price(in $)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="add_price" name="add_price"
                                value="{{$service->add_price}}">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea id="description" rows="5" cols="30" class="form-control"
                                name="description">{{$service->description}}</textarea>
                        </div>
                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
      	$(function() {
  $('#colorselector').change(function(){
    $('.timees').hide();
    $('.colors').hide();
    $('#' + $(this).val()).show();
  });
});
      </script>
@endsection