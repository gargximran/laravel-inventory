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
    <span >Add Product</span>
</a>

 

@endsection 

@section('main_card_content')
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Inventory</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Inventory
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
                <h5 class="card-title m-b-0">Add Inventory</h5>
                <form action="{{route('inventory_store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-t-20">
                                <label>Product Name <small class="text-muted">(required)</small></label>
                                <input name="name" type="text" required class="form-control" placeholder="Ex: RFL gas stove (21gn) etc.">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Brand Name<small class="text-muted">(required)</small></label>
                                <input name="brand" required type="text" class="form-control" placeholder="Ex: RFL">
                            </div>


                            <div class="form-group m-t-20">
                                <label>Size <small class="text-muted">(required)</small></label>
                                <input required name="size" type="text"  class="form-control" placeholder="Ex: 21 GN">
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-t-20">
                                <label>Product Code <small class="text-muted">(required)</small></label>
                                <input name="code" type="text" required class="form-control" placeholder="Ex: rfl-gg324">
                                <small class="text-muted d-block text-danger">* Must have to be unique</small>
                            </div>


                            <div class="form-group m-t-20">
                                <label for="imageUpload">Upload Image <small class="text-muted">(required)</small></label>
                                <small class="text-muted d-block text-danger">* Upload squire size image</small>
                                <input accept="image/*" required type="file" name="image" id="imageUpload" class="d-none">

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
                                    <th>Brand</th>
                                    <th>Size</th>
                                    <th>Qty.</th>
                                    <th>Code</th>
                                    <th>Action's</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $inventory)
                                <tr>
                                    <td>
                                        <p>
                                            <img
                                                src="{{ asset('inventory/images/inventory/'.$inventory->image) }}"
                                                class="table_image"
                                            />
                                        </p>
                                    </td>
                                    <td>{{ $inventory->name }}</td>
                                    <td>{{ $inventory->brand->name }}</td>
                                    <td>{{ $inventory->size }}</td>
                                    <td>{{ $inventory->quantity }}</td>
                                    <td>{{ $inventory->code }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('inventory_watch', $inventory->id) }}" class="btn btn-primary  btn-sm"><i class="mdi mdi-eye"></i> View</a> 
                                            <a href="" class="btn btn-warning btn-sm"><i class="mdi mdi-account-edit"></i> Edit</a> 
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

                                                <form action="" method="POST">
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
