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

    $("#zero_config1").DataTable();



  
</script>

@endsection 


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
                    <hr>
                    <h2 class="bg-secondary text-warning px-2">Invoice History</h2>
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
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($supplier->invoice as $invoice)
                                        <tr>
                                            <td>
                                                {{$invoice->id}}
                                            </td>
                                            <td>
                                               {{$invoice->created_at}}
                                            </td>
                                            <td>{{ $invoice->expense->total_after_discount }} tk</td>
                                            <td>{{ $invoice->expense->paid }} tk</td>
                                            <td>{{ $invoice->expense->due }} tk</td>
                                           
                                            
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <br>
                    <h2 class="bg-secondary text-warning px-2">Inventory History</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table
                                    id="zero_config1"
                                    class="table table-bordered table-hover text-center"
                                >
                                    <thead>
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Batch No.</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Code</th>
                                            <th>Quantity</th>
                                            <th>Per Price</th>
                                            <th>Buy Date</th>
                                            <th>Expire Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($supplier->buy as $buy)
                                        <tr>
                                            <td>
                                                {{$buy->invoice->id}}
                                            </td>
                                            <td>
                                                {{$buy->id}}
                                            </td>
                                            <td>
                                               {{$buy->inventory->name}}
                                            </td>
                                            <td>
                                               {{$buy->inventory->size}}
                                            </td>
                                            <td>
                                               {{$buy->inventory->code}}
                                            </td>

                                            <td>
                                                {{$buy->inventory->quantity}}
                                            </td>

                                            <td>
                                               {{$buy->per_price}} tk
                                            </td>
                                            <td>
                                               {{$buy->created_at}}
                                            </td>

                                            <td>
                                                @if($buy->expireDate)
                                                {{$buy->expireDate}}
                                                @else
                                                    Unlimited
                                                @endif
                                            </td>
                                          
                                            
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <hr>
                    <br>
                    <h2 class="bg-secondary text-warning px-2">Damage History</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table
                                    id="zero_config1"
                                    class="table table-bordered table-hover text-center"
                                >
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Batch No.</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Code</th>
                                            <th>Quantity</th>
                                            <th>Per Price</th>
                                            <th>Buy Date</th>
                                            <th>Damage Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($supplier->buy as $buy)
                                            @foreach ($buy->damages as $damage)
                                                <tr>
                                                    <td>
                                                        <p>
                                                            <img
                                                                src="{{ asset('inventory/images/inventory/'.$damage->inventory->image) }}"
                                                                class="table_image"
                                                            />
                                                        </p>
                                                    </td>
                                                    <td>{{$damage->batch}}</td>
                                                    <td>{{$damage->inventory->name}}</td>
                                                    <td>{{$damage->inventory->size}}</td>
                                                    <td>{{$damage->inventory->code}}</td>
                                                    <td>{{$damage->quantity}}</td>
                                                    <td>{{$buy->per_price}}</td>
                                                    <td>{{$buy->created_at}}</td>
                                                    <td>{{$damage->created_at}}</td>
                                                    
                                                
                                                    
                                                </tr>
                                            @endforeach
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
