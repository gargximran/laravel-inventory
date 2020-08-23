@extends('inventory.layout.app') 

@section('per_page_css')
<link href="{{ asset('inventory/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"/>

@endsection 



@section('per_page_js')
<script src="{{ asset('inventory/assets/extra-libs/DataTables/datatables.min.js') }}"></script>

<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $("#zero_config").DataTable();

  
</script>

@endsection 



@section('main_card_content')
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-10 d-flex no-block align-items-center">
            <h4 class="page-title">Inventory Details</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> 
                            <a href="{{route('inventory_view')}}">Inventory</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page"> 
                            {{$inventory->name}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-2">
            <img src="" alt="" class="img-fluid border border-secondary">
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
                            
                            <h2>Name : <span class="text-secondary font-weight-light">{{$inventory->name}}</span></h2>
                            <h6>Brand : <span class="text-secondary font-weight-light">{{$inventory->brand->name}}</span></h6>
                       

                            <h5>Product Code : <span class="text-secondary font-weight-light">{{$inventory->code}}</span></h5>
                            <h5>Product Size : <span class="text-secondary font-weight-light">{{$inventory->size}}</span></h5>
                            <hr>
                            <br>
                            <h6>Product Quantity : <span class="text-secondary font-weight-light">{{$inventory->quantity}}</span></h6>

                            

                        </div>
                        <div class="col-md-2 col-sm-6">                          

                            <img id="showUploadImage" src="{{asset('inventory/images/inventory/'.$inventory->image)}}" alt="" class="img-fluid border border-secondary p-1">
                            
                        </div>
                    </div>
                </div>
                   
            </div>
        </div>
    </div>

    <hr>
    <h2 class="bg-secondary text-warning px-2">Invoice Purchase History</h2>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table
                    id="zero_config"
                    class="table table-bordered table-hover text-center"
                >
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Batch No.</th>
                            <th>Purchase Date</th>
                            <th>Expire Date</th>
                            <th>Per Price</th>
                            <th>Quantity</th>
                            <th>Supplier Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventory->buy as $buy)
                        <tr>
                            <td>
                                {{$buy->invoice->id}}
                            </td>
                            <td>
                                {{$buy->id}}
                            </td>
                            <td>{{$buy->created_at}}</td>
                            <td>{{$buy->expireDate}}</td>
                            <td>{{$buy->per_price}} tk</td>
                            <td>{{$buy->quantity}} pc.</td>
                            <td>{{ $buy->supplier->name}}</td>
                            
                            
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart
                <!-- ============================================================== -->
</div>
@endsection
