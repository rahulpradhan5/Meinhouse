@extends('admin_jobick.layout.layout')
@section('head_title','Service Calls')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Service Calls Management</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>	 	 	 	
                                        <th>Service Id</th>
                                        <th>User Name</th>
                                        <th>Service Name</th>
                                        <th>Email</th>
                                        <th>Booking Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <tr>
                                      <td>1</td>
                                      <td style="color: #0d9bef;">#1SBAT245</td>
                                      <td>Sample User</td>
                                      <td>Appliance Repair</td>
                                      <td>sample@gmail.com</td>
                                      <td>
                                        <div class="btn-highlight">
                                          Pending
                                        </div>
                                      </td>
                 
                                      <td>
                                        <a href="#" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                      </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection