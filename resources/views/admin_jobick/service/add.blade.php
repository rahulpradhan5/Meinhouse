@extends('admin_jobick.layout.layout')
@section('head_title','Services >> Add New')
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Services</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" name="add-services" id="add-services"
                    action="{{url('admin/add-service-post')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Service Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Service Url</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Enter url">
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Service Icon</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="service_icon" name="service_icon">
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Service Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="service_image" name="service_image">
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <div class="col-sm-2 col-form-label">
                                <label class="wrapper" for="states">Service type</label>
                            </div>
                            <div class="col-sm-10">
                                <div>
                                    <select id="colorselector" name="service_type" class="form-control ">
                                        <option value="red">Time(hours)</option>
                                        <option value="yellow">Area (sqft)</option>
                                        <option value="pink">Get a free Quote</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="output">
                            <div id="red" class="colors red">
                                <div class="form-group mb-2 row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Enter time(in
                                        hour)</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="time" name="time"
                                            placeholder="Time">
                                    </div>
                                </div>
                            </div>
                            <div id="yellow" class="colors yellow" style="display: none;">
                                <div class="form-group mb-2 row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Enter area(in
                                        sqft)</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="time1" name="area"
                                            placeholder="Area">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-2 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Price(in $)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price"
                                    placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Additional Price(in $)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="add_price" name="add_price"
                                    placeholder="Enter Additional Price">
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea id="description" class="form-control" name="description"></textarea>
                            </div>
                        </div>



                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
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
    $('.colors').hide();
    $('#' + $(this).val()).show();
  });
});
</script>
@endsection