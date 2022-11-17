@foreach($data as $gr)
<div class="form-group row mb-2" id="inp{{$gr->id}}">
    <div class="col-sm-10">
        <input type="text" class="form-control" value="{{$gr->requirement}}" disabled style="background-color: rgb(247, 247, 247)">
    </div>
    <div class="col-sm-1">
    <!-- href="{{url("admin/delete-requirement/$gr->id")}}" -->
        <a onclick="deleteDetails(id='{{$gr->id}}',service_id='{{$gr->service_id}}')" class="btn btn-danger btn-xs mt-3 sharp"><i class="fas fa-trash"></i></a>
    </div>
</div>
@endforeach

