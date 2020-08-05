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

@section('create_new_button')

<a class="nav-link" href="#" role="button" data-toggle="modal" data-target="#exampleModalCenter">
    <span >Add Supplier</span>
</a>

 

@endsection 

@section('main_card_content')
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Supplier</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Supplier
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Add Supplier</h5>
                <form action="{{route('supplier_store')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-t-20">
                                <label>Supplier Name <small class="text-muted">(required)</small></label>
                                <input name="name" type="text" required class="form-control" placeholder="Ex: John Doe">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Shop Name <small class="text-muted"></small></label>
                                <input name="shop_name" type="text" class="form-control" placeholder="Ex: SST tech">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Supplier type <small class="text-muted"></small></label>
                                <select name="type" class="form-control">
                                    <option value="0">Select Supplier Type</option>
                                    <option value='1'>Whole Saler</option>
                                    <option value='2'>Distributor</option>
                                    <option value='3'>Broker</option>
                                </select>
                            </div>


                            <div class="form-group m-t-20">
                                <label>Address Line <small class="text-muted"></small></label>
                                <input name="address" type="text"  class="form-control" placeholder="Ex: Uttara-11, house-2, road-12">
                            </div>

                            <div class="form-group m-t-20">
                                <label>City <small class="text-muted"></small></label>
                                <input name="city" type="text"  class="form-control" placeholder="Ex: Uttara">
                            </div>


                            


                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-t-20">
                                <label>Email Address</label>
                                <input name="email" type="text"  class="form-control" placeholder="Ex: example@mail.com">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Phone <small class="text-muted"></small></label>
                                <input name="phone" type="text"  class="form-control" placeholder="Ex: 01734567898">
                            </div>


                            <div class="form-group m-t-20">
                                <label for="imageUpload">Upload Image <small class="text-muted"></small></label>
                                <input accept="image/*" type="file" name="image" id="imageUpload" class="d-none">

                                <label for="imageUpload" class='border border-secondary p-1'>
                                <img id="showUploadImage" src="{{asset('inventory/images/logo/upload.png')}}" alt="" class="img-fluid"></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right">
                            <hr>
                            <input type="reset" class="d-none" id="resetAction">
                            @csrf
                            <button type="button" id="resetTrigger" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
          </div>
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
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-bordered table-hover text-center"
                        >
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Shop Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Action's</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td>
                                        <p>
                                            <img
                                                src="{{ asset('inventory/images/supplier/'.$supplier->image) }}"
                                                class="table_image"
                                            />
                                        </p>
                                    </td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->type }}</td>
                                    <td>{{ $supplier->shop_name }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->city }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('supplier_view_single', $supplier->id) }}" class="btn btn-primary  btn-sm"><i class="mdi mdi-eye"></i> View</a> 
                                            <a href="{{ route('supplier_edit', $supplier->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-account-edit"></i> Edit</a> 
                                            <div class="btn-group">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger dropdown-toggle btn-sm"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <i class="mdi mdi-delete-forever"></i> Delete
                                                </button>
                                                <div
                                                    class="dropdown-menu text-center position-absolute" 
                                                    x-placement="bottom-start"
                                                
                                                >

                                                <form action="{{route('supplier_delete', $supplier->id)}}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="dropdown-item bg-danger" type="submit">Confirm Delete?</button>
                                                </form>

                                                    <a
                                                        class="dropdown-item bg-secondary"
                                                        href="#"
                                                        >Cancel</a
                                                    >
                                                
                                                </div>
                                            </div>
                                        </div>
                                                                               
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
    <!-- ============================================================== -->
    <!-- Sales chart
                <!-- ============================================================== -->
</div>
@endsection
