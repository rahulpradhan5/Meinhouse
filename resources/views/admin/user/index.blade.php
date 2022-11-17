@extends('admin.layout.layout')
@section('content')
<style>
.bg-color-success{
	background:#28a745;
}

.bg-color-danger{
	background:#dc3545;
}

</style>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <div class="content-wrapper">
  
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>User Management</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				  @foreach($user as $key => $userDetails)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$userDetails->name}}</td>
                    <td>{{$userDetails->email}}</td>
                    <td>                  
                        <a href="{{url("update-user/$userDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-user/$userDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>                
						<?php if($userDetails->status=='1'){ ?>
						<a href="javascript:void()" id="active<?php echo $userDetails->id; ?>" class="btn btn-success">Active</a>                
					    <?php }else{?>
						<a href="javascript:void()" id="active<?php echo $userDetails->id; ?>" class="btn btn-danger">InActive</a>                
					    <?php }?>
					</td>
                  </tr>
				 
				<script>
				$(document).ready(function(){
				$("#active<?php echo $userDetails->id; ?>").click(function(){
				$.ajax({
				url:'{{url("user_status")}}',
				method:'POST',
				data:{id:"{{$userDetails->id}}",'_token':"{{csrf_token()}}"},
				success:function(data){
				if(data=='1'){
				$("#active<?php echo $userDetails->id; ?>").css("background-color", "#dc3545");
				$('#active<?php echo $userDetails->id; ?>').html('InActive');
				}else{
				$("#active<?php echo $userDetails->id; ?>").css("background-color", "#28a745");
				$('#active<?php echo $userDetails->id; ?>').html('Active');

				}
				}
				});

				});

				});
				</script>
				 
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
				  <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
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