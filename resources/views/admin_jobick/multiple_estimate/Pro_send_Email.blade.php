@extends('admin_jobick.layout.layout')
@section('head_title','Project >> Details')
@section('content')
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
                    <h4 class="card-title">Project Details</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" name="add-sales" id="add-sales"
                        action="{{route('Send_Pro_Email')}}" enctype="multipart/form-data">
                        @csrf
                        
                            <?php $service = DB::table('services')->where('id',$data->service_id)->first();?>
                            <?php $estimate = DB::table('multiple_estimate')->where('id',$data->estimate_id)->first();?>
                            <?php $services = DB::table('services')->pluck('name','id');?>

                            <p class="text-primary">You’ve received this link because we have deemed you an eligible contractor to join our Qualified Contractor Network.</p>


                            <div class="form-group row mb-3 mt-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Project Type</b></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="service" required >
                                        @foreach($services as $key=>$value)
                                            <option value="{{ $key }}" {{$data->service_id == $key  ? 'selected' : ''}}>{{ $value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Project Area</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="area" placeholder="Locality" value="{{$estimate->address}}" />
                                </div>
                            </div>
                             <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Project Date</b></label>
                                <div class="col-sm-10">
                                   
                                    <input type="date" class="form-control date_picker" name="sdate" id="date_picker" value="{{$data->date ? \Carbon\Carbon::parse($data->date)->format('20y-m-d') : null}}" />
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Project Description</b></label>
                                <div class="col-sm-10">
                                    <textarea row="5" cols="20" class="form-control" name="desc" required placeholder="Enter Description">{{$data->description}}</textarea>
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Project Price Details</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{$data->pro_trade_amount}}" />
                                </div>
                            </div>


                            <!--<div class="form-group row mb-4">-->
                            <!--    <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Image <sup class="text-muted">1st</sup></b></label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <input type="file" class="form-control" name="img1">-->
                            <!--    </div>-->
                            <!--</div>-->


                            <!--<div class="form-group row mb-4">-->
                            <!--    <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Image <sup class="text-muted">2nd</sup></b></label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <input type="file" class="form-control" name="img2">-->
                            <!--    </div>-->
                            <!--</div>-->


                            <!--<div class="form-group row mb-4">-->
                            <!--    <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Image <sup class="text-muted">3rd</sup></b></label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <input type="file" class="form-control" name="img3">-->
                            <!--    </div>-->
                            <!--</div>-->


                            <!--<div class="form-group row mb-4">-->
                            <!--    <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Image <sup class="text-muted">4th</sup></b></label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <input type="file" class="form-control" name="img4">-->
                            <!--    </div>-->
                            <!--</div>-->


                            <!--<div class="form-group row mb-4">-->
                            <!--    <label for="exampleInputEmail1" class="col-sm-2 col-form-label mt-1"><b>Image <sup class="text-muted">5th</sup></b></label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <input type="file" class="form-control" name="img5">-->
                            <!--    </div>-->
                            <!--</div>-->
                            

                            <div >
                            <div class=""><b>Images</b></div>
                                <div class="row my-3">
                                    
                                    <div class="col-3">
                                        @if($estimate->img1==NULL)
                                        <img src="https://www.asiawind.org/wp-content/uploads/2019/04/dummy-post-square-1-thegem-blog-masonry.jpg" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @else
                                        <img src="{{ url("public/estimate_image/$estimate->img1") }}" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @endif
                                        <label class="custom-file-upload">
                                            <input type="file" name="img1" class="form-control col-3"/>
                                        </label>
                                    </div>
                                    
                                    <div class="col-3">
                                        @if($estimate->img2==NULL)
                                        <img src="https://www.asiawind.org/wp-content/uploads/2019/04/dummy-post-square-1-thegem-blog-masonry.jpg" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @else
                                        <img src="{{ url("public/estimate_image/$estimate->img2") }}" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @endif
                                        <label class="custom-file-upload">
                                            <input type="file" name="img2" class="form-control col-3"/>
                                        </label>
                                    </div>
                                    
                                    <div class="col-3">
                                        @if($estimate->img3==NULL)
                                        <img src="https://www.asiawind.org/wp-content/uploads/2019/04/dummy-post-square-1-thegem-blog-masonry.jpg" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @else
                                        <img src="{{ url("public/estimate_image/$estimate->img3") }}" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @endif
                                        <label class="custom-file-upload">
                                            <input type="file" name="img3" class="form-control col-3"/>
                                        </label>
                                    </div>
                                    
                                    <div class="col-3">
                                        @if($estimate->img4==NULL)
                                        <img src="https://www.asiawind.org/wp-content/uploads/2019/04/dummy-post-square-1-thegem-blog-masonry.jpg" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @else
                                        <img src="{{ url("public/estimate_image/$estimate->img4") }}" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @endif
                                        <label class="custom-file-upload">
                                            <input type="file" name="img4" class="form-control col-3"/>
                                        </label>
                                    </div>
                                    
                                    <div class="col-3">
                                        @if($estimate->img5==NULL)
                                        <img src="https://www.asiawind.org/wp-content/uploads/2019/04/dummy-post-square-1-thegem-blog-masonry.jpg" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @else
                                        <img src="{{ url("public/estimate_image/$estimate->img5") }}" style="height: 120px;width: 100%;" class="img-fluid" />
                                        @endif
                                        <label class="custom-file-upload">
                                            <input type="file" name="img5" class="form-control col-3"/>
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            
                            <div class=""><b>How we work</b></div>
                            <div class="my-2">
                                <p>&#8226;&nbsp; Register membership today and receive this project as your first MeinHaus contract!</p>
                                <p>&#8226;&nbsp; No project fees, rate agreed is the rate paid!</p>
                                <p>&#8226;&nbsp; Submit documents (Government ID, Insurance)</p>
                                <p>&#8226;&nbsp; Do the job, get paid right away!</p>
                            </div>
                            
                            
                            
                            <input type="hidden" name="estimate_id" value={{$data->estimate_id}}>
                            <input type="hidden" name="id" value={{$data->id}}>
                            <input type="hidden" name="func" value="1" >
                            
                            <br>
                            <!--<center>-->
                                <input type="submit" class="btn btn-info btn-sm" name="action" value="Update" style="width:100px;"/>
                                <input type="submit" class="btn btn-danger btn-sm ms-1" name="action" value="Send Email" style="width:100px;">
                            <!--</center>-->
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    //console.log(today);
 
    $('.date_picker').attr('min',today);
</script>

<script>
    
    $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);

    
    $('#txtDate').attr('min', maxDate);
});
</script>