@extends('admin_jobick.layout.layout')
@section('head_title','Pro Data >> Detail View')
@section('content')
    {{-- <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item "><a href="javascript:void(0)">Estimate</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Pro Name</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($proData->name) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Phone</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($proData->phone) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Email</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($proData->email) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Trade</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class="">    <td> @if(!empty($proData['services']))
       {{$proData['services']->pluck('name')->implode(', ') }}
     
    @endif</td></span>
                        </div>
                    </div>
                   
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>City/Municipality</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($proData->city) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Province</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($proData->city) }}
                        </div>
                    </div>
                  
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Date of Submission</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ Carbon\Carbon::parse($proData->created_at)->format('d M Y') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
