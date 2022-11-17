@extends('admin_jobick.layout.layout')
@section('content')
<div class="row page-titles">

    <ol class="breadcrumb">

    <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>

<li class="breadcrumb-item "><a href="{{url('admin/promo')}}">Promocode</a></li>

        <li class="breadcrumb-item active"><a href="">Edit Promocode</a></li>

    </ol>

</div>
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
                <h4 class="card-title">Edit Promocode</h4>
            </div>
            <div class="card-body">
              <form class="form-horizontal" method="POST" name="add-promocodes" id="update-promocodes" action="{{url('admin/promo-edit-post')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$promocode->id}}" id="">
                <div class="card-body">
                  <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Promocode Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$promocode->name}}">
                    </div>
                  </div>
                 
                  <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="code" name="code" placeholder="Enter code" value="{{$promocode->code}}">
                    </div>
                  </div>
                 
                 <div class="form-group row mb-2">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Price(in $)</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="price" name="price" value="{{$promocode->price}}">
                    </div>
                  </div>


                  <div class="form-group row mb-2">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Promocode Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="" id="promo_image" name="promo_image">
                      <img src="{{$promocode->promo_image ? url('public/promo_image/'.$promocode->promo_image) : url('public/promo_image/default.png')}}" height="50" width="100">
                    </div>
                  </div>  

                   <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="{{$promocode->description ? $promocode->description : 'NA'}}">
                    </div>
                  </div> 
           
                   
                  
                  <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Starting Date</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Enter starting date" value="{{$promocode->start_date}}">
                    </div>
                  </div>
                 

                  <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ending Date</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Enter Ending Date" value="{{$promocode->end_date}}">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="{{ url('admin/promo') }}"><button type="button" class="btn btn-danger ">Cancel</button></a>
                  <button type="submit" class="btn btn-info">Update Now</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection