@extends('admin.layout.layout')
@section('content')


  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Professional Management</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Professional</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

	 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <a href="{{ url('getProfessional') }}" class="btn btn-info float-right"><i class="fas fa-download"></i> Export</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table datatable table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    
                  </tr>
                  </thead>
                  <tbody>
				  @foreach($user as $key => $userDetails)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$userDetails->name}}</td>
                    <td>{{$userDetails->email}}</td>
                    <td>{{$userDetails->phone}}</td>
                    <td>

                        <?php if($userDetails->state=='1'){ ?>
                        <a href="javascript:void()" id="active<?php echo $userDetails->id; ?>" class="btn btn-success">Verified</a>
                        <?php }else{?>
                        <a href="javascript:void()" id="active<?php echo $userDetails->id; ?>" class="btn btn-danger">UnVarified</a>
                        <?php }?>

                        <a href="{{url("view-professional/$userDetails->id")}}" class="btn btn-info"><i class="fa fa-eye"></i></a>

                      <?php if($userDetails->status=='1'){ ?>
                      <a href="javascript:void()" id="active1<?php echo $userDetails->id; ?>" class="btn btn-success">Active</a>
                        <?php }else{?>
                      <a href="javascript:void()" id="active1<?php echo $userDetails->id; ?>" class="btn btn-danger">InActive</a>
                        <?php }?>

                      <a href="{{url("delete-user/$userDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                      <a href="{{url("delete-user/$userDetails->id")}}" class="btn btn-success delete-confirm"><i class="fa fa-edit"></i></a>



                    </td>
                  </tr>

                  <script>
                      $(document).ready(function(){
                      $("#active<?php echo $userDetails->id; ?>").click(function(){
                      $.ajax({
                      url:'{{url("user_state")}}',
                      method:'POST',
                      data:{id:"{{$userDetails->id}}",'_token':"{{csrf_token()}}"},
                      success:function(data){
                      if(data=='1'){
                      $("#active<?php echo $userDetails->id; ?>").css("background-color", "#dc3545");
                      $('#active<?php echo $userDetails->id; ?>').html('UnVarified');
                      }else{
                      $("#active<?php echo $userDetails->id; ?>").css("background-color", "#28a745");
                      $('#active<?php echo $userDetails->id; ?>').html('Varified');
              
                      }
                      }
                      });
              
                      });
              
                      });
                  </script>

                  <script>
                      $(document).ready(function(){
                      $("#active1<?php echo $userDetails->id; ?>").click(function(){
                      $.ajax({
                      url:'{{url("user_status")}}',
                      method:'POST',
                      data:{id:"{{$userDetails->id}}",'_token':"{{csrf_token()}}"},
                      success:function(data){
                      if(data=='1'){
                      $("#active1<?php echo $userDetails->id; ?>").css("background-color", "#dc3545");
                      $('#active1<?php echo $userDetails->id; ?>').html('InActive');
                      }else{
                      $("#active1<?php echo $userDetails->id; ?>").css("background-color", "#28a745");
                      $('#active1<?php echo $userDetails->id; ?>').html('Active');
              
                      }
                      }
                      });
              
                      });
              
                      });
                  </script>

                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>


   </div>
  @endsection
