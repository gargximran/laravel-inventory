@extends('inventory.layout.app') 



@section('main_card_content')
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Supplier Details</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> 
                            <a href="{{route('supplier_view')}}">Supplier</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page"> 
                            {{$supplier->name}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            
                            <h2>Name : <span class="text-secondary font-weight-light">{{$supplier->name}}</span></h2>
                            <h6>Type : <span class="text-secondary font-weight-light">{{$supplier->type}}</span></h6>
                            <h6>Shop Name : <span class="text-secondary font-weight-light">{{$supplier->shop_name}}</span></h6>
                       

                            <h5>Address : <span class="text-secondary font-weight-light">{{$supplier->address}}</span></h5>
                            <h5>City : <span class="text-secondary font-weight-light">{{$supplier->city}}</span></h5>
                            <hr>
                            <br>
                            <h6>Email : <span class="text-secondary font-weight-light">{{$supplier->email}}</span></h6>
                            <h6>Phone : <span class="text-secondary font-weight-light">{{$supplier->phone}}</span></h6>

                            

                        </div>                       
                    </div>
                </div>
                   
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart
                <!-- ============================================================== -->
</div>
@endsection
