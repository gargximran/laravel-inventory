@extends('inventory.layout.app') 

@section('per_page_css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection 



@section('per_page_js')

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
   
   

    const imagePath = "{{asset('inventory/images/employee/'.$employee->image)}}"
   

    document.getElementById('imageUpload').addEventListener('change', e=>{
        let image = e.target.files[0]
        if(image){
            let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    return document.getElementById('showUploadImage').src = e.target.result
                };
        }else{
            return document.getElementById('showUploadImage').src = imagePath
        }

        
    })


    document.getElementById('resetTrigger').onclick = () => {
        document.getElementById('resetAction').click()
    }
</script>

@endsection 



@section('main_card_content')
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Edit Employee Details</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> 
                            <a href="{{route('employee_view_table')}}">Employee</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page"> 
                            {{$employee->name}} - Edit
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('employee_update', $employee->id)}}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group m-t-20">
                                <label>Employee Name <small class="text-muted">(required)</small></label>
                                <input name="name" value="{{$employee->name}}" type="text" required class="form-control" placeholder="Ex: John Doe">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Position <small class="text-muted">(required)</small></label>
                                <input name="position" value="{{$employee->position}}" type="text" required class="form-control" placeholder="Ex: Web Developer">
                            </div>


                            <div class="form-group m-t-20">
                                <label>Email <small class="text-muted"></small></label>
                                <input name="email" value="{{$employee->email}}" type="email"  class="form-control" placeholder="Ex: example@mail.com">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Phone <small class="text-muted">(required)</small></label>
                                <input name="phone" value="{{$employee->phone}}" type="text"  class="form-control" placeholder="Ex: 0191234567">
                            </div>


                            <div class="form-group m-t-20">
                                <label>Address <small class="text-muted">(required)</small></label>
                                <input name="address" value="{{$employee->address}}" type="text"  class="form-control" placeholder="Ex: Savar, Dhaka">
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-t-20">
                                <label>Salary <small class="text-muted">(required)</small></label>
                                <input name="salary" value="{{$employee->salary}}" type="text"  class="form-control" placeholder="Ex: 10000">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Yearly Vacation <small class="text-muted"></small></label>
                                <input name="vacation" value="{{$employee->yearly_vacation}}"  type="text"  class="form-control" placeholder="Ex: 12">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Experience <small class="text-muted"></small></label>
                                <input name="experience" value="{{$employee->exprience}}" type="text"  class="form-control" placeholder="Ex: 1 year & 12 month">
                            </div>

                            <div class="form-group m-t-20">
                                <label for="imageUpload">Upload Image <small class="text-muted"></small></label>
                                <input type="file" name="image" id="imageUpload" class="d-none">

                                <label for="imageUpload" class='border border-secondary p-1'>
                               
                                <img id="showUploadImage" src="{{asset('inventory/images/employee/'.$employee->image)}}" alt="" class="img-fluid">
                               
                            
                            </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right">
                            <hr>
                            <input type="reset" class="d-none" id="resetAction">
                            @csrf
                            <button type="button" id="resetTrigger" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
          </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart
                <!-- ============================================================== -->
</div>
@endsection
