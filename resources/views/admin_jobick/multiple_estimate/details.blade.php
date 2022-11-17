@extends('admin_jobick.layout.layout')
@section('content')
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item "><a href="javascript:void(0)">Estimate</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estimate Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Booking Id</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class="">{{ $m_est[0]->booking_show_id }}</span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>User Name</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($m_est[0]->name) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Email</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($m_est[0]->email) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Phone Number</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($m_est[0]->phone_no) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Services</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class="">
                                <button data-bs-toggle="modal" data-bs-target="#exampleModalCenter"
                                    class="btn btn-primary btn-xs sharp" style="border-radius: 10px;"><i class="fa fa-eye"
                                        aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Service Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        @foreach ($ms_filter as $ms)
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body" style="white-space: nowrap">
                                                        <span><b>Service Name :</b>
                                                        <?php $service = DB::table('services')->where('id', $ms->service_id)->get(); echo $service[0]->name; ?></span><br>
                                                        <span><b>Amount :</b> {{ $ms->amount }}</span><br>
                                                        <span><b>Registration Amount :</b>
                                                        {{ $ms->reg_amount }}</span><br>
                                                        {{-- {{ $ms->description }} --}}
                                                        <span><b>Professional Assigned :</b> NA</span><br>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger light"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>City</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($m_est[0]->city) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Pincode</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class=""> {{ ucwords($m_est[0]->pincode) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Payment Status</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class="">
                                @if ($m_est[0]->payment_status == 0)
                                    <span>Pending</span>
                                @elseif($m_est[0]->payment_status == 1)
                                    <span>Confirmed</span>
                                @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h5>Transaction ID</h5>
                        </div>
                        <div class="col-1"><B>:</B></div>
                        <div class="col-8"><span class="">
                                @if (empty($m_est[0]->transaction_id))
                                    <span>N/A</span>
                                @else
                                    <span>{{ strtoupper($m_est[0]->transaction_id) }}</span>
                                @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
