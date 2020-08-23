@extends('inventory.layout.app') 

@section('per_page_css')
<link href="{{ asset('inventory/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection 



@section('per_page_js')
<script src="{{ asset('inventory/assets/extra-libs/DataTables/datatables.min.js') }}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $("#zero_config").DataTable();

    const imagePath = "{{asset('inventory/images/logo/upload.png')}}"

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
            <h4 class="page-title">Buy History</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Buy History
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


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
                    <div class="table-responsive">
                        <table
                            id="zero_config"
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
                                    <th>Store Age</th>
                                    <th>Buy Date</th>
                                    <th>Expire Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                <tr>
                                    <td>
                                        <p>
                                            <img
                                                src="{{ asset('inventory/images/inventory/'.$stock->inventory->image) }}"
                                                class="table_image"
                                            />
                                        </p>
                                    </td>
                                    <td>{{ $stock->batch}}</td>
                                    <td>{{ $stock->inventory->name}}</td>
                                    <td>{{ $stock->inventory->size}}</td>
                                    <td>{{ $stock->inventory->code}}</td>
                                    <td>{{ $stock->quantity}} pc.</td>
                                    <td>{{ $stock->purchase_price}} tk</td>
                                    @php
                                    

                                        $exp = explode('|',$stock->created_at);
   
                                        $datework = Carbon\Carbon::createFromDate($exp[0]);
                                        $now = Carbon\Carbon::now();
                                       
                                    @endphp
                                    <td>{{ $datework->diffInDays($now)}} days</td>
                                    <td>{{ $stock->created_at}}</td>
                                    <td>{{ $stock->expireDate}}</td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
