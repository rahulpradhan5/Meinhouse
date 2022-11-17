@extends('admin_jobick.layout.layout')
@section('head_title','Service >> Detail View')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Service Detail</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-3"><h5>Name</h5></div>
                            <div class="col-1"><B>:</B></div>
                            <div class="col-8"><span class="" >{{$service->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3"><h5>Icon</h5></div>
                            <div class="col-1"><B>:</B></div>
                            <div class="col-8"><span class="" > <img src="{{url('assets/services/'.$service->service_image) }}" height="50" width="auto"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3"><h5>Image</h5></div>
                            <div class="col-1"><B>:</B></div>
                            <div class="col-8"><span class="" ><img src="{{url('assets/services/'.$service->service_desc_image) }}" height="50" width="auto"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3"><h5>
                            @if($service->service_type == 0)
                            Time(in Hour)
                            @else
                            Area(in Sqft)
                            @endif
                            </h5></div>
                            <div class="col-1"><B>:</B></div>
                            <div class="col-8"><span class="" >{{$service->time}}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3"><h5>Price(in $)</h5></div>
                            <div class="col-1"><B>:</B></div>
                            <div class="col-8"><span class="" >{{$service->price}}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3"><h5>Additional Price(in $)</h5></div>
                            <div class="col-1"><B>:</B></div>
                            <div class="col-8"><span class="" >{{$service->add_price}}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3"><h5>Created at</h5></div>
                            <div class="col-1"><B>:</B></div>
                            <div class="col-8"><span class="" >{{$service->created_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection