@extends('admin_jobick.layout.layout')
@section('head_title','Professionals')
@section('content')
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Professionals Management</h4>
                        <!---a href="{{url('admin/pro-data')}}" class="btn btn-warning shadow btn-sm sharp" style="float:right;margin-right: 10px;"><i class="fas fa-list"></i>&nbsp; Pro Data</a---->
                     <button id="btnExport" onclick="exportReportToExcel(this)" class="btn btn-warning shadow btn-sm sharp" style="float:right;margin-right: 10px;"><i class="fas fa-download"></i> EXPORT</button>         
                    </div>
                    
    <table class="table table-hover" id="table" hidden>
      <thead>
        <tr>
          <th>S.No.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
        
         @foreach($user as $e_key => $exp_data)
          <tr>
          <td>{{$e_key+1}}</td>
          <td>{{ $exp_data->name }}</td>
          <td>{{ $exp_data->email }}</td>
           <td>{{$exp_data->phone}}</td>
        </tr>
       @endforeach
    </tbody>
  </table>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
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
                                            <a href="javascript:void()" id="active<?php echo $userDetails->id; ?>" onclick="myfunction2('{{$userDetails->id}}')" class="btn btn-success shadow btn-sm sharp">Verified</a>
                                            <?php }else{?>
                                            <a href="javascript:void()" id="active<?php echo $userDetails->id; ?>"onclick="myfunction2('{{$userDetails->id}}')" class="btn btn-danger shadow btn-sm sharp">UnVerified</a>
                                            <?php }?>

                                        <?php if($userDetails->status=='1'){ ?>
                                            <a href="javascript:void()" id="active1<?php echo $userDetails->id; ?>"  onclick="myfunction('{{$userDetails->id}}')" class="btn btn-success shadow btn-sm sharp">Active</a>
                                                <?php }else{?>
                                            <a href="javascript:void()" id="active1<?php echo $userDetails->id; ?>" onclick="myfunction('{{$userDetails->id}}')" class="btn btn-danger shadow btn-sm sharp">InActive</a>
                                                <?php }?>

                                            <a href="{{url('admin/view-professional')}}/{{$userDetails->id}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                                            <button  class="btn btn-danger shadow btn-xs sharp sweet-confirm" onclick="sweetfunc('{{$userDetails->id}}')"><i class="fa fa-trash"></i></button>
                                            <a href="{{url('admin/delete-pro')}}/{{$userDetails->id}}" style="display:none" id="delete{{$userDetails->id}}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>                
                                              
                                            <a href="{{url('admin/edit-professional')}}/{{$userDetails->id}}" class="btn btn-success shadow btn-xs sharp"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#export').on('click', function(e){
            // $("#table").table2excel({
            //     exclude: ".noExport",
            //     name: "Data",
            //     filename: "Workbook",
            // });
            $("#table").table2excel({
                filename: "Employees.xls"
            });
        });
    });
</script>
<script>


    function myfunction(id) {
        var active ="#active1";
        let result = active.concat(id);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{url('admin/user_status')}}",
            data:{ id: id, '_token': "{{csrf_token()}}" },
            success: function (data) {
                if (data == '1') {
                    $(result).css("background-color", "#dc3545");
                    $(result).css("border", "0px");
                    $(result).html('InActive');
                } else {
                    $(result).css("background-color", "#68e365");
                    $(result).css("border", "0px");
                    $(result).html('Active');

                }
            }
        });
    }
    function myfunction2(id) {
        var active ="#active";
        let result = active.concat(id);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{url('admin/user_state')}}",
            data:{ id: id, '_token': "{{csrf_token()}}" },
            success: function (data) {
                if (data == '1') {
                    $(result).css("background-color", "#dc3545");
                    $(result).css("border", "0px");
                    $(result).html('UnVerified');
                } else {
                    $(result).css("background-color", "#68e365");
                    $(result).css("border", "0px");
                    $(result).html('Verified');
                }
            }
        });
    }
</script>
<script>
	function sweetfunc(id) {
        var active ="delete";
        let result = active.concat(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    console.log(result)
                    document.getElementById(result).click();
                }
            });
    }
</script>
<script>
    function exportReportToExcel() {
  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: `ProfessionalList.xlsx`, // fileName you could use any name
    sheet: {
      name: 'ProfessionalList' // sheetName
    }
  });
}
</script>
@endsection