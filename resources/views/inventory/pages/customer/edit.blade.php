@extends('inventory.layout.app') 

@section('per_page_css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection 



@section('per_page_js')

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
   
  

    


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
            <h4 class="page-title">Edit Customer Details</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> 
                            <a href="{{route('customer_view_table')}}">Employee</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page"> 
                            {{$customer->name}} - Edit
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
                    <form action="{{route('customer_update', $customer->id)}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-t-20">
                                    <label>Customer Name <small class="text-muted">(required)</small></label>
                                    <input name="name" value="{{$customer->name}}" type="text" required class="form-control" placeholder="Ex: John Doe">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Shop Name <small class="text-muted"></small></label>
                                    <input name="shop_name" value="{{$customer->shop_name}}" type="text" class="form-control" placeholder="Ex: SST tech">
                                </div>


                                <div class="form-group m-t-20">
                                    <label>Address Line <small class="text-muted"></small></label>
                                    <input name="address" value="{{$customer->address}}" type="text"  class="form-control" placeholder="Ex: Uttara-11, house-2, road-12">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>City <small class="text-muted"></small></label>
                                    <input name="city" type="text" value="{{$customer->city}}"  class="form-control" placeholder="Ex: Uttara">
                                </div>


                                


                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-t-20">
                                    <label>Email Address</label>
                                    <input name="email" type="text" value="{{$customer->email}}"  class="form-control" placeholder="Ex: example@mail.com">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Phone <small class="text-muted"></small></label>
                                    <input name="phone" type="text" value="{{$customer->phone}}" class="form-control" placeholder="Ex: 01734567898">
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <hr>
                                <input type="reset" class="d-none" id="resetAction">
                                @csrf
                                <button type="button" id="resetTrigger" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
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
