@extends('admin_jobick.layout.layout')
@section('content')
<div class="row page-titles">
    <ol class="breadcrumb">
    <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Home</a></li>

<li class="breadcrumb-item "><a href="{{url('admin/promo')}}">Promocode</a></li>
        <li class="breadcrumb-item active"><a href="">Details</a></li>
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
                <h4 class="card-title">Promocode Details</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4">Name</label>
                    <label for="inputEmail3" class="col-2"><B>:</B></label>
                    <div class="col-6">
                        <span class="">{{$promocode->name}}</span>
                    </div>
                </div>


                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4">Code</label>
                    <label for="inputEmail3" class="col-2"><B>:</B></label>
                    <div class="col-6">
                        <span class="">{{$promocode->code}}</span>
                    </div>
                </div>


                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4">Price(in $)</label>
                    <label for="inputEmail3" class="col-2"><B>:</B></label>
                    <div class="col-6">
                        <span class="">{{$promocode->price}}</span>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4">Promocode Image</label>
                    <label for="inputEmail3" class="col-2"><B>:</B></label>
                    <div class="col-6">
                        <img src="{{$promocode->promo_image ? url('public/promo_image/'.$promocode->promo_image) : url('public/promo_image/default.png')}} "
                            height="50" width="100">
                    </div>
                </div>


                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4">Description</label>
                    <label for="inputEmail3" class="col-2"><B>:</B></label>
                    <div class="col-6">
                        <span class="" style="word-break: break-all;">
                            <span class="">{{$promocode->description ? $promocode->description : 'NA'}}</span>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4">Starting Date</label>
                    <label for="inputEmail3" class="col-2"><B>:</B></label>
                    <div class="col-6">
                        <span class="">{{$promocode->start_date}}</span>
                    </div>
                </div>


                <div class="form-group row mb-2">
                    <label for="inputEmail3" class="col-4">Ending Date</label>
                    <label for="inputEmail3" class="col-2"><B>:</B></label>
                    <div class="col-6">
                        <span class="">{{$promocode->end_date}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')

@endsection